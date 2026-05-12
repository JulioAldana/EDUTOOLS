@extends('layouts.admin')

@section('page-title', 'Detalle del alumno')
@section('page-subtitle', 'Información registrada del estudiante en EDUTOOLS')

@section('content')
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
                <div>
                    <h2 class="h5 fw-bold mb-1">
                        {{ $student->first_name }} {{ $student->last_name }}
                    </h2>
                    <p class="text-muted mb-0">
                        Código: {{ $student->student_code }}
                    </p>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('students.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="bi bi-arrow-left me-1"></i>
                        Volver
                    </a>

                    <a href="{{ route('students.edit', $student) }}" class="btn btn-outline-warning rounded-pill px-4">
                         <i class="bi bi-pencil-square me-1"></i>
                             Editar
                    </a>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Código del alumno</div>
                        <div class="fw-semibold">{{ $student->student_code }}</div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-xl-4">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Nombres</div>
                        <div class="fw-semibold">{{ $student->first_name }}</div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-xl-4">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Apellidos</div>
                        <div class="fw-semibold">{{ $student->last_name }}</div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-xl-4">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Fecha de nacimiento</div>
                        <div class="fw-semibold">
                            @if ($student->birth_date)
                                {{ \Carbon\Carbon::parse($student->birth_date)->format('d/m/Y') }}
                            @else
                                No registrada
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-xl-4">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Género</div>
                        <div class="fw-semibold">{{ $student->gender ?? 'No registrado' }}</div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-xl-4">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Teléfono</div>
                        <div class="fw-semibold">{{ $student->phone ?? 'No registrado' }}</div>
                    </div>
                </div>

                <div class="col-12 col-xl-8">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Dirección</div>
                        <div class="fw-semibold">{{ $student->address ?? 'No registrada' }}</div>
                    </div>
                </div>

                <div class="col-12 col-xl-4">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Estado</div>
                        <div>
                            @if ($student->is_active)
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