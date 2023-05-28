@extends('layouts/puntuador')

@section('titulo')
    Puntuador
@endsection

@section('encabezado')
    Puntuador
@endsection

@section('contenido')
    <div class="desktop">
        <div class="alert alert-danger" role="alert">
            Acceda desde un celular.
            
        </div>
        
    </div>

    <div class="mobile">
        <div class="vertical alert alert-danger" role="alert">
            Gire la pantalla.
            @include('layouts.partials.navbar')
        </div>


        <div class="horizontal row mt-5">

            <div class="pulsadorIzq bg-danger col-4 d-flex justify-content-end align-items-center">
                <span class="display-2">- 0.3</span>
            </div>
            <div class="infoCompetidor col-4">
                <p>Competidor:{{$competidor[0]->nombre}} {{$competidor[0]->apellido}}</p>
                <p>Poomse:{{$poomsae[0]->nombre}}</p>
                <p>Puntaje:{{$competencia_competidor[0]->puntaje}}
                </p>
                <button type="button" class="btn btn-success modalPuntuacion" data-bs-toggle="modal" data-bs-target="#modal">
                    Terminar
                </button>
            </div>
            <div class="pulsadorDer bg-primary col-4 d-flex justify-content-start align-items-center">
                <span class="display-2">- 1.0</span>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog text-dark">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modalLabel">Confirmar puntuacion</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <!--ESTO DEBERIA SER UN FORM PROBABLEMENTE-->
                        <div class="modal-body">
                            <p>Competidor: <span class="competidorModal"></span> </p>
                            <p>Poomse: <span class="poomseModal"></span></p>
                            <p>Puntaje: <span class="puntajeModal"></span></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary">Enviar puntuacion</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>
@endsection
