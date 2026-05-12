@extends('layouts.admin')

@section('page-title', 'Registrar docente')
@section('page-subtitle', 'Formulario para agregar un nuevo catedrático al sistema EDUTOOLS')

@section('content')
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="h5 fw-bold mb-1">Nuevo docente</h2>
                    <p class="text-muted mb-0">
                        Complete los datos principales del docente.
                    </p>
                </div>

                <a href="{{ route('teachers.index') }}" class="btn btn-outline-secondary rounded-pill">
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

            <form method="POST" action="{{ route('teachers.store') }}">
                @csrf

                <div class="row g-3">
                    <div class="col-12 col-md-4">
                        <label for="teacher_code" class="form-label fw-semibold">Código del docente</label>
                        <input
                            type="text"
                            id="teacher_code"
                            name="teacher_code"
                            value="{{ old('teacher_code') }}"
                            class="form-control rounded-pill @error('teacher_code') is-invalid @enderror"
                            placeholder="Ejemplo: DOC-2026-001"
                            required
                        >
                        @error('teacher_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-4">
                        <label for="first_name" class="form-label fw-semibold">Nombres</label>
                        <input
                            type="text"
                            id="first_name"
                            name="first_name"
                            value="{{ old('first_name') }}"
                            class="form-control rounded-pill @error('first_name') is-invalid @enderror"
                            placeholder="Ejemplo: Carlos Alberto"
                            required
                        >
                        @error('first_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-4">
                        <label for="last_name" class="form-label fw-semibold">Apellidos</label>
                        <input
                            type="text"
                            id="last_name"
                            name="last_name"
                            value="{{ old('last_name') }}"
                            class="form-control rounded-pill @error('last_name') is-invalid @enderror"
                            placeholder="Ejemplo: Méndez López"
                            required
                        >
                        @error('last_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-4">
                        <label for="dpi" class="form-label fw-semibold">DPI</label>
                        <input
                            type="text"
                            id="dpi"
                            name="dpi"
                            value="{{ old('dpi') }}"
                            class="form-control rounded-pill @error('dpi') is-invalid @enderror"
                            placeholder="Ejemplo: 1234567890101"
                        >
                        @error('dpi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-4">
                        <label for="phone" class="form-label fw-semibold">Teléfono</label>
                        <input
                            type="text"
                            id="phone"
                            name="phone"
                            value="{{ old('phone') }}"
                            class="form-control rounded-pill @error('phone') is-invalid @enderror"
                            placeholder="Ejemplo: 5555-1234"
                        >
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-4">
                        <label for="email" class="form-label fw-semibold">Correo electrónico</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="form-control rounded-pill @error('email') is-invalid @enderror"
                            placeholder="docente@edutools.test"
                        >
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="specialty" class="form-label fw-semibold">Especialidad</label>
                        <input
                            type="text"
                            id="specialty"
                            name="specialty"
                            value="{{ old('specialty') }}"
                            class="form-control rounded-pill @error('specialty') is-invalid @enderror"
                            placeholder="Ejemplo: Matemática"
                        >
                        @error('specialty')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="hire_date" class="form-label fw-semibold">Fecha de contratación</label>
                        <input
                            type="date"
                            id="hire_date"
                            name="hire_date"
                            value="{{ old('hire_date') }}"
                            class="form-control rounded-pill @error('hire_date') is-invalid @enderror"
                        >
                        @error('hire_date')
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
                                Docente activo
                            </label>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('teachers.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        Cancelar
                    </a>

                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-save me-1"></i>
                        Guardar docente
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection