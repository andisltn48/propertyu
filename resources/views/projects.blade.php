<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio — PropertyU</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Akt:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        :root {
            --cream: #F6F3EF;
            --ivory: #FDFBF9;
            --charcoal: #1C1C1C;
            --gold: #B8914A;
            --gold-light: #D4B87A;
            --gold-dark: #8E6F36;
            --teal: #1A2E2A;
            --muted: #6B6B6B;
            --border: #E5DDD4;
            --shadow-sm: 0 4px 20px rgba(26, 30, 30, 0.04);
            --shadow-md: 0 8px 40px rgba(26, 30, 30, 0.06);
            --shadow-lg: 0 25px 60px rgba(26, 30, 30, 0.08);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Akt', sans-serif;
            background: var(--cream);
            color: var(--charcoal);
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }

        ::selection { background: var(--gold); color: white; }

        h1, h2, h3 { font-family: 'Akt', sans-serif; font-weight: 600; color: var(--charcoal); }

        .container { max-width: 1280px; margin: 0 auto; padding: 0 48px; }
        @media (max-width: 768px) { .container { padding: 0 24px; } }

        /* ─── Navigation ─── */
        nav {
            position: fixed; top: 0; left: 0; right: 0;
            z-index: 100;
            padding: 18px 0;
            background: rgba(246, 243, 239, 0.82);
            backdrop-filter: blur(24px) saturate(1.4);
            -webkit-backdrop-filter: blur(24px) saturate(1.4);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            transition: padding 0.3s;
        }
        .nav-scrolled { padding: 10px 0; }

        .nav-inner { display: flex; justify-content: space-between; align-items: center; }

        .logo {
            font-family: 'Akt', sans-serif;
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--charcoal);
            text-decoration: none;
            letter-spacing: -1px;
        }
        .logo span { color: var(--gold); }

        .nav-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--muted);
            text-decoration: none;
            padding: 8px 18px;
            border-radius: 100px;
            border: 1px solid var(--border);
            transition: all 0.3s;
        }
        .nav-back:hover {
            border-color: var(--gold);
            color: var(--charcoal);
            background: rgba(184, 145, 74, 0.06);
        }
        .nav-back svg { transition: transform 0.3s; }
        .nav-back:hover svg { transform: translateX(-3px); }

        /* ─── Header ─── */
        .page-header {
            padding: 140px 0 60px;
            text-align: center;
        }

        .page-tag {
            display: inline-block;
            font-family: 'Akt', sans-serif;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 20px;
        }

        .page-title {
            font-size: clamp(2.8rem, 6vw, 4.5rem);
            letter-spacing: -2px;
            line-height: 1.05;
            margin-bottom: 16px;
        }

        .page-sub {
            color: var(--muted);
            font-size: 1.05rem;
            max-width: 520px;
            margin: 0 auto;
        }

        /* ─── Search ─── */
        .search-wrap {
            max-width: 560px;
            margin: 0 auto 72px;
            position: relative;
        }

        .search-icon {
            position: absolute;
            left: 24px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gold);
            pointer-events: none;
            z-index: 2;
        }

        .search-input {
            width: 100%;
            padding: 18px 24px 18px 60px;
            border-radius: 100px;
            border: 1.5px solid var(--border);
            background: var(--ivory);
            font-family: 'Akt', sans-serif;
            font-size: 0.95rem;
            outline: none;
            transition: all 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            color: var(--charcoal);
        }

        .search-input::placeholder { color: var(--muted); opacity: 0.6; }

        .search-input:focus {
            border-color: var(--gold);
            box-shadow: 0 20px 50px -10px rgba(184, 145, 74, 0.12);
            transform: translateY(-2px);
            background: white;
        }

        /* ─── Project Grid ─── */
        .project-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 28px;
            margin-bottom: 80px;
        }

        .project-card {
            position: relative;
            border-radius: 24px;
            overflow: hidden;
            aspect-ratio: 4/5;
            background: var(--ivory);
            text-decoration: none;
            display: block;
            opacity: 0;
            transform: translateY(24px);
            transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            box-shadow: var(--shadow-sm);
        }

        .project-card.active {
            opacity: 1;
            transform: translateY(0);
        }

        .project-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .project-card:hover img { transform: scale(1.06); }

        .project-overlay {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            padding: 36px 32px;
            background: linear-gradient(transparent 20%, rgba(26, 30, 30, 0.88) 100%);
            color: #fff;
        }

        .project-overlay .tagline {
            font-family: 'Akt', sans-serif;
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--gold-light);
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 8px;
        }

        .project-overlay h3 {
            font-family: 'Akt', sans-serif;
            font-size: 1.5rem;
            font-weight: 600;
            color: #fff;
            letter-spacing: -0.5px;
        }

        .badge-3d {
            position: absolute;
            top: 16px;
            right: 16px;
            z-index: 5;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 14px;
            background: rgba(26, 30, 30, 0.55);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 100px;
            color: #fff;
            font-size: 0.68rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            opacity: 0;
            transition: all 0.3s;
            cursor: pointer;
        }

        .badge-3d svg { width: 14px; height: 14px; }

        .project-card:hover .badge-3d { opacity: 1; }
        .badge-3d:hover {
            background: rgba(184, 145, 74, 0.25);
            border-color: var(--gold-light);
        }

        /* ─── Empty State ─── */
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 80px 20px;
            color: var(--muted);
        }

        .empty-state svg {
            width: 48px;
            height: 48px;
            margin: 0 auto 20px;
            color: var(--border);
        }

        /* ─── Loading ─── */
        #loading {
            text-align: center;
            padding: 40px 0 80px;
            display: none;
        }

        .loading-dots {
            display: inline-flex;
            gap: 8px;
            align-items: center;
            color: var(--muted);
            font-size: 0.85rem;
            font-weight: 500;
        }

        .loading-dots span {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--gold);
            animation: dotPulse 1.4s ease-in-out infinite;
        }

        .loading-dots span:nth-child(2) { animation-delay: 0.2s; }
        .loading-dots span:nth-child(3) { animation-delay: 0.4s; }

        @keyframes dotPulse {
            0%, 80%, 100% { opacity: 0.2; transform: scale(0.8); }
            40% { opacity: 1; transform: scale(1); }
        }

        /* ─── Footer ─── */
        footer {
            border-top: 1px solid var(--border);
            background: var(--ivory);
        }
        .footer-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 32px 0;
            flex-wrap: wrap;
            gap: 16px;
        }
        .footer-brand {
            font-family: 'Akt', sans-serif;
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--charcoal);
        }
        .footer-brand span { color: var(--gold); }
        .footer-copy { font-size: 0.85rem; color: var(--muted); }
        @media (max-width: 640px) {
            .footer-inner { flex-direction: column; text-align: center; }
        }

        /* ─── Responsive Grid ─── */
        @media (max-width: 1024px) {
            .project-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 640px) {
            .project-grid { grid-template-columns: 1fr; gap: 20px; }
            .project-overlay { padding: 28px 24px; }
            .project-overlay h3 { font-size: 1.3rem; }
        }
    </style>
</head>
<body>

    {{-- Navigation --}}
    <nav id="navbar">
        <div class="container">
            <div class="nav-inner">
                <a href="{{ url('/') }}" class="logo">Property<span>U</span>.</a>
                <a href="{{ url('/') }}" class="nav-back">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="14" height="14">
                        <path d="M19 12H5m0 0l6-6m-6 6l6 6"/>
                    </svg>
                    Back to Home
                </a>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main>
        <div class="container">
            <header class="page-header">
                <span class="page-tag">Our Work</span>
                <h1 class="page-title">Portfolio.</h1>
                <p class="page-sub">Our visionary architecture projects across the country.</p>
            </header>

            <div class="search-wrap">
                <svg class="search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" width="20" height="20">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" id="searchInput" class="search-input" placeholder="Search property by name...">
            </div>

            <div id="project-container" class="project-grid">
                @include('partials.project-items', ['projects' => $projects])
            </div>

            <div id="loading">
                <div class="loading-dots">
                    <span></span><span></span><span></span>
                    &nbsp; Discovering more projects...
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <div class="footer-inner">
                <span class="footer-brand">Property<span>U</span>.</span>
                <span class="footer-copy">&copy; {{ date('Y') }} PropertyU. Architecture Archives.</span>
            </div>
        </div>
    </footer>

    <script>
        let page = 1;
        let loading = false;
        let hasMore = {{ $projects->hasMorePages() ? 'true' : 'false' }};
        let searchQuery = '';

        const container = document.getElementById('project-container');
        const loadingEl = document.getElementById('loading');
        const searchInput = document.getElementById('searchInput');

        function animateItems() {
            const items = document.querySelectorAll('.project-card:not(.active)');
            items.forEach((item, index) => {
                setTimeout(() => {
                    item.classList.add('active');
                }, index * 100);
            });
        }

        async function loadProjects(reset = false) {
            if (loading) return;
            if (reset) {
                page = 1;
                hasMore = true;
                container.innerHTML = '';
            }
            if (!hasMore) return;

            loading = true;
            loadingEl.style.display = 'block';

            try {
                const response = await fetch(`{{ route('public.projects') }}?page=${page}&search=${searchQuery}`, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                const html = await response.text();

                if (html.trim() === "") {
                    hasMore = false;
                    if (reset) {
                        container.innerHTML = `
                            <div class="empty-state">
                                <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                <p>No projects match your search.</p>
                            </div>`;
                    }
                } else {
                    container.insertAdjacentHTML('beforeend', html);
                    animateItems();
                    if (html.split('project-card').length - 1 < 9) hasMore = false;
                }
            } catch (error) {
                console.error("Failed to load projects", error);
            } finally {
                loading = false;
                loadingEl.style.display = 'none';
            }
        }

        let searchTimeout;
        searchInput.addEventListener('input', (e) => {
            clearTimeout(searchTimeout);
            searchQuery = e.target.value;
            searchTimeout = setTimeout(() => {
                loadProjects(true);
            }, 500);
        });

        const scrollObserver = new IntersectionObserver((entries) => {
            if (entries[0].isIntersecting && !loading && hasMore) {
                page++;
                loadProjects();
            }
        }, { threshold: 0.1 });

        scrollObserver.observe(loadingEl);

        document.addEventListener('DOMContentLoaded', animateItems);

        // Navbar shrink
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('nav-scrolled', window.scrollY > 60);
        });
    </script>

</body>
</html>
