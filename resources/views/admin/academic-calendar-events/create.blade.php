@extends('layouts.admin')

@section('page-title', 'Registrar evento académico')
@section('page-subtitle', 'Formulario para agregar una actividad al calendario académico')

@section('content')
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="h5 fw-bold mb-1">Nuevo evento</h2>
                    <p class="text-muted mb-0">Complete los datos principales del evento académico.</p>
                </div>

                <a href="{{ route('academic-calendar-events.index') }}" class="btn btn-outline-secondary rounded-pill">
                    <i class="bi bi-arrow-left me-1"></i>
                    Volver
                </a>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger rounded-4">
                    <strong>Revise los datos ingresados.</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('academic-calendar-events.store') }}">
                @csrf

                <div class="row g-3">
                    <div class="col-12 col-md-8">
                        <label for="title" class="form-label fw-semibold">Título del evento</label>
                        <input
                            type="text"
                            id="title"
                            name="title"
                            value="{{ old('title') }}"
                            class="form-control rounded-pill @error('title') is-invalid @enderror"
                            placeholder="Ejemplo: Reunión de padres de familia"
                            required
                        >
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 col-md-4">
                        <label for="event_type" class="form-label fw-semibold">Tipo de evento</label>
                        <select id="event_type" name="event_type" class="form-select rounded-pill @error('event_type') is-invalid @enderror" required>
                            <option value="">Seleccione un tipo</option>
                            <option value="Académico" @selected(old('event_type') === 'Académico')>Académico</option>
                            <option value="Evaluación" @selected(old('event_type') === 'Evaluación')>Evaluación</option>
                            <option value="Reunión" @selected(old('event_type') === 'Reunión')>Reunión</option>
                            <option value="Feriado" @selected(old('event_type') === 'Feriado')>Feriado</option>
                            <option value="Actividad especial" @selected(old('event_type') === 'Actividad especial')>Actividad especial</option>
                        </select>
                        @error('event_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 col-md-4">
                        <label for="event_date" class="form-label fw-semibold">Fecha del evento</label>
                        <input
                            type="date"
                            id="event_date"
                            name="event_date"
                            value="{{ old('event_date', date('Y-m-d')) }}"
                            class="form-control rounded-pill @error('event_date') is-invalid @enderror"
                            required
                        >
                        @error('event_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 col-md-4">
                        <label for="start_time" class="form-label fw-semibold">Hora de inicio</label>
                        <input
                            type="time"
                            id="start_time"
                            name="start_time"
                            value="{{ old('start_time') }}"
                            class="form-control rounded-pill @error('start_time') is-invalid @enderror"
                        >
                        @error('start_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 col-md-4">
                        <label for="end_time" class="form-label fw-semibold">Hora de finalización</label>
                        <input
                            type="time"
                            id="end_time"
                            name="end_time"
                            value="{{ old('end_time') }}"
                            class="form-control rounded-pill @error('end_time') is-invalid @enderror"
                        >
                        @error('end_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12">
                        <label for="description" class="form-label fw-semibold">Descripción</label>
                        <textarea
                            id="description"
                            name="description"
                            rows="4"
                            class="form-control rounded-4 @error('description') is-invalid @enderror"
                            placeholder="Descripción breve del evento"
                        >{{ old('description') }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input
                                type="checkbox"
                                id="is_active"
                                name="is_active"
                                value="1"
                                class="form-check-input"
                                @checked(old('is_active', true))
                            >
                            <label for="is_active" class="form-check-label fw-semibold">
                                Evento activo
                            </label>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('academic-calendar-events.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Cancelar</a>

                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-save me-1"></i>
                        Guardar evento
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection