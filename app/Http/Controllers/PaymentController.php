<?php

namespace App\Http\Controllers;

use App\Models\Projek;
use App\Models\ProjekOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    private function midtransUrl(): string
    {
        $isProduction = config('services.midtrans.is_production', false);
        return $isProduction
            ? 'https://app.midtrans.com/snap/v1/transactions'
            : 'https://app.sandbox.midtrans.com/snap/v1/transactions';
    }

    public function beli(Request $request, $id)
    {
        $projek = Projek::findOrFail($id);

        if (!$projek->isBerbayar()) {
            return redirect()->back()->with('error', 'Projek ini gratis, tidak perlu pembayaran.');
        }

        $request->validate([
            'nama'  => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $token   = Str::random(48);
        $orderId = 'PROJEK-' . time() . '-' . Str::random(6);

        $order = ProjekOrder::create([
            'projek_id'  => $projek->id,
            'nama'       => $request->nama,
            'email'      => $request->email,
            'harga'      => $projek->harga,
            'token'      => $token,
            'invoice_id' => $orderId,
            'status'     => 'pending',
        ]);

        $serverKey = config('services.midtrans.server_key');

        if (empty($serverKey)) {
            $order->update(['invoice_url' => route('projek.sukses', $token)]);
            return redirect()->route('projek.sukses', $token);
        }

        $finishUrl = route('projek.sukses', $token);

        $response = Http::withBasicAuth($serverKey, '')
            ->timeout(15)
            ->post($this->midtransUrl(), [
                'transaction_details' => [
                    'order_id'     => $orderId,
                    'gross_amount' => (int) $projek->harga,
                ],
                'customer_details' => [
                    'first_name' => $request->nama,
                    'email'      => $request->email,
                ],
                'item_details' => [
                    [
                        'id'       => 'projek-' . $projek->id,
                        'price'    => (int) $projek->harga,
                        'quantity' => 1,
                        'name'     => 'Source Code: ' . mb_substr($projek->title, 0, 50),
                    ],
                ],
                'callbacks' => [
                    'finish'  => $finishUrl,
                    'error'   => $finishUrl,
                    'pending' => $finishUrl,
                ],
            ]);

        if ($response->failed()) {
            $order->delete();
            return redirect()->back()->with('error', 'Gagal membuat sesi pembayaran. Coba lagi.');
        }

        $data = $response->json();

        $order->update(['invoice_url' => $data['redirect_url'] ?? null]);

        return redirect($data['redirect_url']);
    }

    public function sukses($token)
    {
        $order  = ProjekOrder::where('token', $token)->firstOrFail();
        $projek = $order->projek;

        return view('payment.sukses', compact('order', 'projek'));
    }

    public function download($token)
    {
        $order = ProjekOrder::where('token', $token)->firstOrFail();

        if ($order->status !== 'paid') {
            abort(403, 'Akses ditolak. Pembayaran belum dikonfirmasi.');
        }

        $projek = $order->projek;

        if (!$projek->zip_file || !Storage::disk('local')->exists($projek->zip_file)) {
            abort(404, 'File ZIP belum tersedia. Hubungi penjual.');
        }

        $filename = Str::slug($projek->title) . '.zip';
        return Storage::disk('local')->download($projek->zip_file, $filename);
    }

    public function batal(Request $request, $token)
    {
        $order = ProjekOrder::where('token', $token)->firstOrFail();

        if ($order->status !== 'pending') {
            return redirect()->route('projek.sukses', $token)
                ->with('error', 'Pembayaran tidak bisa dibatalkan.');
        }

        $order->update(['status' => 'cancelled']);

        return redirect('/')->with('info', 'Pembayaran berhasil dibatalkan.');
    }

    public function webhook(Request $request)
    {
        $data = $request->all();

        $orderId           = $data['order_id']          ?? '';
        $statusCode        = $data['status_code']        ?? '';
        $grossAmount       = $data['gross_amount']       ?? '';
        $transactionStatus = $data['transaction_status'] ?? '';
        $fraudStatus       = $data['fraud_status']       ?? '';
        $signatureKey      = $data['signature_key']      ?? '';

        $serverKey = config('services.midtrans.server_key');
        $expected  = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

        if (!empty($serverKey) && !hash_equals($expected, $signatureKey)) {
            return response()->json(['error' => 'Invalid signature'], 401);
        }

        $order = ProjekOrder::where('invoice_id', $orderId)->first();

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        $isPaid = $transactionStatus === 'settlement'
            || ($transactionStatus === 'capture' && $fraudStatus === 'accept');

        if ($isPaid && $order->status !== 'paid') {
            $order->update([
                'status'  => 'paid',
                'paid_at' => now(),
            ]);
        } elseif (in_array($transactionStatus, ['cancel', 'deny', 'expire']) && $order->status === 'pending') {
            $order->update(['status' => 'expired']);
        }

        return response()->json(['status' => 'ok']);
    }
}