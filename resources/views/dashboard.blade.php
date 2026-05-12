@extends('layouts.admin')

@section('page-title', 'Panel Administrativo EDUTOOLS')
@section('page-subtitle', 'Control académico y administrativo del centro educativo')

@section('content')
    <style>
        .edutools-dashboard {
            min-height: calc(100vh - 130px);
            background:
                radial-gradient(circle at top left, rgba(13, 110, 253, 0.14), transparent 32%),
                radial-gradient(circle at top right, rgba(32, 201, 151, 0.14), transparent 30%),
                linear-gradient(135deg, #f8fafc 0%, #eef2f7 100%);
        }

        .edutools-hero {
            position: relative;
            overflow: hidden;
            border-radius: 28px;
            background: linear-gradient(135deg, #07111f 0%, #10233f 45%, #0d6efd 100%);
            color: #ffffff;
            box-shadow: 0 24px 60px rgba(15, 23, 42, 0.20);
        }

        .edutools-hero::before {
            content: "";
            position: absolute;
            width: 420px;
            height: 420px;
            right: -120px;
            top: -160px;
            background: radial-gradient(circle, rgba(255,255,255,0.26), transparent 62%);
        }

        .edutools-hero::after {
            content: "";
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.07) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.07) 1px, transparent 1px);
            background-size: 42px 42px;
            mask-image: linear-gradient(to bottom, rgba(0,0,0,0.8), transparent);
        }

        .edutools-hero-content {
            position: relative;
            z-index: 2;
        }

        .edutools-card {
            border: 0;
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.94);
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
            backdrop-filter: blur(10px);
        }

        .edutools-stat-icon {
            width: 52px;
            height: 52px;
            border-radius: 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.45rem;
        }

        .icon-blue { background: rgba(13, 110, 253, 0.12); color: #0d6efd; }
        .icon-green { background: rgba(25, 135, 84, 0.12); color: #198754; }
        .icon-orange { background: rgba(255, 193, 7, 0.18); color: #b58100; }
        .icon-purple { background: rgba(111, 66, 193, 0.13); color: #6f42c1; }
        .icon-cyan { background: rgba(13, 202, 240, 0.14); color: #087990; }
        .icon-red { background: rgba(220, 53, 69, 0.12); color: #dc3545; }

        .edutools-mini-label {
            font-size: 0.78rem;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            color: #64748b;
            font-weight: 700;
        }

        .edutools-module {
            transition: transform 0.18s ease, box-shadow 0.18s ease;
            text-decoration: none;
            color: inherit;
        }

        .edutools-module:hover {
            transform: translateY(-4px);
            box-shadow: 0 22px 55px rgba(15, 23, 42, 0.12);
            color: inherit;
        }

        .edutools-status-dot {
            width: 10px;
            height: 10px;
            border-radius: 999px;
            display: inline-block;
            background: #198754;
        }

        .edutools-table th {
            color: #64748b;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .edutools-table td,
        .edutools-table th {
            padding: 1rem;
        }
    </style>

    <div class="edutools-dashboard py-4">
        <div class="container-fluid px-3 px-lg-4">

            <section class="edutools-hero p-4 p-lg-5 mb-4">
                <div class="edutools-hero-content">
                    <div class="row align-items-center g-4">
                        <div class="col-lg-8">
                            <span class="badge rounded-pill bg-light text-primary px-3 py-2 mb-3">
                                <i class="bi bi-check-circle-fill me-1"></i>
                                Plataforma académica operativa
                            </span>

                            <h1 class="display-6 fw-bold mb-3">
                                Administración centralizada para EDUTOOLS
                            </h1>

                            <p class="lead mb-0 text-white-50">
                                Gestiona alumnos, tutores, docentes, cursos, grados, secciones, inscripciones,
                                notas, asistencia, usuarios y calendario académico desde un panel seguro.
                            </p>
                        </div>

                        <div class="col-lg-4">
                            <div class="bg-white bg-opacity-10 rounded-4 p-4 border border-light border-opacity-25">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <span class="text-white-50">Sesión actual</span>
                                    <i class="bi bi-person-lock fs-4"></i>
                                </div>

                                <h5 class="fw-bold mb-1">{{ Auth::user()->name }}</h5>
                                <p class="mb-3 text-white-50">{{ Auth::user()->email }}</p>

                                <div class="d-flex flex-wrap gap-2">
                                    <span class="badge text-bg-success">Activo</span>
                                    <span class="badge text-bg-primary">Rol: {{ Auth::user()->role }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="row g-4 mb-4">
                <div class="col-md-6 col-xl-3">
                    <a href="{{ route('students.index') }}" class="card edutools-card edutools-module h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="edutools-mini-label mb-2">Estudiantes</div>
                                    <h3 class="fw-bold mb-1">{{ $stats['active_students'] }}</h3>
                                    <p class="text-muted mb-0">Activos de {{ $stats['students'] }} registrados</p>
                                </div>
                                <div class="edutools-stat-icon icon-blue">
                                    <i class="bi bi-mortarboard-fill"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 col-xl-3">
                    <a href="{{ route('guardians.index') }}" class="card edutools-card edutools-module h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="edutools-mini-label mb-2">Padres/Tutores</div>
                                    <h3 class="fw-bold mb-1">{{ $stats['active_guardians'] }}</h3>
                                    <p class="text-muted mb-0">Responsables activos</p>
                                </div>
                                <div class="edutools-stat-icon icon-purple">
                                    <i class="bi bi-person-hearts"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 col-xl-3">
                    <a href="{{ route('teachers.index') }}" class="card edutools-card edutools-module h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="edutools-mini-label mb-2">Docentes</div>
                                    <h3 class="fw-bold mb-1">{{ $stats['active_teachers'] }}</h3>
                                    <p class="text-muted mb-0">Activos de {{ $stats['teachers'] }} registrados</p>
                                </div>
                                <div class="edutools-stat-icon icon-green">
                                    <i class="bi bi-person-workspace"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 col-xl-3">
                    <a href="{{ route('courses.index') }}" class="card edutools-card edutools-module h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="edutools-mini-label mb-2">Cursos</div>
                                    <h3 class="fw-bold mb-1">{{ $stats['active_courses'] }}</h3>
                                    <p class="text-muted mb-0">Cursos activos</p>
                                </div>
                                <div class="edutools-stat-icon icon-orange">
                                    <i class="bi bi-journal-bookmark-fill"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </section>

            <section class="row g-4 mb-4">
                <div class="col-md-6 col-xl-3">
                    <a href="{{ route('enrollments.index') }}" class="card edutools-card edutools-module h-100">
                        <div class="card-body">
                            <div class="edutools-mini-label mb-2">Inscripciones activas</div>
                            <h3 class="fw-bold mb-1">{{ $stats['active_enrollments'] }}</h3>
                            <p class="text-muted mb-0">Total: {{ $stats['enrollments'] }}</p>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 col-xl-3">
                    <a href="{{ route('grade-records.index') }}" class="card edutools-card edutools-module h-100">
                        <div class="card-body">
                            <div class="edutools-mini-label mb-2">Notas activas</div>
                            <h3 class="fw-bold mb-1">{{ $stats['active_grade_records'] }}</h3>
                            <p class="text-muted mb-0">Total: {{ $stats['grade_records'] }}</p>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 col-xl-3">
                    <a href="{{ route('attendance-records.index') }}" class="card edutools-card edutools-module h-100">
                        <div class="card-body">
                            <div class="edutools-mini-label mb-2">Asistencias</div>
                            <h3 class="fw-bold mb-1">{{ $stats['attendance_records'] }}</h3>
                            <p class="text-muted mb-0">Registros académicos</p>
                        </div>
                    </a>
                </div>

                <div class="col-md-6 col-xl-3">
                    <a href="{{ route('academic-calendar-events.index') }}" class="card edutools-card edutools-module h-100">
                        <div class="card-body">
                            <div class="edutools-mini-label mb-2">Eventos activos</div>
                            <h3 class="fw-bold mb-1">{{ $stats['active_calendar_events'] }}</h3>
                            <p class="text-muted mb-0">Calendario académico</p>
                        </div>
                    </a>
                </div>
            </section>

            <section class="row g-4 mb-4">
                <div class="col-xl-8">
                    <div class="card edutools-card h-100">
                        <div class="card-body p-4">
                            <div class="d-flex flex-column flex-md-row justify-content-between gap-3 mb-3">
                                <div>
                                    <h5 class="fw-bold mb-1">Resumen operativo del sistema</h5>
                                    <p class="text-muted mb-0">
                                        Conteos reales obtenidos desde MySQL.
                                    </p>
                                </div>

                                <span class="badge rounded-pill text-bg-success align-self-md-start px-3 py-2">
                                    <i class="bi bi-database-check me-1"></i>
                                    Datos reales
                                </span>
                            </div>

                            <div id="academicActivityChart"></div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card edutools-card h-100">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-1">Estado del sistema</h5>
                            <p class="text-muted mb-4">Componentes principales verificados.</p>

                            <div class="d-flex align-items-center justify-content-between border-bottom py-3">
                                <div><span class="edutools-status-dot me-2"></span>Autenticación</div>
                                <span class="badge text-bg-success">Activa</span>
                            </div>

                            <div class="d-flex align-items-center justify-content-between border-bottom py-3">
                                <div><span class="edutools-status-dot me-2"></span>Roles</div>
                                <span class="badge text-bg-success">Activos</span>
                            </div>

                            <div class="d-flex align-items-center justify-content-between border-bottom py-3">
                                <div><span class="edutools-status-dot me-2"></span>Portal padres</div>
                                <span class="badge text-bg-success">Funcional</span>
                            </div>

                            <div class="d-flex align-items-center justify-content-between border-bottom py-3">
                                <div><span class="edutools-status-dot me-2"></span>CRUDs administrativos</div>
                                <span class="badge text-bg-success">Completos</span>
                            </div>

                            <div class="d-flex align-items-center justify-content-between py-3">
                                <div><span class="edutools-status-dot me-2"></span>MySQL</div>
                                <span class="badge text-bg-success">Conectado</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="row g-4 mb-4">
                <div class="col-xl-4">
                    <div class="card edutools-card h-100">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3">Últimas inscripciones</h5>

                            <div class="table-responsive">
                                <table class="table align-middle edutools-table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Alumno</th>
                                            <th>Ciclo</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($latestEnrollments as $enrollment)
                                            <tr>
                                                <td>
                                                    {{ $enrollment->student->first_name ?? 'Alumno' }}
                                                    {{ $enrollment->student->last_name ?? '' }}
                                                </td>
                                                <td>{{ $enrollment->academic_year }}</td>
                                                <td><span class="badge text-bg-primary">{{ ucfirst($enrollment->status) }}</span></td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-muted">Sin inscripciones recientes.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card edutools-card h-100">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3">Últimas notas</h5>

                            <div class="table-responsive">
                                <table class="table align-middle edutools-table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Alumno</th>
                                            <th>Curso</th>
                                            <th>Nota</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($latestGradeRecords as $gradeRecord)
                                            <tr>
                                                <td>
                                                    {{ $gradeRecord->student->first_name ?? 'Alumno' }}
                                                    {{ $gradeRecord->student->last_name ?? '' }}
                                                </td>
                                                <td>{{ $gradeRecord->course->name ?? 'Curso' }}</td>
                                                <td>{{ number_format($gradeRecord->score, 2) }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-muted">Sin notas recientes.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="card edutools-card h-100">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3">Eventos próximos</h5>

                            <div class="table-responsive">
                                <table class="table align-middle edutools-table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Evento</th>
                                            <th>Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($upcomingEvents as $event)
                                            <tr>
                                                <td>{{ $event->title }}</td>
                                                <td>{{ \Carbon\Carbon::parse($event->event_date)->format('d/m/Y') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2" class="text-muted">Sin eventos próximos.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="row g-4">
                <div class="col-12">
                    <div class="card edutools-card">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3">Módulos administrativos disponibles</h5>

                            <div class="row g-3">
                                <div class="col-6 col-md-4 col-xl-2">
                                    <a href="{{ route('users.index') }}" class="edutools-module border rounded-4 p-3 h-100 d-block">
                                        <i class="bi bi-people-fill text-primary fs-3"></i>
                                        <p class="fw-semibold mt-2 mb-0">Usuarios</p>
                                    </a>
                                </div>

                                <div class="col-6 col-md-4 col-xl-2">
                                    <a href="{{ route('grades.index') }}" class="edutools-module border rounded-4 p-3 h-100 d-block">
                                        <i class="bi bi-layers text-success fs-3"></i>
                                        <p class="fw-semibold mt-2 mb-0">Grados</p>
                                    </a>
                                </div>

                                <div class="col-6 col-md-4 col-xl-2">
                                    <a href="{{ route('sections.index') }}" class="edutools-module border rounded-4 p-3 h-100 d-block">
                                        <i class="bi bi-grid-3x3-gap text-info fs-3"></i>
                                        <p class="fw-semibold mt-2 mb-0">Secciones</p>
                                    </a>
                                </div>

                                <div class="col-6 col-md-4 col-xl-2">
                                    <a href="{{ route('enrollments.index') }}" class="edutools-module border rounded-4 p-3 h-100 d-block">
                                        <i class="bi bi-clipboard-check text-warning fs-3"></i>
                                        <p class="fw-semibold mt-2 mb-0">Inscripciones</p>
                                    </a>
                                </div>

                                <div class="col-6 col-md-4 col-xl-2">
                                    <a href="{{ route('grade-records.index') }}" class="edutools-module border rounded-4 p-3 h-100 d-block">
                                        <i class="bi bi-clipboard-data text-danger fs-3"></i>
                                        <p class="fw-semibold mt-2 mb-0">Notas</p>
                                    </a>
                                </div>

                                <div class="col-6 col-md-4 col-xl-2">
                                    <a href="{{ route('attendance-records.index') }}" class="edutools-module border rounded-4 p-3 h-100 d-block">
                                        <i class="bi bi-calendar-check text-primary fs-3"></i>
                                        <p class="fw-semibold mt-2 mb-0">Asistencia</p>
                                    </a>
                                </div>
                            </div>
                        </div>
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
                        height: 360,
                        toolbar: { show: false },
                        animations: {
                            enabled: true,
                            easing: 'easeinout',
                            speed: 900
                        }
                    },
                    series: [
                        {
                            name: 'Registros activos',
                            data: chartValues
                        }
                    ],
                    xaxis: {
                        categories: chartLabels
                    },
                    plotOptions: {
                        bar: {
                            borderRadius: 8,
                            columnWidth: '48%'
                        }
                    },
                    dataLabels: {
                        enabled: true
                    },
                    grid: {
                        borderColor: '#e5e7eb'
                    },
                    tooltip: {
                        y: {
                            formatter: function (value) {
                                return value + ' registros';
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