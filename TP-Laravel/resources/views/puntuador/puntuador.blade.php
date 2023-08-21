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
    <input type="hidden" name="idCompCompeti" id="idCompCompeti" value="{{$reloj->idCompetenciaCompetidor}}">
    <input type="hidden" name="idCompJuez" id="idCompJuez" value="{{$competencia_juez[0]->idCompetenciaJuez}}">

    @foreach ($arrayPoomsaes as $poomsae)
        <input type="hidden" id="idPoomsae{{$loop->iteration}}" value="{{$poomsae->nombre }}">
    @endforeach

    <div class="mobile">
        <div class="vertical">
            @include('puntuador.partials.vistaNoDisponible')
        </div>

        <div class="horizontal row ">

            {{-- pulsador rojo --}}
            <div class="pulsadorIzq bg-danger transicion2 col-4 d-flex justify-content-center align-items-center">
                <span class="display-1 fw-bold text-white">- 0.3</span>
            </div>

            <div class="infoCompetidor col-4 justify-content-center">

                <h5> <span id="etapaPuntuacion" class="badge text-bg-success">
                        Exactitud
                    </span>
                    <br>
                    <span class="badge text-bg-success">
                        Pasada n° <span id="etapaPasada"></span>
                    </span>
                </h5>
                
                {{-- muestra puntaje --}}
                <h2>Puntaje: <span id="puntajeId" class="puntaje"></span> </h2>

                <p>Competidor: <span class="fw-bold">{{ $competidor->nombre }}
                        {{ $competidor->apellido }}</span> <br>Poomsae:
                    <span class="fw-bold" id="poomsaePasadaActual">
                    </span>
                </p>


                <button type="button" class="btn btn-success disabled"
                    {{-- id="siguientePuntuacion_{{ $competencia->idCompetencia }}"> --}}
                    id="siguientePuntuacion_">
                    Siguiente
                </button>

                <button type="button" class="btn btn-success d-none" data-bs-toggle="modal" data-bs-target="#modal"
                    id="terminarPuntuacion">
                    Terminar
                </button>
                
            </div>
        
            {{-- pulsador azul --}}
            <div class="pulsadorDer bg-primary transicion2 col-4 d-flex justify-content-center align-items-center">
                <span class="display-1 fw-bold text-white">- 0.1</span>
            </div>


            {{-- devuelve info en la parte baja --}}
            <div class="row mt-3">
                <div class="col border btn"> <span id="estados"></span> </div>
                <div class="col border btn"> <span id="respuestaSvr"></span> </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog text-dark">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title fs-5" id="modalLabel">Confirmar puntuacion {{ $competidor->nombre }} {{ $competidor->apellido }}</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                       
                        <div class="modal-body">
                            <p>Puntaje exactitud: <span class="badge bg-success puntajeExactitudModal"></span>
                                <br>Puntaje presentacion: <span class="badge bg-success puntajePresentacionModal"></span>
                            </p>
                        </div>
                        <div class="m-2 d-flex justify-content-end">
                            <h3>
                                <button id="enviarPasada" class="btn btn-primary display-2">Enviar puntuacion</button>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal" id="modalCategoriaTerminada" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Puntuacion terminada</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p>Ya puntuaste al competidor</p>
                    </div>
                    <div class="modal-footer">
                      <a href="{{route("puntuador_index")}}"><button type="button" class="btn btn-primary" data-bs-dismiss="modal">Ir a Relojes</button></a>
                    </div>
                  </div>
                </div>
            </div>


        </div>
    </div>
    <script defer src="{{ asset('js/reloj_activo.js') }}"></script>
@endsection
