@extends('layouts/layout')

@section('titulo')
    Crear Competencia
@endsection

@section('encabezado')
    Crear Competencia
@endsection

@section('contenido')
    <form class="m-5 row" method="post" action="{{ route('store_competencia')}} " enctype="multipart/form-data">

        <!-- vvvv - ver que es esto - vvvv -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        <div class="col-lg-6 col-12 form-group form-floating mb-3">
            <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" placeholder="nombre"
                required="required" autofocus>
            <label for="floatingnombre mx-5">Nombre</label>
            @if ($errors->has('nombre'))
                <span class="text-danger text-left">{{ $errors->first('nombre') }}</span>
            @endif
        </div>

        <div class="col-lg-6 col-12 form-group form-floating mb-3">
            <input type="date" class="form-control" name="fecha" value="{{ old('fecha') }}" placeholder="fecha"
                required="required" autofocus>
            <label for="floatingName">Fecha</label>
            @if ($errors->has('fecha'))
                <span class="text-danger text-left">{{ $errors->first('fecha') }}</span>
            @endif
        </div>
        <div class="col-lg-6 col-12 form-group form-floating mb-3">
            <input type="file" name="flyer" id="flyer">
        </div>

        <div class="col-lg-6 col-12 button-group mb-3 d-flex justify-content-end align-items-center">
            <button class="btn btn-outline-primary mx-2" type="submit">Guardar</button>
            <button type="button" class="btn btn-outline-secondary" onclick="history.back()">Volver</button>
        </div>


    </form>
@endsection
