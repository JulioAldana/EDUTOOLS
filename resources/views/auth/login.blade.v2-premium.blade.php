<x-guest-layout>
    <style>
        :root {
            --ed-bg: #020617;
            --ed-panel: rgba(8, 13, 31, 0.82);
            --ed-panel-soft: rgba(15, 23, 42, 0.58);
            --ed-border: rgba(125, 211, 252, 0.24);
            --ed-cyan: #38bdf8;
            --ed-blue: #2563eb;
            --ed-violet: #7c3aed;
            --ed-purple: #a855f7;
            --ed-text: #f8fafc;
            --ed-muted: #94a3b8;
            --ed-green: #22c55e;
        }

        * {
            box-sizing: border-box;
        }

        body {
            background: var(--ed-bg);
            min-height: 100vh;
            overflow-x: hidden;
        }

        .ed-auth-shell {
            min-height: 100vh;
            width: 100%;
            display: grid;
            grid-template-columns: minmax(0, 1.15fr) minmax(380px, 0.85fr);
            align-items: center;
            gap: clamp(2rem, 5vw, 5rem);
            padding: clamp(1.4rem, 4vw, 4.5rem);
            position: relative;
            isolation: isolate;
            color: var(--ed-text);
            overflow: hidden;
            background:
                radial-gradient(circle at 12% 18%, rgba(56, 189, 248, 0.22), transparent 28%),
                radial-gradient(circle at 88% 75%, rgba(124, 58, 237, 0.25), transparent 34%),
                radial-gradient(circle at 50% 100%, rgba(37, 99, 235, 0.18), transparent 36%),
                linear-gradient(135deg, #020617 0%, #050816 52%, #090b1f 100%);
        }

        .ed-auth-shell::before {
            content: "";
            position: absolute;
            inset: -2px;
            background-image:
                linear-gradient(rgba(148, 163, 184, 0.07) 1px, transparent 1px),
                linear-gradient(90deg, rgba(148, 163, 184, 0.07) 1px, transparent 1px);
            background-size: 46px 46px;
            mask-image: radial-gradient(circle at center, black 0%, transparent 77%);
            z-index: -4;
        }

        .ed-auth-shell::after {
            content: "";
            position: absolute;
            inset: 0;
            background:
                linear-gradient(115deg, transparent 0%, rgba(56, 189, 248, .055) 35%, transparent 58%),
                linear-gradient(245deg, transparent 0%, rgba(124, 58, 237, .08) 38%, transparent 64%);
            z-index: -3;
            animation: ed-light-sweep 11s ease-in-out infinite alternate;
        }

        @keyframes ed-light-sweep {
            from { transform: translateX(-3%) translateY(-2%); opacity: .7; }
            to { transform: translateX(3%) translateY(2%); opacity: 1; }
        }

        .ed-noise {
            position: absolute;
            inset: 0;
            opacity: .18;
            pointer-events: none;
            z-index: -2;
            background-image:
                radial-gradient(circle at 20% 30%, rgba(255,255,255,.16) 0 1px, transparent 1px),
                radial-gradient(circle at 80% 60%, rgba(255,255,255,.12) 0 1px, transparent 1px),
                radial-gradient(circle at 40% 80%, rgba(255,255,255,.10) 0 1px, transparent 1px);
            background-size: 120px 120px, 180px 180px, 240px 240px;
            animation: ed-stars 18s linear infinite;
        }

        @keyframes ed-stars {
            from { transform: translateY(0); }
            to { transform: translateY(-120px); }
        }

        .ed-orb {
            position: absolute;
            width: 420px;
            height: 420px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.33), rgba(37, 99, 235, 0.10), transparent 70%);
            filter: blur(10px);
            top: 6%;
            right: 8%;
            z-index: -1;
            animation: ed-float 8s ease-in-out infinite;
        }

        .ed-orb.two {
            width: 300px;
            height: 300px;
            left: 5%;
            bottom: 8%;
            top: auto;
            right: auto;
            background: radial-gradient(circle, rgba(168, 85, 247, 0.30), rgba(56, 189, 248, 0.08), transparent 70%);
            animation-delay: -3s;
        }

        @keyframes ed-float {
            0%, 100% { transform: translate3d(0, 0, 0) scale(1); }
            50% { transform: translate3d(0, -24px, 0) scale(1.04); }
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
            font-weight: 800;
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
            0%, 100% { opacity: .65; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.28); }
        }

        .ed-title {
            font-size: clamp(3rem, 7.5vw, 7.4rem);
            line-height: .84;
            letter-spacing: -0.085em;
            font-weight: 900;
            margin: 0;
            color: #f8fafc;
            text-shadow: 0 0 36px rgba(56, 189, 248, 0.12);
        }

        .ed-title span {
            display: block;
            color: transparent;
            -webkit-text-stroke: 1px rgba(186, 230, 253, 0.78);
            text-shadow: 0 0 32px rgba(56, 189, 248, 0.24);
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
            background:
                linear-gradient(180deg, rgba(15, 23, 42, .62), rgba(15, 23, 42, .34));
            border-radius: 1.25rem;
            padding: 1rem;
            backdrop-filter: blur(20px);
            box-shadow: inset 0 1px 0 rgba(255,255,255,.04);
            transition: transform .22s ease, border-color .22s ease;
        }

        .ed-metric:hover {
            transform: translateY(-4px);
            border-color: rgba(56, 189, 248, .42);
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

        .ed-holo-panel {
            position: absolute;
            left: clamp(18rem, 42vw, 42rem);
            top: 13%;
            width: 230px;
            border: 1px solid rgba(56, 189, 248, .22);
            background: rgba(8, 13, 31, .48);
            border-radius: 1.2rem;
            padding: 1rem;
            backdrop-filter: blur(18px);
            box-shadow: 0 25px 70px rgba(0,0,0,.24);
            animation: ed-panel-float 7s ease-in-out infinite;
        }

        .ed-holo-panel.second {
            left: clamp(16rem, 38vw, 39rem);
            top: auto;
            bottom: 13%;
            width: 250px;
            animation-delay: -2.5s;
        }

        @keyframes ed-panel-float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-16px); }
        }

        .ed-holo-label {
            display: flex;
            justify-content: space-between;
            color: #bae6fd;
            font-size: .72rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .08em;
            margin-bottom: .75rem;
        }

        .ed-line {
            height: .48rem;
            border-radius: 999px;
            background: rgba(148, 163, 184, .18);
            overflow: hidden;
            margin: .55rem 0;
        }

        .ed-line span {
            display: block;
            height: 100%;
            width: var(--w);
            border-radius: inherit;
            background: linear-gradient(90deg, var(--ed-blue), var(--ed-cyan), var(--ed-purple));
            box-shadow: 0 0 18px rgba(56, 189, 248, .38);
        }

        .ed-card {
            width: min(100%, 460px);
            justify-self: center;
            border: 1px solid var(--ed-border);
            background:
                linear-gradient(180deg, rgba(15, 23, 42, .88), rgba(2, 6, 23, .76)),
                radial-gradient(circle at top right, rgba(56, 189, 248, .16), transparent 42%);
            box-shadow:
                0 32px 95px rgba(0, 0, 0, .48),
                0 0 80px rgba(56, 189, 248, .08),
                inset 0 1px 0 rgba(255,255,255,.06);
            border-radius: 2rem;
            padding: 2rem;
            backdrop-filter: blur(30px);
            position: relative;
            overflow: hidden;
        }

        .ed-card::before {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: inherit;
            padding: 1px;
            background: linear-gradient(135deg, rgba(56, 189, 248, .85), transparent 32%, rgba(124, 58, 237, .72));
            -webkit-mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            pointer-events: none;
        }

        .ed-card::after {
            content: "";
            position: absolute;
            width: 180px;
            height: 180px;
            right: -70px;
            top: -70px;
            background: radial-gradient(circle, rgba(56, 189, 248, .25), transparent 68%);
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
            font-weight: 800;
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
            font-weight: 800;
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
                0 0 32px rgba(56, 189, 248, .10);
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
            font-weight: 700;
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
        }

        .ed-button::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(120deg, transparent, rgba(255,255,255,.28), transparent);
            transform: translateX(-120%);
            transition: transform .55s ease;
        }

        .ed-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 24px 60px rgba(56, 189, 248, .30);
            filter: saturate(1.15);
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
            font-weight: 800;
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

        @media (max-width: 1160px) {
            .ed-holo-panel,
            .ed-holo-panel.second {
                display: none;
            }
        }

        @media (max-width: 980px) {
            .ed-auth-shell {
                grid-template-columns: 1fr;
                padding: 2rem 1rem;
            }

            .ed-card {
                justify-self: center;
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
        }
    </style>

    <section class="ed-auth-shell">
        <div class="ed-noise"></div>
        <div class="ed-orb"></div>
        <div class="ed-orb two"></div>

        <div class="ed-holo-panel">
            <div class="ed-holo-label">
                <span>Rendimiento</span>
                <span>96%</span>
            </div>
            <div class="ed-line"><span style="--w: 96%;"></span></div>
            <div class="ed-line"><span style="--w: 82%;"></span></div>
            <div class="ed-line"><span style="--w: 74%;"></span></div>
        </div>

        <div class="ed-holo-panel second">
            <div class="ed-holo-label">
                <span>Asistencia</span>
                <span>Activa</span>
            </div>
            <div class="ed-line"><span style="--w: 88%;"></span></div>
            <div class="ed-line"><span style="--w: 69%;"></span></div>
            <div class="ed-line"><span style="--w: 91%;"></span></div>
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
