@extends('layouts.admin')

@section('page-title', 'Detalle del docente')
@section('page-subtitle', 'Información registrada del catedrático en EDUTOOLS')

@section('content')
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
                <div>
                    <h2 class="h5 fw-bold mb-1">
                        {{ $teacher->first_name }} {{ $teacher->last_name }}
                    </h2>
                    <p class="text-muted mb-0">
                        Código: {{ $teacher->teacher_code }}
                    </p>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('teachers.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="bi bi-arrow-left me-1"></i>
                        Volver
                    </a>

                    <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-outline-warning rounded-pill px-4">
                        <i class="bi bi-pencil-square me-1"></i>
                        Editar
                    </a>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Código del docente</div>
                        <div class="fw-semibold">{{ $teacher->teacher_code }}</div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-xl-4">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Nombres</div>
                        <div class="fw-semibold">{{ $teacher->first_name }}</div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-xl-4">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Apellidos</div>
                        <div class="fw-semibold">{{ $teacher->last_name }}</div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-xl-4">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">DPI</div>
                        <div class="fw-semibold">{{ $teacher->dpi ?? 'No registrado' }}</div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-xl-4">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Teléfono</div>
                        <div class="fw-semibold">{{ $teacher->phone ?? 'No registrado' }}</div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-xl-4">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Correo electrónico</div>
                        <div class="fw-semibold">{{ $teacher->email ?? 'No registrado' }}</div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-xl-4">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Especialidad</div>
                        <div class="fw-semibold">{{ $teacher->specialty ?? 'No registrada' }}</div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-xl-4">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Fecha de contratación</div>
                        <div class="fw-semibold">
                            @if ($teacher->hire_date)
                                {{ \Carbon\Carbon::parse($teacher->hire_date)->format('d/m/Y') }}
                            @else
                                No registrada
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-xl-4">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Estado</div>
                        <div>
                            @if ($teacher->is_active)
                                <span class="badge rounded-pill text-bg-success">Activo</span>
                            @else
                                <span class="badge rounded-pill text-bg-secondary">Inactivo</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection