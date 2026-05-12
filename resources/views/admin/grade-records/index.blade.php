@extends('layouts.admin')

@section('page-title', 'Gestión de notas')
@section('page-subtitle', 'Consulta y administración de calificaciones académicas')

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
                    <h2 class="h5 fw-bold mb-1">Notas registradas</h2>
                    <p class="text-muted mb-0">
                        Listado general de calificaciones por alumno, curso, docente y período.
                    </p>
                </div>

                <a href="{{ route('grade-records.create') }}" class="btn btn-primary rounded-pill px-4">
                    <i class="bi bi-plus-circle me-1"></i>
                    Nueva nota
                </a>
            </div>

            <form method="GET" action="{{ route('grade-records.index') }}" class="mb-4">
                <div class="row g-2">
                    <div class="col-12 col-md-9">
                        <input
                            type="text"
                            name="search"
                            value="{{ $search }}"
                            class="form-control form-control-lg rounded-pill"
                            placeholder="Buscar por alumno, curso, docente, año, período, tipo o estado"
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
                            <th>Curso</th>
                            <th>Docente</th>
                            <th>Período</th>
                            <th>Evaluación</th>
                            <th>Nota</th>
                            <th>Estado</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($gradeRecords as $gradeRecord)
                            <tr>
                                <td>
                                    <div class="fw-semibold">
                                        {{ $gradeRecord->student->first_name ?? 'No registrado' }}
                                        {{ $gradeRecord->student->last_name ?? '' }}
                                    </div>
                                    <div class="small text-muted">
                                        {{ $gradeRecord->student->student_code ?? 'Sin código' }}
                                    </div>
                                </td>

                                <td>
                                    <div class="fw-semibold">
                                        {{ $gradeRecord->course->name ?? 'No asignado' }}
                                    </div>
                                    <div class="small text-muted">
                                        {{ $gradeRecord->course->code ?? 'Sin código' }}
                                    </div>
                                </td>

                                <td>
                                    @if ($gradeRecord->teacher)
                                        {{ $gradeRecord->teacher->first_name }} {{ $gradeRecord->teacher->last_name }}
                                    @else
                                        No asignado
                                    @endif
                                </td>

                                <td>
                                    <div class="fw-semibold">{{ $gradeRecord->term }}</div>
                                    <div class="small text-muted">{{ $gradeRecord->academic_year }}</div>
                                </td>

                                <td>{{ $gradeRecord->evaluation_type }}</td>

                                <td>
                                    <span class="fw-semibold">
                                        {{ number_format($gradeRecord->score, 2) }}
                                    </span>
                                    /
                                    {{ number_format($gradeRecord->max_score, 2) }}
                                </td>

                                <td>
                                    @if ($gradeRecord->status === 'activo')
                                        <span class="badge rounded-pill text-bg-success">Activo</span>
                                    @else
                                        <span class="badge rounded-pill text-bg-secondary">Anulado</span>
                                    @endif
                                </td>

                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-1">
                                        <a href="{{ route('grade-records.show', $gradeRecord) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                                            Ver
                                        </a>

                                        <a href="{{ route('grade-records.edit', $gradeRecord) }}" class="btn btn-sm btn-outline-warning rounded-pill">
                                            Editar
                                        </a>

                                        @if ($gradeRecord->status !== 'anulado')
                                            <form method="POST" action="{{ route('grade-records.destroy', $gradeRecord) }}" onsubmit="return confirm('¿Seguro que desea anular esta nota?');">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill">
                                                    Anular
                                                </button>
                                            </form>
                                        @else
                                            <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill" disabled>
                                                Anulada
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <i class="bi bi-inbox fs-1 text-muted"></i>
                                    <h3 class="h6 fw-bold mt-3">No se encontraron notas</h3>
                                    <p class="text-muted mb-0">Intenta con otro criterio de búsqueda.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mt-4">
                <div class="text-muted small">
                    Mostrando {{ $gradeRecords->count() }} nota(s) de {{ $gradeRecords->total() }} registro(s).
                </div>

                <div>
                    {{ $gradeRecords->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection