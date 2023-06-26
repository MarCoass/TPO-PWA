@extends('layouts/layout')

@section('titulo')
    Perfil
@endsection

@section('contenido')
    @include('layouts.partials.messages')
    @auth
        @include('verPerfil.subirFoto')
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <div>
                            @if (auth()->user()->imagenPerfil)
                                <img src="{{ asset('storage/' . auth()->user()->imagenPerfil) }}" alt="avatar"
                                    class="rounded-circle img-fluid" style="width: 150px;">
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" fill="currentColor"
                                    class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                    <path fill-rule="evenodd"
                                        d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                                </svg>
                            @endif
                            <p class="mb-4 mt-2"><a href="#" class="pe-auto text-primary font-italic me-1"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal">Editar foto de perfil</a>
                            </p>
                        </div>

                        <h5 class="my-3">{{ auth()->user()->usuario }}</h5>
                        @if (auth()->user()->idRol == 2 || auth()->user()->idRol == 3)
                            <p class="text-muted mb-1"><span class="me-2"><i class="bi bi-building"></i>
                                    Escuela:</span>{{ auth()->user()->escuela->nombre }}</p>
                        @endif
                        <p class="text-muted mb-4"><span class="me-2"><i class="bi bi-person-badge"></i>
                                Permisos:</span>{{ auth()->user()->rol->nombreRol }} </p>
                    </div>
                </div>
                @if (auth()->user()->idRol != 1)
                <div class="card mb-4 mb-lg-0">
                    <div class="card-body mx-auto">
                        {{-- Incluimos Modal para ver las competencias del usuario --}}
                        @include('layouts.modales.modalCompetenciasPerfil')

                        <button type="button" class="btn btn-info" data-bs-toggle="modal"
                            data-bs-target="#competenciasPerfil">
                            <i class="bi bi-book me-2"></i>Ver Competencias
                        </button>

                        {{-- Incluimos Modal para ver las solcitudes sin atender del usuario --}}
                        @include('layouts.modales.modalInscripcionesPerfil')
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                            data-bs-target="#solicitudesPerfil">
                            <i class="bi bi-list-task me-2"></i>Ver Inscripciones
                        </button>
                    </div>
                </div>
                @endif
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0"><i class="bi bi-person-lines-fill me-2"></i>Nombre Completo:</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ auth()->user()->nombre }} {{ auth()->user()->apellido }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0"><i class="bi bi-envelope-at me-2"></i>Email:</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ auth()->user()->correo }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0"><i class="bi bi-person-check-fill me-2"></i>Nombre de Usuario:</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ auth()->user()->usuario }}</p>
                            </div>
                        </div>
                        @if (auth()->user()->idRol == 3 && $competidor != null)
                        <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0"><i class="bi bi-mortarboard-fill me-2"></i>Graduación: </p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $graduacion->nombre }} - {{ $graduacion->color }}</p>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
                <div class="row">
                    <hr class="col-10 offset-1">
                    <div class="col-md-6 mt-1">
                        <div class="card mb-4 mb-md-0">
                            <div class="card-body">
                                <p class="mb-4"><span class="text-primary font-italic me-1">Editar</span>Datos Personales
                                </p>

                                <form method="post" action="{{ route('actualizarDatosPersonales') }}">

                                    @csrf
                                    <input type="text" name="id" value="{{ auth()->user()->id }}" hidden>
                                    <p class="mb-1" style="font-size: .77rem;">Nombre</p>
                                    <div class="input-group mb-3">
                                        <input type="text" name="nombre" class="form-control"
                                            value="{{ auth()->user()->nombre }}" aria-label="Nombre"
                                            aria-describedby="basic-addon1" required>
                                    </div>

                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Apellido</p>
                                    <div class="input-group mb-3">
                                        <input type="text" name="apellido" class="form-control"
                                            value="{{ auth()->user()->apellido }}" aria-label="Apellido"
                                            aria-describedby="basic-addon1" required>
                                    </div>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Contraseña</p>
                                    <div class="input-group mb-3">
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Confirmar contraseña" aria-label="contraseña"
                                            aria-describedby="basic-addon1" required>
                                    </div>

                                    <button class="btn btn-outline-success" type="submit"><i
                                            class="bi bi-pencil-square me-2"></i>Actualizar</button>

                            </div>
                        </div>
                    </div>
                    </form>
                    <div class="col-md-6 mt-1">
                        <div class="card mb-4 mb-md-0">
                            <div class="card-body">
                                <p class="mb-4"><span class="text-primary font-italic me-1">Actualizar</span>Contraseña
                                </p>

                                <form method="post" action="{{ route('actualizarPassword') }}">

                                    @csrf
                                    <input type="text" name="id" value="{{ auth()->user()->id }}" hidden>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Contraseña actual</p>
                                    <div class="input-group mb-3">
                                        <input type="password" name="passwordactual" class="form-control"
                                            aria-label="contraseña" aria-describedby="basic-addon1" required>
                                    </div>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Contraseña nueva</p>
                                    <div class="input-group mb-3">
                                        <input type="password" name="passwordnueva" class="form-control"
                                            aria-label="contraseña" aria-describedby="basic-addon1" required>
                                    </div>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Confirmar contraseña nueva</p>
                                    <div class="input-group mb-3">
                                        <input type="password" name="passwordnueva2" class="form-control"
                                            aria-label="contraseña" aria-describedby="basic-addon1" required>
                                    </div>

                                    <button class="btn btn-outline-success" type="submit"><i
                                            class="bi bi-pencil-square me-2"></i>Actualizar</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </section>
    @endauth
@endsection
