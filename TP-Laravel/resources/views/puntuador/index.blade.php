@extends('layouts/layout')

@section('titulo')
Puntuador
@endsection

@section('encabezado')
Puntuador
@endsection

@section('contenido')
<!-- despliega mensajes -->
@include('layouts.partials.messages')
<form class="m-5 row" method="post" action="{{ route('store_usuario') }}">

<div class="col-lg-12 col-md-12 col-sm-6 col-xs-12  pt-3">
    <label class="form-label" for="graduacion_puntuador">Graduacion:</label>
    <select class="form-control validar" id="graduacion_puntuador" name="graduacion_puntuador" required>
        <option value="" disabled selected data-error="Por favor seleccione una graduacion válida">Selecciona una graduación.</option>
        @foreach ($graduaciones as $row)
        <option value="{{$row->idGraduacion}}">{{$row->nombre}}</option>
        @endforeach
    </select>
    <div class="valid-feedback">
        ¡Correcto!
    </div>
    <div class="invalid-feedback">Seleccione una opcion valida.</div>
</div>
<div class="col-lg-12 col-md-12 col-sm-6 col-xs-12  pt-3">
    <label class="form-label" for="competidor_puntuador">Competidor:</label>
    <select class="form-control validar" id="competidor_puntuador" name="competidor_puntuador" required>
        <option value="" disabled selected data-error="Por favor seleccione una graduacion válida">Selecciona un competidor.</option>
    </select>
    <div class="valid-feedback">
        ¡Correcto!
    </div>
    <div class="invalid-feedback">Seleccione una opcion valida.</div>
</div>

<div class="col-lg-12 col-md-12 col-sm-6 col-xs-12  pt-3">
    <label class="form-label" for="poomsae_puntuador">Poomsae:</label>
    <select class="form-control validar" id="poomsae_puntuador" name="poomsae_puntuador" required>
        <option value="" disabled selected data-error="Por favor seleccione una Poomsae válida">Selecciona un Poomsae.</option>
        @foreach ($poomsae as $row)
        <option value="{{$row->idPoomsae}}">{{$row->nombre}}</option>
        @endforeach
    </select>
    <div class="valid-feedback">
        ¡Correcto!
    </div>
    <div class="invalid-feedback">Seleccione una opcion valida.</div>
</div>
</form>
@endsection