<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login – Portofolio</title>
    <link rel="icon" type="image/png" href="/logo.png?v=1">
    <link rel="shortcut icon" type="image/png" href="/logo.png?v=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --primary: #ff6fac; --primary2: #ff8fc0; --accent: #ffb5d7;
            --bg: #07060b; --surface: #171422; --border: #4b3a58;
            --text: #f9f3ff; --muted: #d8bfd3; --faint: #b899b3;
        }
        * { margin:0; padding:0; box-sizing:border-box; }
        body {
            font-family:'Plus Jakarta Sans',sans-serif;
            background:var(--bg); min-height:100vh;
            display:flex; align-items:center; justify-content:center;
            background-image:
                radial-gradient(ellipse at 15% 40%, rgba(255,111,172,0.16) 0%, transparent 55%),
                radial-gradient(ellipse at 85% 70%, rgba(255,181,215,0.1) 0%, transparent 55%);
        }
        .login-wrap { width:100%; max-width:420px; padding:1rem; }
        .login-card {
            background:var(--surface); border:1.5px solid var(--border);
            border-radius:20px; padding:2.5rem;
            box-shadow:0 20px 60px rgba(255,111,172,0.18);
        }
        .login-logo {
            text-align:center; margin-bottom:2rem;
        }
        .logo-text img { height:52px; width:auto; display:block; margin:0 auto; }
        .logo-sub { font-size:0.82rem; color:var(--faint); font-weight:700; margin-top:6px; text-transform:uppercase; letter-spacing:4px; }
        h2 { font-size:1.4rem; font-weight:800; color:var(--text); margin-bottom:0.35rem; }
        .subtitle { font-size:0.92rem; color:var(--faint); margin-bottom:2rem; }
        .form-group { margin-bottom:1.25rem; }
        label { display:block; font-size:0.88rem; font-weight:700; color:var(--muted); margin-bottom:0.4rem; }
        .form-control {
            width:100%; padding:0.85rem 1.1rem; border-radius:12px;
            border:1.5px solid var(--border); background:var(--surface);
            font-size:0.95rem; color:var(--text); font-family:inherit;
            transition:border-color 0.25s, box-shadow 0.25s; outline:none;
        }
        .form-control:focus { border-color:var(--primary2); box-shadow:0 0 0 3px rgba(255,111,172,0.2); }
        .form-control.is-invalid { border-color:#dc2626; }
        .error-msg { font-size:0.78rem; color:#dc2626; margin-top:4px; }
        .form-check { display:flex; align-items:center; gap:0.5rem; margin-bottom:1.5rem; }
        .form-check input { accent-color:var(--primary); width:16px; height:16px; cursor:pointer; }
        .form-check label { font-size:0.84rem; color:var(--muted); margin:0; cursor:pointer; }
        .input-pw-wrap { position:relative; display:flex; align-items:center; }
        .input-pw-wrap .form-control { padding-right:2.8rem; }
        .pw-toggle { position:absolute; right:0.85rem; background:none; border:none; cursor:pointer;
            color:var(--faint); font-size:1rem; padding:0; line-height:1; transition:color 0.2s; }
        .pw-toggle:hover { color:var(--primary); }
        .btn-login {
            width:100%; padding:0.9rem;
            background:linear-gradient(135deg,var(--primary),var(--primary2));
            color:#fff; border:none; border-radius:12px;
            font-size:1rem; font-weight:700; cursor:pointer;
            font-family:inherit; transition:all 0.3s;
            box-shadow:0 6px 20px rgba(255,111,172,0.35);
        }
        .btn-login:hover { transform:translateY(-2px); box-shadow:0 10px 30px rgba(255,111,172,0.5); }
        .back-link { text-align:center; margin-top:1.5rem; }
        .back-link a { font-size:0.82rem; color:var(--accent); font-weight:600; text-decoration:none; }
        .back-link a:hover { text-decoration:underline; }
        .alert-error {
            padding:0.85rem 1rem; border-radius:10px; margin-bottom:1.5rem;
            font-size:0.85rem; font-weight:600; color:#dc2626;
            background:rgba(220,38,38,0.08); border:1.5px solid rgba(220,38,38,0.18);
        }
    </style>
</head>
<body>
    <div class="login-wrap">
        <div class="login-card">
            <div class="login-logo">
                <div class="logo-text"><img src="/logo.png?v=1" alt="Logo"></div>
                <div class="logo-sub">Admin Panel</div>
            </div>
            <h2>Selamat Datang <i class="fa-solid fa-hand-wave" style="color:#f59e0b;"></i></h2>
            <p class="subtitle">Masuk untuk mengelola konten portfolio.</p>

            @if($errors->any())
                <div class="alert-error"><i class="fa-solid fa-circle-xmark"></i> {{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('admin.login.post') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email"
                           class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                           value="{{ old('email') }}" placeholder="admin@admin.com"
                           autocomplete="email" required autofocus>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-pw-wrap">
                        <input type="password" id="password" name="password"
                               class="form-control" placeholder="••••••••"
                               autocomplete="current-password" required>
                        <button type="button" class="pw-toggle" onclick="togglePw('password','pwIcon1')" tabindex="-1" aria-label="Tampilkan/sembunyikan password">
                            <i id="pwIcon1" class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="form-check">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Ingat saya</label>
                </div>
                <button type="submit" class="btn-login"><i class="fa-solid fa-right-to-bracket"></i> Masuk ke Admin</button>
            </form>
            <div class="back-link">
                <a href="{{ url('/') }}">← Kembali ke Portfolio</a>
            </div>
        </div>
    </div>
    <script>
    function togglePw(inputId, iconId) {
        var inp = document.getElementById(inputId);
        var ico = document.getElementById(iconId);
        if (inp.type === 'password') {
            inp.type = 'text';
            ico.classList.replace('fa-eye','fa-eye-slash');
        } else {
            inp.type = 'password';
            ico.classList.replace('fa-eye-slash','fa-eye');
        }
    }
    </script>
</body>
</html>
