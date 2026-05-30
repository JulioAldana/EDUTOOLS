<x-guest-layout>
    <style>
        :root {
            --bg-1: #dff3ff;
            --bg-2: #e9dbff;
            --bg-3: #f7d3ec;
            --glass: rgba(255, 255, 255, 0.18);
            --glass-strong: rgba(255, 255, 255, 0.26);
            --glass-border: rgba(255, 255, 255, 0.30);
            --text-main: #111827;
            --text-soft: #4b5563;
            --accent-1: #6ea8ff;
            --accent-2: #9b6dff;
            --accent-3: #f05db3;
            --accent-dark: #2f3f78;
            --white-soft: rgba(255,255,255,0.72);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Figtree, sans-serif;
            overflow-x: hidden;
            background:
                radial-gradient(circle at 15% 25%, rgba(173, 226, 255, 0.95), transparent 28%),
                radial-gradient(circle at 78% 30%, rgba(199, 151, 255, 0.72), transparent 24%),
                radial-gradient(circle at 72% 72%, rgba(255, 133, 196, 0.68), transparent 25%),
                linear-gradient(135deg, var(--bg-1) 0%, var(--bg-2) 48%, var(--bg-3) 100%);
            color: var(--text-main);
        }

        .login-scene {
            position: relative;
            min-height: 100vh;
            overflow: hidden;
            isolation: isolate;
        }

        .login-scene::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                linear-gradient(rgba(255,255,255,0.08) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.08) 1px, transparent 1px);
            background-size: 46px 46px;
            mask-image: radial-gradient(circle at center, black 0%, transparent 86%);
            z-index: -5;
            pointer-events: none;
        }

        .bg-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            opacity: 0.62;
            pointer-events: none;
            z-index: -4;
            animation: blobFloat 12s ease-in-out infinite;
        }

        .bg-blob.one {
            width: 430px;
            height: 430px;
            left: -120px;
            top: 60px;
            background: rgba(126, 211, 255, 0.55);
        }

        .bg-blob.two {
            width: 380px;
            height: 380px;
            right: 12%;
            top: 12%;
            background: rgba(182, 126, 255, 0.45);
            animation-delay: -3s;
        }

        .bg-blob.three {
            width: 420px;
            height: 420px;
            right: -80px;
            bottom: -40px;
            background: rgba(255, 121, 188, 0.40);
            animation-delay: -6s;
        }

        @keyframes blobFloat {
            0%, 100% {
                transform: translateY(0) scale(1);
            }
            50% {
                transform: translateY(-18px) scale(1.04);
            }
        }

        #academic-rain {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
            opacity: 0.58;
            pointer-events: none;
        }

        .content-shell {
            min-height: 100vh;
            display: grid;
            grid-template-columns: minmax(0, 1.15fr) minmax(390px, 0.85fr);
            align-items: center;
            gap: clamp(2rem, 5vw, 6rem);
            padding: clamp(1.4rem, 4vw, 4rem);
            position: relative;
        }

        .hero-panel {
            position: relative;
            max-width: 720px;
            z-index: 2;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: .6rem;
            padding: .7rem 1rem;
            border-radius: 999px;
            background: rgba(255,255,255,0.30);
            border: 1px solid rgba(255,255,255,0.42);
            box-shadow: 0 10px 30px rgba(101, 116, 205, 0.14);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            font-size: .8rem;
            font-weight: 800;
            letter-spacing: .10em;
            text-transform: uppercase;
            color: #2f3f78;
            margin-bottom: 1.2rem;
        }

        .hero-badge-dot {
            width: .6rem;
            height: .6rem;
            border-radius: 50%;
            background: linear-gradient(135deg, #6ea8ff, #f05db3);
            box-shadow: 0 0 18px rgba(240, 93, 179, 0.55);
        }

        .hero-title {
            margin: 0;
            font-size: clamp(3.1rem, 7vw, 6.4rem);
            line-height: .92;
            letter-spacing: -0.08em;
            font-weight: 900;
            color: #101828;
            text-shadow: 0 8px 24px rgba(255,255,255,0.30);
        }

        .hero-title .outline {
            display: block;
            color: transparent;
            -webkit-text-stroke: 1.4px rgba(50, 64, 120, 0.45);
            text-shadow: none;
        }

        .hero-text {
            max-width: 620px;
            margin-top: 1.4rem;
            font-size: 1.05rem;
            line-height: 1.9;
            color: var(--text-soft);
        }

        .hero-chips {
            display: flex;
            flex-wrap: wrap;
            gap: .9rem;
            margin-top: 2rem;
        }

        .hero-chip {
            padding: 1rem 1.1rem;
            min-width: 145px;
            border-radius: 1.3rem;
            background: rgba(255,255,255,0.18);
            border: 1px solid rgba(255,255,255,0.34);
            box-shadow:
                0 18px 40px rgba(91, 96, 160, 0.12),
                inset 0 1px 0 rgba(255,255,255,0.35);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }

        .hero-chip strong {
            display: block;
            font-size: 1.35rem;
            line-height: 1.1;
            color: #172033;
        }

        .hero-chip small {
            color: #5f667a;
            font-size: .8rem;
        }

        .floating-note {
            position: absolute;
            right: -2%;
            top: 7%;
            width: 140px;
            padding: .85rem .95rem;
            border-radius: 1.2rem;
            background: rgba(255,255,255,0.18);
            border: 1px solid rgba(255,255,255,0.32);
            box-shadow: 0 20px 48px rgba(83, 87, 148, 0.14);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            color: #31406b;
            font-weight: 800;
            font-size: .88rem;
            animation: floatCard 8s ease-in-out infinite;
        }

        .floating-note.two {
            right: 2%;
            bottom: 5%;
            top: auto;
            width: 155px;
            animation-delay: -4s;
        }

        .floating-note .mini {
            display: block;
            margin-top: .3rem;
            font-size: .75rem;
            color: #667085;
            font-weight: 600;
        }

        @keyframes floatCard {
            0%, 100% {
                transform: translateY(0) rotate(-2deg);
            }
            50% {
                transform: translateY(-14px) rotate(1deg);
            }
        }

        .auth-panel-wrap {
            position: relative;
            display: flex;
            justify-content: center;
            z-index: 2;
        }

        .panel-glow {
            position: absolute;
            width: 520px;
            height: 520px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(240,93,179,0.22), rgba(110,168,255,0.18), transparent 70%);
            filter: blur(46px);
            z-index: -1;
        }

        .auth-panel {
            width: min(100%, 430px);
            padding: 2.1rem;
            border-radius: 2rem;
            background: rgba(255,255,255,0.17);
            border: 1px solid rgba(255,255,255,0.34);
            box-shadow:
                0 30px 80px rgba(92, 95, 161, 0.18),
                inset 0 1px 0 rgba(255,255,255,0.38);
            backdrop-filter: blur(22px);
            -webkit-backdrop-filter: blur(22px);
            position: relative;
            overflow: hidden;
        }

        .auth-panel::before {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: inherit;
            background:
                linear-gradient(145deg, rgba(255,255,255,0.18), transparent 35%),
                linear-gradient(325deg, rgba(255,255,255,0.12), transparent 40%);
            pointer-events: none;
        }

        .auth-icon {
            width: 74px;
            height: 74px;
            margin: 0 auto 1.1rem;
            border-radius: 50%;
            display: grid;
            place-items: center;
            background: rgba(255,255,255,0.20);
            border: 1px solid rgba(255,255,255,0.35);
            box-shadow: 0 12px 30px rgba(112, 101, 200, 0.12);
            color: #31406b;
            font-size: 1.8rem;
            position: relative;
            z-index: 1;
        }

        .auth-title {
            text-align: center;
            margin: 0;
            font-size: 2rem;
            font-weight: 900;
            letter-spacing: -0.04em;
            color: #172033;
            position: relative;
            z-index: 1;
        }

        .auth-subtitle {
            text-align: center;
            margin: .5rem 0 1.4rem;
            color: #5b6477;
            font-size: .95rem;
            line-height: 1.7;
            position: relative;
            z-index: 1;
        }

        .secure-pill {
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            margin: 0 auto 1.4rem;
            padding: .5rem .8rem;
            border-radius: 999px;
            background: rgba(255,255,255,0.24);
            border: 1px solid rgba(255,255,255,0.34);
            color: #31526a;
            font-size: .75rem;
            font-weight: 800;
            position: relative;
            z-index: 1;
        }

        .secure-pill-dot {
            width: .5rem;
            height: .5rem;
            border-radius: 50%;
            background: linear-gradient(135deg, #6ea8ff, #f05db3);
            box-shadow: 0 0 14px rgba(240,93,179,0.50);
        }

        .status-box {
            margin-bottom: 1rem;
            padding: .85rem 1rem;
            border-radius: 1rem;
            background: rgba(255,255,255,0.22);
            border: 1px solid rgba(255,255,255,0.34);
            color: #27446e;
            font-size: .92rem;
            position: relative;
            z-index: 1;
        }

        .field-block {
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }

        .field-label {
            display: block;
            font-size: .84rem;
            font-weight: 800;
            color: #31406b;
            margin-bottom: .45rem;
        }

        .field-input {
            width: 100%;
            border: 1px solid rgba(255,255,255,0.34);
            background: rgba(255,255,255,0.50);
            color: #172033;
            border-radius: 1rem;
            padding: .95rem 1rem;
            font-size: .95rem;
            outline: none;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.22);
            transition: .25s ease;
        }

        .field-input::placeholder {
            color: #7b8192;
        }

        .field-input:focus {
            background: rgba(255,255,255,0.62);
            border-color: rgba(255,255,255,0.52);
            box-shadow:
                0 0 0 5px rgba(173, 226, 255, 0.35),
                0 12px 28px rgba(160, 138, 255, 0.14);
            transform: translateY(-1px);
        }

        .error-box {
            margin-top: .4rem;
            color: #a11b63;
            font-size: .83rem;
            font-weight: 600;
        }

        .row-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            margin: .9rem 0 1.2rem;
            position: relative;
            z-index: 1;
        }

        .remember-box {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            color: #4b5563;
            font-size: .87rem;
        }

        .remember-box input {
            width: 16px;
            height: 16px;
            accent-color: #8d75ff;
        }

        .link-soft {
            color: #4c57c7;
            text-decoration: none;
            font-size: .87rem;
            font-weight: 700;
        }

        .link-soft:hover {
            color: #d13f95;
        }

        .primary-btn {
            width: 100%;
            border: none;
            border-radius: 1rem;
            padding: 1rem 1rem;
            font-size: .98rem;
            font-weight: 900;
            color: white;
            cursor: pointer;
            background: linear-gradient(135deg, #6ea8ff 0%, #8f79ff 48%, #f05db3 100%);
            box-shadow:
                0 18px 36px rgba(143, 121, 255, 0.28),
                inset 0 1px 0 rgba(255,255,255,0.24);
            transition: .25s ease;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .primary-btn::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(120deg, transparent, rgba(255,255,255,0.28), transparent);
            transform: translateX(-120%);
            transition: transform .6s ease;
        }

        .primary-btn:hover {
            transform: translateY(-2px);
            box-shadow:
                0 24px 44px rgba(143, 121, 255, 0.34),
                inset 0 1px 0 rgba(255,255,255,0.28);
        }

        .primary-btn:hover::before {
            transform: translateX(120%);
        }

        .register-box {
            margin-top: 1.2rem;
            text-align: center;
            color: #5e6578;
            font-size: .9rem;
            position: relative;
            z-index: 1;
        }

        .register-box a {
            color: #4c57c7;
            font-weight: 800;
            text-decoration: none;
        }

        .register-box a:hover {
            color: #d13f95;
        }

        @media (max-width: 1100px) {
            .floating-note {
                display: none;
            }
        }

        @media (max-width: 980px) {
            .content-shell {
                grid-template-columns: 1fr;
                padding: 1.5rem 1rem 2rem;
            }

            .hero-panel {
                text-align: center;
                margin-inline: auto;
            }

            .hero-text {
                margin-left: auto;
                margin-right: auto;
            }

            .hero-chips {
                justify-content: center;
            }
        }

        @media (max-width: 560px) {
            .hero-title {
                font-size: clamp(2.7rem, 16vw, 4.5rem);
            }

            .auth-panel {
                padding: 1.35rem;
                border-radius: 1.5rem;
            }

            .row-actions {
                flex-direction: column;
                align-items: flex-start;
            }

            .hero-chips {
                gap: .7rem;
            }

            .hero-chip {
                min-width: 100%;
            }
        }
    </style>

    <section class="login-scene">
        <canvas id="academic-rain"></canvas>

        <div class="bg-blob one"></div>
        <div class="bg-blob two"></div>
        <div class="bg-blob three"></div>

        <div class="content-shell">
            <div class="hero-panel">
                <div class="hero-badge">
                    <span class="hero-badge-dot"></span>
                    Plataforma académica inteligente
                </div>

                <h1 class="hero-title">
                    EDUTOOLS
                    <span class="outline">CONTROL</span>
                    <span class="outline">ACADÉMICO</span>
                </h1>

                <p class="hero-text">
                    Plataforma educativa para administrar estudiantes, docentes, cursos,
                    notas, asistencia, calendario institucional y acceso familiar desde una
                    experiencia moderna, visual y tecnológicamente elegante.
                </p>

                <div class="hero-chips">
                    <div class="hero-chip">
                        <strong>360°</strong>
                        <small>Gestión académica</small>
                    </div>
                    <div class="hero-chip">
                        <strong>Roles</strong>
                        <small>Acceso protegido</small>
                    </div>
                    <div class="hero-chip">
                        <strong>MySQL</strong>
                        <small>Datos estructurados</small>
                    </div>
                </div>

                <div class="floating-note">
                    Rendimiento A+
                    <span class="mini">Monitoreo académico</span>
                </div>

                <div class="floating-note two">
                    Calendario activo
                    <span class="mini">Control institucional</span>
                </div>
            </div>

            <div class="auth-panel-wrap">
                <div class="panel-glow"></div>

                <div class="auth-panel">
                    <div class="auth-icon">◎</div>

                    <h2 class="auth-title">Acceso institucional</h2>
                    <p class="auth-subtitle">
                        Ingresa con tus credenciales para continuar en el entorno académico.
                    </p>

                    <div style="text-align:center;">
                        <div class="secure-pill">
                            <span class="secure-pill-dot"></span>
                            Sesión protegida por roles
                        </div>
                    </div>

                    @if (session('status'))
                        <div class="status-box">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="field-block">
                            <label class="field-label" for="email">Correo electrónico</label>
                            <input
                                id="email"
                                class="field-input"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="admin@edutools.test"
                            >
                            @error('email')
                                <div class="error-box">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="field-block">
                            <label class="field-label" for="password">Contraseña</label>
                            <input
                                id="password"
                                class="field-input"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="Ingresa tu contraseña"
                            >
                            @error('password')
                                <div class="error-box">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row-actions">
                            <label for="remember_me" class="remember-box">
                                <input id="remember_me" type="checkbox" name="remember">
                                <span>Recordarme</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a class="link-soft" href="{{ route('password.request') }}">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            @endif
                        </div>

                        <button type="submit" class="primary-btn">
                            Iniciar sesión
                        </button>

                        @if (Route::has('register'))
                            <div class="register-box">
                                ¿No tienes cuenta?
                                <a href="{{ route('register') }}">Solicitar acceso</a>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
    (() => {
        const canvas = document.getElementById('academic-rain');
        if (!canvas) return;

        const ctx = canvas.getContext('2d');

        const symbols = [
            '✏︎', '📘', '📚', '📝', '📒', '📓', '📔', '📐', '📏', '🧮',
            '🗓', '🎓', 'A+', '100', 'π', '∑', '√', 'Δ', 'f(x)', 'x²',
            'ABC', '123', 'nota', 'quiz', 'tarea', 'curso', 'clase'
        ];

        let width = 0;
        let height = 0;
        let drops = [];
        let animationId = null;

        function randomBetween(min, max) {
            return Math.random() * (max - min) + min;
        }

        function pick(arr) {
            return arr[Math.floor(Math.random() * arr.length)];
        }

        function createDrop(x, layer) {
            let size, speed, alpha, sway, color;

            if (layer === 'back') {
                size = randomBetween(14, 18);
                speed = randomBetween(0.38, 0.54);
                alpha = randomBetween(0.10, 0.16);
                sway = randomBetween(0.15, 0.35);
                color = 'rgba(110, 168, 255, 1)';
            } else if (layer === 'mid') {
                size = randomBetween(18, 24);
                speed = randomBetween(0.48, 0.68);
                alpha = randomBetween(0.16, 0.24);
                sway = randomBetween(0.25, 0.55);
                color = 'rgba(155, 109, 255, 1)';
            } else {
                size = randomBetween(22, 30);
                speed = randomBetween(0.56, 0.78);
                alpha = randomBetween(0.20, 0.30);
                sway = randomBetween(0.35, 0.75);
                color = 'rgba(240, 93, 179, 1)';
            }

            return {
                x,
                baseX: x,
                y: randomBetween(-height, 0),
                size,
                speed,
                alpha,
                sway,
                phase: randomBetween(0, Math.PI * 2),
                symbol: pick(symbols),
                color,
                layer
            };
        }

        function buildDrops() {
            drops = [];

            const spacingBack = width < 768 ? 85 : 95;
            const spacingMid = width < 768 ? 110 : 125;
            const spacingFront = width < 768 ? 145 : 165;

            for (let x = 20; x < width; x += spacingBack) {
                drops.push(createDrop(x, 'back'));
            }

            for (let x = 50; x < width; x += spacingMid) {
                drops.push(createDrop(x, 'mid'));
            }

            for (let x = 90; x < width; x += spacingFront) {
                drops.push(createDrop(x, 'front'));
            }
        }

        function resizeCanvas() {
            width = canvas.width = window.innerWidth;
            height = canvas.height = window.innerHeight;
            buildDrops();
        }

        function drawDrop(drop, time) {
            const swayOffset = Math.sin((time * 0.0007) + drop.phase + drop.y * 0.01) * (8 * drop.sway);
            const drawX = drop.baseX + swayOffset;

            ctx.save();
            ctx.globalAlpha = drop.alpha;
            ctx.font = `700 ${drop.size}px Figtree, sans-serif`;
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            ctx.fillStyle = drop.color;

            if (drop.layer === 'front') {
                ctx.shadowColor = 'rgba(255,255,255,0.18)';
                ctx.shadowBlur = 10;
            } else if (drop.layer === 'mid') {
                ctx.shadowColor = 'rgba(255,255,255,0.08)';
                ctx.shadowBlur = 5;
            }

            ctx.fillText(drop.symbol, drawX, drop.y);
            ctx.restore();
        }

        function updateDrop(drop) {
            drop.y += drop.speed;

            if (Math.random() < 0.0025) {
                drop.symbol = pick(symbols);
            }

            if (drop.y > height + 60) {
                drop.y = randomBetween(-180, -40);
                drop.symbol = pick(symbols);
            }
        }

        function animate(time = 0) {
            ctx.clearRect(0, 0, width, height);

            for (const drop of drops) {
                drawDrop(drop, time);
                updateDrop(drop);
            }

            animationId = requestAnimationFrame(animate);
        }

        resizeCanvas();
        animate();

        window.addEventListener('resize', () => {
            if (animationId) cancelAnimationFrame(animationId);
            resizeCanvas();
            animate();
        });
    })();
    </script>
</x-guest-layout>




