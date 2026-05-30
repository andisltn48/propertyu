@extends('layouts.public')

@section('title', 'Articles — PropertyU')
@section('description', 'Baca artikel dan berita terbaru seputar properti, hunian, dan investasi dari PropertyU.')
@section('og_title', 'Articles — PropertyU')

@push('head')
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
            --muted: #6B6B6B;
            --border: #E5DDD4;
            --shadow-sm: 0 4px 20px rgba(26, 30, 30, 0.04);
            --shadow-md: 0 8px 40px rgba(26, 30, 30, 0.06);
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

        /* ─── Articles Grid ─── */
        .articles-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 28px;
            margin-bottom: 60px;
        }

        .article-card {
            background: var(--ivory);
            border-radius: 24px;
            overflow: hidden;
            border: 1px solid var(--border);
            text-decoration: none;
            display: block;
            box-shadow: var(--shadow-sm);
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .article-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-md);
            border-color: var(--gold-light);
        }

        .article-thumb {
            aspect-ratio: 16/9;
            background: var(--cream);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--border);
            overflow: hidden;
        }

        .article-thumb svg {
            width: 48px;
            height: 48px;
            opacity: 0.4;
        }

        .article-body {
            padding: 28px;
        }

        .article-category {
            display: inline-block;
            font-size: 0.6rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 10px;
        }

        .article-body h3 {
            font-size: 1.15rem;
            font-weight: 600;
            letter-spacing: -0.3px;
            color: var(--charcoal);
            margin-bottom: 12px;
            line-height: 1.3;
            transition: color 0.3s;
        }

        .article-card:hover .article-body h3 { color: var(--gold-dark); }

        .article-excerpt {
            font-size: 0.85rem;
            color: var(--muted);
            line-height: 1.65;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .article-meta {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 16px;
            font-size: 0.75rem;
            color: var(--muted);
        }

        .article-meta svg { width: 14px; height: 14px; opacity: 0.5; }
        .article-meta span { display: flex; align-items: center; gap: 4px; }

        /* ─── Pagination ─── */
        .pagination-wrap {
            display: flex;
            justify-content: center;
            gap: 8px;
            padding-bottom: 100px;
        }

        .pagination-wrap a, .pagination-wrap span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 44px;
            height: 44px;
            padding: 0 16px;
            border-radius: 100px;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            border: 1.5px solid var(--border);
            color: var(--muted);
            transition: all 0.3s;
        }

        .pagination-wrap a:hover {
            border-color: var(--gold);
            color: var(--charcoal);
            background: rgba(184, 145, 74, 0.05);
        }

        .pagination-wrap span:first-child,
        .pagination-wrap span:last-child {
            border-color: transparent;
            color: var(--muted);
        }

        .pagination-wrap .active {
            background: var(--charcoal);
            border-color: var(--charcoal);
            color: white;
        }

        @media (max-width: 1024px) {
            .articles-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 640px) {
            .articles-grid { grid-template-columns: 1fr; }
            .article-body { padding: 20px; }
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

        /* ─── Animations ─── */
        .reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        .reveal.active { opacity: 1; transform: translateY(0); }
    </style>
@endpush

@section('content')
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

    <main>
        <div class="container">
            <header class="page-header">
                <span class="page-tag">Wawasan & Inspirasi</span>
                <h1 class="page-title">Articles.</h1>
                <p class="page-sub">Artikel dan wawasan seputar arsitektur, properti, dan hunian masa depan.</p>
            </header>

            <div class="articles-grid">
                @forelse($articles as $article)
                <a href="{{ route('public.articles.detail', $article) }}" class="article-card reveal">
                    <div class="article-thumb">
                        <svg fill="none" stroke="currentColor" stroke-width="1.2" viewBox="0 0 24 24">
                            <path d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                    </div>
                    <div class="article-body">
                        <span class="article-category">{{ $article->category }}</span>
                        <h3>{{ $article->title }}</h3>
                        <p class="article-excerpt">{{ Str::limit(strip_tags($article->content), 140) }}</p>
                        <div class="article-meta">
                            <span>
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ \Carbon\Carbon::parse($article->published_at)->translatedFormat('d F Y') }}
                            </span>
                        </div>
                    </div>
                </a>
                @empty
                <div class="col-span-full text-center py-20" style="color: var(--muted);">
                    <p>No articles published yet.</p>
                </div>
                @endforelse
            </div>

            <div class="pagination-wrap">
                {{ $articles->links() }}
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <div class="footer-inner">
                <span class="footer-brand">Property<span>U</span>.</span>
                <span class="footer-copy">&copy; {{ date('Y') }} PropertyU. All Rights Reserved.</span>
            </div>
        </div>
    </footer>

    <script>
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('active');
            });
        }, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });
        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('nav-scrolled', window.scrollY > 60);
        });
    </script>
@endsection
