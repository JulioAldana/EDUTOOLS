@extends('layouts.admin')

@section('page-title', 'Portal para padres')
@section('page-subtitle', 'Resumen académico de los alumnos vinculados a su cuenta')

@section('content')
    <div class="row g-3 mb-4">
        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <h2 class="h5 fw-bold mb-1">
                        {{ $guardian->first_name }} {{ $guardian->last_name }}
                    </h2>

                    <p class="text-muted mb-2">
                        {{ $guardian->relationship }}
                    </p>

                    <div class="small text-muted">
                        Teléfono: {{ $guardian->phone }}
                    </div>

                    <div class="small text-muted">
                        Alumnos vinculados: {{ $guardian->students->count() }}
                    </div>

                    <a href="{{ route('portal.calendar.index') }}" class="btn btn-outline-primary rounded-pill mt-3">
                        <i class="bi bi-calendar-event me-1"></i>
                        Ver calendario
                    </a>
                </div>
            </div>
        </div>

        @foreach ($guardian->students as $student)
            <div class="col-12 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">
                        <div class="small text-muted mb-1">{{ $student->student_code }}</div>

                        <h3 class="h6 fw-bold mb-2">
                            {{ $student->first_name }} {{ $student->last_name }}
                        </h3>

                        @if ($student->pivot->is_primary)
                            <span class="badge rounded-pill text-bg-primary mb-3">Alumno principal</span>
                        @else
                            <span class="badge rounded-pill text-bg-light text-dark mb-3">Alumno vinculado</span>
                        @endif

                        <div>
                            <a href="{{ route('portal.students.show', $student) }}" class="btn btn-primary rounded-pill px-4">
                                Ver información académica
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row g-3">
        <div class="col-12 col-xl-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <h2 class="h6 fw-bold mb-3">Notas recientes</h2>

                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr class="text-muted">
                                    <th>Alumno</th>
                                    <th>Curso</th>
                                    <th>Nota</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($recentGrades as $grade)
                                    <tr>
                                        <td>{{ $grade->student->first_name }} {{ $grade->student->last_name }}</td>
                                        <td>{{ $grade->course->name ?? 'No asignado' }}</td>
                                        <td class="fw-semibold">
                                            {{ number_format($grade->score, 2) }} / {{ number_format($grade->max_score, 2) }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-muted">No hay notas recientes.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <h2 class="h6 fw-bold mb-3">Asistencia reciente</h2>

                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr class="text-muted">
                                    <th>Alumno</th>
                                    <th>Fecha</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($recentAttendance as $attendance)
                                    <tr>
                                        <td>{{ $attendance->student->first_name }} {{ $attendance->student->last_name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($attendance->attendance_date)->format('d/m/Y') }}</td>
                                        <td>{{ ucfirst($attendance->status) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-muted">No hay asistencia reciente.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection