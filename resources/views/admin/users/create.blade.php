@extends('layouts.admin')

@section('page-title', 'Registrar usuario')
@section('page-subtitle', 'Formulario para crear una nueva cuenta de acceso')

@section('content')
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="h5 fw-bold mb-1">Nuevo usuario</h2>
                    <p class="text-muted mb-0">Complete los datos de acceso y rol del usuario.</p>
                </div>

                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary rounded-pill">
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

            <form method="POST" action="{{ route('users.store') }}">
                @csrf

                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label for="name" class="form-label fw-semibold">Nombre completo</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            class="form-control rounded-pill @error('name') is-invalid @enderror"
                            required
                        >
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="email" class="form-label fw-semibold">Correo electrónico</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="form-control rounded-pill @error('email') is-invalid @enderror"
                            required
                        >
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="password" class="form-label fw-semibold">Contraseña</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control rounded-pill @error('password') is-invalid @enderror"
                            required
                        >
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="password_confirmation" class="form-label fw-semibold">Confirmar contraseña</label>
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            class="form-control rounded-pill"
                            required
                        >
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="role" class="form-label fw-semibold">Rol</label>
                        <select id="role" name="role" class="form-select rounded-pill @error('role') is-invalid @enderror" required>
                            <option value="">Seleccione un rol</option>
                            <option value="admin" @selected(old('role') === 'admin')>Administrador</option>
                            <option value="docente" @selected(old('role') === 'docente')>Docente</option>
                            <option value="tutor" @selected(old('role') === 'tutor')>Padre/Tutor</option>
                            <option value="pendiente" @selected(old('role', 'pendiente') === 'pendiente')>Pendiente</option>
                        </select>
                        @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 col-md-6 d-flex align-items-end">
                        <div class="form-check form-switch mb-2">
                            <input
                                type="checkbox"
                                id="is_active"
                                name="is_active"
                                value="1"
                                class="form-check-input"
                                @checked(old('is_active', true))
                            >
                            <label for="is_active" class="form-check-label fw-semibold">
                                Usuario activo
                            </label>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Cancelar</a>

                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-save me-1"></i>
                        Guardar usuario
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection