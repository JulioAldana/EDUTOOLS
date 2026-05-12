@extends('layouts.admin')

@section('page-title', 'Editar inscripción')
@section('page-subtitle', 'Actualizar información de inscripción académica')

@section('content')
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="h5 fw-bold mb-1">Editar inscripción</h2>
                    <p class="text-muted mb-0">Modifique los datos necesarios de la inscripción.</p>
                </div>

                <a href="{{ route('enrollments.index') }}" class="btn btn-outline-secondary rounded-pill">
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

            <form method="POST" action="{{ route('enrollments.update', $enrollment) }}">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label for="student_id" class="form-label fw-semibold">Alumno</label>
                        <select id="student_id" name="student_id" class="form-select rounded-pill @error('student_id') is-invalid @enderror" required>
                            <option value="">Seleccione un alumno</option>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}" @selected(old('student_id', $enrollment->student_id) == $student->id)>
                                    {{ $student->student_code }} - {{ $student->first_name }} {{ $student->last_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('student_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="academic_year" class="form-label fw-semibold">Ciclo escolar</label>
                        <input
                            type="number"
                            id="academic_year"
                            name="academic_year"
                            value="{{ old('academic_year', $enrollment->academic_year) }}"
                            class="form-control rounded-pill @error('academic_year') is-invalid @enderror"
                            min="2020"
                            max="2100"
                            required
                        >
                        @error('academic_year') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="grade_id" class="form-label fw-semibold">Grado</label>
                        <select id="grade_id" name="grade_id" class="form-select rounded-pill @error('grade_id') is-invalid @enderror" required>
                            <option value="">Seleccione un grado</option>
                            @foreach ($grades as $grade)
                                <option value="{{ $grade->id }}" @selected(old('grade_id', $enrollment->grade_id) == $grade->id)>
                                    {{ $grade->name }} - {{ $grade->level }}
                                </option>
                            @endforeach
                        </select>
                        @error('grade_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="section_id" class="form-label fw-semibold">Sección</label>
                        <select id="section_id" name="section_id" class="form-select rounded-pill @error('section_id') is-invalid @enderror" required>
                            <option value="">Seleccione una sección</option>
                            @foreach ($sections as $section)
                                <option value="{{ $section->id }}" @selected(old('section_id', $enrollment->section_id) == $section->id)>
                                    {{ $section->name }} - {{ $section->grade->name ?? 'Sin grado' }}
                                </option>
                            @endforeach
                        </select>
                        @error('section_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="enrollment_date" class="form-label fw-semibold">Fecha de inscripción</label>
                        <input
                            type="date"
                            id="enrollment_date"
                            name="enrollment_date"
                            value="{{ old('enrollment_date', $enrollment->enrollment_date) }}"
                            class="form-control rounded-pill @error('enrollment_date') is-invalid @enderror"
                            required
                        >
                        @error('enrollment_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="status" class="form-label fw-semibold">Estado</label>
                        <select id="status" name="status" class="form-select rounded-pill @error('status') is-invalid @enderror" required>
                            <option value="activo" @selected(old('status', $enrollment->status) === 'activo')>Activo</option>
                            <option value="inactivo" @selected(old('status', $enrollment->status) === 'inactivo')>Inactivo</option>
                            <option value="retirado" @selected(old('status', $enrollment->status) === 'retirado')>Retirado</option>
                            <option value="finalizado" @selected(old('status', $enrollment->status) === 'finalizado')>Finalizado</option>
                        </select>
                        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('enrollments.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Cancelar</a>

                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-save me-1"></i>
                        Guardar cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection