@extends('layouts/layout')

@section('titulo')
    Crear Poomsae
@endsection

@section('encabezado')
    Crear Poomsae
@endsection

@section('librerias')

@endsection

@section('contenido')
    <form class="m-5 row" method="post" action="{{ route('store_poomsae')}} ">
        @csrf
        
        <div class="col-lg-6 col-12 form-group form-floating mb-3">
            <input type="text" class="form-control" name="nombre" id="nombre" value="{{ old('nombre') }}" placeholder="nombre"
                required="required" autofocus>
            <label for="floatingnombre mx-5"  class="mx-2">Nombre</label>
            @if ($errors->has('nombre'))
                <span class="text-danger text-left">{{ $errors->first('nombre') }}</span>
            @endif
        </div>

        <div class="col-lg-12 col-12 button-group mb-3 d-flex justify-content-end align-items-center">
            <button class="btn btn-outline-primary mx-2" type="submit">Guardar</button>
            <button type="button" class="btn btn-outline-secondary" onclick="history.back()">Volver</button>
        </div>

    </form>
@endsection
