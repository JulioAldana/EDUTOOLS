@extends('layouts.admin')

@section('page-title', 'Detalle del grado')
@section('page-subtitle', 'Información registrada del grado académico')

@section('content')
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
                <div>
                    <h2 class="h5 fw-bold mb-1">{{ $grade->name }}</h2>
                    <p class="text-muted mb-0">Nivel: {{ $grade->level }}</p>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('grades.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="bi bi-arrow-left me-1"></i>
                        Volver
                    </a>

                    <a href="{{ route('grades.edit', $grade) }}" class="btn btn-outline-warning rounded-pill px-4">
                        <i class="bi bi-pencil-square me-1"></i>
                        Editar
                    </a>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Nombre del grado</div>
                        <div class="fw-semibold">{{ $grade->name }}</div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Nivel académico</div>
                        <div class="fw-semibold">{{ $grade->level }}</div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Estado</div>
                        <div>
                            @if ($grade->is_active)
                                <span class="badge rounded-pill text-bg-success">Activo</span>
                            @else
                                <span class="badge rounded-pill text-bg-secondary">Inactivo</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Secciones asociadas</div>
                        <div class="fw-semibold">{{ $grade->sections->count() }}</div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Descripción</div>
                        <div class="fw-semibold">{{ $grade->description ?? 'Sin descripción registrada' }}</div>
                    </div>
                </div>
            </div>

            <h3 class="h6 fw-bold mt-4 mb-3">Secciones de este grado</h3>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr class="text-muted">
                            <th>Sección</th>
                            <th>Capacidad</th>
                            <th>Estado</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($grade->sections as $section)
                            <tr>
                                <td>{{ $section->name }}</td>
                                <td>{{ $section->capacity }} estudiantes</td>
                                <td>
                                    @if ($section->is_active)
                                        <span class="badge rounded-pill text-bg-success">Activa</span>
                                    @else
                                        <span class="badge rounded-pill text-bg-secondary">Inactiva</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-muted">Este grado todavía no tiene secciones registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection