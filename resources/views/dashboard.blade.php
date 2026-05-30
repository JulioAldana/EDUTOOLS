@extends('layouts.admin')

@section('page-title', 'Centro de Control EDUTOOLS')
@section('page-subtitle', 'Panel acad&eacute;mico conectado a datos reales del sistema')

@section('content')
    <style>
        :root {
            --dash-bg: #02040d;
            --dash-panel: rgba(9, 15, 30, 0.54);
            --dash-panel-strong: rgba(9, 15, 30, 0.78);
            --dash-border: rgba(113, 185, 255, 0.18);
            --dash-border-soft: rgba(255, 255, 255, 0.06);
            --dash-cyan: #41c7f5;
            --dash-blue: #3d7eff;
            --dash-violet: #6d7dff;
            --dash-accent: #9cdcff;
            --dash-green: #38d9a9;
            --dash-text: #f2fbff;
            --dash-muted: #9fb4ca;
            --dash-muted-2: #71859c;
        }

        .premium-dashboard {
            position: relative;
            min-height: calc(100vh - 120px);
            padding: 1.15rem 0 2rem;
            color: var(--dash-text);
            overflow: hidden;
        }

        .premium-dashboard::before {
            content: "";
            position: absolute;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            background:
                radial-gradient(circle at 6% 4%, rgba(65, 199, 245, 0.15), transparent 30%),
                radial-gradient(circle at 90% 12%, rgba(109, 125, 255, 0.12), transparent 32%),
                radial-gradient(circle at 78% 86%, rgba(61, 126, 255, 0.10), transparent 36%);
            opacity: .92;
        }

        .dashboard-layer {
            position: relative;
            z-index: 2;
        }

        .glass-panel {
            position: relative;
            overflow: hidden;
            border-radius: 28px;
            background:
                linear-gradient(135deg, rgba(255,255,255,0.06), rgba(255,255,255,0.018)),
                radial-gradient(circle at top left, rgba(65, 199, 245, 0.10), transparent 42%),
                radial-gradient(circle at bottom right, rgba(109, 125, 255, 0.08), transparent 42%);
            border: 1px solid var(--dash-border);
            box-shadow:
                0 28px 80px rgba(0, 0, 0, 0.30),
                inset 0 1px 0 rgba(255,255,255,0.06);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
        }

        .glass-panel::after {
            content: "";
            position: absolute;
            inset: 0;
            pointer-events: none;
            background:
                linear-gradient(120deg, transparent, rgba(255,255,255,.035), transparent);
            transform: translateX(-38%);
            opacity: .40;
        }

        .hero-control {
            min-height: 315px;
            padding: clamp(1.3rem, 3vw, 2.2rem);
        }

        .hero-control > * {
            position: relative;
            z-index: 2;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: .52rem;
            padding: .58rem .85rem;
            border-radius: 999px;
            color: #bff4ff;
            background: rgba(2, 8, 23, .64);
            border: 1px solid rgba(104,224,255,.24);
            box-shadow: 0 16px 42px rgba(0,0,0,.22);
            font-size: .72rem;
            font-weight: 950;
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        .hero-pulse {
            width: .55rem;
            height: .55rem;
            border-radius: 999px;
            background: linear-gradient(135deg, var(--dash-cyan), var(--dash-fuchsia));
            box-shadow: 0 0 22px rgba(56,217,255,.58);
        }

        .hero-title {
            margin: .95rem 0 .8rem;
            max-width: 850px;
            color: #ffffff;
            font-size: clamp(2.25rem, 5vw, 5.2rem);
            line-height: .9;
            font-weight: 950;
            letter-spacing: -0.075em;
        }

        .hero-title span {
            display: block;
            color: transparent;
            -webkit-text-stroke: 1.25px rgba(139, 235, 255, .38);
            text-shadow: 0 0 36px rgba(56,217,255,.10);
        }

        .hero-description {
            max-width: 780px;
            color: var(--dash-muted);
            line-height: 1.75;
            font-size: .98rem;
        }

        .hero-orbit {
            position: relative;
            min-height: 245px;
            border-radius: 28px;
            background:
                radial-gradient(circle at 50% 50%, rgba(65,199,245,.12), transparent 35%),
                radial-gradient(circle at 72% 30%, rgba(109,125,255,.12), transparent 34%),
                rgba(2, 8, 23, .34);
            border: 1px solid rgba(113,185,255,.18);
            box-shadow:
                inset 0 1px 0 rgba(255,255,255,.05),
                0 20px 55px rgba(0,0,0,.20);
            overflow: hidden;
        }

        .hero-orbit::before,
        .hero-orbit::after {
            content: "";
            position: absolute;
            inset: 36px;
            border-radius: 999px;
            border: 1px solid rgba(104,224,255,.18);
            transform: rotate(-12deg);
        }

        .hero-orbit::after {
            inset: 65px;
            border-color: rgba(243,93,187,.18);
            transform: rotate(20deg);
        }

        .orbit-core {
            position: absolute;
            left: 50%;
            top: 50%;
            width: 112px;
            height: 112px;
            border-radius: 34px;
            transform: translate(-50%, -50%);
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, #2999ff, #4d7dff);
            color: #fff;
            font-size: 2.7rem;
            box-shadow:
                0 18px 44px rgba(41, 153, 255, .20);
            z-index: 3;
        }

        .orbit-chip {
            position: absolute;
            z-index: 4;
            display: inline-flex;
            align-items: center;
            gap: .45rem;
            padding: .5rem .68rem;
            border-radius: 999px;
            background: rgba(2, 8, 23, .76);
            border: 1px solid rgba(113,185,255,.18);
            color: #dff8ff;
            font-size: .73rem;
            font-weight: 850;
            box-shadow: 0 14px 28px rgba(0,0,0,.16);
        }

        .orbit-chip i {
            color: var(--dash-cyan);
        }

        .orbit-chip.one { left: 18px; top: 26px; }
        .orbit-chip.two { right: 18px; top: 48px; }
        .orbit-chip.three { left: 32px; bottom: 28px; }
        .orbit-chip.four { right: 28px; bottom: 34px; }

        .metric-card {
            position: relative;
            min-height: 155px;
            display: block;
            padding: 1.1rem;
            color: inherit;
            text-decoration: none;
            transition: transform .22s ease, box-shadow .22s ease, border-color .22s ease;
        }

        .metric-card:hover {
            color: inherit;
            transform: translateY(-6px);
            border-color: rgba(113,185,255,.30);
            box-shadow:
                0 30px 72px rgba(0, 0, 0, 0.32),
                inset 0 1px 0 rgba(255,255,255,0.08);
        }

        .metric-content {
            position: relative;
            z-index: 2;
        }

        .metric-icon {
            width: 54px;
            height: 54px;
            border-radius: 18px;
            display: grid;
            place-items: center;
            color: #fff;
            font-size: 1.28rem;
            background: linear-gradient(135deg, #2897ff, #577dff);
            box-shadow:
                0 12px 28px rgba(40, 151, 255, .16);
        }

        .metric-label {
            color: #aeefff;
            font-size: .72rem;
            font-weight: 950;
            letter-spacing: .10em;
            text-transform: uppercase;
        }

        .metric-number {
            margin-top: .25rem;
            color: #ffffff;
            font-size: 2.25rem;
            line-height: 1;
            font-weight: 950;
            letter-spacing: -.055em;
        }

        .metric-note {
            margin-top: .55rem;
            color: var(--dash-muted);
            font-size: .86rem;
        }

        .section-heading {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .section-heading h2,
        .section-heading h5 {
            margin: 0;
            color: #ffffff;
            font-weight: 950;
            letter-spacing: -0.04em;
        }

        .section-heading p {
            margin: .25rem 0 0;
            color: var(--dash-muted);
            font-size: .9rem;
        }

        .premium-badge {
            display: inline-flex;
            align-items: center;
            gap: .42rem;
            padding: .42rem .70rem;
            border-radius: 999px;
            color: #dff8ff;
            background: rgba(2, 8, 23, .62);
            border: 1px solid rgba(104,224,255,.22);
            font-size: .74rem;
            font-weight: 850;
            white-space: nowrap;
        }

        .status-dot {
            width: .62rem;
            height: .62rem;
            border-radius: 999px;
            display: inline-block;
            background: linear-gradient(135deg, #38f8a8, #8fffe0);
            box-shadow: 0 0 18px rgba(56,248,168,.52);
        }

        .chart-shell {
            padding: 1.25rem;
            min-height: 500px;
        }

        #academicActivityChart {
            min-height: 405px;
        }

        .system-list {
            display: grid;
            gap: .76rem;
        }

        .system-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: .8rem;
            padding: .86rem;
            border-radius: 18px;
            background: rgba(2, 8, 23, .38);
            border: 1px solid rgba(255,255,255,.075);
        }

        .system-item strong {
            color: #ffffff;
            font-size: .9rem;
        }

        .system-item small {
            color: var(--dash-muted);
        }

        .activity-card {
            padding: 1.05rem;
            min-height: 100%;
        }

        .activity-list {
            display: grid;
            gap: .75rem;
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .78rem;
            border-radius: 18px;
            background: rgba(2, 8, 23, .38);
            border: 1px solid rgba(255,255,255,.075);
        }

        .activity-icon {
            width: 42px;
            height: 42px;
            flex: 0 0 42px;
            border-radius: 14px;
            display: grid;
            place-items: center;
            color: #ffffff;
            background: linear-gradient(135deg, #2897ff, #577dff);
            box-shadow: 0 10px 22px rgba(40,151,255,.14);
        }

        .activity-title {
            color: #ffffff;
            font-weight: 850;
            font-size: .9rem;
            line-height: 1.15;
        }

        .activity-subtitle {
            margin-top: .18rem;
            color: var(--dash-muted);
            font-size: .78rem;
        }

        .empty-state {
            padding: 1rem;
            border-radius: 18px;
            color: var(--dash-muted);
            background: rgba(2, 8, 23, .34);
            border: 1px dashed rgba(104,224,255,.22);
        }

        .module-launcher {
            padding: 1.2rem;
        }

        .module-link {
            position: relative;
            display: block;
            min-height: 154px;
            height: 100%;
            padding: 1rem;
            overflow: hidden;
            color: inherit;
            text-decoration: none;
            border-radius: 24px;
            background:
                linear-gradient(135deg, rgba(255,255,255,0.055), rgba(255,255,255,0.018)),
                radial-gradient(circle at top left, rgba(65,199,245,.12), transparent 46%),
                radial-gradient(circle at bottom right, rgba(109,125,255,.08), transparent 46%);
            border: 1px solid rgba(113,185,255,.18);
            box-shadow:
                0 18px 44px rgba(0,0,0,.22),
                inset 0 1px 0 rgba(255,255,255,.05);
            transition: transform .22s ease, border-color .22s ease, box-shadow .22s ease;
        }

        .module-link::before {
            content: "";
            position: absolute;
            width: 96px;
            height: 96px;
            right: -26px;
            top: -26px;
            border-radius: 999px;
            background: radial-gradient(circle, rgba(65,199,245,.16), transparent 68%);
            opacity: .78;
        }

        .module-link:hover {
            color: inherit;
            transform: translateY(-6px);
            border-color: rgba(113,185,255,.30);
            box-shadow:
                0 28px 68px rgba(0,0,0,.30),
                inset 0 1px 0 rgba(255,255,255,.08);
        }

        .module-content {
            position: relative;
            z-index: 2;
        }

        .module-icon {
            width: 48px;
            height: 48px;
            border-radius: 16px;
            display: grid;
            place-items: center;
            color: #ffffff;
            font-size: 1.2rem;
            background: linear-gradient(135deg, #2897ff, #577dff);
            box-shadow: 0 12px 26px rgba(40,151,255,.15);
        }

        .module-title {
            margin-top: .9rem;
            color: #ffffff;
            font-weight: 950;
            letter-spacing: -0.03em;
        }

        .module-desc {
            margin-top: .25rem;
            color: var(--dash-muted);
            font-size: .78rem;
            line-height: 1.45;
        }

        .module-arrow {
            position: absolute;
            right: 1rem;
            bottom: 1rem;
            color: #aeefff;
            opacity: .78;
        }

        .apexcharts-xaxis text,
        .apexcharts-yaxis text {
            fill: #b8cde2 !important;
            font-weight: 800 !important;
        }

        .apexcharts-gridline {
            stroke: rgba(255,255,255,0.08) !important;
        }

        .apexcharts-data-labels rect,
        .apexcharts-datalabels rect {
            fill: rgba(7, 16, 32, 0.98) !important;
            stroke: rgba(56, 217, 255, 0.72) !important;
            stroke-width: 1.2px !important;
        }

        .apexcharts-data-labels text,
        .apexcharts-datalabels text {
            fill: #ffffff !important;
            font-weight: 900 !important;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: clamp(2.35rem, 14vw, 3.4rem);
            }

            .hero-orbit {
                min-height: 210px;
            }

            .orbit-chip {
                display: none;
            }

            .section-heading {
                align-items: start;
                flex-direction: column;
            }

            .chart-shell {
                min-height: auto;
            }
        }
    </style>

    <div class="premium-dashboard">
        <div class="container-fluid px-2 px-lg-3 dashboard-layer">

            <section class="glass-panel hero-control mb-4">
                <div class="row align-items-center g-4">
                    <div class="col-xl-8">
                        <div class="hero-badge">
                            <span class="hero-pulse"></span>
                            Plataforma acad&eacute;mica operativa
                        </div>

                        <h1 class="hero-title">
                            Centro de control
                            <span>EDUTOOLS</span>
                        </h1>

                        <p class="hero-description mb-0">
                            Administra estudiantes, tutores, docentes, cursos, grados, secciones,
                            inscripciones, notas, asistencia, usuarios y calendario acad&eacute;mico
                            desde una interfaz centralizada conectada a MySQL.
                        </p>
                    </div>

                    <div class="col-xl-4">
                        <div class="hero-orbit">
                            <div class="orbit-core">
                                <i class="bi bi-mortarboard-fill"></i>
                            </div>

                            <div class="orbit-chip one">
                                <i class="bi bi-database-check"></i>
                                MySQL conectado
                            </div>

                            <div class="orbit-chip two">
                                <i class="bi bi-shield-check"></i>
                                Roles activos
                            </div>

                            <div class="orbit-chip three">
                                <i class="bi bi-person-lock"></i>
                                {{ Auth::user()->role }}
                            </div>

                            <div class="orbit-chip four">
                                <i class="bi bi-lightning-charge"></i>
                                Laravel 11
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="row g-3 mb-4">
                <div class="col-md-6 col-xl-3">
                    <a href="{{ route('students.index') }}" class="glass-panel metric-card">
                        <div class="metric-content">
                            <div class="d-flex justify-content-between align-items-start gap-3">
                                <div>
                                    <div class="metric-label">Estudiantes</div>
                                    <div class="metric-number">{{ $stats['active_students'] }}</div>
                                    <div class="metric-note">Activos de {{ $stats['students'] }} registrados</div>
                                </div>
                                <div class="metric-icon"><i class="bi bi-mortarboard-fill"></i></div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 col-xl-3">
                    <a href="{{ route('guardians.index') }}" class="glass-panel metric-card">
                        <div class="metric-content">
                            <div class="d-flex justify-content-between align-items-start gap-3">
                                <div>
                                    <div class="metric-label">Padres/Tutores</div>
                                    <div class="metric-number">{{ $stats['active_guardians'] }}</div>
                                    <div class="metric-note">Responsables activos</div>
                                </div>
                                <div class="metric-icon"><i class="bi bi-person-hearts"></i></div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 col-xl-3">
                    <a href="{{ route('teachers.index') }}" class="glass-panel metric-card">
                        <div class="metric-content">
                            <div class="d-flex justify-content-between align-items-start gap-3">
                                <div>
                                    <div class="metric-label">Docentes</div>
                                    <div class="metric-number">{{ $stats['active_teachers'] }}</div>
                                    <div class="metric-note">Activos de {{ $stats['teachers'] }} registrados</div>
                                </div>
                                <div class="metric-icon"><i class="bi bi-person-workspace"></i></div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 col-xl-3">
                    <a href="{{ route('courses.index') }}" class="glass-panel metric-card">
                        <div class="metric-content">
                            <div class="d-flex justify-content-between align-items-start gap-3">
                                <div>
                                    <div class="metric-label">Cursos</div>
                                    <div class="metric-number">{{ $stats['active_courses'] }}</div>
                                    <div class="metric-note">Cursos activos</div>
                                </div>
                                <div class="metric-icon"><i class="bi bi-journal-bookmark-fill"></i></div>
                            </div>
                        </div>
                    </a>
                </div>
            </section>

            <section class="row g-3 mb-4">
                <div class="col-md-6 col-xl-3">
                    <a href="{{ route('enrollments.index') }}" class="glass-panel metric-card">
                        <div class="metric-content">
                            <div class="metric-label">Inscripciones activas</div>
                            <div class="metric-number">{{ $stats['active_enrollments'] }}</div>
                            <div class="metric-note">Total: {{ $stats['enrollments'] }}</div>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 col-xl-3">
                    <a href="{{ route('grade-records.index') }}" class="glass-panel metric-card">
                        <div class="metric-content">
                            <div class="metric-label">Notas activas</div>
                            <div class="metric-number">{{ $stats['active_grade_records'] }}</div>
                            <div class="metric-note">Total: {{ $stats['grade_records'] }}</div>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 col-xl-3">
                    <a href="{{ route('attendance-records.index') }}" class="glass-panel metric-card">
                        <div class="metric-content">
                            <div class="metric-label">Asistencias</div>
                            <div class="metric-number">{{ $stats['attendance_records'] }}</div>
                            <div class="metric-note">Registros acad&eacute;micos</div>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 col-xl-3">
                    <a href="{{ route('academic-calendar-events.index') }}" class="glass-panel metric-card">
                        <div class="metric-content">
                            <div class="metric-label">Eventos activos</div>
                            <div class="metric-number">{{ $stats['active_calendar_events'] }}</div>
                            <div class="metric-note">Calendario acad&eacute;mico</div>
                        </div>
                    </a>
                </div>
            </section>

            <section class="row g-3 mb-4">
                <div class="col-xl-8">
                    <div class="glass-panel chart-shell h-100">
                        <div class="section-heading">
                            <div>
                                <h2 class="h4">Actividad acad&eacute;mica</h2>
                                <p>Resumen visual generado con datos reales del sistema.</p>
                            </div>

                            <span class="premium-badge">
                                <i class="bi bi-bar-chart-line"></i>
                                ApexCharts
                            </span>
                        </div>

                        <div id="academicActivityChart"></div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="glass-panel chart-shell h-100">
                        <div class="section-heading">
                            <div>
                                <h5>Estado institucional</h5>
                                <p>Componentes principales activos.</p>
                            </div>
                        </div>

                        <div class="system-list">
                            <div class="system-item">
                                <div>
                                    <strong><span class="status-dot me-2"></span>Autenticaci&oacute;n</strong><br>
                                    <small>Login y sesiones funcionando</small>
                                </div>
                                <span class="premium-badge">Activa</span>
                            </div>

                            <div class="system-item">
                                <div>
                                    <strong><span class="status-dot me-2"></span>Roles</strong><br>
                                    <small>Admin y portal familiar</small>
                                </div>
                                <span class="premium-badge">OK</span>
                            </div>

                            <div class="system-item">
                                <div>
                                    <strong><span class="status-dot me-2"></span>CRUDs</strong><br>
                                    <small>Administraci&oacute;n completa</small>
                                </div>
                                <span class="premium-badge">OK</span>
                            </div>

                            <div class="system-item">
                                <div>
                                    <strong><span class="status-dot me-2"></span>Base de datos</strong><br>
                                    <small>Datos conectados desde MySQL</small>
                                </div>
                                <span class="premium-badge">MySQL</span>
                            </div>

                            <div class="system-item">
                                <div>
                                    <strong><span class="status-dot me-2"></span>Usuario actual</strong><br>
                                    <small>{{ Auth::user()->email }}</small>
                                </div>
                                <span class="premium-badge">{{ Auth::user()->role }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="row g-3 mb-4">
                <div class="col-xl-4">
                    <div class="glass-panel activity-card">
                        <div class="section-heading">
                            <div>
                                <h5>&Uacute;ltimas inscripciones</h5>
                                <p>Movimientos recientes.</p>
                            </div>
                        </div>

                        <div class="activity-list">
                            @forelse ($latestEnrollments as $enrollment)
                                <div class="activity-item">
                                    <div class="activity-icon"><i class="bi bi-clipboard-check"></i></div>
                                    <div>
                                        <div class="activity-title">
                                            {{ $enrollment->student->first_name ?? 'Alumno' }}
                                            {{ $enrollment->student->last_name ?? '' }}
                                        </div>
                                        <div class="activity-subtitle">
                                            Ciclo {{ $enrollment->academic_year }} · {{ ucfirst($enrollment->status) }}
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="empty-state">Sin inscripciones recientes.</div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="glass-panel activity-card">
                        <div class="section-heading">
                            <div>
                                <h5>&Uacute;ltimas notas</h5>
                                <p>Registros acad&eacute;micos recientes.</p>
                            </div>
                        </div>

                        <div class="activity-list">
                            @forelse ($latestGradeRecords as $gradeRecord)
                                <div class="activity-item">
                                    <div class="activity-icon"><i class="bi bi-clipboard-data"></i></div>
                                    <div>
                                        <div class="activity-title">
                                            {{ $gradeRecord->student->first_name ?? 'Alumno' }}
                                            {{ $gradeRecord->student->last_name ?? '' }}
                                        </div>
                                        <div class="activity-subtitle">
                                            {{ $gradeRecord->course->name ?? 'Curso' }} · Nota {{ number_format($gradeRecord->score, 2) }}
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="empty-state">Sin notas recientes.</div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="glass-panel activity-card">
                        <div class="section-heading">
                            <div>
                                <h5>Eventos pr&oacute;ximos</h5>
                                <p>Calendario acad&eacute;mico.</p>
                            </div>
                        </div>

                        <div class="activity-list">
                            @forelse ($upcomingEvents as $event)
                                <div class="activity-item">
                                    <div class="activity-icon"><i class="bi bi-calendar-event"></i></div>
                                    <div>
                                        <div class="activity-title">{{ $event->title }}</div>
                                        <div class="activity-subtitle">
                                            {{ \Carbon\Carbon::parse($event->event_date)->format('d/m/Y') }}
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="empty-state">Sin eventos pr&oacute;ximos.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </section>

            <section class="glass-panel module-launcher">
                <div class="section-heading">
                    <div>
                        <h2 class="h4">M&oacute;dulos administrativos</h2>
                        <p>Accesos principales del sistema EDUTOOLS.</p>
                    </div>

                    <span class="premium-badge">
                        <i class="bi bi-grid-1x2"></i>
                        App launcher
                    </span>
                </div>

                <div class="row g-3">
                    <div class="col-6 col-md-4 col-xl-2">
                        <a href="{{ route('users.index') }}" class="module-link">
                            <div class="module-content">
                                <div class="module-icon"><i class="bi bi-people-fill"></i></div>
                                <div class="module-title">Usuarios</div>
                                <div class="module-desc">Roles, accesos y estado de cuentas.</div>
                            </div>
                            <i class="bi bi-arrow-up-right module-arrow"></i>
                        </a>
                    </div>

                    <div class="col-6 col-md-4 col-xl-2">
                        <a href="{{ route('grades.index') }}" class="module-link">
                            <div class="module-content">
                                <div class="module-icon"><i class="bi bi-layers"></i></div>
                                <div class="module-title">Grados</div>
                                <div class="module-desc">Estructura acad&eacute;mica institucional.</div>
                            </div>
                            <i class="bi bi-arrow-up-right module-arrow"></i>
                        </a>
                    </div>

                    <div class="col-6 col-md-4 col-xl-2">
                        <a href="{{ route('sections.index') }}" class="module-link">
                            <div class="module-content">
                                <div class="module-icon"><i class="bi bi-grid-3x3-gap"></i></div>
                                <div class="module-title">Secciones</div>
                                <div class="module-desc">Organizaci&oacute;n de grupos y aulas.</div>
                            </div>
                            <i class="bi bi-arrow-up-right module-arrow"></i>
                        </a>
                    </div>

                    <div class="col-6 col-md-4 col-xl-2">
                        <a href="{{ route('enrollments.index') }}" class="module-link">
                            <div class="module-content">
                                <div class="module-icon"><i class="bi bi-clipboard-check"></i></div>
                                <div class="module-title">Inscripciones</div>
                                <div class="module-desc">Control de asignaciones activas.</div>
                            </div>
                            <i class="bi bi-arrow-up-right module-arrow"></i>
                        </a>
                    </div>

                    <div class="col-6 col-md-4 col-xl-2">
                        <a href="{{ route('grade-records.index') }}" class="module-link">
                            <div class="module-content">
                                <div class="module-icon"><i class="bi bi-clipboard-data"></i></div>
                                <div class="module-title">Notas</div>
                                <div class="module-desc">Registro y seguimiento acad&eacute;mico.</div>
                            </div>
                            <i class="bi bi-arrow-up-right module-arrow"></i>
                        </a>
                    </div>

                    <div class="col-6 col-md-4 col-xl-2">
                        <a href="{{ route('attendance-records.index') }}" class="module-link">
                            <div class="module-content">
                                <div class="module-icon"><i class="bi bi-calendar-check"></i></div>
                                <div class="module-title">Asistencia</div>
                                <div class="module-desc">Control de presencia estudiantil.</div>
                            </div>
                            <i class="bi bi-arrow-up-right module-arrow"></i>
                        </a>
                    </div>
                </div>
            </section>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chartElement = document.querySelector('#academicActivityChart');

            const chartLabels = @json($chartData['labels']);
            const chartValues = @json($chartData['values']);

            if (chartElement && window.ApexCharts) {
                const options = {
                    chart: {
                        type: 'bar',
                        height: 405,
                        toolbar: { show: false },
                        background: 'transparent',
                        fontFamily: 'inherit',
                        animations: {
                            enabled: true,
                            easing: 'easeinout',
                            speed: 950,
                            animateGradually: {
                                enabled: true,
                                delay: 120
                            }
                        },
                        dropShadow: {
                            enabled: true,
                            top: 10,
                            left: 0,
                            blur: 14,
                            opacity: 0.18
                        }
                    },
                    series: [
                        {
                            name: 'Registros activos',
                            data: chartValues
                        }
                    ],
                    colors: [
                        '#41c7f5',
                        '#4aa8ff',
                        '#5c8dff',
                        '#3caef2',
                        '#4d93ff',
                        '#6d7dff',
                        '#41c7f5',
                        '#4aa8ff'
                    ],
                    xaxis: {
                        categories: chartLabels,
                        labels: {
                            rotate: -15,
                            trim: true,
                            style: {
                                colors: '#b8cde2',
                                fontWeight: 800,
                                fontSize: '12px'
                            }
                        },
                        axisBorder: { show: false },
                        axisTicks: { show: false },
                        tooltip: { enabled: false }
                    },
                    yaxis: {
                        labels: {
                            style: {
                                colors: '#9cb3c8',
                                fontWeight: 800,
                                fontSize: '12px'
                            }
                        }
                    },
                    plotOptions: {
                        bar: {
                            borderRadius: 16,
                            columnWidth: '46%',
                            distributed: true,
                            dataLabels: {
                                position: 'top'
                            }
                        }
                    },
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shade: 'dark',
                            type: 'vertical',
                            shadeIntensity: 0.18,
                            gradientToColors: [
                                '#4aa8ff',
                                '#5c8dff',
                                '#7e95ff',
                                '#4d93ff',
                                '#6d7dff',
                                '#8ea2ff',
                                '#4aa8ff',
                                '#5c8dff'
                            ],
                            inverseColors: false,
                            opacityFrom: 1,
                            opacityTo: 0.82,
                            stops: [0, 60, 100]
                        }
                    },
                    stroke: {
                        show: true,
                        width: 1,
                        colors: ['rgba(255,255,255,0.20)']
                    },
                    dataLabels: {
                        enabled: true,
                        offsetY: -16,
                        formatter: function (value) {
                            return value;
                        },
                        style: {
                            colors: ['#ffffff'],
                            fontWeight: 900,
                            fontSize: '14px'
                        },
                        background: {
                            enabled: true,
                            foreColor: '#ffffff',
                            padding: 7,
                            borderRadius: 12,
                            borderWidth: 1,
                            borderColor: 'rgba(56, 217, 255, 0.60)',
                            opacity: 1,
                            dropShadow: {
                                enabled: true,
                                top: 6,
                                left: 0,
                                blur: 10,
                                color: '#08111f',
                                opacity: 0.28
                            }
                        }
                    },
                    grid: {
                        borderColor: 'rgba(255,255,255,.07)',
                        strokeDashArray: 5,
                        xaxis: {
                            lines: { show: false }
                        },
                        yaxis: {
                            lines: { show: true }
                        },
                        padding: {
                            top: 18,
                            right: 10,
                            bottom: 0,
                            left: 8
                        }
                    },
                    tooltip: {
                        theme: 'dark',
                        fillSeriesColor: false,
                        style: {
                            fontSize: '13px'
                        },
                        y: {
                            formatter: function (value) {
                                return value + ' registros activos';
                            }
                        }
                    },
                    legend: {
                        show: false
                    },
                    states: {
                        hover: {
                            filter: {
                                type: 'lighten',
                                value: 0.08
                            }
                        },
                        active: {
                            filter: {
                                type: 'none'
                            }
                        }
                    }
                };

                const chart = new ApexCharts(chartElement, options);
                chart.render();
            }
        });
    </script>
@endsection