@extends('layouts.admin')

@section('page-title', 'Detalle de asistencia')
@section('page-subtitle', 'Información registrada del control de asistencia')

@section('content')
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
                <div>
                    <h2 class="h5 fw-bold mb-1">
                        {{ $attendanceRecord->student->first_name ?? 'Alumno' }} {{ $attendanceRecord->student->last_name ?? '' }}
                    </h2>
                    <p class="text-muted mb-0">
                        Fecha: {{ \Carbon\Carbon::parse($attendanceRecord->attendance_date)->format('d/m/Y') }}
                    </p>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('attendance-records.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="bi bi-arrow-left me-1"></i>
                        Volver
                    </a>

                    <a href="{{ route('attendance-records.edit', $attendanceRecord) }}" class="btn btn-outline-warning rounded-pill px-4">
                        <i class="bi bi-pencil-square me-1"></i>
                        Editar
                    </a>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Alumno</div>
                        <div class="fw-semibold">
                            {{ $attendanceRecord->student->student_code ?? 'Sin código' }} -
                            {{ $attendanceRecord->student->first_name ?? '' }}
                            {{ $attendanceRecord->student->last_name ?? '' }}
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Curso</div>
                        <div class="fw-semibold">
                            {{ $attendanceRecord->course->code ?? 'Sin código' }} -
                            {{ $attendanceRecord->course->name ?? 'No asignado' }}
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Docente</div>
                        <div class="fw-semibold">
                            @if ($attendanceRecord->teacher)
                                {{ $attendanceRecord->teacher->first_name }} {{ $attendanceRecord->teacher->last_name }}
                            @else
                                No asignado
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Fecha</div>
                        <div class="fw-semibold">{{ \Carbon\Carbon::parse($attendanceRecord->attendance_date)->format('d/m/Y') }}</div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Estado</div>
                        <div class="fw-semibold">{{ ucfirst($attendanceRecord->status) }}</div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Comentarios</div>
                        <div class="fw-semibold">{{ $attendanceRecord->comments ?? 'Sin comentarios registrados' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection