@extends('layouts.admin')

@section('page-title', 'Información académica del alumno')
@section('page-subtitle', 'Consulta de inscripciones, notas y asistencia')

@section('content')
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">
                <div>
                    <h2 class="h5 fw-bold mb-1">
                        {{ $student->first_name }} {{ $student->last_name }}
                    </h2>

                    <p class="text-muted mb-0">
                        Código: {{ $student->student_code }}
                    </p>
                </div>

                <a href="{{ route('portal.dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="bi bi-arrow-left me-1"></i>
                    Volver al portal
                </a>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <h3 class="h6 fw-bold mb-3">Inscripciones</h3>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr class="text-muted">
                            <th>Ciclo</th>
                            <th>Grado</th>
                            <th>Sección</th>
                            <th>Estado</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($enrollments as $enrollment)
                            <tr>
                                <td>{{ $enrollment->academic_year }}</td>
                                <td>{{ $enrollment->grade->name ?? 'No asignado' }}</td>
                                <td>{{ $enrollment->section->name ?? 'No asignada' }}</td>
                                <td>{{ ucfirst($enrollment->status) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-muted">No hay inscripciones registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <h3 class="h6 fw-bold mb-3">Notas</h3>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr class="text-muted">
                            <th>Ciclo</th>
                            <th>Curso</th>
                            <th>Período</th>
                            <th>Evaluación</th>
                            <th>Nota</th>
                            <th>Estado</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($grades as $grade)
                            <tr>
                                <td>{{ $grade->academic_year }}</td>
                                <td>{{ $grade->course->name ?? 'No asignado' }}</td>
                                <td>{{ $grade->term }}</td>
                                <td>{{ $grade->evaluation_type }}</td>
                                <td>{{ number_format($grade->score, 2) }} / {{ number_format($grade->max_score, 2) }}</td>
                                <td>{{ ucfirst($grade->status) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-muted">No hay notas registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <h3 class="h6 fw-bold mb-3">Asistencia reciente</h3>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr class="text-muted">
                            <th>Fecha</th>
                            <th>Curso</th>
                            <th>Estado</th>
                            <th>Comentarios</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($attendanceRecords as $attendance)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($attendance->attendance_date)->format('d/m/Y') }}</td>
                                <td>{{ $attendance->course->name ?? 'No asignado' }}</td>
                                <td>{{ ucfirst($attendance->status) }}</td>
                                <td>{{ $attendance->comments ?? 'Sin comentarios' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-muted">No hay asistencia registrada.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection