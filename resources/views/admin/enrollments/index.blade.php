@extends('layouts.admin')

@section('page-title', 'Gestión de inscripciones')
@section('page-subtitle', 'Consulta y administración de inscripciones académicas')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm" role="alert">
            <i class="bi bi-check-circle me-1"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
                <div>
                    <h2 class="h5 fw-bold mb-1">Inscripciones registradas</h2>
                    <p class="text-muted mb-0">
                        Listado general de alumnos inscritos por ciclo escolar, grado y sección.
                    </p>
                </div>

                <a href="{{ route('enrollments.create') }}" class="btn btn-primary rounded-pill px-4">
                    <i class="bi bi-plus-circle me-1"></i>
                    Nueva inscripción
                </a>
            </div>

            <form method="GET" action="{{ route('enrollments.index') }}" class="mb-4">
                <div class="row g-2">
                    <div class="col-12 col-md-9">
                        <input
                            type="text"
                            name="search"
                            value="{{ $search }}"
                            class="form-control form-control-lg rounded-pill"
                            placeholder="Buscar por alumno, código, grado, sección, año o estado"
                        >
                    </div>

                    <div class="col-12 col-md-3 d-grid">
                        <button type="submit" class="btn btn-dark rounded-pill">
                            <i class="bi bi-search me-1"></i>
                            Buscar
                        </button>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr class="text-muted">
                            <th>Alumno</th>
                            <th>Grado</th>
                            <th>Sección</th>
                            <th>Ciclo</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($enrollments as $enrollment)
                            <tr>
                                <td>
                                    <div class="fw-semibold">
                                        {{ $enrollment->student->first_name ?? 'No registrado' }}
                                        {{ $enrollment->student->last_name ?? '' }}
                                    </div>
                                    <div class="small text-muted">
                                        {{ $enrollment->student->student_code ?? 'Sin código' }}
                                    </div>
                                </td>

                                <td>{{ $enrollment->grade->name ?? 'No asignado' }}</td>
                                <td>{{ $enrollment->section->name ?? 'No asignada' }}</td>
                                <td>{{ $enrollment->academic_year }}</td>
                                <td>{{ \Carbon\Carbon::parse($enrollment->enrollment_date)->format('d/m/Y') }}</td>

                                <td>
                                    @if ($enrollment->status === 'activo')
                                        <span class="badge rounded-pill text-bg-success">Activo</span>
                                    @elseif ($enrollment->status === 'finalizado')
                                        <span class="badge rounded-pill text-bg-primary">Finalizado</span>
                                    @elseif ($enrollment->status === 'retirado')
                                        <span class="badge rounded-pill text-bg-warning">Retirado</span>
                                    @else
                                        <span class="badge rounded-pill text-bg-secondary">Inactivo</span>
                                    @endif
                                </td>

                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-1">
                                        <a href="{{ route('enrollments.show', $enrollment) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                                            Ver
                                        </a>

                                        <a href="{{ route('enrollments.edit', $enrollment) }}" class="btn btn-sm btn-outline-warning rounded-pill">
                                            Editar
                                        </a>

                                        @if ($enrollment->status !== 'inactivo')
                                            <form method="POST" action="{{ route('enrollments.destroy', $enrollment) }}" onsubmit="return confirm('¿Seguro que desea inactivar esta inscripción?');">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill">
                                                    Inactivar
                                                </button>
                                            </form>
                                        @else
                                            <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill" disabled>
                                                Inactiva
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <i class="bi bi-inbox fs-1 text-muted"></i>
                                    <h3 class="h6 fw-bold mt-3">No se encontraron inscripciones</h3>
                                    <p class="text-muted mb-0">Intenta con otro criterio de búsqueda.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mt-4">
                <div class="text-muted small">
                    Mostrando {{ $enrollments->count() }} inscripción(es) de {{ $enrollments->total() }} registro(s).
                </div>

                <div>
                    {{ $enrollments->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection