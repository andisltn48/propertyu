@extends('layouts.public')

@section('title')
    {{ $article->title }} — PropertyU
@endsection
@section('description')
    {{ $article->content ? Str::limit(strip_tags($article->content), 160) : 'Baca artikel properti lengkap di PropertyU.' }}
@endsection
@section('og_title')
    {{ $article->title }} — PropertyU
@endsection

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
            --teal: #1A2E2A;
            --muted: #6B6B6B;
            --border: #E5DDD4;
            --shadow-card: 0 8px 40px rgba(26, 30, 30, 0.06);
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

        h1, h2, h3, h4 {
            font-family: 'Akt', sans-serif;
            font-weight: 600;
            color: var(--charcoal);
        }

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

        /* ─── Hero Article ─── */
        .article-hero {
            margin-top: 80px;
            padding: 80px 0 60px;
        }

        .article-category {
            display: inline-block;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 20px;
        }

        .article-title {
            font-size: clamp(2.2rem, 5vw, 3.5rem);
            letter-spacing: -2px;
            line-height: 1.1;
            margin-bottom: 20px;
            max-width: 840px;
        }

        .article-meta-bar {
            display: flex;
            align-items: center;
            gap: 24px;
            color: var(--muted);
            font-size: 0.85rem;
            flex-wrap: wrap;
        }

        .article-meta-bar span {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .article-meta-bar svg {
            width: 16px;
            height: 16px;
            opacity: 0.5;
        }

        .divider-line {
            border: none;
            border-top: 1px solid var(--border);
            margin-top: 40px;
        }

        /* ─── Content ─── */
        .content-wrap {
            max-width: 780px;
            margin: 0 auto;
            padding-bottom: 100px;
        }

        .article-body {
            font-size: 1.05rem;
            line-height: 1.9;
            color: var(--muted);
        }

        .article-body h2, .article-body h3 {
            color: var(--charcoal);
            margin: 48px 0 16px;
            letter-spacing: -0.5px;
        }
        .article-body h2 { font-size: 1.6rem; }
        .article-body h3 { font-size: 1.2rem; }
        .article-body p { margin-bottom: 24px; }
        .article-body ul, .article-body ol { padding-left: 24px; margin-bottom: 24px; }
        .article-body li { margin-bottom: 8px; }
        .article-body img {
            border-radius: 20px;
            margin: 40px 0;
            width: 100%;
            box-shadow: var(--shadow-card);
        }
        .article-body a {
            color: var(--gold-dark);
            text-decoration: underline;
            text-underline-offset: 3px;
        }
        .article-body a:hover { color: var(--gold); }
        .article-body blockquote {
            border-left: 3px solid var(--gold);
            padding: 4px 0 4px 24px;
            margin: 36px 0;
            font-style: italic;
            font-size: 1.1rem;
            color: var(--charcoal);
        }

        /* ─── Related Articles ─── */
        .related-section {
            border-top: 1px solid var(--border);
            background: var(--ivory);
            padding: 80px 0 100px;
        }

        .related-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 28px;
            margin-top: 48px;
        }

        .related-card {
            background: var(--cream);
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid var(--border);
            text-decoration: none;
            display: block;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .related-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-card);
            border-color: var(--gold-light);
        }

        .related-body {
            padding: 24px;
        }

        .related-body .cat {
            font-size: 0.6rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--gold);
        }

        .related-body h3 {
            font-size: 1rem;
            margin: 8px 0 10px;
            letter-spacing: -0.3px;
            transition: color 0.3s;
        }

        .related-card:hover .related-body h3 { color: var(--gold-dark); }

        .related-body .excerpt {
            font-size: 0.8rem;
            color: var(--muted);
            line-height: 1.6;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        @media (max-width: 900px) {
            .related-grid { grid-template-columns: 1fr; }
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
            transform: translateY(28px);
            transition: opacity 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94),
                        transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        .reveal.active { opacity: 1; transform: translateY(0); }
        .reveal-delay-1 { transition-delay: 0.1s; }
        .reveal-delay-2 { transition-delay: 0.2s; }
        .reveal-delay-3 { transition-delay: 0.3s; }
    </style>

    @section('jsonld')
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "Article",
      "headline": "{{ $article->title }}",
      "datePublished": "{{ $article->published_at }}",
      "author": {
        "@@type": "Organization",
        "name": "PropertyU"
      }
    }
    </script>
    @endsection

@endpush

@section('content')

    {{-- Navigation --}}
    <nav id="navbar">
        <div class="container">
            <div class="nav-inner">
                <a href="{{ url('/') }}" class="logo">Property<span>U</span>.</a>
                <a href="{{ route('public.articles') }}" class="nav-back">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="14" height="14">
                        <path d="M19 12H5m0 0l6-6m-6 6l6 6"/>
                    </svg>
                    Back to Articles
                </a>
            </div>
        </div>
    </nav>

    {{-- Breadcrumbs --}}
    <nav aria-label="Breadcrumb" class="container">
        <ol style="display:flex;gap:8px;list-style:none;padding:24px 0 0;font-size:13px;font-weight:500;color:var(--muted);">
            <li><a href="{{ url('/') }}" style="color:var(--gold);text-decoration:none;">Home</a><span style="margin-left:8px;">/</span></li>
            <li><a href="{{ route('public.articles') }}" style="color:var(--gold);text-decoration:none;">Articles</a><span style="margin-left:8px;">/</span></li>
            <li aria-current="page" style="color:var(--muted);">{{ $article->title }}</li>
        </ol>
    </nav>

    {{-- Article Hero --}}
    <section class="article-hero">
        <div class="container">
            <span class="article-category reveal active">{{ $article->category }}</span>
            <h1 class="article-title reveal active">{{ $article->title }}</h1>
            <div class="article-meta-bar reveal active">
                <span>
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    {{ \Carbon\Carbon::parse($article->published_at)->translatedFormat('d F Y') }}
                </span>
                <span>
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    {{ Str::wordCount(strip_tags($article->content)) }} kata
                </span>
            </div>
            <hr class="divider-line">
        </div>
    </section>

    {{-- Article Content --}}
    <section class="content-wrap">
        <div class="container">
            <div class="article-body reveal">
                {!! $article->content !!}
            </div>
        </div>
    </section>

    {{-- Related Articles --}}
    @if($related->count() > 0)
    <section class="related-section">
        <div class="container">
            <span class="article-category" style="display: block; margin-bottom: 8px;">Artikel Lainnya</span>
            <h2 style="font-size: 1.8rem; letter-spacing: -1px;">Related Articles.</h2>

            <div class="related-grid">
                @foreach($related as $item)
                <a href="{{ route('public.articles.detail', $item) }}" class="related-card reveal">
                    <div class="related-body">
                        <span class="cat">{{ $item->category }}</span>
                        <h3>{{ $item->title }}</h3>
                        <p class="excerpt">{{ Str::limit(strip_tags($item->content), 100) }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Footer --}}
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
