@extends('layouts.admin')

@section('page-title', 'Registrar asistencia')
@section('page-subtitle', 'Formulario para agregar un registro de asistencia')

@section('content')
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="h5 fw-bold mb-1">Nueva asistencia</h2>
                    <p class="text-muted mb-0">Complete los datos de asistencia del estudiante.</p>
                </div>

                <a href="{{ route('attendance-records.index') }}" class="btn btn-outline-secondary rounded-pill">
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

            <form method="POST" action="{{ route('attendance-records.store') }}">
                @csrf

                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label for="student_id" class="form-label fw-semibold">Alumno</label>
                        <select id="student_id" name="student_id" class="form-select rounded-pill @error('student_id') is-invalid @enderror" required>
                            <option value="">Seleccione un alumno</option>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}" @selected(old('student_id') == $student->id)>
                                    {{ $student->student_code }} - {{ $student->first_name }} {{ $student->last_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('student_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="course_id" class="form-label fw-semibold">Curso</label>
                        <select id="course_id" name="course_id" class="form-select rounded-pill @error('course_id') is-invalid @enderror" required>
                            <option value="">Seleccione un curso</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}" @selected(old('course_id') == $course->id)>
                                    {{ $course->code }} - {{ $course->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('course_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="teacher_id" class="form-label fw-semibold">Docente</label>
                        <select id="teacher_id" name="teacher_id" class="form-select rounded-pill @error('teacher_id') is-invalid @enderror">
                            <option value="">Sin docente asignado</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}" @selected(old('teacher_id') == $teacher->id)>
                                    {{ $teacher->teacher_code }} - {{ $teacher->first_name }} {{ $teacher->last_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('teacher_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="attendance_date" class="form-label fw-semibold">Fecha de asistencia</label>
                        <input
                            type="date"
                            id="attendance_date"
                            name="attendance_date"
                            value="{{ old('attendance_date', date('Y-m-d')) }}"
                            class="form-control rounded-pill @error('attendance_date') is-invalid @enderror"
                            required
                        >
                        @error('attendance_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12">
                        <label for="status" class="form-label fw-semibold">Estado</label>
                        <select id="status" name="status" class="form-select rounded-pill @error('status') is-invalid @enderror" required>
                            <option value="presente" @selected(old('status', 'presente') === 'presente')>Presente</option>
                            <option value="ausente" @selected(old('status') === 'ausente')>Ausente</option>
                            <option value="tarde" @selected(old('status') === 'tarde')>Tarde</option>
                            <option value="justificado" @selected(old('status') === 'justificado')>Justificado</option>
                            <option value="anulado" @selected(old('status') === 'anulado')>Anulado</option>
                        </select>
                        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12">
                        <label for="comments" class="form-label fw-semibold">Comentarios</label>
                        <textarea
                            id="comments"
                            name="comments"
                            rows="4"
                            class="form-control rounded-4 @error('comments') is-invalid @enderror"
                            placeholder="Observaciones opcionales"
                        >{{ old('comments') }}</textarea>
                        @error('comments') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('attendance-records.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Cancelar</a>

                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-save me-1"></i>
                        Guardar asistencia
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection