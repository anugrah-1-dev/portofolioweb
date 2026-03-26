<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin – @yield('title', 'Dashboard') | Portofolio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary:  #2d6a4f;
            --primary2: #40916c;
            --accent:   #0d9488;
            --bg:       #f4f0e8;
            --bg2:      #ebf4ee;
            --surface:  #ffffff;
            --border:   #c9dfc9;
            --text:     #1a2e20;
            --muted:    #52735c;
            --faint:    #8aab90;
            --sidebar:  #162c1e;
            --sidebar2: #1f3d2b;
            --danger:   #dc2626;
        }
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Plus Jakarta Sans',sans-serif; background:var(--bg); color:var(--text); display:flex; min-height:100vh; }

        /* ── SIDEBAR ── */
        .sidebar {
            width:255px; background:var(--sidebar); min-height:100vh;
            position:fixed; top:0; left:0; bottom:0;
            display:flex; flex-direction:column;
            z-index:100;
        }
        .sidebar-brand {
            padding:1.75rem 1.5rem 1.5rem;
            border-bottom:1px solid rgba(255,255,255,0.07);
        }
        .sidebar-brand .brand-logo {
            font-size:1.6rem; font-weight:900; letter-spacing:-1px;
            background:linear-gradient(135deg,#52d68a,#5eead4);
            -webkit-background-clip:text; -webkit-text-fill-color:transparent;
        }
        .sidebar-brand .brand-sub {
            font-size:0.72rem; color:rgba(255,255,255,0.35);
            text-transform:uppercase; letter-spacing:3px; margin-top:2px;
        }
        .sidebar-nav { flex:1; padding:1rem 0; overflow-y:auto; }
        .nav-section { padding:0.5rem 1.5rem 0.35rem; font-size:0.65rem; font-weight:700;
            color:rgba(255,255,255,0.25); text-transform:uppercase; letter-spacing:3px; }
        .sidebar-nav a {
            display:flex; align-items:center; gap:0.75rem;
            padding:0.7rem 1.5rem; color:rgba(255,255,255,0.6);
            text-decoration:none; font-size:0.88rem; font-weight:600;
            transition:all 0.2s; border-left:3px solid transparent;
        }
        .sidebar-nav a:hover { color:#fff; background:rgba(255,255,255,0.06); }
        .sidebar-nav a.active { color:#5eead4; background:rgba(94,234,212,0.08); border-left-color:#5eead4; }
        .sidebar-nav .nav-icon { font-size:1.1rem; width:20px; text-align:center; }
        .sidebar-footer {
            padding:1.25rem 1.5rem;
            border-top:1px solid rgba(255,255,255,0.07);
        }
        .sidebar-footer .user-info { display:flex; align-items:center; gap:0.75rem; margin-bottom:1rem; }
        .user-avatar { width:36px; height:36px; border-radius:50%; background:linear-gradient(135deg,var(--primary),var(--accent)); display:flex; align-items:center; justify-content:center; font-size:1rem; flex-shrink:0; }
        .user-name { font-size:0.82rem; font-weight:700; color:rgba(255,255,255,0.85); }
        .user-role { font-size:0.7rem; color:rgba(255,255,255,0.35); }
        .btn-logout {
            display:flex; align-items:center; justify-content:center; gap:0.5rem;
            width:100%; padding:0.6rem; border-radius:8px;
            background:rgba(220,38,38,0.12); color:#f87171;
            border:1px solid rgba(220,38,38,0.25); font-size:0.82rem; font-weight:700;
            cursor:pointer; text-decoration:none; transition:all 0.2s; font-family:inherit;
        }
        .btn-logout:hover { background:rgba(220,38,38,0.22); }

        /* ── MAIN ── */
        .main { margin-left:255px; flex:1; display:flex; flex-direction:column; min-height:100vh; }
        .topbar {
            background:var(--surface); border-bottom:1.5px solid var(--border);
            padding:1rem 2rem; display:flex; align-items:center; justify-content:space-between;
            position:sticky; top:0; z-index:50;
        }
        .topbar-title { font-size:1.15rem; font-weight:800; color:var(--text); }
        .topbar-breadcrumb { font-size:0.78rem; color:var(--faint); margin-top:1px; }
        .topbar-right { display:flex; align-items:center; gap:1rem; }
        .view-site-btn {
            padding:0.45rem 1.1rem; border-radius:50px; border:1.5px solid var(--border);
            color:var(--muted); font-size:0.82rem; font-weight:600; text-decoration:none;
            background:var(--bg); transition:all 0.2s; font-family:inherit;
        }
        .view-site-btn:hover { border-color:var(--primary); color:var(--primary); }

        /* ── CONTENT ── */
        .content { padding:2rem; flex:1; }

        /* ── ALERTS ── */
        .alert {
            padding:1rem 1.25rem; border-radius:10px; margin-bottom:1.5rem;
            font-size:0.88rem; font-weight:600; display:flex; align-items:center; gap:0.6rem;
        }
        .alert-success { background:rgba(45,106,79,0.1); color:var(--primary); border:1.5px solid rgba(45,106,79,0.2); }
        .alert-error   { background:rgba(220,38,38,0.08); color:#dc2626; border:1.5px solid rgba(220,38,38,0.18); }

        /* ── CARDS ── */
        .card {
            background:var(--surface); border:1.5px solid var(--border);
            border-radius:16px; overflow:hidden;
        }
        .card-header {
            padding:1.25rem 1.5rem; border-bottom:1.5px solid var(--border);
            display:flex; align-items:center; justify-content:space-between;
        }
        .card-header h2 { font-size:1rem; font-weight:800; color:var(--text); }
        .card-body { padding:1.5rem; }

        /* ── TABLE ── */
        table { width:100%; border-collapse:collapse; }
        thead th {
            padding:0.75rem 1rem; text-align:left; font-size:0.72rem; font-weight:700;
            color:var(--faint); text-transform:uppercase; letter-spacing:1.5px;
            border-bottom:1.5px solid var(--border); background:var(--bg);
        }
        tbody td { padding:1rem; border-bottom:1px solid rgba(201,223,201,0.5); vertical-align:middle; }
        tbody tr:last-child td { border-bottom:none; }
        tbody tr:hover td { background:rgba(45,106,79,0.03); }
        .td-icon { font-size:1.5rem; }
        .td-title { font-size:0.9rem; font-weight:700; color:var(--text); }
        .td-sub { font-size:0.78rem; color:var(--faint); margin-top:2px; }
        .td-badge {
            display:inline-block; padding:0.2rem 0.8rem; border-radius:20px;
            font-size:0.72rem; font-weight:700;
            background:rgba(45,106,79,0.1); color:var(--primary);
            border:1px solid rgba(45,106,79,0.2);
        }
        .td-actions { display:flex; gap:0.5rem; align-items:center; }
        .btn-sm {
            padding:0.35rem 0.85rem; border-radius:8px; font-size:0.78rem; font-weight:700;
            cursor:pointer; text-decoration:none; border:none; transition:all 0.2s; font-family:inherit;
            display:inline-flex; align-items:center; gap:0.3rem;
        }
        .btn-edit { background:rgba(13,148,136,0.1); color:var(--accent); border:1px solid rgba(13,148,136,0.25); }
        .btn-edit:hover { background:rgba(13,148,136,0.2); }
        .btn-del  { background:rgba(220,38,38,0.08); color:#dc2626; border:1px solid rgba(220,38,38,0.2); }
        .btn-del:hover { background:rgba(220,38,38,0.16); }

        /* ── BUTTONS ── */
        .btn {
            padding:0.65rem 1.4rem; border-radius:10px; font-weight:700; font-size:0.88rem;
            cursor:pointer; text-decoration:none; border:none; transition:all 0.25s;
            display:inline-flex; align-items:center; gap:0.4rem; font-family:inherit;
        }
        .btn-primary { background:linear-gradient(135deg,var(--primary),var(--primary2)); color:#fff; box-shadow:0 4px 14px rgba(45,106,79,0.25); }
        .btn-primary:hover { transform:translateY(-2px); box-shadow:0 6px 20px rgba(45,106,79,0.35); }
        .btn-secondary { background:var(--bg2); color:var(--muted); border:1.5px solid var(--border); }
        .btn-secondary:hover { border-color:var(--primary); color:var(--primary); }

        /* ── FORM ── */
        .form-grid { display:grid; grid-template-columns:1fr 1fr; gap:1.25rem; }
        .form-group { display:flex; flex-direction:column; gap:0.4rem; }
        .form-group.full { grid-column:1/-1; }
        label { font-size:0.82rem; font-weight:700; color:var(--muted); }
        .form-control {
            padding:0.7rem 0.95rem; border-radius:10px;
            border:1.5px solid var(--border); background:var(--surface);
            font-size:0.9rem; color:var(--text); font-family:inherit;
            transition:border-color 0.2s, box-shadow 0.2s; outline:none; width:100%;
        }
        .form-control:focus { border-color:var(--primary2); box-shadow:0 0 0 3px rgba(45,106,79,0.1); }
        textarea.form-control { min-height:120px; resize:vertical; }
        select.form-control { cursor:pointer; }
        .form-hint { font-size:0.75rem; color:var(--faint); }
        .form-actions { display:flex; gap:1rem; margin-top:1.5rem; padding-top:1.5rem; border-top:1.5px solid var(--border); }
        .invalid-feedback { font-size:0.78rem; color:#dc2626; margin-top:2px; }

        /* ── PAGINATION ── */
        .pagination { display:flex; gap:0.4rem; align-items:center; }
        .pagination a, .pagination span {
            padding:0.4rem 0.75rem; border-radius:8px; font-size:0.82rem; font-weight:600;
            text-decoration:none; border:1.5px solid var(--border); color:var(--muted);
        }
        .pagination a:hover { border-color:var(--primary); color:var(--primary); }
        .pagination .active span { background:var(--primary); color:#fff; border-color:var(--primary); }

        /* ── EMPTY STATE ── */
        .empty-state { text-align:center; padding:3.5rem 2rem; color:var(--faint); }
        .empty-state .empty-icon { font-size:3rem; margin-bottom:1rem; }
        .empty-state p { font-size:0.9rem; }

        @media (max-width:900px) {
            .sidebar { transform:translateX(-100%); }
            .main { margin-left:0; }
            .form-grid { grid-template-columns:1fr; }
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-logo">AG.</div>
            <div class="brand-sub">Admin Panel</div>
        </div>
        <nav class="sidebar-nav">
            <div class="nav-section">Menu</div>
            <a href="{{ route('admin.dashboard') }}"
               class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="nav-icon">🏠</span> Dashboard
            </a>
            <a href="{{ route('admin.profil.edit') }}"
               class="{{ request()->routeIs('admin.profil.*') ? 'active' : '' }}">
                <span class="nav-icon">👤</span> Tentang Saya
            </a>
            <a href="{{ route('admin.sosmed.index') }}"
               class="{{ request()->routeIs('admin.sosmed.*') ? 'active' : '' }}">
                <span class="nav-icon">📱</span> Sosial Media
            </a>
            <a href="{{ route('admin.prestasi.index') }}"
               class="{{ request()->routeIs('admin.prestasi.*') ? 'active' : '' }}">
                <span class="nav-icon">🏆</span> Prestasi
            </a>
            <a href="{{ route('admin.jurnal.index') }}"
               class="{{ request()->routeIs('admin.jurnal.*') ? 'active' : '' }}">
                <span class="nav-icon">📄</span> Jurnal
            </a>
            <a href="{{ route('admin.projek.index') }}"
               class="{{ request()->routeIs('admin.projek.*') ? 'active' : '' }}">
                <span class="nav-icon">💻</span> Projek
            </a>
            <div class="nav-section" style="margin-top:1rem">Lainnya</div>
            <a href="{{ url('/') }}" target="_blank">
                <span class="nav-icon">🌿</span> Lihat Portfolio
            </a>
        </nav>
        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">👤</div>
                <div>
                    <div class="user-name">{{ auth()->user()->name }}</div>
                    <div class="user-role">Administrator</div>
                </div>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="btn-logout">🚪 Keluar</button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <div class="main">
        <div class="topbar">
            <div>
                <div class="topbar-title">@yield('title', 'Dashboard')</div>
                <div class="topbar-breadcrumb">Admin Panel &rsaquo; @yield('title', 'Dashboard')</div>
            </div>
            <div class="topbar-right">
                <a href="{{ url('/') }}" target="_blank" class="view-site-btn">🌿 Lihat Site</a>
            </div>
        </div>

        <div class="content">
            @if(session('success'))
                <div class="alert alert-success">✅ {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-error">❌ {{ session('error') }}</div>
            @endif

            @yield('content')
        </div>
    </div>

</body>
</html>
