@extends('layouts.admin')

@section('page-title', 'Detalle de inscripción')
@section('page-subtitle', 'Información registrada de la inscripción académica')

@section('content')
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
                <div>
                    <h2 class="h5 fw-bold mb-1">
                        {{ $enrollment->student->first_name ?? 'Alumno' }} {{ $enrollment->student->last_name ?? '' }}
                    </h2>
                    <p class="text-muted mb-0">
                        Ciclo escolar: {{ $enrollment->academic_year }}
                    </p>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('enrollments.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="bi bi-arrow-left me-1"></i>
                        Volver
                    </a>

                    <a href="{{ route('enrollments.edit', $enrollment) }}" class="btn btn-outline-warning rounded-pill px-4">
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
                            {{ $enrollment->student->student_code ?? 'Sin código' }} -
                            {{ $enrollment->student->first_name ?? '' }}
                            {{ $enrollment->student->last_name ?? '' }}
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Ciclo escolar</div>
                        <div class="fw-semibold">{{ $enrollment->academic_year }}</div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Grado</div>
                        <div class="fw-semibold">{{ $enrollment->grade->name ?? 'No asignado' }}</div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Sección</div>
                        <div class="fw-semibold">{{ $enrollment->section->name ?? 'No asignada' }}</div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Fecha de inscripción</div>
                        <div class="fw-semibold">{{ \Carbon\Carbon::parse($enrollment->enrollment_date)->format('d/m/Y') }}</div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Estado</div>
                        <div class="fw-semibold">{{ ucfirst($enrollment->status) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection