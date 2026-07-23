<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ahmednagar Connect | Rural Infrastructure Monitoring System</title>
    <meta name="description" content="Ahmednagar Connect is a premium government digital portal for monitoring rural infrastructure projects across Ahmednagar with transparency, speed, and public accountability.">
    <meta name="theme-color" content="#285F6B">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Crect width='64' height='64' rx='14' fill='%23285F6B'/%3E%3Crect x='10' y='10' width='44' height='44' rx='10' fill='%23367D8A'/%3E%3Cpath d='M22 42V22h8c6 0 10 2.8 10 8 0 3.7-2.2 6.6-5.6 7.5L42 42h-8l-8-10h-4v10h-6Zm6-6h2c3.2 0 5-1.8 5-4.5 0-2.6-1.8-4.5-5-4.5h-2v9Z' fill='white'/%3E%3C/svg%3E">
    <style>
        :root {
            --primary: #285F6B;
            --secondary: #367D8A;
            --dark: #133336;
            --black: #010001;
            --white: #FFFFFF;
            --surface: rgba(255, 255, 255, 0.12);
            --surface-strong: rgba(255, 255, 255, 0.2);
            --border: rgba(255, 255, 255, 0.18);
            --shadow: 0 20px 40px rgba(1, 0, 1, 0.18);
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5fcfd 0%, #eef8fa 100%);
            color: var(--black);
        }

        img {
            max-width: 100%;
            display: block;
        }

        .topbar {
            position: sticky;
            top: 0;
            z-index: 999;
            background: rgba(19, 51, 54, 0.96);
            backdrop-filter: blur(22px);
            color: var(--white);
            box-shadow: 0 10px 30px rgba(1, 0, 1, 0.16);
        }

        .topbar .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 0;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 0.9rem;
            color: var(--white);
            text-decoration: none;
        }

        .brand img {
            width: 54px;
            height: 54px;
            object-fit: cover;
            border-radius: 14px;
            border: 2px solid rgba(255, 255, 255, 0.22);
            box-shadow: var(--shadow);
        }

        .brand strong {
            display: block;
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: 0.03em;
        }

        .brand span {
            font-size: 0.8rem;
            opacity: 0.75;
        }

        .top-nav {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .top-nav a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.25s ease, transform 0.25s ease;
        }

        .top-nav a:hover {
            color: var(--white);
            transform: translateY(-1px);
        }

        .btn-pill {
            border-radius: 999px;
            padding: 0.7rem 1.15rem;
            font-weight: 600;
            border: none;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .btn-pill:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(1, 0, 1, 0.14);
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: var(--white);
        }

        .btn-outline-custom {
            background: transparent;
            color: var(--white);
            border: 1px solid rgba(255, 255, 255, 0.24);
        }

        .mobile-toggle {
            display: none;
            background: transparent;
            border: 0;
            color: var(--white);
            font-size: 1.4rem;
        }

        .hero-section {
            padding: 5rem 0 4rem;
            background:
                radial-gradient(circle at top right, rgba(54, 125, 138, 0.18), transparent 30%),
                linear-gradient(135deg, rgba(19, 51, 54, 0.98), rgba(40, 95, 107, 0.95));
            color: var(--white);
            position: relative;
            overflow: hidden;
        }

        .hero-section::before,
        .hero-section::after {
            content: "";
            position: absolute;
            border-radius: 50%;
            filter: blur(8px);
            opacity: 0.28;
            animation: float 8s ease-in-out infinite;
        }

        .hero-section::before {
            width: 280px;
            height: 280px;
            right: -70px;
            top: -70px;
            background: var(--secondary);
        }

        .hero-section::after {
            width: 200px;
            height: 200px;
            left: -40px;
            bottom: -40px;
            background: var(--primary);
            animation-duration: 10s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) scale(1); }
            50% { transform: translateY(-18px) scale(1.04); }
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            background: rgba(255, 255, 255, 0.14);
            border: 1px solid rgba(255, 255, 255, 0.18);
            padding: 0.7rem 1rem;
            border-radius: 999px;
            font-size: 0.92rem;
            margin-bottom: 1.25rem;
            font-weight: 600;
        }

        .hero-title {
            font-size: clamp(2.1rem, 4vw, 3.8rem);
            line-height: 1.08;
            font-family: 'Manrope', sans-serif;
            font-weight: 800;
            margin-bottom: 1rem;
        }

        .hero-copy {
            font-size: 1.02rem;
            line-height: 1.8;
            max-width: 680px;
            color: rgba(255, 255, 255, 0.87);
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.9rem;
            margin-top: 1.7rem;
        }

        .hero-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 0.7rem;
            margin-top: 1.4rem;
        }

        .hero-badges .badge-item {
            background: rgba(255, 255, 255, 0.14);
            border: 1px solid rgba(255, 255, 255, 0.16);
            color: var(--white);
            padding: 0.7rem 0.95rem;
            border-radius: 999px;
            font-size: 0.9rem;
            backdrop-filter: blur(10px);
        }

        .hero-card {
            background: linear-gradient(145deg, rgba(255,255,255,0.16), rgba(255,255,255,0.08));
            border: 1px solid var(--border);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 1.5rem;
            box-shadow: var(--shadow);
            position: relative;
        }

        .hero-card .glass-title {
            font-size: 1rem;
            color: rgba(255,255,255,0.78);
            margin-bottom: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
        }

        .hero-card .monitor-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: grid;
            gap: 0.75rem;
        }

        .hero-card .monitor-list li {
            padding: 0.9rem 1rem;
            border-radius: 16px;
            background: rgba(255,255,255,0.11);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: var(--white);
        }

        .section-block {
            padding: 5rem 0;
        }

        .section-title {
            font-size: 1.95rem;
            font-family: 'Manrope', sans-serif;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 0.9rem;
        }

        .section-subtitle {
            color: #57757a;
            max-width: 720px;
            line-height: 1.8;
            margin-bottom: 2rem;
        }

        .card-soft {
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(40, 95, 107, 0.12);
            box-shadow: 0 15px 30px rgba(19, 51, 54, 0.08);
            border-radius: 22px;
            padding: 1.4rem;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            height: 100%;
        }

        .card-soft:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(19, 51, 54, 0.12);
        }

        .icon-pill {
            width: 46px;
            height: 46px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: var(--white);
            margin-bottom: 1rem;
            font-size: 1.15rem;
        }

        .stat-card {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: var(--white);
            border-radius: 24px;
            padding: 1.4rem;
            box-shadow: var(--shadow);
            min-height: 150px;
        }

        .stat-card h3 {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 0.4rem;
        }

        .pill-tag {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: rgba(40, 95, 107, 0.1);
            color: var(--primary);
            border-radius: 999px;
            padding: 0.5rem 0.8rem;
            font-size: 0.84rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .project-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 18px;
            margin-bottom: 1rem;
        }

        .timeline-list {
            display: grid;
            gap: 0.8rem;
            padding-left: 0;
            list-style: none;
        }

        .timeline-list li {
            display: flex;
            gap: 0.7rem;
            align-items: flex-start;
            color: #486468;
        }

        .timeline-list li::before {
            content: "•";
            color: var(--secondary);
            font-size: 1.2rem;
            line-height: 1.1;
        }

        .faq-item {
            border: 1px solid rgba(40, 95, 107, 0.12);
            border-radius: 16px;
            padding: 1rem 1.1rem;
            background: var(--white);
            box-shadow: 0 10px 24px rgba(19, 51, 54, 0.05);
        }

        .faq-item button {
            width: 100%;
            border: 0;
            background: transparent;
            text-align: left;
            color: var(--dark);
            font-weight: 700;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .faq-answer {
            display: none;
            margin-top: 0.8rem;
            color: #60767a;
            line-height: 1.8;
        }

        .faq-item.active .faq-answer {
            display: block;
        }

        .contact-card {
            background: linear-gradient(135deg, rgba(19, 51, 54, 0.95), rgba(40, 95, 107, 0.95));
            color: var(--white);
            border-radius: 24px;
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .map-placeholder {
            background: linear-gradient(135deg, rgba(255,255,255,0.18), rgba(255,255,255,0.08));
            border: 1px solid rgba(255,255,255,0.16);
            border-radius: 20px;
            height: 240px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 1.5rem;
            color: var(--white);
            backdrop-filter: blur(10px);
        }

        .footer {
            background: var(--black);
            color: rgba(255,255,255,0.78);
            padding: 2rem 0;
        }

        .footer a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
        }

        .reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: all 0.7s ease;
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        @media (max-width: 991px) {
            .top-nav {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                flex-direction: column;
                background: rgba(19, 51, 54, 0.98);
                padding: 1rem 1.2rem;
                display: none;
                border-top: 1px solid rgba(255,255,255,0.1);
            }

            .top-nav.show {
                display: flex;
            }

            .mobile-toggle {
                display: block;
            }
        }

        @media (max-width: 767px) {
            .hero-section {
                padding: 4rem 0 3rem;
            }

            .section-block {
                padding: 4rem 0;
            }

            .hero-title {
                font-size: 2.2rem;
            }

            .topbar .container {
                padding: 0.9rem 0;
            }
        }
    </style>
</head>
<body>
    <header class="topbar">
        <div class="container">
            <a class="brand" href="#hero">
                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 220 220'%3E%3Crect width='220' height='220' rx='36' fill='%23285F6B'/%3E%3Crect x='26' y='26' width='168' height='168' rx='28' fill='%23367D8A'/%3E%3Cpath d='M74 152V70h28c22 0 38 10 38 30 0 14-8 24-21 28l21 24h-24l-24-32h-12v32H74Zm20-20h10c10 0 15-5 15-12s-5-12-15-12h-10v24Z' fill='white'/%3E%3C/svg%3E" alt="Ahmednagar Connect logo">
                <span>
                    <strong>Ahmednagar Connect</strong>
                    <span>Rural Infrastructure Monitoring System</span>
                </span>
            </a>
            <button class="mobile-toggle" type="button" aria-label="Toggle navigation">
                <i class="bi bi-list"></i>
            </button>
            <nav class="top-nav" id="topNav">
                <a href="#about">About</a>
                <a href="#features">Features</a>
                <a href="#projects">Projects</a>
                <a href="#gallery">Gallery</a>
                <a href="#faq">FAQ</a>
                <a href="#contact">Contact</a>
                <a href="login.php" class="btn-pill btn-outline-custom">Login Portal</a>
            </nav>
        </div>
    </header>

    <main>
        <section class="hero-section" id="hero">
            <div class="container">
                <div class="row align-items-center g-5">
                    <div class="col-lg-7 reveal">
                        <div class="eyebrow"><i class="bi bi-shield-check"></i> Government Digital Governance Platform</div>
                        <h1 class="hero-title">Smarter rural infrastructure stewardship for every district and village.</h1>
                        <p class="hero-copy">Ahmednagar Connect brings a premium digital experience to monitor roads, schools, water supply, drainage, and public buildings with transparent progress updates, live accountability, and modern public oversight.</p>
                        <div class="hero-actions">
                            <a href="#projects" class="btn-pill btn-primary-custom">Explore Infrastructure</a>
                            <a href="#contact" class="btn-pill btn-outline-custom">Request Support</a>
                        </div>
                        <div class="hero-badges">
                            <span class="badge-item"><i class="bi bi-geo-alt-fill"></i> 260+ Villages</span>
                            <span class="badge-item"><i class="bi bi-bar-chart-line-fill"></i> Real-time Reports</span>
                            <span class="badge-item"><i class="bi bi-people-fill"></i> Public Transparency</span>
                        </div>
                    </div>
                    <div class="col-lg-5 reveal">
                        <div class="hero-card">
                            <div class="glass-title">Live Monitoring View</div>
                            <ul class="monitor-list">
                                <li><i class="bi bi-signpost-split-fill"></i> 137 roads under active inspection</li>
                                <li><i class="bi bi-building-fill"></i> 89 public buildings verified</li>
                                <li><i class="bi bi-droplet-fill"></i> 54 water networks optimised</li>
                                <li><i class="bi bi-brightness-high-fill"></i> 18 public works flagged</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-block" id="about">
            <div class="container">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6 reveal">
                        <div class="pill-tag"><i class="bi bi-columns-gap"></i> About the Portal</div>
                        <h2 class="section-title">A modern public infrastructure command center for disciplined governance.</h2>
                        <p class="section-subtitle">Built for government departments and public oversight teams, Ahmednagar Connect offers a premium experience for monitoring civic progress, verifying work quality, and ensuring timely completion across all rural infrastructure categories.</p>
                        <ul class="timeline-list">
                            <li>Unified project visibility spanning roads, schools, water, drainage, and public assets.</li>
                            <li>Structured compliance and verification workflow for department teams and auditors.</li>
                            <li>Elegant digital communication for notices, progress updates, and district-level awareness.</li>
                        </ul>
                    </div>
                    <div class="col-lg-6 reveal">
                        <div class="row g-4">
                            <div class="col-6">
                                <div class="card-soft">
                                    <div class="icon-pill"><i class="bi bi-bullseye"></i></div>
                                    <h4>Objectives</h4>
                                    <p>Strengthen delivery, accountability, and visible public progress through a single digital interface.</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card-soft">
                                    <div class="icon-pill"><i class="bi bi-lightning-charge"></i></div>
                                    <h4>Mission</h4>
                                    <p>Upgrade infrastructure oversight using digital transparency, visual analytics, and rapid response systems.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-block" style="background: linear-gradient(180deg, rgba(40,95,107,0.04), rgba(255,255,255,0));">
            <div class="container">
                <div class="text-center reveal">
                    <div class="pill-tag"><i class="bi bi-stars"></i> Key Features</div>
                    <h2 class="section-title">A premium digital experience for public infrastructure monitoring.</h2>
                    <p class="section-subtitle mx-auto">The portal is designed to feel refined, trusted, and operationally strong — balancing attractive presentation with clear civic utility.</p>
                </div>
                <div class="row g-4 mt-2">
                    <div class="col-lg-4 col-md-6 reveal">
                        <div class="card-soft">
                            <div class="icon-pill"><i class="bi bi-speedometer2"></i></div>
                            <h4>Live Dashboard</h4>
                            <p>Track project health, district priorities, and status indicators with a polished administrative view.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 reveal">
                        <div class="card-soft">
                            <div class="icon-pill"><i class="bi bi-check2-square"></i></div>
                            <h4>Verification Flow</h4>
                            <p>Manage milestone approvals and work validation through a guided and structured interface.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 reveal">
                        <div class="card-soft">
                            <div class="icon-pill"><i class="bi bi-bell-fill"></i></div>
                            <h4>Alerts & Updates</h4>
                            <p>Deliver immediate notices, operational updates, and important government communications in style.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 reveal">
                        <div class="card-soft">
                            <div class="icon-pill"><i class="bi bi-file-earmark-bar-graph"></i></div>
                            <h4>Reports & Analytics</h4>
                            <p>Present district-level insights, trends, and summaries through a credible digital reporting layer.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 reveal">
                        <div class="card-soft">
                            <div class="icon-pill"><i class="bi bi-images"></i></div>
                            <h4>Visual Gallery</h4>
                            <p>Showcase progress photographs, completed works, and public project milestones with elegance.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 reveal">
                        <div class="card-soft">
                            <div class="icon-pill"><i class="bi bi-headset"></i></div>
                            <h4>Support Concierge</h4>
                            <p>Provide a premium support experience through contact, help, and responsive public communication.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-block">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-3 col-md-6 reveal">
                        <div class="stat-card">
                            <div class="pill-tag" style="background: rgba(255,255,255,0.16); color: #fff;">Projects</div>
                            <h3>248</h3>
                            <p>District-wide active initiatives tracked</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 reveal">
                        <div class="stat-card">
                            <div class="pill-tag" style="background: rgba(255,255,255,0.16); color: #fff;">Completion</div>
                            <h3>76%</h3>
                            <p>Average progress across monitored works</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 reveal">
                        <div class="stat-card">
                            <div class="pill-tag" style="background: rgba(255,255,255,0.16); color: #fff;">Verification</div>
                            <h3>1.2K</h3>
                            <p>Milestones reviewed and approved</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 reveal">
                        <div class="stat-card">
                            <div class="pill-tag" style="background: rgba(255,255,255,0.16); color: #fff;">Response</div>
                            <h3>24/7</h3>
                            <p>Operational support visibility and updates</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-block" id="projects">
            <div class="container">
                <div class="text-center reveal">
                    <div class="pill-tag"><i class="bi bi-diagram-3-fill"></i> Project Categories</div>
                    <h2 class="section-title">Infrastructure monitoring across civic essentials.</h2>
                    <p class="section-subtitle mx-auto">Every project category is represented with a strong modern interface, making public assets and district priorities easier to track and communicate.</p>
                </div>
                <div class="row g-4 mt-2">
                    <div class="col-lg-4 col-md-6 reveal">
                        <div class="card-soft project-card">
                            <img src="https://images.unsplash.com/photo-1500375592092-40eb2168fd21?auto=format&fit=crop&w=900&q=80" alt="Road infrastructure monitoring">
                            <h4>Roads</h4>
                            <p>Monitor road quality, drainage integration, and connectivity improvements across rural corridors.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 reveal">
                        <div class="card-soft project-card">
                            <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=900&q=80" alt="School infrastructure">
                            <h4>Schools</h4>
                            <p>Track classroom upgrades, sanitation improvements, and public education facility readiness.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 reveal">
                        <div class="card-soft project-card">
                            <img src="https://images.unsplash.com/photo-1581578017437-5fe3f98f5d2e?auto=format&fit=crop&w=900&q=80" alt="Water supply system">
                            <h4>Water Supply</h4>
                            <p>Review water line installation, storage capacity, and service continuity at village level.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 reveal">
                        <div class="card-soft project-card">
                            <img src="https://images.unsplash.com/photo-1519452575417-920b9392f7db?auto=format&fit=crop&w=900&q=80" alt="Drainage infrastructure">
                            <h4>Drainage</h4>
                            <p>Archive flood resilience work, drainage layouts, and sanitation project conditions.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 reveal">
                        <div class="card-soft project-card">
                            <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=900&q=80" alt="Public building infrastructure">
                            <h4>Public Buildings</h4>
                            <p>Monitor civic facilities, administrative centres, and welfare infrastructure improvements.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 reveal">
                        <div class="card-soft project-card">
                            <img src="https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=900&q=80" alt="Government infrastructure overview">
                            <h4>Infrastructure Monitoring</h4>
                            <p>Bring every sector into one refined portal where officials and citizens can understand progress.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-block" id="gallery" style="background: linear-gradient(180deg, rgba(19,51,54,0.03), rgba(255,255,255,0));">
            <div class="container">
                <div class="text-center reveal">
                    <div class="pill-tag"><i class="bi bi-images"></i> Gallery & Progress</div>
                    <h2 class="section-title">Visual documentation of rural upliftment.</h2>
                    <p class="section-subtitle mx-auto">From completed works to active site visits, the gallery section offers a polished visual narrative of public infrastructure progress.</p>
                </div>
                <div class="row g-4 mt-2">
                    <div class="col-lg-4 reveal">
                        <div class="card-soft">
                            <img src="https://images.unsplash.com/photo-1497366754035-f200968a6e72?auto=format&fit=crop&w=900&q=80" alt="Infrastructure progress gallery" style="height:220px; width:100%; object-fit:cover; border-radius:18px; margin-bottom:1rem;">
                            <h4>Road Rehabilitation</h4>
                            <p>Completed segment with improved safety, drainage integration, and public usability.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 reveal">
                        <div class="card-soft">
                            <img src="https://images.unsplash.com/photo-1460317442991-0ec209397118?auto=format&fit=crop&w=900&q=80" alt="Water supply infrastructure gallery" style="height:220px; width:100%; object-fit:cover; border-radius:18px; margin-bottom:1rem;">
                            <h4>Water Supply Upgrade</h4>
                            <p>Village network improvements and storage enhancement visualised clearly for citizens.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 reveal">
                        <div class="card-soft">
                            <img src="https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&w=900&q=80" alt="Community facility gallery" style="height:220px; width:100%; object-fit:cover; border-radius:18px; margin-bottom:1rem;">
                            <h4>Community Facility</h4>
                            <p>Public building upliftment and maintenance activity reflected in an elegant gallery view.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-block">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-6 reveal">
                        <div class="card-soft">
                            <div class="pill-tag"><i class="bi bi-newspaper"></i> Latest Updates</div>
                            <h3 class="section-title" style="font-size: 1.5rem;">Official notices and public communication</h3>
                            <ul class="timeline-list">
                                <li><strong>July 20</strong> — District monitoring review scheduled for three priority clusters.</li>
                                <li><strong>July 15</strong> — New inspection checklist introduced for school infrastructure reporting.</li>
                                <li><strong>July 10</strong> — Water supply verification campaign launched with public visibility updates.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 reveal">
                        <div class="card-soft">
                            <div class="pill-tag"><i class="bi bi-megaphone"></i> Notices</div>
                            <h3 class="section-title" style="font-size: 1.5rem;">Important advisories</h3>
                            <ul class="timeline-list">
                                <li>Temporary site access update for selected district work zones.</li>
                                <li>Quarterly progress report submission window now open.</li>
                                <li>Department support email enabled for project coordination requests.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-block" id="faq">
            <div class="container">
                <div class="text-center reveal">
                    <div class="pill-tag"><i class="bi bi-question-circle"></i> FAQ</div>
                    <h2 class="section-title">Common questions answered with clarity.</h2>
                    <p class="section-subtitle mx-auto">The portal is designed to be intuitive for officials, administrators, and public stakeholders alike.</p>
                </div>
                <div class="row g-4 mt-2">
                    <div class="col-lg-6 reveal">
                        <div class="faq-item active">
                            <button type="button" class="faq-toggle">What is Ahmednagar Connect?<span><i class="bi bi-chevron-down"></i></span></button>
                            <div class="faq-answer">It is a premium government-facing portal for monitoring rural infrastructure projects through a refined digital experience.</div>
                        </div>
                    </div>
                    <div class="col-lg-6 reveal">
                        <div class="faq-item">
                            <button type="button" class="faq-toggle">Who can use it?<span><i class="bi bi-chevron-down"></i></span></button>
                            <div class="faq-answer">The interface is intended for departments, field teams, administrators, and authorized stakeholders.</div>
                        </div>
                    </div>
                    <div class="col-lg-6 reveal">
                        <div class="faq-item">
                            <button type="button" class="faq-toggle">What categories are covered?<span><i class="bi bi-chevron-down"></i></span></button>
                            <div class="faq-answer">Roads, schools, water supply, drainage, and public buildings are all represented within the portal.</div>
                        </div>
                    </div>
                    <div class="col-lg-6 reveal">
                        <div class="faq-item">
                            <button type="button" class="faq-toggle">Is the platform suitable for public communication?<span><i class="bi bi-chevron-down"></i></span></button>
                            <div class="faq-answer">Yes, it supports notices, updates, progress highlights, and clearer citizen-facing communication.</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-block" id="contact">
            <div class="container">
                <div class="contact-card reveal">
                    <div class="row g-0">
                        <div class="col-lg-7 p-4 p-lg-5">
                            <div class="pill-tag" style="background: rgba(255,255,255,0.16); color: #fff;">Contact & Support</div>
                            <h2 class="section-title" style="color: #fff; font-size: 1.7rem;">Official support and coordination assistance</h2>
                            <p style="color: rgba(255,255,255,0.85); line-height: 1.8;">Reach out for public support, technical assistance, verification requests, or district engagement. The contact section is presented with the same premium governance experience as the rest of the portal.</p>
                            <ul class="timeline-list" style="color: rgba(255,255,255,0.88); margin-top: 1rem;">
                                <li><i class="bi bi-envelope-fill"></i> support@ahmadnagarconnect.gov.in</li>
                                <li><i class="bi bi-telephone-fill"></i> +91 0241 224 0000</li>
                                <li><i class="bi bi-geo-alt-fill"></i> District Administration Office, Ahmednagar</li>
                            </ul>
                        </div>
                        <div class="col-lg-5 p-4 p-lg-5">
                            <div class="map-placeholder">
                                <div>
                                    <i class="bi bi-map-fill" style="font-size: 2rem; margin-bottom: 0.7rem; display: block;"></i>
                                    <strong>Google Map Placeholder</strong>
                                    <p class="mb-0">Interactive district map section will be integrated in the next phase.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container">
            <div class="row align-items-center g-3">
                <div class="col-md-6">
                    <p class="mb-0">© 2026 Ahmednagar Connect. Government Digital Infrastructure Portal.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#">Privacy Policy</a> · <a href="#">Terms</a> · <a href="#">Version 1.0</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const toggle = document.querySelector('.mobile-toggle');
        const nav = document.getElementById('topNav');
        if (toggle && nav) {
            toggle.addEventListener('click', () => nav.classList.toggle('show'));
            document.querySelectorAll('#topNav a').forEach(link => {
                link.addEventListener('click', () => nav.classList.remove('show'));
            });
        }

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.12 });

        document.querySelectorAll('.reveal').forEach(item => observer.observe(item));

        document.querySelectorAll('.faq-toggle').forEach(button => {
            button.addEventListener('click', () => {
                const item = button.closest('.faq-item');
                document.querySelectorAll('.faq-item').forEach(box => {
                    if (box !== item) box.classList.remove('active');
                });
                item.classList.toggle('active');
            });
        });
    </script>
</body>
</html>
