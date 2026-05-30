@extends('layouts.public')

@section('title')
    {{ $project->name }} — PropertyU
@endsection
@section('description')
    {{ Str::limit(strip_tags($project->detail), 160) }}
@endsection
@section('og_title')
    {{ $project->name }} — PropertyU
@endsection
@if($project->images->first())
  @section('og_image', asset('storage/' . $project->images->first()->image_path))
@endif

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

        h1, h2, h3, h4 {
            font-family: 'Akt', sans-serif;
            font-weight: 600;
            color: var(--charcoal);
        }

        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 48px;
        }

        @media (max-width: 768px) {
            .container { padding: 0 24px; }
        }

        /* ─── Navigation ─── */
        nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 100;
            padding: 18px 0;
            background: rgba(246, 243, 239, 0.82);
            backdrop-filter: blur(24px) saturate(1.4);
            -webkit-backdrop-filter: blur(24px) saturate(1.4);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            transition: padding 0.3s;
        }

        .nav-scrolled { padding: 10px 0; }

        .nav-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

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

        /* ─── Hero Section ─── */
        .hero {
            margin-top: 80px;
            position: relative;
            height: 75vh;
            min-height: 520px;
            max-height: 700px;
            border-radius: 32px;
            overflow: hidden;
            background: var(--teal);
        }

        .hero img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.75;
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                180deg,
                rgba(26, 30, 30, 0.1) 0%,
                rgba(26, 30, 30, 0.55) 50%,
                rgba(26, 30, 30, 0.85) 100%
            );
        }

        .hero-content {
            position: absolute;
            bottom: 0;
            left: 0; right: 0;
            padding: 64px 64px 56px;
        }

        .hero-tag {
            display: inline-block;
            font-family: 'Akt', sans-serif;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--gold-light);
            margin-bottom: 16px;
            background: rgba(26, 30, 30, 0.5);
            padding: 6px 16px;
            border-radius: 100px;
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .hero-title {
            font-family: 'Akt', sans-serif;
            font-size: clamp(2.8rem, 6vw, 4.8rem);
            font-weight: 600;
            color: white;
            letter-spacing: -2px;
            line-height: 1.05;
            max-width: 740px;
            text-shadow: 0 2px 20px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 768px) {
            .hero { height: 60vh; min-height: 380px; border-radius: 20px; }
            .hero-content { padding: 32px 24px 28px; }
        }

        /* ─── Content Grid ─── */
        .content-section {
            padding: 80px 0 120px;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1.45fr 1fr;
            gap: 72px;
            align-items: start;
        }

        @media (max-width: 1024px) {
            .content-grid { grid-template-columns: 1fr; gap: 56px; }
        }

        /* ─── Detail Text ─── */
        .detail-body {
            font-size: 1rem;
            line-height: 1.85;
            color: var(--muted);
        }

        .detail-body h2,
        .detail-body h3 {
            font-family: 'Akt', sans-serif;
            color: var(--charcoal);
            margin: 48px 0 16px;
            letter-spacing: -0.5px;
        }

        .detail-body h2 { font-size: 1.75rem; }
        .detail-body h3 { font-size: 1.3rem; }

        .detail-body p { margin-bottom: 20px; }

        .detail-body ul, .detail-body ol {
            padding-left: 24px;
            margin-bottom: 20px;
        }
        .detail-body li { margin-bottom: 8px; }

        .detail-body img {
            border-radius: 16px;
            margin: 32px 0;
            width: 100%;
            box-shadow: var(--shadow-card);
        }

        .detail-body a {
            color: var(--gold-dark);
            text-decoration: underline;
            text-underline-offset: 3px;
            text-decoration-thickness: 1px;
        }

        .detail-body a:hover { color: var(--gold); }

        .detail-body blockquote {
            border-left: 3px solid var(--gold);
            padding: 4px 0 4px 24px;
            margin: 28px 0;
            font-family: 'Akt', sans-serif;
            font-style: italic;
            font-size: 1.15rem;
            color: var(--charcoal);
        }

        /* ─── Section Divider ─── */
        .section-divider {
            display: flex;
            align-items: center;
            gap: 20px;
            margin: 56px 0 32px;
        }

        .section-divider hr {
            flex: 1;
            border: none;
            border-top: 1px solid var(--border);
        }

        .section-label {
            font-family: 'Akt', sans-serif;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--gold);
            white-space: nowrap;
        }

        .section-label svg {
            display: inline;
            vertical-align: middle;
            margin-right: 6px;
        }

        /* ─── Gallery ─── */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .gallery-grid .gallery-item:first-child {
            grid-column: span 2;
        }

        .gallery-item {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            cursor: pointer;
            background: var(--cream);
            aspect-ratio: 4/3;
        }

        .gallery-item:first-child {
            aspect-ratio: 16/7;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .gallery-item:hover img {
            transform: scale(1.05);
        }

        .gallery-item::after {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(26, 30, 30, 0);
            transition: background 0.4s;
        }

        .gallery-item:hover::after {
            background: rgba(26, 30, 30, 0.06);
        }

        @media (max-width: 640px) {
            .gallery-grid { grid-template-columns: 1fr; }
            .gallery-grid .gallery-item:first-child { grid-column: span 1; aspect-ratio: 4/3; }
            .gallery-item:first-child { aspect-ratio: 4/3; }
        }

        /* ─── Sidebar CTA ─── */
        .cta-sticky {
            position: sticky;
            top: 104px;
        }

        .cta-card {
            background: var(--ivory);
            border-radius: 28px;
            padding: 44px 36px;
            border: 1px solid var(--border);
            box-shadow: var(--shadow-card);
        }

        .cta-card h3 {
            font-family: 'Akt', sans-serif;
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--charcoal);
            margin-bottom: 10px;
            letter-spacing: -0.5px;
        }

        .cta-desc {
            color: var(--muted);
            font-size: 0.9rem;
            line-height: 1.7;
            margin-bottom: 28px;
        }

        .cta-divider {
            border: none;
            border-top: 1px solid var(--border);
            margin: 28px 0;
        }

        .cta-benefits {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 32px;
        }

        .cta-benefit {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.85rem;
            color: var(--muted);
        }

        .cta-benefit svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
            color: var(--gold);
        }

        .btn-primary {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            width: 100%;
            padding: 16px 28px;
            border-radius: 100px;
            font-family: 'Akt', sans-serif;
            font-weight: 700;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            border: none;
            cursor: pointer;
        }

        .btn-gold {
            background: var(--gold);
            color: white;
        }
        .btn-gold:hover {
            background: var(--gold-dark);
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(184, 145, 74, 0.25);
        }

        .btn-outline {
            background: transparent;
            color: var(--charcoal);
            border: 1.5px solid var(--border);
        }
        .btn-outline:hover {
            border-color: var(--gold);
            background: rgba(184, 145, 74, 0.05);
            transform: translateY(-2px);
        }

        .btn-whatsapp {
            background: #25D366;
            color: white;
        }
        .btn-whatsapp:hover {
            background: #1DA859;
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(37, 211, 102, 0.25);
        }

        .cta-hours {
            text-align: center;
            font-size: 0.75rem;
            color: var(--muted);
            margin-top: 20px;
            opacity: 0.7;
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
        }

        .lightbox.show { display: flex; }

        .lightbox img {
            max-width: 100%;
            max-height: 100%;
            border-radius: 20px;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.5);
        }

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

        .lightbox-close:hover {
            background: rgba(255, 255, 255, 0.15);
        }

        .lightbox-counter {
            position: absolute;
            bottom: 32px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.4);
            font-weight: 500;
            letter-spacing: 1px;
        }

        @media (max-width: 768px) {
            .lightbox { padding: 24px; }
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

        .footer-copy {
            font-size: 0.85rem;
            color: var(--muted);
        }

        @media (max-width: 640px) {
            .footer-inner { flex-direction: column; text-align: center; }
        }

        /* ─── Scroll Animations ─── */
        .reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94),
                        transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        .reveal-delay-1 { transition-delay: 0.1s; }
        .reveal-delay-2 { transition-delay: 0.2s; }
        .reveal-delay-3 { transition-delay: 0.3s; }
        .reveal-delay-4 { transition-delay: 0.4s; }

        /* ─── Hero Entrance ─── */
        .hero-entrance {
            opacity: 0;
            transform: scale(0.96);
            animation: heroIn 1.2s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
        }

        @keyframes heroIn {
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .hero-content-entrance {
            opacity: 0;
            transform: translateY(40px);
            animation: heroContentIn 1s cubic-bezier(0.25, 0.46, 0.45, 0.94) 0.3s forwards;
        }

        @keyframes heroContentIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ─── Counter badge ─── */
        .gallery-counter {
            position: absolute;
            bottom: 16px;
            right: 16px;
            background: rgba(26, 30, 30, 0.65);
            backdrop-filter: blur(8px);
            padding: 4px 14px;
            border-radius: 100px;
            font-size: 0.75rem;
            font-weight: 600;
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.1);
            z-index: 2;
        }
    </style>
@endpush

@section('jsonld')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "Product",
  "name": "{{ $project->name }}",
  "description": "{{ strip_tags($project->detail) }}",
  "image": "{{ $project->images->first() ? asset('storage/' . $project->images->first()->image_path) : '' }}",
  "url": "{{ url()->current() }}"
}
</script>
@endsection

@section('content')

    {{-- Navigation --}}
    <nav id="navbar">
        <div class="container">
            <div class="nav-inner">
                <a href="{{ url('/') }}" class="logo">Property<span>U</span>.</a>
                <a href="{{ route('public.projects') }}" class="nav-back">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="14" height="14">
                        <path d="M19 12H5m0 0l6-6m-6 6l6 6"/>
                    </svg>
                    Back to Portfolio
                </a>
            </div>
        </div>
    </nav>

    {{-- Breadcrumbs --}}
    <nav aria-label="Breadcrumb" class="container">
        <ol style="display:flex;gap:8px;list-style:none;padding:24px 0 0;font-size:13px;font-weight:500;color:var(--muted);">
            <li><a href="{{ url('/') }}" style="color:var(--gold);text-decoration:none;">Home</a><span style="margin-left:8px;">/</span></li>
            <li><a href="{{ route('public.projects') }}" style="color:var(--gold);text-decoration:none;">Projects</a><span style="margin-left:8px;">/</span></li>
            <li aria-current="page" style="color:var(--muted);">{{ $project->name }}</li>
        </ol>
    </nav>

    {{-- Hero Section --}}
    <section class="container hero-entrance">
        <div class="hero">
            <img src="{{ asset('storage/' . ($project->images->first()->image_path ?? '')) }}"
                 alt="{{ $project->name }}"
                 onerror="this.style.display='none'">
            <div class="hero-overlay"></div>
            <div class="hero-content hero-content-entrance">
                <span class="hero-tag">Featured Project</span>
                <h1 class="hero-title">{{ $project->name }}</h1>
            </div>
        </div>
    </section>

    {{-- Main Content --}}
    <section class="content-section">
        <div class="container">
            <div class="content-grid">
                {{-- Left: Description + Gallery --}}
                <div>
                    <div class="detail-body reveal">
                        {!! $project->detail !!}
                    </div>

                    @if($project->images->count() > 0)
                        <div class="section-divider reveal reveal-delay-1">
                            <hr>
                            <span class="section-label">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="14" height="14">
                                    <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Gallery
                            </span>
                        </div>

                        <div class="gallery-grid reveal reveal-delay-2">
                            @foreach($project->images as $index => $img)
                                <div class="gallery-item" onclick="openLightbox({{ $index }})">
                                    <img src="{{ asset('storage/' . $img->image_path) }}" alt="Gallery image {{ $index + 1 }}" loading="lazy">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Right: Sticky CTA --}}
                <div class="cta-sticky reveal reveal-delay-1">
                    <div class="cta-card">
                        <h3>Tertarik dengan Proyek Ini?</h3>
                        <p class="cta-desc">Dapatkan jadwal kunjungan langsung atau konsultasi detail dengan konsultan properti kami.</p>

                        <div class="cta-benefits">
                            <div class="cta-benefit">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Konsultasi gratis &amp; tanpa komitmen
                            </div>
                            <div class="cta-benefit">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Jadwalkan kunjungan langsung
                            </div>
                            <div class="cta-benefit">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                Tersedia di kota Anda
                            </div>
                        </div>

                        @if($project->file_3d_path)
                            <a href="{{ route('public.projects.3d', $project) }}" class="btn-primary btn-gold" style="margin-bottom: 12px;">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="18" height="18">
                                    <path d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"/>
                                </svg>
                                Experience 3D Virtual Tour
                            </a>
                        @endif

                        <a href="https://wa.me/{{ $contact->no_whatsapp ?? '6281234567890' }}?text=Halo%20PropertyU,%20saya%20tertarik%20dengan%20proyek%20{{ urlencode($project->name) }}"
                           class="btn-primary btn-whatsapp">
                            <svg fill="currentColor" viewBox="0 0 24 24" width="18" height="18">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                            Konsultasi via WhatsApp
                        </a>

                        <p class="cta-hours">Respon cepat setiap jam kerja 08:00 — 17:00</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Lightbox --}}
    <div id="lightbox" class="lightbox" onclick="closeLightbox()">
        <button class="lightbox-close" onclick="closeLightbox()">&times;</button>
        <img id="lightbox-img" src="" alt="Full view">
        <span class="lightbox-counter" id="lightbox-counter"></span>
    </div>

    {{-- Footer --}}
    <footer>
        <div class="container">
            <div class="footer-inner">
                <span class="footer-brand">Property<span>U</span>.</span>
                <span class="footer-copy">&copy; {{ date('Y') }} PropertyU. Excellence in every detail.</span>
            </div>
        </div>
    </footer>

    <script>
        const images = @json($project->images->pluck('image_path')->map(fn($p) => asset('storage/' . $p)));
        let currentIndex = 0;

        function openLightbox(index) {
            currentIndex = index;
            updateLightbox();
            document.getElementById('lightbox').classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            document.getElementById('lightbox').classList.remove('show');
            document.body.style.overflow = '';
        }

        function updateLightbox() {
            const img = document.getElementById('lightbox-img');
            img.src = images[currentIndex];
            document.getElementById('lightbox-counter').textContent =
                `${currentIndex + 1} / ${images.length}`;
        }

        document.addEventListener('keydown', (e) => {
            const lb = document.getElementById('lightbox');
            if (!lb.classList.contains('show')) return;

            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowRight' && currentIndex < images.length - 1) {
                currentIndex++;
                updateLightbox();
            }
            if (e.key === 'ArrowLeft' && currentIndex > 0) {
                currentIndex--;
                updateLightbox();
            }
        });

        // Scroll-triggered reveals
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('active');
            });
        }, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        // Navbar shrink on scroll
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('nav-scrolled', window.scrollY > 60);
        });
    </script>

@endsection
