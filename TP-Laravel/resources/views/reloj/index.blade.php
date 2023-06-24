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
            @if(count($competencias) > 0)
            <option value="" disabled selected data-error="Por favor seleccione una competencia válida">Selecciona una Competencia.</option>
            
            @foreach ($competencias as $row)
            <option value="{{$row->idCompetencia}}">{{$row->nombre}}</option>       
            @endforeach

            @else
            <option value="" disabled selected data-error="Por favor seleccione una competencia válida">No hay competencias Abiertas.</option>
            @endif

        </select>
        <div class="valid-feedback">
            ¡Correcto!
        </div>
        <div class="invalid-feedback">Seleccione una opcion valida.</div>
</div>
<div class="col-lg-6 col-md-12 col-sm-12  pt-3">
        <label class="form-label" for="categoria">Categoria:</label>
        <select class="form-control validar" id="categoria" name="categoria" required>
            <option value="" disabled selected data-error="Por favor seleccione una categoria válida">Selecciona una categoria.</option>
        </select>
        <div class="valid-feedback">
            ¡Correcto!
        </div>
        <div class="invalid-feedback">Seleccione una opcion valida.</div>
</div>

<div class="col-lg-6 col-md-12 col-sm-12  pt-3">
    <label class="form-label" for="cantJueces">Cantidad de jueces:</label>
    <select class="form-control validar" id="cantJueces" name="cantJueces" required>
        <option value="" disabled selected data-error="Por favor seleccione una cantJueces válida">Selecciona la cantidad de jueces.</option>
        <option value="3">3</option>
        <option value="5">5</option>
        <option value="7">7</option>
    </select>
    <div class="valid-feedback">
        ¡Correcto!
    </div>
    <div class="invalid-feedback">Seleccione una opcion valida.</div>
</div>

<div class="col-lg-6 col-12 button-group mb-3 d-flex justify-content-end align-items-center">
    <button class="btn btn-outline-primary mx-2" type="submit"><i class="bi bi-hourglass-split me-1"></i>Iniciar Cronómetro</button>
</div>
</form>
@endsection