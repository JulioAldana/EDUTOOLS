@extends('layouts.admin')

@section('page-title', 'Registrar curso')
@section('page-subtitle', 'Formulario para agregar un nuevo curso académico')

@section('content')
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="h5 fw-bold mb-1">Nuevo curso</h2>
                    <p class="text-muted mb-0">
                        Complete los datos principales del curso.
                    </p>
                </div>

                <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary rounded-pill">
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

            <form method="POST" action="{{ route('courses.store') }}">
                @csrf

                <div class="row g-3">
                    <div class="col-12 col-md-4">
                        <label for="code" class="form-label fw-semibold">Código del curso</label>
                        <input
                            type="text"
                            id="code"
                            name="code"
                            value="{{ old('code') }}"
                            class="form-control rounded-pill @error('code') is-invalid @enderror"
                            placeholder="Ejemplo: MAT-001"
                            required
                        >
                        @error('code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-8">
                        <label for="name" class="form-label fw-semibold">Nombre del curso</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            class="form-control rounded-pill @error('name') is-invalid @enderror"
                            placeholder="Ejemplo: Matemática"
                            required
                        >
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

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
                                <option value="{{ $grade->id }}" @selected(old('grade_id') == $grade->id)>
                                    {{ $grade->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('grade_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-4">
                        <label for="teacher_id" class="form-label fw-semibold">Docente asignado</label>
                        <select
                            id="teacher_id"
                            name="teacher_id"
                            class="form-select rounded-pill @error('teacher_id') is-invalid @enderror"
                        >
                            <option value="">Sin docente asignado</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}" @selected(old('teacher_id') == $teacher->id)>
                                    {{ $teacher->first_name }} {{ $teacher->last_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('teacher_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-4">
                        <label for="weekly_hours" class="form-label fw-semibold">Horas semanales</label>
                        <input
                            type="number"
                            id="weekly_hours"
                            name="weekly_hours"
                            value="{{ old('weekly_hours', 5) }}"
                            class="form-control rounded-pill @error('weekly_hours') is-invalid @enderror"
                            min="1"
                            max="40"
                            required
                        >
                        @error('weekly_hours')
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
                            placeholder="Descripción breve del curso"
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
                                Curso activo
                            </label>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        Cancelar
                    </a>

                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-save me-1"></i>
                        Guardar curso
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection