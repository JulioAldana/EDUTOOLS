@extends('layouts.admin')

@section('page-title', 'Detalle del curso')
@section('page-subtitle', 'Información registrada del curso académico')

@section('content')
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
                <div>
                    <h2 class="h5 fw-bold mb-1">
                        {{ $course->name }}
                    </h2>
                    <p class="text-muted mb-0">
                        Código: {{ $course->code }}
                    </p>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="bi bi-arrow-left me-1"></i>
                        Volver
                    </a>

                    <a href="{{ route('courses.edit', $course) }}" class="btn btn-outline-warning rounded-pill px-4">
                        <i class="bi bi-pencil-square me-1"></i>
                        Editar
                    </a>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Código del curso</div>
                        <div class="fw-semibold">{{ $course->code }}</div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-xl-4">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Nombre del curso</div>
                        <div class="fw-semibold">{{ $course->name }}</div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-xl-4">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Horas semanales</div>
                        <div class="fw-semibold">{{ $course->weekly_hours }} h/semana</div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Grado asignado</div>
                        <div class="fw-semibold">{{ $course->grade->name ?? 'No asignado' }}</div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Docente asignado</div>
                        <div class="fw-semibold">
                            @if ($course->teacher)
                                {{ $course->teacher->first_name }} {{ $course->teacher->last_name }}
                            @else
                                No asignado
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Estado</div>
                        <div>
                            @if ($course->is_active)
                                <span class="badge rounded-pill text-bg-success">Activo</span>
                            @else
                                <span class="badge rounded-pill text-bg-secondary">Inactivo</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Descripción</div>
                        <div class="fw-semibold">
                            {{ $course->description ?? 'Sin descripción registrada' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection