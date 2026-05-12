<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'EDUTOOLS') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background: #eef2f7;
            color: #0f172a;
        }

        .admin-shell {
            min-height: 100vh;
            display: flex;
            background:
                radial-gradient(circle at top left, rgba(13, 110, 253, 0.14), transparent 30%),
                radial-gradient(circle at bottom right, rgba(32, 201, 151, 0.12), transparent 28%),
                #eef2f7;
        }

        .admin-sidebar {
            width: 280px;
            min-height: 100vh;
            background: linear-gradient(180deg, #07111f 0%, #0d1b2f 55%, #10233f 100%);
            color: #ffffff;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            padding: 1.25rem;
            overflow-y: auto;
            z-index: 1000;
        }

        .admin-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .admin-brand-icon {
            width: 44px;
            height: 44px;
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(13, 110, 253, 0.22);
            color: #ffffff;
            font-size: 1.4rem;
        }

        .admin-nav-label {
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: rgba(255, 255, 255, 0.46);
            font-weight: 700;
            padding: 0 0.75rem;
            margin: 1.25rem 0 0.5rem;
        }

        .admin-nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: rgba(255, 255, 255, 0.76);
            text-decoration: none;
            padding: 0.82rem 0.9rem;
            border-radius: 16px;
            margin-bottom: 0.35rem;
            transition: all 0.18s ease;
        }

        .admin-nav-link:hover,
        .admin-nav-link.active {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.12);
        }

        .admin-nav-link i {
            font-size: 1.1rem;
        }

        .admin-main {
            margin-left: 280px;
            width: calc(100% - 280px);
            min-height: 100vh;
        }

        .admin-topbar {
            min-height: 76px;
            background: rgba(255, 255, 255, 0.86);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(148, 163, 184, 0.22);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 1.5rem;
            position: sticky;
            top: 0;
            z-index: 900;
        }

        .admin-content {
            padding: 1.5rem;
        }

        .admin-user-chip {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 999px;
            padding: 0.45rem 0.8rem;
        }

        .admin-user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #0d6efd;
            color: #ffffff;
            font-weight: 700;
        }

        @media (max-width: 991.98px) {
            .admin-sidebar {
                position: relative;
                width: 100%;
                min-height: auto;
                border-radius: 0 0 28px 28px;
            }

            .admin-shell {
                display: block;
            }

            .admin-main {
                margin-left: 0;
                width: 100%;
            }

            .admin-topbar {
                position: relative;
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
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
            <div class="admin-brand">
                <div class="admin-brand-icon">
                    <i class="bi bi-mortarboard-fill"></i>
                </div>

                <div>
                    <div class="fw-bold fs-5">EDUTOOLS</div>
                    <div class="small text-white-50">
                        @if ($currentUser->role === 'admin')
                            Panel administrativo
                        @elseif ($currentUser->role === 'tutor')
                            Portal familiar
                        @else
                            Acceso al sistema
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

                <div class="admin-nav-label">Gestión académica</div>

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
                    <span>Calendario académico</span>
                </a>

                <div class="admin-nav-label">Administración</div>

                <a href="{{ route('users.index') }}" class="admin-nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i>
                    <span>Usuarios</span>
                </a>
            @elseif ($currentUser->role === 'tutor')
                <div class="admin-nav-label">Portal familiar</div>

                <a href="{{ route('portal.dashboard') }}" class="admin-nav-link {{ request()->routeIs('portal.dashboard') || request()->routeIs('portal.students.*') ? 'active' : '' }}">
                    <i class="bi bi-house-heart"></i>
                    <span>Resumen académico</span>
                </a>

                <a href="{{ route('portal.calendar.index') }}" class="admin-nav-link {{ request()->routeIs('portal.calendar.*') ? 'active' : '' }}">
                    <i class="bi bi-calendar-event"></i>
                    <span>Calendario académico</span>
                </a>
            @endif

            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf

                <button type="submit" class="admin-nav-link border-0 w-100 text-start bg-transparent">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Cerrar sesión</span>
                </button>
            </form>
        </aside>

        <main class="admin-main">
            <header class="admin-topbar">
                <div>
                    <h1 class="h4 fw-bold mb-1">
                        @yield('page-title', 'Panel EDUTOOLS')
                    </h1>
                    <p class="text-muted mb-0">
                        @yield('page-subtitle', 'Gestión académica del centro educativo')
                    </p>
                </div>

                <div class="admin-user-chip">
                    <div class="admin-user-avatar">
                        {{ strtoupper(substr($currentUser->name, 0, 1)) }}
                    </div>

                    <div>
                        <div class="fw-semibold small">
                            {{ $currentUser->name }}
                        </div>
                        <div class="text-muted small">
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