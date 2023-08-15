@extends('layouts/puntuador')

@section('titulo')
    Puntuador
@endsection


@section('contenido')
    <div class="desktop">
        @include('puntuador.partials.vistaNoDisponible')

    </div>
    <input type="hidden" name="id_reloj" id="id_reloj" value="{{ $reloj->idReloj }}">
    <input type="hidden" name="id_competencia" id="id_competencia" value="{{ $reloj->idCompetencia }}">
    <input type="hidden" name="id_categoria" id="id_categoria" value="{{ $reloj->competenciaCompetidor->categoria->idCategoria }}">

    <div class="mobile">
        <div class="vertical">
            @include('puntuador.partials.vistaNoDisponible')
        </div>


        <div class="horizontal row ">

            <div class="pulsadorIzq bg-danger col-4 d-flex justify-content-center align-items-center">

                <span class="display-2">- 0.3</span>
            </div>
            <div class="infoCompetidor col-4 justify-content-center">

                <h5> <span id="etapaPuntuacion" class="badge text-bg-success">
                        Exactitud
                    </span><br><span class="badge text-bg-success">
                        Pasada n°{{ $pasada }}
                    </span></h5>

                <h2>Puntaje: <span id="puntajeId" class="puntaje">4</span>
                </h2>
                <p>Competidor: <span class="fw-bold">{{ $competidor->nombre }}
                        {{ $competidor->apellido }}</span> <br>Poomsae:
                    <span class="fw-bold">
                        @foreach ($arrayPoomsaes as $poomsae)
                            {{ $poomsae->nombre }}
                        @endforeach
                    </span>

                </p>

                <button type="button" class="btn btn-success disabled"
                    id="siguientePuntuacion_{{ $competencia->idCompetencia }}">
                    Siguiente
                </button>
                <button type="button" class="btn btn-success d-none" data-bs-toggle="modal" data-bs-target="#modal"
                    id="terminarPuntuacion">
                    Terminar
                </button>
            </div>
            <div class="pulsadorDer bg-primary col-4 d-flex justify-content-center align-items-center disabled">
                <span class="display-2">- 0.1</span>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog text-dark">
                    <form method="POST" action="{{ route('puntaje.update') }}">

                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title fs-5" id="modalLabel">Confirmar puntuacion {{ $competidor->nombre }} {{ $competidor->apellido }}</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            @csrf
                           
                            <div class="modal-body">
                                <p>Puntaje exactitud: <span class="badge bg-success puntajeExactitudModal"></span>
                                    <br>Puntaje presentacion: <span class="badge bg-success puntajePresentacionModal"></span>
                                </p>
                                <input type="hidden" id="puntajeExactitudInput" name="puntajeExactitud">
                                <input type="hidden" id="puntajePresentacionInput" name="puntajePresentacion">
                                <input type="hidden" id="pasada" name="pasada" value='{{ $pasada }}'>
                                <input type="hidden" id="overtime" name="overtime" value='0'>
                                <input type="hidden" id="idCompetenciaCompetidor" name="idCompetenciaCompetidor"
                                    value='{{ $competencia_competidor->idCompetenciaCompetidor }}'>
                                <input type="hidden" id="idCompetenciaJuez" name="idCompetenciaJuez"
                                    value='{{ $competencia_juez[0]->idCompetenciaJuez }}'>
                            </div>
                            <div class="m-2 d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary mx-1" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Enviar puntuacion</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>


    </div>

    <script defer src="{{ asset('js/reloj_activo.js') }}"></script>
@endsection
