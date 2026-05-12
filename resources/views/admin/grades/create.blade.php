@extends('layouts.admin')

@section('page-title', 'Registrar grado')
@section('page-subtitle', 'Formulario para agregar un nuevo grado académico')

@section('content')
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="h5 fw-bold mb-1">Nuevo grado</h2>
                    <p class="text-muted mb-0">Complete los datos principales del grado.</p>
                </div>

                <a href="{{ route('grades.index') }}" class="btn btn-outline-secondary rounded-pill">
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

            <form method="POST" action="{{ route('grades.store') }}">
                @csrf

                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label for="name" class="form-label fw-semibold">Nombre del grado</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            class="form-control rounded-pill @error('name') is-invalid @enderror"
                            placeholder="Ejemplo: Primero Básico"
                            required
                        >
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="level" class="form-label fw-semibold">Nivel académico</label>
                        <input
                            type="text"
                            id="level"
                            name="level"
                            value="{{ old('level') }}"
                            class="form-control rounded-pill @error('level') is-invalid @enderror"
                            placeholder="Ejemplo: Básico"
                            required
                        >
                        @error('level')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="description" class="form-label fw-semibold">Descripción</label>
                        <textarea
                            id="description"
                            name="description"
                            rows="4"
                            class="form-control rounded-4 @error('description') is-invalid @enderror"
                            placeholder="Descripción breve del grado"
                        >{{ old('description') }}</textarea>
                        @error('description')
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
                                @checked(old('is_active', true))
                            >
                            <label for="is_active" class="form-check-label fw-semibold">
                                Grado activo
                            </label>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('grades.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        Cancelar
                    </a>

                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-save me-1"></i>
                        Guardar grado
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection