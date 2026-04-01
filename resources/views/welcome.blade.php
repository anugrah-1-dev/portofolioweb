<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portofolio - {{ $profil?->nama ?? 'Anugrah' }}</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="alternate icon" href="/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">
    <style>
        :root {
            --bg:        #f4f0e8;
            --bg2:       #ebf4ee;
            --surface:   #ffffff;
            --border:    #c9dfc9;
            --primary:   #2d6a4f;
            --primary2:  #40916c;
            --accent:    #0d9488;
            --accentlt:  #5eead4;
            --text:      #1a2e20;
            --muted:     #52735c;
            --faint:     #8aab90;

            /* Corak / Batik accent */
            --batik1: #b5883e;
            --batik2: #8a5c1e;
            --batik3: #d4a843;
        }
        * { margin:0; padding:0; box-sizing:border-box; }
        html { scroll-behavior:smooth; }
        body { font-family:'Plus Jakarta Sans',sans-serif; background:var(--bg); color:var(--text); overflow-x:hidden; font-size:17px; }

        /* ─── CORAK / BATIK PATTERN SVG (reusable bg) ─── */
        .corak-bg {
            position:absolute; inset:0; pointer-events:none; z-index:0; opacity:0.032;
            background-image:
                url("data:image/svg+xml,%3Csvg width='64' height='64' viewBox='0 0 64 64' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%232d6a4f' fill-opacity='1'%3E%3Cpath d='M32 0 L40 16 L32 8 L24 16z'/%3E%3Cpath d='M0 32 L16 40 L8 32 L16 24z'/%3E%3Cpath d='M64 32 L48 24 L56 32 L48 40z'/%3E%3Cpath d='M32 64 L24 48 L32 56 L40 48z'/%3E%3Ccircle cx='32' cy='32' r='3'/%3E%3Ccircle cx='8' cy='8' r='1.5'/%3E%3Ccircle cx='56' cy='8' r='1.5'/%3E%3Ccircle cx='8' cy='56' r='1.5'/%3E%3Ccircle cx='56' cy='56' r='1.5'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            background-size:64px 64px;
        }
        .corak-border {
            position:absolute; left:0; right:0; height:3px; z-index:2;
            background:var(--primary);
        }
        .corak-border-top { top:0; }
        .corak-border-bottom { bottom:0; }
        .corak-side {
            position:absolute; top:0; bottom:0; width:5px; z-index:2;
            background:repeating-linear-gradient(180deg,
                var(--primary) 0px, var(--primary) 18px,
                var(--batik1) 18px, var(--batik1) 28px,
                var(--accent) 28px, var(--accent) 46px,
                var(--batik3) 46px, var(--batik3) 56px
            );
        }
        .corak-side-left { left:0; }
        .corak-side-right { right:0; }

        /* ─── NAVBAR ─── */
        nav {
            position:fixed; top:0; left:0; right:0; z-index:1000;
            background:rgba(244,240,232,0.92); backdrop-filter:blur(20px);
            border-bottom:1px solid rgba(45,106,79,0.12);
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
        .logo { flex-shrink:0; }
        nav.scrolled .nav-inner { padding:0.65rem 2rem; }
        nav.scrolled { box-shadow:0 4px 24px rgba(45,106,79,0.12); }
        .logo {
            font-size:1.5rem; font-weight:900; letter-spacing:-1px;
            background:linear-gradient(135deg,#2d6a4f,#0d9488);
            -webkit-background-clip:text; -webkit-text-fill-color:transparent;
        }
        .nav-links { display:flex; gap:0.35rem; list-style:none; }
        .nav-links a {
            color:var(--muted); text-decoration:none; font-weight:600;
            font-size:0.97rem; padding:0.45rem 1.05rem; border-radius:50px;
            transition:all 0.25s; letter-spacing:0.1px;
        }
        .nav-links a:hover,
        .nav-links a.active { color:var(--primary); background:rgba(45,106,79,0.10); }
        .hamburger { display:none; flex-direction:column; gap:5px; cursor:pointer; padding:5px; }
        .hamburger span { width:24px; height:2px; background:var(--primary); transition:all 0.3s; border-radius:2px; display:block; }

        /* ─── LAYOUT ─── */
        section { min-height:100vh; padding:6rem 2rem; display:flex; align-items:center; justify-content:center; position:relative; overflow:hidden; }
        .container { max-width:1100px; width:100%; margin:0 auto; }
        .section-header { text-align:center; margin-bottom:4rem; position:relative; }
        .section-label { font-size:0.75rem; font-weight:700; color:var(--batik1); text-transform:uppercase; letter-spacing:5px; margin-bottom:1rem; display:block; }
        .section-title { font-size:clamp(2rem,4vw,2.8rem); font-weight:800; color:var(--text); line-height:1.2; }
        .section-title span { background:linear-gradient(135deg,var(--primary),var(--accent)); -webkit-background-clip:text; -webkit-text-fill-color:transparent; }

        /* Divider */
        .section-divider {
            width:80px; height:4px; margin:1.5rem auto 0; border-radius:4px;
            background:var(--primary);
        }

        /* ─── HOME ─── */
        #home {
            background:
                radial-gradient(ellipse at 10% 40%, rgba(45,106,79,0.10) 0%, transparent 55%),
                radial-gradient(ellipse at 85% 20%, rgba(13,148,136,0.08) 0%, transparent 55%),
                radial-gradient(ellipse at 50% 90%, rgba(64,145,108,0.07) 0%, transparent 50%),
                var(--bg);
        }
        .home-dots {
            position:absolute; inset:0; pointer-events:none; z-index:0;
            background-image:radial-gradient(circle, rgba(45,106,79,0.07) 1.8px, transparent 1.8px);
            background-size:36px 36px;
        }
        .home-decor { position:absolute; inset:0; pointer-events:none; overflow:hidden; z-index:0; }
        .home-decor .shape { position:absolute; border-radius:50%; opacity:0.07; }
        .home-decor .shape-1 { width:350px; height:350px; background:var(--primary); top:-80px; right:-60px; animation:floatShape 12s ease-in-out infinite; }
        .home-decor .shape-2 { width:200px; height:200px; background:var(--accent); bottom:10%; left:-40px; animation:floatShape 10s ease-in-out infinite 2s; }
        .home-decor .shape-3 { width:120px; height:120px; background:var(--primary2); top:55%; right:12%; border-radius:20px; transform:rotate(45deg); animation:floatShape 8s ease-in-out infinite 4s; }
        .home-orb { position:absolute; border-radius:50%; filter:blur(80px); opacity:0.10; pointer-events:none; z-index:0; }
        .home-orb-1 { width:400px; height:400px; background:#0d9488; top:-100px; left:-100px; }
        .home-orb-2 { width:300px; height:300px; background:#2d6a4f; bottom:-50px; right:-80px; }
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
        .btn-primary { background:linear-gradient(135deg,var(--primary),var(--primary2)); color:#fff; box-shadow:0 6px 20px rgba(45,106,79,0.30); }
        .btn-primary:hover { transform:translateY(-3px); box-shadow:0 10px 30px rgba(45,106,79,0.45); }
        .btn-outline { background:transparent; color:var(--primary); border:2px solid rgba(45,106,79,0.4); }
        .btn-outline:hover { background:rgba(45,106,79,0.08); border-color:var(--primary); transform:translateY(-3px); }
        .btn-whatsapp { background:linear-gradient(135deg,#25d366,#128c7e); color:#fff; box-shadow:0 6px 20px rgba(37,211,102,0.30); }
        .btn-whatsapp:hover { transform:translateY(-3px); box-shadow:0 10px 30px rgba(37,211,102,0.45); }
        .hero-stats { display:flex; gap:2.5rem; }
        .stat-item .stat-num { font-size:2.2rem; font-weight:800; background:linear-gradient(135deg,var(--primary),var(--accent)); -webkit-background-clip:text; -webkit-text-fill-color:transparent; }
        .stat-item .stat-label { font-size:0.82rem; color:var(--faint); font-weight:600; text-transform:uppercase; letter-spacing:1px; margin-top:2px; }

        /* Avatar */
        .hero-visual { position:relative; display:flex; justify-content:center; align-items:center; }
        .avatar-bg-pattern { position:absolute; width:380px; height:380px; top:50%; left:50%; border:2px dashed rgba(45,106,79,0.12); border-radius:24px; transform:translate(-50%,-50%) rotate(8deg); }
        .avatar-bg-pattern-2 { position:absolute; width:400px; height:400px; top:50%; left:50%; border:2px dashed rgba(13,148,136,0.08); border-radius:28px; transform:translate(-50%,-50%) rotate(-5deg); }
        .avatar-wrap { position:relative; width:340px; height:340px; }
        .avatar-ring { position:absolute; inset:-6px; border-radius:22px; background:linear-gradient(135deg,#2d6a4f,#b5883e,#0d9488); box-shadow:0 20px 60px rgba(45,106,79,0.25); }
        .avatar-core { position:absolute; inset:4px; border-radius:18px; background:#fff; display:flex; align-items:center; justify-content:center; font-size:6rem; overflow:hidden; }
        .avatar-core img { display:block; width:100%; height:100%; object-fit:cover; }
        .float-tag { position:absolute; background:rgba(255,255,255,0.94); backdrop-filter:blur(10px); border:1.5px solid rgba(45,106,79,0.25); border-radius:12px; padding:0.55rem 1.1rem; font-size:0.8rem; font-weight:700; color:var(--primary); white-space:nowrap; }
        .float-tag-1 { top:10px; right:-40px; animation:floatAnim 3s ease-in-out infinite; }
        .float-tag-2 { bottom:30px; left:-50px; animation:floatAnim 3s ease-in-out infinite 1.5s; }
        .float-tag-3 { top:45%; right:-60px; animation:floatAnim 3s ease-in-out infinite 0.8s; }

        /* Batik corner motif on avatar */
        .batik-corner { position:absolute; width:50px; height:50px; opacity:0.55; }
        .batik-corner-tl { top:-10px; left:-10px; transform:rotate(0deg); }
        .batik-corner-tr { top:-10px; right:-10px; transform:rotate(90deg); }
        .batik-corner-bl { bottom:-10px; left:-10px; transform:rotate(270deg); }
        .batik-corner-br { bottom:-10px; right:-10px; transform:rotate(180deg); }

        /* ─── TENTANG ─── */
        #tentang { background:linear-gradient(160deg,var(--bg) 0%,var(--bg2) 100%); }
        .tentang-orb { position:absolute; border-radius:50%; filter:blur(90px); opacity:0.07; pointer-events:none; z-index:0; }
        .tentang-orb-1 { width:350px; height:350px; background:#0d9488; top:10%; right:-80px; }
        .tentang-orb-2 { width:250px; height:250px; background:#2d6a4f; bottom:5%; left:-60px; }
        #tentang .container { position:relative; z-index:1; }
        .about-grid { display:grid; grid-template-columns:1fr 1.1fr; gap:5rem; align-items:start; }
        .about-info { position:relative; padding-left:1.5rem; }
        .about-info::before { content:''; position:absolute; left:0; top:0; width:4px; height:100%;
            background:var(--primary);
            border-radius:2px; }
        .about-info p { color:var(--muted); line-height:1.9; margin-bottom:1.5rem; font-size:1.1rem; text-align:justify; }
        .about-info .accent { color:var(--primary); font-weight:700; }
        .about-cards { display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-top:2rem; align-items:start; }
        .about-card { background:var(--surface); border:1.5px solid var(--border); border-radius:14px; padding:1.25rem; transition:border-color 0.3s,box-shadow 0.3s; position:relative; overflow:hidden; }
        .about-card::after { content:''; position:absolute; top:0; left:0; right:0; height:3px;
            background:var(--primary);
            opacity:0; transition:opacity 0.3s; }
        .about-card:hover::after { opacity:1; }
        .about-card:hover { border-color:var(--primary2); box-shadow:0 4px 18px rgba(45,106,79,0.12); }
        .about-card .card-label { font-size:0.82rem; color:var(--faint); text-transform:uppercase; letter-spacing:2px; margin-bottom:0.4rem; font-weight:600; }
        .about-card .card-value { font-size:1.08rem; font-weight:700; color:var(--text); word-break:break-all; overflow-wrap:anywhere; }

        /* Skills */
        .skills-wrap { position:relative; }
        .skills-wrap h3 { font-size:0.95rem; font-weight:800; color:var(--text); margin-bottom:1.75rem; text-transform:uppercase; letter-spacing:2px; display:flex; align-items:center; gap:0.6rem; }
        .skills-wrap h3::after { content:''; flex:1; height:2px;
            background:var(--primary);
        }
        .tech-tags { display:grid; grid-template-columns:repeat(auto-fill,minmax(130px,1fr)); gap:0.75rem; }
        .tech-tag { padding:0.85rem 1rem; border-radius:12px; font-size:0.97rem; font-weight:700; text-align:center; border:1.5px solid transparent; transition:transform 0.22s,box-shadow 0.22s; cursor:default; position:relative; overflow:hidden; }
        .tech-tag::before { content:''; position:absolute; inset:0; opacity:0; background:linear-gradient(135deg,transparent 40%, rgba(255,255,255,0.4)); transition:opacity 0.3s; }
        .tech-tag:hover { transform:translateY(-4px) scale(1.04); box-shadow:0 10px 24px rgba(0,0,0,0.10); }
        .tech-tag:hover::before { opacity:1; }
        .tech-tag:nth-child(6n+1) { background:rgba(45,106,79,0.12);  color:#2d6a4f; border-color:rgba(45,106,79,0.30); }
        .tech-tag:nth-child(6n+2) { background:rgba(13,148,136,0.12); color:#0d7a72; border-color:rgba(13,148,136,0.30); }
        .tech-tag:nth-child(6n+3) { background:rgba(59,130,246,0.12); color:#1d4ed8; border-color:rgba(59,130,246,0.30); }
        .tech-tag:nth-child(6n+4) { background:rgba(181,136,62,0.14); color:#8a5c1e; border-color:rgba(181,136,62,0.35); }
        .tech-tag:nth-child(6n+5) { background:rgba(245,158,11,0.12); color:#b45309; border-color:rgba(245,158,11,0.30); }
        .tech-tag:nth-child(6n+6) { background:rgba(239,68,68,0.12);  color:#dc2626; border-color:rgba(239,68,68,0.30); }

        /* Stats & CV */
        .about-stats { display:grid; grid-template-columns:repeat(4,1fr); gap:0.75rem; margin-top:2rem; }
        .stat-item { background:var(--surface); border:1.5px solid var(--border); border-radius:14px; padding:1rem 0.75rem; text-align:center; transition:border-color 0.3s,box-shadow 0.3s; }
        .stat-item:hover { border-color:var(--primary2); box-shadow:0 4px 16px rgba(45,106,79,0.1); }
        .stat-number { font-size:1.6rem; font-weight:900; color:var(--primary); line-height:1; }
        .stat-label { font-size:0.75rem; font-weight:600; color:var(--faint); text-transform:uppercase; letter-spacing:1.5px; margin-top:0.3rem; }
        .btn-cv { display:inline-flex; align-items:center; gap:0.6rem; margin-top:1.25rem; padding:0.8rem 1.75rem;
            background:var(--primary); color:#fff; border-radius:50px; font-weight:700; font-size:0.97rem;
            text-decoration:none; transition:all 0.3s; box-shadow:0 4px 16px rgba(45,106,79,0.25); }
        .btn-cv:hover { background:var(--primary2); transform:translateY(-2px); box-shadow:0 8px 24px rgba(45,106,79,0.35); }

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
        .sosmed-whatsapp  { background:#25d366; }

        /* ─── PENGALAMAN ─── */
        #pengalaman { background:var(--bg); }
        .peng-timeline { position:relative; padding-left:2.5rem; }
        .peng-timeline::before {
            content:''; position:absolute; left:0.6rem; top:0; bottom:0; width:4px;
            background:repeating-linear-gradient(180deg,
                var(--primary) 0px,var(--primary) 16px,
                var(--batik1) 16px,var(--batik1) 24px,
                var(--accent) 24px,var(--accent) 40px,
                var(--batik3) 40px,var(--batik3) 48px,
                var(--primary2) 48px,var(--primary2) 64px
            );
            border-radius:2px;
        }
        .peng-item { position:relative; margin-bottom:2rem; }
        .peng-item:last-child { margin-bottom:0; }
        .peng-dot {
            position:absolute; left:-2.15rem; top:1.1rem;
            width:18px; height:18px; border-radius:50%;
            background:linear-gradient(135deg,var(--primary),var(--accent));
            border:3px solid var(--bg); box-shadow:0 0 0 2px var(--primary2);
            z-index:1;
        }
        .peng-card { background:var(--surface); border:1.5px solid var(--border); border-radius:18px; padding:1.5rem 1.75rem; transition:all 0.35s; position:relative; overflow:hidden; }
        .peng-card::before { content:''; position:absolute; top:0; left:0; right:0; height:4px;
            background:repeating-linear-gradient(90deg,var(--primary) 0,var(--primary) 14px,var(--batik1) 14px,var(--batik1) 22px,var(--accent) 22px,var(--accent) 36px,var(--batik3) 36px,var(--batik3) 44px);
            opacity:0; transition:opacity 0.35s; }
        .peng-card:hover::before { opacity:1; }
        .peng-card:hover { border-color:var(--primary2); box-shadow:0 16px 48px rgba(45,106,79,0.14); transform:translateX(6px); }
        .peng-head { display:flex; justify-content:space-between; align-items:flex-start; gap:1rem; margin-bottom:0.5rem; flex-wrap:wrap; }
        .peng-org { font-size:1.2rem; font-weight:800; color:var(--text); line-height:1.3; }
        .peng-meta { display:flex; align-items:center; gap:0.6rem; flex-wrap:wrap; }
        .peng-periode { font-size:0.78rem; font-weight:700; color:var(--accent); text-transform:uppercase; letter-spacing:2px; white-space:nowrap; }
        .peng-jenis { padding:0.25rem 0.8rem; border-radius:20px; font-size:0.72rem; font-weight:700;
            background:rgba(181,136,62,0.12); color:var(--batik2); border:1.5px solid rgba(181,136,62,0.28);
            text-transform:uppercase; letter-spacing:1px; white-space:nowrap; }
        .peng-jenis-organisasi  { background:rgba(45,106,79,0.12);  color:var(--primary); border-color:rgba(45,106,79,0.28); }
        .peng-jenis-kepanitiaan { background:rgba(13,148,136,0.12); color:var(--accent); border-color:rgba(13,148,136,0.28); }
        .peng-jenis-komunitas   { background:rgba(59,130,246,0.12); color:#1d4ed8; border-color:rgba(59,130,246,0.28); }
        .peng-jenis-magang      { background:rgba(168,85,247,0.12); color:#7c3aed; border-color:rgba(168,85,247,0.28); }
        .peng-jenis-volunteer   { background:rgba(181,136,62,0.12); color:var(--batik2); border-color:rgba(181,136,62,0.28); }
        .peng-jenis-lainnya     { background:rgba(107,114,128,0.12); color:#4b5563; border-color:rgba(107,114,128,0.28); }
        .peng-peran { font-size:0.97rem; font-weight:700; color:var(--primary2); margin-bottom:0.5rem; display:flex; align-items:center; gap:0.4rem; }
        .peng-peran::before { content:''; display:inline-block; width:8px; height:8px; border-radius:50%; background:var(--batik1); }
        .peng-desc { font-size:1rem; color:var(--muted); line-height:1.75; }

        /* ─── PRESTASI ─── */
        #prestasi { background:linear-gradient(160deg,var(--bg2) 0%,var(--bg) 100%); }
        .prestasi-tabs { display:flex; gap:0.75rem; margin-bottom:2.5rem; flex-wrap:wrap; }
        .ptab-btn { padding:0.55rem 1.4rem; border-radius:30px; border:2px solid var(--border); background:var(--surface);
            color:var(--muted); font-size:0.88rem; font-weight:700; cursor:pointer; transition:all 0.3s; }
        .ptab-btn.active { background:linear-gradient(135deg,var(--primary),var(--primary2)); border-color:transparent; color:#fff; box-shadow:0 4px 16px rgba(45,106,79,0.25); }
        .ptab-btn:hover:not(.active) { border-color:var(--primary2); color:var(--primary); }
        .ptab-panel { display:none; }
        .ptab-panel.active { display:block; }
        .prestasi-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(310px,1fr)); gap:1.5rem; }
        .p-card { background:var(--surface); border:1.5px solid var(--border); border-radius:20px; padding:2rem; transition:all 0.35s; position:relative; overflow:hidden; }
        .p-card::before { content:''; position:absolute; top:0; left:0; right:0; height:4px;
            background:var(--primary);
            opacity:0; transition:opacity 0.35s; }
        .p-card:hover { transform:translateY(-8px); border-color:var(--primary2); box-shadow:0 20px 50px rgba(45,106,79,0.15); }
        .p-card:hover::before { opacity:1; }
        .p-icon { font-size:2.5rem; margin-bottom:1.25rem; }
        .p-foto { width:100%; height:180px; object-fit:cover; border-radius:12px; margin-bottom:1.25rem; display:block; }
        .p-year { font-size:0.72rem; font-weight:700; color:var(--batik1); text-transform:uppercase; letter-spacing:3px; margin-bottom:0.6rem; }
        .p-title { font-size:1.25rem; font-weight:700; color:var(--text); margin-bottom:0.75rem; line-height:1.45; }
        .p-desc { font-size:1rem; color:var(--muted); line-height:1.75; }
        .p-badge { display:inline-block; margin-top:1.25rem; padding:0.3rem 0.9rem; border-radius:20px; font-size:0.72rem; font-weight:700;
            background:rgba(45,106,79,0.10); color:var(--primary); border:1.5px solid rgba(45,106,79,0.22); text-transform:uppercase; letter-spacing:1px; }

        /* ─── JURNAL ─── */
        #jurnal { background:var(--bg); }
        .jurnal-list { display:flex; flex-direction:column; gap:1.25rem; }
        .j-card { background:var(--surface); border:1.5px solid var(--border); border-radius:16px; padding:1.5rem 1.75rem;
            display:grid; grid-template-columns:1fr auto; gap:1.25rem; align-items:start;
            transition:all 0.35s; position:relative; overflow:hidden; }
        .j-card::after { content:''; position:absolute; left:0; top:0; bottom:0; width:4px;
            background:var(--primary);
            opacity:0; transition:opacity 0.35s; }
        .j-card:hover { border-color:var(--primary2); box-shadow:0 12px 40px rgba(45,106,79,0.12); transform:translateX(4px); }
        .j-card:hover::after { opacity:1; }
        .j-title { font-size:1.18rem; font-weight:700; color:var(--text); margin-bottom:0.35rem; line-height:1.45; }
        .j-meta { font-size:0.95rem; color:var(--muted); margin-bottom:0.6rem; }
        .j-meta span { color:var(--accent); font-weight:600; }
        .j-desc { font-size:0.98rem; color:var(--faint); line-height:1.7; }
        .j-index-badge { padding:0.3rem 0.85rem; border-radius:20px; font-size:0.72rem; font-weight:700;
            background:rgba(13,148,136,0.10); color:var(--accent); border:1.5px solid rgba(13,148,136,0.22);
            text-transform:uppercase; letter-spacing:1px; white-space:nowrap; }
        .j-link-btn { display:inline-flex; align-items:center; gap:0.4rem; margin-top:0.75rem;
            padding:0.4rem 1rem; border-radius:20px; font-size:0.78rem; font-weight:700;
            background:linear-gradient(135deg,var(--primary),var(--primary2)); color:#fff; text-decoration:none; transition:all 0.3s; }
        .j-link-btn:hover { background:linear-gradient(135deg,var(--accent),var(--primary)); transform:translateY(-1px); box-shadow:0 4px 14px rgba(45,106,79,0.30); }
        .j-right { display:flex; flex-direction:column; align-items:flex-end; gap:0.6rem; }
        .j-year { font-size:0.72rem; font-weight:700; color:var(--batik1); text-transform:uppercase; letter-spacing:3px; }

        /* ─── PROJEK ─── */
        #projek { background:linear-gradient(160deg,var(--bg2) 0%,var(--bg) 100%); }
        .proj-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(340px,1fr)); gap:2rem; }
        .proj-card { background:var(--surface); border:1.5px solid var(--border); border-radius:20px; overflow:hidden; transition:all 0.4s; }
        .proj-card:hover { transform:translateY(-10px); border-color:var(--primary2); box-shadow:0 25px 60px rgba(45,106,79,0.18); }
        .proj-thumb { height:195px; display:flex; align-items:center; justify-content:center; position:relative; overflow:hidden; }
        .proj-thumb img { width:100%; height:100%; object-fit:cover; display:block; }
        .proj-thumb-1 { background:linear-gradient(135deg,#cce8d8 0%,#a8d5b5 100%); }
        .proj-thumb-2 { background:linear-gradient(135deg,#b8e0d2 0%,#8ccfb8 100%); }
        .proj-thumb-3 { background:linear-gradient(135deg,#c5dfe4 0%,#96c8d2 100%); }
        /* Overlay strip on thumb */
        .proj-thumb::before { content:''; position:absolute; bottom:0; left:0; right:0; height:4px; z-index:2;
            background:var(--primary);
        }
        .proj-card:hover .proj-thumb::after { opacity:1; }
        .proj-thumb::after { content:''; position:absolute; inset:0; background:rgba(45,106,79,0.12); opacity:0; transition:opacity 0.4s; z-index:1; }
        .proj-body { padding:1.5rem; }
        .proj-tags { display:flex; gap:0.5rem; flex-wrap:wrap; margin-bottom:0.9rem; }
        .tag { padding:0.28rem 0.78rem; font-size:0.8rem; font-weight:700; border-radius:20px; background:rgba(13,148,136,0.10); color:var(--accent); border:1px solid rgba(13,148,136,0.22); }
        .proj-title { font-size:1.3rem; font-weight:800; color:var(--text); margin-bottom:0.7rem; }
        .proj-desc { font-size:1rem; color:var(--muted); line-height:1.75; margin-bottom:1.4rem; }
        .proj-links { display:flex; gap:1.25rem; }
        .proj-link { font-size:0.83rem; font-weight:700; color:var(--primary); text-decoration:none; transition:all 0.3s; display:flex; align-items:center; gap:0.35rem; }
        .proj-link:hover { color:var(--accent); transform:translateX(2px); }

        /* ─── FOOTER ─── */
        .footer { background:linear-gradient(160deg,#1a2e20 0%,#0f1f15 100%); color:rgba(255,255,255,0.7); position:relative; overflow:hidden; }
        .footer-corak { height:3px;
            background:var(--primary);
        }
        .footer-wave { width:100%; line-height:0; }
        .footer-wave svg { display:block; width:100%; height:60px; }
        .footer-content { padding:3rem 2rem 1.5rem; max-width:1100px; margin:0 auto; }
        .footer-grid { display:grid; grid-template-columns:1.5fr 1fr 1fr; gap:3rem; margin-bottom:2.5rem; }
        .footer-brand .footer-logo { font-size:1.5rem; font-weight:900; letter-spacing:-1px; background:linear-gradient(135deg,#5eead4,#40916c); -webkit-background-clip:text; -webkit-text-fill-color:transparent; margin-bottom:0.75rem; }
        .footer-brand .footer-tagline { font-size:0.9rem; line-height:1.7; color:rgba(255,255,255,0.5); max-width:320px; }
        .footer-nav h4, .footer-social-section h4 { font-size:0.75rem; font-weight:700; text-transform:uppercase; letter-spacing:3px; color:rgba(255,255,255,0.9); margin-bottom:1.25rem; }
        .footer-nav ul { list-style:none; display:flex; flex-direction:column; gap:0.6rem; }
        .footer-nav a { color:rgba(255,255,255,0.5); text-decoration:none; font-size:0.9rem; font-weight:500; transition:all 0.3s; }
        .footer-nav a:hover { color:#5eead4; transform:translateX(4px); display:inline-block; }
        .footer-social-links { display:flex; gap:0.65rem; flex-wrap:wrap; }
        .footer-social-link { width:40px; height:40px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.1rem; background:rgba(255,255,255,0.08); color:rgba(255,255,255,0.6); text-decoration:none; transition:all 0.3s; border:1px solid rgba(255,255,255,0.06); }
        .footer-social-link:hover { background:rgba(94,234,212,0.15); color:#5eead4; transform:translateY(-3px); border-color:rgba(94,234,212,0.3); }
        .footer-bottom { border-top:1px solid rgba(255,255,255,0.08); padding-top:1.5rem; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:0.75rem; }
        .footer-bottom p { font-size:0.82rem; color:rgba(255,255,255,0.35); }
        .footer-bottom span { color:#5eead4; font-weight:700; }
        .footer-bottom-links a { font-size:0.82rem; color:rgba(255,255,255,0.35); text-decoration:none; transition:color 0.3s; }
        .footer-bottom-links a:hover { color:#5eead4; }

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
    </style>
</head>
<body>

    <!-- ═══ NAVBAR ═══ -->
    <nav id="navbar">
        <div class="nav-corak"></div>
        <div class="nav-inner">
            <div class="logo">ANUGRAH TEJO MALIKI</div>
            <ul class="nav-links" id="navLinks">
                <li><a href="#home" class="active">Home</a></li>
                <li><a href="#tentang">Tentang</a></li>
                <li><a href="#pengalaman">Pengalaman</a></li>
                <li><a href="#prestasi">Prestasi</a></li>
                <li><a href="#jurnal">Jurnal</a></li>
                <li><a href="#projek">Projek</a></li>
            </ul>
            <div class="hamburger" id="hamburger" onclick="toggleMenu()">
                <span></span><span></span><span></span>
            </div>
        </div>
    </nav>

    <!-- ═══ HOME ═══ -->
    <section id="home">
        <div class="corak-bg"></div>
        <div class="home-dots"></div>
        <div class="home-orb home-orb-1"></div>
        <div class="home-orb home-orb-2"></div>
        <div class="home-decor">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>
        <div class="home-wave">
            <svg viewBox="0 0 1440 100" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                <path d="M0,60 C360,100 720,20 1080,60 C1260,80 1380,40 1440,50 L1440,100 L0,100Z" fill="rgba(235,244,238,0.6)"/>
                <path d="M0,75 C300,95 600,55 900,75 C1100,85 1300,65 1440,70 L1440,100 L0,100Z" fill="rgba(235,244,238,0.4)"/>
            </svg>
        </div>
        <div class="container">
            <div class="hero">
                <div class="hero-text">
                    <span class="greeting fade-up d1">Halo, Perkenalkan</span>
                    <h1 class="fade-up d2">
                        <span class="name">Saya Anugrah</span>
                    </h1>
                    <p class="hero-desc fade-up d3" style="text-align:justify;">Mahasiswa Teknologi Informasi yang berfokus pada pengembangan aplikasi dan sistem. Berpengalaman membangun proyek desktop, web, dan mobile dengan berbagai teknologi modern, serta memiliki minat tinggi dalam pengembangan software dan kolaborasi tim.</p>
                    <div class="btn-group fade-up d4">
                        <a href="#projek" class="btn btn-primary">&#128640; Lihat Projek</a>
                        <a href="#tentang" class="btn btn-outline">&#128100; Tentang Saya</a>
                        @if($profil?->no_whatsapp)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $profil->no_whatsapp) }}?text={{ urlencode('Halo, saya tertarik untuk berdiskusi lebih lanjut.') }}" target="_blank" rel="noopener noreferrer" class="btn btn-whatsapp"><i class="fa-brands fa-whatsapp"></i> Hubungi Saya</a>
                        @endif
                    </div>
                    <div class="hero-stats fade-up d5">
                        <div class="stat-item">
                            <div class="stat-num">{{ $totalProjek }}+</div>
                            <div class="stat-label">Projek Selesai</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-num">{{ $totalJurnal }}+</div>
                            <div class="stat-label">Jurnal & Artikel</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-num">{{ $totalPrestasi }}+</div>
                            <div class="stat-label">Prestasi</div>
                        </div>
                    </div>
                </div>
                <div class="hero-visual fade-up d3">
                    <div class="avatar-bg-pattern"></div>
                    <div class="avatar-bg-pattern-2"></div>
                    <div class="avatar-wrap">
                        <div class="avatar-ring"></div>
                        <div class="avatar-core">
                            @if($profil?->foto)
                            <img src="{{ Storage::url($profil->foto) }}" alt="{{ $profil->nama }}" style="width:100%;height:100%;object-fit:cover;">
                            @else
                            &#128104;&#8205;&#128187;
                            @endif
                        </div>
                        <!-- Batik corner decorations -->
                        <svg class="batik-corner batik-corner-tl" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 0 L50 0 L0 50Z" fill="rgba(45,106,79,0.18)"/>
                            <path d="M0 0 L24 0 L0 24Z" fill="rgba(181,136,62,0.25)"/>
                            <circle cx="8" cy="8" r="3" fill="rgba(13,148,136,0.35)"/>
                        </svg>
                        <svg class="batik-corner batik-corner-tr" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 0 L50 0 L0 50Z" fill="rgba(45,106,79,0.18)"/>
                            <path d="M0 0 L24 0 L0 24Z" fill="rgba(181,136,62,0.25)"/>
                            <circle cx="8" cy="8" r="3" fill="rgba(13,148,136,0.35)"/>
                        </svg>
                        <svg class="batik-corner batik-corner-bl" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 0 L50 0 L0 50Z" fill="rgba(45,106,79,0.18)"/>
                            <path d="M0 0 L24 0 L0 24Z" fill="rgba(181,136,62,0.25)"/>
                            <circle cx="8" cy="8" r="3" fill="rgba(13,148,136,0.35)"/>
                        </svg>
                        <svg class="batik-corner batik-corner-br" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 0 L50 0 L0 50Z" fill="rgba(45,106,79,0.18)"/>
                            <path d="M0 0 L24 0 L0 24Z" fill="rgba(181,136,62,0.25)"/>
                            <circle cx="8" cy="8" r="3" fill="rgba(13,148,136,0.35)"/>
                        </svg>
                    </div>
                    @php $tags = $profil?->kata_penyemangat ?? []; @endphp
                    @if(isset($tags[0]))<div class="float-tag float-tag-1">⭐ {{ $tags[0] }}</div>@endif
                    @if(isset($tags[1]))<div class="float-tag float-tag-2">🔥 {{ $tags[1] }}</div>@endif
                    @if(isset($tags[2]))<div class="float-tag float-tag-3">💪 {{ $tags[2] }}</div>@endif
                </div>
            </div>
        </div>
    </section>

    <!-- ═══ TENTANG ═══ -->
    <section id="tentang">
        <div class="corak-bg"></div>
        <div class="corak-border corak-border-top"></div>
        <div class="tentang-orb tentang-orb-1"></div>
        <div class="tentang-orb tentang-orb-2"></div>
        <div class="container">
            <div class="section-header reveal">
                <span class="section-label">Siapa Saya</span>
                <h2 class="section-title">Tentang <span>Saya</span></h2>
                <div class="section-divider"></div>
            </div>
            <div class="about-grid">
                <div class="about-info reveal">
                    <p>{{ $profil?->bio1 ?? 'Saya adalah seorang Web Developer yang penuh semangat dalam menciptakan solusi digital yang inovatif dan berdampak.' }}</p>
                    @if($profil?->bio2)
                    <p>{{ $profil->bio2 }}</p>
                    @endif
                    <div class="about-cards">
                        <div class="about-card">
                            <div class="card-label">Nama</div>
                            <div class="card-value">{{ $profil?->nama ?? 'Anugrah' }}</div>
                        </div>
                        <div class="about-card">
                            <div class="card-label">Email</div>
                            <div class="card-value">{{ $profil?->status ?? 'email@contoh.com' }}</div>
                        </div>
                        <div class="about-card">
                            <div class="card-label">Lokasi</div>
                            <div class="card-value">{{ $profil?->lokasi ?? 'Indonesia' }} &#127470;&#127465;</div>
                        </div>
                        <div class="about-card">
                            <div class="card-label">No. Telpon</div>
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
                    <h3>Keahlian Teknis</h3>
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
                            <div class="stat-label">Projek</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">{{ $pengalaman->count() }}</div>
                            <div class="stat-label">Organisasi</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">{{ $totalPrestasi }}</div>
                            <div class="stat-label">Prestasi</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">{{ $totalJurnal }}</div>
                            <div class="stat-label">Jurnal</div>
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
    </section>

    <!-- ═══ PENGALAMAN ═══ -->
    <section id="pengalaman">
        <div class="corak-bg"></div>
        <div class="corak-border corak-border-top"></div>
        <div class="container" style="position:relative;z-index:1;">
            <div class="section-header reveal">
                <span class="section-label">Riwayat Kontribusi</span>
                <h2 class="section-title">Pengalaman <span>Organisasi</span></h2>
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
                        'organisasi'  => '🏛️ Organisasi',
                        'kepanitiaan' => '📋 Kepanitiaan',
                        'komunitas'   => '👥 Komunitas',
                        'magang'      => '💼 Magang',
                        'volunteer'   => '🤝 Volunteer',
                        'lainnya'     => '📌 Lainnya',
                    ];
                @endphp
                <div class="peng-item reveal">
                    <div class="peng-dot"></div>
                    <div class="peng-card">
                        <div class="peng-head">
                            <div class="peng-org">{{ $item->nama_organisasi }}</div>
                            <div class="peng-meta">
                                <span class="peng-periode">{{ $item->tahun_mulai }} – {{ $item->tahun_selesai ?? 'Sekarang' }}</span>
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
                Belum ada data pengalaman.
            </div>
            @endif
        </div>
    </section>

    <!-- ═══ PRESTASI ═══ -->
    <section id="prestasi">
        <div class="corak-bg"></div>
        <div class="corak-border corak-border-top"></div>
        <div class="container">
            <div class="section-header reveal">
                <span class="section-label">Pencapaian</span>
                <h2 class="section-title">Prestasi <span>Saya</span></h2>
                <div class="section-divider"></div>
            </div>

            {{-- Tab Buttons --}}
            <div class="prestasi-tabs reveal">
                <button class="ptab-btn active" onclick="switchTab('akademik', this)">🎓 Prestasi Akademik</button>
                <button class="ptab-btn" onclick="switchTab('non_akademik', this)">🏆 Prestasi Non-Akademik</button>
            </div>

            {{-- Tab: Akademik --}}
            <div class="ptab-panel active" id="tab-akademik">
                <div class="prestasi-grid">
                    @forelse($prestasiAkademik as $item)
                    <div class="p-card reveal">
                        @if($item->foto)
                        <img class="p-foto" src="{{ Storage::url($item->foto) }}" alt="{{ $item->title }}">
                        @endif
                        <div class="p-year">{{ $item->year }}</div>
                        <div class="p-title">{{ $item->title }}</div>
                        <div class="p-desc">{{ $item->description }}</div>
                        <span class="p-badge">{{ $item->badge }}</span>
                    </div>
                    @empty
                    <p style="color:var(--faint);font-size:0.9rem;">Belum ada data prestasi akademik.</p>
                    @endforelse
                </div>
            </div>

            {{-- Tab: Non-Akademik --}}
            <div class="ptab-panel" id="tab-non_akademik">
                <div class="prestasi-grid">
                    @forelse($prestasiNonAkademik as $item)
                    <div class="p-card reveal">
                        @if($item->foto)
                        <img class="p-foto" src="{{ Storage::url($item->foto) }}" alt="{{ $item->title }}">
                        @endif
                        <div class="p-year">{{ $item->year }}</div>
                        <div class="p-title">{{ $item->title }}</div>
                        <div class="p-desc">{{ $item->description }}</div>
                        <span class="p-badge">{{ $item->badge }}</span>
                    </div>
                    @empty
                    <p style="color:var(--faint);font-size:0.9rem;">Belum ada data prestasi non-akademik.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <!-- ═══ JURNAL ═══ -->
    <section id="jurnal">
        <div class="corak-bg"></div>
        <div class="corak-border corak-border-top"></div>
        <div class="container">
            <div class="section-header reveal">
                <span class="section-label">Publikasi Ilmiah</span>
                <h2 class="section-title">Jurnal <span>&amp; Artikel</span></h2>
                <div class="section-divider"></div>
            </div>
            <div class="jurnal-list">
                @forelse($jurnal as $item)
                <div class="j-card reveal">
                    <div class="j-body">
                        <div class="j-title">{{ $item->title }}</div>
                        <div class="j-meta">{{ $item->authors }} &bull; <span>{{ $item->journal_name }}</span></div>
                        @if($item->description)
                        <div class="j-desc">{{ $item->description }}</div>
                        @endif
                        @if($item->url)
                        <a href="{{ $item->url }}" target="_blank" rel="noopener noreferrer" class="j-link-btn">&#128279; Buka Jurnal</a>
                        @endif
                    </div>
                    <div class="j-right">
                        <span class="j-year">{{ $item->year }}</span>
                        <span class="j-index-badge">{{ $item->indexed_by }}</span>
                    </div>
                </div>
                @empty
                <p style="color:var(--faint);font-size:0.9rem;text-align:center;padding:2rem 0;">Belum ada data jurnal.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- ═══ PROJEK ═══ -->
    <section id="projek">
        <div class="corak-bg"></div>
        <div class="corak-border corak-border-top"></div>
        <div class="container">
            <div class="section-header reveal">
                <span class="section-label">Karya Saya</span>
                <h2 class="section-title">Projek <span>Terbaru</span></h2>
                <div class="section-divider"></div>
            </div>
            <div class="proj-grid">
                @forelse($projek as $item)
                <div class="proj-card reveal">
                    <div class="proj-thumb proj-thumb-{{ $item->thumb_color }}">
                        @if($item->gambar)
                        <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->title }}">
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
                        <div class="proj-links">
                            @if($item->demo_url)
                            <a href="{{ $item->demo_url }}" target="_blank" rel="noopener noreferrer" class="proj-link">&#8594; Live Demo</a>
                            @endif
                            @if($item->github_url)
                            <a href="{{ $item->github_url }}" target="_blank" rel="noopener noreferrer" class="proj-link">&#9961; GitHub</a>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <p style="color:var(--faint);font-size:0.9rem;">Belum ada data projek.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- ═══ FOOTER ═══ -->
    <div class="footer">
        <div class="footer-corak"></div>
        <div class="footer-wave">
            <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                <path d="M0,30 C240,55 480,5 720,30 C960,55 1200,5 1440,30 L1440,60 L0,60Z" fill="#1a2e20"/>
            </svg>
        </div>
        <div class="footer-content">
            <div class="footer-grid">
                <div class="footer-brand">
                    <div class="footer-logo">{{ $profil?->nama ?? 'Anugrah' }}</div>
                    <p class="footer-tagline">Mahasiswa Teknologi Informasi yang berfokus pada pengembangan aplikasi dan sistem dengan berbagai teknologi modern.</p>
                </div>
                <div class="footer-nav">
                    <h4>Navigasi</h4>
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#tentang">Tentang</a></li>
                        <li><a href="#pengalaman">Pengalaman</a></li>
                        <li><a href="#prestasi">Prestasi</a></li>
                        <li><a href="#jurnal">Jurnal</a></li>
                        <li><a href="#projek">Projek</a></li>
                    </ul>
                </div>
                <div class="footer-social-section">
                    <h4>Sosial Media</h4>
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
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $profil->no_whatsapp) }}" target="_blank" rel="noopener noreferrer" style="display:inline-flex;align-items:center;gap:0.4rem;margin-top:1rem;font-size:0.85rem;color:#5eead4;text-decoration:none;font-weight:600;">
                        <i class="fa-brands fa-whatsapp"></i> {{ $profil->no_whatsapp }}
                    </a>
                    @endif
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} <span>{{ $profil?->nama ?? 'Anugrah' }}</span> &mdash; Dibangun dengan ❤️ &amp; dedikasi penuh</p>
                <div class="footer-bottom-links">
                    <a href="#home">Kembali ke Atas ↑</a>
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
    </script>

    @if($profil?->no_whatsapp)
    <!-- ═══ FLOATING WHATSAPP BUTTON ═══ -->
    <style>
        .wa-float {
            position: fixed;
            bottom: 1.75rem;
            left: 1.75rem;
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
            background: linear-gradient(135deg, #25d366, #128c7e);
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
            left: 68px;
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
            transform: translateX(-6px);
            transition: opacity 0.25s, transform 0.25s;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .wa-float .wa-tooltip::before {
            content: '';
            position: absolute;
            left: -6px;
            top: 50%;
            transform: translateY(-50%);
            border: 6px solid transparent;
            border-right-color: #fff;
            border-left: none;
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
            .wa-float { bottom: 1.25rem; left: 1.25rem; }
            .wa-float a { width: 52px; height: 52px; font-size: 1.55rem; }
            .wa-float .wa-tooltip { display: none; }
        }
    </style>
    <div class="wa-float">
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $profil->no_whatsapp) }}?text={{ urlencode('Halo, saya dari web https://anugrahtejomaliki.my.id/ tertarik untuk berdiskusi lebih lanjut.') }}"
           target="_blank" rel="noopener noreferrer" aria-label="Chat WhatsApp">
            <i class="fa-brands fa-whatsapp"></i>
        </a>
        <span class="wa-tooltip">Chat via WhatsApp</span>
    </div>
    @endif
</body>
</html>