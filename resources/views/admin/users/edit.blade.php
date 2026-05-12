@extends('layouts.admin')

@section('page-title', 'Editar usuario')
@section('page-subtitle', 'Actualizar información de acceso, rol y estado')

@section('content')
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="h5 fw-bold mb-1">Editar usuario</h2>
                    <p class="text-muted mb-0">
                        Si no desea cambiar la contraseña, deje los campos de contraseña vacíos.
                    </p>
                </div>

                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary rounded-pill">
                    <i class="bi bi-arrow-left me-1"></i>
                    Volver
                </a>
            </div>

            @if ($user->id === auth()->id())
                <div class="alert alert-info rounded-4">
                    Está editando su propio usuario. El sistema mantendrá su rol como administrador y su cuenta activa.
                </div>
            @endif

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

            <form method="POST" action="{{ route('users.update', $user) }}">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label for="name" class="form-label fw-semibold">Nombre completo</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', $user->name) }}"
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
                            value="{{ old('email', $user->email) }}"
                            class="form-control rounded-pill @error('email') is-invalid @enderror"
                            required
                        >
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="password" class="form-label fw-semibold">Nueva contraseña</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control rounded-pill @error('password') is-invalid @enderror"
                            placeholder="Opcional"
                        >
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="password_confirmation" class="form-label fw-semibold">Confirmar nueva contraseña</label>
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            class="form-control rounded-pill"
                            placeholder="Opcional"
                        >
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="role" class="form-label fw-semibold">Rol</label>
                        <select
                            id="role"
                            name="role"
                            class="form-select rounded-pill @error('role') is-invalid @enderror"
                            required
                            @disabled($user->id === auth()->id())
                        >
                            <option value="admin" @selected(old('role', $user->role) === 'admin')>Administrador</option>
                            <option value="docente" @selected(old('role', $user->role) === 'docente')>Docente</option>
                            <option value="tutor" @selected(old('role', $user->role) === 'tutor')>Padre/Tutor</option>
                            <option value="pendiente" @selected(old('role', $user->role) === 'pendiente')>Pendiente</option>
                        </select>

                        @if ($user->id === auth()->id())
                            <input type="hidden" name="role" value="admin">
                        @endif

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
                                @checked(old('is_active', $user->is_active))
                                @disabled($user->id === auth()->id())
                            >
                            <label for="is_active" class="form-check-label fw-semibold">
                                Usuario activo
                            </label>

                            @if ($user->id === auth()->id())
                                <input type="hidden" name="is_active" value="1">
                            @endif
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Cancelar</a>

                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-save me-1"></i>
                        Guardar cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection