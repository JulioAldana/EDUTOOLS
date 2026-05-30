<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'EDUTOOLS') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --admin-bg: #02040d;
            --admin-bg-2: #050816;
            --admin-panel: rgba(7, 12, 28, 0.58);
            --admin-panel-strong: rgba(8, 14, 31, 0.78);
            --admin-border: rgba(104, 224, 255, 0.20);
            --admin-border-strong: rgba(104, 224, 255, 0.38);
            --admin-cyan: #38d9ff;
            --admin-cyan-soft: rgba(56, 217, 255, 0.16);
            --admin-fuchsia: #f35dbb;
            --admin-fuchsia-soft: rgba(243, 93, 187, 0.16);
            --admin-violet: #725cff;
            --admin-text: #f2fbff;
            --admin-muted: #9fb4ca;
            --admin-muted-2: #6f8299;
            --admin-radius-xl: 30px;
            --admin-radius-lg: 22px;
            --admin-shadow: 0 30px 90px rgba(0, 0, 0, 0.42);
        }

        * {
            box-sizing: border-box;
        }

        html {
            min-height: 100%;
            background: var(--admin-bg);
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: var(--admin-bg);
            color: var(--admin-text);
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            z-index: -3;
            background:
                radial-gradient(circle at 8% 10%, rgba(56, 217, 255, 0.22), transparent 28%),
                radial-gradient(circle at 92% 12%, rgba(243, 93, 187, 0.18), transparent 30%),
                radial-gradient(circle at 78% 88%, rgba(114, 92, 255, 0.16), transparent 34%),
                linear-gradient(135deg, #02040d 0%, #050816 48%, #0b0618 100%);
        }

        body::after {
            content: "";
            position: fixed;
            inset: 0;
            z-index: -2;
            opacity: 0.46;
            pointer-events: none;
            background-image:
                linear-gradient(rgba(255,255,255,0.035) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px);
            background-size: 70px 70px;
            mask-image: radial-gradient(circle at center, black, transparent 78%);
        }

        .admin-shell {
            position: relative;
            min-height: 100vh;
            display: flex;
            isolation: isolate;
        }

        .admin-shell::before,
        .admin-shell::after {
            content: "";
            position: fixed;
            width: 520px;
            height: 520px;
            border-radius: 999px;
            pointer-events: none;
            z-index: -1;
            filter: blur(40px);
            opacity: 0.78;
        }

        .admin-shell::before {
            left: 210px;
            top: -230px;
            background: radial-gradient(circle, rgba(56, 217, 255, 0.25), transparent 68%);
        }

        .admin-shell::after {
            right: -190px;
            bottom: -220px;
            background: radial-gradient(circle, rgba(243, 93, 187, 0.22), transparent 70%);
        }

        .admin-sidebar {
            width: 292px;
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            z-index: 1000;
            padding: 1.05rem;
            overflow-y: auto;
            background:
                linear-gradient(180deg, rgba(2, 5, 16, 0.72), rgba(5, 8, 22, 0.50)),
                radial-gradient(circle at 18% 0%, rgba(56, 217, 255, 0.36), transparent 38%),
                radial-gradient(circle at 92% 14%, rgba(243, 93, 187, 0.30), transparent 34%),
                linear-gradient(145deg, rgba(255,255,255,0.04), rgba(255,255,255,0.01));
            border-right: 1px solid rgba(104, 224, 255, 0.16);
            box-shadow:
                28px 0 90px rgba(0, 0, 0, 0.46),
                inset -1px 0 0 rgba(255,255,255,0.04);
            backdrop-filter: blur(28px);
            -webkit-backdrop-filter: blur(28px);
        }

        .admin-sidebar::before {
            content: "";
            position: absolute;
            inset: 0;
            pointer-events: none;
            background:
                linear-gradient(90deg, rgba(56, 217, 255, 0.11), transparent 8%, transparent 90%, rgba(243, 93, 187, 0.10)),
                linear-gradient(180deg, rgba(255,255,255,0.05), transparent 18%);
            opacity: 0.86;
        }

        .admin-sidebar-inner {
            position: relative;
            z-index: 2;
        }

        .admin-brand {
            position: relative;
            display: flex;
            align-items: center;
            gap: 0.85rem;
            padding: 0.9rem;
            margin-bottom: 1.25rem;
            border-radius: 28px;
            color: var(--admin-text);
            background:
                linear-gradient(135deg, rgba(255,255,255,0.07), rgba(255,255,255,0.02)),
                radial-gradient(circle at top left, rgba(56, 217, 255, 0.18), transparent 44%),
                radial-gradient(circle at bottom right, rgba(243, 93, 187, 0.16), transparent 42%);
            border: 1px solid rgba(104, 224, 255, 0.22);
            box-shadow:
                0 24px 60px rgba(0,0,0,0.24),
                inset 0 1px 0 rgba(255,255,255,0.07);
            overflow: hidden;
        }

        .admin-brand::after {
            content: "";
            position: absolute;
            inset: -1px;
            border-radius: inherit;
            pointer-events: none;
            background: linear-gradient(135deg, rgba(56,217,255,.38), transparent 34%, rgba(243,93,187,.30));
            opacity: .22;
            mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
            -webkit-mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
            padding: 1px;
            -webkit-mask-composite: xor;
            mask-composite: exclude;
        }

        .admin-brand-icon {
            width: 52px;
            height: 52px;
            flex: 0 0 52px;
            border-radius: 20px;
            display: grid;
            place-items: center;
            background:
                radial-gradient(circle at 30% 20%, rgba(255,255,255,0.85), transparent 18%),
                linear-gradient(135deg, var(--admin-cyan), var(--admin-violet), var(--admin-fuchsia));
            color: #ffffff;
            font-size: 1.45rem;
            box-shadow:
                0 18px 42px rgba(56, 217, 255, 0.20),
                0 0 42px rgba(243, 93, 187, 0.14);
        }

        .admin-brand-title {
            color: #ffffff;
            font-size: 1.18rem;
            line-height: 1;
            font-weight: 950;
            letter-spacing: -0.045em;
        }

        .admin-brand-subtitle {
            margin-top: .28rem;
            color: var(--admin-muted);
            font-size: .76rem;
            font-weight: 700;
        }

        .admin-nav-label {
            display: flex;
            align-items: center;
            gap: .55rem;
            margin: 1rem .2rem .52rem;
            padding: 0 .55rem;
            color: rgba(189, 239, 255, 0.58);
            font-size: .68rem;
            font-weight: 950;
            text-transform: uppercase;
            letter-spacing: .13em;
        }

        .admin-nav-label::after {
            content: "";
            height: 1px;
            flex: 1;
            background: linear-gradient(90deg, rgba(104,224,255,.24), transparent);
        }

        .admin-nav-link {
            position: relative;
            display: flex;
            align-items: center;
            gap: .78rem;
            width: 100%;
            padding: .86rem .9rem;
            margin-bottom: .32rem;
            border-radius: 18px;
            color: rgba(231, 244, 255, 0.78);
            text-decoration: none;
            border: 1px solid transparent;
            background: transparent;
            transition:
                transform .22s ease,
                border-color .22s ease,
                background .22s ease,
                box-shadow .22s ease,
                color .22s ease;
        }

        .admin-nav-link::before {
            content: "";
            position: absolute;
            left: -4px;
            width: 4px;
            height: 0;
            border-radius: 999px;
            background: linear-gradient(180deg, var(--admin-cyan), var(--admin-fuchsia));
            box-shadow: 0 0 18px rgba(56, 217, 255, .44);
            transition: height .22s ease;
        }

        .admin-nav-link i {
            width: 24px;
            color: #82e7ff;
            font-size: 1.08rem;
            text-align: center;
            transition: color .22s ease, transform .22s ease;
        }

        .admin-nav-link span {
            font-size: .92rem;
            font-weight: 760;
            letter-spacing: -0.015em;
        }

        .admin-nav-link:hover {
            color: #ffffff;
            transform: translateX(4px);
            border-color: rgba(104, 224, 255, 0.20);
            background:
                linear-gradient(135deg, rgba(56,217,255,0.10), rgba(243,93,187,0.06));
            box-shadow: 0 18px 40px rgba(0,0,0,0.20);
        }

        .admin-nav-link:hover::before,
        .admin-nav-link.active::before {
            height: 25px;
        }

        .admin-nav-link:hover i {
            color: #ffffff;
            transform: scale(1.06);
        }

        .admin-nav-link.active {
            color: #ffffff;
            border-color: rgba(104, 224, 255, 0.34);
            background:
                radial-gradient(circle at 18% 18%, rgba(56,217,255,0.22), transparent 46%),
                radial-gradient(circle at 100% 50%, rgba(243,93,187,0.18), transparent 42%),
                linear-gradient(135deg, rgba(255,255,255,0.08), rgba(255,255,255,0.025));
            box-shadow:
                0 22px 54px rgba(0,0,0,0.28),
                inset 0 1px 0 rgba(255,255,255,0.07);
        }

        .admin-nav-link.active i {
            color: #ff8bd3;
        }

        .admin-logout {
            margin-top: 1.15rem;
            padding-top: 1rem;
            border-top: 1px solid rgba(255,255,255,0.08);
        }

        .admin-main {
            margin-left: 292px;
            width: calc(100% - 292px);
            min-height: 100vh;
            position: relative;
        }

        .admin-topbar {
            min-height: 82px;
            position: sticky;
            top: 0;
            z-index: 900;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            padding: 1rem 1.55rem;
            background:
                linear-gradient(135deg, rgba(2, 5, 16, 0.82), rgba(7, 12, 28, 0.58)),
                radial-gradient(circle at 18% 0%, rgba(56,217,255,0.13), transparent 30%),
                radial-gradient(circle at 90% 0%, rgba(243,93,187,0.12), transparent 34%);
            border-bottom: 1px solid rgba(104, 224, 255, 0.15);
            box-shadow: 0 24px 70px rgba(0,0,0,0.24);
            backdrop-filter: blur(26px);
            -webkit-backdrop-filter: blur(26px);
        }

        .admin-topbar::before {
            content: "";
            position: absolute;
            left: 1.5rem;
            right: 1.5rem;
            bottom: -1px;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(56,217,255,.50), rgba(243,93,187,.42), transparent);
            opacity: .62;
        }

        .admin-title-kicker {
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            margin-bottom: .22rem;
            color: #9eeeff;
            font-size: .7rem;
            font-weight: 950;
            text-transform: uppercase;
            letter-spacing: .12em;
        }

        .admin-title-kicker::before {
            content: "";
            width: .48rem;
            height: .48rem;
            border-radius: 999px;
            background: linear-gradient(135deg, var(--admin-cyan), var(--admin-fuchsia));
            box-shadow: 0 0 18px rgba(56,217,255,.48);
        }

        .admin-topbar h1 {
            margin: 0;
            color: #ffffff;
            font-size: clamp(1.12rem, 2vw, 1.42rem);
            font-weight: 950;
            letter-spacing: -0.045em;
        }

        .admin-topbar p {
            margin: .18rem 0 0;
            color: var(--admin-muted);
            font-size: .9rem;
        }

        .admin-user-chip {
            display: flex;
            align-items: center;
            gap: .78rem;
            min-width: 220px;
            padding: .55rem .7rem .55rem .55rem;
            border-radius: 999px;
            color: var(--admin-text);
            background:
                linear-gradient(135deg, rgba(255,255,255,0.075), rgba(255,255,255,0.025)),
                radial-gradient(circle at 15% 50%, rgba(56,217,255,.18), transparent 42%);
            border: 1px solid rgba(104, 224, 255, 0.23);
            box-shadow:
                0 20px 50px rgba(0,0,0,0.22),
                inset 0 1px 0 rgba(255,255,255,0.07);
        }

        .admin-user-avatar {
            width: 42px;
            height: 42px;
            flex: 0 0 42px;
            border-radius: 999px;
            display: grid;
            place-items: center;
            color: #ffffff;
            font-weight: 950;
            background:
                radial-gradient(circle at 30% 20%, rgba(255,255,255,.85), transparent 18%),
                linear-gradient(135deg, var(--admin-cyan), var(--admin-violet), var(--admin-fuchsia));
            box-shadow:
                0 14px 34px rgba(56,217,255,.22),
                0 0 30px rgba(243,93,187,.14);
        }

        .admin-user-name {
            max-width: 150px;
            color: #ffffff;
            font-size: .86rem;
            font-weight: 850;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .admin-user-role {
            color: var(--admin-muted);
            font-size: .74rem;
            font-weight: 700;
            text-transform: capitalize;
        }

        .admin-content {
            position: relative;
            padding: 1.35rem;
        }

        @media (max-width: 991.98px) {
            body::after {
                opacity: .25;
            }

            .admin-shell {
                display: block;
            }

            .admin-sidebar {
                position: relative;
                width: 100%;
                min-height: auto;
                border-right: 0;
                border-bottom: 1px solid rgba(104, 224, 255, 0.16);
                border-radius: 0 0 30px 30px;
            }

            .admin-main {
                margin-left: 0;
                width: 100%;
            }

            .admin-topbar {
                position: relative;
                flex-direction: column;
                align-items: stretch;
                padding: 1rem;
            }

            .admin-user-chip {
                width: 100%;
                min-width: 0;
                border-radius: 22px;
            }

            .admin-content {
                padding: 1rem;
            }
        }
    </style>
</head>

<body>
    @php
        $currentUser = Auth::user();
    @endphp

    <div class="admin-shell">
        <aside class="admin-sidebar">
            <div class="admin-sidebar-inner">
                <div class="admin-brand">
                    <div class="admin-brand-icon">
                        <i class="bi bi-mortarboard-fill"></i>
                    </div>

                    <div>
                        <div class="admin-brand-title">EDUTOOLS</div>
                        <div class="admin-brand-subtitle">
                            @if ($currentUser->role === 'admin')
                                Centro de control acad&eacute;mico
                            @elseif ($currentUser->role === 'tutor')
                                Portal familiar
                            @else
                                Acceso institucional
                            @endif
                        </div>
                    </div>
                </div>

                @if ($currentUser->role === 'admin')
                    <div class="admin-nav-label">Principal</div>

                    <a href="{{ route('dashboard') }}" class="admin-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </a>

                    <div class="admin-nav-label">Gesti&oacute;n acad&eacute;mica</div>

                    <a href="{{ route('students.index') }}" class="admin-nav-link {{ request()->routeIs('students.*') ? 'active' : '' }}">
                        <i class="bi bi-mortarboard"></i>
                        <span>Estudiantes</span>
                    </a>

                    <a href="{{ route('guardians.index') }}" class="admin-nav-link {{ request()->routeIs('guardians.*') ? 'active' : '' }}">
                        <i class="bi bi-person-hearts"></i>
                        <span>Padres/Tutores</span>
                    </a>

                    <a href="{{ route('teachers.index') }}" class="admin-nav-link {{ request()->routeIs('teachers.*') ? 'active' : '' }}">
                        <i class="bi bi-person-workspace"></i>
                        <span>Docentes</span>
                    </a>

                    <a href="{{ route('courses.index') }}" class="admin-nav-link {{ request()->routeIs('courses.*') ? 'active' : '' }}">
                        <i class="bi bi-journal-bookmark"></i>
                        <span>Cursos</span>
                    </a>

                    <a href="{{ route('grades.index') }}" class="admin-nav-link {{ request()->routeIs('grades.*') ? 'active' : '' }}">
                        <i class="bi bi-layers"></i>
                        <span>Grados</span>
                    </a>

                    <a href="{{ route('sections.index') }}" class="admin-nav-link {{ request()->routeIs('sections.*') ? 'active' : '' }}">
                        <i class="bi bi-grid-3x3-gap"></i>
                        <span>Secciones</span>
                    </a>

                    <a href="{{ route('enrollments.index') }}" class="admin-nav-link {{ request()->routeIs('enrollments.*') ? 'active' : '' }}">
                        <i class="bi bi-clipboard-check"></i>
                        <span>Inscripciones</span>
                    </a>

                    <a href="{{ route('grade-records.index') }}" class="admin-nav-link {{ request()->routeIs('grade-records.*') ? 'active' : '' }}">
                        <i class="bi bi-clipboard-data"></i>
                        <span>Notas</span>
                    </a>

                    <a href="{{ route('attendance-records.index') }}" class="admin-nav-link {{ request()->routeIs('attendance-records.*') ? 'active' : '' }}">
                        <i class="bi bi-calendar-check"></i>
                        <span>Asistencia</span>
                    </a>

                    <a href="{{ route('academic-calendar-events.index') }}" class="admin-nav-link {{ request()->routeIs('academic-calendar-events.*') ? 'active' : '' }}">
                        <i class="bi bi-calendar-event"></i>
                        <span>Calendario acad&eacute;mico</span>
                    </a>

                    <div class="admin-nav-label">Administraci&oacute;n</div>

                    <a href="{{ route('users.index') }}" class="admin-nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                        <i class="bi bi-people"></i>
                        <span>Usuarios</span>
                    </a>
                @elseif ($currentUser->role === 'tutor')
                    <div class="admin-nav-label">Portal familiar</div>

                    <a href="{{ route('portal.dashboard') }}" class="admin-nav-link {{ request()->routeIs('portal.dashboard') || request()->routeIs('portal.students.*') ? 'active' : '' }}">
                        <i class="bi bi-house-heart"></i>
                        <span>Resumen acad&eacute;mico</span>
                    </a>

                    <a href="{{ route('portal.calendar.index') }}" class="admin-nav-link {{ request()->routeIs('portal.calendar.*') ? 'active' : '' }}">
                        <i class="bi bi-calendar-event"></i>
                        <span>Calendario acad&eacute;mico</span>
                    </a>
                @endif

                <form method="POST" action="{{ route('logout') }}" class="admin-logout">
                    @csrf

                    <button type="submit" class="admin-nav-link border-0 text-start">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Cerrar sesi&oacute;n</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="admin-main">
            <header class="admin-topbar">
                <div>
                    <div class="admin-title-kicker">EDUTOOLS Control</div>
                    <h1>
                        @yield('page-title', 'Panel EDUTOOLS')
                    </h1>
                    <p>
                        @yield('page-subtitle', 'Gesti&oacute;n acad&eacute;mica del centro educativo')
                    </p>
                </div>

                <div class="admin-user-chip">
                    <div class="admin-user-avatar">
                        {{ strtoupper(substr($currentUser->name, 0, 1)) }}
                    </div>

                    <div>
                        <div class="admin-user-name">
                            {{ $currentUser->name }}
                        </div>
                        <div class="admin-user-role">
                            {{ $currentUser->role }}
                        </div>
                    </div>
                </div>
            </header>

            <section class="admin-content">
                @yield('content')
            </section>
        </main>
    </div>
</body>
</html>