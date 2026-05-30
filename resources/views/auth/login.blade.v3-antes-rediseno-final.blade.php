<x-guest-layout>
    <style>
        :root {
            --ed-bg: #020617;
            --ed-cyan: #38bdf8;
            --ed-blue: #2563eb;
            --ed-violet: #7c3aed;
            --ed-purple: #a855f7;
            --ed-text: #f8fafc;
            --ed-muted: #94a3b8;
            --ed-border: rgba(125, 211, 252, 0.24);
            --ed-green: #22c55e;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: var(--ed-bg);
            overflow-x: hidden;
        }

        .ed-auth-shell {
            min-height: 100vh;
            width: 100%;
            display: grid;
            grid-template-columns: minmax(0, 1.15fr) minmax(380px, .85fr);
            align-items: center;
            gap: clamp(2rem, 5vw, 5rem);
            padding: clamp(1.5rem, 4vw, 4.5rem);
            position: relative;
            isolation: isolate;
            color: var(--ed-text);
            overflow: hidden;
            background:
                radial-gradient(circle at 12% 18%, rgba(56, 189, 248, 0.23), transparent 28%),
                radial-gradient(circle at 86% 72%, rgba(124, 58, 237, 0.28), transparent 34%),
                radial-gradient(circle at 42% 100%, rgba(37, 99, 235, 0.20), transparent 34%),
                linear-gradient(135deg, #020617 0%, #050816 52%, #090b1f 100%);
        }

        .ed-auth-shell::before {
            content: "";
            position: absolute;
            inset: -2px;
            background-image:
                linear-gradient(rgba(148, 163, 184, 0.065) 1px, transparent 1px),
                linear-gradient(90deg, rgba(148, 163, 184, 0.065) 1px, transparent 1px);
            background-size: 46px 46px;
            mask-image: radial-gradient(circle at center, black 0%, transparent 78%);
            z-index: -5;
        }

        .ed-auth-shell::after {
            content: "";
            position: absolute;
            inset: 0;
            background:
                linear-gradient(120deg, transparent 0%, rgba(56, 189, 248, .055) 36%, transparent 58%),
                linear-gradient(245deg, transparent 0%, rgba(124, 58, 237, .08) 40%, transparent 66%);
            z-index: -4;
            animation: ed-light-sweep 12s ease-in-out infinite alternate;
        }

        @keyframes ed-light-sweep {
            from {
                transform: translateX(-3%) translateY(-2%);
                opacity: .65;
            }
            to {
                transform: translateX(3%) translateY(2%);
                opacity: 1;
            }
        }

        .ed-network {
            position: absolute;
            inset: 0;
            z-index: -3;
            pointer-events: none;
            opacity: .72;
        }

        .ed-network svg {
            width: 100%;
            height: 100%;
        }

        .ed-network line {
            stroke: rgba(56, 189, 248, .22);
            stroke-width: 1;
            stroke-dasharray: 7 12;
            animation: ed-dash 14s linear infinite;
        }

        .ed-network circle {
            fill: rgba(56, 189, 248, .70);
            filter: drop-shadow(0 0 8px rgba(56, 189, 248, .65));
            animation: ed-node 3s ease-in-out infinite;
        }

        .ed-network circle:nth-child(odd) {
            animation-delay: -1.4s;
        }

        @keyframes ed-dash {
            to {
                stroke-dashoffset: -180;
            }
        }

        @keyframes ed-node {
            0%, 100% {
                opacity: .45;
                transform: scale(1);
            }
            50% {
                opacity: 1;
                transform: scale(1.25);
            }
        }

        .ed-orb {
            position: absolute;
            width: 430px;
            height: 430px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.30), rgba(37, 99, 235, 0.10), transparent 70%);
            filter: blur(12px);
            top: 5%;
            right: 6%;
            z-index: -2;
            animation: ed-float 8s ease-in-out infinite;
        }

        .ed-orb.two {
            width: 320px;
            height: 320px;
            left: 4%;
            bottom: 6%;
            top: auto;
            right: auto;
            background: radial-gradient(circle, rgba(168, 85, 247, 0.30), rgba(56, 189, 248, 0.08), transparent 70%);
            animation-delay: -3s;
        }

        @keyframes ed-float {
            0%, 100% {
                transform: translate3d(0, 0, 0) scale(1);
            }
            50% {
                transform: translate3d(0, -24px, 0) scale(1.04);
            }
        }

        .ed-academic-particles {
            position: absolute;
            inset: 0;
            pointer-events: none;
            z-index: -1;
        }

        .ed-particle {
            position: absolute;
            color: rgba(186, 230, 253, .42);
            border: 1px solid rgba(125, 211, 252, .16);
            background: rgba(15, 23, 42, .30);
            backdrop-filter: blur(10px);
            border-radius: .8rem;
            padding: .38rem .58rem;
            font-weight: 900;
            letter-spacing: -.03em;
            box-shadow: 0 18px 50px rgba(0, 0, 0, .22);
            animation: ed-particle-float 9s ease-in-out infinite;
        }

        .ed-particle.one {
            left: 42%;
            top: 14%;
            font-size: 1rem;
        }

        .ed-particle.two {
            left: 6%;
            bottom: 16%;
            font-size: .9rem;
            animation-delay: -2s;
        }

        .ed-particle.three {
            left: 34%;
            bottom: 28%;
            font-size: .85rem;
            animation-delay: -4s;
        }

        .ed-particle.four {
            right: 36%;
            top: 56%;
            font-size: .82rem;
            animation-delay: -6s;
        }

        .ed-pencil {
            position: absolute;
            left: 48%;
            bottom: 18%;
            width: 96px;
            height: 13px;
            border-radius: 999px;
            background: linear-gradient(90deg, #38bdf8 0%, #60a5fa 52%, #a855f7 100%);
            box-shadow: 0 0 28px rgba(56, 189, 248, .22);
            transform: rotate(-18deg);
            opacity: .58;
            animation: ed-pencil 10s ease-in-out infinite;
        }

        .ed-pencil::before {
            content: "";
            position: absolute;
            right: -15px;
            top: 0;
            border-left: 18px solid rgba(226, 232, 240, .78);
            border-top: 6.5px solid transparent;
            border-bottom: 6.5px solid transparent;
        }

        .ed-pencil::after {
            content: "";
            position: absolute;
            left: -11px;
            top: 1px;
            width: 13px;
            height: 11px;
            border-radius: 4px;
            background: rgba(15, 23, 42, .75);
            border: 1px solid rgba(186, 230, 253, .28);
        }

        @keyframes ed-pencil {
            0%, 100% {
                transform: translateY(0) rotate(-18deg);
            }
            50% {
                transform: translateY(-18px) rotate(-13deg);
            }
        }

        @keyframes ed-particle-float {
            0%, 100% {
                transform: translate3d(0, 0, 0);
                opacity: .35;
            }
            50% {
                transform: translate3d(0, -18px, 0);
                opacity: .72;
            }
        }

        .ed-hero {
            max-width: 720px;
            position: relative;
            z-index: 2;
        }

        .ed-kicker {
            display: inline-flex;
            align-items: center;
            gap: .55rem;
            border: 1px solid var(--ed-border);
            background: rgba(15, 23, 42, 0.55);
            color: #bae6fd;
            padding: .58rem .95rem;
            border-radius: 999px;
            font-size: .78rem;
            font-weight: 900;
            letter-spacing: .08em;
            text-transform: uppercase;
            backdrop-filter: blur(18px);
            margin-bottom: 1.35rem;
            box-shadow: 0 0 28px rgba(56, 189, 248, .08);
        }

        .ed-pulse {
            width: .55rem;
            height: .55rem;
            border-radius: 50%;
            background: var(--ed-cyan);
            box-shadow: 0 0 22px var(--ed-cyan);
            animation: ed-pulse 1.8s ease-in-out infinite;
        }

        @keyframes ed-pulse {
            0%, 100% {
                opacity: .65;
                transform: scale(1);
            }
            50% {
                opacity: 1;
                transform: scale(1.28);
            }
        }

        .ed-title {
            font-size: clamp(3rem, 7.5vw, 7.4rem);
            line-height: .84;
            letter-spacing: -0.085em;
            font-weight: 900;
            margin: 0;
            color: #f8fafc;
            text-shadow: 0 0 38px rgba(56, 189, 248, 0.14);
        }

        .ed-title span {
            display: block;
            color: transparent;
            -webkit-text-stroke: 1px rgba(186, 230, 253, 0.78);
            text-shadow: 0 0 34px rgba(56, 189, 248, 0.26);
        }

        .ed-description {
            margin-top: 1.5rem;
            max-width: 600px;
            color: #cbd5e1;
            font-size: 1.02rem;
            line-height: 1.8;
        }

        .ed-metrics {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: .85rem;
            margin-top: 2rem;
            max-width: 580px;
        }

        .ed-metric {
            border: 1px solid rgba(148, 163, 184, .18);
            background: linear-gradient(180deg, rgba(15, 23, 42, .62), rgba(15, 23, 42, .34));
            border-radius: 1.25rem;
            padding: 1rem;
            backdrop-filter: blur(20px);
            box-shadow:
                0 18px 40px rgba(0, 0, 0, .16),
                inset 0 1px 0 rgba(255,255,255,.04);
            transition: transform .22s ease, border-color .22s ease, background .22s ease;
        }

        .ed-metric:hover {
            transform: translateY(-4px);
            border-color: rgba(56, 189, 248, .42);
            background: linear-gradient(180deg, rgba(15, 23, 42, .80), rgba(15, 23, 42, .48));
        }

        .ed-metric strong {
            display: block;
            color: #f8fafc;
            font-size: 1.35rem;
            line-height: 1.1;
        }

        .ed-metric small {
            color: #94a3b8;
            font-size: .76rem;
        }

        .ed-card {
            width: min(100%, 460px);
            justify-self: center;
            border: 1px solid var(--ed-border);
            background:
                linear-gradient(180deg, rgba(15, 23, 42, .88), rgba(2, 6, 23, .76)),
                radial-gradient(circle at top right, rgba(56, 189, 248, .18), transparent 42%);
            box-shadow:
                0 34px 105px rgba(0, 0, 0, .54),
                0 0 90px rgba(56, 189, 248, .10),
                inset 0 1px 0 rgba(255,255,255,.06);
            border-radius: 2rem;
            padding: 2rem;
            backdrop-filter: blur(30px);
            position: relative;
            overflow: hidden;
            transform: perspective(1000px) rotateY(-2deg);
            transition: transform .25s ease, box-shadow .25s ease;
        }

        .ed-card:hover {
            transform: perspective(1000px) rotateY(0deg) translateY(-3px);
            box-shadow:
                0 42px 120px rgba(0, 0, 0, .58),
                0 0 110px rgba(56, 189, 248, .14),
                inset 0 1px 0 rgba(255,255,255,.07);
        }

        .ed-card::before {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: inherit;
            padding: 1px;
            background: linear-gradient(135deg, rgba(56, 189, 248, .90), transparent 34%, rgba(124, 58, 237, .76));
            -webkit-mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            pointer-events: none;
        }

        .ed-card::after {
            content: "";
            position: absolute;
            width: 220px;
            height: 220px;
            right: -92px;
            top: -92px;
            background: radial-gradient(circle, rgba(56, 189, 248, .30), transparent 68%);
            pointer-events: none;
        }

        .ed-card-head {
            position: relative;
            z-index: 1;
            margin-bottom: 1.35rem;
        }

        .ed-card h2 {
            color: #f8fafc;
            font-size: 1.65rem;
            font-weight: 900;
            margin: 0 0 .35rem;
            letter-spacing: -0.03em;
        }

        .ed-card p {
            color: var(--ed-muted);
            margin: 0;
            font-size: .94rem;
        }

        .ed-secure-badge {
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            margin-top: 1rem;
            color: #bbf7d0;
            background: rgba(22, 101, 52, .14);
            border: 1px solid rgba(34, 197, 94, .20);
            border-radius: 999px;
            padding: .42rem .68rem;
            font-size: .73rem;
            font-weight: 900;
        }

        .ed-secure-dot {
            width: .45rem;
            height: .45rem;
            background: var(--ed-green);
            border-radius: 50%;
            box-shadow: 0 0 14px rgba(34, 197, 94, .8);
        }

        .ed-field {
            margin-bottom: 1.15rem;
            position: relative;
            z-index: 1;
        }

        .ed-label {
            display: block;
            color: #bfdbfe;
            font-size: .80rem;
            font-weight: 900;
            margin-bottom: .45rem;
            letter-spacing: .03em;
        }

        .ed-input {
            width: 100%;
            border: 1px solid rgba(148, 163, 184, .24);
            background: rgba(15, 23, 42, .78);
            color: #f8fafc;
            border-radius: 1rem;
            padding: .92rem 1rem;
            outline: none;
            transition: .22s ease;
            font-size: .94rem;
        }

        .ed-input:focus {
            border-color: rgba(56, 189, 248, .78);
            box-shadow:
                0 0 0 4px rgba(56, 189, 248, .10),
                0 0 34px rgba(56, 189, 248, .13);
            background: rgba(15, 23, 42, .94);
        }

        .ed-input::placeholder {
            color: #64748b;
        }

        .ed-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            margin: .8rem 0 1.3rem;
            color: #cbd5e1;
            font-size: .84rem;
            position: relative;
            z-index: 1;
        }

        .ed-row a {
            color: #7dd3fc;
            text-decoration: none;
            font-weight: 800;
        }

        .ed-row a:hover {
            color: #bae6fd;
        }

        .ed-check {
            display: inline-flex;
            align-items: center;
            gap: .45rem;
        }

        .ed-check input {
            border-radius: .35rem;
            background: rgba(15, 23, 42, .8);
            border-color: rgba(148, 163, 184, .35);
            color: var(--ed-cyan);
        }

        .ed-button {
            width: 100%;
            border: 0;
            border-radius: 1rem;
            padding: .98rem 1rem;
            color: white;
            font-weight: 900;
            letter-spacing: .02em;
            background: linear-gradient(135deg, var(--ed-blue), var(--ed-cyan), var(--ed-violet));
            box-shadow: 0 18px 45px rgba(37, 99, 235, .32);
            transition: transform .22s ease, box-shadow .22s ease, filter .22s ease;
            position: relative;
            z-index: 1;
            overflow: hidden;
            cursor: pointer;
        }

        .ed-button::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(120deg, transparent, rgba(255,255,255,.30), transparent);
            transform: translateX(-120%);
            transition: transform .55s ease;
        }

        .ed-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 24px 64px rgba(56, 189, 248, .32);
            filter: saturate(1.16);
        }

        .ed-button:hover::before {
            transform: translateX(120%);
        }

        .ed-register-link {
            margin-top: 1.35rem;
            text-align: center;
            color: #94a3b8;
            font-size: .88rem;
            position: relative;
            z-index: 1;
        }

        .ed-register-link a {
            color: #7dd3fc;
            text-decoration: none;
            font-weight: 900;
        }

        .ed-error {
            color: #fecaca;
            font-size: .82rem;
            margin-top: .4rem;
        }

        .ed-status {
            color: #bbf7d0;
            border: 1px solid rgba(34, 197, 94, .22);
            background: rgba(22, 101, 52, .16);
            padding: .8rem 1rem;
            border-radius: .9rem;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }

        @media (max-width: 980px) {
            .ed-auth-shell {
                grid-template-columns: 1fr;
                padding: 2rem 1rem;
            }

            .ed-card {
                justify-self: center;
                transform: none;
            }

            .ed-card:hover {
                transform: translateY(-2px);
            }

            .ed-hero {
                text-align: center;
                margin-inline: auto;
            }

            .ed-description,
            .ed-metrics {
                margin-left: auto;
                margin-right: auto;
            }

            .ed-particle.one,
            .ed-particle.four,
            .ed-pencil {
                display: none;
            }
        }

        @media (max-width: 560px) {
            .ed-metrics {
                grid-template-columns: 1fr;
            }

            .ed-card {
                padding: 1.35rem;
                border-radius: 1.5rem;
            }

            .ed-row {
                align-items: flex-start;
                flex-direction: column;
            }

            .ed-title {
                font-size: clamp(2.6rem, 16vw, 4.2rem);
            }
        }
    </style>

    <section class="ed-auth-shell">
        <div class="ed-network">
            <svg viewBox="0 0 1400 700" preserveAspectRatio="none" aria-hidden="true">
                <line x1="80" y1="120" x2="310" y2="210"></line>
                <line x1="310" y1="210" x2="520" y2="110"></line>
                <line x1="520" y1="110" x2="730" y2="250"></line>
                <line x1="730" y1="250" x2="940" y2="150"></line>
                <line x1="940" y1="150" x2="1220" y2="270"></line>
                <line x1="180" y1="510" x2="420" y2="410"></line>
                <line x1="420" y1="410" x2="660" y2="520"></line>
                <line x1="660" y1="520" x2="900" y2="430"></line>
                <line x1="900" y1="430" x2="1210" y2="560"></line>
                <circle cx="80" cy="120" r="4"></circle>
                <circle cx="310" cy="210" r="4"></circle>
                <circle cx="520" cy="110" r="4"></circle>
                <circle cx="730" cy="250" r="4"></circle>
                <circle cx="940" cy="150" r="4"></circle>
                <circle cx="1220" cy="270" r="4"></circle>
                <circle cx="180" cy="510" r="4"></circle>
                <circle cx="420" cy="410" r="4"></circle>
                <circle cx="660" cy="520" r="4"></circle>
                <circle cx="900" cy="430" r="4"></circle>
                <circle cx="1210" cy="560" r="4"></circle>
            </svg>
        </div>

        <div class="ed-orb"></div>
        <div class="ed-orb two"></div>

        <div class="ed-academic-particles">
            <span class="ed-particle one">f(x)</span>
            <span class="ed-particle two">A+</span>
            <span class="ed-particle three">∑ notas</span>
            <span class="ed-particle four">📅</span>
            <span class="ed-pencil"></span>
        </div>

        <div class="ed-hero">
            <div class="ed-kicker">
                <span class="ed-pulse"></span>
                Plataforma académica inteligente
            </div>

            <h1 class="ed-title">
                EDUTOOLS
                <span>CONTROL</span>
                <span>ACADÉMICO</span>
            </h1>

            <p class="ed-description">
                Sistema administrativo para gestionar estudiantes, docentes, cursos, notas,
                asistencia, calendario institucional y portal familiar desde una experiencia
                moderna, segura y centralizada.
            </p>

            <div class="ed-metrics">
                <div class="ed-metric">
                    <strong>360°</strong>
                    <small>Gestión académica</small>
                </div>
                <div class="ed-metric">
                    <strong>Roles</strong>
                    <small>Acceso protegido</small>
                </div>
                <div class="ed-metric">
                    <strong>MySQL</strong>
                    <small>Datos relacionales</small>
                </div>
            </div>
        </div>

        <div class="ed-card">
            <div class="ed-card-head">
                <h2>Acceso institucional</h2>
                <p>Ingresa con tus credenciales para continuar.</p>

                <div class="ed-secure-badge">
                    <span class="ed-secure-dot"></span>
                    Sesión protegida por roles
                </div>
            </div>

            @if (session('status'))
                <div class="ed-status">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="ed-field">
                    <label class="ed-label" for="email">Correo electrónico</label>
                    <input
                        id="email"
                        class="ed-input"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="admin@edutools.test"
                    >
                    @error('email')
                        <div class="ed-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="ed-field">
                    <label class="ed-label" for="password">Contraseña</label>
                    <input
                        id="password"
                        class="ed-input"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="Ingresa tu contraseña"
                    >
                    @error('password')
                        <div class="ed-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="ed-row">
                    <label for="remember_me" class="ed-check">
                        <input id="remember_me" type="checkbox" name="remember">
                        <span>Recordarme</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                    @endif
                </div>

                <button type="submit" class="ed-button">
                    Iniciar sesión
                </button>

                @if (Route::has('register'))
                    <div class="ed-register-link">
                        ¿No tienes cuenta?
                        <a href="{{ route('register') }}">Solicitar acceso</a>
                    </div>
                @endif
            </form>
        </div>
    </section>
</x-guest-layout>
