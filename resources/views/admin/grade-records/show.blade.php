@extends('layouts.admin')

@section('page-title', 'Detalle de nota')
@section('page-subtitle', 'Información registrada de la calificación académica')

@section('content')
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
                <div>
                    <h2 class="h5 fw-bold mb-1">
                        {{ $gradeRecord->student->first_name ?? 'Alumno' }} {{ $gradeRecord->student->last_name ?? '' }}
                    </h2>
                    <p class="text-muted mb-0">
                        {{ $gradeRecord->course->name ?? 'Curso no asignado' }} - {{ $gradeRecord->term }}
                    </p>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('grade-records.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="bi bi-arrow-left me-1"></i>
                        Volver
                    </a>

                    <a href="{{ route('grade-records.edit', $gradeRecord) }}" class="btn btn-outline-warning rounded-pill px-4">
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
                            {{ $gradeRecord->student->student_code ?? 'Sin código' }} -
                            {{ $gradeRecord->student->first_name ?? '' }}
                            {{ $gradeRecord->student->last_name ?? '' }}
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Curso</div>
                        <div class="fw-semibold">
                            {{ $gradeRecord->course->code ?? 'Sin código' }} -
                            {{ $gradeRecord->course->name ?? 'No asignado' }}
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Docente</div>
                        <div class="fw-semibold">
                            @if ($gradeRecord->teacher)
                                {{ $gradeRecord->teacher->first_name }} {{ $gradeRecord->teacher->last_name }}
                            @else
                                No asignado
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Ciclo escolar</div>
                        <div class="fw-semibold">{{ $gradeRecord->academic_year }}</div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Período</div>
                        <div class="fw-semibold">{{ $gradeRecord->term }}</div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Tipo de evaluación</div>
                        <div class="fw-semibold">{{ $gradeRecord->evaluation_type }}</div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Estado</div>
                        <div class="fw-semibold">{{ ucfirst($gradeRecord->status) }}</div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Nota obtenida</div>
                        <div class="fw-semibold">{{ number_format($gradeRecord->score, 2) }}</div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Nota máxima</div>
                        <div class="fw-semibold">{{ number_format($gradeRecord->max_score, 2) }}</div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Comentarios</div>
                        <div class="fw-semibold">{{ $gradeRecord->comments ?? 'Sin comentarios registrados' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection