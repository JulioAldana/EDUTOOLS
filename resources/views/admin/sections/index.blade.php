@extends('layouts.admin')

@section('page-title', 'Gestión de secciones')
@section('page-subtitle', 'Consulta y administración de secciones por grado en EDUTOOLS')

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
                    <h2 class="h5 fw-bold mb-1">Secciones registradas</h2>
                    <p class="text-muted mb-0">
                        Listado general de secciones asociadas a cada grado académico.
                    </p>
                </div>

                <a href="{{ route('sections.create') }}" class="btn btn-primary rounded-pill px-4">
                    <i class="bi bi-plus-circle me-1"></i>
                    Nueva sección
                </a>
            </div>

            <form method="GET" action="{{ route('sections.index') }}" class="mb-4">
                <div class="row g-2">
                    <div class="col-12 col-md-9">
                        <input
                            type="text"
                            name="search"
                            value="{{ $search }}"
                            class="form-control form-control-lg rounded-pill"
                            placeholder="Buscar por sección, capacidad, grado o nivel"
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
                            <th>Sección</th>
                            <th>Grado</th>
                            <th>Nivel</th>
                            <th>Capacidad</th>
                            <th>Estado</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($sections as $section)
                            <tr>
                                <td class="fw-semibold">{{ $section->name }}</td>
                                <td>{{ $section->grade->name ?? 'No asignado' }}</td>
                                <td>{{ $section->grade->level ?? 'No asignado' }}</td>
                                <td>{{ $section->capacity }} estudiantes</td>

                                <td>
                                    @if ($section->is_active)
                                        <span class="badge rounded-pill text-bg-success">Activa</span>
                                    @else
                                        <span class="badge rounded-pill text-bg-secondary">Inactiva</span>
                                    @endif
                                </td>

                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-1">
                                        <a href="{{ route('sections.show', $section) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                                            Ver
                                        </a>

                                        <a href="{{ route('sections.edit', $section) }}" class="btn btn-sm btn-outline-warning rounded-pill">
                                            Editar
                                        </a>

                                        @if ($section->is_active)
                                            <form method="POST" action="{{ route('sections.destroy', $section) }}" onsubmit="return confirm('¿Seguro que desea inactivar esta sección?');">
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
                                <td colspan="6" class="text-center py-5">
                                    <i class="bi bi-inbox fs-1 text-muted"></i>
                                    <h3 class="h6 fw-bold mt-3">No se encontraron secciones</h3>
                                    <p class="text-muted mb-0">Intenta con otro criterio de búsqueda.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mt-4">
                <div class="text-muted small">
                    Mostrando {{ $sections->count() }} sección(es) de {{ $sections->total() }} registro(s).
                </div>

                <div>
                    {{ $sections->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection