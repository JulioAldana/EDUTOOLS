@extends('layouts.admin')

@section('page-title', 'Calendario académico')
@section('page-subtitle', 'Consulta y administración de eventos académicos institucionales')

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
                    <h2 class="h5 fw-bold mb-1">Eventos académicos registrados</h2>
                    <p class="text-muted mb-0">
                        Listado general de actividades, reuniones, evaluaciones y eventos institucionales.
                    </p>
                </div>

                <a href="{{ route('academic-calendar-events.create') }}" class="btn btn-primary rounded-pill px-4">
                    <i class="bi bi-plus-circle me-1"></i>
                    Nuevo evento
                </a>
            </div>

            <form method="GET" action="{{ route('academic-calendar-events.index') }}" class="mb-4">
                <div class="row g-2">
                    <div class="col-12 col-md-9">
                        <input
                            type="text"
                            name="search"
                            value="{{ $search }}"
                            class="form-control form-control-lg rounded-pill"
                            placeholder="Buscar por título, descripción, tipo o fecha"
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
                            <th>Evento</th>
                            <th>Fecha</th>
                            <th>Horario</th>
                            <th>Tipo</th>
                            <th>Estado</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($events as $event)
                            <tr>
                                <td>
                                    <div class="fw-semibold">{{ $event->title }}</div>
                                    <div class="small text-muted">
                                        {{ $event->description ? \Illuminate\Support\Str::limit($event->description, 80) : 'Sin descripción registrada' }}
                                    </div>
                                </td>

                                <td>{{ \Carbon\Carbon::parse($event->event_date)->format('d/m/Y') }}</td>

                                <td>
                                    @if ($event->start_time && $event->end_time)
                                        {{ substr($event->start_time, 0, 5) }} - {{ substr($event->end_time, 0, 5) }}
                                    @elseif ($event->start_time)
                                        Desde {{ substr($event->start_time, 0, 5) }}
                                    @else
                                        Sin horario
                                    @endif
                                </td>

                                <td>{{ $event->event_type }}</td>

                                <td>
                                    @if ($event->is_active)
                                        <span class="badge rounded-pill text-bg-success">Activo</span>
                                    @else
                                        <span class="badge rounded-pill text-bg-secondary">Inactivo</span>
                                    @endif
                                </td>

                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-1">
                                        <a href="{{ route('academic-calendar-events.show', $event) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                                            Ver
                                        </a>

                                        <a href="{{ route('academic-calendar-events.edit', $event) }}" class="btn btn-sm btn-outline-warning rounded-pill">
                                            Editar
                                        </a>

                                        @if ($event->is_active)
                                            <form method="POST" action="{{ route('academic-calendar-events.destroy', $event) }}" onsubmit="return confirm('¿Seguro que desea inactivar este evento?');">
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
                                <td colspan="6" class="text-center py-5">
                                    <i class="bi bi-inbox fs-1 text-muted"></i>
                                    <h3 class="h6 fw-bold mt-3">No se encontraron eventos académicos</h3>
                                    <p class="text-muted mb-0">Intenta con otro criterio de búsqueda.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mt-4">
                <div class="text-muted small">
                    Mostrando {{ $events->count() }} evento(s) de {{ $events->total() }} registro(s).
                </div>

                <div>
                    {{ $events->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection