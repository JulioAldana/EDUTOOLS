@extends('layouts.admin')

@section('page-title', 'Detalle de la sección')
@section('page-subtitle', 'Información registrada de la sección académica')

@section('content')
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
                <div>
                    <h2 class="h5 fw-bold mb-1">
                        Sección {{ $section->name }}
                    </h2>
                    <p class="text-muted mb-0">
                        Grado: {{ $section->grade->name ?? 'No asignado' }}
                    </p>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('sections.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="bi bi-arrow-left me-1"></i>
                        Volver
                    </a>

                    <a href="{{ route('sections.edit', $section) }}" class="btn btn-outline-warning rounded-pill px-4">
                        <i class="bi bi-pencil-square me-1"></i>
                        Editar
                    </a>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Sección</div>
                        <div class="fw-semibold">{{ $section->name }}</div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Capacidad</div>
                        <div class="fw-semibold">{{ $section->capacity }} estudiantes</div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Grado</div>
                        <div class="fw-semibold">{{ $section->grade->name ?? 'No asignado' }}</div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Nivel académico</div>
                        <div class="fw-semibold">{{ $section->grade->level ?? 'No asignado' }}</div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Estado</div>
                        <div>
                            @if ($section->is_active)
                                <span class="badge rounded-pill text-bg-success">Activa</span>
                            @else
                                <span class="badge rounded-pill text-bg-secondary">Inactiva</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection