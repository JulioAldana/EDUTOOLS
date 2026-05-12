@extends('layouts.admin')

@section('page-title', 'Detalle del usuario')
@section('page-subtitle', 'Información registrada de la cuenta de acceso')

@section('content')
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
                <div>
                    <h2 class="h5 fw-bold mb-1">{{ $user->name }}</h2>
                    <p class="text-muted mb-0">{{ $user->email }}</p>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="bi bi-arrow-left me-1"></i>
                        Volver
                    </a>

                    <a href="{{ route('users.edit', $user) }}" class="btn btn-outline-warning rounded-pill px-4">
                        <i class="bi bi-pencil-square me-1"></i>
                        Editar
                    </a>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Nombre</div>
                        <div class="fw-semibold">{{ $user->name }}</div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Correo electrónico</div>
                        <div class="fw-semibold">{{ $user->email }}</div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Rol</div>
                        <div class="fw-semibold">{{ ucfirst($user->role) }}</div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Estado</div>
                        <div>
                            @if ($user->is_active)
                                <span class="badge rounded-pill text-bg-success">Activo</span>
                            @else
                                <span class="badge rounded-pill text-bg-secondary">Inactivo</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Usuario actual</div>
                        <div class="fw-semibold">{{ $user->id === auth()->id() ? 'Sí' : 'No' }}</div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Creado</div>
                        <div class="fw-semibold">{{ $user->created_at ? $user->created_at->format('d/m/Y H:i') : 'No registrado' }}</div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="border rounded-4 p-3 h-100 bg-light">
                        <div class="text-muted small mb-1">Última actualización</div>
                        <div class="fw-semibold">{{ $user->updated_at ? $user->updated_at->format('d/m/Y H:i') : 'No registrada' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection