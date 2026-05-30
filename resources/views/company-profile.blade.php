@extends('layouts.public')

@section('title', 'PropertyU — Visionary Living Redefined')
@section('description', 'PropertyU menghadirkan hunian modern, apartemen premium, dan kawasan properti eksklusif di Indonesia. Wujudkan visi hunian impian Anda.')
@section('og_title', 'PropertyU — Visionary Living Redefined')

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
            --shadow-sm: 0 4px 20px rgba(26, 30, 30, 0.04);
            --shadow-md: 0 8px 40px rgba(26, 30, 30, 0.06);
            --shadow-lg: 0 25px 60px rgba(26, 30, 30, 0.08);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Akt', sans-serif;
            background: var(--cream);
            color: var(--charcoal);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }

        ::selection { background: var(--gold); color: white; }

        h1, h2, h3, h4 {
            font-family: 'Akt', sans-serif;
            font-weight: 600;
            color: var(--charcoal);
            line-height: 1.1;
        }

        .container { max-width: 1280px; margin: 0 auto; padding: 0 48px; }

        @media (max-width: 768px) {
            .container { padding: 0 24px; }
            .nav-links { display: none !important; }
        }

        /* ─── Section Shared ─── */
        section { padding: 140px 0; }
        @media (max-width: 768px) { section { padding: 80px 0; } }

        .section-tag {
            display: inline-block;
            font-family: 'Akt', sans-serif;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 20px;
        }

        .section-title {
            font-size: clamp(2.5rem, 5vw, 3.8rem);
            letter-spacing: -2px;
            margin-bottom: 20px;
        }

        .section-sub {
            color: var(--muted);
            font-size: 1.05rem;
            max-width: 540px;
        }

        /* ─── Navigation ─── */
        nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 100;
            padding: 24px 0;
            transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            background: transparent;
        }

        nav .logo { color: white; }
        nav .logo span { color: var(--gold-light); }
        nav .nav-links a { color: rgba(255, 255, 255, 0.85); }

        nav.scrolled {
            padding: 12px 0;
            background: rgba(246, 243, 239, 0.88);
            backdrop-filter: blur(24px) saturate(1.4);
            -webkit-backdrop-filter: blur(24px) saturate(1.4);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        nav.scrolled .logo { color: var(--charcoal); }
        nav.scrolled .logo span { color: var(--gold); }
        nav.scrolled .nav-links a { color: var(--muted); }
        nav.scrolled .nav-links a:hover { color: var(--charcoal); }

        .nav-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-family: 'Akt', sans-serif;
            font-weight: 700;
            font-size: 1.5rem;
            text-decoration: none;
            letter-spacing: -1px;
            transition: color 0.3s;
        }

        .nav-links {
            display: flex;
            gap: 36px;
            background: rgba(255, 255, 255, 0.06);
            padding: 8px 24px;
            border-radius: 100px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            transition: all 0.3s;
        }

        nav.scrolled .nav-links {
            background: rgba(26, 30, 30, 0.03);
            border-color: var(--border);
        }

        .nav-links a {
            text-decoration: none;
            font-weight: 500;
            font-size: 0.85rem;
            transition: color 0.3s;
        }

        .nav-links a:hover { color: var(--gold) !important; }

        nav.scrolled .btn-wa-nav {
            border-color: var(--border);
            color: var(--charcoal);
        }
        nav.scrolled .btn-wa-nav:hover {
            border-color: var(--gold);
            background: rgba(184, 145, 74, 0.06);
        }

        .btn-wa-nav {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 20px;
            border-radius: 100px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-wa-nav:hover {
            border-color: var(--gold-light);
            background: rgba(255, 255, 255, 0.06);
        }

        /* ─── Hero ─── */
        .hero {
            height: 100vh;
            min-height: 600px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            background: var(--charcoal);
            overflow: hidden;
            text-align: center;
        }

        .hero-slideshow {
            position: absolute;
            inset: 0;
            z-index: 1;
        }

        .hero-slide {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            opacity: 0;
            transition: opacity 1.8s ease-in-out, transform 12s linear;
            filter: brightness(0.45);
        }

        .hero-slide.active {
            opacity: 1;
            transform: scale(1.08);
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            z-index: 2;
            background: linear-gradient(
                180deg,
                rgba(26, 30, 30, 0.2) 0%,
                rgba(26, 30, 30, 0.4) 50%,
                rgba(26, 30, 30, 0.7) 100%
            );
        }

        .hero-content {
            position: relative;
            z-index: 10;
            color: #fff;
            max-width: 800px;
            padding: 0 20px;
        }

        .hero-content h1 {
            font-family: 'Akt', sans-serif;
            font-size: clamp(3.2rem, 9vw, 6.5rem);
            margin-bottom: 24px;
            letter-spacing: -3px;
            color: #fff;
            line-height: 1.05;
        }

        .hero-content p {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.8);
            margin: 0 auto 44px;
            max-width: 560px;
        }

        .hero-cta {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 16px 36px;
            background: var(--gold);
            color: white;
            text-decoration: none;
            border-radius: 100px;
            font-weight: 700;
            font-size: 0.95rem;
            transition: all 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .hero-cta:hover {
            background: var(--gold-dark);
            transform: translateY(-3px);
            box-shadow: 0 16px 40px rgba(184, 145, 74, 0.3);
        }

        .hero-scroll {
            position: absolute;
            bottom: 40px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 10;
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.7rem;
            letter-spacing: 3px;
            text-transform: uppercase;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            animation: floatDown 2.5s ease-in-out infinite;
        }

        @keyframes floatDown {
            0%, 100% { transform: translateX(-50%) translateY(0); opacity: 0.5; }
            50% { transform: translateX(-50%) translateY(6px); opacity: 1; }
        }

        /* ─── About ─── */
        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 100px;
            align-items: center;
        }

        @media (max-width: 900px) {
            .about-grid { grid-template-columns: 1fr; gap: 48px; }
        }

        .about-image {
            height: 600px;
            border-radius: 24px;
            background-size: cover;
            background-position: center;
            box-shadow: var(--shadow-md);
        }

        @media (max-width: 768px) {
            .about-image { height: 380px; order: -1; }
        }

        .about-text h2 {
            font-size: clamp(2.2rem, 4vw, 3.2rem);
            letter-spacing: -1.5px;
            margin-bottom: 28px;
        }

        .about-text .about-content {
            color: var(--muted);
            font-size: 1rem;
            line-height: 1.85;
        }

        .about-text .about-content p { margin-bottom: 20px; }

        /* ─── Projects ─── */
        .projects-section {
            background: var(--ivory);
        }

        .projects-header {
            text-align: center;
            margin-bottom: 72px;
        }

        .project-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 28px;
        }

        .project-card {
            position: relative;
            border-radius: 24px;
            overflow: hidden;
            aspect-ratio: 4/5;
            background: var(--ivory);
            text-decoration: none;
            display: block;
            box-shadow: var(--shadow-sm);
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

        .btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 32px;
            border-radius: 100px;
            border: 1.5px solid var(--border);
            color: var(--charcoal);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s;
        }

        .btn-outline:hover {
            border-color: var(--gold);
            background: rgba(184, 145, 74, 0.05);
            transform: translateY(-2px);
        }

        .btn-outline svg { transition: transform 0.3s; }
        .btn-outline:hover svg { transform: translateX(3px); }

        @media (max-width: 1024px) {
            .project-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 640px) {
            .project-grid { grid-template-columns: 1fr; gap: 20px; }
            .project-overlay { padding: 28px 24px; }
            .project-overlay h3 { font-size: 1.3rem; }
        }

        /* ─── Gallery ─── */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 16px;
            grid-auto-rows: 200px;
        }

        .gallery-item {
            border-radius: 20px;
            overflow: hidden;
            background-size: cover;
            background-position: center;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .gallery-item:hover {
            filter: brightness(0.7);
            transform: scale(1.02);
        }

        .gi-1 { grid-column: span 8; grid-row: span 2; }
        .gi-2 { grid-column: span 4; grid-row: span 3; }
        .gi-3 { grid-column: span 4; grid-row: span 2; }
        .gi-4 { grid-column: span 4; grid-row: span 2; }

        /* ─── Articles ─── */
        .articles-section {
            background: var(--cream);
        }

        .articles-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 28px;
        }

        .article-card {
            background: var(--ivory);
            border-radius: 24px;
            overflow: hidden;
            border: 1px solid var(--border);
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            text-decoration: none;
            display: block;
            box-shadow: var(--shadow-sm);
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
            padding: 28px 28px 32px;
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

        .article-card:hover .article-body h3 {
            color: var(--gold-dark);
        }

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

        .article-meta svg {
            width: 14px;
            height: 14px;
            opacity: 0.5;
        }

        .article-meta span {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        @media (max-width: 1024px) {
            .articles-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 640px) {
            .articles-grid { grid-template-columns: 1fr; }
            .article-body { padding: 20px; }
        }

        /* ─── Lightbox ─── */
        .lightbox {
            position: fixed;
            inset: 0;
            background: rgba(18, 20, 20, 0.95);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            z-index: 2000;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 48px;
            cursor: zoom-out;
            opacity: 0;
            transition: opacity 0.4s;
        }

        .lightbox.show { display: flex; opacity: 1; }

        .lightbox-content {
            max-width: 100%;
            max-height: 100%;
            border-radius: 20px;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.5);
            transform: scale(0.92);
            transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .lightbox.show .lightbox-content { transform: scale(1); }

        .lightbox-close {
            position: absolute;
            top: 28px;
            right: 32px;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.12);
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s;
        }

        .lightbox-close:hover { background: rgba(255, 255, 255, 0.15); }

        /* ─── Contact ─── */
        .contact-section {
            background: var(--ivory);
            text-align: center;
            border-top: 1px solid var(--border);
        }

        .contact-section h2 {
            font-size: clamp(2.5rem, 5vw, 4rem);
            margin-bottom: 20px;
        }

        .contact-section p {
            color: var(--muted);
            font-size: 1.05rem;
            max-width: 520px;
            margin: 0 auto 40px;
        }

        .btn-whatsapp {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 18px 42px;
            background: #25D366;
            color: white;
            text-decoration: none;
            border-radius: 100px;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .btn-whatsapp:hover {
            background: #1DA859;
            transform: translateY(-3px);
            box-shadow: 0 16px 40px rgba(37, 211, 102, 0.25);
        }

        /* ─── Footer ─── */
        footer {
            padding: 100px 0 0;
            background: var(--ivory);
            border-top: 1px solid var(--border);
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.3fr 1fr 0.8fr 1.1fr;
            gap: 60px;
            margin-bottom: 60px;
        }

        @media (max-width: 1024px) {
            .footer-grid { grid-template-columns: 1fr 1fr; gap: 40px; }
        }
        @media (max-width: 640px) {
            .footer-grid { grid-template-columns: 1fr; }
        }

        .footer-col h4 {
            font-family: 'Akt', sans-serif;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 24px;
            color: var(--charcoal);
        }

        .footer-brand-lg {
            font-family: 'Akt', sans-serif;
            font-weight: 700;
            font-size: 1.4rem;
            color: var(--charcoal);
            text-decoration: none;
            display: inline-block;
            margin-bottom: 20px;
        }
        .footer-brand-lg span { color: var(--gold); }

        .footer-desc {
            color: var(--muted);
            font-size: 0.9rem;
            line-height: 1.8;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li { margin-bottom: 12px; }

        .footer-links a {
            text-decoration: none;
            color: var(--muted);
            font-size: 0.9rem;
            transition: color 0.3s;
        }

        .footer-links a:hover { color: var(--gold); }

        .footer-map {
            height: 140px;
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 16px;
            border: 1px solid var(--border);
        }

        .footer-map iframe {
            width: 100%;
            height: 100%;
            border: 0;
        }

        .footer-map-placeholder {
            height: 100%;
            background: var(--cream);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--muted);
            font-size: 0.75rem;
        }

        .footer-addr {
            color: var(--muted);
            font-size: 0.85rem;
        }

        .footer-news-item {
            margin-bottom: 20px;
        }

        .footer-news-item a { text-decoration: none; }

        .footer-news-item span {
            font-size: 0.65rem;
            font-weight: 600;
            color: var(--gold);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .footer-news-item p {
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--charcoal);
            margin-top: 4px;
            line-height: 1.4;
            transition: color 0.3s;
        }

        .footer-news-item a:hover p { color: var(--gold); }

        .copyright {
            padding: 32px 0;
            border-top: 1px solid var(--border);
            text-align: center;
            font-size: 0.85rem;
            color: var(--muted);
        }

        /* ─── Back to Top ─── */
        .to-up {
            position: fixed;
            bottom: 40px;
            right: 40px;
            width: 52px;
            height: 52px;
            background: var(--charcoal);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            cursor: pointer;
            border: none;
            outline: none;
            box-shadow: var(--shadow-md);
        }

        .to-up.show {
            opacity: 1;
            visibility: visible;
            bottom: 30px;
        }

        .to-up:hover {
            background: var(--gold);
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(184, 145, 74, 0.25);
        }

        /* ─── Animations ─── */
        [data-reveal] {
            opacity: 0;
            transform: translateY(40px);
            transition: all 1s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        [data-reveal].active {
            opacity: 1;
            transform: translateY(0);
        }

        .stagger-1 { transition-delay: 0.1s; }
        .stagger-2 { transition-delay: 0.2s; }
        .stagger-3 { transition-delay: 0.3s; }
        .stagger-4 { transition-delay: 0.4s; }
    </style>
@endpush

@section('jsonld')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "RealEstateAgent",
  "name": "PropertyU",
  "url": "{{ url('/') }}",
  "description": "PropertyU menghadirkan hunian modern, apartemen premium, dan kawasan properti eksklusif di Indonesia.",
  "contactPoint": {
    "@@type": "ContactPoint",
    "contactType": "customer service"
  }
}
</script>
@endsection

@section('content')

    {{-- Navigation --}}
    <nav id="navbar">
        <div class="container">
            <div class="nav-inner">
                <a href="#" class="logo">Property<span>U</span>.</a>
                <div class="nav-links">
                    <a href="#home">Home</a>
                    <a href="#about">Tentang Kami</a>
                    <a href="#projects">Projects</a>
                    <a href="#gallery">Galeri</a>
                    <a href="#articles">Articles</a>
                </div>
                <a href="https://wa.me/{{ $contact->no_whatsapp ?? '6281234567890' }}?text=Halo%20PropertyU,%20saya%20tertarik%20dengan%20proyek%20hunian%20Anda." class="btn-wa-nav">
                    <svg fill="currentColor" viewBox="0 0 24 24" width="16" height="16">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    Private Chat
                </a>
            </div>
        </div>
    </nav>

    <main>
        {{-- Home / Hero --}}
        <section id="home" class="hero">
            <div class="hero-slideshow">
                @if($heroImages->count() > 0)
                    @foreach($heroImages as $index => $img)
                        <div class="hero-slide {{ $index === 0 ? 'active' : '' }}"
                             style="background-image: url('{{ asset('storage/' . $img->image_path) }}');"></div>
                    @endforeach
                @else
                    <div class="hero-slide active"
                         style="background-image: url('https://images.unsplash.com/photo-1600585154340-be6199f74009?auto=format&fit=crop&w=1920&q=80');"></div>
                @endif
            </div>
            <div class="hero-overlay"></div>

            <div class="container hero-content">
                <span class="section-tag" style="color: var(--gold-light);" data-reveal>The Future of Living</span>
                <h1 data-reveal>{!! $heroSetting->overlay_text ?? 'Space to <br>Breathe.' !!}</h1>
                <p data-reveal>Mendefinisikan ulang batas antara alam dan hunian modern melalui arsitektur visioner.</p>
                <div data-reveal>
                    <a href="#projects" class="hero-cta">
                        Jelajahi Proyek
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="16" height="16">
                            <path d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="hero-scroll">
                <span>Scroll</span>
                <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" width="16" height="16">
                    <path d="M12 5v14m0 0l-4-4m4 4l4-4"/>
                </svg>
            </div>
        </section>

        {{-- About --}}
        <section id="about">
            <div class="container about-grid">
                <div class="about-image" data-reveal
                     style="background-image: url('{{ $about && $about->foto ? asset('storage/' . $about->foto) : 'https://images.unsplash.com/photo-1600607687940-4e7a6a35a05b?auto=format&fit=crop&w=1000&q=80' }}');">
                </div>
                <div class="about-text" data-reveal>
                    <span class="section-tag">Tentang Kami</span>
                    <h2>Didesain untuk <br>Kehidupan.</h2>
                    <div class="about-content">
                        {!! $about->konten ?? '<p>Kami tidak membangun sekadar struktur. Kami merancang ekosistem yang bernapas. Dengan teknologi 3D interaktif, kami memberikan transparansi mutlak sebelum pondasi pertama diletakkan.</p>' !!}
                    </div>
                </div>
            </div>
        </section>

        {{-- Projects --}}
        <section id="projects" class="projects-section">
            <div class="container">
                <div class="projects-header" data-reveal>
                    <span class="section-tag">Mahakarya Kami</span>
                    <h2 class="section-title" style="margin-bottom: 12px;">Current Projects.</h2>
                    <p class="section-sub" style="margin: 0 auto;">Menghadirkan hunian visioner yang menyatu dengan alam.</p>
                </div>

                <div class="project-grid">
                    @forelse($projects->take(6) as $index => $project)
                    <a href="{{ route('public.projects.detail', $project->id) }}"
                       class="project-card"
                       data-reveal
                       style="text-decoration: none; display: block; position: relative;">
                        @if($project->images->first())
                            <img src="{{ asset('storage/' . $project->images->first()->image_path) }}" alt="{{ $project->name }}" loading="lazy">
                        @else
                            <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=800&q=80" alt="Placeholder" loading="lazy">
                        @endif
                        @if($project->file_3d_path)
                        <span class="badge-3d" onclick="event.stopPropagation(); window.location='{{ route('public.projects.3d', $project->id) }}';">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"/>
                            </svg>
                            3D Tour
                        </span>
                        @endif
                        <div class="project-overlay">
                            <span class="tagline">
                                @if($project->file_3d_path)
                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="12" height="12">
                                        <path d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"/>
                                    </svg>
                                    3D Tour Ready
                                @else
                                    Featured Project
                                @endif
                            </span>
                            <h3>{{ $project->name }}</h3>
                        </div>
                    </a>
                    @empty
                    <div class="col-span-full text-center py-20" style="color: var(--muted);">
                        <p>No projects published yet.</p>
                    </div>
                    @endforelse
                </div>

                <div class="flex justify-center mt-16" data-reveal>
                    <a href="{{ route('public.projects') }}" class="btn-outline">
                        Browse More Projects
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="14" height="14">
                            <path d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
        </section>

        {{-- Gallery --}}
        <section id="gallery">
            <div class="container">
                <div data-reveal style="margin-bottom: 60px;">
                    <span class="section-tag">Galeri Visual</span>
                    <h2 class="section-title">Aesthetic Corners.</h2>
                </div>

                <div class="gallery-grid">
                    @foreach($galleries as $index => $item)
                        @php
                            $class = '';
                            if($index == 0) $class = 'gi-1';
                            elseif($index == 1) $class = 'gi-2';
                            elseif($index == 2) $class = 'gi-3';
                            elseif($index == 3) $class = 'gi-4';
                            else $class = 'gi-3';
                        @endphp
                        <div class="gallery-item {{ $class }}"
                             style="background-image: url('{{ asset('storage/' . $item->image_path) }}');"
                             data-reveal
                             onclick="openLightbox(this)">
                        </div>
                    @endforeach
                </div>

                @if($galleries->count() > 4)
                <div class="flex justify-center mt-16" data-reveal>
                    <a href="{{ route('public.gallery') }}" class="btn-outline">
                        Browse More Gallery
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="14" height="14">
                            <path d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
                @endif
            </div>
        </section>

        {{-- Articles --}}
        <section id="articles" class="articles-section">
            <div class="container">
                <div data-reveal style="margin-bottom: 60px;">
                    <span class="section-tag">Wawasan & Inspirasi</span>
                    <h2 class="section-title">Articles.</h2>
                </div>

                <div class="articles-grid">
                    @forelse($articles as $index => $article)
                        <a href="{{ route('public.articles.detail', $article) }}" class="article-card" data-reveal>
                            <div class="article-thumb">
                                <svg fill="none" stroke="currentColor" stroke-width="1.2" viewBox="0 0 24 24">
                                    <path d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                </svg>
                            </div>
                            <div class="article-body">
                                <span class="article-category">{{ $article->category }}</span>
                                <h3>{{ $article->title }}</h3>
                                <p class="article-excerpt">{{ Str::limit(strip_tags($article->content), 120) }}</p>
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

                @if($articles->count() >= 3)
                <div class="flex justify-center mt-16" data-reveal>
                    <a href="{{ route('public.articles') }}" class="btn-outline">
                        Browse More Articles
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="14" height="14">
                            <path d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
                @endif
            </div>
        </section>

        {{-- Contact --}}
        <section id="contact" class="contact-section">
            <div class="container" data-reveal>
                <span class="section-tag">Siap untuk Memulai?</span>
                <h2>Let's talk about <br>your dream home.</h2>
                <p>Konsultasikan kebutuhan hunian Anda secara eksklusif dengan tim kami melalui WhatsApp.</p>
                <a href="https://wa.me/{{ $contact->no_whatsapp ?? '6281234567890' }}?text=Halo%20PropertyU,%20saya%20tertarik%20dengan%20proyek%20hunian%20Anda." class="btn-whatsapp">
                    <svg fill="currentColor" viewBox="0 0 24 24" width="20" height="20">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    Chat via WhatsApp
                </a>
            </div>
        </section>
    </main>

    {{-- Footer --}}
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <a href="#" class="footer-brand-lg">Property<span>U</span>.</a>
                    <p class="footer-desc">
                        Mendefinisikan ulang masa depan hunian tropis melalui integrasi teknologi 3D visioner dan arsitektur berkelanjutan. Membangun lebih dari sekadar bangunan, kami membangun ekosistem kehidupan.
                    </p>
                </div>

                <div class="footer-col">
                    <h4>Lokasi Kami</h4>
                    <div class="footer-map">
                        @if($map && $map->link_maps)
                            {!! $map->link_maps !!}
                        @else
                            <div class="footer-map-placeholder">Map Not Set</div>
                        @endif
                    </div>
                    <p class="footer-addr">{{ $map->alamat_teks ?? 'Alamat belum diatur.' }}</p>
                </div>

                <div class="footer-col">
                    <h4>Navigasi</h4>
                    <ul class="footer-links">
                        <li><a href="#home">Home</a></li>
                        <li><a href="#about">Tentang Kami</a></li>
                        <li><a href="#projects">Projects Kami</a></li>
                        <li><a href="{{ route('public.gallery') }}">Galeri Foto</a></li>
                        <li><a href="#articles">Articles</a></li>
                        <li><a href="#contact">Kontak</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Artikel Terbaru</h4>
                    @forelse($articles as $article)
                    <div class="footer-news-item">
                        <a href="#">
                            <span>{{ $article->category }} • {{ \Carbon\Carbon::parse($article->published_at)->translatedFormat('F Y') }}</span>
                            <p>{{ $article->title }}</p>
                        </a>
                    </div>
                    @empty
                    <p class="footer-desc">Belum ada artikel.</p>
                    @endforelse
                </div>
            </div>

            <div class="copyright">
                <p>&copy; 2026 PropertyU. Architecture for the Soul. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    {{-- Back to Top --}}
    <button id="toUp" class="to-up" onclick="window.scrollTo({ top: 0, behavior: 'smooth' })">
        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" width="20" height="20">
            <path d="M5 10l7-7m0 0l7 7m-7-7v18"/>
        </svg>
    </button>

    {{-- Lightbox --}}
    <div id="lightbox" class="lightbox" onclick="closeLightbox()">
        <button class="lightbox-close">&times;</button>
        <img id="lightbox-img" class="lightbox-content" src="" alt="Full Size Preview">
    </div>

    <script>
        // Lightbox
        const lightbox = document.getElementById('lightbox');
        const lightboxImg = document.getElementById('lightbox-img');

        function openLightbox(el) {
            const style = window.getComputedStyle(el);
            const bg = style.backgroundImage;
            const url = bg.replace(/url\(['"]?(.*?)['"]?\)/i, '$1');
            lightboxImg.src = url;
            lightbox.classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            lightbox.classList.remove('show');
            document.body.style.overflow = '';
            setTimeout(() => { lightboxImg.src = ''; }, 400);
        }

        // Hero Slideshow
        const slides = document.querySelectorAll('.hero-slide');
        let currentSlide = 0;

        function nextSlide() {
            if (slides.length === 0) return;
            slides[currentSlide].classList.remove('active');
            currentSlide = (currentSlide + 1) % slides.length;
            slides[currentSlide].classList.add('active');
        }

        if (slides.length > 1) {
            setInterval(nextSlide, 5000);
        }

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('navbar');
            const toUp = document.getElementById('toUp');

            nav.classList.toggle('scrolled', window.scrollY > 60);
            toUp.classList.toggle('show', window.scrollY > 600);
        });

        // Intersection Observer for scroll reveals
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });

        document.querySelectorAll('[data-reveal]').forEach(el => observer.observe(el));
    </script>

@endsection
