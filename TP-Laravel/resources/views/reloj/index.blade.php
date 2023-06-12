@extends('layouts/layout')

@section('titulo')
    Cronómetro Index
@endsection

@section('encabezado')
    Cronómetro Index
@endsection

@section('contenido')
 
<form class="m-5 row" method="get" action="{{ url('/iniciar_cronometro') }}">
    @csrf
<div class="col-lg-6 col-md-12 col-sm-12  pt-3">
        <label class="form-label" for="competencia">Competencia:</label>
        <select class="form-control validar" id="competencia" name="competencia" required>
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

<div class="col-lg-6 col-12 button-group mb-3 d-flex justify-content-end align-items-center">
    <button class="btn btn-outline-primary mx-2" type="submit">Iniciar Cronometro</button>
</div>
</form>
@endsection