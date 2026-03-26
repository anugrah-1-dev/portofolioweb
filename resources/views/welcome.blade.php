<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portofolio - Anugrah</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
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
        }
        * { margin:0; padding:0; box-sizing:border-box; }
        html { scroll-behavior:smooth; }
        body { font-family:'Plus Jakarta Sans',sans-serif; background:var(--bg); color:var(--text); overflow-x:hidden; }

        /* ─── NAVBAR ─── */
        nav {
            position:fixed; top:0; left:0; right:0; z-index:1000;
            background:rgba(244,240,232,0.88); backdrop-filter:blur(20px);
            border-bottom:1px solid rgba(45,106,79,0.12);
            transition:all 0.3s;
        }
        .nav-inner {
            width:100%;
            padding:1.1rem 2rem;
            display:flex; justify-content:space-between; align-items:center;
        }
        .logo { flex-shrink:0; }
        nav.scrolled .nav-inner { padding:0.75rem 2rem; }
        nav.scrolled { box-shadow:0 4px 24px rgba(45,106,79,0.12); }
        .logo {
            font-size:1.65rem; font-weight:900; letter-spacing:-1px;
            background:linear-gradient(135deg,#2d6a4f,#0d9488);
            -webkit-background-clip:text; -webkit-text-fill-color:transparent;
        }
        .nav-links { display:flex; gap:0.5rem; list-style:none; }
        .nav-links a {
            color:var(--muted); text-decoration:none; font-weight:600;
            font-size:1.15rem; padding:0.5rem 1.15rem; border-radius:50px;
            transition:all 0.25s; letter-spacing:0.1px;
        }
        .nav-links a:hover,
        .nav-links a.active { color:var(--primary); background:rgba(45,106,79,0.1); }
        .nav-links a.active { color:var(--primary); }
        .hamburger { display:none; flex-direction:column; gap:5px; cursor:pointer; padding:5px; }
        .hamburger span { width:24px; height:2px; background:var(--primary); transition:all 0.3s; border-radius:2px; display:block; }

        /* ─── LAYOUT ─── */
        section { min-height:100vh; padding:6rem 2rem; display:flex; align-items:center; justify-content:center; }
        .container { max-width:1100px; width:100%; margin:0 auto; }
        .section-header { text-align:center; margin-bottom:4rem; }
        .section-label { font-size:0.78rem; font-weight:700; color:var(--accent); text-transform:uppercase; letter-spacing:5px; margin-bottom:1rem; display:block; }
        .section-title { font-size:clamp(2rem,4vw,2.8rem); font-weight:800; color:var(--text); line-height:1.2; }
        .section-title span { background:linear-gradient(135deg,var(--primary),var(--accent)); -webkit-background-clip:text; -webkit-text-fill-color:transparent; }
        .section-divider { width:60px; height:3px; background:linear-gradient(90deg,var(--primary),var(--accent)); border-radius:2px; margin:1.5rem auto 0; }

        /* ─── HOME ─── */
        #home {
            position:relative; overflow:hidden;
            background:
                radial-gradient(ellipse at 10% 40%, rgba(45,106,79,0.10) 0%, transparent 55%),
                radial-gradient(ellipse at 85% 20%, rgba(13,148,136,0.08) 0%, transparent 55%),
                radial-gradient(ellipse at 50% 90%, rgba(64,145,108,0.07) 0%, transparent 50%);
        }

        /* Decorative floating shapes */
        .home-decor { position:absolute; inset:0; pointer-events:none; overflow:hidden; z-index:0; }
        .home-decor .shape {
            position:absolute; border-radius:50%; opacity:0.07;
        }
        .home-decor .shape-1 { width:350px; height:350px; background:var(--primary); top:-80px; right:-60px; animation:floatShape 12s ease-in-out infinite; }
        .home-decor .shape-2 { width:200px; height:200px; background:var(--accent); bottom:10%; left:-40px; animation:floatShape 10s ease-in-out infinite 2s; }
        .home-decor .shape-3 { width:120px; height:120px; background:var(--primary2); top:55%; right:12%; border-radius:20px; transform:rotate(45deg); animation:floatShape 8s ease-in-out infinite 4s; }
        .home-decor .shape-4 { width:80px; height:80px; background:var(--accent); top:15%; left:25%; border-radius:16px; transform:rotate(30deg); animation:floatShape 9s ease-in-out infinite 1s; }
        .home-decor .shape-5 { width:160px; height:160px; border:3px solid rgba(45,106,79,0.08); top:30%; left:5%; animation:floatShape 11s ease-in-out infinite 3s; }
        .home-decor .shape-6 { width:100px; height:100px; border:3px solid rgba(13,148,136,0.08); bottom:25%; right:8%; border-radius:20px; transform:rotate(15deg); animation:floatShape 7s ease-in-out infinite 5s; }

        /* Dot grid pattern */
        .home-dots {
            position:absolute; inset:0; pointer-events:none; z-index:0;
            background-image:radial-gradient(circle, rgba(45,106,79,0.06) 1.5px, transparent 1.5px);
            background-size:32px 32px;
        }

        /* Gradient orbs */
        .home-orb { position:absolute; border-radius:50%; filter:blur(80px); opacity:0.12; pointer-events:none; z-index:0; }
        .home-orb-1 { width:400px; height:400px; background:#0d9488; top:-100px; left:-100px; }
        .home-orb-2 { width:300px; height:300px; background:#2d6a4f; bottom:-50px; right:-80px; }
        .home-orb-3 { width:200px; height:200px; background:#40916c; top:40%; left:45%; }

        /* Bottom wave */
        .home-wave { position:absolute; bottom:0; left:0; width:100%; z-index:0; }
        .home-wave svg { display:block; width:100%; height:auto; }

        .hero { position:relative; z-index:1; display:grid; grid-template-columns:1.1fr 0.9fr; gap:5rem; align-items:center; }
        .hero-text .greeting { font-size:0.85rem; font-weight:700; color:var(--accent); text-transform:uppercase; letter-spacing:5px; margin-bottom:1.25rem; display:block; }
        .hero-text h1 { font-size:clamp(2.8rem,5.5vw,4.2rem); font-weight:900; line-height:1.05; margin-bottom:1rem; letter-spacing:-2px; }
        .hero-text h1 .name { color:var(--text); }
        .hero-text h1 .highlight { background:linear-gradient(135deg,var(--primary),var(--accent)); -webkit-background-clip:text; -webkit-text-fill-color:transparent; }
        .hero-role { font-size:1.05rem; color:var(--muted); margin-bottom:0.75rem; }
        .hero-role strong { color:var(--primary); font-weight:700; }
        .hero-desc { font-size:1rem; color:var(--muted); line-height:1.8; margin-bottom:2.5rem; max-width:460px; }
        .btn-group { display:flex; gap:1rem; flex-wrap:wrap; margin-bottom:3rem; }
        .btn { padding:0.85rem 2rem; border-radius:50px; font-weight:700; font-size:0.9rem; text-decoration:none; transition:all 0.3s; cursor:pointer; border:none; display:inline-flex; align-items:center; gap:0.4rem; font-family:inherit; }
        .btn-primary { background:linear-gradient(135deg,var(--primary),var(--primary2)); color:#fff; box-shadow:0 6px 20px rgba(45,106,79,0.30); }
        .btn-primary:hover { transform:translateY(-3px); box-shadow:0 10px 30px rgba(45,106,79,0.45); }
        .btn-outline { background:transparent; color:var(--primary); border:2px solid rgba(45,106,79,0.4); }
        .btn-outline:hover { background:rgba(45,106,79,0.08); border-color:var(--primary); transform:translateY(-3px); }
        .btn-whatsapp { background:linear-gradient(135deg,#25d366,#128c7e); color:#fff; box-shadow:0 6px 20px rgba(37,211,102,0.30); }
        .btn-whatsapp:hover { transform:translateY(-3px); box-shadow:0 10px 30px rgba(37,211,102,0.45); }
        .hero-stats { display:flex; gap:2.5rem; }
        .stat-item .stat-num { font-size:2rem; font-weight:800; background:linear-gradient(135deg,var(--primary),var(--accent)); -webkit-background-clip:text; -webkit-text-fill-color:transparent; }
        .stat-item .stat-label { font-size:0.78rem; color:var(--faint); font-weight:600; text-transform:uppercase; letter-spacing:1px; margin-top:2px; }

        /* Avatar */
        .hero-visual { position:relative; display:flex; justify-content:center; align-items:center; }
        .avatar-bg-pattern { position:absolute; width:380px; height:380px; top:50%; left:50%; transform:translate(-50%,-50%); border:2px dashed rgba(45,106,79,0.12); border-radius:24px; transform:translate(-50%,-50%) rotate(8deg); }
        .avatar-bg-pattern-2 { position:absolute; width:400px; height:400px; top:50%; left:50%; border:2px dashed rgba(13,148,136,0.08); border-radius:28px; transform:translate(-50%,-50%) rotate(-5deg); }
        .avatar-wrap { position:relative; width:340px; height:340px; }
        .avatar-ring { position:absolute; inset:-6px; border-radius:22px; background:linear-gradient(135deg,#2d6a4f,#0d9488); box-shadow:0 20px 60px rgba(45,106,79,0.25); }
        .avatar-ring-inner { display:none; }
        .avatar-core { position:absolute; inset:4px; border-radius:18px; background:#fff; display:flex; align-items:center; justify-content:center; font-size:6rem; overflow:hidden; box-shadow:inset 0 0 0 1px rgba(45,106,79,0.1); }
        .avatar-core img { display:block; width:100%; height:100%; object-fit:cover; }
        .float-tag { position:absolute; background:rgba(255,255,255,0.92); backdrop-filter:blur(10px); border:1.5px solid rgba(45,106,79,0.25); border-radius:12px; padding:0.55rem 1.1rem; font-size:0.8rem; font-weight:700; color:var(--primary); white-space:nowrap; }
        .float-tag-1 { top:10px; right:-40px; animation:floatAnim 3s ease-in-out infinite; }
        .float-tag-2 { bottom:30px; left:-50px; animation:floatAnim 3s ease-in-out infinite 1.5s; }
        .float-tag-3 { top:45%; right:-60px; animation:floatAnim 3s ease-in-out infinite 0.8s; }

        /* ─── TENTANG ─── */
        #tentang { background:linear-gradient(160deg,var(--bg) 0%,var(--bg2) 100%); }
        .about-grid { display:grid; grid-template-columns:1fr 1.1fr; gap:5rem; align-items:start; }
        .about-info p { color:var(--muted); line-height:1.9; margin-bottom:1.5rem; font-size:1.1rem; text-align:justify; }
        .about-info .accent { color:var(--primary); font-weight:700; }
        .about-cards { display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-top:2rem; }
        .about-card { background:var(--surface); border:1.5px solid var(--border); border-radius:14px; padding:1.25rem; transition:border-color 0.3s,box-shadow 0.3s; }
        .about-card:hover { border-color:var(--primary2); box-shadow:0 4px 16px rgba(45,106,79,0.10); }
        .about-card .card-label { font-size:0.8rem; color:var(--faint); text-transform:uppercase; letter-spacing:2px; margin-bottom:0.4rem; font-weight:600; }
        .about-card .card-value { font-size:1.05rem; font-weight:700; color:var(--text); }
        .skills-wrap h3 { font-size:1rem; font-weight:800; color:var(--text); margin-bottom:1.75rem; text-transform:uppercase; letter-spacing:2px; }
        .tech-tags { display:grid; grid-template-columns:repeat(auto-fill,minmax(135px,1fr)); gap:0.75rem; margin-top:0; }
        .tech-tag { padding:0.88rem 1rem; border-radius:14px; font-size:0.95rem; font-weight:700; text-align:center; border:1.5px solid transparent; transition:transform 0.22s,box-shadow 0.22s; cursor:default; letter-spacing:0.2px; }
        .tech-tag:hover { transform:translateY(-4px); box-shadow:0 10px 24px rgba(0,0,0,0.10); }
        .tech-tag:nth-child(6n+1) { background:rgba(45,106,79,0.12);  color:#2d6a4f; border-color:rgba(45,106,79,0.30); }
        .tech-tag:nth-child(6n+2) { background:rgba(13,148,136,0.12); color:#0d7a72; border-color:rgba(13,148,136,0.30); }
        .tech-tag:nth-child(6n+3) { background:rgba(59,130,246,0.12); color:#1d4ed8; border-color:rgba(59,130,246,0.30); }
        .tech-tag:nth-child(6n+4) { background:rgba(168,85,247,0.12); color:#7c3aed; border-color:rgba(168,85,247,0.30); }
        .tech-tag:nth-child(6n+5) { background:rgba(245,158,11,0.12); color:#b45309; border-color:rgba(245,158,11,0.30); }
        .tech-tag:nth-child(6n+6) { background:rgba(239,68,68,0.12);  color:#dc2626; border-color:rgba(239,68,68,0.30); }

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

        /* ─── PRESTASI ─── */
        #prestasi { background:var(--bg); }
        .prestasi-tabs { display:flex; gap:0.75rem; margin-bottom:2.5rem; flex-wrap:wrap; }
        .ptab-btn { padding:0.55rem 1.4rem; border-radius:30px; border:2px solid var(--border); background:var(--surface);
            color:var(--muted); font-size:0.88rem; font-weight:700; cursor:pointer; transition:all 0.3s; }
        .ptab-btn.active { background:var(--primary); border-color:var(--primary); color:#fff; }
        .ptab-btn:hover:not(.active) { border-color:var(--primary2); color:var(--primary); }
        .ptab-panel { display:none; }
        .ptab-panel.active { display:block; }
        .prestasi-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(310px,1fr)); gap:1.5rem; }
        .p-card { background:var(--surface); border:1.5px solid var(--border); border-radius:20px; padding:2rem; transition:all 0.35s; position:relative; overflow:hidden; }
        .p-card::before { content:''; position:absolute; top:0; left:0; right:0; height:3px; background:linear-gradient(90deg,var(--primary),var(--accent)); opacity:0; transition:opacity 0.35s; }
        .p-card:hover { transform:translateY(-8px); border-color:var(--primary2); box-shadow:0 20px 50px rgba(45,106,79,0.15); }
        .p-card:hover::before { opacity:1; }
        .p-icon { font-size:2.5rem; margin-bottom:1.25rem; }
        .p-foto { width:100%; height:180px; object-fit:cover; border-radius:12px; margin-bottom:1.25rem; display:block; }
        .p-year { font-size:0.72rem; font-weight:700; color:var(--accent); text-transform:uppercase; letter-spacing:3px; margin-bottom:0.6rem; }
        .p-title { font-size:1.25rem; font-weight:700; color:var(--text); margin-bottom:0.75rem; line-height:1.45; }
        .p-desc { font-size:1rem; color:var(--muted); line-height:1.75; }
        .p-badge { display:inline-block; margin-top:1.25rem; padding:0.3rem 0.9rem; border-radius:20px; font-size:0.72rem; font-weight:700; background:rgba(45,106,79,0.10); color:var(--primary); border:1.5px solid rgba(45,106,79,0.22); text-transform:uppercase; letter-spacing:1px; }

        /* ─── JURNAL ─── */
        #jurnal { background:linear-gradient(160deg,var(--bg2) 0%,var(--bg) 100%); }
        .jurnal-list { display:flex; flex-direction:column; gap:1.25rem; }
        .j-card { background:var(--surface); border:1.5px solid var(--border); border-radius:16px; padding:1.5rem 1.75rem;
            display:grid; grid-template-columns:1fr auto; gap:1.25rem; align-items:start;
            transition:all 0.35s; }
        .j-card:hover { border-color:var(--primary2); box-shadow:0 12px 40px rgba(45,106,79,0.12); transform:translateX(4px); }
        .j-icon { font-size:2.2rem; }
        .j-body {}
        .j-title { font-size:1.15rem; font-weight:700; color:var(--text); margin-bottom:0.35rem; line-height:1.45; }
        .j-meta { font-size:0.92rem; color:var(--muted); margin-bottom:0.6rem; }
        .j-meta span { color:var(--accent); font-weight:600; }
        .j-desc { font-size:0.98rem; color:var(--faint); line-height:1.7; }
        .j-index-badge { padding:0.3rem 0.85rem; border-radius:20px; font-size:0.72rem; font-weight:700;
            background:rgba(13,148,136,0.10); color:var(--accent); border:1.5px solid rgba(13,148,136,0.22);
            text-transform:uppercase; letter-spacing:1px; white-space:nowrap; }
        .j-link-btn { display:inline-flex; align-items:center; gap:0.4rem; margin-top:0.75rem;
            padding:0.4rem 1rem; border-radius:20px; font-size:0.78rem; font-weight:700;
            background:var(--primary); color:#fff; text-decoration:none; transition:all 0.3s; }
        .j-link-btn:hover { background:var(--accent); transform:translateY(-1px); }
        .j-right { display:flex; flex-direction:column; align-items:flex-end; gap:0.6rem; }
        .j-year { font-size:0.72rem; font-weight:700; color:var(--accent); text-transform:uppercase; letter-spacing:3px; }

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
        .proj-card:hover .proj-thumb::after { opacity:1; }
        .proj-thumb::after { content:''; position:absolute; inset:0; background:rgba(45,106,79,0.12); opacity:0; transition:opacity 0.4s; }
        .proj-body { padding:1.5rem; }
        .proj-tags { display:flex; gap:0.5rem; flex-wrap:wrap; margin-bottom:0.9rem; }
        .tag { padding:0.28rem 0.78rem; font-size:0.82rem; font-weight:700; border-radius:20px; background:rgba(13,148,136,0.10); color:var(--accent); border:1px solid rgba(13,148,136,0.22); }
        .proj-title { font-size:1.28rem; font-weight:700; color:var(--text); margin-bottom:0.7rem; }
        .proj-desc { font-size:1rem; color:var(--muted); line-height:1.75; margin-bottom:1.4rem; }
        .proj-links { display:flex; gap:1.25rem; }
        .proj-link { font-size:0.83rem; font-weight:700; color:var(--primary); text-decoration:none; transition:all 0.3s; display:flex; align-items:center; gap:0.35rem; }
        .proj-link:hover { color:var(--accent); transform:translateX(2px); }

        /* ─── FOOTER ─── */
        .footer { background:linear-gradient(160deg,#1a2e20 0%,#0f1f15 100%); color:rgba(255,255,255,0.7); position:relative; overflow:hidden; }
        .footer-wave { width:100%; line-height:0; }
        .footer-wave svg { display:block; width:100%; height:60px; }
        .footer-content { padding:3rem 2rem 1.5rem; max-width:1100px; margin:0 auto; }
        .footer-grid { display:grid; grid-template-columns:1.5fr 1fr 1fr; gap:3rem; margin-bottom:2.5rem; }
        .footer-brand .footer-logo { font-size:1.5rem; font-weight:900; letter-spacing:-1px; background:linear-gradient(135deg,#5eead4,#40916c); -webkit-background-clip:text; -webkit-text-fill-color:transparent; margin-bottom:0.75rem; }
        .footer-brand .footer-tagline { font-size:0.92rem; line-height:1.7; color:rgba(255,255,255,0.5); max-width:320px; }
        .footer-nav h4, .footer-social-section h4 { font-size:0.78rem; font-weight:700; text-transform:uppercase; letter-spacing:3px; color:rgba(255,255,255,0.9); margin-bottom:1.25rem; }
        .footer-nav ul { list-style:none; display:flex; flex-direction:column; gap:0.6rem; }
        .footer-nav a { color:rgba(255,255,255,0.5); text-decoration:none; font-size:0.9rem; font-weight:500; transition:all 0.3s; }
        .footer-nav a:hover { color:#5eead4; transform:translateX(4px); display:inline-block; }
        .footer-social-links { display:flex; gap:0.65rem; flex-wrap:wrap; }
        .footer-social-link { width:40px; height:40px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.1rem; background:rgba(255,255,255,0.08); color:rgba(255,255,255,0.6); text-decoration:none; transition:all 0.3s; border:1px solid rgba(255,255,255,0.06); }
        .footer-social-link:hover { background:rgba(94,234,212,0.15); color:#5eead4; transform:translateY(-3px); border-color:rgba(94,234,212,0.3); }
        .footer-bottom { border-top:1px solid rgba(255,255,255,0.08); padding-top:1.5rem; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:0.75rem; }
        .footer-bottom p { font-size:0.82rem; color:rgba(255,255,255,0.35); }
        .footer-bottom span { color:#5eead4; font-weight:700; }
        .footer-bottom-links { display:flex; gap:1.5rem; }
        .footer-bottom-links a { font-size:0.82rem; color:rgba(255,255,255,0.35); text-decoration:none; transition:color 0.3s; }
        .footer-bottom-links a:hover { color:#5eead4; }
        @media (max-width:768px) {
            .footer-grid { grid-template-columns:1fr; gap:2rem; }
            .footer-bottom { justify-content:center; text-align:center; flex-direction:column; }
        }

        /* ─── ANIMATIONS ─── */
        @keyframes rotateSpin { to { transform:rotate(360deg); } }
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
        ::-webkit-scrollbar { width:5px; }
        ::-webkit-scrollbar-track { background:var(--bg); }
        ::-webkit-scrollbar-thumb { background:var(--primary2); border-radius:5px; }

        /* ─── RESPONSIVE ─── */
        @media (max-width:900px) {
            .hero { grid-template-columns:1fr; text-align:center; gap:3rem; }
            .hero-visual { display:none; }
            .hero-desc,.btn-group,.hero-stats { justify-content:center; margin-left:auto; margin-right:auto; }
            .hero-desc { max-width:100%; }
            .about-grid { grid-template-columns:1fr; gap:3rem; }
        }
        @media (max-width:768px) {
            .nav-links { display:none; flex-direction:column; position:absolute; top:100%; left:0; right:0; background:rgba(244,240,232,0.98); padding:1.5rem 2rem; border-bottom:1.5px solid var(--border); gap:0.5rem; }
            .nav-links a { font-size:1.05rem; padding:0.75rem 1rem; }
            .nav-links.open { display:flex; }
            .hamburger { display:flex; }
            section { padding:5rem 1.25rem; }
        }
    </style>
</head>
<body>

    <!-- ═══ NAVBAR ═══ -->
    <nav id="navbar">
        <div class="nav-inner">
            <div class="logo">ANUGRAH TEJO MALIKI</div>
            <ul class="nav-links" id="navLinks">
                <li><a href="#home" class="active">Home</a></li>
                <li><a href="#tentang">Tentang</a></li>
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
        <!-- Decorative elements -->
        <div class="home-dots"></div>
        <div class="home-orb home-orb-1"></div>
        <div class="home-orb home-orb-2"></div>
        <div class="home-orb home-orb-3"></div>
        <div class="home-decor">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
            <div class="shape shape-4"></div>
            <div class="shape shape-5"></div>
            <div class="shape shape-6"></div>
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
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $profil->no_whatsapp) }}?text={{ urlencode('Halo, saya tertarik untuk berdiskusi lebih lanjut.') }}" target="_blank" class="btn btn-whatsapp"><i class="fa-brands fa-whatsapp"></i> Hubungi Saya</a>
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
                        <div class="avatar-ring-inner"></div>
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
                </div>
            </div>
        </div>
    </section>

    <!-- ═══ TENTANG ═══ -->
    <section id="tentang">
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
                </div>
            </div>
        </div>
    </section>

    <!-- ═══ PRESTASI ═══ -->
    <section id="prestasi">
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
                        <a href="{{ $item->url }}" target="_blank" class="j-link-btn">&#128279; Buka Jurnal</a>
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
                            <a href="{{ $item->demo_url }}" target="_blank" class="proj-link">&#8594; Live Demo</a>
                            @endif
                            @if($item->github_url)
                            <a href="{{ $item->github_url }}" target="_blank" class="proj-link">&#9961; GitHub</a>
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
                        <a href="{{ $s->url }}" target="_blank" rel="noopener" class="footer-social-link" title="{{ $s->label }}">
                            <i class="fa-brands fa-{{ $s->platform }}"></i>
                        </a>
                        @endforeach
                    </div>
                    @endif
                    @if($profil?->no_whatsapp)
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $profil->no_whatsapp) }}" target="_blank" style="display:inline-flex;align-items:center;gap:0.4rem;margin-top:1rem;font-size:0.85rem;color:#5eead4;text-decoration:none;font-weight:600;">
                        <i class="fa-brands fa-whatsapp"></i> {{ $profil->no_whatsapp }}
                    </a>
                    @endif
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} <span>{{ $profil?->nama ?? 'Anugrah' }}</span> &mdash; Dibangun dengan ❤️ & dedikasi penuh</p>
                <div class="footer-bottom-links">
                    <a href="#home">Kembali ke Atas</a>
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
</body>
</html>