
@extends('layouts.admin')

@section('page-title', 'Registrar tutor')
@section('page-subtitle', 'Formulario para agregar un padre, madre o responsable')

@section('content')
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="h5 fw-bold mb-1">Nuevo tutor</h2>
                    <p class="text-muted mb-0">
                        Complete los datos del responsable y vincúlelo con uno o más alumnos.
                    </p>
                </div>

                <a href="{{ route('guardians.index') }}" class="btn btn-outline-secondary rounded-pill">
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

            <form method="POST" action="{{ route('guardians.store') }}">
                @csrf

                <div class="row g-3">
                    <div class="col-12">
                        <label for="user_id" class="form-label fw-semibold">Usuario vinculado</label>
                        <select id="user_id" name="user_id" class="form-select rounded-pill @error('user_id') is-invalid @enderror">
                            <option value="">Sin usuario vinculado</option>

                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" @selected(old('user_id') == $user->id)>
                                    {{ $user->name }} - {{ $user->email }}
                                </option>
                            @endforeach
                        </select>

                        <div class="form-text">
                            Solo aparecen usuarios activos con rol Padre/Tutor que aún no están vinculados.
                        </div>

                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="first_name" class="form-label fw-semibold">Nombres</label>
                        <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" class="form-control rounded-pill @error('first_name') is-invalid @enderror" required>
                        @error('first_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="last_name" class="form-label fw-semibold">Apellidos</label>
                        <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" class="form-control rounded-pill @error('last_name') is-invalid @enderror" required>
                        @error('last_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 col-md-4">
                        <label for="dpi" class="form-label fw-semibold">DPI</label>
                        <input type="text" id="dpi" name="dpi" value="{{ old('dpi') }}" class="form-control rounded-pill @error('dpi') is-invalid @enderror" placeholder="Opcional">
                        @error('dpi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 col-md-4">
                        <label for="phone" class="form-label fw-semibold">Teléfono</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="form-control rounded-pill @error('phone') is-invalid @enderror" required>
                        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 col-md-4">
                        <label for="relationship" class="form-label fw-semibold">Parentesco</label>
                        <select id="relationship" name="relationship" class="form-select rounded-pill @error('relationship') is-invalid @enderror" required>
                            <option value="">Seleccione una opción</option>
                            <option value="Padre" @selected(old('relationship') === 'Padre')>Padre</option>
                            <option value="Madre" @selected(old('relationship') === 'Madre')>Madre</option>
                            <option value="Tutor legal" @selected(old('relationship') === 'Tutor legal')>Tutor legal</option>
                            <option value="Encargado" @selected(old('relationship') === 'Encargado')>Encargado</option>
                        </select>
                        @error('relationship') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12">
                        <label for="address" class="form-label fw-semibold">Dirección</label>
                        <input type="text" id="address" name="address" value="{{ old('address') }}" class="form-control rounded-pill @error('address') is-invalid @enderror">
                        @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-semibold">Alumnos vinculados</label>
                        <div class="border rounded-4 p-3 bg-light">
                            @forelse ($students as $student)
                                <div class="form-check mb-2">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="student_ids[]"
                                        value="{{ $student->id }}"
                                        id="student_{{ $student->id }}"
                                        @checked(in_array((string) $student->id, old('student_ids', []), true))
                                    >
                                    <label class="form-check-label" for="student_{{ $student->id }}">
                                        {{ $student->student_code }} - {{ $student->first_name }} {{ $student->last_name }}
                                    </label>
                                </div>
                            @empty
                                <p class="text-muted mb-0">No hay alumnos activos disponibles.</p>
                            @endforelse
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="primary_student_id" class="form-label fw-semibold">Alumno principal</label>
                        <select id="primary_student_id" name="primary_student_id" class="form-select rounded-pill">
                            <option value="">Sin alumno principal</option>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}" @selected(old('primary_student_id') == $student->id)>
                                    {{ $student->student_code }} - {{ $student->first_name }} {{ $student->last_name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="form-text">Seleccione aquí al alumno principal si el tutor tiene varios alumnos vinculados.</div>
                    </div>

                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input type="checkbox" id="is_active" name="is_active" value="1" class="form-check-input" @checked(old('is_active', true))>
                            <label for="is_active" class="form-check-label fw-semibold">Tutor activo</label>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('guardians.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Cancelar</a>

                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-save me-1"></i>
                        Guardar tutor
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection