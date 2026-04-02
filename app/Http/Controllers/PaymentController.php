<?php

namespace App\Http\Controllers;

use App\Models\Projek;
use App\Models\ProjekOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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

        // Mode demo jika belum ada API key
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

    public function webhook(Request $request)
    {
        $data = $request->all();

        $orderId           = $data['order_id']          ?? '';
        $statusCode        = $data['status_code']        ?? '';
        $grossAmount       = $data['gross_amount']       ?? '';
        $transactionStatus = $data['transaction_status'] ?? '';
        $fraudStatus       = $data['fraud_status']       ?? '';
        $signatureKey      = $data['signature_key']      ?? '';

        // Verifikasi signature Midtrans
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


class PaymentController extends Controller
{
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

        $token = Str::random(48);

        $order = ProjekOrder::create([
            'projek_id' => $projek->id,
            'nama'      => $request->nama,
            'email'     => $request->email,
            'harga'     => $projek->harga,
            'token'     => $token,
            'status'    => 'pending',
        ]);

        $secretKey = config('services.xendit.secret_key');

        // Jika belum ada API key, tampilkan halaman simulasi
        if (empty($secretKey) || $secretKey === 'YOUR_XENDIT_SECRET_KEY') {
            // Mode demo tanpa Xendit
            $order->update([
                'xendit_invoice_id'  => 'DEMO-' . $order->id,
                'xendit_invoice_url' => route('projek.sukses', $token),
            ]);
            return redirect()->route('projek.sukses', $token);
        }

        $successUrl = route('projek.sukses', $token);
        $failureUrl = url('/') . '#projek';

        $response = Http::withBasicAuth($secretKey, '')
            ->timeout(15)
            ->post('https://api.xendit.co/v2/invoices', [
                'external_id'         => 'projek-' . $order->id . '-' . $token,
                'amount'              => $projek->harga,
                'description'         => 'Akses Source Code: ' . $projek->title,
                'invoice_duration'    => 86400,
                'customer'            => [
                    'given_names' => $request->nama,
                    'email'       => $request->email,
                ],
                'customer_notification_preference' => [
                    'invoice_created' => ['email'],
                    'invoice_paid'    => ['email'],
                ],
                'success_redirect_url' => $successUrl,
                'failure_redirect_url' => $failureUrl,
                'currency'             => 'IDR',
            ]);

        if ($response->failed()) {
            $order->delete();
            return redirect()->back()->with('error', 'Gagal membuat invoice pembayaran. Coba lagi.');
        }

        $data = $response->json();

        $order->update([
            'xendit_invoice_id'  => $data['id'] ?? null,
            'xendit_invoice_url' => $data['invoice_url'] ?? null,
        ]);

        return redirect($data['invoice_url']);
    }

    public function sukses($token)
    {
        $order = ProjekOrder::where('token', $token)->firstOrFail();
        $projek = $order->projek;

        // Cek status terbaru dari Xendit jika masih pending
        if ($order->status === 'pending' && $order->xendit_invoice_id && !str_starts_with($order->xendit_invoice_id, 'DEMO')) {
            $secretKey = config('services.xendit.secret_key');
            if (!empty($secretKey) && $secretKey !== 'YOUR_XENDIT_SECRET_KEY') {
                $res = Http::withBasicAuth($secretKey, '')
                    ->get('https://api.xendit.co/v2/invoices/' . $order->xendit_invoice_id);

                if ($res->ok()) {
                    $inv = $res->json();
                    if (($inv['status'] ?? '') === 'PAID') {
                        $order->update([
                            'status'  => 'paid',
                            'paid_at' => now(),
                        ]);
                        $order->refresh();
                    } elseif (($inv['status'] ?? '') === 'EXPIRED') {
                        $order->update(['status' => 'expired']);
                        $order->refresh();
                    }
                }
            }
        }

        return view('payment.sukses', compact('order', 'projek'));
    }

    public function webhook(Request $request)
    {
        $callbackToken = $request->header('x-callback-token');
        $expectedToken = config('services.xendit.callback_token');

        if (!empty($expectedToken) && $callbackToken !== $expectedToken) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $data = $request->all();
        $status = $data['status'] ?? '';
        $externalId = $data['external_id'] ?? '';

        // external_id format: projek-{orderId}-{token}
        $parts = explode('-', $externalId);
        if (count($parts) >= 3) {
            $orderId = $parts[1];
            $order = ProjekOrder::find($orderId);

            if ($order) {
                if ($status === 'PAID' && $order->status !== 'paid') {
                    $order->update([
                        'status'  => 'paid',
                        'paid_at' => now(),
                    ]);
                } elseif ($status === 'EXPIRED' && $order->status === 'pending') {
                    $order->update(['status' => 'expired']);
                }
            }
        }

        return response()->json(['status' => 'ok']);
    }
}
