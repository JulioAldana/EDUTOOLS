@extends('layouts.admin')

@section('page-title', 'Gestión de cursos')
@section('page-subtitle', 'Consulta y administración de cursos registrados en EDUTOOLS')

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
                    <h2 class="h5 fw-bold mb-1">Cursos registrados</h2>
                    <p class="text-muted mb-0">
                        Listado general de cursos, grados asignados y docentes responsables.
                    </p>
                </div>

                <a href="{{ route('courses.create') }}" class="btn btn-primary rounded-pill px-4">
                    <i class="bi bi-plus-circle me-1"></i>
                    Nuevo curso
                </a>
            </div>

            <form method="GET" action="{{ route('courses.index') }}" class="mb-4">
                <div class="row g-2">
                    <div class="col-12 col-md-9">
                        <input
                            type="text"
                            name="search"
                            value="{{ $search }}"
                            class="form-control form-control-lg rounded-pill"
                            placeholder="Buscar por código, curso, descripción, grado o docente"
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
                            <th>Código</th>
                            <th>Curso</th>
                            <th>Grado</th>
                            <th>Docente</th>
                            <th>Horas</th>
                            <th>Estado</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($courses as $course)
                            <tr>
                                <td class="fw-semibold">
                                    {{ $course->code }}
                                </td>

                                <td>
                                    <div class="fw-semibold">
                                        {{ $course->name }}
                                    </div>

                                    <div class="small text-muted">
                                        {{ $course->description ? \Illuminate\Support\Str::limit($course->description, 70) : 'Sin descripción registrada' }}
                                    </div>
                                </td>

                                <td>
                                    {{ $course->grade->name ?? 'No asignado' }}
                                </td>

                                <td>
                                    @if ($course->teacher)
                                        {{ $course->teacher->first_name }} {{ $course->teacher->last_name }}
                                    @else
                                        No asignado
                                    @endif
                                </td>

                                <td>
                                    {{ $course->weekly_hours }} h/semana
                                </td>

                                <td>
                                    @if ($course->is_active)
                                        <span class="badge rounded-pill text-bg-success">Activo</span>
                                    @else
                                        <span class="badge rounded-pill text-bg-secondary">Inactivo</span>
                                    @endif
                                </td>

                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-1">
                                        <a href="{{ route('courses.show', $course) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                                            Ver
                                        </a>

                                        <a href="{{ route('courses.edit', $course) }}" class="btn btn-sm btn-outline-warning rounded-pill">
                                            Editar
                                        </a>

                                        @if ($course->is_active)
                                            <form method="POST" action="{{ route('courses.destroy', $course) }}" onsubmit="return confirm('¿Seguro que desea inactivar este curso?');">
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
                                    <h3 class="h6 fw-bold mt-3">No se encontraron cursos</h3>
                                    <p class="text-muted mb-0">
                                        Intenta con otro criterio de búsqueda.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mt-4">
                <div class="text-muted small">
                    Mostrando {{ $courses->count() }} curso(s) de {{ $courses->total() }} registro(s).
                </div>

                <div>
                    {{ $courses->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection