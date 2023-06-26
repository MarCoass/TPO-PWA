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
            <h3 class="display-5" id="contador_{{ $id_competencia }}">90 seg.</h3>
        </div>
        <input type="hidden" name="id_competencia" id="id_competencia" value="{{ $id_competencia }}">
        <input type="hidden" name="id_categoria" id="id_categoria" value="{{ $id_categoria }}">
        <input type="hidden" name="cantJueces" id="cantJueces" value="{{ $cantJueces }}">
        <input type="hidden" name="idReloj" id="idReloj" value="{{ $idReloj }}">

        <div class="col-md-12 text-center">
            <button type="button" onclick="iniciarCronometro({{ $id_competencia }})"
                class="btn btn-outline-primary btn-lg me-2" id="inicio-contador_{{ $id_competencia }}">
                <i class="bi bi-play me-1"></i>Iniciar
            </button>
            <button type="button" onclick="detenerCronometro({{ $id_competencia }})"
                class="btn btn-outline-danger btn-lg disabled" id="fin-contador_{{ $id_competencia }}">
                <i class="bi bi-stop me-1"></i>Terminar
            </button>
        </div>

        <input type="hidden" id='overtime_{{ $id_competencia }}' name="overtime_{{ $id_competencia }}">

        <div class="col-md-12 text-center">
            <p class="display-6" id="tiempo-total_{{ $id_competencia }}"></p>
        </div>
    </div>


    @include('reloj/tablaInformacion')
    @include('reloj/alertaCategoriaTerminada')
    <script src="{{ asset('js/cronometro.js') }}"></script>
@endsection
