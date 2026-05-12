@extends('layouts.admin')

@section('page-title', 'Editar sección')
@section('page-subtitle', 'Actualizar información registrada de la sección académica')

@section('content')
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="h5 fw-bold mb-1">Editar sección</h2>
                    <p class="text-muted mb-0">Modifique los datos necesarios de la sección.</p>
                </div>

                <a href="{{ route('sections.index') }}" class="btn btn-outline-secondary rounded-pill">
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

            <form method="POST" action="{{ route('sections.update', $section) }}">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-12 col-md-4">
                        <label for="grade_id" class="form-label fw-semibold">Grado</label>
                        <select
                            id="grade_id"
                            name="grade_id"
                            class="form-select rounded-pill @error('grade_id') is-invalid @enderror"
                            required
                        >
                            <option value="">Seleccione un grado</option>
                            @foreach ($grades as $grade)
                                <option value="{{ $grade->id }}" @selected(old('grade_id', $section->grade_id) == $grade->id)>
                                    {{ $grade->name }} - {{ $grade->level }}
                                </option>
                            @endforeach
                        </select>
                        @error('grade_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-4">
                        <label for="name" class="form-label fw-semibold">Nombre de sección</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', $section->name) }}"
                            class="form-control rounded-pill @error('name') is-invalid @enderror"
                            required
                        >
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-4">
                        <label for="capacity" class="form-label fw-semibold">Capacidad</label>
                        <input
                            type="number"
                            id="capacity"
                            name="capacity"
                            value="{{ old('capacity', $section->capacity) }}"
                            class="form-control rounded-pill @error('capacity') is-invalid @enderror"
                            min="1"
                            max="100"
                            required
                        >
                        @error('capacity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input
                                type="checkbox"
                                id="is_active"
                                name="is_active"
                                value="1"
                                class="form-check-input"
                                @checked(old('is_active', $section->is_active))
                            >
                            <label for="is_active" class="form-check-label fw-semibold">
                                Sección activa
                            </label>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('sections.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        Cancelar
                    </a>

                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-save me-1"></i>
                        Guardar cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection