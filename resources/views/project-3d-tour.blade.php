<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3D Tour — {{ $project->name }} — PropertyU</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:opsz@8..72&family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/3.5.0/model-viewer.min.js"></script>

    <script type="importmap">
    {
        "imports": {
            "three": "https://cdn.jsdelivr.net/npm/three@0.160.0/build/three.module.js",
            "three/addons/": "https://cdn.jsdelivr.net/npm/three@0.160.0/examples/jsm/"
        }
    }
    </script>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Outfit', sans-serif;
            background: #0a0a0e;
            color: rgba(255,255,255,0.85);
            overflow: hidden;
            height: 100vh;
            width: 100vw;
            -webkit-font-smoothing: antialiased;
            user-select: none;
        }

        /* ── Noise texture overlay ── */
        body::after {
            content: '';
            position: fixed;
            inset: 0;
            z-index: 200;
            pointer-events: none;
            opacity: 0.3;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
            background-repeat: repeat;
            background-size: 256px 256px;
            mix-blend-mode: overlay;
        }

        /* ── Top bar ── */
        .top-bar {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 100;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 28px;
            transition: opacity 0.6s ease, transform 0.6s ease;
            opacity: 1;
            transform: translateY(0);
            pointer-events: none;
            background: linear-gradient(180deg, rgba(0,0,0,0.5) 0%, transparent 100%);
        }
        .top-bar.hidden {
            opacity: 0;
            transform: translateY(-16px);
        }
        .top-bar > * { pointer-events: auto; }

        .back-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.08);
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            transition: all 0.25s;
            backdrop-filter: blur(12px);
        }
        .back-btn:hover {
            background: rgba(255,255,255,0.12);
            color: #fff;
            border-color: rgba(255,255,255,0.15);
        }
        .back-btn svg { width: 18px; height: 18px; }

        .project-name {
            font-family: 'Instrument Serif', serif;
            font-size: 1.15rem;
            color: rgba(255,255,255,0.7);
            letter-spacing: -0.01em;
            text-align: center;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            white-space: nowrap;
        }

        /* ── Mode toggle ── */
        .mode-toggle {
            display: flex;
            position: relative;
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(12px);
            border-radius: 100px;
            padding: 3px;
            border: 1px solid rgba(255,255,255,0.06);
        }

        .mode-indicator {
            position: absolute;
            top: 3px;
            left: 3px;
            height: calc(100% - 6px);
            width: calc(50% - 3px);
            background: rgba(255,255,255,0.08);
            border-radius: 100px;
            transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
            pointer-events: none;
        }
        .mode-indicator.right { transform: translateX(100%); }

        .mode-btn {
            position: relative;
            z-index: 1;
            padding: 8px 20px;
            border: none;
            border-radius: 100px;
            font-family: 'Outfit', sans-serif;
            font-weight: 500;
            font-size: 0.8rem;
            cursor: pointer;
            transition: color 0.25s;
            background: transparent;
            color: rgba(255,255,255,0.35);
            letter-spacing: 0.02em;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .mode-btn:hover { color: rgba(255,255,255,0.7); }
        .mode-btn.active { color: #fff; }
        .mode-btn svg { width: 14px; height: 14px; opacity: 0.7; }

        /* ── Viewers ── */
        #orbitViewer, #walkViewer {
            position: fixed;
            inset: 0;
            width: 100vw;
            height: 100vh;
            transition: opacity 0.5s ease;
        }
        #orbitViewer { z-index: 1; }
        #orbitViewer model-viewer {
            width: 100%;
            height: 100%;
            --poster-color: transparent;
        }
        #walkViewer { z-index: 2; opacity: 0; pointer-events: none; }
        #walkViewer.active { opacity: 1; pointer-events: auto; }
        #walkViewer canvas { display: block; width: 100% !important; height: 100% !important; }

        /* ── Walk lock hint ── */
        .walk-lock-hint {
            position: absolute;
            inset: 0;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            transition: opacity 0.5s ease;
        }
        .walk-lock-hint.show { opacity: 1; }

        .walk-lock-hint-inner {
            text-align: center;
            padding: 32px 48px;
            border-radius: 24px;
            background: rgba(0,0,0,0.3);
            backdrop-filter: blur(24px);
            border: 1px solid rgba(255,255,255,0.06);
            transform: translateY(8px);
            transition: transform 0.5s ease;
        }
        .walk-lock-hint.show .walk-lock-hint-inner { transform: translateY(0); }

        .walk-lock-hint-inner .icon-wrap {
            width: 48px;
            height: 48px;
            margin: 0 auto 16px;
            border-radius: 50%;
            background: rgba(200,155,108,0.15);
            border: 1px solid rgba(200,155,108,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .walk-lock-hint-inner .icon-wrap svg {
            width: 22px;
            height: 22px;
            color: #C89B6C;
        }
        .walk-lock-hint-inner .title {
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
            font-size: 1rem;
            color: rgba(255,255,255,0.9);
            margin-bottom: 4px;
        }
        .walk-lock-hint-inner .sub {
            font-size: 0.8rem;
            color: rgba(255,255,255,0.35);
            font-weight: 400;
            letter-spacing: 0.01em;
        }
        .walk-lock-hint-inner .keys-row {
            display: flex;
            justify-content: center;
            gap: 6px;
            margin: 14px 0 8px;
        }
        .walk-lock-hint-inner .keys-row kbd {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            background: rgba(255,255,255,0.06);
            border-radius: 8px;
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
            font-size: 0.7rem;
            color: rgba(255,255,255,0.5);
            border: 1px solid rgba(255,255,255,0.06);
        }

        /* ── Walk instructions toast ── */
        .walk-instructions {
            position: absolute;
            bottom: 32px;
            left: 50%;
            transform: translateX(-50%) translateY(12px);
            z-index: 10;
            padding: 10px 22px;
            border-radius: 100px;
            background: rgba(0,0,0,0.5);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.05);
            font-size: 0.75rem;
            color: rgba(255,255,255,0.5);
            display: flex;
            align-items: center;
            gap: 12px;
            opacity: 0;
            transition: opacity 0.4s ease, transform 0.4s ease;
            pointer-events: none;
            white-space: nowrap;
        }
        .walk-instructions.show {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }
        .walk-instructions .keys {
            display: flex;
            gap: 3px;
        }
        .walk-instructions .keys span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 24px; height: 24px;
            background: rgba(255,255,255,0.06);
            border-radius: 5px;
            font-weight: 600;
            font-size: 0.6rem;
            color: rgba(255,255,255,0.4);
            border: 1px solid rgba(255,255,255,0.04);
        }

        /* ── Bottom bar ── */
        .bottom-bar {
            position: fixed;
            bottom: 24px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 90;
            font-size: 0.65rem;
            font-weight: 500;
            color: rgba(255,255,255,0.12);
            letter-spacing: 0.08em;
            text-transform: uppercase;
            pointer-events: none;
            transition: opacity 0.6s ease;
        }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            .top-bar { padding: 14px 16px; }
            .project-name { font-size: 0.95rem; }
            .mode-btn { padding: 6px 14px; font-size: 0.7rem; }
            .mode-btn svg { width: 12px; height: 12px; }
            .walk-lock-hint-inner { padding: 24px 28px; }
            .walk-lock-hint-inner .title { font-size: 0.9rem; }
            .walk-instructions { font-size: 0.65rem; padding: 8px 14px; bottom: 24px; }
        }
    </style>
</head>
<body>

    <!-- Top Bar -->
    <div class="top-bar" id="topBar">
        <a href="{{ route('public.projects.detail', $project) }}" class="back-btn">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 12H5m7-7l-7 7 7 7"/></svg>
        </a>
        <div class="project-name">{{ $project->name }}</div>
        <div class="mode-toggle" id="modeToggle">
            <div class="mode-indicator" id="modeIndicator"></div>
            <button class="mode-btn active" data-mode="orbit" onclick="switchMode('orbit')">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="3"/></svg>
                Orbit
            </button>
            <button class="mode-btn" data-mode="walk" onclick="switchMode('walk')">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M13 5a2 2 0 100-4 2 2 0 000 4z"/><path d="M5 21l3-6 3 2 3-8 3 2"/></svg>
                Walk
            </button>
        </div>
    </div>

    <!-- Orbit Viewer -->
    <div id="orbitViewer">
        <model-viewer
            id="modelViewer"
            src="{{ asset('storage/' . $project->file_3d_path) }}"
            ar ar-modes="webxr scene-viewer quick-look"
            camera-controls
            shadow-intensity="1"
            auto-rotate
            exposure="1"
            interaction-prompt="none">
        </model-viewer>
    </div>

    <!-- Walk Viewer -->
    <div id="walkViewer">
        <div id="walkLockHint" class="walk-lock-hint show" onclick="enterWalkMode()">
            <div class="walk-lock-hint-inner">
                <div class="icon-wrap">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M15.042 21.672L13.684 16.6m0 0l-2.51 2.225.569-9.47 5.227 7.917-3.286-.672zm-7.518-.267A8.25 8.25 0 1120.25 10.5M8.288 14.212A5.25 5.25 0 1117.25 10.5"/></svg>
                </div>
                <div class="title">Click to explore</div>
                <div class="sub">Move through the space freely</div>
                <div class="keys-row">
                    <kbd>W</kbd><kbd>A</kbd><kbd>S</kbd><kbd>D</kbd>
                </div>
                <div class="sub" style="font-size: 0.7rem;">Mouse to look · Scroll to zoom</div>
            </div>
        </div>
        <div id="walkInstructions" class="walk-instructions">
            <div class="keys">
                <span>W</span><span>A</span><span>S</span><span>D</span>
            </div>
            Move · Mouse to look · ESC to pause
        </div>
        <div id="walkCanvas" style="width: 100%; height: 100%;"></div>
    </div>

    <div class="bottom-bar">PropertyU — 3D Virtual Tour</div>

    <script>
        // ── UI: Top bar auto-hide ──
        let hideTimer;
        const topBar = document.getElementById('topBar');

        function showTopBar() {
            topBar.classList.remove('hidden');
            clearTimeout(hideTimer);
            hideTimer = setTimeout(() => topBar.classList.add('hidden'), 2500);
        }
        document.addEventListener('mousemove', showTopBar);
        document.addEventListener('touchstart', showTopBar);
        showTopBar();

        // ── Mode switching ──
        function switchMode(mode) {
            const orbitViewer = document.getElementById('orbitViewer');
            const walkViewer = document.getElementById('walkViewer');
            const btns = document.querySelectorAll('.mode-btn');
            const indicator = document.getElementById('modeIndicator');

            btns.forEach(b => b.classList.toggle('active', b.dataset.mode === mode));
            indicator.classList.toggle('right', mode === 'walk');

            if (mode === 'orbit') {
                walkViewer.classList.remove('active');
                orbitViewer.style.display = 'block';
                setTimeout(() => orbitViewer.style.opacity = '1', 20);
                disposeWalkViewer();
            } else {
                orbitViewer.style.display = 'none';
                walkViewer.classList.add('active');
                initWalkViewer();
            }
            showTopBar();
        }

        function enterWalkMode() {
            if (window.__walkControls && !window.__walkControls.isLocked) {
                window.__walkControls.lock();
            }
        }
    </script>

    <script type="module">
        import * as THREE from 'three';
        import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';
        import { PointerLockControls } from 'three/addons/controls/PointerLockControls.js';

        const modelSrc = '{{ asset('storage/' . $project->file_3d_path) }}';

        let w = {
            initialized: false,
            scene: null, camera: null, renderer: null,
            controls: null, model: null,
            modelCenter: new THREE.Vector3(),
            animId: null,
            moveState: { f: false, b: false, l: false, r: false },
            clock: new THREE.Clock(),
        };

        function kd(e) {
            switch(e.code) {
                case 'KeyW': w.moveState.f = true; e.preventDefault(); break;
                case 'KeyS': w.moveState.b = true; e.preventDefault(); break;
                case 'KeyA': w.moveState.l = true; e.preventDefault(); break;
                case 'KeyD': w.moveState.r = true; e.preventDefault(); break;
            }
        }
        function ku(e) {
            switch(e.code) {
                case 'KeyW': w.moveState.f = false; e.preventDefault(); break;
                case 'KeyS': w.moveState.b = false; e.preventDefault(); break;
                case 'KeyA': w.moveState.l = false; e.preventDefault(); break;
                case 'KeyD': w.moveState.r = false; e.preventDefault(); break;
            }
        }
        function rs() {
            const c = document.getElementById('walkCanvas');
            if (!c || !w.camera || !w.renderer) return;
            const rect = c.getBoundingClientRect();
            w.camera.aspect = rect.width / rect.height;
            w.camera.updateProjectionMatrix();
            w.renderer.setSize(rect.width, rect.height);
        }

        window.initWalkViewer = function() {
            if (w.initialized) return;
            w.initialized = true;

            const container = document.getElementById('walkCanvas');
            const rect = container.getBoundingClientRect();
            const cw = rect.width || window.innerWidth;
            const ch = rect.height || window.innerHeight;

            const scene = new THREE.Scene();
            scene.background = new THREE.Color(0x0a0a0e);

            const camera = new THREE.PerspectiveCamera(70, cw / ch, 0.1, 1000);
            camera.position.set(0, 1.6, 3);

            const renderer = new THREE.WebGLRenderer({ antialias: true });
            renderer.setSize(cw, ch);
            renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
            renderer.shadowMap.enabled = true;
            renderer.shadowMap.type = THREE.PCFSoftShadowMap;
            renderer.toneMapping = THREE.ACESFilmicToneMapping;
            renderer.toneMappingExposure = 1;
            container.appendChild(renderer.domElement);

            const controls = new PointerLockControls(camera, document.body);
            controls.addEventListener('lock', () => {
                document.getElementById('walkLockHint').classList.remove('show');
                document.getElementById('walkInstructions').classList.add('show');
                setTimeout(() => document.getElementById('walkInstructions').classList.remove('show'), 3500);
            });
            controls.addEventListener('unlock', () => {
                document.getElementById('walkLockHint').classList.add('show');
            });
            window.__walkControls = controls;

            scene.add(new THREE.AmbientLight(0xffffff, 0.5));
            scene.add(new THREE.HemisphereLight(0xffffff, 0x444444, 0.4));

            const dl = new THREE.DirectionalLight(0xffffff, 3);
            dl.position.set(5, 15, 5);
            dl.castShadow = true;
            dl.shadow.mapSize.width = 2048;
            dl.shadow.mapSize.height = 2048;
            dl.shadow.camera.far = 50;
            const d = 20;
            dl.shadow.camera.left = -d; dl.shadow.camera.right = d;
            dl.shadow.camera.top = d; dl.shadow.camera.bottom = -d;
            scene.add(dl);

            const fl = new THREE.DirectionalLight(0x88aaff, 0.3);
            fl.position.set(-5, 5, -5);
            scene.add(fl);

            const loader = new GLTFLoader();
            loader.load(modelSrc, (gltf) => {
                const model = gltf.scene;
                model.traverse((n) => { if (n.isMesh) { n.castShadow = true; n.receiveShadow = true; } });
                scene.add(model);
                w.model = model;

                const box = new THREE.Box3().setFromObject(model);
                const center = box.getCenter(new THREE.Vector3());
                w.modelCenter.copy(center);
                const size = box.getSize(new THREE.Vector3());
                const maxDim = Math.max(size.x, size.y, size.z);
                const dist = Math.min(maxDim * 0.8, 8);
                camera.position.set(center.x, center.y + 1.6, center.z + dist);
                camera.lookAt(center.x, center.y + 1.6, center.z);
            });

            w.scene = scene;
            w.camera = camera;
            w.renderer = renderer;
            w.controls = controls;

            document.addEventListener('keydown', kd);
            document.addEventListener('keyup', ku);
            window.addEventListener('resize', rs);
            document.addEventListener('wheel', (e) => {
                if (!controls.isLocked) return;
                const delta = Math.sign(e.deltaY) * -2;
                camera.fov = Math.min(120, Math.max(20, camera.fov + delta));
                camera.updateProjectionMatrix();
            }, { passive: true });

            function animate() {
                w.animId = requestAnimationFrame(animate);
                const delta = w.clock.getDelta();

                if (controls.isLocked) {
                    const speed = 2.5;
                    const dir = new THREE.Vector3();
                    camera.getWorldDirection(dir);
                    dir.y = 0; dir.normalize();

                    const right = new THREE.Vector3();
                    right.crossVectors(dir, camera.up).normalize();

                    const mv = new THREE.Vector3();
                    if (w.moveState.f) mv.add(dir);
                    if (w.moveState.b) mv.sub(dir);
                    if (w.moveState.l) mv.sub(right);
                    if (w.moveState.r) mv.add(right);

                    if (mv.length() > 0) {
                        mv.normalize().multiplyScalar(speed * delta);
                        camera.position.add(mv);
                        camera.position.y = Math.max(w.modelCenter.y + 0.2, camera.position.y);
                    }
                }
                renderer.render(scene, camera);
            }
            animate();
        };

        window.disposeWalkViewer = function() {
            if (w.animId) cancelAnimationFrame(w.animId);
            w.animId = null;
            w.initialized = false;

            document.removeEventListener('keydown', kd);
            document.removeEventListener('keyup', ku);
            window.removeEventListener('resize', rs);

            if (w.controls) {
                w.controls.unlock();
                w.controls.dispose();
                w.controls = null;
            }
            window.__walkControls = null;

            if (w.renderer) {
                const c = document.getElementById('walkCanvas');
                if (c && c.contains(w.renderer.domElement)) c.removeChild(w.renderer.domElement);
                w.renderer.dispose();
                w.renderer = null;
            }
            if (w.model) {
                w.model.traverse((n) => {
                    if (n.isMesh) {
                        n.geometry.dispose();
                        if (Array.isArray(n.material)) n.material.forEach(m => m.dispose());
                        else if (n.material) n.material.dispose();
                    }
                });
                w.model = null;
            }
            if (w.scene) { w.scene.clear(); w.scene = null; }
            w.camera = null;
            w.moveState = { f: false, b: false, l: false, r: false };
            w.clock = new THREE.Clock();
        };
    </script>
</body>
</html>
