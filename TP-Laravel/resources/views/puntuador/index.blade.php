@extends('layouts/layout')

@section('titulo')
Iniciar Puntuador
@endsection

@section('encabezado')
Iniciar Puntuador
@endsection
@include('layouts.partials.messages')
@section('contenido')
<form class="m-5 row" method="post" action="{{ url('/iniciar_puntaje') }}">
    @csrf
<div class="col-lg-6 col-md-12 col-sm-12  pt-3">
        <label class="form-label" for="competencia_puntuador">Competencia:</label>
        <select class="form-control validar" id="competencia_puntuador" name="competencia_puntuador" required>
            <option value="" disabled selected data-error="Por favor seleccione una competencia válida">Selecciona una Competencia.</option>
            @foreach ($competencias as $row)
            <option value="{{$row->idCompetencia}}">{{$row->nombre}}</option>
            @endforeach
        </select>
        <div class="valid-feedback">
            ¡Correcto!
        </div>
        <div class="invalid-feedback">Seleccione una opcion valida.</div>
</div>
    
<div class="col-lg-6 col-md-12 col-sm-12  pt-3">
        <label class="form-label" for="categoria_puntuador">Categoria:</label>
        <select class="form-control validar" id="categoria_puntuador" name="categoria_puntuador" required>
            <option value="" disabled selected data-error="Por favor seleccione una categoria válida">Selecciona una categoria.</option>
            @foreach ($categorias as $row)
            <option value="{{$row->idCategoria}}">{{$row->nombre}}</option>
            @endforeach
        </select>
        <div class="valid-feedback">
            ¡Correcto!
        </div>
        <div class="invalid-feedback">Seleccione una opcion valida.</div>
</div>
<div class="col-lg-6 col-md-12 col-sm-12  pt-3">
    <label class="form-label" for="competidor_puntuador">Competidor:</label>
    <select class="form-control validar" id="competidor_puntuador" name="competidor_puntuador" required>
        <option value="" disabled selected data-error="Por favor seleccione una graduacion válida">Selecciona un competidor.</option>
    </select>
    <div class="valid-feedback">
        ¡Correcto!
    </div>
    <div class="invalid-feedback">Seleccione una opcion valida.</div>
</div>
{{-- <div class="col-lg-6 col-md-12 col-sm-12  pt-3">
    <label class="form-label" for="poomsae_puntuador">Poomsae:</label>
    <select class="form-control validar" id="poomsae_puntuador" name="poomsae_puntuador" required>
    </select>
    <div class="valid-feedback">
        ¡Correcto!
    </div>
    <div class="invalid-feedback">Seleccione una opcion valida.</div>
</div> --}}

<div class="col-lg-6 col-12 button-group mb-3 d-flex justify-content-end align-items-center">
    <button class="btn btn-outline-primary mx-2" type="submit">Iniciar Puntaje</button>
</div>
</form>
@endsection