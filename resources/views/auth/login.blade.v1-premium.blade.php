<x-guest-layout>
    <style>
        :root {
            --ed-bg: #050816;
            --ed-panel: rgba(10, 18, 40, 0.78);
            --ed-border: rgba(125, 211, 252, 0.22);
            --ed-cyan: #38bdf8;
            --ed-blue: #2563eb;
            --ed-violet: #7c3aed;
            --ed-text: #e5f3ff;
            --ed-muted: #9ca3af;
        }

        body {
            background:
                radial-gradient(circle at top left, rgba(56, 189, 248, 0.20), transparent 34%),
                radial-gradient(circle at bottom right, rgba(124, 58, 237, 0.26), transparent 35%),
                linear-gradient(135deg, #020617 0%, #050816 45%, #08111f 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }

        .ed-auth-shell {
            min-height: 100vh;
            width: 100%;
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            align-items: center;
            gap: 3rem;
            padding: 3rem clamp(1.2rem, 4vw, 5rem);
            position: relative;
            isolation: isolate;
            color: var(--ed-text);
        }

        .ed-auth-shell::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(148, 163, 184, 0.08) 1px, transparent 1px),
                linear-gradient(90deg, rgba(148, 163, 184, 0.08) 1px, transparent 1px);
            background-size: 42px 42px;
            mask-image: radial-gradient(circle at center, black 0%, transparent 78%);
            z-index: -2;
        }

        .ed-orb {
            position: absolute;
            width: 380px;
            height: 380px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.30), rgba(37, 99, 235, 0.08), transparent 70%);
            filter: blur(6px);
            top: 8%;
            right: 9%;
            z-index: -1;
            animation: ed-float 8s ease-in-out infinite;
        }

        .ed-orb.two {
            width: 260px;
            height: 260px;
            left: 7%;
            bottom: 10%;
            top: auto;
            right: auto;
            background: radial-gradient(circle, rgba(124, 58, 237, 0.30), rgba(56, 189, 248, 0.08), transparent 70%);
            animation-delay: -3s;
        }

        @keyframes ed-float {
            0%, 100% { transform: translate3d(0, 0, 0) scale(1); }
            50% { transform: translate3d(0, -22px, 0) scale(1.04); }
        }

        .ed-hero {
            max-width: 680px;
        }

        .ed-kicker {
            display: inline-flex;
            align-items: center;
            gap: .55rem;
            border: 1px solid var(--ed-border);
            background: rgba(15, 23, 42, 0.55);
            color: #bae6fd;
            padding: .55rem .9rem;
            border-radius: 999px;
            font-size: .82rem;
            letter-spacing: .08em;
            text-transform: uppercase;
            backdrop-filter: blur(18px);
            margin-bottom: 1.4rem;
        }

        .ed-pulse {
            width: .55rem;
            height: .55rem;
            border-radius: 50%;
            background: var(--ed-cyan);
            box-shadow: 0 0 22px var(--ed-cyan);
        }

        .ed-title {
            font-size: clamp(2.7rem, 7vw, 6.6rem);
            line-height: .88;
            letter-spacing: -0.08em;
            font-weight: 900;
            margin: 0;
            color: #f8fafc;
        }

        .ed-title span {
            display: block;
            color: transparent;
            -webkit-text-stroke: 1px rgba(186, 230, 253, 0.78);
            text-shadow: 0 0 32px rgba(56, 189, 248, 0.22);
        }

        .ed-description {
            margin-top: 1.5rem;
            max-width: 560px;
            color: #cbd5e1;
            font-size: 1.04rem;
            line-height: 1.8;
        }

        .ed-metrics {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: .85rem;
            margin-top: 2rem;
            max-width: 560px;
        }

        .ed-metric {
            border: 1px solid rgba(148, 163, 184, .16);
            background: rgba(15, 23, 42, .45);
            border-radius: 1.25rem;
            padding: 1rem;
            backdrop-filter: blur(20px);
        }

        .ed-metric strong {
            display: block;
            color: #f8fafc;
            font-size: 1.35rem;
        }

        .ed-metric small {
            color: #94a3b8;
            font-size: .76rem;
        }

        .ed-card {
            width: min(100%, 460px);
            justify-self: end;
            border: 1px solid var(--ed-border);
            background:
                linear-gradient(180deg, rgba(15, 23, 42, .86), rgba(2, 6, 23, .72)),
                radial-gradient(circle at top right, rgba(56, 189, 248, .12), transparent 40%);
            box-shadow:
                0 30px 90px rgba(0, 0, 0, .42),
                inset 0 1px 0 rgba(255,255,255,.06);
            border-radius: 2rem;
            padding: 2rem;
            backdrop-filter: blur(28px);
            position: relative;
            overflow: hidden;
        }

        .ed-card::before {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: inherit;
            padding: 1px;
            background: linear-gradient(135deg, rgba(56, 189, 248, .75), transparent 32%, rgba(124, 58, 237, .65));
            -webkit-mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            pointer-events: none;
        }

        .ed-card h2 {
            color: #f8fafc;
            font-size: 1.65rem;
            font-weight: 800;
            margin-bottom: .4rem;
        }

        .ed-card p {
            color: var(--ed-muted);
            margin-bottom: 1.5rem;
        }

        .ed-field {
            margin-bottom: 1.15rem;
        }

        .ed-label {
            display: block;
            color: #bfdbfe;
            font-size: .82rem;
            font-weight: 700;
            margin-bottom: .45rem;
            letter-spacing: .03em;
        }

        .ed-input {
            width: 100%;
            border: 1px solid rgba(148, 163, 184, .24);
            background: rgba(15, 23, 42, .78);
            color: #f8fafc;
            border-radius: 1rem;
            padding: .9rem 1rem;
            outline: none;
            transition: .22s ease;
        }

        .ed-input:focus {
            border-color: rgba(56, 189, 248, .75);
            box-shadow: 0 0 0 4px rgba(56, 189, 248, .10);
            background: rgba(15, 23, 42, .92);
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
            font-size: .88rem;
        }

        .ed-row a {
            color: #7dd3fc;
            text-decoration: none;
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
            padding: .95rem 1rem;
            color: white;
            font-weight: 800;
            letter-spacing: .02em;
            background: linear-gradient(135deg, var(--ed-blue), var(--ed-cyan), var(--ed-violet));
            box-shadow: 0 18px 45px rgba(37, 99, 235, .32);
            transition: transform .22s ease, box-shadow .22s ease;
        }

        .ed-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 24px 60px rgba(56, 189, 248, .30);
        }

        .ed-register-link {
            margin-top: 1.35rem;
            text-align: center;
            color: #94a3b8;
            font-size: .9rem;
        }

        .ed-register-link a {
            color: #7dd3fc;
            text-decoration: none;
            font-weight: 700;
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
        <div class="ed-orb"></div>
        <div class="ed-orb two"></div>

        <div class="ed-hero">
            <div class="ed-kicker">
                <span class="ed-pulse"></span>
                Plataforma académica inteligente
            </div>

            <h1 class="ed-title">
                EDUTOOLS
                <span>CONTROL ACADÉMICO</span>
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
            <h2>Acceso institucional</h2>
            <p>Ingresa con tus credenciales para continuar.</p>

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
                        <a href="{{ route('register') }}">Crear acceso</a>
                    </div>
                @endif
            </form>
        </div>
    </section>
</x-guest-layout>
