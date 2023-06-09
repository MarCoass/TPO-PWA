@extends('layouts/layout')

@section('titulo')
    Editar Graduación
@endsection

@section('encabezado')
    Editar Graduación
@endsection

@section('contenido')
    <form class="m-5 row" method="POST" action="{{ route('graduaciones.update', ['graduacione' => $graduacion->idGraduacion])}} ">
        @csrf
        @method('PUT')

        <div class="col-lg-6 col-12 form-group form-floating mb-3">
            <input type="text" class="form-control" name="nombre" id="nombre" value="{{ $graduacion->nombre }}" placeholder="nombre"
                required="required" autofocus>
            <label for="floatingnombre mx-5"  class="mx-2">Nombre</label>
            @if ($errors->has('nombre'))
                <span class="text-danger text-left">{{ $errors->first('nombre') }}</span>
            @endif
        </div>

        @if($graduacion->tipo != 'DAN')
            <div class="col-lg-6 col-12 form-group form-floating mb-3">
                <input type="text" class="form-control" name="color" id="color" value="{{ $graduacion->color }}" placeholder="color"
                    required="required">
                <label for="floatingName"  class="mx-2">Color</label>
                @if ($errors->has('color'))
                    <span class="text-danger text-left">{{ $errors->first('color') }}</span>
                @endif
            </div>
        @endif


        <div class="col-lg-12 col-12 button-group mb-3 d-flex justify-content-end align-items-center">
            <button class="btn btn-outline-primary mx-2" type="submit">Guardar</button>
            <button type="button" class="btn btn-outline-secondary" onclick="history.back()">Volver</button>
        </div>

    </form>

    <script src="{{ asset('js/graduacion.js') }}"></script>
@endsection
