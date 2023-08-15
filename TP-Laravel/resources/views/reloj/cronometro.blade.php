@extends('layouts/layout')

@section('titulo')
    Cronómetro
@endsection

@section('encabezado')
    Cronómetro
@endsection

@section('contenido')
    <div class="p-3">
        <div class="col-md-12 text-center">
            <h3 class="display-5" id="contador_{{ $reloj->competencia->idCompetencia }}">90 seg.</h3>
        </div>
        <input type="hidden" name="id_competencia" id="id_competencia" value="{{ $reloj->competencia->idCompetencia }}">
        <input type="hidden" name="id_categoria" id="id_categoria" value="{{ $reloj->categoria->idCategoria }}">
        <input type="hidden" name="cantJueces" id="cantJueces" value="{{ $reloj->cantJueces }}">
        <input type="hidden" name="idReloj" id="idReloj" value="{{ $reloj->idReloj }}">

        <div class="col-md-12 text-center">
            <button type="button" onclick="iniciarCronometro({{ $reloj->competencia->idCompetencia }})"
                class="btn btn-outline-primary btn-lg me-2" id="inicio-contador_{{ $reloj->competencia->idCompetencia }}">
                <i class="bi bi-play me-1"></i>Iniciar
            </button>
            <button type="button" onclick="detenerCronometro({{ $reloj->competencia->idCompetencia }})"
                class="btn btn-outline-danger btn-lg disabled" id="fin-contador_{{ $reloj->competencia->idCompetencia }}">
                <i class="bi bi-stop me-1"></i>Terminar
            </button>
        </div>

        <input type="hidden" id='overtime_{{ $reloj->competencia->idCompetencia }}' name="overtime_{{ $reloj->competencia->idCompetencia }}">

        <div class="col-md-12 text-center">
            <p class="display-6" id="tiempo-total_{{ $reloj->competencia->idCompetencia }}"></p>
        </div>
    </div>


    @include('reloj/tablaInformacion')
    @include('reloj/alertaCategoriaTerminada')
    <script src="{{ asset('js/cronometro.js') }}"></script>
@endsection
