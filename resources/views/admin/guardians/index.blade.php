@extends('layouts.admin')

@section('page-title', 'Gestión de padres y tutores')
@section('page-subtitle', 'Consulta y administración de responsables vinculados a estudiantes')

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
                    <h2 class="h5 fw-bold mb-1">Padres/Tutores registrados</h2>
                    <p class="text-muted mb-0">
                        Listado general de responsables familiares vinculados a alumnos.
                    </p>
                </div>

                <a href="{{ route('guardians.create') }}" class="btn btn-primary rounded-pill px-4">
                    <i class="bi bi-plus-circle me-1"></i>
                    Nuevo tutor
                </a>
            </div>

            <form method="GET" action="{{ route('guardians.index') }}" class="mb-4">
                <div class="row g-2">
                    <div class="col-12 col-md-9">
                        <input
                            type="text"
                            name="search"
                            value="{{ $search }}"
                            class="form-control form-control-lg rounded-pill"
                            placeholder="Buscar por nombre, DPI, teléfono, parentesco o alumno"
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
                            <th>Tutor</th>
                            <th>DPI</th>
                            <th>Teléfono</th>
                            <th>Parentesco</th>
                            <th>Alumnos vinculados</th>
                            <th>Estado</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($guardians as $guardian)
                            <tr>
                                <td>
                                    <div class="fw-semibold">
                                        {{ $guardian->first_name }} {{ $guardian->last_name }}
                                    </div>
                                    <div class="small text-muted">
                                        {{ $guardian->address ?? 'Sin dirección registrada' }}
                                    </div>
                                </td>

                                <td>{{ $guardian->dpi ?? 'No registrado' }}</td>
                                <td>{{ $guardian->phone }}</td>
                                <td>{{ $guardian->relationship }}</td>
                                <td>{{ $guardian->students_count }}</td>

                                <td>
                                    @if ($guardian->is_active)
                                        <span class="badge rounded-pill text-bg-success">Activo</span>
                                    @else
                                        <span class="badge rounded-pill text-bg-secondary">Inactivo</span>
                                    @endif
                                </td>

                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-1">
                                        <a href="{{ route('guardians.show', $guardian) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                                            Ver
                                        </a>

                                        <a href="{{ route('guardians.edit', $guardian) }}" class="btn btn-sm btn-outline-warning rounded-pill">
                                            Editar
                                        </a>

                                        @if ($guardian->is_active)
                                            <form method="POST" action="{{ route('guardians.destroy', $guardian) }}" onsubmit="return confirm('¿Seguro que desea inactivar este tutor?');">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill">
                                                    Inactivar
                                                </button>
                                            </form>
                                        @else
                                            <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill" disabled>
                                                Inactivo
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <i class="bi bi-inbox fs-1 text-muted"></i>
                                    <h3 class="h6 fw-bold mt-3">No se encontraron tutores</h3>
                                    <p class="text-muted mb-0">Intenta con otro criterio de búsqueda.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mt-4">
                <div class="text-muted small">
                    Mostrando {{ $guardians->count() }} tutor(es) de {{ $guardians->total() }} registro(s).
                </div>

                <div>
                    {{ $guardians->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection