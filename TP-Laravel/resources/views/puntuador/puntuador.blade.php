@extends('layouts/puntuador')

@section('titulo')
    Puntuador
@endsection

@section('encabezado')
    Puntuador pasada n°{{$pasada}}
@endsection

@section('contenido')
    <div class="desktop">
        @include('puntuador.partials.vistaNoDisponible')
        
    </div>
<input type="hidden" name="id_competencia" id="id_competencia" value="{{$competencia[0]->idCompetencia}}">
<input type="hidden" name="id_categoria" id="id_categoria" value="{{$competencia_competidor[0]->idCategoria}}">

    <div class="mobile">
        <div class="vertical">
            @include('puntuador.partials.vistaNoDisponible')
        </div>


        <div class="horizontal row mt-5">

            <div class="pulsadorIzq bg-danger col-4 d-flex justify-content-end align-items-center">
                
                <span class="display-2">- 0.3</span>
            </div>
            <div class="infoCompetidor col-4 ">
                <h3 id="etapaPuntuacion">Exactitud</h3>
                <p>Competidor: {{$competidor[0]->nombre}} {{$competidor[0]->apellido}}</p>
                <p></p>
                <p>Poomsae: <ul>
                    @foreach($arrayPoomsaes as $poomsae)
                        <li>{{ $poomsae->nombre }}</li>
                    @endforeach
                </ul></p>
                <p>Puntaje: <span class="puntaje">4</span>
                </p>
                <button type="button" class="btn btn-success" id="siguientePuntuacion_{{$competencia[0]->idComppetencia}}">
                    Siguiente
                </button>
                <button type="button" class="btn btn-success d-none" data-bs-toggle="modal" data-bs-target="#modal" id="terminarPuntuacion">
                    Terminar
                </button>
            </div>
            <div class="pulsadorDer bg-primary col-4 d-flex justify-content-start align-items-center">
                <span class="display-2">- 0.1</span>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog text-dark">
                    <form method="POST" action="{{ route('puntaje.store') }}">
                      
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modalLabel">Confirmar puntuacion</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        @csrf
                        <!--ESTO DEBERIA SER UN FORM PROBABLEMENTE-->
                        <div class="modal-body">
                            <p>Competidor: {{$competidor[0]->nombre}} {{$competidor[0]->apellido}}</span> </p>
                            <p>Poomsae:<ul>
                                @foreach($arrayPoomsaes as $poomsae)
                                    <li>{{ $poomsae->nombre }}</li>
                                @endforeach
                            </ul></p>
                            <p>Puntaje exactitud: <span class="puntajeExactitudModal"></span></p>
                            <p>Puntaje presentacion: <span class="puntajePresentacionModal"></span></p>

                            <input type="hidden" id="puntajeExactitudInput" name="puntajeExactitud">
                            <input type="hidden" id="puntajePresentacionInput" name="puntajePresentacion">
                            <input type="hidden" id="pasada" name="pasada" value='{{$pasada}}'>
                            <input type="hidden" id="overtime" name="overtime" value='0'>
                            <input type="hidden" id="idCompetenciaCompetidor" name="idCompetenciaCompetidor" value='{{$competencia_competidor[0]->idCompetenciaCompetidor}}'>
                            <input type="hidden" id="idCompetenciaJuez" name="idCompetenciaJuez" value='{{$competencia_juez[0]->idCompetenciaJuez}}'>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Enviar puntuacion</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>

        </div>


    </div>

    <script src="{{ asset('js/reloj_activo.js') }}"></script>
@endsection
