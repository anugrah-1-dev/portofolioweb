<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portofolio - Anugrah</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; background: #0a0a0f; color: #e2e8f0; overflow-x: hidden; }

        /* ─── NAVBAR ─── */
        nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
            padding: 1rem 2.5rem; display: flex; justify-content: space-between; align-items: center;
            background: rgba(10,10,15,0.85); backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255,255,255,0.06); transition: all 0.3s;
        }
        nav.scrolled { padding: 0.75rem 2.5rem; box-shadow: 0 4px 30px rgba(0,0,0,0.4); }
        .logo { font-size: 1.6rem; font-weight: 900; background: linear-gradient(135deg, #6366f1, #8b5cf6, #ec4899); -webkit-background-clip: text; -webkit-text-fill-color: transparent; letter-spacing: -1px; }
        .nav-links { display: flex; gap: 2.5rem; list-style: none; }
        .nav-links a { color: #64748b; text-decoration: none; font-weight: 500; font-size: 0.9rem; transition: color 0.3s; position: relative; letter-spacing: 0.3px; }
        .nav-links a:hover, .nav-links a.active { color: #a78bfa; }
        .nav-links a::after { content: ''; position: absolute; bottom: -6px; left: 0; width: 0; height: 2px; background: linear-gradient(90deg, #6366f1, #a78bfa); transition: width 0.3s ease; border-radius: 2px; }
        .nav-links a:hover::after, .nav-links a.active::after { width: 100%; }
        .hamburger { display: none; flex-direction: column; gap: 5px; cursor: pointer; padding: 5px; }
        .hamburger span { width: 24px; height: 2px; background: #94a3b8; transition: all 0.3s; border-radius: 2px; display: block; }

        /* ─── SECTIONS ─── */
        section { min-height: 100vh; padding: 6rem 2rem; display: flex; align-items: center; justify-content: center; }
        .container { max-width: 1100px; width: 100%; margin: 0 auto; }
        .section-header { text-align: center; margin-bottom: 4rem; }
        .section-label { font-size: 0.78rem; font-weight: 700; color: #a78bfa; text-transform: uppercase; letter-spacing: 5px; margin-bottom: 1rem; display: block; }
        .section-title { font-size: clamp(2rem, 4vw, 2.8rem); font-weight: 800; color: #f1f5f9; line-height: 1.2; }
        .section-title span { background: linear-gradient(135deg, #6366f1, #a78bfa); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .section-divider { width: 60px; height: 3px; background: linear-gradient(90deg, #6366f1, #a78bfa); border-radius: 2px; margin: 1.5rem auto 0; }

        /* ─── HOME ─── */
        #home {
            background: radial-gradient(ellipse at 20% 50%, rgba(99,102,241,0.12) 0%, transparent 55%),
                        radial-gradient(ellipse at 80% 30%, rgba(139,92,246,0.08) 0%, transparent 55%),
                        radial-gradient(ellipse at 50% 100%, rgba(236,72,153,0.06) 0%, transparent 50%);
        }
        .hero { display: grid; grid-template-columns: 1.1fr 0.9fr; gap: 5rem; align-items: center; }
        .hero-text .greeting { font-size: 0.85rem; font-weight: 700; color: #a78bfa; text-transform: uppercase; letter-spacing: 5px; margin-bottom: 1.25rem; display: block; }
        .hero-text h1 { font-size: clamp(2.8rem, 5.5vw, 4.2rem); font-weight: 900; line-height: 1.05; margin-bottom: 1rem; letter-spacing: -2px; }
        .hero-text h1 .name { color: #f1f5f9; }
        .hero-text h1 .highlight { background: linear-gradient(135deg, #6366f1, #a78bfa, #ec4899); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .hero-role { font-size: 1.05rem; color: #94a3b8; margin-bottom: 0.75rem; }
        .hero-role strong { color: #c4b5fd; font-weight: 600; }
        .hero-desc { font-size: 1rem; color: #475569; line-height: 1.8; margin-bottom: 2.5rem; max-width: 460px; }
        .btn-group { display: flex; gap: 1rem; flex-wrap: wrap; margin-bottom: 3rem; }
        .btn { padding: 0.85rem 2rem; border-radius: 50px; font-weight: 600; font-size: 0.9rem; text-decoration: none; transition: all 0.3s; cursor: pointer; border: none; display: inline-flex; align-items: center; gap: 0.4rem; }
        .btn-primary { background: linear-gradient(135deg, #6366f1, #8b5cf6); color: white; box-shadow: 0 0 25px rgba(99,102,241,0.35); }
        .btn-primary:hover { transform: translateY(-3px); box-shadow: 0 0 35px rgba(99,102,241,0.55); }
        .btn-outline { background: transparent; color: #a78bfa; border: 2px solid rgba(99,102,241,0.4); }
        .btn-outline:hover { background: rgba(99,102,241,0.1); border-color: #8b5cf6; transform: translateY(-3px); }
        .hero-stats { display: flex; gap: 2.5rem; }
        .stat-item .stat-num { font-size: 2rem; font-weight: 800; background: linear-gradient(135deg, #6366f1, #a78bfa); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .stat-item .stat-label { font-size: 0.78rem; color: #475569; font-weight: 500; text-transform: uppercase; letter-spacing: 1px; margin-top: 2px; }
        .hero-visual { position: relative; display: flex; justify-content: center; align-items: center; }
        .avatar-wrap { position: relative; width: 280px; height: 280px; }
        .avatar-ring { position: absolute; inset: -12px; border-radius: 50%; background: conic-gradient(from 0deg, #6366f1, #8b5cf6, #ec4899, #6366f1); animation: rotateSpin 8s linear infinite; }
        .avatar-ring-inner { position: absolute; inset: 4px; background: #0a0a0f; border-radius: 50%; }
        .avatar-core { position: absolute; inset: 12px; border-radius: 50%; background: linear-gradient(135deg, #1e1b4b 0%, #2d1b69 100%); display: flex; align-items: center; justify-content: center; font-size: 6rem; overflow: hidden; }
        .float-tag { position: absolute; background: rgba(10,10,15,0.9); backdrop-filter: blur(10px); border: 1px solid rgba(99,102,241,0.35); border-radius: 12px; padding: 0.55rem 1.1rem; font-size: 0.8rem; font-weight: 600; color: #c4b5fd; white-space: nowrap; }
        .float-tag-1 { top: 10px; right: -40px; animation: floatAnim 3s ease-in-out infinite; }
        .float-tag-2 { bottom: 30px; left: -50px; animation: floatAnim 3s ease-in-out infinite 1.5s; }
        .float-tag-3 { top: 45%; right: -60px; animation: floatAnim 3s ease-in-out infinite 0.8s; }

        /* ─── TENTANG ─── */
        #tentang { background: radial-gradient(ellipse at 90% 30%, rgba(139,92,246,0.09) 0%, transparent 55%); }
        .about-grid { display: grid; grid-template-columns: 1fr 1.1fr; gap: 5rem; align-items: start; }
        .about-info p { color: #94a3b8; line-height: 1.85; margin-bottom: 1.5rem; font-size: 1rem; }
        .about-info .accent { color: #c4b5fd; font-weight: 600; }
        .about-cards { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-top: 2rem; }
        .about-card { background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.07); border-radius: 14px; padding: 1.25rem; transition: border-color 0.3s; }
        .about-card:hover { border-color: rgba(99,102,241,0.3); }
        .about-card .card-label { font-size: 0.7rem; color: #475569; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 0.4rem; }
        .about-card .card-value { font-size: 0.95rem; font-weight: 700; color: #e2e8f0; }
        .skills-wrap h3 { font-size: 1rem; font-weight: 700; color: #f1f5f9; margin-bottom: 1.75rem; text-transform: uppercase; letter-spacing: 2px; }
        .skill-item { margin-bottom: 1.5rem; }
        .skill-header { display: flex; justify-content: space-between; margin-bottom: 0.6rem; align-items: center; }
        .skill-name { font-size: 0.88rem; font-weight: 600; color: #cbd5e1; }
        .skill-pct { font-size: 0.8rem; font-weight: 700; color: #a78bfa; }
        .skill-bar { height: 5px; background: rgba(255,255,255,0.06); border-radius: 10px; overflow: hidden; }
        .skill-fill { height: 100%; border-radius: 10px; background: linear-gradient(90deg, #6366f1, #a78bfa); width: 0; transition: width 1.5s cubic-bezier(0.25, 0.46, 0.45, 0.94); }
        .tech-tags { display: flex; flex-wrap: wrap; gap: 0.6rem; margin-top: 2rem; }
        .tech-tag { padding: 0.3rem 0.9rem; border-radius: 20px; font-size: 0.78rem; font-weight: 600; background: rgba(99,102,241,0.12); color: #a78bfa; border: 1px solid rgba(99,102,241,0.2); }

        /* ─── PRESTASI ─── */
        #prestasi { background: radial-gradient(ellipse at 15% 70%, rgba(99,102,241,0.09) 0%, transparent 55%); }
        .prestasi-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(310px, 1fr)); gap: 1.5rem; }
        .p-card { background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.07); border-radius: 20px; padding: 2rem; transition: all 0.35s; position: relative; overflow: hidden; }
        .p-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px; background: linear-gradient(90deg, #6366f1, #a78bfa, #ec4899); opacity: 0; transition: opacity 0.35s; }
        .p-card:hover { transform: translateY(-8px); border-color: rgba(99,102,241,0.3); box-shadow: 0 20px 50px rgba(0,0,0,0.35); }
        .p-card:hover::before { opacity: 1; }
        .p-icon { font-size: 2.5rem; margin-bottom: 1.25rem; }
        .p-year { font-size: 0.72rem; font-weight: 700; color: #6366f1; text-transform: uppercase; letter-spacing: 3px; margin-bottom: 0.6rem; }
        .p-title { font-size: 1.1rem; font-weight: 700; color: #f1f5f9; margin-bottom: 0.75rem; line-height: 1.4; }
        .p-desc { font-size: 0.87rem; color: #64748b; line-height: 1.65; }
        .p-badge { display: inline-block; margin-top: 1.25rem; padding: 0.3rem 0.9rem; border-radius: 20px; font-size: 0.72rem; font-weight: 700; background: rgba(99,102,241,0.12); color: #a78bfa; border: 1px solid rgba(99,102,241,0.25); text-transform: uppercase; letter-spacing: 1px; }

        /* ─── PROJEK ─── */
        #projek { background: radial-gradient(ellipse at 85% 60%, rgba(236,72,153,0.07) 0%, transparent 55%); }
        .proj-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 2rem; }
        .proj-card { background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.07); border-radius: 20px; overflow: hidden; transition: all 0.4s; }
        .proj-card:hover { transform: translateY(-10px); border-color: rgba(139,92,246,0.35); box-shadow: 0 25px 60px rgba(0,0,0,0.45); }
        .proj-thumb { height: 195px; display: flex; align-items: center; justify-content: center; font-size: 4.5rem; position: relative; overflow: hidden; }
        .proj-thumb-1 { background: linear-gradient(135deg, #1e1035 0%, #312e81 100%); }
        .proj-thumb-2 { background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 100%); }
        .proj-thumb-3 { background: linear-gradient(135deg, #150a2c 0%, #2d1b69 100%); }
        .proj-card:hover .proj-thumb::after { opacity: 1; }
        .proj-thumb::after { content: ''; position: absolute; inset: 0; background: rgba(99,102,241,0.15); opacity: 0; transition: opacity 0.4s; }
        .proj-body { padding: 1.5rem; }
        .proj-tags { display: flex; gap: 0.5rem; flex-wrap: wrap; margin-bottom: 0.9rem; }
        .tag { padding: 0.2rem 0.65rem; font-size: 0.7rem; font-weight: 700; border-radius: 20px; background: rgba(99,102,241,0.12); color: #818cf8; border: 1px solid rgba(99,102,241,0.2); }
        .proj-title { font-size: 1.15rem; font-weight: 700; color: #f1f5f9; margin-bottom: 0.65rem; }
        .proj-desc { font-size: 0.87rem; color: #64748b; line-height: 1.65; margin-bottom: 1.4rem; }
        .proj-links { display: flex; gap: 1.25rem; }
        .proj-link { font-size: 0.83rem; font-weight: 600; color: #818cf8; text-decoration: none; transition: all 0.3s; display: flex; align-items: center; gap: 0.35rem; }
        .proj-link:hover { color: #c4b5fd; transform: translateX(2px); }

        /* ─── FOOTER ─── */
        footer { padding: 2.5rem 2rem; text-align: center; background: rgba(0,0,0,0.25); border-top: 1px solid rgba(255,255,255,0.04); }
        footer p { color: #334155; font-size: 0.88rem; }
        footer span { color: #6366f1; font-weight: 600; }

        /* ─── ANIMATIONS ─── */
        @keyframes rotateSpin { to { transform: rotate(360deg); } }
        @keyframes floatAnim { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-10px); } }
        @keyframes fadeUp { from { opacity: 0; transform: translateY(35px); } to { opacity: 1; transform: translateY(0); } }
        .fade-up { opacity: 0; animation: fadeUp 0.9s ease forwards; }
        .d1 { animation-delay: 0.1s; }
        .d2 { animation-delay: 0.3s; }
        .d3 { animation-delay: 0.5s; }
        .d4 { animation-delay: 0.7s; }
        .d5 { animation-delay: 0.9s; }
        .reveal { opacity: 0; transform: translateY(40px); transition: opacity 0.7s ease, transform 0.7s ease; }
        .reveal.visible { opacity: 1; transform: translateY(0); }

        /* ─── SCROLLBAR ─── */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: #0a0a0f; }
        ::-webkit-scrollbar-thumb { background: #312e81; border-radius: 5px; }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 900px) {
            .hero { grid-template-columns: 1fr; text-align: center; gap: 3rem; }
            .hero-visual { display: none; }
            .hero-desc, .btn-group, .hero-stats { justify-content: center; margin-left: auto; margin-right: auto; }
            .hero-desc { max-width: 100%; }
            .about-grid { grid-template-columns: 1fr; gap: 3rem; }
        }
        @media (max-width: 768px) {
            .nav-links { display: none; flex-direction: column; position: absolute; top: 100%; left: 0; right: 0; background: rgba(8,8,14,0.98); padding: 1.5rem 2rem; border-bottom: 1px solid rgba(255,255,255,0.07); gap: 1.25rem; }
            .nav-links.open { display: flex; }
            .hamburger { display: flex; }
            section { padding: 5rem 1.25rem; }
        }
    </style>
</head>
<body>

    <!-- ═══ NAVBAR ═══ -->
    <nav id="navbar">
        <div class="logo">AG.</div>
        <ul class="nav-links" id="navLinks">
            <li><a href="#home" class="active">Home</a></li>
            <li><a href="#tentang">Tentang</a></li>
            <li><a href="#prestasi">Prestasi</a></li>
            <li><a href="#projek">Projek</a></li>
        </ul>
        <div class="hamburger" id="hamburger" onclick="toggleMenu()">
            <span></span><span></span><span></span>
        </div>
    </nav>

    <!-- ═══ HOME ═══ -->
    <section id="home">
        <div class="container">
            <div class="hero">
                <div class="hero-text">
                    <span class="greeting fade-up d1">Halo, Perkenalkan</span>
                    <h1 class="fade-up d2">
                        <span class="name">Saya Anugrah</span><br>
                        <span class="highlight">Web Developer</span>
                    </h1>
                    <p class="hero-role fade-up d3">Full Stack Developer &amp; <strong>UI/UX Enthusiast</strong></p>
                    <p class="hero-desc fade-up d3">Membangun pengalaman digital yang modern, cepat, dan elegan. Spesialis dalam Laravel, Vue.js, dan desain antarmuka yang intuitif.</p>
                    <div class="btn-group fade-up d4">
                        <a href="#projek" class="btn btn-primary">&#128640; Lihat Projek</a>
                        <a href="#tentang" class="btn btn-outline">&#128100; Tentang Saya</a>
                    </div>
                    <div class="hero-stats fade-up d5">
                        <div class="stat-item">
                            <div class="stat-num">10+</div>
                            <div class="stat-label">Projek Selesai</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-num">3+</div>
                            <div class="stat-label">Tahun Pengalaman</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-num">6+</div>
                            <div class="stat-label">Prestasi</div>
                        </div>
                    </div>
                </div>
                <div class="hero-visual fade-up d3">
                    <div class="avatar-wrap">
                        <div class="avatar-ring"></div>
                        <div class="avatar-ring-inner"></div>
                        <div class="avatar-core">&#128104;&#8205;&#128187;</div>
                    </div>
                    <div class="float-tag float-tag-1">&#9889; Laravel</div>
                    <div class="float-tag float-tag-2">&#127912; UI Design</div>
                    <div class="float-tag float-tag-3">&#128293; Vue.js</div>
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
                    <p>Saya adalah seorang <span class="accent">Web Developer</span> yang penuh semangat dalam menciptakan solusi digital yang inovatif dan berdampak. Dengan latar belakang kuat di pengembangan <span class="accent">Full Stack</span>, saya senang membangun aplikasi dari nol hingga siap produksi.</p>
                    <p>Saya percaya bahwa kode yang baik bukan hanya yang bekerja, tapi juga yang mudah dibaca dan dipelihara. Setiap projek adalah kesempatan untuk belajar hal baru dan memberikan yang terbaik.</p>
                    <div class="about-cards">
                        <div class="about-card">
                            <div class="card-label">Nama</div>
                            <div class="card-value">Anugrah</div>
                        </div>
                        <div class="about-card">
                            <div class="card-label">Status</div>
                            <div class="card-value">Tersedia &#128994;</div>
                        </div>
                        <div class="about-card">
                            <div class="card-label">Lokasi</div>
                            <div class="card-value">Indonesia &#127470;&#127465;</div>
                        </div>
                        <div class="about-card">
                            <div class="card-label">Bahasa</div>
                            <div class="card-value">ID / EN</div>
                        </div>
                    </div>
                    <div class="tech-tags" style="margin-top:1.5rem">
                        <span class="tech-tag">Laravel</span>
                        <span class="tech-tag">Vue.js</span>
                        <span class="tech-tag">PHP</span>
                        <span class="tech-tag">MySQL</span>
                        <span class="tech-tag">Tailwind CSS</span>
                        <span class="tech-tag">JavaScript</span>
                        <span class="tech-tag">Git</span>
                        <span class="tech-tag">Docker</span>
                    </div>
                </div>
                <div class="skills-wrap reveal">
                    <h3>Keahlian Teknis</h3>
                    <div class="skill-item">
                        <div class="skill-header"><span class="skill-name">PHP / Laravel</span><span class="skill-pct">90%</span></div>
                        <div class="skill-bar"><div class="skill-fill" data-width="90"></div></div>
                    </div>
                    <div class="skill-item">
                        <div class="skill-header"><span class="skill-name">JavaScript / Vue.js</span><span class="skill-pct">80%</span></div>
                        <div class="skill-bar"><div class="skill-fill" data-width="80"></div></div>
                    </div>
                    <div class="skill-item">
                        <div class="skill-header"><span class="skill-name">HTML &amp; CSS / Tailwind</span><span class="skill-pct">95%</span></div>
                        <div class="skill-bar"><div class="skill-fill" data-width="95"></div></div>
                    </div>
                    <div class="skill-item">
                        <div class="skill-header"><span class="skill-name">MySQL / Database</span><span class="skill-pct">85%</span></div>
                        <div class="skill-bar"><div class="skill-fill" data-width="85"></div></div>
                    </div>
                    <div class="skill-item">
                        <div class="skill-header"><span class="skill-name">Git &amp; Version Control</span><span class="skill-pct">80%</span></div>
                        <div class="skill-bar"><div class="skill-fill" data-width="80"></div></div>
                    </div>
                    <div class="skill-item">
                        <div class="skill-header"><span class="skill-name">UI/UX Design</span><span class="skill-pct">75%</span></div>
                        <div class="skill-bar"><div class="skill-fill" data-width="75"></div></div>
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
            <div class="prestasi-grid">
                <div class="p-card reveal">
                    <div class="p-icon">&#127942;</div>
                    <div class="p-year">2024</div>
                    <div class="p-title">Juara 1 Web Development Competition</div>
                    <div class="p-desc">Memenangkan kompetisi pembuatan website tingkat provinsi dengan kategori Best UI/UX Design dan Most Innovative Solution.</div>
                    <span class="p-badge">Kompetisi</span>
                </div>
                <div class="p-card reveal">
                    <div class="p-icon">&#127894;</div>
                    <div class="p-year">2024</div>
                    <div class="p-title">Laravel Certified Developer</div>
                    <div class="p-desc">Mendapatkan sertifikasi resmi Laravel Certified Developer melalui ujian kompetensi framework Laravel tingkat lanjutan.</div>
                    <span class="p-badge">Sertifikasi</span>
                </div>
                <div class="p-card reveal">
                    <div class="p-icon">&#128640;</div>
                    <div class="p-year">2023</div>
                    <div class="p-title">Top 5 Hackathon Nasional</div>
                    <div class="p-desc">Masuk 5 besar hackathon nasional dengan solusi aplikasi berbasis AI untuk meningkatkan aksesibilitas pendidikan digital.</div>
                    <span class="p-badge">Hackathon</span>
                </div>
                <div class="p-card reveal">
                    <div class="p-icon">&#127891;</div>
                    <div class="p-year">2023</div>
                    <div class="p-title">Best Graduate Project Award</div>
                    <div class="p-desc">Proyek akhir mendapat penghargaan sebagai proyek terbaik dengan nilai sempurna dan rekomendasi untuk dipublikasikan.</div>
                    <span class="p-badge">Akademik</span>
                </div>
                <div class="p-card reveal">
                    <div class="p-icon">&#128161;</div>
                    <div class="p-year">2023</div>
                    <div class="p-title">Open Source Contributor</div>
                    <div class="p-desc">Aktif berkontribusi pada proyek open source populer dengan lebih dari 50 pull request yang berhasil diterima dan di-merge.</div>
                    <span class="p-badge">Open Source</span>
                </div>
                <div class="p-card reveal">
                    <div class="p-icon">&#11088;</div>
                    <div class="p-year">2022</div>
                    <div class="p-title">Beasiswa Prestasi IT</div>
                    <div class="p-desc">Meraih beasiswa penuh untuk program intensif pengembangan web dan mobile apps selama 6 bulan dari institusi terkemuka.</div>
                    <span class="p-badge">Beasiswa</span>
                </div>
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
                <div class="proj-card reveal">
                    <div class="proj-thumb proj-thumb-1">&#128722;</div>
                    <div class="proj-body">
                        <div class="proj-tags">
                            <span class="tag">Laravel</span>
                            <span class="tag">Vue.js</span>
                            <span class="tag">Tailwind</span>
                            <span class="tag">MySQL</span>
                        </div>
                        <div class="proj-title">E-Commerce Platform</div>
                        <div class="proj-desc">Platform e-commerce lengkap dengan manajemen produk, keranjang belanja, pembayaran online (Midtrans), dan dashboard admin real-time.</div>
                        <div class="proj-links">
                            <a href="#" class="proj-link">&#8594; Live Demo</a>
                            <a href="#" class="proj-link">&#9961; GitHub</a>
                        </div>
                    </div>
                </div>
                <div class="proj-card reveal">
                    <div class="proj-thumb proj-thumb-2">&#128202;</div>
                    <div class="proj-body">
                        <div class="proj-tags">
                            <span class="tag">Laravel</span>
                            <span class="tag">MySQL</span>
                            <span class="tag">Chart.js</span>
                            <span class="tag">Alpine.js</span>
                        </div>
                        <div class="proj-title">Sistem Manajemen Sekolah</div>
                        <div class="proj-desc">Aplikasi manajemen sekolah dengan fitur absensi digital QR-code, penilaian siswa, laporan akademik, dan portal komunikasi orang tua.</div>
                        <div class="proj-links">
                            <a href="#" class="proj-link">&#8594; Live Demo</a>
                            <a href="#" class="proj-link">&#9961; GitHub</a>
                        </div>
                    </div>
                </div>
                <div class="proj-card reveal">
                    <div class="proj-thumb proj-thumb-3">&#127760;</div>
                    <div class="proj-body">
                        <div class="proj-tags">
                            <span class="tag">Next.js</span>
                            <span class="tag">TypeScript</span>
                            <span class="tag">Prisma</span>
                            <span class="tag">PostgreSQL</span>
                        </div>
                        <div class="proj-title">Blog CMS Modern</div>
                        <div class="proj-desc">Platform blog dengan editor markdown visual, SEO optimization otomatis, dark mode, sistem komentar real-time, dan analytics dashboard.</div>
                        <div class="proj-links">
                            <a href="#" class="proj-link">&#8594; Live Demo</a>
                            <a href="#" class="proj-link">&#9961; GitHub</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══ FOOTER ═══ -->
    <footer>
        <p>&#169; 2024 <span>Anugrah</span> &mdash; Dibangun dengan &#10084; menggunakan Laravel &amp; dedikasi penuh</p>
    </footer>

    <script>
        // Toggle mobile menu
        function toggleMenu() {
            document.getElementById('navLinks').classList.toggle('open');
        }

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }

            // Active nav highlight
            let current = '';
            document.querySelectorAll('section').forEach(function(section) {
                if (window.scrollY >= section.offsetTop - 120) {
                    current = section.getAttribute('id');
                }
            });
            document.querySelectorAll('.nav-links a').forEach(function(link) {
                link.classList.remove('active');
                if (link.getAttribute('href') === '#' + current) {
                    link.classList.add('active');
                }
            });

            // Scroll reveal
            checkReveal();

            // Skill bar animation
            animateSkills();
        });

        function checkReveal() {
            document.querySelectorAll('.reveal').forEach(function(el) {
                if (el.getBoundingClientRect().top < window.innerHeight - 80) {
                    el.classList.add('visible');
                }
            });
        }

        var skillsAnimated = false;
        function animateSkills() {
            if (skillsAnimated) return;
            var skillsSection = document.getElementById('tentang');
            if (skillsSection && skillsSection.getBoundingClientRect().top < window.innerHeight) {
                document.querySelectorAll('.skill-fill').forEach(function(bar) {
                    bar.style.width = bar.getAttribute('data-width') + '%';
                });
                skillsAnimated = true;
            }
        }

        // Close menu on link click
        document.querySelectorAll('.nav-links a').forEach(function(link) {
            link.addEventListener('click', function() {
                document.getElementById('navLinks').classList.remove('open');
            });
        });

        // Run on load
        checkReveal();
        animateSkills();
    </script>
</body>
</html>