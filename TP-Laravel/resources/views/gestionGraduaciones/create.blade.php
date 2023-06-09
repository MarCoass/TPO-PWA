@extends('layouts/layout')

@section('titulo')
    Crear Graduación
@endsection

@section('encabezado')
    Crear Graduación
@endsection

@section('contenido')
    <form class="m-5 row" method="post" action="{{ route('graduaciones.store')}} ">
        @csrf
        
        <div>
            
        <div class="col-lg-2 col-12 form-group mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <select name="tipo" id="tipo" class="form-control" required>
                <option value="GUP">GUP</option>
                <option value="DAN">DAN</option>
            </select>
            @if ($errors->has('tipo'))
                <span class="text-danger text-left">{{ $errors->first('tipo') }}</span>
            @endif
        </div>
        </div>

        <div class="col-lg-6 col-12 form-group form-floating mb-3">
            <input type="text" class="form-control" name="nombre" id="nombre" value="{{ old('nombre') }}" placeholder="nombre"
                required="required" autofocus>
            <label for="floatingnombre mx-5"  class="mx-2">Nombre</label>
            @if ($errors->has('nombre'))
                <span class="text-danger text-left">{{ $errors->first('nombre') }}</span>
            @endif
        </div>

        <div class="col-lg-6 col-12 form-group form-floating mb-3">
            <input type="text" class="form-control" name="color" id="color" value="{{ old('color') }}" placeholder="color"
                required="required">
            <label for="floatingName"  class="mx-2">Color</label>
            @if ($errors->has('color'))
                <span class="text-danger text-left">{{ $errors->first('color') }}</span>
            @endif
        </div>
       


        <div class="col-lg-12 col-12 button-group mb-3 d-flex justify-content-end align-items-center">
            <button class="btn btn-outline-primary mx-2" type="submit">Guardar</button>
            <button type="button" class="btn btn-outline-secondary" onclick="history.back()">Volver</button>
        </div>

    </form>

    <script src="{{ asset('js/graduacion.js') }}"></script>
@endsection
