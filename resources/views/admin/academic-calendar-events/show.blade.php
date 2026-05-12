@extends('layouts.admin')

@section('page-title', 'Detalle del evento académico')
@section('page-subtitle', 'Información registrada del calendario académico')

@section('content')
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
                <div>
                    <h2 class="h5 fw-bold mb-1">{{ $event->title }}</h2>
                    <p class="text-muted mb-0">
                        {{ \Carbon\Carbon::parse($event->event_date)->format('d/m/Y') }}
                    </p>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('academic-calendar-events.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="bi bi-arrow-left me-1"></i>
                        Volver
                    </a>

                    <a href="{{ route('academic-calendar-events.edit', $event) }}" class="btn btn-outline-warning rounded-pill px-4">
                        <i class="bi bi-pencil-square me-1"></i>
                        Editar
                    </a>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-12 col-md-8">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Título</div>
                        <div class="fw-semibold">{{ $event->title }}</div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Tipo</div>
                        <div class="fw-semibold">{{ $event->event_type }}</div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Fecha</div>
                        <div class="fw-semibold">{{ \Carbon\Carbon::parse($event->event_date)->format('d/m/Y') }}</div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Hora de inicio</div>
                        <div class="fw-semibold">{{ $event->start_time ? substr($event->start_time, 0, 5) : 'Sin hora registrada' }}</div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Hora de finalización</div>
                        <div class="fw-semibold">{{ $event->end_time ? substr($event->end_time, 0, 5) : 'Sin hora registrada' }}</div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Estado</div>
                        <div>
                            @if ($event->is_active)
                                <span class="badge rounded-pill text-bg-success">Activo</span>
                            @else
                                <span class="badge rounded-pill text-bg-secondary">Inactivo</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Descripción</div>
                        <div class="fw-semibold">{{ $event->description ?? 'Sin descripción registrada' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection