@extends('layouts.admin')

@section('page-title', 'Editar alumno')
@section('page-subtitle', 'Actualizar información registrada del estudiante')

@section('content')
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="h5 fw-bold mb-1">Editar alumno</h2>
                    <p class="text-muted mb-0">
                        Modifique los datos necesarios del estudiante.
                    </p>
                </div>

                <a href="{{ route('students.index') }}" class="btn btn-outline-secondary rounded-pill">
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

            <form method="POST" action="{{ route('students.update', $student) }}">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-12 col-md-4">
                        <label for="student_code" class="form-label fw-semibold">Código del alumno</label>
                        <input
                            type="text"
                            id="student_code"
                            name="student_code"
                            value="{{ old('student_code', $student->student_code) }}"
                            class="form-control rounded-pill @error('student_code') is-invalid @enderror"
                            required
                        >
                        @error('student_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-4">
                        <label for="first_name" class="form-label fw-semibold">Nombres</label>
                        <input
                            type="text"
                            id="first_name"
                            name="first_name"
                            value="{{ old('first_name', $student->first_name) }}"
                            class="form-control rounded-pill @error('first_name') is-invalid @enderror"
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
                            value="{{ old('last_name', $student->last_name) }}"
                            class="form-control rounded-pill @error('last_name') is-invalid @enderror"
                            required
                        >
                        @error('last_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-4">
                        <label for="birth_date" class="form-label fw-semibold">Fecha de nacimiento</label>
                        <input
                            type="date"
                            id="birth_date"
                            name="birth_date"
                            value="{{ old('birth_date', $student->birth_date) }}"
                            class="form-control rounded-pill @error('birth_date') is-invalid @enderror"
                        >
                        @error('birth_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-4">
                        <label for="gender" class="form-label fw-semibold">Género</label>
                        <select
                            id="gender"
                            name="gender"
                            class="form-select rounded-pill @error('gender') is-invalid @enderror"
                        >
                            <option value="">Seleccione una opción</option>
                            <option value="Masculino" @selected(old('gender', $student->gender) === 'Masculino')>Masculino</option>
                            <option value="Femenino" @selected(old('gender', $student->gender) === 'Femenino')>Femenino</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-4">
                        <label for="phone" class="form-label fw-semibold">Teléfono</label>
                        <input
                            type="text"
                            id="phone"
                            name="phone"
                            value="{{ old('phone', $student->phone) }}"
                            class="form-control rounded-pill @error('phone') is-invalid @enderror"
                        >
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="address" class="form-label fw-semibold">Dirección</label>
                        <input
                            type="text"
                            id="address"
                            name="address"
                            value="{{ old('address', $student->address) }}"
                            class="form-control rounded-pill @error('address') is-invalid @enderror"
                        >
                        @error('address')
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
                                @checked(old('is_active', $student->is_active))
                            >
                            <label for="is_active" class="form-check-label fw-semibold">
                                Alumno activo
                            </label>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('students.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
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