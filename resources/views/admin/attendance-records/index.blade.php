@extends('layouts.admin')

@section('page-title', 'Gestión de asistencia')
@section('page-subtitle', 'Consulta y administración de registros de asistencia académica')

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
                    <h2 class="h5 fw-bold mb-1">Asistencias registradas</h2>
                    <p class="text-muted mb-0">
                        Listado general de asistencia por alumno, curso, docente y fecha.
                    </p>
                </div>

                <a href="{{ route('attendance-records.create') }}" class="btn btn-primary rounded-pill px-4">
                    <i class="bi bi-plus-circle me-1"></i>
                    Nueva asistencia
                </a>
            </div>

            <form method="GET" action="{{ route('attendance-records.index') }}" class="mb-4">
                <div class="row g-2">
                    <div class="col-12 col-md-9">
                        <input
                            type="text"
                            name="search"
                            value="{{ $search }}"
                            class="form-control form-control-lg rounded-pill"
                            placeholder="Buscar por alumno, curso, docente, fecha, estado o comentario"
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
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Comentarios</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($attendanceRecords as $attendanceRecord)
                            <tr>
                                <td>
                                    <div class="fw-semibold">
                                        {{ $attendanceRecord->student->first_name ?? 'No registrado' }}
                                        {{ $attendanceRecord->student->last_name ?? '' }}
                                    </div>
                                    <div class="small text-muted">
                                        {{ $attendanceRecord->student->student_code ?? 'Sin código' }}
                                    </div>
                                </td>

                                <td>
                                    <div class="fw-semibold">
                                        {{ $attendanceRecord->course->name ?? 'No asignado' }}
                                    </div>
                                    <div class="small text-muted">
                                        {{ $attendanceRecord->course->code ?? 'Sin código' }}
                                    </div>
                                </td>

                                <td>
                                    @if ($attendanceRecord->teacher)
                                        {{ $attendanceRecord->teacher->first_name }} {{ $attendanceRecord->teacher->last_name }}
                                    @else
                                        No asignado
                                    @endif
                                </td>

                                <td>
                                    {{ \Carbon\Carbon::parse($attendanceRecord->attendance_date)->format('d/m/Y') }}
                                </td>

                                <td>
                                    @if ($attendanceRecord->status === 'presente')
                                        <span class="badge rounded-pill text-bg-success">Presente</span>
                                    @elseif ($attendanceRecord->status === 'ausente')
                                        <span class="badge rounded-pill text-bg-danger">Ausente</span>
                                    @elseif ($attendanceRecord->status === 'tarde')
                                        <span class="badge rounded-pill text-bg-warning">Tarde</span>
                                    @elseif ($attendanceRecord->status === 'justificado')
                                        <span class="badge rounded-pill text-bg-primary">Justificado</span>
                                    @else
                                        <span class="badge rounded-pill text-bg-secondary">Anulado</span>
                                    @endif
                                </td>

                                <td>
                                    {{ $attendanceRecord->comments ? \Illuminate\Support\Str::limit($attendanceRecord->comments, 50) : 'Sin comentarios' }}
                                </td>

                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-1">
                                        <a href="{{ route('attendance-records.show', $attendanceRecord) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                                            Ver
                                        </a>

                                        <a href="{{ route('attendance-records.edit', $attendanceRecord) }}" class="btn btn-sm btn-outline-warning rounded-pill">
                                            Editar
                                        </a>

                                        @if ($attendanceRecord->status !== 'anulado')
                                            <form method="POST" action="{{ route('attendance-records.destroy', $attendanceRecord) }}" onsubmit="return confirm('¿Seguro que desea anular esta asistencia?');">
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
                                <td colspan="7" class="text-center py-5">
                                    <i class="bi bi-inbox fs-1 text-muted"></i>
                                    <h3 class="h6 fw-bold mt-3">No se encontraron registros de asistencia</h3>
                                    <p class="text-muted mb-0">Intenta con otro criterio de búsqueda.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mt-4">
                <div class="text-muted small">
                    Mostrando {{ $attendanceRecords->count() }} registro(s) de {{ $attendanceRecords->total() }} asistencia(s).
                </div>

                <div>
                    {{ $attendanceRecords->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection