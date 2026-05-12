@extends('layouts.admin')

@section('page-title', 'Editar nota')
@section('page-subtitle', 'Actualizar información de la calificación académica')

@section('content')
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="h5 fw-bold mb-1">Editar nota</h2>
                    <p class="text-muted mb-0">Complete los datos de la calificación del estudiante.</p>
                </div>

                <a href="{{ route('grade-records.index') }}" class="btn btn-outline-secondary rounded-pill">
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

            <form method="POST" action="{{ route('grade-records.update', $gradeRecord) }}">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label for="student_id" class="form-label fw-semibold">Alumno</label>
                        <select id="student_id" name="student_id" class="form-select rounded-pill @error('student_id') is-invalid @enderror" required>
                            <option value="">Seleccione un alumno</option>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}" @selected(old('student_id', $gradeRecord->student_id) == $student->id)>
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
                                <option value="{{ $course->id }}" @selected(old('course_id', $gradeRecord->course_id) == $course->id)>
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
                                <option value="{{ $teacher->id }}" @selected(old('teacher_id', $gradeRecord->teacher_id) == $teacher->id)>
                                    {{ $teacher->teacher_code }} - {{ $teacher->first_name }} {{ $teacher->last_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('teacher_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="academic_year" class="form-label fw-semibold">Ciclo escolar</label>
                        <input
                            type="number"
                            id="academic_year"
                            name="academic_year"
                            value="{{ old('academic_year', $gradeRecord->academic_year) }}"
                            class="form-control rounded-pill @error('academic_year') is-invalid @enderror"
                            min="2020"
                            max="2100"
                            required
                        >
                        @error('academic_year') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 col-md-4">
                        <label for="term" class="form-label fw-semibold">Período</label>
                        <select id="term" name="term" class="form-select rounded-pill @error('term') is-invalid @enderror" required>
                            <option value="">Seleccione un período</option>
                            <option value="Primer Bimestre" @selected(old('term', $gradeRecord->term) === 'Primer Bimestre')>Primer Bimestre</option>
                            <option value="Segundo Bimestre" @selected(old('term', $gradeRecord->term) === 'Segundo Bimestre')>Segundo Bimestre</option>
                            <option value="Tercer Bimestre" @selected(old('term', $gradeRecord->term) === 'Tercer Bimestre')>Tercer Bimestre</option>
                            <option value="Cuarto Bimestre" @selected(old('term', $gradeRecord->term) === 'Cuarto Bimestre')>Cuarto Bimestre</option>
                            <option value="Final" @selected(old('term', $gradeRecord->term) === 'Final')>Final</option>
                        </select>
                        @error('term') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 col-md-4">
                        <label for="evaluation_type" class="form-label fw-semibold">Tipo de evaluación</label>
                        <select id="evaluation_type" name="evaluation_type" class="form-select rounded-pill @error('evaluation_type') is-invalid @enderror" required>
                            <option value="Actividad" @selected(old('evaluation_type', $gradeRecord->evaluation_type) === 'Actividad')>Actividad</option>
                            <option value="Tarea" @selected(old('evaluation_type', $gradeRecord->evaluation_type) === 'Tarea')>Tarea</option>
                            <option value="Examen corto" @selected(old('evaluation_type', $gradeRecord->evaluation_type) === 'Examen corto')>Examen corto</option>
                            <option value="Proyecto" @selected(old('evaluation_type', $gradeRecord->evaluation_type) === 'Proyecto')>Proyecto</option>
                            <option value="Examen final" @selected(old('evaluation_type', $gradeRecord->evaluation_type) === 'Examen final')>Examen final</option>
                        </select>
                        @error('evaluation_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 col-md-4">
                        <label for="status" class="form-label fw-semibold">Estado</label>
                        <select id="status" name="status" class="form-select rounded-pill @error('status') is-invalid @enderror" required>
                            <option value="activo" @selected(old('status', $gradeRecord->status) === 'activo')>Activo</option>
                            <option value="anulado" @selected(old('status', $gradeRecord->status) === 'anulado')>Anulado</option>
                        </select>
                        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="score" class="form-label fw-semibold">Nota obtenida</label>
                        <input
                            type="number"
                            step="0.01"
                            id="score"
                            name="score"
                            value="{{ old('score', $gradeRecord->score) }}"
                            class="form-control rounded-pill @error('score') is-invalid @enderror"
                            min="0"
                            required
                        >
                        @error('score') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="max_score" class="form-label fw-semibold">Nota máxima</label>
                        <input
                            type="number"
                            step="0.01"
                            id="max_score"
                            name="max_score"
                            value="{{ old('max_score', $gradeRecord->max_score) }}"
                            class="form-control rounded-pill @error('max_score') is-invalid @enderror"
                            min="1"
                            required
                        >
                        @error('max_score') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12">
                        <label for="comments" class="form-label fw-semibold">Comentarios</label>
                        <textarea
                            id="comments"
                            name="comments"
                            rows="4"
                            class="form-control rounded-4 @error('comments') is-invalid @enderror"
                            placeholder="Observaciones académicas opcionales"
                        >{{ old('comments', $gradeRecord->comments) }}</textarea>
                        @error('comments') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('grade-records.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Cancelar</a>

                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-save me-1"></i>
                        Guardar cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection