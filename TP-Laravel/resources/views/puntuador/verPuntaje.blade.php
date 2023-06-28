@extends('layouts/puntuador')

@section('titulo')
    Puntuacion
@endsection

@section('encabezado')
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


        <div class="horizontal row justify-content-center align-items-center">
            <div class="row">
                <p class="col-6">
                    Puntuacion pasada n° <span class="fw-bold">  {{ $puntaje->pasada }}</p></span>
                <p class="col-6 "> Competidor:
                    <span class="fw-bold">
                        {{ $competidor->nombre }} {{ $competidor->apellido }}</p>
                    </span>
                    
            </div>


            <div class="row">
                <div class="col-4">
                    <div class="card bg-c-blue order-card">
                        <div class="card-block">
                            <h6 class="m-b-20">Exactitud</h6>
                            <h2 class="text-right fs-5"><span>{{ $puntaje->puntajeExactitud }} <span
                                        class="fs-6">(parcial)</span></span></h2>
                            <h2 class="text-right d-none resultadoTotal"><span id="puntajeExactitudTotal">-- </span><span
                                    class="fs-6"> (total)</span></span></h2>
                            <div class="esperando align-item-center">
                                <div class="spinner-border spinner-border-sm" role="status">
                                    <span class="visually-hidden">Esperando total...</span>
                                </div>
                                <span class="">Esperando total...</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="card bg-c-yellow order-card">
                        <div class="card-block">
                            <h6 class="m-b-20 ">Presentacion</h6>
                            <h2 class="text-right fs-5"><span>{{ $puntaje->puntajePresentacion }} <span
                                        class="fs-6">(parcial)</span></span></h2>
                            <h2 class="text-right d-none resultadoTotal">
                                <span id="puntajePresentacionTotal">--</span>
                                <span class="fs-6"> (total)</span></span>
                            </h2>
                            <div class="esperando align-item-center">
                                <div class="spinner-border spinner-border-sm" role="status">
                                    <span class="visually-hidden">Esperando total...</span>
                                </div>
                                <span class="">Esperando total...</span>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card bg-c-pink order-card">
                        <div class="card-block">
                            <h6 class="m-b-20">Total pasada</h6>
                            <h2 class="text-right d-none resultadoTotal">
                                <span id="puntajeTotal">--</span><span class="fs-6"> (total)</span></span>
                            </h2>
                            <div class="esperando align-item-center">
                                <div class="spinner-border spinner-border-sm" role="status">
                                    <span class="visually-hidden">Esperando total...</span>
                                </div>
                                <span class="">Esperando total...</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="badge rounded-pill bg-danger mb-2" id="badgeMensajeDanger" id="badgeMensaje">
                Esperando puntuaciones<span id="cantJueces">..</span>.
            </div>
            <div class="badge rounded-pill bg-success mb-2 d-none" id="badgeMensajeSuccess">
                Puntuaciones listas.
            </div>
            @if ($puntaje->pasada == 1)
                <form action="{{ route('iniciar_puntaje') }}" method="post">
                    @csrf
                    <input type="hidden" name="competencia" id="competencia" value={{ $competencia }}>
                    <input type="hidden" name="competidor" id="competidor" value={{ $competidor->idCompetidor }}>
                    <input type="hidden" name="juez_puntuador" id="juez_puntuador" value={{ $juez_puntuador }}>
                    <input type="hidden" name="pasada_puntuador" id="pasada_puntuador" value={{ $puntaje->pasada }}>
                    <button type="submit" class="btn btn-primary btn-lg boton" disabled>Siguiente pasada <i
                            class="bi bi-arrow-right"></i></button>

                </form>
            @else
                <input type="hidden" name="competencia" id="competencia" value={{ $competencia }}>
                <input type="hidden" name="competidor" id="competidor" value={{ $competidor->idCompetidor }}>
                <input type="hidden" name="pasada_puntuador" id="pasada_puntuador" value={{ $puntaje->pasada }}>
                <a href="{{ route('puntajeFinal.show', ['competenciaCompetidor' => $competencia_competidor]) }}"><button
                        class="btn btn-primary btn-lg boton" disabled>Ver resultado final <i
                            class="bi bi-arrow-right"></i></button>
                </a>
            @endif

        </div>


    </div>
    <!-- Por andar de mamada cambiando nombre quedo mal esto, necesitamoslos dos name asis -->
    <input type="hidden" name="competencia" id="competencia" value={{ $competencia }}>
    <input type="hidden" name="id_competencia" id="id_competencia" value={{ $competencia }}>
    <input type="hidden" name="pasada_puntuador" id="pasada_puntuador" value={{ $puntaje->pasada }}>
    <input type="hidden" name="competidor" id="competidor" value={{ $competidor->idCompetidor }}>
                
@endsection
<script src="{{ asset('js/validarPuntuaciones.js') }}"></script>
