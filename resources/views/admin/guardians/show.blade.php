@extends('layouts.admin')

@section('page-title', 'Detalle del tutor')
@section('page-subtitle', 'Información registrada del padre, madre o responsable')

@section('content')
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
                <div>
                    <h2 class="h5 fw-bold mb-1">{{ $guardian->first_name }} {{ $guardian->last_name }}</h2>
                    <p class="text-muted mb-0">Parentesco: {{ $guardian->relationship }}</p>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('guardians.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="bi bi-arrow-left me-1"></i>
                        Volver
                    </a>

                    <a href="{{ route('guardians.edit', $guardian) }}" class="btn btn-outline-warning rounded-pill px-4">
                        <i class="bi bi-pencil-square me-1"></i>
                        Editar
                    </a>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Nombre completo</div>
                        <div class="fw-semibold">{{ $guardian->first_name }} {{ $guardian->last_name }}</div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-xl-4">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">DPI</div>
                        <div class="fw-semibold">{{ $guardian->dpi ?? 'No registrado' }}</div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-xl-4">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Teléfono</div>
                        <div class="fw-semibold">{{ $guardian->phone }}</div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-xl-4">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Parentesco</div>
                        <div class="fw-semibold">{{ $guardian->relationship }}</div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-xl-4">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Estado</div>
                        <div>
                            @if ($guardian->is_active)
                                <span class="badge rounded-pill text-bg-success">Activo</span>
                            @else
                                <span class="badge rounded-pill text-bg-secondary">Inactivo</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-8">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Dirección</div>
                        <div class="fw-semibold">{{ $guardian->address ?? 'Sin dirección registrada' }}</div>
                    </div>
                </div>
            </div>

            <h3 class="h6 fw-bold mt-4 mb-3">Alumnos vinculados</h3>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr class="text-muted">
                            <th>Código</th>
                            <th>Alumno</th>
                            <th>Principal</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($guardian->students as $student)
                            <tr>
                                <td class="fw-semibold">{{ $student->student_code }}</td>
                                <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                                <td>
                                    @if ($student->pivot->is_primary)
                                        <span class="badge rounded-pill text-bg-primary">Principal</span>
                                    @else
                                        <span class="badge rounded-pill text-bg-light text-dark">Secundario</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-muted">Este tutor no tiene alumnos vinculados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection