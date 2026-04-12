<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $order->status === 'paid' ? 'Pembayaran Berhasil' : 'Status Pembayaran' }} – {{ $projek->title }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --primary: #ff6fac;
            --accent:  #ffb5d7;
            --fg:      #f9f3ff;
            --bg:      #0b0911;
            --surface: #171422;
            --border:  #4b3a58;
            --muted:   #cfafc8;
            --faint:   #9c7f98;
            --success: #ff8fc0;
            --danger:  #ef4444;
            --warning: #f59e0b;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            color: var(--fg);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }
        .card {
            background: var(--surface);
            border: 1.5px solid var(--border);
            border-radius: 24px;
            padding: 2.5rem 2rem;
            max-width: 500px;
            width: 100%;
            text-align: center;
        }
        .icon-wrap {
            width: 88px;
            height: 88px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            margin: 0 auto 1.5rem;
            position: relative;
        }
        .icon-paid    { background: rgba(255,143,192,0.18); color: var(--success); box-shadow: 0 0 0 10px rgba(255,143,192,0.12); }
        .icon-pending { background: rgba(245,158,11,0.12); color: var(--warning); box-shadow: 0 0 0 10px rgba(245,158,11,0.06); }
        .icon-expired { background: rgba(239,68,68,0.12);  color: var(--danger);  box-shadow: 0 0 0 10px rgba(239,68,68,0.06); }
        .icon-cancelled { background: rgba(100,116,139,0.12); color: #94a3b8; box-shadow: 0 0 0 10px rgba(100,116,139,0.06); }

        h1 { font-size: 1.5rem; font-weight: 800; margin-bottom: 0.5rem; }
        .subtitle { font-size: 0.9rem; color: var(--muted); margin-bottom: 1.75rem; line-height: 1.6; }

        .info-block {
            background: rgba(255,255,255,0.03);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.5rem;
            text-align: left;
        }
        .info-row { display: flex; justify-content: space-between; gap: 1rem; margin-bottom: 0.6rem; font-size: 0.88rem; }
        .info-row:last-child { margin-bottom: 0; }
        .info-label { color: var(--muted); font-weight: 600; }
        .info-value { color: var(--fg); font-weight: 700; text-align: right; word-break: break-word; }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.85rem 1.75rem;
            border-radius: 12px;
            font-size: 0.93rem;
            font-weight: 700;
            font-family: inherit;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.25s;
            width: 100%;
        }
        .btn-primary { background: linear-gradient(135deg, var(--primary), var(--accent)); color: #fff; box-shadow: 0 4px 18px rgba(255,111,172,0.35); }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(255,111,172,0.5); }
        .btn-ghost { background: transparent; border: 1.5px solid var(--border); color: var(--muted); }
        .btn-ghost:hover { border-color: var(--primary); color: var(--fg); }
        .btn-danger { background: transparent; border: 1.5px solid rgba(239,68,68,0.35); color: #fca5a5; }
        .btn-danger:hover { background: rgba(239,68,68,0.1); border-color: var(--danger); }
        .btn-stack { display: flex; flex-direction: column; gap: 0.6rem; }

        .github-box {
            background: rgba(255,143,192,0.14);
            border: 1.5px solid rgba(255,181,215,0.35);
            border-radius: 14px;
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.5rem;
        }
        .github-box p { font-size: 0.8rem; color: var(--muted); margin-bottom: 0.75rem; display: flex; align-items: center; gap: 0.4rem; }
        .github-link {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            background: var(--primary);
            color: #fff;
            padding: 0.75rem 1.25rem;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.88rem;
            transition: background 0.25s;
            word-break: break-all;
        }
        .github-link:hover { background: var(--accent); }        .download-box {
            background: rgba(255,181,215,0.12);
            border: 1.5px solid rgba(255,181,215,0.35);
            border-radius: 14px;
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.5rem;
        }
        .download-box p { font-size: 0.8rem; color: var(--muted); margin-bottom: 0.75rem; display: flex; align-items: center; gap: 0.4rem; }
        .download-link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: #fff;
            padding: 0.85rem 1.5rem;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.95rem;
            transition: all 0.25s;
            box-shadow: 0 4px 18px rgba(255,111,172,0.35);
        }
        .download-link:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(255,111,172,0.5); }        .status-badge { display:inline-flex;align-items:center;gap:0.4rem;padding:0.25rem 0.8rem;border-radius:20px;font-size:0.72rem;font-weight:700;margin-bottom:0.65rem; }
        .status-paid    { background:rgba(255,143,192,0.2);color:var(--success);border:1px solid rgba(255,181,215,0.35); }
        .status-pending { background:rgba(245,158,11,0.12);color:var(--warning);border:1px solid rgba(245,158,11,0.25); }
        .status-expired { background:rgba(239,68,68,0.12);color:var(--danger);border:1px solid rgba(239,68,68,0.25); }
        .status-cancelled { background:rgba(100,116,139,0.12);color:#94a3b8;border:1px solid rgba(100,116,139,0.25); }

        .refresh-note { font-size: 0.76rem; color: var(--faint); margin-top: 0.5rem; display: flex; align-items: center; justify-content: center; gap: 0.35rem; }
    </style>
</head>
<body>
<div class="card">

    @if($order->status === 'paid')
    {{-- ── PAID ── --}}
    <div class="icon-wrap icon-paid"><i class="fa-solid fa-circle-check"></i></div>
    <div class="status-badge status-paid"><i class="fa-solid fa-check"></i> Lunas</div>
    <h1 style="color: var(--success);">Pembayaran Berhasil!</h1>
    <p class="subtitle">Terima kasih, <strong>{{ $order->nama }}</strong>. Berikut adalah link source code projek yang kamu beli.</p>

    <div class="info-block">
        <div class="info-row">
            <span class="info-label">Projek</span>
            <span class="info-value">{{ $projek->title }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Harga Dibayar</span>
            <span class="info-value" style="color:var(--success);">{{ $projek->hargaFormatted() }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Email</span>
            <span class="info-value">{{ $order->email }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Waktu Bayar</span>
            <span class="info-value">{{ $order->paid_at ? \Carbon\Carbon::parse($order->paid_at)->timezone('Asia/Jakarta')->format('d M Y, H:i') . ' WIB' : '-' }}</span>
        </div>
    </div>

    @if($projek->zip_file)
    <div class="download-box">
        <p><i class="fa-solid fa-circle-info" style="color:var(--accent);"></i> Download source code projek di bawah. Link download ini hanya untuk kamu.</p>
        <a href="{{ route('projek.download', $order->token) }}" class="download-link">
            <i class="fa-solid fa-file-zipper" style="font-size:1.1rem;"></i>
            Download Source Code (.zip)
        </a>
    </div>
    @elseif($projek->github_url)
    <div class="github-box">
        <p><i class="fa-solid fa-triangle-exclamation" style="color:var(--warning);"></i> Simpan link ini — halaman ini tidak bisa diakses ulang.</p>
        <a href="{{ $projek->github_url }}" target="_blank" rel="noopener noreferrer" class="github-link">
            <i class="fa-brands fa-github" style="font-size:1.1rem;flex-shrink:0;"></i>
            {{ $projek->github_url }}
        </a>
    </div>
    @endif

    <div class="btn-stack">
        <a href="/" class="btn btn-ghost"><i class="fa-solid fa-arrow-left"></i> Kembali ke Portofolio</a>
    </div>

    @elseif($order->status === 'pending')
    {{-- ── PENDING ── --}}
    <div class="icon-wrap icon-pending"><i class="fa-solid fa-clock"></i></div>
    <div class="status-badge status-pending"><i class="fa-solid fa-hourglass-half"></i> Menunggu</div>
    <h1 style="color: var(--warning);">Menunggu Pembayaran</h1>
    <p class="subtitle">Pembayaran untuk <strong>{{ $projek->title }}</strong> belum kami terima. Selesaikan pembayaran via Midtrans, lalu cek status di bawah.</p>

    <div class="info-block">
        <div class="info-row">
            <span class="info-label">Projek</span>
            <span class="info-value">{{ $projek->title }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Harga</span>
            <span class="info-value" style="color:var(--accent);">{{ $projek->hargaFormatted() }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Nama</span>
            <span class="info-value">{{ $order->nama }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Email</span>
            <span class="info-value">{{ $order->email }}</span>
        </div>
    </div>

    <div class="btn-stack">
        @if($order->invoice_url && !str_starts_with($order->invoice_url, '/'))
        <a href="{{ $order->invoice_url }}" class="btn btn-primary">
            <i class="fa-solid fa-credit-card"></i> Lanjutkan Pembayaran
        </a>
        @endif
        <a href="{{ route('projek.sukses', $order->token) }}" class="btn btn-ghost">
            <i class="fa-solid fa-rotate-right"></i> Cek Status Pembayaran
        </a>
        <form method="POST" action="{{ route('projek.batal', $order->token) }}"
              onsubmit="return confirm('Yakin ingin membatalkan pembayaran ini?')">
            @csrf
            <button type="submit" class="btn btn-danger">
                <i class="fa-solid fa-xmark"></i> Batalkan Pembayaran
            </button>
        </form>
    </div>
    <p class="refresh-note"><i class="fa-solid fa-circle-info"></i> Link download tersedia otomatis setelah pembayaran dikonfirmasi.</p>

    @elseif($order->status === 'cancelled')
    {{-- ── CANCELLED ── --}}
    <div class="icon-wrap icon-cancelled"><i class="fa-solid fa-ban"></i></div>
    <div class="status-badge status-cancelled"><i class="fa-solid fa-xmark"></i> Dibatalkan</div>
    <h1 style="color: #94a3b8;">Pembayaran Dibatalkan</h1>
    <p class="subtitle">Pembayaran untuk <strong>{{ $projek->title }}</strong> telah dibatalkan. Kamu bisa membeli ulang kapan saja.</p>
    <div class="btn-stack">
        <a href="/#projek" class="btn btn-primary"><i class="fa-solid fa-cart-shopping"></i> Beli Ulang</a>
        <a href="/" class="btn btn-ghost"><i class="fa-solid fa-arrow-left"></i> Kembali ke Portofolio</a>
    </div>

    @else
    {{-- ── EXPIRED ── --}}
    <div class="icon-wrap icon-expired"><i class="fa-solid fa-circle-xmark"></i></div>
    <div class="status-badge status-expired"><i class="fa-solid fa-clock-rotate-left"></i> Kedaluwarsa</div>
    <h1 style="color: var(--danger);">Pembayaran Kedaluwarsa</h1>
    <p class="subtitle">Sesi pembayaran untuk <strong>{{ $projek->title }}</strong> telah kedaluwarsa. Silakan ulangi proses pembelian.</p>
    <div class="btn-stack">
        <a href="/#projek" class="btn btn-primary"><i class="fa-solid fa-cart-shopping"></i> Beli Ulang</a>
        <a href="/" class="btn btn-ghost"><i class="fa-solid fa-arrow-left"></i> Kembali ke Portofolio</a>
    </div>
    @endif

</div>
</body>
</html>
