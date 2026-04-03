<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin – @yield('title', 'Dashboard') | Portofolio</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="alternate icon" href="/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --primary:  #2d6a4f;
            --primary2: #40916c;
            --primary3: #52b788;
            --accent:   #0d9488;
            --accent2:  #5eead4;
            --bg:       #f1f5f0;
            --bg2:      #e8f0eb;
            --surface:  #ffffff;
            --border:   #d4e5d4;
            --text:     #1a2e20;
            --muted:    #52735c;
            --faint:    #8aab90;
            --sidebar:  #0f1f15;
            --sidebar2: #162c1e;
            --danger:   #dc2626;
            --gold:     #b5883e;
        }
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Plus Jakarta Sans',sans-serif; background:var(--bg); color:var(--text); display:flex; min-height:100vh; }

        /* ── SIDEBAR ── */
        .sidebar {
            width:275px; min-height:100vh;
            position:fixed; top:0; left:0; bottom:0;
            display:flex; flex-direction:column;
            z-index:100;
            background: linear-gradient(180deg, #0f1f15 0%, #162c1e 40%, #1a3524 100%);
        }
        .sidebar::before {
            content:''; position:absolute; inset:0; pointer-events:none;
            background: radial-gradient(ellipse at 30% 20%, rgba(94,234,212,0.06) 0%, transparent 60%),
                        radial-gradient(ellipse at 70% 80%, rgba(45,106,79,0.08) 0%, transparent 60%);
        }

        /* Brand */
        .sidebar-brand {
            padding:1.75rem 1.5rem 1.25rem;
            border-bottom:1px solid rgba(255,255,255,0.08);
            position:relative;
        }
        .sidebar-brand::after {
            content:''; position:absolute; bottom:0; left:1.5rem; right:1.5rem; height:1px;
            background:linear-gradient(90deg, transparent, rgba(94,234,212,0.3), transparent);
        }
        .brand-logo {
            font-size:1.3rem; font-weight:900; letter-spacing:0.5px; line-height:1.3;
            background:linear-gradient(135deg,#5eead4 0%,#52d68a 50%,#b5883e 100%);
            -webkit-background-clip:text; -webkit-text-fill-color:transparent;
        }
        .brand-sub {
            font-size:0.78rem; color:rgba(255,255,255,0.4);
            text-transform:uppercase; letter-spacing:4px; margin-top:4px;
            font-weight:700;
        }

        /* Nav */
        .sidebar-nav { flex:1; padding:1rem 0; overflow-y:auto; position:relative; }
        .sidebar-nav::-webkit-scrollbar { width:3px; }
        .sidebar-nav::-webkit-scrollbar-thumb { background:rgba(94,234,212,0.2); border-radius:3px; }
        .nav-section {
            padding:1rem 1.5rem 0.5rem; font-size:0.68rem; font-weight:800;
            color:rgba(255,255,255,0.2); text-transform:uppercase; letter-spacing:4px;
        }
        .sidebar-nav a {
            display:flex; align-items:center; gap:0.85rem;
            padding:0.75rem 1.5rem; color:rgba(255,255,255,0.5);
            text-decoration:none; font-size:0.92rem; font-weight:600;
            transition:all 0.25s; border-left:3px solid transparent;
            position:relative; margin:1px 0;
        }
        .sidebar-nav a:hover {
            color:rgba(255,255,255,0.9); background:rgba(255,255,255,0.06);
            border-left-color:rgba(94,234,212,0.4);
        }
        .sidebar-nav a.active {
            color:#5eead4; background:rgba(94,234,212,0.10);
            border-left-color:#5eead4; font-weight:700;
        }
        .sidebar-nav a.active::after {
            content:''; position:absolute; right:0; top:25%; bottom:25%;
            width:3px; background:#5eead4; border-radius:3px 0 0 3px;
        }
        .nav-icon { font-size:1rem; width:24px; text-align:center; flex-shrink:0; color:inherit; }

        /* Footer */
        .sidebar-footer {
            padding:1.25rem 1.5rem;
            border-top:1px solid rgba(255,255,255,0.08);
            background:rgba(0,0,0,0.15);
            position:relative;
        }
        .sidebar-footer .user-info { display:flex; align-items:center; gap:0.85rem; margin-bottom:1rem; }
        .user-avatar {
            width:40px; height:40px; border-radius:12px;
            background:linear-gradient(135deg,var(--primary),var(--accent));
            display:flex; align-items:center; justify-content:center;
            font-size:1.1rem; flex-shrink:0;
            box-shadow:0 4px 12px rgba(0,0,0,0.3);
        }
        .user-name { font-size:0.88rem; font-weight:700; color:rgba(255,255,255,0.9); }
        .user-role { font-size:0.72rem; color:rgba(255,255,255,0.35); font-weight:600; letter-spacing:0.5px; }
        .btn-logout {
            display:flex; align-items:center; justify-content:center; gap:0.5rem;
            width:100%; padding:0.65rem; border-radius:10px;
            background:rgba(220,38,38,0.10); color:#f87171;
            border:1.5px solid rgba(220,38,38,0.20); font-size:0.85rem; font-weight:700;
            cursor:pointer; text-decoration:none; transition:all 0.25s; font-family:inherit;
        }
        .btn-logout:hover { background:rgba(220,38,38,0.22); border-color:rgba(220,38,38,0.35); transform:translateY(-1px); }

        /* ── MAIN ── */
        .main { margin-left:275px; flex:1; display:flex; flex-direction:column; min-height:100vh; }

        /* Topbar */
        .topbar {
            background:rgba(255,255,255,0.85); backdrop-filter:blur(20px);
            border-bottom:1.5px solid var(--border);
            padding:1.1rem 2.25rem; display:flex; align-items:center; justify-content:space-between;
            position:sticky; top:0; z-index:50;
        }
        .topbar-title { font-size:1.25rem; font-weight:800; color:var(--text); letter-spacing:-0.3px; }
        .topbar-breadcrumb { font-size:0.82rem; color:var(--faint); margin-top:2px; font-weight:500; }
        .topbar-right { display:flex; align-items:center; gap:1rem; }
        .view-site-btn {
            padding:0.5rem 1.25rem; border-radius:50px; border:1.5px solid var(--border);
            color:var(--muted); font-size:0.85rem; font-weight:700; text-decoration:none;
            background:var(--surface); transition:all 0.25s; font-family:inherit;
            box-shadow:0 2px 8px rgba(0,0,0,0.04);
        }
        .view-site-btn:hover { border-color:var(--primary); color:var(--primary); transform:translateY(-1px); box-shadow:0 4px 12px rgba(45,106,79,0.12); }

        /* ── CONTENT ── */
        .content { padding:2.25rem; flex:1; }

        /* ── ALERTS ── */
        .alert {
            padding:1.1rem 1.35rem; border-radius:12px; margin-bottom:1.75rem;
            font-size:0.92rem; font-weight:600; display:flex; align-items:center; gap:0.7rem;
            animation: slideDown 0.4s ease;
        }
        @keyframes slideDown { from { opacity:0; transform:translateY(-10px); } to { opacity:1; transform:translateY(0); } }
        .alert-success { background:rgba(45,106,79,0.08); color:var(--primary); border:1.5px solid rgba(45,106,79,0.18); }
        .alert-error   { background:rgba(220,38,38,0.06); color:#dc2626; border:1.5px solid rgba(220,38,38,0.15); }

        /* ── CARDS ── */
        .card {
            background:var(--surface); border:1.5px solid var(--border);
            border-radius:18px; overflow:hidden;
            box-shadow:0 2px 12px rgba(45,106,79,0.04);
            transition:box-shadow 0.3s;
        }
        .card:hover { box-shadow:0 4px 20px rgba(45,106,79,0.08); }
        .card-header {
            padding:1.35rem 1.6rem; border-bottom:1.5px solid var(--border);
            display:flex; align-items:center; justify-content:space-between;
            background:linear-gradient(135deg, rgba(244,240,232,0.3) 0%, rgba(235,244,238,0.5) 100%);
        }
        .card-header h2 { font-size:1.08rem; font-weight:800; color:var(--text); }
        .card-body { padding:1.6rem; }

        /* ── TABLE ── */
        table { width:100%; border-collapse:collapse; }
        thead th {
            padding:0.85rem 1.1rem; text-align:left; font-size:0.75rem; font-weight:800;
            color:var(--faint); text-transform:uppercase; letter-spacing:1.5px;
            border-bottom:1.5px solid var(--border); background:var(--bg2);
        }
        tbody td { padding:1.1rem; border-bottom:1px solid rgba(212,229,212,0.6); vertical-align:middle; font-size:0.92rem; }
        tbody tr:last-child td { border-bottom:none; }
        tbody tr { transition:background 0.2s; }
        tbody tr:hover td { background:rgba(45,106,79,0.03); }
        .td-icon { font-size:1.6rem; }
        .td-title { font-size:0.95rem; font-weight:700; color:var(--text); }
        .td-sub { font-size:0.82rem; color:var(--faint); margin-top:3px; }
        .td-badge {
            display:inline-block; padding:0.25rem 0.85rem; border-radius:20px;
            font-size:0.75rem; font-weight:700;
            background:rgba(45,106,79,0.08); color:var(--primary);
            border:1.5px solid rgba(45,106,79,0.18);
        }
        .td-actions { display:flex; gap:0.6rem; align-items:center; }
        .btn-sm {
            padding:0.4rem 0.95rem; border-radius:10px; font-size:0.82rem; font-weight:700;
            cursor:pointer; text-decoration:none; border:none; transition:all 0.25s; font-family:inherit;
            display:inline-flex; align-items:center; gap:0.35rem;
        }
        .btn-edit { background:rgba(13,148,136,0.08); color:var(--accent); border:1.5px solid rgba(13,148,136,0.2); }
        .btn-edit:hover { background:rgba(13,148,136,0.16); transform:translateY(-1px); }
        .btn-del  { background:rgba(220,38,38,0.06); color:#dc2626; border:1.5px solid rgba(220,38,38,0.15); }
        .btn-del:hover { background:rgba(220,38,38,0.14); transform:translateY(-1px); }

        /* ── BUTTONS ── */
        .btn {
            padding:0.7rem 1.5rem; border-radius:12px; font-weight:700; font-size:0.92rem;
            cursor:pointer; text-decoration:none; border:none; transition:all 0.3s;
            display:inline-flex; align-items:center; gap:0.45rem; font-family:inherit;
        }
        .btn-primary {
            background:linear-gradient(135deg,var(--primary),var(--primary2));
            color:#fff; box-shadow:0 4px 16px rgba(45,106,79,0.25);
        }
        .btn-primary:hover { transform:translateY(-2px); box-shadow:0 8px 24px rgba(45,106,79,0.35); }
        .btn-secondary { background:var(--surface); color:var(--muted); border:1.5px solid var(--border); }
        .btn-secondary:hover { border-color:var(--primary); color:var(--primary); transform:translateY(-1px); }

        /* ── FORM ── */
        .form-grid { display:grid; grid-template-columns:1fr 1fr; gap:1.35rem; }
        .form-group { display:flex; flex-direction:column; gap:0.45rem; }
        .form-group.full { grid-column:1/-1; }
        label { font-size:0.88rem; font-weight:700; color:var(--muted); }
        .form-control {
            padding:0.75rem 1rem; border-radius:12px;
            border:1.5px solid var(--border); background:var(--surface);
            font-size:0.95rem; color:var(--text); font-family:inherit;
            transition:border-color 0.25s, box-shadow 0.25s; outline:none; width:100%;
        }
        .form-control:focus { border-color:var(--primary2); box-shadow:0 0 0 4px rgba(45,106,79,0.08); }
        textarea.form-control { min-height:130px; resize:vertical; }
        select.form-control { cursor:pointer; }
        .form-hint { font-size:0.78rem; color:var(--faint); }
        .form-actions { display:flex; gap:1rem; margin-top:1.75rem; padding-top:1.75rem; border-top:1.5px solid var(--border); }
        .invalid-feedback { font-size:0.82rem; color:#dc2626; margin-top:3px; font-weight:600; }
        .input-pw-wrap { position:relative; display:flex; align-items:center; }
        .input-pw-wrap .form-control { padding-right:2.8rem; }
        .pw-toggle { position:absolute; right:0.85rem; background:none; border:none; cursor:pointer;
            color:var(--faint); font-size:1rem; padding:0; line-height:1; transition:color 0.2s; }
        .pw-toggle:hover { color:var(--primary); }

        /* ── PAGINATION ── */
        .pagination { display:flex; gap:0.5rem; align-items:center; }
        .pagination a, .pagination span {
            padding:0.45rem 0.85rem; border-radius:10px; font-size:0.85rem; font-weight:700;
            text-decoration:none; border:1.5px solid var(--border); color:var(--muted);
            transition:all 0.25s;
        }
        .pagination a:hover { border-color:var(--primary); color:var(--primary); transform:translateY(-1px); }
        .pagination .active span { background:linear-gradient(135deg,var(--primary),var(--primary2)); color:#fff; border-color:var(--primary); }

        /* ── EMPTY STATE ── */
        .empty-state { text-align:center; padding:4rem 2rem; color:var(--faint); }
        .empty-state .empty-icon { font-size:2.8rem; margin-bottom:1.25rem; color:var(--faint); }
        .empty-state p { font-size:0.95rem; }

        /* ── TRANSITIONS ── */
        .sidebar-nav a, .btn, .btn-sm, .card, .view-site-btn, .btn-logout {
            will-change:transform;
        }

        /* ── SIDEBAR OVERLAY ── */
        .sidebar-overlay {
            display:none; position:fixed; inset:0; z-index:99;
            background:rgba(0,0,0,0.55); backdrop-filter:blur(2px);
        }
        .sidebar-overlay.open { display:block; }

        /* ── MOBILE TOGGLE ── */
        .sidebar-toggle {
            display:none; align-items:center; justify-content:center;
            width:40px; height:40px; border-radius:10px; border:1.5px solid var(--border);
            background:var(--surface); cursor:pointer; flex-shrink:0;
            transition:all 0.25s; margin-right:0.75rem;
        }
        .sidebar-toggle:hover { border-color:var(--primary); background:rgba(45,106,79,0.06); }
        .sidebar-toggle span { display:block; width:18px; height:2px; background:var(--text); border-radius:2px; transition:all 0.3s; }
        .sidebar-toggle-inner { display:flex; flex-direction:column; gap:4px; }

        @media (max-width:900px) {
            .sidebar { transform:translateX(-100%); transition:transform 0.3s cubic-bezier(.4,0,.2,1); }
            .sidebar.open { transform:translateX(0); }
            .main { margin-left:0; }
            .form-grid { grid-template-columns:1fr; }
            .content { padding:1.25rem; }
            .topbar { padding:0.85rem 1.25rem; }
            .sidebar-toggle { display:flex; }
            table { font-size:0.85rem; }
            thead th, tbody td { padding:0.75rem 0.85rem; }
        }
        @media (max-width:600px) {
            .content { padding:1rem; }
            .topbar { padding:0.75rem 1rem; }
            .topbar-title { font-size:1.05rem; }
            .card-header { padding:1rem 1.25rem; flex-wrap:wrap; gap:0.6rem; }
            .card-body { padding:1.25rem; }
            .td-actions { gap:0.4rem; }
            .btn-sm { padding:0.35rem 0.7rem; font-size:0.78rem; }
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- SIDEBAR OVERLAY (mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <div class="brand-logo">ANUGRAH TEJO MALIKI</div>
            <div class="brand-sub">Admin Panel</div>
        </div>
        <nav class="sidebar-nav">
            <div class="nav-section">Menu</div>
            <a href="{{ route('admin.dashboard') }}"
               class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-gauge"></i></span> Dashboard
            </a>
            <a href="{{ route('admin.profil.edit') }}"
               class="{{ request()->routeIs('admin.profil.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-user"></i></span> Tentang Saya
            </a>
            <a href="{{ route('admin.pengalaman.index') }}"
               class="{{ request()->routeIs('admin.pengalaman.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-building"></i></span> Pengalaman
            </a>
            <a href="{{ route('admin.sosmed.index') }}"
               class="{{ request()->routeIs('admin.sosmed.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-share-nodes"></i></span> Sosial Media
            </a>
            <a href="{{ route('admin.prestasi.index') }}"
               class="{{ request()->routeIs('admin.prestasi.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-trophy"></i></span> Prestasi
            </a>
            <a href="{{ route('admin.jurnal.index') }}"
               class="{{ request()->routeIs('admin.jurnal.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-file-lines"></i></span> Jurnal
            </a>
            <a href="{{ route('admin.hki.index') }}"
               class="{{ request()->routeIs('admin.hki.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-certificate"></i></span> HKI
            </a>
            <a href="{{ route('admin.projek.index') }}"
               class="{{ request()->routeIs('admin.projek.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-laptop-code"></i></span> Projek
            </a>
            <div class="nav-section" style="margin-top:1rem">Lainnya</div>
            <a href="{{ route('admin.users.index') }}"
               class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-users"></i></span> Manajemen User
            </a>
            <a href="{{ url('/') }}" target="_blank" rel="noopener noreferrer">
                <span class="nav-icon"><i class="fa-solid fa-arrow-up-right-from-square"></i></span> Lihat Portfolio
            </a>
        </nav>
        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar"><i class="fa-solid fa-user" style="color:#fff;font-size:0.95rem;"></i></div>
                <div>
                    <div class="user-name">{{ auth()->user()->name }}</div>
                    <div class="user-role">Administrator</div>
                </div>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="btn-logout"><i class="fa-solid fa-right-from-bracket"></i> Keluar</button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <div class="main">
        <div class="topbar">
            <div style="display:flex;align-items:center;flex:1;min-width:0;">
                <button class="sidebar-toggle" id="sidebarToggle" onclick="toggleSidebar()" aria-label="Toggle menu">
                    <div class="sidebar-toggle-inner">
                        <span></span><span></span><span></span>
                    </div>
                </button>
                <div style="min-width:0;">
                    <div class="topbar-title">@yield('title', 'Dashboard')</div>
                    <div class="topbar-breadcrumb">Admin Panel &rsaquo; @yield('title', 'Dashboard')</div>
                </div>
            </div>
            <div class="topbar-right">
                <a href="{{ url('/') }}" target="_blank" rel="noopener noreferrer" class="view-site-btn"><i class="fa-solid fa-arrow-up-right-from-square"></i> Lihat Site</a>
            </div>
        </div>

        <div class="content">
            @if(session('success'))
                <div class="alert alert-success"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-error"><i class="fa-solid fa-circle-xmark"></i> {{ session('error') }}</div>
            @endif

            @yield('content')
        </div>
    </div>

    @stack('scripts')
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebarOverlay').classList.toggle('open');
        }
        function closeSidebar() {
            document.getElementById('sidebar').classList.remove('open');
            document.getElementById('sidebarOverlay').classList.remove('open');
        }
        // Close sidebar when a nav link is clicked on mobile
        document.querySelectorAll('.sidebar-nav a').forEach(function(a) {
            a.addEventListener('click', function() {
                if (window.innerWidth <= 900) closeSidebar();
            });
        });
    </script>
</body>
</html>
