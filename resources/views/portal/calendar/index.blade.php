@extends('layouts.admin')

@section('page-title', 'Calendario académico')
@section('page-subtitle', 'Eventos académicos visibles para padres de familia')

@section('content')
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="h5 fw-bold mb-1">Eventos académicos</h2>
                    <p class="text-muted mb-0">
                        Actividades, reuniones, evaluaciones y eventos institucionales.
                    </p>
                </div>

                <a href="{{ route('portal.dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="bi bi-arrow-left me-1"></i>
                    Volver
                </a>
            </div>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr class="text-muted">
                            <th>Evento</th>
                            <th>Fecha</th>
                            <th>Horario</th>
                            <th>Tipo</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($events as $event)
                            <tr>
                                <td>
                                    <div class="fw-semibold">{{ $event->title }}</div>
                                    <div class="small text-muted">
                                        {{ $event->description ?? 'Sin descripción registrada' }}
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
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-muted">No hay eventos académicos disponibles.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $events->links() }}
            </div>
        </div>
    </div>
@endsection