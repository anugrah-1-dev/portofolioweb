<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $profil?->nama ?? 'ALIFIA SHOFA\' NABILAH' }} - My Portfolio</title>
    <meta name="description" content="Portfolio of {{ $profil?->nama ?? 'ALIFIA SHOFA\' NABILAH' }} - Information Technology student focused on web and application development. Explore my projects, experiences, and achievements.">
    <meta name="keywords" content="{{ $profil?->nama ?? 'ALIFIA SHOFA\' NABILAH' }}, portfolio, web developer, laravel, programmer, information technology">
    <meta name="author" content="{{ $profil?->nama ?? 'ALIFIA SHOFA\' NABILAH' }}">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://anugerahtedjom.my.id/">
    <meta name="google-site-verification" content="YkMylM-AikW2Z7-lam_Mi7fOEBaGptnr2O3xcRaaSHY">
    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://anugerahtedjom.my.id/">
    <meta property="og:title" content="{{ $profil?->nama ?? 'ALIFIA SHOFA\' NABILAH' }} - My Portfolio">
    <meta property="og:description" content="Portfolio of {{ $profil?->nama ?? 'ALIFIA SHOFA\' NABILAH' }} - Information Technology student focused on web and application development.">
    @if($profil?->foto)<meta property="og:image" content="{{ Storage::url($profil->foto) }}">@endif
    <link rel="icon" type="image/png" href="/logo.png?v=1">
    <link rel="shortcut icon" type="image/png" href="/logo.png?v=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">
    <style>
        :root {
            --bg:        #07060b;
            --bg2:       #11101a;
            --surface:   #171422;
            --border:    #4b3a58;
            --primary:   #ff6fac;
            --primary2:  #ff8fc0;
            --accent:    #ffb5d7;
            --accentlt:  #ffd5e8;
            --text:      #f9f3ff;
            --muted:     #d8bfd3;
            --faint:     #b899b3;

            /* Corak / Batik accent */
            --batik1: #ff9ec8;
            --batik2: #f07fb5;
            --batik3: #ffc2de;
        }
        * { margin:0; padding:0; box-sizing:border-box; }
        html { scroll-behavior:smooth; }
        body { font-family:'Plus Jakarta Sans',sans-serif; background:var(--bg); color:var(--text); overflow-x:hidden; font-size:17px; }


        /* ─── NAVBAR ─── */
        nav {
            position:fixed; top:0; left:0; right:0; z-index:1000;
            background:rgba(10,8,16,0.92); backdrop-filter:blur(20px);
            border-bottom:1px solid rgba(255,143,192,0.2);
            transition:all 0.3s;
        }
        .nav-corak {
            height:3px; width:100%;
            background:var(--primary);
        }
        .nav-inner {
            width:100%; padding:0.9rem 2rem;
            display:flex; justify-content:space-between; align-items:center;
        }
        .logo { flex-shrink:0; display:flex; align-items:center; }
        nav.scrolled .nav-inner { padding:0.65rem 2rem; }
        nav.scrolled { box-shadow:0 4px 24px rgba(255,143,192,0.2); }
        .logo img { height:44px; width:auto; display:block; }
        .nav-links { display:flex; gap:0.35rem; list-style:none; }
        .nav-links a {
            color:var(--muted); text-decoration:none; font-weight:600;
            font-size:0.97rem; padding:0.45rem 1.05rem; border-radius:50px;
            transition:all 0.25s; letter-spacing:0.1px;
        }
        .nav-links a:hover,
        .nav-links a.active { color:var(--primary); background:rgba(255,143,192,0.18); }
        .hamburger { display:none; flex-direction:column; gap:5px; cursor:pointer; padding:5px; }
        .hamburger span { width:24px; height:2px; background:var(--primary); transition:all 0.3s; border-radius:2px; display:block; }

        /* ─── LAYOUT ─── */
        section { min-height:100vh; padding:6rem 2rem; display:flex; align-items:center; justify-content:center; position:relative; overflow:hidden; }
        .container { max-width:1100px; width:100%; margin:0 auto; }
        .section-header { text-align:center; margin-bottom:4rem; position:relative; }
        .section-label { font-size:0.75rem; font-weight:700; color:var(--batik1); text-transform:uppercase; letter-spacing:5px; margin-bottom:1rem; display:block; }
        .section-label::before, .section-label::after { content:'◆'; display:inline-block; margin:0 0.6rem; font-size:0.5rem; vertical-align:middle; opacity:0.80; }
        .section-title { font-size:clamp(2rem,4vw,2.8rem); font-weight:800; color:var(--text); line-height:1.2; }
        .section-title span { background:linear-gradient(135deg,var(--primary),var(--accent)); -webkit-background-clip:text; -webkit-text-fill-color:transparent; }

        /* Divider — gold emas line */
        .section-divider {
            width:80px; height:4px; margin:1.5rem auto 0; border-radius:4px;
            background: linear-gradient(90deg, #ff6fac, #ffd5e8, #ff6fac);
            position:relative;
        }
        .section-divider::before, .section-divider::after {
            content:''; position:absolute; top:50%; transform:translateY(-50%);
            width:7px; height:7px; background:#ffd5e8;
            clip-path:polygon(50% 0%,100% 50%,50% 100%,0% 50%);
        }
        .section-divider::before { right:calc(100% + 8px); }
        .section-divider::after  { left:calc(100% + 8px); }
        /* Section wave separators */
        .sec-wave-end { position:absolute; bottom:0; left:0; width:100%; z-index:2; line-height:0; pointer-events:none; }
        .sec-wave-end svg { display:block; width:100%; height:auto; }

        /* Keep natural section seam; wave fill is matched to next section color */
        #tentang,#pengalaman,#prestasi,#jurnal,#hki,#projek { margin-top:0; }
        /* Ambient section glow orbs — hidden, gradients handled in bg */
        .sec-glow { display:none; }
        /* Orb pulse keyframe */
        @keyframes orbPulse { 0%,100% { opacity:var(--op,0.09); } 50% { opacity:calc(var(--op,0.09) * 1.4); } }

        /* ─── HOME ─── */
        #home {
            background:
                radial-gradient(ellipse at 10% 40%, rgba(255,111,172,0.24) 0%, transparent 55%),
                radial-gradient(ellipse at 85% 20%, rgba(255,181,215,0.18) 0%, transparent 55%),
                radial-gradient(ellipse at 50% 90%, rgba(255,143,192,0.18) 0%, transparent 50%),
                linear-gradient(160deg,#07060b 0%,#0f0b15 60%,#130d1a 100%);
        }
        /* ── Hero dark-bg text overrides ── */
        #home .greeting { color:#ffb5d7 !important; }
        #home .hero-desc { color:rgba(247,226,239,0.82) !important; }
        #home .hero-role-badge { background:rgba(255,111,172,0.12); color:#ffd5e8; border-color:rgba(255,181,215,0.28); }
        #home .hero-role-dot { background:rgba(255,255,255,0.25); }
        #home .hero-quick-stats { border-top-color:rgba(255,255,255,0.08); }
        #home .hero-qs-label { color:rgba(255,255,255,0.40); }
        #home .hero-qs-divider { background:rgba(255,255,255,0.09); }
        .home-dots {
            position:absolute; inset:0; pointer-events:none; z-index:0;
            background-image:radial-gradient(circle, rgba(255,181,215,0.14) 1.8px, transparent 1.8px);
            background-size:36px 36px;
        }
        .home-decor { position:absolute; inset:0; pointer-events:none; overflow:hidden; z-index:0; }
        .home-decor .shape { position:absolute; border-radius:50%; opacity:0.10; }
        .home-decor .shape-1 { width:350px; height:350px; background:var(--accent); top:-80px; right:-60px; animation:floatShape 12s ease-in-out infinite; }
        .home-decor .shape-2 { width:200px; height:200px; background:var(--primary); bottom:10%; left:-40px; animation:floatShape 10s ease-in-out infinite 2s; }
        .home-decor .shape-3 { width:120px; height:120px; background:var(--accentlt); top:55%; right:12%; border-radius:20px; transform:rotate(45deg); animation:floatShape 8s ease-in-out infinite 4s; }
        .home-orb { position:absolute; border-radius:50%; filter:blur(80px); opacity:0.20; pointer-events:none; z-index:0; }
        .home-orb-1 { width:400px; height:400px; background:#ff6fac; top:-100px; left:-100px; }
        .home-orb-2 { width:300px; height:300px; background:#ff8fc0; bottom:-50px; right:-80px; }
        .home-wave { position:absolute; bottom:0; left:0; width:100%; z-index:0; }
        .home-wave svg { display:block; width:100%; height:auto; }

        .hero { position:relative; z-index:1; display:grid; grid-template-columns:1.1fr 0.9fr; gap:5rem; align-items:center; }
        .hero-text .greeting { font-size:0.82rem; font-weight:700; color:var(--batik1); text-transform:uppercase; letter-spacing:5px; margin-bottom:1.25rem; display:block; }
        .hero-text h1 { font-size:clamp(2.8rem,5.5vw,4.2rem); font-weight:900; line-height:1.05; margin-bottom:1rem; letter-spacing:-2px; }
        .hero-text h1 .name { color:var(--text); }
        .hero-text h1 .highlight { background:linear-gradient(135deg,var(--primary),var(--accent)); -webkit-background-clip:text; -webkit-text-fill-color:transparent; }
        .hero-role { font-size:1.05rem; color:var(--muted); margin-bottom:0.75rem; }
        .hero-role strong { color:var(--primary); font-weight:700; }
        .hero-desc { font-size:1.1rem; color:var(--muted); line-height:1.85; margin-bottom:2.5rem; max-width:480px; }
        .btn-group { display:flex; gap:1rem; flex-wrap:wrap; margin-bottom:3rem; }
        .btn { padding:0.85rem 2rem; border-radius:50px; font-weight:700; font-size:0.93rem; text-decoration:none; transition:all 0.3s; cursor:pointer; border:none; display:inline-flex; align-items:center; gap:0.4rem; font-family:inherit; }
        .btn-primary { background:linear-gradient(135deg,var(--primary),var(--primary2)); color:#fff; box-shadow:0 6px 20px rgba(255,111,172,0.35); }
        .btn-primary:hover { transform:translateY(-3px); box-shadow:0 10px 30px rgba(255,111,172,0.5); }
        .btn-outline { background:transparent; color:var(--primary); border:2px solid rgba(255,181,215,0.5); }
        .btn-outline:hover { background:rgba(255,143,192,0.14); border-color:var(--primary); transform:translateY(-3px); }
        /* Override btn-outline on dark home bg */
        #home .btn-outline { color:rgba(255,225,238,0.92); border-color:rgba(255,181,215,0.45); background:rgba(255,255,255,0.06); }
        #home .btn-outline:hover { color:#fff; border-color:rgba(255,213,232,0.85); background:rgba(255,255,255,0.12); transform:translateY(-3px); }
        .btn-whatsapp { background:linear-gradient(135deg,#ff6fac,#ff8fc0); color:#fff; box-shadow:0 6px 20px rgba(255,111,172,0.3); }
        .btn-whatsapp:hover { transform:translateY(-3px); box-shadow:0 10px 30px rgba(255,111,172,0.45); }
        .hero-stats { display:flex; gap:2.5rem; }
        .stat-item .stat-num { font-size:2.2rem; font-weight:800; background:linear-gradient(135deg,var(--primary),var(--accent)); -webkit-background-clip:text; -webkit-text-fill-color:transparent; }
        .stat-item .stat-label { font-size:0.82rem; color:var(--faint); font-weight:600; text-transform:uppercase; letter-spacing:1px; margin-top:2px; }

        /* Avatar */
        .hero-visual { position:relative; display:flex; justify-content:center; align-items:center; }
        .avatar-bg-pattern { position:absolute; width:380px; height:380px; top:50%; left:50%; border:2px dashed rgba(255,143,192,0.22); border-radius:24px; transform:translate(-50%,-50%) rotate(8deg); }
        .avatar-bg-pattern-2 { position:absolute; width:400px; height:400px; top:50%; left:50%; border:2px dashed rgba(255,181,215,0.16); border-radius:28px; transform:translate(-50%,-50%) rotate(-5deg); }
        .avatar-wrap { position:relative; width:340px; height:340px; }
        .avatar-ring { position:absolute; inset:-6px; border-radius:22px; background:linear-gradient(135deg,#ff6fac,#ff9ec8,#ffd5e8); box-shadow:0 20px 60px rgba(255,111,172,0.35); }
        .avatar-core { position:absolute; inset:4px; border-radius:18px; background:#fff; display:flex; align-items:center; justify-content:center; font-size:6rem; overflow:hidden; }
        .avatar-core img { display:block; width:100%; height:100%; object-fit:cover; }
        .float-tag { position:absolute; background:rgba(23,20,34,0.9); backdrop-filter:blur(10px); border:1.5px solid rgba(255,143,192,0.35); border-radius:12px; padding:0.55rem 1.1rem; font-size:0.8rem; font-weight:700; color:#ffd5e8; white-space:nowrap; }
        .float-tag-1 { top:10px; right:-40px; animation:floatAnim 3s ease-in-out infinite; }
        .float-tag-2 { bottom:30px; left:-50px; animation:floatAnim 3s ease-in-out infinite 1.5s; }
        .float-tag-3 { top:45%; right:-60px; animation:floatAnim 3s ease-in-out infinite 0.8s; }



        /* ─── TENTANG ─── */
        #tentang { background:#0b0a10; }
        .tentang-orb { display:none; }
        .tentang-orb-1, .tentang-orb-2 { display:none; }
        #tentang .container { position:relative; z-index:1; }
        .about-grid { display:grid; grid-template-columns:1fr 1.1fr; gap:5rem; align-items:start; }
        .about-info { position:relative; padding-left:1.5rem; }
        .about-info::before { content:''; position:absolute; left:0; top:0; width:5px; height:100%;
            background:linear-gradient(180deg,#ffd5e8 0%,#ff8fc0 50%,#ff6fac 100%);
            border-radius:3px; box-shadow:0 0 12px rgba(255,143,192,0.4); }
        .about-info p { color:#e9d3e5; line-height:1.9; margin-bottom:1.5rem; font-size:1.1rem; text-align:justify; font-weight:450; }
        .about-info .accent { color:var(--primary); font-weight:700; }
        .about-cards { display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-top:2rem; align-items:start; }
        .about-card { background:#171422; border:2px solid rgba(255,143,192,0.22); border-radius:14px; padding:1.25rem; transition:all 0.3s; position:relative; overflow:hidden; box-shadow:0 3px 14px rgba(255,111,172,0.12); }
        .about-card::after { content:''; position:absolute; top:0; left:0; right:0; height:3px;
            background:linear-gradient(90deg,#ffb5d7,#ff6fac,#ffd5e8);
            opacity:0; transition:opacity 0.3s; }
        .about-card:hover::after { opacity:1; }
        .about-card:hover { border-color:var(--primary); box-shadow:0 8px 28px rgba(255,111,172,0.2); transform:translateY(-3px); }
        .about-card .card-label { font-size:0.78rem; color:#ffb5d7; text-transform:uppercase; letter-spacing:2px; margin-bottom:0.35rem; font-weight:800; }
        .about-card .card-value { font-size:1.05rem; font-weight:700; color:#f9f3ff; word-break:break-all; overflow-wrap:anywhere; }

        /* Skills */
        .skills-wrap { position:relative; }
        .skills-wrap h3 { font-size:0.95rem; font-weight:800; color:var(--text); margin-bottom:1.75rem; text-transform:uppercase; letter-spacing:2px; display:flex; align-items:center; gap:0.6rem; }
        .skills-wrap h3::after { content:''; flex:1; height:2px;
            background:linear-gradient(90deg,var(--primary),var(--accent),transparent);
        }
        .tech-tags { display:grid; grid-template-columns:repeat(auto-fill,minmax(130px,1fr)); gap:0.75rem; }
        .tech-tag { padding:0.85rem 1rem; border-radius:12px; font-size:0.97rem; font-weight:700; text-align:center; border:1.5px solid transparent; transition:transform 0.22s,box-shadow 0.22s; cursor:default; position:relative; overflow:hidden; }
        .tech-tag::before { content:''; position:absolute; inset:0; opacity:0; background:linear-gradient(135deg,transparent 40%, rgba(255,255,255,0.4)); transition:opacity 0.3s; }
        .tech-tag:hover { transform:translateY(-4px) scale(1.04); box-shadow:0 10px 24px rgba(0,0,0,0.10); }
        .tech-tag:hover::before { opacity:1; }
        .tech-tag:nth-child(6n+1) { background:rgba(255,111,172,0.16);  color:#ffd5e8; border-color:rgba(255,143,192,0.38); }
        .tech-tag:nth-child(6n+2) { background:rgba(255,181,215,0.16); color:#ffdff0; border-color:rgba(255,181,215,0.38); }
        .tech-tag:nth-child(6n+3) { background:rgba(59,130,246,0.12); color:#1d4ed8; border-color:rgba(59,130,246,0.30); }
        .tech-tag:nth-child(6n+4) { background:rgba(181,136,62,0.14); color:#8a5c1e; border-color:rgba(181,136,62,0.35); }
        .tech-tag:nth-child(6n+5) { background:rgba(245,158,11,0.12); color:#b45309; border-color:rgba(245,158,11,0.30); }
        .tech-tag:nth-child(6n+6) { background:rgba(239,68,68,0.12);  color:#dc2626; border-color:rgba(239,68,68,0.30); }

        /* Stats & CV */
        .about-stats { display:grid; grid-template-columns:repeat(4,1fr); gap:0.75rem; margin-top:2rem; }
        .stat-item { background:#171422; border:2px solid rgba(255,143,192,0.2); border-radius:14px; padding:1rem 0.75rem; text-align:center; transition:all 0.3s; box-shadow:0 3px 12px rgba(255,111,172,0.12); }
        .stat-item:hover { border-color:var(--primary); box-shadow:0 8px 24px rgba(255,111,172,0.2); transform:translateY(-3px); }
        .stat-number { font-size:1.65rem; font-weight:900; background:linear-gradient(135deg,#ff6fac,#ffd5e8); -webkit-background-clip:text; -webkit-text-fill-color:transparent; line-height:1; }
        .stat-label { font-size:0.75rem; font-weight:700; color:#cfafc8; text-transform:uppercase; letter-spacing:1.5px; margin-top:0.3rem; }
        .btn-cv { display:inline-flex; align-items:center; gap:0.6rem; margin-top:1.25rem; padding:0.8rem 1.75rem;
            background:var(--primary); color:#fff; border-radius:50px; font-weight:700; font-size:0.97rem;
            text-decoration:none; transition:all 0.3s; box-shadow:0 4px 16px rgba(255,111,172,0.28); }
        .btn-cv:hover { background:var(--primary2); transform:translateY(-2px); box-shadow:0 8px 24px rgba(255,111,172,0.4); }

        /* ─── SOSMED ─── */
        .sosmed-wrap { display:flex; gap:0.85rem; margin-top:1.75rem; flex-wrap:wrap; }
        .sosmed-link { width:46px; height:46px; border-radius:14px; display:flex; align-items:center; justify-content:center; font-size:1.25rem; text-decoration:none; transition:all 0.3s; color:#fff; }
        .sosmed-link:hover { transform:translateY(-4px) scale(1.08); box-shadow:0 8px 20px rgba(0,0,0,0.18); }
        .sosmed-instagram { background:linear-gradient(135deg,#f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%); }
        .sosmed-tiktok    { background:#010101; }
        .sosmed-facebook  { background:#1877f2; }
        .sosmed-twitter, .sosmed-x-twitter { background:#000; }
        .sosmed-youtube   { background:#ff0000; }
        .sosmed-linkedin  { background:#0a66c2; }
        .sosmed-github    { background:#24292e; }
        .sosmed-whatsapp  { background:linear-gradient(135deg,#ff6fac,#ff8fc0); }

        /* ─── PENGALAMAN ─── */
        #pengalaman { background:#100d16; }
        .peng-timeline { position:relative; padding-left:2.5rem; }
        .peng-timeline::before {
            content:''; position:absolute; left:0.75rem; top:0; bottom:0; width:4px;
            background:var(--primary);
            border-radius:2px;
        }
        .peng-item { position:relative; margin-bottom:2rem; }
        .peng-item:last-child { margin-bottom:0; }
        .peng-dot {
            position:absolute; left:-2.1875rem; top:50%; transform:translateY(-50%);
            width:18px; height:18px; border-radius:50%;
            background:linear-gradient(135deg,var(--primary),var(--accent));
            border:3px solid var(--bg); box-shadow:0 0 0 2px var(--primary2);
            z-index:1;
        }
        .peng-card { background:var(--surface); border:1.5px solid var(--border); border-radius:18px; padding:1.5rem 1.75rem; transition:all 0.35s; position:relative; overflow:hidden; }
        .peng-card::before { content:''; position:absolute; top:0; left:0; right:0; height:4px;
            background:var(--primary);
            opacity:0; transition:opacity 0.35s; }
        .peng-card:hover::before { opacity:1; }
        .peng-card:hover { border-color:var(--primary2); box-shadow:0 16px 48px rgba(255,111,172,0.24); transform:translateX(6px); }
        .peng-head { display:flex; justify-content:space-between; align-items:flex-start; gap:1rem; margin-bottom:0.5rem; flex-wrap:wrap; }
        .peng-org { font-size:1.2rem; font-weight:800; color:var(--text); line-height:1.3; }
        .peng-meta { display:flex; align-items:center; gap:0.6rem; flex-wrap:wrap; }
        .peng-periode { font-size:0.78rem; font-weight:700; color:var(--accent); text-transform:uppercase; letter-spacing:2px; white-space:nowrap; }
        .peng-jenis { padding:0.25rem 0.8rem; border-radius:20px; font-size:0.72rem; font-weight:700;
            background:rgba(181,136,62,0.12); color:var(--batik2); border:1.5px solid rgba(181,136,62,0.28);
            text-transform:uppercase; letter-spacing:1px; white-space:nowrap; }
        .peng-jenis-organisasi  { background:rgba(255,111,172,0.2);  color:#ffd5e8; border-color:rgba(255,143,192,0.38); }
        .peng-jenis-kepanitiaan { background:rgba(255,181,215,0.18); color:#ffd5e8; border-color:rgba(255,181,215,0.38); }
        .peng-jenis-komunitas   { background:rgba(59,130,246,0.12); color:#1d4ed8; border-color:rgba(59,130,246,0.28); }
        .peng-jenis-magang      { background:rgba(168,85,247,0.12); color:#7c3aed; border-color:rgba(168,85,247,0.28); }
        .peng-jenis-volunteer   { background:rgba(181,136,62,0.12); color:var(--batik2); border-color:rgba(181,136,62,0.28); }
        .peng-jenis-lainnya     { background:rgba(107,114,128,0.12); color:#4b5563; border-color:rgba(107,114,128,0.28); }
        .peng-peran { font-size:0.97rem; font-weight:700; color:var(--primary2); margin-bottom:0.5rem; display:flex; align-items:center; gap:0.4rem; }
        .peng-peran::before { content:''; display:inline-block; width:8px; height:8px; border-radius:50%; background:var(--batik1); }
        .peng-desc { font-size:1rem; color:var(--muted); line-height:1.75; }

        /* ─── PRESTASI ─── */
        #prestasi { background:#140f1c; }
        .prestasi-tabs { display:flex; gap:0.75rem; margin-bottom:2.5rem; flex-wrap:wrap; }
        .ptab-btn { padding:0.55rem 1.4rem; border-radius:30px; border:2px solid var(--border); background:var(--surface);
            color:var(--muted); font-size:0.88rem; font-weight:700; cursor:pointer; transition:all 0.3s; }
        .ptab-btn.active { background:linear-gradient(135deg,var(--primary),var(--primary2)); border-color:transparent; color:#fff; box-shadow:0 4px 16px rgba(255,111,172,0.35); }
        .ptab-btn:hover:not(.active) { border-color:var(--primary2); color:var(--primary); }
        .ptab-panel { display:none; }
        .ptab-panel.active { display:block; }
        .prestasi-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(310px,1fr)); gap:1.5rem; align-items:start; }
        .p-card { background:var(--surface); border:1.5px solid var(--border); border-radius:20px; padding:0; transition:all 0.35s; position:relative; overflow:hidden; display:flex; flex-direction:column; }
        .p-card::before { content:''; position:absolute; top:0; left:0; right:0; height:4px;
            background:linear-gradient(90deg,var(--primary),var(--accent));
            opacity:0; transition:opacity 0.35s; z-index:1; }
        .p-card:hover { transform:translateY(-6px); border-color:var(--primary2); box-shadow:0 20px 50px rgba(255,111,172,0.22); }
        .p-card:hover::before { opacity:1; }
        .p-icon { font-size:2.5rem; margin-bottom:1.25rem; }
        .p-foto { width:100%; height:190px; object-fit:cover; border-radius:0; display:block; flex-shrink:0; }
        .p-card-body { padding:1.5rem 1.75rem; display:flex; flex-direction:column; flex:1; }
        .p-header { display:flex; justify-content:space-between; align-items:center; gap:0.75rem; margin-bottom:0.5rem; flex-wrap:wrap; }
        .p-year { font-size:0.7rem; font-weight:700; color:var(--batik1); text-transform:uppercase; letter-spacing:3px; }
        .p-title { font-size:1.1rem; font-weight:800; color:var(--text); margin-bottom:0.6rem; line-height:1.45; }
        .p-desc { font-size:0.93rem; color:var(--muted); line-height:1.72; flex:1;
            display:-webkit-box; -webkit-line-clamp:3; -webkit-box-orient:vertical; overflow:hidden; }
        .p-footer { margin-top:1.1rem; padding-top:0.85rem; border-top:1px solid var(--border); display:flex; align-items:center; justify-content:space-between; gap:0.5rem; flex-wrap:wrap; }
        .p-badge { display:inline-flex; align-items:center; gap:0.3rem; padding:0.28rem 0.85rem; border-radius:20px; font-size:0.7rem; font-weight:700;
            background:rgba(255,143,192,0.18); color:#ffd5e8; border:1.5px solid rgba(255,181,215,0.35); text-transform:uppercase; letter-spacing:1px; }
        .p-more { font-size:0.78rem; color:var(--accent); font-weight:600; display:flex; align-items:center; gap:0.25rem; }

        /* ─── JURNAL ─── */
        #jurnal { background:#181224; }
        .jurnal-list { display:flex; flex-direction:column; gap:1.25rem; }
        .j-card { background:var(--surface); border:1.5px solid var(--border); border-radius:16px; padding:1.5rem 1.75rem;
            display:grid; grid-template-columns:1fr auto; gap:1.25rem; align-items:start;
            transition:all 0.35s; position:relative; overflow:hidden; }
        .j-card::after { content:''; position:absolute; left:0; top:0; bottom:0; width:4px;
            background:var(--primary);
            opacity:0; transition:opacity 0.35s; }
        .j-card:hover { border-color:var(--primary2); box-shadow:0 12px 40px rgba(255,111,172,0.2); transform:translateX(4px); }
        .j-card:hover::after { opacity:1; }
        .j-title { font-size:1.18rem; font-weight:700; color:var(--text); margin-bottom:0.35rem; line-height:1.45; }
        .j-meta { font-size:0.95rem; color:var(--muted); margin-bottom:0.6rem; }
        .j-meta span { color:var(--accent); font-weight:600; }
        .j-desc { font-size:0.98rem; color:var(--faint); line-height:1.7; }
        .j-index-badge { padding:0.3rem 0.85rem; border-radius:20px; font-size:0.72rem; font-weight:700;
            background:rgba(255,143,192,0.18); color:#ffd5e8; border:1.5px solid rgba(255,181,215,0.35);
            text-transform:uppercase; letter-spacing:1px; white-space:nowrap; }
        .j-link-btn { display:inline-flex; align-items:center; gap:0.4rem; margin-top:0.75rem;
            padding:0.4rem 1rem; border-radius:20px; font-size:0.78rem; font-weight:700;
            background:linear-gradient(135deg,var(--primary),var(--primary2)); color:#fff; text-decoration:none; transition:all 0.3s; }
        .j-link-btn:hover { background:linear-gradient(135deg,var(--accent),var(--primary)); transform:translateY(-1px); box-shadow:0 4px 14px rgba(255,111,172,0.35); }
        .j-right { display:flex; flex-direction:column; align-items:flex-end; gap:0.6rem; }
        .j-year { font-size:0.72rem; font-weight:700; color:var(--batik1); text-transform:uppercase; letter-spacing:3px; }

        /* ─── HKI ─── */
        #hki { background:#1d152b; }
        .hki-list { display:flex; flex-direction:column; gap:1.25rem; }
        .hki-card { background:var(--surface); border:1.5px solid var(--border); border-radius:16px; padding:1.5rem 1.75rem;
            display:grid; grid-template-columns:1fr auto; gap:1.25rem; align-items:start;
            transition:all 0.35s; position:relative; overflow:hidden; cursor:pointer; }
        .hki-card::after { content:''; position:absolute; left:0; top:0; bottom:0; width:4px;
            background:linear-gradient(180deg,var(--accent),var(--primary));
            opacity:0; transition:opacity 0.35s; }
        .hki-card:hover { border-color:var(--accent); box-shadow:0 12px 40px rgba(255,143,192,0.2); transform:translateX(4px); }
        .hki-card:hover::after { opacity:1; }
        .hki-title { font-size:1.1rem; font-weight:700; color:var(--text); margin-bottom:0.3rem; line-height:1.45; }
        .hki-meta { font-size:0.93rem; color:var(--muted); margin-bottom:0.5rem; }
        .hki-nomor { font-size:0.8rem; color:var(--faint); font-family:monospace; }
        .hki-desc { font-size:0.95rem; color:var(--faint); line-height:1.7; margin-top:0.5rem; }
        .hki-jenis-badge { padding:0.3rem 0.85rem; border-radius:20px; font-size:0.72rem; font-weight:700;
            background:rgba(255,143,192,0.18); color:#ffd5e8; border:1.5px solid rgba(255,181,215,0.35);
            text-transform:uppercase; letter-spacing:1px; white-space:nowrap;
            display:inline-flex; align-items:center; gap:0.35rem; }
        .hki-link-btn { display:inline-flex; align-items:center; gap:0.4rem; margin-top:0.75rem;
            padding:0.4rem 1rem; border-radius:20px; font-size:0.78rem; font-weight:700;
            background:linear-gradient(135deg,var(--accent),var(--primary)); color:#fff; text-decoration:none; transition:all 0.3s; }
        .hki-link-btn:hover { transform:translateY(-1px); box-shadow:0 4px 14px rgba(255,143,192,0.35); }
        .hki-right { display:flex; flex-direction:column; align-items:flex-end; gap:0.6rem; }
        .hki-year { font-size:0.72rem; font-weight:700; color:var(--batik1); text-transform:uppercase; letter-spacing:3px; }

        /* ─── PROJEK ─── */
        #projek { background:#221833; }
        .proj-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(340px,1fr)); gap:2rem; }
        .proj-card { background:var(--surface); border:1.5px solid var(--border); border-radius:20px; overflow:hidden; transition:all 0.4s; cursor:pointer; position:relative; }
        .proj-card:hover { transform:translateY(-8px); border-color:var(--primary2); box-shadow:0 28px 60px rgba(255,111,172,0.3); }
        /* Thumb */
        .proj-thumb { height:205px; display:flex; align-items:center; justify-content:center; position:relative; overflow:hidden; }
        .proj-thumb img { width:100%; height:100%; object-fit:cover; display:block; transition:transform 0.55s ease; }
        .proj-card:hover .proj-thumb img { transform:scale(1.07); }
        /* Slider */
        .proj-slider { position:relative; width:100%; height:100%; }
        .proj-slide { position:absolute; inset:0; opacity:0; transition:opacity 0.5s ease; z-index:0; }
        .proj-slide.active { opacity:1; z-index:1; }
        .proj-slide img { width:100%; height:100%; object-fit:cover; display:block; transition:transform 0.55s ease; }
        .proj-card:hover .proj-slide.active img { transform:scale(1.07); }
        .proj-slide-btn { position:absolute; top:50%; transform:translateY(-50%); z-index:8; background:rgba(0,0,0,0.48); border:none; color:#fff; width:28px; height:28px; border-radius:50%; cursor:pointer; display:flex; align-items:center; justify-content:center; font-size:0.65rem; opacity:0; transition:opacity 0.25s; padding:0; line-height:1; }
        .proj-thumb:hover .proj-slide-btn { opacity:1; }
        .proj-slide-prev { left:8px; }
        .proj-slide-next { right:8px; }
        .proj-slide-dots { position:absolute; bottom:32px; left:50%; transform:translateX(-50%); display:flex; gap:5px; z-index:8; pointer-events:none; }
        .proj-slide-dot { width:6px; height:6px; border-radius:50%; background:rgba(255,255,255,0.45); transition:all 0.3s; }
        .proj-slide-dot.active { background:#fff; width:16px; border-radius:3px; }
        /* Detail modal slider */
        .detail-slider { position:relative; width:100%; border-radius:14px; overflow:hidden; margin-bottom:1.1rem; background:#0a0f0a; }
        .detail-slide { display:none; }
        .detail-slide.active { display:block; }
        .detail-slide img { width:100%; max-height:300px; object-fit:cover; display:block; }
        .detail-slide-prev,.detail-slide-next { position:absolute; top:50%; transform:translateY(-50%); background:rgba(0,0,0,0.55); border:none; color:#fff; width:36px; height:36px; border-radius:50%; cursor:pointer; z-index:10; display:flex; align-items:center; justify-content:center; font-size:0.85rem; padding:0; transition:background 0.2s; }
        .detail-slide-prev:hover,.detail-slide-next:hover { background:rgba(0,0,0,0.78); }
        .detail-slide-prev { left:10px; }
        .detail-slide-next { right:10px; }
        .detail-slide-dots-wrap { position:absolute; bottom:10px; left:50%; transform:translateX(-50%); display:flex; gap:6px; z-index:10; }
        .detail-dot { width:8px; height:8px; border-radius:50%; background:rgba(255,255,255,0.45); cursor:pointer; transition:all 0.3s; }
        .detail-dot.active { background:#fff; width:18px; border-radius:4px; }
        .proj-thumb-1 { background:linear-gradient(135deg,#2a0f24 0%,#3b1634 50%,#ff6fac 100%); }
        .proj-thumb-2 { background:linear-gradient(135deg,#1d1024 0%,#2e1538 50%,#ff8fc0 100%); }
        .proj-thumb-3 { background:linear-gradient(135deg,#121e2e 0%,#1a3a52 50%,#1a5276 100%); }
        /* Gradient accent bottom */
        .proj-thumb::before { content:''; position:absolute; bottom:0; left:0; right:0; height:3px; z-index:3; background:linear-gradient(90deg,var(--primary),var(--accent)); }
        /* Hover overlay */
        .proj-thumb::after { content:''; position:absolute; inset:0; background:linear-gradient(to bottom,transparent 30%,rgba(0,0,0,0.6) 100%); opacity:0; transition:opacity 0.4s; z-index:1; }
        .proj-card:hover .proj-thumb::after { opacity:1; }
        /* No-image icon */
        .proj-icon-wrap { display:flex; flex-direction:column; align-items:center; justify-content:center; width:100%; height:100%; gap:0.6rem; z-index:2; position:relative; }
        .proj-icon { font-size:3.4rem; color:rgba(255,255,255,0.2); transition:all 0.4s; filter:drop-shadow(0 0 20px rgba(255,181,215,0.25)); }
        .proj-card:hover .proj-icon { color:rgba(255,255,255,0.42); filter:drop-shadow(0 0 32px rgba(255,143,192,0.4)); transform:scale(1.12); }
        /* Geo pattern overlay on thumb */
        .proj-thumb-pattern { position:absolute; inset:0; z-index:0; opacity:0.06; background-image:radial-gradient(circle, rgba(255,255,255,0.8) 1px, transparent 1px); background-size:24px 24px; }
        /* Body */
        .proj-body { padding:1.35rem 1.5rem 1.25rem; }
        .proj-tags { display:flex; gap:0.4rem; flex-wrap:wrap; margin-bottom:0.75rem; }
        .tag { padding:0.2rem 0.6rem; font-size:0.72rem; font-weight:700; border-radius:20px; background:rgba(255,143,192,0.16); color:#ffd5e8; border:1px solid rgba(255,181,215,0.32); letter-spacing:0.2px; }
        .proj-title { font-size:1.15rem; font-weight:800; color:var(--text); margin-bottom:0.5rem; line-height:1.4; }
        .proj-desc { font-size:0.87rem; color:var(--muted); line-height:1.7; margin-bottom:1rem; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; }
        /* Footer row */
        .proj-footer { display:flex; align-items:center; justify-content:space-between; gap:0.5rem; border-top:1px solid var(--border); padding-top:0.9rem; flex-wrap:wrap; }
        .proj-links { display:flex; gap:0.45rem; margin-left:auto; }
        .proj-link { font-size:0.74rem; font-weight:700; text-decoration:none; transition:all 0.25s; display:inline-flex; align-items:center; gap:0.3rem; padding:0.3rem 0.8rem; border-radius:20px; white-space:nowrap; }
        .proj-link-demo { background:rgba(255,143,192,0.18); color:#ffd5e8; border:1px solid rgba(255,181,215,0.35); }
        .proj-link-demo:hover { background:var(--accent); color:#fff; transform:translateY(-1px); }
        .proj-link-git { background:rgba(255,255,255,0.06); color:rgba(255,255,255,0.65); border:1px solid rgba(255,255,255,0.12); }
        .proj-link-git:hover { background:rgba(255,255,255,0.15); color:#fff; transform:translateY(-1px); }
        /* Section icon */
        .section-icon { width:54px; height:54px; border-radius:16px; background:linear-gradient(135deg,var(--primary),var(--accent)); display:flex; align-items:center; justify-content:center; font-size:1.4rem; color:#fff; margin:0 auto 1rem; box-shadow:0 8px 28px rgba(255,111,172,0.35); }

        /* ─── FOOTER ─── */
        .footer { background:linear-gradient(160deg,#0b0911 0%,#130d1c 100%); color:rgba(255,255,255,0.7); position:relative; overflow:hidden; }
        .footer-corak { display:none; }
        .footer-wave { width:100%; line-height:0; margin-top:-2px; }
        .footer-wave svg { display:block; width:100%; height:80px; }
        .footer-content { padding:3rem 2rem 1.5rem; max-width:1100px; margin:0 auto; }
        .footer-grid { display:grid; grid-template-columns:1.5fr 1fr 1fr; gap:3rem; margin-bottom:2.5rem; }
        .footer-brand .footer-logo { font-size:1.5rem; font-weight:900; letter-spacing:-1px; background:linear-gradient(135deg,#ff8fc0,#ffd5e8); -webkit-background-clip:text; -webkit-text-fill-color:transparent; margin-bottom:0.75rem; }
        .footer-brand .footer-tagline { font-size:0.9rem; line-height:1.7; color:rgba(255,255,255,0.5); max-width:320px; }
        .footer-nav h4, .footer-social-section h4 { font-size:0.75rem; font-weight:700; text-transform:uppercase; letter-spacing:3px; color:rgba(255,255,255,0.9); margin-bottom:1.25rem; }
        .footer-nav ul { list-style:none; display:flex; flex-direction:column; gap:0.6rem; }
        .footer-nav a { color:rgba(255,255,255,0.5); text-decoration:none; font-size:0.9rem; font-weight:500; transition:all 0.3s; }
        .footer-nav a:hover { color:#ffd5e8; transform:translateX(4px); display:inline-block; }
        .footer-social-links { display:flex; gap:0.65rem; flex-wrap:wrap; }
        .footer-social-link { width:40px; height:40px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.1rem; background:rgba(255,255,255,0.08); color:rgba(255,255,255,0.6); text-decoration:none; transition:all 0.3s; border:1px solid rgba(255,255,255,0.06); }
        .footer-social-link:hover { background:rgba(255,143,192,0.2); color:#ffd5e8; transform:translateY(-3px); border-color:rgba(255,181,215,0.4); }
        .footer-bottom { border-top:1px solid rgba(255,255,255,0.08); padding-top:1.5rem; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:0.75rem; }
        .footer-bottom p { font-size:0.82rem; color:rgba(255,255,255,0.35); }
        .footer-bottom span { color:#ffd5e8; font-weight:700; }
        .footer-bottom-links a { font-size:0.82rem; color:rgba(255,255,255,0.35); text-decoration:none; transition:color 0.3s; }
        .footer-bottom-links a:hover { color:#ffd5e8; }

        /* ─── ANIMATIONS ─── */
        @keyframes floatAnim { 0%,100% { transform:translateY(0px); } 50% { transform:translateY(-10px); } }
        @keyframes floatShape { 0%,100% { transform:translateY(0px); } 50% { transform:translateY(-20px); } }
        @keyframes fadeUp { from { opacity:0; transform:translateY(35px); } to { opacity:1; transform:translateY(0); } }
        .fade-up { opacity:0; animation:fadeUp 0.9s ease forwards; }
        .d1 { animation-delay:0.1s; }
        .d2 { animation-delay:0.3s; }
        .d3 { animation-delay:0.5s; }
        .d4 { animation-delay:0.7s; }
        .d5 { animation-delay:0.9s; }
        .reveal { opacity:0; transform:translateY(40px); transition:opacity 0.7s ease,transform 0.7s ease; }
        .reveal.visible { opacity:1; transform:translateY(0); }

        /* ─── SCROLLBAR ─── */
        ::-webkit-scrollbar { width:6px; }
        ::-webkit-scrollbar-track { background:var(--bg); }
        ::-webkit-scrollbar-thumb { background:var(--primary); border-radius:6px; }

        /* ─── RESPONSIVE ─── */
        @media (max-width:1200px) {
            .avatar-wrap { width:290px; height:290px; }
            .avatar-bg-pattern { width:310px; height:310px; }
            .avatar-bg-pattern-2 { width:330px; height:330px; }
            .float-tag-1 { right:-20px; }
            .float-tag-3 { right:-20px; }
        }
        @media (max-width:1024px) {
            .hero { gap:3rem; }
            .avatar-wrap { width:260px; height:260px; }
            .avatar-bg-pattern { width:280px; height:280px; }
            .avatar-bg-pattern-2 { width:300px; height:300px; }
            .float-tag { display:none; }
            .about-grid { gap:3rem; }
            .footer-grid { grid-template-columns:1fr 1fr; gap:2rem; }
            .footer-brand { grid-column:1/-1; }
        }
        @media (max-width:900px) {
            .hero { grid-template-columns:1fr; text-align:center; gap:2.5rem; }
            .hero-visual { display:flex; justify-content:center; order:-1; }
            .avatar-wrap { width:220px; height:220px; }
            .avatar-bg-pattern { width:240px; height:240px; }
            .avatar-bg-pattern-2 { width:260px; height:260px; }
            .float-tag { display:none; }
            .hero-desc { max-width:100%; margin-left:auto; margin-right:auto; }
            .btn-group { justify-content:center; }
            .hero-stats { justify-content:center; flex-wrap:wrap; }
            .about-grid { grid-template-columns:1fr; gap:2.5rem; }
            .about-stats { grid-template-columns:repeat(2,1fr); }
            .prestasi-grid { grid-template-columns:repeat(auto-fill,minmax(260px,1fr)); }
        }
        @media (max-width:768px) {
            .nav-links { display:none; flex-direction:column; position:absolute; top:100%; left:0; right:0; background:rgba(244,240,232,0.98); padding:1.5rem 2rem; border-bottom:1.5px solid var(--border); gap:0.5rem; }
            .nav-links a { font-size:1.05rem; padding:0.75rem 1rem; }
            .nav-links.open { display:flex; }
            .hamburger { display:flex; }
            section { padding:5rem 1.25rem; min-height:auto; }
            #home { min-height:100svh; }
            .footer-grid { grid-template-columns:1fr; gap:2rem; }
            .footer-brand { grid-column:auto; }
            .footer-bottom { justify-content:center; text-align:center; flex-direction:column; }
            .peng-timeline { padding-left:2rem; }
            .peng-timeline .peng-dot { left:-1.6875rem; }
            .peng-head { flex-direction:column; align-items:flex-start; gap:0.5rem; }
            .j-card { grid-template-columns:1fr; gap:0.75rem; }
            .j-right { flex-direction:row; align-items:center; flex-wrap:wrap; gap:0.5rem; }
            .prestasi-grid { grid-template-columns:1fr; }
            .about-cards { grid-template-columns:1fr 1fr; }
        }
        @media (max-width:480px) {
            body { font-size:15px; }
            .logo { font-size:1.15rem; letter-spacing:-0.5px; }
            .nav-inner { padding:0.75rem 1rem; }
            section { padding:4.5rem 1rem; }
            #home { padding-top:5rem; min-height:100svh; }
            .hero-visual { display:none; }
            .hero-stats { gap:1.25rem; flex-wrap:wrap; justify-content:center; }
            .btn-group { flex-direction:column; align-items:center; }
            .btn { width:100%; justify-content:center; max-width:300px; }
            .about-cards { grid-template-columns:1fr; }
            .about-stats { grid-template-columns:repeat(2,1fr); }
            .prestasi-tabs { gap:0.5rem; }
            .ptab-btn { padding:0.5rem 0.9rem; font-size:0.82rem; }
            .proj-grid { grid-template-columns:1fr; }
            .prestasi-grid { grid-template-columns:1fr; }
            .footer-grid { grid-template-columns:1fr; gap:1.5rem; }
            .peng-timeline { padding-left:1.75rem; }
            .peng-timeline .peng-dot { left:-1.4375rem; }
            .peng-card { padding:1.1rem 1.25rem; }
            .tech-tags { grid-template-columns:repeat(auto-fill,minmax(110px,1fr)); }
            .section-header { margin-bottom:2.5rem; }
            .about-info::before { display:none; }
            .about-info { padding-left:0; }
        }
        @media (max-width:360px) {
            .nav-inner { padding:0.65rem 0.85rem; }
            .logo { font-size:1rem; }
            .hero-stats { gap:1rem; }
            .stat-item .stat-num { font-size:1.7rem; }
            .btn { font-size:0.85rem; padding:0.75rem 1.5rem; }
            .about-stats { grid-template-columns:repeat(2,1fr); }
        }

        /* ─── DETAIL MODAL ─── */
        .detail-overlay {
            position:fixed;inset:0;z-index:9000;
            background:rgba(15,31,21,0.72);backdrop-filter:blur(8px);
            display:flex;align-items:center;justify-content:center;padding:1.5rem;
            opacity:0;pointer-events:none;transition:opacity 0.3s;
        }
        .detail-overlay.open { opacity:1;pointer-events:all; }
        .detail-modal {
            background:var(--surface);border-radius:24px;
            max-width:640px;width:100%;max-height:88vh;overflow-y:auto;
            box-shadow:0 32px 80px rgba(0,0,0,0.28);
            transform:translateY(28px) scale(0.97);transition:transform 0.35s cubic-bezier(.4,0,.2,1);
            position:relative;
        }
        .detail-overlay.open .detail-modal { transform:translateY(0) scale(1); }
        .detail-modal::-webkit-scrollbar { width:5px; }
        .detail-modal::-webkit-scrollbar-thumb { background:var(--border);border-radius:5px; }
        .detail-close {
            position:absolute;top:1.1rem;right:1.1rem;
            width:36px;height:36px;border-radius:10px;border:none;
            background:var(--bg2);color:var(--muted);font-size:1.1rem;
            cursor:pointer;display:flex;align-items:center;justify-content:center;
            transition:all 0.25s;z-index:10;
        }
        .detail-close:hover { background:rgba(220,38,38,0.10);color:#dc2626; }
        .detail-header {
            padding:2rem 2.25rem 1.35rem;
            border-bottom:1.5px solid var(--border);
            background:linear-gradient(135deg,rgba(244,240,232,0.5),rgba(235,244,238,0.7));
        }
        .detail-type-badge {
            display:inline-flex;align-items:center;gap:0.35rem;
            padding:0.28rem 0.85rem;border-radius:20px;font-size:0.72rem;font-weight:700;
            background:rgba(255,143,192,0.18);color:#ffd5e8;
            border:1.5px solid rgba(255,181,215,0.35);
            text-transform:uppercase;letter-spacing:1px;margin-bottom:0.85rem;
        }
        .detail-title { font-size:1.25rem;font-weight:800;color:var(--text);line-height:1.38; }
        .detail-subtitle { font-size:0.95rem;color:var(--primary2);font-weight:700;margin-top:0.45rem; }
        .detail-body { padding:1.6rem 2.25rem 2rem; }
        .detail-foto {
            width:100%;max-height:360px;object-fit:contain;
            border-radius:14px;border:1.5px solid var(--border);
            margin-bottom:1.35rem;background:var(--bg);padding:8px;display:block;
        }
        .detail-row { display:flex;gap:0.6rem;align-items:baseline;margin-bottom:0.7rem;flex-wrap:wrap; }
        .detail-label { font-size:0.75rem;font-weight:800;color:var(--faint);text-transform:uppercase;letter-spacing:1.5px;min-width:88px;flex-shrink:0; }
        .detail-value { font-size:0.93rem;color:var(--text);font-weight:500;flex:1; }
        .detail-desc { font-size:0.97rem;color:var(--muted);line-height:1.85;margin-top:0.85rem;white-space:pre-line;text-align:justify; }
        .detail-tags { display:flex;gap:0.5rem;flex-wrap:wrap;margin-top:0.65rem; }
        .detail-tag { padding:0.25rem 0.8rem;border-radius:20px;font-size:0.78rem;font-weight:700;background:rgba(255,143,192,0.18);color:#ffd5e8;border:1.5px solid rgba(255,181,215,0.35); }
        .detail-links { display:flex;gap:0.75rem;flex-wrap:wrap;margin-top:1.35rem;padding-top:1.25rem;border-top:1.5px solid var(--border); }
        .detail-link-btn { padding:0.6rem 1.4rem;border-radius:12px;font-size:0.88rem;font-weight:700;text-decoration:none;transition:all 0.25s;display:inline-flex;align-items:center;gap:0.4rem; }
        .detail-link-primary { background:linear-gradient(135deg,var(--primary),var(--primary2));color:#fff;box-shadow:0 4px 14px rgba(255,111,172,0.35); }
        .detail-link-primary:hover { transform:translateY(-2px);box-shadow:0 8px 20px rgba(255,111,172,0.45); }
        .detail-link-secondary { background:var(--bg2);color:var(--muted);border:1.5px solid var(--border); }
        .detail-link-secondary:hover { border-color:var(--primary);color:var(--primary);transform:translateY(-1px); }
        .detail-img-wrap { position:relative;margin-bottom:1.35rem; }
        .detail-img-wrap .detail-foto { margin-bottom:0; }
        .detail-dl-btn { display:flex;align-items:center;justify-content:center;gap:0.45rem;
            width:100%;padding:0.5rem;margin-top:0.5rem;border-radius:10px;font-size:0.82rem;font-weight:700;
            background:var(--bg2);color:var(--primary);border:1.5px solid var(--border);
            text-decoration:none;transition:all 0.25s; }
        .detail-dl-btn:hover { background:var(--primary);color:#fff;border-color:var(--primary);transform:translateY(-1px); }
        .peng-card,.p-card,.j-card,.proj-card { cursor:pointer; }
        @media (max-width:600px) {
            .detail-header { padding:1.5rem 1.5rem 1rem; }
            .detail-body { padding:1.25rem 1.5rem 1.5rem; }
            .detail-title { font-size:1.08rem; }
        }

        /* ─── 3D EFFECTS ─── */
        /* Glare overlay for tilt cards */
        .tilt-glare {
            position:absolute; inset:0; border-radius:inherit;
            background:radial-gradient(circle at var(--mx,50%) var(--my,50%), rgba(255,255,255,0.13) 0%, transparent 62%);
            pointer-events:none; z-index:20; opacity:0; transition:opacity 0.4s;
        }
        /* Hero 3D geometric elements */
        .hero-3d-wrap {
            position:absolute; inset:0; pointer-events:none; z-index:0; overflow:hidden;
        }
        .geo-3d { position:absolute; }
        .geo-cube {
            width:50px; height:50px;
            transform-style:preserve-3d;
            animation:geoCubeRotate 22s linear infinite;
        }
        .geo-cube .face {
            position:absolute; width:100%; height:100%;
            border:1.5px solid rgba(255,143,192,0.35);
            background:rgba(255,143,192,0.08); border-radius:3px;
        }
        .geo-cube.teal .face { border-color:rgba(255,181,215,0.4); background:rgba(255,181,215,0.08); }
        .geo-cube.gold .face { border-color:rgba(181,136,62,0.35); background:rgba(181,136,62,0.04); }
        .face-f  { transform:translateZ(25px); }
        .face-b  { transform:rotateY(180deg) translateZ(25px); }
        .face-r  { transform:rotateY(90deg) translateZ(25px); }
        .face-l  { transform:rotateY(-90deg) translateZ(25px); }
        .face-t  { transform:rotateX(90deg) translateZ(25px); }
        .face-bo { transform:rotateX(-90deg) translateZ(25px); }
        .geo-ring {
            width:72px; height:72px; border-radius:50%;
            border:2px solid rgba(255,181,215,0.28);
            border-top-color:rgba(255,181,215,0.7);
            transform-style:preserve-3d;
            animation:geoRingRotate 14s linear infinite;
        }
        .geo-ring-inner {
            position:absolute; inset:14px; border-radius:50%;
            border:1.5px solid rgba(255,143,192,0.3);
            border-bottom-color:rgba(255,143,192,0.6);
            animation:geoRingRotate 9s linear infinite reverse;
        }
        .geo-dot {
            width:9px; height:9px; border-radius:50%;
            background:rgba(181,136,62,0.65);
            box-shadow:0 0 14px rgba(181,136,62,0.45);
            animation:geoDotPulse 3.5s ease-in-out infinite;
        }
        .geo-diamond {
            width:24px; height:24px;
            background:rgba(255,181,215,0.16);
            border:1.5px solid rgba(255,181,215,0.4);
            transform:rotate(45deg);
            animation:geoDiamondFloat 7s ease-in-out infinite;
        }
        .geo-line {
            width:90px; height:1.5px;
            background:linear-gradient(90deg, transparent, rgba(255,143,192,0.45), transparent);
            animation:geoLineAnim 9s ease-in-out infinite;
        }
        @keyframes geoCubeRotate {
            from { transform:rotateX(18deg) rotateY(0deg); }
            to   { transform:rotateX(18deg) rotateY(360deg); }
        }
        @keyframes geoRingRotate {
            from { transform:rotateX(68deg) rotateZ(0deg); }
            to   { transform:rotateX(68deg) rotateZ(360deg); }
        }
        @keyframes geoDotPulse {
            0%,100% { transform:scale(1); opacity:0.65; }
            50%     { transform:scale(2.2); opacity:1; }
        }
        @keyframes geoDiamondFloat {
            0%,100% { transform:rotate(45deg) translateY(0px); opacity:0.7; }
            50%     { transform:rotate(65deg) translateY(-14px); opacity:1; }
        }
        @keyframes geoLineAnim {
            0%,100% { transform:scaleX(1) translateY(0); opacity:0.5; }
            50%     { transform:scaleX(0.6) translateY(-10px); opacity:0.85; }
        }
        /* Avatar 3D perspective */
        .hero-visual { perspective:1000px; perspective-origin:center 40%; }
        .avatar-wrap  { transform-style:preserve-3d; }
        /* Card hover: let JS handle transform on desktop */
        @media (hover:hover) {
            .js-tilt-ready:hover { transform:none !important; }
        }
        @media (max-width:768px) {
            .hero-3d-wrap { display:none; }
        }

        /* ─── HERO ENHANCEMENTS ─── */
        .hero-text h1 .name { background:linear-gradient(135deg,#ffd5e8 0%,#ffb5d7 50%,#ff6fac 100%); -webkit-background-clip:text; -webkit-text-fill-color:transparent; color:transparent; }
        .hero-role { display:flex; align-items:center; gap:0.6rem; margin-bottom:1.5rem; flex-wrap:wrap; }
        .hero-role-badge { display:inline-flex; align-items:center; gap:0.4rem; padding:0.3rem 0.85rem; border-radius:20px; font-size:0.8rem; font-weight:700; background:rgba(255,143,192,0.18); color:#ffd5e8; border:1.5px solid rgba(255,181,215,0.35); }
        .hero-role-dot { width:5px; height:5px; border-radius:50%; background:var(--faint); display:inline-block; margin:0 0.1rem; }
        .hero-quick-stats { display:flex; align-items:center; gap:1.75rem; margin-top:1.75rem; flex-wrap:wrap; padding-top:1.5rem; border-top:1px solid rgba(255,255,255,0.07); }
        .hero-qs-item { display:flex; flex-direction:column; }
        .hero-qs-num { font-size:1.65rem; font-weight:900; background:linear-gradient(135deg,var(--primary),var(--accent)); -webkit-background-clip:text; -webkit-text-fill-color:transparent; line-height:1; }
        .hero-qs-label { font-size:0.68rem; font-weight:700; color:var(--faint); text-transform:uppercase; letter-spacing:1.5px; margin-top:4px; }
        .hero-qs-divider { width:1px; height:36px; background:rgba(255,255,255,0.1); align-self:center; }
        /* Orbit rings around avatar */
        .avatar-orbit { position:absolute; inset:-30px; border-radius:50%; border:1.5px dashed rgba(255,143,192,0.32); animation:geoRingRotate 24s linear infinite; pointer-events:none; z-index:0; }
        .avatar-orbit-2 { position:absolute; inset:-52px; border-radius:50%; border:1.5px dashed rgba(255,181,215,0.22); animation:geoRingRotate 38s linear infinite reverse; pointer-events:none; z-index:0; }
        .avatar-orbit-dot { position:absolute; width:9px; height:9px; border-radius:50%; background:linear-gradient(135deg,var(--primary),var(--accent)); box-shadow:0 0 14px rgba(255,143,192,0.7); z-index:1; }
        .avatar-orbit-dot-1 { top:0; left:50%; transform:translate(-50%,-50%); }
        .avatar-orbit-dot-2 { bottom:0; left:50%; transform:translate(-50%,50%); }
        .avatar-orbit-dot-3 { top:50%; right:0; transform:translate(50%,-50%); background:linear-gradient(135deg,var(--accent),rgba(181,136,62,0.9)); }
        /* Second photo – profile badge card */
        .hero-photo-badge { position:absolute; bottom:-22px; left:-75px; display:flex; align-items:center; gap:0.7rem; background:rgba(18,12,28,0.9); backdrop-filter:blur(18px); border:1.5px solid rgba(255,143,192,0.45); border-radius:18px; padding:0.7rem 1.15rem 0.7rem 0.7rem; box-shadow:0 8px 36px rgba(0,0,0,0.45); z-index:12; animation:floatAnim 4.5s ease-in-out infinite 0.5s; white-space:nowrap; }
        .hpb-img { width:48px; height:48px; border-radius:12px; flex-shrink:0; background:rgba(255,143,192,0.18); display:flex; align-items:center; justify-content:center; font-size:1.5rem; overflow:hidden; border:2px solid rgba(255,181,215,0.55); }
        .hpb-img img { width:100%; height:100%; object-fit:cover; display:block; }
        .hpb-name { font-size:0.84rem; font-weight:800; color:#ffeaf5; display:block; line-height:1.3; }
        .hpb-role { font-size:0.7rem; color:var(--accent); font-weight:600; display:block; }
        .hpb-status { display:flex; align-items:center; gap:0.3rem; margin-top:0.2rem; }
        .hpb-dot { width:7px; height:7px; border-radius:50%; background:#ff8fc0; animation:geoDotPulse 2s ease-in-out infinite; box-shadow:0 0 6px rgba(255,143,192,0.75); flex-shrink:0; }
        .hpb-status-txt { font-size:0.65rem; color:rgba(255,255,255,0.45); }
        @media (max-width:900px) {
            .hero-photo-badge { left:-10px; bottom:-65px; }
            .hero-quick-stats { gap:1rem; }
        }
        @media (max-width:480px) {
            .hero-photo-badge { display:none; }
            .hero-quick-stats { gap:0.8rem; }
        }

        /* Theme readability overrides (dark + soft pink) */
        .section-title,
        .p-title,
        .peng-org,
        .j-title,
        .hki-title,
        .proj-title,
        .detail-title,
        .detail-value { color:#f9f3ff; }
        .about-info p,
        .peng-desc,
        .p-desc,
        .j-desc,
        .hki-desc,
        .proj-desc,
        .detail-desc,
        .hero-desc,
        .footer-brand .footer-tagline { color:#e9d3e5 !important; }
        .about-card,
        .stat-item,
        .p-card,
        .j-card,
        .hki-card,
        .proj-card,
        .peng-card,
        .card,
        .detail-modal { background:#171422; border-color:#4b3a58; }
        .about-card .card-value,
        .stat-label,
        .j-meta,
        .hki-meta,
        .hero-qs-label,
        .td-sub,
        .footer-bottom p,
        .footer-bottom-links a { color:#cfafc8 !important; }
        .section-label,
        .p-year,
        .j-year,
        .hki-year,
        .greeting,
        .hero-role-badge,
        .btn-cv,
        .proj-price,
        .p-badge,
        .j-index-badge,
        .hki-jenis-badge { color:#ffd5e8 !important; border-color:rgba(255,143,192,0.35); }
        .btn-primary,
        .btn-whatsapp,
        .detail-link-primary,
        .beli-submit-btn { background:linear-gradient(135deg,#ff6fac,#ff8fc0); box-shadow:0 10px 28px rgba(255,111,172,0.35); }
        .btn-outline,
        .detail-link-secondary { color:#ffd5e8; border-color:rgba(255,181,215,0.4); }
        .footer { background:linear-gradient(160deg,#0b0911 0%,#130d1c 100%); }
    </style>
</head>
<body>

    @if(session('info'))
    <div id="flash-info" style="position:fixed;top:1rem;left:50%;transform:translateX(-50%);z-index:9999;background:var(--accent);color:#fff;padding:0.75rem 1.5rem;border-radius:8px;font-size:0.95rem;box-shadow:0 4px 20px rgba(0,0,0,0.4);">
        {{ session('info') }}
    </div>
    <script>setTimeout(()=>document.getElementById('flash-info').remove(),4000)</script>
    @endif

    @if(session('error'))
    <div id="flash-error" style="position:fixed;top:1rem;left:50%;transform:translateX(-50%);z-index:9999;background:#dc2626;color:#fff;padding:0.75rem 1.5rem;border-radius:8px;font-size:0.95rem;box-shadow:0 4px 20px rgba(0,0,0,0.4);">
        {{ session('error') }}
    </div>
    <script>setTimeout(()=>document.getElementById('flash-error').remove(),4000)</script>
    @endif

    <!-- ═══ NAVBAR ═══ -->
    <nav id="navbar">
        <div class="nav-corak"></div>
        <div class="nav-inner">
            <div class="logo"><img src="/logo.png?v=1" alt="Logo"></div>
            <ul class="nav-links" id="navLinks">
                <li><a href="#home" class="active">Home</a></li>
                <li><a href="#tentang">About</a></li>
                <li><a href="#pengalaman">Experience</a></li>
                <li><a href="#prestasi">Achievements</a></li>
                <li><a href="#jurnal">Journal</a></li>
                <li><a href="#hki">IPR</a></li>
                <li><a href="#projek">Projects</a></li>
            </ul>
            <div class="hamburger" id="hamburger" onclick="toggleMenu()">
                <span></span><span></span><span></span>
            </div>
        </div>
    </nav>

    <!-- ═══ HOME ═══ -->
    <section id="home">
        <div class="home-dots"></div>
        <div class="home-orb home-orb-1"></div>
        <div class="home-orb home-orb-2"></div>
        <div class="home-decor">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>
        <!-- 3D Geometric Decorations -->
        <div class="hero-3d-wrap" aria-hidden="true">
            <!-- Rotating cube – top right -->
            <div class="geo-3d" style="top:12%; right:7%; transform:scale(1.3);">
                <div class="geo-cube green">
                    <div class="face face-f"></div><div class="face face-b"></div>
                    <div class="face face-r"></div><div class="face face-l"></div>
                    <div class="face face-t"></div><div class="face face-bo"></div>
                </div>
            </div>
            <!-- Rotating cube – bottom left, teal, slower reverse -->
            <div class="geo-3d" style="bottom:22%; left:5%; transform:scale(0.75);">
                <div class="geo-cube teal" style="animation-duration:17s; animation-direction:reverse;">
                    <div class="face face-f"></div><div class="face face-b"></div>
                    <div class="face face-r"></div><div class="face face-l"></div>
                    <div class="face face-t"></div><div class="face face-bo"></div>
                </div>
            </div>
            <!-- Rotating cube – bottom right, gold, slow -->
            <div class="geo-3d" style="bottom:8%; right:18%; transform:scale(0.9);">
                <div class="geo-cube gold" style="animation-duration:28s;">
                    <div class="face face-f"></div><div class="face face-b"></div>
                    <div class="face face-r"></div><div class="face face-l"></div>
                    <div class="face face-t"></div><div class="face face-bo"></div>
                </div>
            </div>
            <!-- Spinning ring – left centre -->
            <div class="geo-3d" style="top:45%; left:2.5%;">
                <div class="geo-ring"><div class="geo-ring-inner"></div></div>
            </div>
            <!-- Spinning ring – top centre, smaller -->
            <div class="geo-3d" style="top:8%; left:42%; transform:scale(0.65);">
                <div class="geo-ring" style="animation-duration:10s; animation-direction:reverse;"><div class="geo-ring-inner"></div></div>
            </div>
            <!-- Pulsing dots -->
            <div class="geo-3d" style="top:28%; left:18%;"><div class="geo-dot"></div></div>
            <div class="geo-3d" style="top:70%; right:6%;"><div class="geo-dot" style="animation-delay:1.2s; background:rgba(255,143,192,0.8); box-shadow:0 0 14px rgba(255,143,192,0.55);"></div></div>
            <div class="geo-3d" style="top:55%; right:28%;"><div class="geo-dot" style="animation-delay:2.1s; width:6px; height:6px;"></div></div>
            <!-- Diamond shapes -->
            <div class="geo-3d" style="top:22%; right:22%;"><div class="geo-diamond"></div></div>
            <div class="geo-3d" style="bottom:30%; left:22%;"><div class="geo-diamond" style="animation-delay:3s; animation-direction:reverse;"></div></div>
            <!-- Floating lines -->
            <div class="geo-3d" style="top:60%; left:10%;"><div class="geo-line"></div></div>
            <div class="geo-3d" style="top:35%; right:3%;"><div class="geo-line" style="animation-delay:2s; width:55px;"></div></div>
        </div>
        <div class="home-wave">
            <svg viewBox="0 0 1440 100" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                <path d="M0,40 C360,90 720,10 1080,50 C1260,70 1380,30 1440,40 L1440,100 L0,100Z" fill="#0b0a10"/>
                <path d="M0,65 C300,95 600,45 900,65 C1100,78 1300,55 1440,62 L1440,100 L0,100Z" fill="#0b0a10"/>
            </svg>
        </div>
        <div class="container">
            <div class="hero">
                <div class="hero-text">
                    <span class="greeting fade-up d1">Hello, I'm</span>
                    <h1 class="fade-up d2">
                        <span class="name">{{ $profil?->nama ?? 'ALIFIA SHOFA\' NABILAH' }}</span>
                    </h1>
                    <div class="hero-role fade-up d2">
                        <span class="hero-role-badge"><i class="fa-solid fa-code"></i> {{ $profil?->hero_role1 ?? 'Full-Stack Developer' }}</span>
                        <span class="hero-role-dot"></span>
                        <span class="hero-role-badge"><i class="fa-solid fa-graduation-cap"></i> {{ $profil?->hero_role2 ?? 'IT Student' }}</span>
                    </div>
                    <p class="hero-desc fade-up d3" style="text-align:justify;">{{ $profil?->deskripsi_home ?? 'Information Technology student focused on application and system development. Experienced in building desktop, web, and mobile projects with various modern technologies, with a strong interest in software development and team collaboration.' }}</p>
                    <div class="btn-group fade-up d4">
                        <a href="#projek" class="btn btn-primary">&#128640; View Projects</a>
                        <a href="#tentang" class="btn btn-outline">&#128100; About Me</a>
                        @if($profil?->no_whatsapp)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $profil->no_whatsapp) }}?text={{ urlencode('Hello, I am interested in discussing further.') }}" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp"><i class="fa-brands fa-whatsapp"></i> Contact Me</a>
                        @endif
                    </div>
                    <div class="hero-quick-stats fade-up d5">
                        <div class="hero-qs-item">
                            <span class="hero-qs-num">{{ $totalProjek }}+</span>
                            <span class="hero-qs-label">Projects</span>
                        </div>
                        <div class="hero-qs-divider"></div>
                        <div class="hero-qs-item">
                            <span class="hero-qs-num">{{ $pengalaman->count() }}+</span>
                            <span class="hero-qs-label">Experiences</span>
                        </div>
                        <div class="hero-qs-divider"></div>
                        <div class="hero-qs-item">
                            <span class="hero-qs-num">{{ $totalPrestasi }}+</span>
                            <span class="hero-qs-label">Awards</span>
                        </div>
                        <div class="hero-qs-divider"></div>
                        <div class="hero-qs-item">
                            <span class="hero-qs-num">{{ $totalJurnal + $totalHki }}+</span>
                            <span class="hero-qs-label">Publications</span>
                        </div>
                    </div>
                </div>
                <div class="hero-visual fade-up d3">
                    <div class="avatar-bg-pattern"></div>
                    <div class="avatar-bg-pattern-2"></div>
                    <div class="avatar-wrap">
                        <div class="avatar-orbit">
                            <span class="avatar-orbit-dot avatar-orbit-dot-1"></span>
                            <span class="avatar-orbit-dot avatar-orbit-dot-2"></span>
                            <span class="avatar-orbit-dot avatar-orbit-dot-3"></span>
                        </div>
                        <div class="avatar-orbit-2"></div>
                        <div class="avatar-ring"></div>
                        <div class="avatar-core">
                            @if($profil?->foto)
                            <img src="{{ Storage::url($profil->foto) }}" alt="{{ $profil->nama }}" style="width:100%;height:100%;object-fit:cover;">
                            @else
                            &#128104;&#8205;&#128187;
                            @endif
                        </div>

                    </div>
                    @php $tags = $profil?->kata_penyemangat ?? []; @endphp
                    @if(isset($tags[0]))<div class="float-tag float-tag-1">⭐ {{ $tags[0] }}</div>@endif
                    @if(isset($tags[1]))<div class="float-tag float-tag-2">🔥 {{ $tags[1] }}</div>@endif
                    @if(isset($tags[2]))<div class="float-tag float-tag-3">💪 {{ $tags[2] }}</div>@endif
                    <!-- Second photo card badge -->
                    <div class="hero-photo-badge">
                        <div class="hpb-img">
                            @if($profil?->foto2)
                            <img src="{{ Storage::url($profil->foto2) }}" alt="{{ $profil->nama }}">
                            @elseif($profil?->foto)
                            <img src="{{ Storage::url($profil->foto) }}" alt="{{ $profil->nama }}">
                            @else
                            &#128104;&#8205;&#128187;
                            @endif
                        </div>
                        <div>
                            <span class="hpb-name">{{ $profil?->nama ?? 'ALIFIA SHOFA\' NABILAH' }}</span>
                            <span class="hpb-role">{{ $profil?->keahlian[0] ?? 'IT Developer' }}</span>
                            <div class="hpb-status">
                                <span class="hpb-dot"></span>
                                <span class="hpb-status-txt">{{ $profil?->hero_status ?? 'Available for work' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ═══ TENTANG ═══ -->
    <section id="tentang">
        <div class="tentang-orb tentang-orb-1"></div>
        <div class="tentang-orb tentang-orb-2"></div>
        <div class="container">
            <div class="section-header reveal">
                <span class="section-label">Who I Am</span>
                <h2 class="section-title">About <span>Me</span></h2>
                <div class="section-divider"></div>
            </div>
            <div class="about-grid">
                <div class="about-info reveal">
                    <p>{{ $profil?->bio1 ?? 'I am a passionate Web Developer dedicated to creating innovative and impactful digital solutions.' }}</p>
                    @if($profil?->bio2)
                    <p>{{ $profil->bio2 }}</p>
                    @endif
                    <div class="about-cards">
                        <div class="about-card">
                            <div class="card-label">Name</div>
                            <div class="card-value">{{ $profil?->nama ?? 'ALIFIA SHOFA\' NABILAH' }}</div>
                        </div>
                        <div class="about-card">
                            <div class="card-label">Email</div>
                            <div class="card-value">{{ $profil?->status ?? 'email@example.com' }}</div>
                        </div>
                        <div class="about-card">
                            <div class="card-label">Location</div>
                            <div class="card-value">{{ $profil?->lokasi ?? 'Indonesia' }}</div>
                        </div>
                        <div class="about-card">
                            <div class="card-label">Phone No.</div>
                            <div class="card-value">{{ $profil?->bahasa ?? '+62 812 xxxx xxxx' }}</div>
                        </div>
                    </div>
                    @if($sosmed->isNotEmpty())
                    <div class="sosmed-wrap">
                        @foreach($sosmed as $s)
                        <a href="{{ $s->url }}" target="_blank" rel="noopener"
                           class="sosmed-link sosmed-{{ $s->platform }}" title="{{ $s->label }}">
                            <i class="fa-brands fa-{{ $s->platform }}"></i>
                        </a>
                        @endforeach
                    </div>
                    @endif
                </div>
                <div class="skills-wrap reveal">
                    <h3>Technical Skills</h3>
                    <div class="tech-tags">
                        @forelse($profil?->keahlian ?? [] as $skill)
                        <span class="tech-tag">{{ $skill }}</span>
                        @empty
                        <span class="tech-tag">PHP</span>
                        <span class="tech-tag">Laravel</span>
                        <span class="tech-tag">Vue.js</span>
                        <span class="tech-tag">MySQL</span>
                        <span class="tech-tag">JavaScript</span>
                        <span class="tech-tag">Git</span>
                        @endforelse
                    </div>

                    {{-- Stats --}}
                    <div class="about-stats">
                        <div class="stat-item">
                            <div class="stat-number">{{ $totalProjek }}</div>
                            <div class="stat-label">Projects</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">{{ $pengalaman->count() }}</div>
                            <div class="stat-label">Orgs</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">{{ $totalPrestasi }}</div>
                            <div class="stat-label">Awards</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">{{ $totalJurnal + $totalHki }}</div>
                            <div class="stat-label">Publications</div>
                        </div>
                    </div>

                    @if($profil?->cv_file)
                    <a href="{{ route('cv.download') }}" class="btn-cv">
                        <i class="fa-solid fa-file-arrow-down"></i> Download CV
                    </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="sec-wave-end">
            <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                <path d="M0,38 C360,80 720,5 1080,42 C1260,58 1380,22 1440,32 L1440,80 L0,80Z" fill="#100d16"/>
                <path d="M0,55 C300,72 600,35 900,58 C1100,68 1300,45 1440,54 L1440,80 L0,80Z" fill="#100d16"/>
            </svg>
        </div>
    </section>

    <!-- ═══ PENGALAMAN ═══ -->
    <section id="pengalaman">
        <div class="sec-glow" style="--op:0.30;width:400px;height:400px;background:#a5d8c0;opacity:0.30;top:-90px;right:-60px;"></div>
        <div class="sec-glow" style="--op:0.25;width:320px;height:320px;background:#b8e2ce;opacity:0.25;bottom:8%;left:-50px;"></div>
        <div class="container" style="position:relative;z-index:1;">
            <div class="section-header reveal">
                <span class="section-label">Contribution History</span>
                <h2 class="section-title">Organization <span>Experience</span></h2>
                <div class="section-divider"></div>
            </div>
            @if($pengalaman->isNotEmpty())
            <div class="peng-timeline">
                @foreach($pengalaman as $item)
                @php
                    $jenis_class = [
                        'organisasi'  => 'peng-jenis-organisasi',
                        'kepanitiaan' => 'peng-jenis-kepanitiaan',
                        'komunitas'   => 'peng-jenis-komunitas',
                        'magang'      => 'peng-jenis-magang',
                        'volunteer'   => 'peng-jenis-volunteer',
                        'lainnya'     => 'peng-jenis-lainnya',
                    ];
                    $jenis_label = [
                        'organisasi'  => '🏛️ Organization',
                        'kepanitiaan' => '📋 Committee',
                        'komunitas'   => '👥 Community',
                        'magang'      => '💼 Internship',
                        'volunteer'   => '🤝 Volunteer',
                        'lainnya'     => '📌 Other',
                    ];
                @endphp
                <div class="peng-item reveal">
                    <div class="peng-dot"></div>
                    <div class="peng-card"
                         onclick="openDetailModal(this)"
                         data-type="pengalaman"
                         data-nama="{{ $item->nama_organisasi }}"
                         data-peran="{{ $item->peran }}"
                         data-jenis-label="{{ $jenis_label[$item->jenis] ?? $item->jenis }}"
                         data-jenis-class="{{ $jenis_class[$item->jenis] ?? '' }}"
                         data-periode="{{ $item->tahun_mulai }} – {{ $item->tahun_selesai ?? 'Present' }}"
                         data-deskripsi="{{ $item->deskripsi ?? '' }}"
                         data-sertifikat="{{ $item->foto_sertifikat ? Storage::url($item->foto_sertifikat) : '' }}">
                        <div class="peng-head">
                            <div class="peng-org">{{ $item->nama_organisasi }}</div>
                            <div class="peng-meta">
                                <span class="peng-periode">{{ $item->tahun_mulai }} – {{ $item->tahun_selesai ?? 'Present' }}</span>
                                <span class="peng-jenis {{ $jenis_class[$item->jenis] ?? '' }}">{{ $jenis_label[$item->jenis] ?? $item->jenis }}</span>
                            </div>
                        </div>
                        <div class="peng-peran">{{ $item->peran }}</div>
                        @if($item->deskripsi)
                        <div class="peng-desc">{{ $item->deskripsi }}</div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div style="text-align:center;padding:3rem 0;color:var(--faint);font-size:1rem;">
                No experience data available.
            </div>
            @endif
        </div>
        <div class="sec-wave-end">
            <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                <path d="M0,32 C240,80 600,5 900,45 C1100,65 1280,20 1440,38 L1440,80 L0,80Z" fill="#140f1c"/>
                <path d="M0,52 C360,72 720,30 1080,54 C1260,64 1380,40 1440,50 L1440,80 L0,80Z" fill="#140f1c"/>
            </svg>
        </div>
    </section>

    <!-- ═══ PRESTASI ═══ -->
    <section id="prestasi">
        <div class="sec-glow" style="--op:0.28;width:400px;height:400px;background:#b0e2cc;opacity:0.28;top:-100px;right:-70px;"></div>
        <div class="sec-glow" style="--op:0.22;width:300px;height:300px;background:#a8dfc4;opacity:0.22;bottom:10%;left:-55px;"></div>
        <div class="container" style="position:relative;z-index:1;">
            <div class="section-header reveal">
                <span class="section-label">Achievements</span>
                <h2 class="section-title">My <span>Achievements</span></h2>
                <div class="section-divider"></div>
            </div>

            {{-- Tab Buttons --}}
            <div class="prestasi-tabs reveal">
                <button class="ptab-btn active" onclick="switchTab('akademik', this)">🎓 Academic Achievements</button>
                <button class="ptab-btn" onclick="switchTab('non_akademik', this)">🏆 Non-Academic Achievements</button>
            </div>

            {{-- Tab: Akademik --}}
            <div class="ptab-panel active" id="tab-akademik">
                <div class="prestasi-grid">
                    @forelse($prestasiAkademik as $item)
                    <div class="p-card reveal"
                         onclick="openDetailModal(this)"
                         data-type="prestasi"
                         data-title="{{ $item->title }}"
                         data-year="{{ $item->year }}"
                         data-description="{{ $item->description ?? '' }}"
                         data-badge="{{ $item->badge ?? '' }}"
                         data-foto="{{ $item->foto ? Storage::url($item->foto) : '' }}">
                        @if($item->foto)
                        <img class="p-foto" src="{{ Storage::url($item->foto) }}" alt="{{ $item->title }}">
                        @endif
                        <div class="p-card-body">
                            <div class="p-year"><i class="fa-solid fa-calendar-days" style="margin-right:0.3rem;"></i>{{ $item->year }}</div>
                            <div class="p-title">{{ $item->title }}</div>
                            <div class="p-desc">{{ $item->description }}</div>
                            <div class="p-footer">
                                <span class="p-badge"><i class="fa-solid fa-trophy"></i> {{ $item->badge }}</span>
                                <span class="p-more"><i class="fa-solid fa-circle-info"></i> Details</span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p style="color:var(--faint);font-size:0.9rem;">No academic achievement data available.</p>
                    @endforelse
                </div>
            </div>

            {{-- Tab: Non-Akademik --}}
            <div class="ptab-panel" id="tab-non_akademik">
                <div class="prestasi-grid">
                    @forelse($prestasiNonAkademik as $item)
                    <div class="p-card reveal"
                         onclick="openDetailModal(this)"
                         data-type="prestasi"
                         data-title="{{ $item->title }}"
                         data-year="{{ $item->year }}"
                         data-description="{{ $item->description ?? '' }}"
                         data-badge="{{ $item->badge ?? '' }}"
                         data-foto="{{ $item->foto ? Storage::url($item->foto) : '' }}">
                        @if($item->foto)
                        <img class="p-foto" src="{{ Storage::url($item->foto) }}" alt="{{ $item->title }}">
                        @endif
                        <div class="p-card-body">
                            <div class="p-year"><i class="fa-solid fa-calendar-days" style="margin-right:0.3rem;"></i>{{ $item->year }}</div>
                            <div class="p-title">{{ $item->title }}</div>
                            <div class="p-desc">{{ $item->description }}</div>
                            <div class="p-footer">
                                <span class="p-badge"><i class="fa-solid fa-trophy"></i> {{ $item->badge }}</span>
                                <span class="p-more"><i class="fa-solid fa-circle-info"></i> Details</span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p style="color:var(--faint);font-size:0.9rem;">No non-academic achievement data available.</p>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="sec-wave-end">
            <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                <path d="M0,35 C360,80 720,5 1080,38 C1260,52 1380,22 1440,30 L1440,80 L0,80Z" fill="#181224"/>
                <path d="M0,55 C300,74 600,36 900,56 C1100,68 1300,44 1440,52 L1440,80 L0,80Z" fill="#181224"/>
            </svg>
        </div>
    </section>

    <!-- ═══ JURNAL ═══ -->
    <section id="jurnal">
        <div class="sec-glow" style="--op:0.30;width:360px;height:360px;background:#a5dcc4;opacity:0.30;top:-90px;left:-50px;"></div>
        <div class="sec-glow" style="--op:0.25;width:300px;height:300px;background:#b2e8d2;opacity:0.25;bottom:12%;right:-40px;"></div>
        <div class="container" style="position:relative;z-index:1;">
            <div class="section-header reveal">
                <span class="section-label">Scientific Publications</span>
                <h2 class="section-title">Journal <span>&amp; Articles</span></h2>
                <div class="section-divider"></div>
            </div>
            <div class="jurnal-list">
                @forelse($jurnal as $item)
                <div class="j-card reveal"
                     onclick="openDetailModal(this)"
                     data-type="jurnal"
                     data-title="{{ $item->title }}"
                     data-authors="{{ $item->authors ?? '' }}"
                     data-journal="{{ $item->journal_name ?? '' }}"
                     data-year="{{ $item->year }}"
                     data-indexed="{{ $item->indexed_by ?? '' }}"
                     data-description="{{ $item->description ?? '' }}"
                     data-url="{{ $item->url ?? '' }}">
                    <div class="j-body">
                        <div class="j-title">{{ $item->title }}</div>
                        <div class="j-meta">{{ $item->authors }} &bull; <span>{{ $item->journal_name }}</span></div>
                        @if($item->description)
                        <div class="j-desc">{{ $item->description }}</div>
                        @endif
                        @if($item->url)
                        <a href="{{ $item->url }}" target="_blank" rel="noopener noreferrer" class="j-link-btn">&#128279; Open Journal</a>
                        @endif
                    </div>
                    <div class="j-right">
                        <span class="j-year">{{ $item->year }}</span>
                        <span class="j-index-badge">{{ $item->indexed_by }}</span>
                    </div>
                </div>
                @empty
                <p style="color:var(--faint);font-size:0.9rem;text-align:center;padding:2rem 0;">No journal data available.</p>
                @endforelse
            </div>
        </div>
        <div class="sec-wave-end">
            <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                <path d="M0,30 C240,80 600,5 900,42 C1100,62 1280,22 1440,36 L1440,80 L0,80Z" fill="#1d152b"/>
                <path d="M0,52 C360,70 720,32 1080,52 C1260,62 1380,40 1440,48 L1440,80 L0,80Z" fill="#1d152b"/>
            </svg>
        </div>
    </section>

    <!-- ═══ HKI ═══ -->
    <section id="hki">
        <div class="sec-glow" style="--op:0.28;width:380px;height:380px;background:#a8e0d0;opacity:0.28;top:-80px;right:-60px;"></div>
        <div class="sec-glow" style="--op:0.22;width:310px;height:310px;background:#b5e8da;opacity:0.22;bottom:8%;left:-55px;"></div>
        <div class="container" style="position:relative;z-index:1;">
            <div class="section-header reveal">
                <span class="section-label">Intellectual Property</span>
                <h2 class="section-title">IPR <span>&amp; Patents</span></h2>
                <div class="section-divider"></div>
            </div>
            <div class="hki-list">
                @forelse($hki as $item)
                <div class="hki-card reveal"
                     onclick="openDetailModal(this)"
                     data-type="hki"
                     data-title="{{ $item->title }}"
                     data-authors="{{ $item->authors ?? '' }}"
                     data-jenis="{{ $item->jenis_hki ?? '' }}"
                     data-nomor="{{ $item->nomor_pencatatan ?? '' }}"
                     data-year="{{ $item->year }}"
                     data-description="{{ $item->description ?? '' }}"
                     data-url="{{ $item->sertifikat_file ? Storage::url($item->sertifikat_file) : '' }}">
                    <div class="j-body">
                        <div class="hki-title">{{ $item->title }}</div>
                        <div class="hki-meta">{{ $item->authors }}</div>
                        @if($item->nomor_pencatatan)
                        <div class="hki-nomor"><i class="fa-solid fa-fingerprint" style="opacity:0.5;font-size:0.75em;"></i> {{ $item->nomor_pencatatan }}</div>
                        @endif
                        @if($item->description)
                        <div class="hki-desc">{{ Str::limit($item->description, 150) }}</div>
                        @endif
                        @if($item->sertifikat_file)
                        <a href="{{ Storage::url($item->sertifikat_file) }}" target="_blank" rel="noopener noreferrer" class="hki-link-btn" onclick="event.stopPropagation()"><i class="fa-solid fa-scroll"></i> View Certificate</a>
                        @endif
                    </div>
                    <div class="hki-right">
                        <span class="hki-year">{{ $item->year }}</span>
                        <span class="hki-jenis-badge">
                            @php
                                $jenis = strtolower($item->jenis_hki ?? '');
                                $jenisIcon = str_contains($jenis, 'paten') ? 'fa-lightbulb'
                                    : (str_contains($jenis, 'merek') ? 'fa-tag'
                                    : (str_contains($jenis, 'desain') ? 'fa-pen-ruler'
                                    : 'fa-copyright'));
                            @endphp
                            <i class="fa-solid {{ $jenisIcon }}"></i> {{ $item->jenis_hki }}
                        </span>
                    </div>
                </div>
                @empty
                <p style="color:var(--faint);font-size:0.9rem;text-align:center;padding:2rem 0;">No IPR data available.</p>
                @endforelse
            </div>
        </div>
        <div class="sec-wave-end">
            <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                <path d="M0,33 C360,80 720,5 1080,38 C1260,54 1380,22 1440,32 L1440,80 L0,80Z" fill="#221833"/>
                <path d="M0,54 C300,73 600,34 900,55 C1100,67 1300,44 1440,52 L1440,80 L0,80Z" fill="#221833"/>
            </svg>
        </div>
    </section>

    <!-- ═══ PROJEK ═══ -->
    <section id="projek">
        <div class="sec-glow" style="--op:0.28;width:400px;height:400px;background:#a8d8bc;opacity:0.28;top:-100px;right:-70px;"></div>
        <div class="sec-glow" style="--op:0.22;width:310px;height:310px;background:#bce5cc;opacity:0.22;bottom:10%;left:-50px;"></div>
        <div class="container" style="position:relative;z-index:1;">
            <div class="section-header reveal">
                <span class="section-label">My Work</span>
                <h2 class="section-title">Latest <span>Projects</span></h2>
                <div class="section-divider"></div>
            </div>
            <div class="proj-grid">
                @forelse($projek as $item)
                 <div class="proj-card reveal"
                     onclick="openDetailModal(this)"
                     data-type="projek"
                     data-title="{{ $item->title }}"
                     data-description="{{ $item->description ?? '' }}"
                     data-tags="{{ json_encode($item->tags ?? []) }}"
                     data-galeri="{{ json_encode($item->allImages()) }}"
                     data-demo="{{ $item->demo_url ?? '' }}"
                     data-github="{{ $item->github_url ?? '' }}">
                    @php $allImgs = $item->allImages(); @endphp
                    <div class="proj-thumb proj-thumb-{{ $item->thumb_color }}">
                        <div class="proj-thumb-pattern"></div>
                        @if(count($allImgs) > 0)
                        <div class="proj-slider" data-index="0" data-count="{{ count($allImgs) }}">
                            @foreach($allImgs as $imgUrl)
                            <div class="proj-slide{{ $loop->first ? ' active' : '' }}">
                                <img src="{{ $imgUrl }}" alt="{{ $item->title }}" loading="lazy">
                            </div>
                            @endforeach
                            @if(count($allImgs) > 1)
                            <button class="proj-slide-btn proj-slide-prev" onclick="slideCard(this,-1);event.stopPropagation();"><i class="fa-solid fa-chevron-left"></i></button>
                            <button class="proj-slide-btn proj-slide-next" onclick="slideCard(this,1);event.stopPropagation();"><i class="fa-solid fa-chevron-right"></i></button>
                            <div class="proj-slide-dots">
                                @foreach($allImgs as $imgUrl)
                                <span class="proj-slide-dot{{ $loop->first ? ' active' : '' }}"></span>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        @else
                        <div class="proj-icon-wrap">
                            @if($item->thumb_color == 2)
                            <i class="fa-solid fa-mobile-screen-button proj-icon"></i>
                            @elseif($item->thumb_color == 3)
                            <i class="fa-solid fa-database proj-icon"></i>
                            @else
                            <i class="fa-solid fa-code proj-icon"></i>
                            @endif
                        </div>
                        @endif
                    </div>
                    <div class="proj-body">
                        <div class="proj-tags">
                            @foreach($item->tags ?? [] as $tag)
                            <span class="tag">{{ $tag }}</span>
                            @endforeach
                        </div>
                        <div class="proj-title">{{ $item->title }}</div>
                        <div class="proj-desc">{{ $item->description }}</div>
                        <div class="proj-footer">
                            <div class="proj-links">
                                @if($item->demo_url)
                                <a href="{{ $item->demo_url }}" target="_blank" rel="noopener noreferrer" class="proj-link proj-link-demo" onclick="event.stopPropagation()">
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i> Demo
                                </a>
                                @endif
                                @if($item->github_url)
                                <a href="{{ $item->github_url }}" target="_blank" rel="noopener noreferrer" class="proj-link proj-link-git" onclick="event.stopPropagation()">
                                    <i class="fa-brands fa-github"></i> GitHub
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <p style="color:var(--faint);font-size:0.9rem;">No project data available.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- ═══ FOOTER ═══ -->
    <div class="footer">
        <div class="footer-corak"></div>
        <div class="footer-wave">
            <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                <path d="M0,38 C360,80 720,5 1080,42 C1260,58 1380,22 1440,32 L1440,0 L0,0Z" fill="#221833"/>
                <path d="M0,55 C300,72 600,35 900,58 C1100,68 1300,45 1440,54 L1440,0 L0,0Z" fill="#221833"/>
            </svg>
        </div>
        <div class="footer-content">
            <div class="footer-grid">
                <div class="footer-brand">
                    <div class="footer-logo">{{ $profil?->nama ?? 'ALIFIA SHOFA\' NABILAH' }}</div>
                    <p class="footer-tagline">Information Technology student focused on application and system development with various modern technologies.</p>
                </div>
                <div class="footer-nav">
                    <h4>Navigation</h4>
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#tentang">About</a></li>
                        <li><a href="#pengalaman">Experience</a></li>
                        <li><a href="#prestasi">Achievements</a></li>
                        <li><a href="#jurnal">Journal</a></li>
                        <li><a href="#hki">IPR</a></li>
                        <li><a href="#projek">Projects</a></li>
                    </ul>
                </div>
                <div class="footer-social-section">
                    <h4>Social Media</h4>
                    @if($sosmed->isNotEmpty())
                    <div class="footer-social-links">
                        @foreach($sosmed as $s)
                        <a href="{{ $s->url }}" target="_blank" rel="noopener noreferrer" class="footer-social-link" title="{{ $s->label }}">
                            <i class="fa-brands fa-{{ $s->platform }}"></i>
                        </a>
                        @endforeach
                    </div>
                    @endif
                    @if($profil?->no_whatsapp)
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $profil->no_whatsapp) }}" target="_blank" rel="noopener noreferrer" style="display:inline-flex;align-items:center;gap:0.4rem;margin-top:1rem;font-size:0.85rem;color:#ffd5e8;text-decoration:none;font-weight:600;">
                        <i class="fa-brands fa-whatsapp"></i> {{ $profil->no_whatsapp }}
                    </a>
                    @endif
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} <span>{{ $profil?->nama ?? 'ALIFIA SHOFA\' NABILAH' }}</span> &mdash; Built with ❤️ &amp; full dedication</p>
                <div class="footer-bottom-links">
                    <a href="#home">Back to Top ↑</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function switchTab(tab, btn) {
            document.querySelectorAll('.ptab-panel').forEach(function(p) { p.classList.remove('active'); });
            document.querySelectorAll('.ptab-btn').forEach(function(b) { b.classList.remove('active'); });
            document.getElementById('tab-' + tab).classList.add('active');
            btn.classList.add('active');
        }
        function toggleMenu() {
            document.getElementById('navLinks').classList.toggle('open');
        }
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) navbar.classList.add('scrolled');
            else navbar.classList.remove('scrolled');
            let current = '';
            document.querySelectorAll('section').forEach(function(s) {
                if (window.scrollY >= s.offsetTop - 120) current = s.getAttribute('id');
            });
            document.querySelectorAll('.nav-links a').forEach(function(a) {
                a.classList.remove('active');
                if (a.getAttribute('href') === '#' + current) a.classList.add('active');
            });
            checkReveal();
        });
        function checkReveal() {
            document.querySelectorAll('.reveal').forEach(function(el) {
                if (el.getBoundingClientRect().top < window.innerHeight - 80) el.classList.add('visible');
            });
        }
        checkReveal();
        document.querySelectorAll('.nav-links a').forEach(function(a) {
            a.addEventListener('click', function() {
                document.getElementById('navLinks').classList.remove('open');
            });
        });

        /* ── DETAIL MODAL ── */
        function openDetailModal(el) {
            const type = el.dataset.type;
            const header = document.getElementById('detailHeader');
            const body   = document.getElementById('detailBody');
            let hHtml = '', bHtml = '';

            if (type === 'pengalaman') {
                hHtml = '<div class="detail-type-badge"><i class="fa-solid fa-briefcase"></i> Experience & Organizations</div>'
                      + '<div class="detail-title">' + escHtml(el.dataset.nama) + '</div>'
                      + '<div class="detail-subtitle">📌 ' + escHtml(el.dataset.peran) + '</div>';
                if (el.dataset.sertifikat) bHtml += '<div class="detail-img-wrap"><img class="detail-foto" src="' + el.dataset.sertifikat + '" alt="Certificate"><a class="detail-dl-btn" href="' + el.dataset.sertifikat + '" download="certificate.jpg"><i class="fa-solid fa-download"></i> Download Image</a></div>';
                bHtml += '<div class="detail-row"><span class="detail-label">Period</span><span class="detail-value">' + escHtml(el.dataset.periode) + '</span></div>'
                       + '<div class="detail-row"><span class="detail-label">Type</span><span class="detail-value"><span class="peng-jenis ' + el.dataset.jenisClass + '">' + escHtml(el.dataset.jenisLabel) + '</span></span></div>';
                if (el.dataset.deskripsi) bHtml += '<div class="detail-desc">' + escHtml(el.dataset.deskripsi) + '</div>';

            } else if (type === 'prestasi') {
                hHtml = '<div class="detail-type-badge"><i class="fa-solid fa-trophy"></i> Achievement</div>'
                      + '<div class="detail-title">' + escHtml(el.dataset.title) + '</div>';
                if (el.dataset.foto) bHtml += '<div class="detail-img-wrap"><img class="detail-foto" src="' + el.dataset.foto + '" alt="Achievement Photo"><a class="detail-dl-btn" href="' + el.dataset.foto + '" download="achievement.jpg"><i class="fa-solid fa-download"></i> Download Image</a></div>';
                bHtml += '<div class="detail-row"><span class="detail-label">Year</span><span class="detail-value">' + escHtml(el.dataset.year) + '</span></div>';
                if (el.dataset.badge) bHtml += '<div class="detail-row"><span class="detail-label">Category</span><span class="detail-value"><span class="td-badge">' + escHtml(el.dataset.badge) + '</span></span></div>';
                if (el.dataset.description) bHtml += '<div class="detail-desc">' + escHtml(el.dataset.description) + '</div>';

            } else if (type === 'jurnal') {
                hHtml = '<div class="detail-type-badge"><i class="fa-solid fa-newspaper"></i> Journal & Articles</div>'
                      + '<div class="detail-title">' + escHtml(el.dataset.title) + '</div>';
                bHtml = '<div class="detail-row"><span class="detail-label">Authors</span><span class="detail-value">' + escHtml(el.dataset.authors) + '</span></div>'
                      + '<div class="detail-row"><span class="detail-label">Journal</span><span class="detail-value">' + escHtml(el.dataset.journal) + '</span></div>'
                      + '<div class="detail-row"><span class="detail-label">Year</span><span class="detail-value">' + escHtml(el.dataset.year) + '</span></div>';
                if (el.dataset.indexed) bHtml += '<div class="detail-row"><span class="detail-label">Index</span><span class="detail-value">' + escHtml(el.dataset.indexed) + '</span></div>';
                if (el.dataset.description) bHtml += '<div class="detail-desc">' + escHtml(el.dataset.description) + '</div>';
                if (el.dataset.url) bHtml += '<div class="detail-links"><a href="' + el.dataset.url + '" target="_blank" rel="noopener noreferrer" class="detail-link-btn detail-link-primary"><i class="fa-solid fa-arrow-up-right-from-square"></i> Open Journal</a></div>';

            } else if (type === 'hki') {
                hHtml = '<div class="detail-type-badge"><i class="fa-solid fa-certificate"></i> IPR &amp; Patents</div>'
                      + '<div class="detail-title">' + escHtml(el.dataset.title) + '</div>';
                bHtml = '<div class="detail-row"><span class="detail-label">Rights Holder</span><span class="detail-value">' + escHtml(el.dataset.authors) + '</span></div>'
                      + '<div class="detail-row"><span class="detail-label">Type</span><span class="detail-value"><span class="td-badge">' + escHtml(el.dataset.jenis) + '</span></span></div>'
                      + '<div class="detail-row"><span class="detail-label">Year</span><span class="detail-value">' + escHtml(el.dataset.year) + '</span></div>';
                if (el.dataset.nomor) bHtml += '<div class="detail-row"><span class="detail-label">Registration No.</span><span class="detail-value" style="font-family:monospace;">' + escHtml(el.dataset.nomor) + '</span></div>';
                if (el.dataset.description) bHtml += '<div class="detail-desc">' + escHtml(el.dataset.description) + '</div>';
                if (el.dataset.url) bHtml += '<div class="detail-links"><a href="' + el.dataset.url + '" target="_blank" rel="noopener noreferrer" class="detail-link-btn detail-link-primary"><i class="fa-solid fa-scroll"></i> View Certificate</a></div>';

            } else if (type === 'projek') {
                var tags = [];
                try { tags = JSON.parse(el.dataset.tags || '[]'); } catch(e) {}
                var imgs = [];
                try { imgs = JSON.parse(el.dataset.galeri || '[]'); } catch(e) {}
                hHtml = '<div class="detail-type-badge"><i class="fa-solid fa-laptop-code"></i> Project</div>'
                      + '<div class="detail-title">' + escHtml(el.dataset.title) + '</div>';
                // Image slider
                if (imgs.length > 0) {
                    bHtml += '<div class="detail-slider" id="detailSlider" data-index="0">';
                    imgs.forEach(function(src, i) {
                        bHtml += '<div class="detail-slide' + (i===0?' active':'') + '"><img src="' + src + '" alt="Project Image" loading="lazy"></div>';
                    });
                    if (imgs.length > 1) {
                        bHtml += '<button class="detail-slide-prev" onclick="detailSlide(-1)"><i class="fa-solid fa-chevron-left"></i></button>';
                        bHtml += '<button class="detail-slide-next" onclick="detailSlide(1)"><i class="fa-solid fa-chevron-right"></i></button>';
                        bHtml += '<div class="detail-slide-dots-wrap">';
                        imgs.forEach(function(_, i) {
                            bHtml += '<span class="detail-dot' + (i===0?' active':'') + '"></span>';
                        });
                        bHtml += '</div>';
                    }
                    bHtml += '</div>';
                }
                if (tags.length) bHtml += '<div class="detail-tags">' + tags.map(function(t){ return '<span class="detail-tag">' + escHtml(t) + '</span>'; }).join('') + '</div>';
                if (el.dataset.description) bHtml += '<div class="detail-desc">' + escHtml(el.dataset.description) + '</div>';
                if (el.dataset.demo || el.dataset.github) {
                    bHtml += '<div class="detail-links">';
                    if (el.dataset.demo) bHtml += '<a href="' + el.dataset.demo + '" target="_blank" rel="noopener noreferrer" class="detail-link-btn detail-link-primary"><i class="fa-solid fa-arrow-up-right-from-square"></i> Live Demo</a>';
                    if (el.dataset.github) {
                        bHtml += '<a href="' + el.dataset.github + '" target="_blank" rel="noopener noreferrer" class="detail-link-btn detail-link-secondary"><i class="fa-brands fa-github"></i> GitHub</a>';
                    }
                    bHtml += '</div>';
                }
            }

            header.innerHTML = hHtml;
            body.innerHTML   = bHtml;
            // Start detail slider auto-advance
            clearInterval(_detailTimer);
            var ds = document.getElementById('detailSlider');
            if (ds && ds.querySelectorAll('.detail-slide').length > 1) {
                _detailTimer = setInterval(function() { detailSlide(1); }, 4500);
            }
            document.getElementById('detailOverlay').classList.add('open');
            document.body.style.overflow = 'hidden';
        }
        function closeDetailModal(e) {
            if (e.target === document.getElementById('detailOverlay')) closeDetailModalBtn();
        }
        function closeDetailModalBtn() {
            clearInterval(_detailTimer);
            document.getElementById('detailOverlay').classList.remove('open');
            document.body.style.overflow = '';
        }
        function escHtml(str) {
            if (!str) return '';
            return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
        }
        /* ── SLIDER FUNCTIONS ── */
        var _detailTimer = null;
        function advanceSlider(slider, dir) {
            var slides = slider.querySelectorAll('.proj-slide,.detail-slide');
            var dots   = slider.querySelectorAll('.proj-slide-dot,.detail-dot');
            var idx    = parseInt(slider.dataset.index) || 0;
            var total  = slides.length;
            slides[idx].classList.remove('active');
            if (dots[idx]) dots[idx].classList.remove('active');
            idx = (idx + dir + total) % total;
            slides[idx].classList.add('active');
            if (dots[idx]) dots[idx].classList.add('active');
            slider.dataset.index = idx;
        }
        function slideCard(btn, dir) {
            advanceSlider(btn.closest('.proj-slider'), dir);
        }
        function detailSlide(dir) {
            var ds = document.getElementById('detailSlider');
            if (ds) advanceSlider(ds, dir);
        }
        function initSliders() {
            document.querySelectorAll('.proj-slider').forEach(function(slider) {
                var count = parseInt(slider.dataset.count || 1);
                if (count < 2) return;
                function startTimer() {
                    slider._timer = setInterval(function() { advanceSlider(slider, 1); }, 4000);
                }
                startTimer();
                slider.addEventListener('mouseenter', function() { clearInterval(slider._timer); });
                slider.addEventListener('mouseleave', startTimer);
            });
        }
        window.addEventListener('load', function() {
            initSliders();
            initTilt();
            initHeroParallax();
        });
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') { closeDetailModalBtn(); }
        });

        /* ── 3D TILT ON CARDS (desktop only) ── */
        function initTilt() {
            if (window.matchMedia('(hover:none)').matches) return; // skip touch
            var selectors = '.proj-card, .p-card, .peng-card, .about-card, .j-card, .hki-card';
            document.querySelectorAll(selectors).forEach(function(card) {
                card.classList.add('js-tilt-ready');
                // inject glare div
                var glare = document.createElement('div');
                glare.className = 'tilt-glare';
                card.appendChild(glare);

                card.addEventListener('mousemove', function(e) {
                    var rect = card.getBoundingClientRect();
                    var x = e.clientX - rect.left;
                    var y = e.clientY - rect.top;
                    var cx = rect.width / 2;
                    var cy = rect.height / 2;
                    var rotX = ((y - cy) / cy) * -7;
                    var rotY = ((x - cx) / cx) * 7;
                    var mxPct = (x / rect.width * 100).toFixed(1) + '%';
                    var myPct = (y / rect.height * 100).toFixed(1) + '%';
                    card.style.transform = 'perspective(750px) rotateX(' + rotX + 'deg) rotateY(' + rotY + 'deg) scale3d(1.025,1.025,1.025) translateY(-5px)';
                    card.style.transition = 'transform 0.08s ease, box-shadow 0.3s';
                    glare.style.setProperty('--mx', mxPct);
                    glare.style.setProperty('--my', myPct);
                    glare.style.opacity = '1';
                });
                card.addEventListener('mouseleave', function() {
                    card.style.transform = '';
                    card.style.transition = 'transform 0.45s ease, box-shadow 0.45s';
                    glare.style.opacity = '0';
                    // brief timeout then clear inline so CSS transition takes over properly
                    setTimeout(function() { card.style.transition = ''; }, 450);
                });
            });
        }

        /* ── HERO AVATAR MOUSE PARALLAX ── */
        function initHeroParallax() {
            if (window.matchMedia('(hover:none)').matches) return;
            var hero = document.getElementById('home');
            if (!hero) return;
            var avatarWrap     = hero.querySelector('.avatar-wrap');
            var shapes         = hero.querySelectorAll('.shape');
            var orbs           = hero.querySelectorAll('.home-orb');
            var geo3ds         = hero.querySelectorAll('.geo-3d');

            hero.addEventListener('mousemove', function(e) {
                var rect = hero.getBoundingClientRect();
                var x = (e.clientX - rect.left) / rect.width - 0.5;   // -0.5 … 0.5
                var y = (e.clientY - rect.top)  / rect.height - 0.5;
                shapes.forEach(function(s, i) {
                    var f = (i + 1) * 10;
                    s.style.transform = 'translateY(0) translate(' + (x * f) + 'px, ' + (y * f) + 'px)';
                });
                orbs.forEach(function(o, i) {
                    var f = (i + 1) * 18;
                    o.style.transform = 'translate(' + (x * f) + 'px, ' + (y * f) + 'px)';
                });
                geo3ds.forEach(function(g, i) {
                    var f = ((i % 4) + 1) * 5;
                    var sign = (i % 2 === 0) ? 1 : -1;
                    g.style.transform = (g.style.transform || '').replace(/translate3d\([^)]+\)/g, '')
                        + ' translate(' + (x * f * sign) + 'px, ' + (y * f * sign) + 'px)';
                });
            });
            hero.addEventListener('mouseleave', function() {
                shapes.forEach(function(s) { s.style.transform = ''; });
                orbs.forEach(function(o) { o.style.transform = ''; });
                geo3ds.forEach(function(g) {
                    // restore only the original scale transform if any
                    var orig = g.getAttribute('style') ? g.getAttribute('style').match(/scale\([^)]+\)/) : null;
                    g.style.transform = orig ? orig[0] : '';
                });
            });
        }

    </script>

    <!-- ═══ DETAIL MODAL ═══ -->
    <div class="detail-overlay" id="detailOverlay" onclick="closeDetailModal(event)">
        <div class="detail-modal" id="detailModal">
            <button class="detail-close" onclick="closeDetailModalBtn()">✕</button>
            <div class="detail-header" id="detailHeader"></div>
            <div class="detail-body" id="detailBody"></div>
        </div>
    </div>

    @if($profil?->no_whatsapp)
    <!-- ═══ FLOATING WHATSAPP BUTTON ═══ -->
    <style>
        .wa-float {
            position: fixed;
            bottom: 1.75rem;
            right: 1.75rem;
            z-index: 9999;
            display: flex;
            align-items: center;
            gap: 0;
            filter: drop-shadow(0 4px 16px rgba(37,211,102,0.45));
            animation: waPulse 2.5s ease-in-out infinite;
        }
        .wa-float a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 58px;
            height: 58px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ff6fac, #ff8fc0);
            color: #fff;
            font-size: 1.75rem;
            text-decoration: none;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 6px 24px rgba(37,211,102,0.45);
        }
        .wa-float a:hover {
            transform: scale(1.12);
            box-shadow: 0 10px 32px rgba(37,211,102,0.60);
        }
        .wa-float .wa-tooltip {
            position: absolute;
            right: 68px;
            background: #fff;
            color: #1a2e20;
            font-size: 0.82rem;
            font-weight: 700;
            padding: 0.45rem 0.9rem;
            border-radius: 8px;
            white-space: nowrap;
            box-shadow: 0 4px 16px rgba(0,0,0,0.12);
            pointer-events: none;
            opacity: 0;
            transform: translateX(6px);
            transition: opacity 0.25s, transform 0.25s;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .wa-float .wa-tooltip::before {
            content: '';
            position: absolute;
            right: -6px;
            top: 50%;
            transform: translateY(-50%);
            border: 6px solid transparent;
            border-left-color: #fff;
            border-right: none;
        }
        .wa-float a:hover + .wa-tooltip,
        .wa-float:hover .wa-tooltip {
            opacity: 1;
            transform: translateX(0);
        }
        @keyframes waPulse {
            0%, 100% { filter: drop-shadow(0 4px 16px rgba(37,211,102,0.45)); }
            50%       { filter: drop-shadow(0 4px 28px rgba(37,211,102,0.75)); }
        }
        @media (max-width: 480px) {
            .wa-float { bottom: 1.25rem; right: 1.25rem; }
            .wa-float a { width: 52px; height: 52px; font-size: 1.55rem; }
            .wa-float .wa-tooltip { display: none; }
        }
    </style>
    <div class="wa-float">
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $profil->no_whatsapp) }}?text={{ urlencode('Hello, I found your portfolio at https://anugerahtedjom.my.id/ and I am interested in discussing further.') }}"
           target="_blank" rel="noopener noreferrer" aria-label="Chat on WhatsApp">
            <i class="fa-brands fa-whatsapp"></i>
        </a>
        <span class="wa-tooltip">Chat on WhatsApp</span>
    </div>
    @endif
</body>
</html>