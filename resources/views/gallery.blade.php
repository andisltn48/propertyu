<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Full Gallery - PropertyU</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Akt:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        :root {
            --primary: #2C3E50;
            --accent: #E67E22;
            --shape: 8px;
            --bg-warm: #FAFAF9;
            --text-main: #1E293B;
            --text-muted: #475569;
            --white: #FFFFFF;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Akt', sans-serif;
            background-color: var(--bg-warm);
            color: var(--text-main);
            overflow-x: hidden;
        }

        h1, h2 { font-family: 'Akt', sans-serif; color: var(--primary); }

        .container { max-width: 1300px; margin: 0 auto; padding: 0 40px; }

        nav {
            padding: 20px 0;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-inner { display: flex; justify-content: space-between; align-items: center; }
        .logo { font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 800; font-size: 1.6rem; color: var(--primary); text-decoration: none; letter-spacing: -1.5px; }

        header { padding: 100px 0 60px; text-align: center; }
        header h1 { font-size: 4rem; letter-spacing: -2px; margin-bottom: 20px; }
        header p { color: var(--text-muted); font-size: 1.2rem; }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 100px;
        }

        .gallery-item {
            aspect-ratio: 1;
            border-radius: var(--shape);
            background-size: cover;
            background-position: center;
            background-color: #ddd;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1);
            cursor: pointer;
        }

        .gallery-item.active {
            opacity: 1;
            transform: translateY(0);
        }

        .gallery-item:hover {
            filter: brightness(0.8);
            transform: scale(1.02) translateY(-5px);
        }

        /* Lightbox Modal */
        .lightbox {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(44, 62, 80, 0.95);
            backdrop-filter: blur(10px);
            z-index: 2000;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 40px;
            cursor: zoom-out;
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .lightbox.show {
            display: flex;
            opacity: 1;
        }

        .lightbox-content {
            max-width: 100%;
            max-height: 100%;
            border-radius: var(--shape);
            box-shadow: 0 30px 60px rgba(0,0,0,0.5);
            transform: scale(0.9);
            transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .lightbox.show .lightbox-content {
            transform: scale(1);
        }

        .lightbox-close {
            position: absolute;
            top: 30px;
            right: 40px;
            color: #fff;
            font-size: 2rem;
            cursor: pointer;
            transition: transform 0.3s;
        }

        .lightbox-close:hover { transform: rotate(90deg); color: var(--accent); }

        #loading {
            text-align: center;
            padding: 40px;
            font-weight: 700;
            color: var(--accent);
            display: none;
        }

        .btn-back {
            text-decoration: none;
            color: var(--text-muted);
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 40px;
            transition: color 0.3s;
        }
        .btn-back:hover { color: var(--accent); }

        footer { padding: 60px 0; text-align: center; border-top: 1px solid rgba(0,0,0,0.05); background: #fff; }
    </style>
</head>
<body>

    <nav>
        <div class="container">
            <div class="nav-inner">
                <a href="{{ url('/') }}" class="logo">PropertyU.</a>
                <a href="{{ url('/') }}" style="text-decoration: none; color: var(--primary); font-weight: 700; font-size: 0.9rem;">Back to Home</a>
            </div>
        </div>
    </nav>

    <main class="container">
        <header>
            
            <h1>All Gallery Assets.</h1>
            <p>Exploring the details of our vision through visual stories.</p>
        </header>

        <div id="gallery-container" class="gallery-grid">
            @include('partials.gallery-items', ['galleries' => $galleries])
        </div>

        <div id="loading">
            <span class="animate-pulse">Loading more magic...</span>
        </div>
    </main>

    <footer>
        <p style="color: var(--text-muted); font-size: 0.9rem;">&copy; 2026 PropertyU. Visual Archives.</p>
    </footer>

    <div id="lightbox" class="lightbox" onclick="closeLightbox()">
        <span class="lightbox-close">&times;</span>
        <img id="lightbox-img" class="lightbox-content" src="" alt="Full Size Preview">
    </div>

    <script>
        // Lightbox Logic
        const lightbox = document.getElementById('lightbox');
        const lightboxImg = document.getElementById('lightbox-img');

        function openLightbox(imgUrl) {
            lightboxImg.src = imgUrl;
            lightbox.classList.add('show');
            document.body.style.overflow = 'hidden'; // Disable scroll
        }

        function closeLightbox() {
            lightbox.classList.remove('show');
            document.body.style.overflow = 'auto'; // Enable scroll
            setTimeout(() => { lightboxImg.src = ''; }, 400);
        }

        // Attach clicks to gallery items
        document.addEventListener('click', (e) => {
            const item = e.target.closest('.gallery-item');
            if (item) {
                const style = window.getComputedStyle(item);
                const bg = style.backgroundImage;
                const url = bg.replace(/url\(['"]?(.*?)['"]?\)/i, '$1');
                openLightbox(url);
            }
        });

        let page = 1;
        let loading = false;
        let hasMore = {{ $galleries->hasMorePages() ? 'true' : 'false' }};

        const container = document.getElementById('gallery-container');
        const loadingEl = document.getElementById('loading');

        function animateItems() {
            const items = document.querySelectorAll('.gallery-item:not(.active)');
            items.forEach((item, index) => {
                setTimeout(() => {
                    item.classList.add('active');
                }, index * 100);
            });
        }

        async function loadMore() {
            if (loading || !hasMore) return;
            
            loading = true;
            loadingEl.style.display = 'block';
            page++;

            try {
                const response = await fetch(`{{ route('public.gallery') }}?page=${page}`, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                const html = await response.text();
                
                if (html.trim() === "") {
                    hasMore = false;
                } else {
                    container.insertAdjacentHTML('beforeend', html);
                    animateItems();
                }
            } catch (error) {
                console.error("Failed to load more photos", error);
            } finally {
                loading = false;
                loadingEl.style.display = 'none';
            }
        }

        // Intersection Observer for scroll detection
        const scrollObserver = new IntersectionObserver((entries) => {
            if (entries[0].isIntersecting) {
                loadMore();
            }
        }, { threshold: 0.1 });

        scrollObserver.observe(loadingEl);

        // Initial animation
        document.addEventListener('DOMContentLoaded', animateItems);
    </script>
</body>
</html>
