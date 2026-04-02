<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $order->status === 'paid' ? 'Pembayaran Berhasil' : 'Status Pembayaran' }} – {{ $projek->title }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --primary: #2d6a4f;
            --accent:  #0d9488;
            --fg:      #e8f5e9;
            --bg:      #0d1f16;
            --surface: #132a1e;
            --border:  #1e4030;
            --muted:   #7cad8f;
            --faint:   #3d6b55;
            --success: #22c55e;
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
            width: 90px;
            height: 90px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            margin: 0 auto 1.5rem;
        }
        .icon-paid    { background: rgba(34,197,94,0.15); }
        .icon-pending { background: rgba(245,158,11,0.15); }
        .icon-expired { background: rgba(239,68,68,0.15); }

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
            gap: 0.5rem;
            padding: 0.85rem 1.75rem;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 700;
            font-family: inherit;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.25s;
        }
        .btn-primary { background: var(--primary); color: #fff; }
        .btn-primary:hover { background: var(--accent); }
        .btn-ghost { background: transparent; border: 1.5px solid var(--border); color: var(--muted); margin-top: 0.75rem; }
        .btn-ghost:hover { border-color: var(--primary); color: var(--fg); }

        .github-box {
            background: rgba(45,106,79,0.15);
            border: 2px solid var(--primary);
            border-radius: 14px;
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.5rem;
        }
        .github-box p { font-size: 0.82rem; color: var(--muted); margin-bottom: 0.75rem; }
        .github-link {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--primary);
            color: #fff;
            padding: 0.75rem 1.25rem;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.92rem;
            transition: background 0.25s;
            word-break: break-all;
        }
        .github-link:hover { background: var(--accent); }

        .refresh-note { font-size: 0.78rem; color: var(--faint); margin-top: 1rem; }
    </style>
</head>
<body>
<div class="card">

    @if($order->status === 'paid')
    {{-- ── PAID ── --}}
    <div class="icon-wrap icon-paid">✅</div>
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

    @if($projek->github_url)
    <div class="github-box">
        <p>🔗 Simpan link ini — halaman ini tidak bisa diakses ulang setelah dibayar.</p>
        <a href="{{ $projek->github_url }}" target="_blank" rel="noopener noreferrer" class="github-link">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.3 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 21.795 24 17.295 24 12c0-6.63-5.37-12-12-12"/></svg>
            {{ $projek->github_url }}
        </a>
    </div>
    @endif

    <a href="/" class="btn btn-ghost" style="display:inline-flex;">← Kembali ke Portofolio</a>

    @elseif($order->status === 'pending')
    {{-- ── PENDING ── --}}
    <div class="icon-wrap icon-pending">⏳</div>
    <h1 style="color: var(--warning);">Menunggu Pembayaran</h1>
    <p class="subtitle">Pembayaran untuk <strong>{{ $projek->title }}</strong> belum kami terima. Selesaikan pembayaran via Midtrans, lalu refresh halaman ini.</p>

    <div class="info-block">
        <div class="info-row">
            <span class="info-label">Projek</span>
            <span class="info-value">{{ $projek->title }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Harga</span>
            <span class="info-value">{{ $projek->hargaFormatted() }}</span>
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

    @if($order->invoice_url && !str_starts_with($order->invoice_url, '/'))
    <a href="{{ $order->invoice_url }}" class="btn btn-primary">
        💳 Lanjutkan Pembayaran
    </a>
    @endif
    <br>
    <a href="{{ route('projek.sukses', $order->token) }}" class="btn btn-ghost" style="display:inline-flex;margin-top:0.75rem;">
        🔄 Cek Status Pembayaran
    </a>
    <br>
    <form method="POST" action="{{ route('projek.batal', $order->token) }}"
          onsubmit="return confirm('Yakin ingin membatalkan pembayaran ini?')">
        @csrf
        <button type="submit" class="btn btn-ghost" style="margin-top:0.75rem;color:var(--danger);border-color:var(--danger);">
            ✕ Batalkan Pembayaran
        </button>
    </form>
    <p class="refresh-note">Halaman ini akan menampilkan link GitHub setelah pembayaran dikonfirmasi.</p>

    @else
    {{-- ── EXPIRED ── --}}
    <div class="icon-wrap icon-expired">❌</div>
    <h1 style="color: var(--danger);">Pembayaran Kedaluwarsa</h1>
    <p class="subtitle">Sesi pembayaran untuk <strong>{{ $projek->title }}</strong> telah kedaluwarsa. Silakan ulangi proses pembelian.</p>

    <a href="/#projek" class="btn btn-primary">Beli Ulang</a>
    <br>
    <a href="/" class="btn btn-ghost" style="display:inline-flex;margin-top:0.75rem;">← Kembali ke Portofolio</a>
    @endif

</div>
</body>
</html>
