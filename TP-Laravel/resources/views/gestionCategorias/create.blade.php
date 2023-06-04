@extends('layouts/layout')

@section('titulo')
    Crear Categorias
@endsection

@section('encabezado')
    Crear Categorias
@endsection

@section('contenido')
    <form class="m-5 row" method="post" action="{{ route('store_categoria')}} " enctype="multipart/form-data">

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
            <input type="number" class="form-control" name="edadMax" value="{{ old('edadMax') }}" placeholder="edadMax"
                required="required" autofocus>
            <label for="floatingnombre mx-5">Edad Maxima</label>
            @if ($errors->has('edadMax'))
                <span class="text-danger text-left">{{ $errors->first('edadMax') }}</span>
            @endif
        </div>
        
        <div class="col-lg-6 col-12 form-group form-floating mb-3">
            <input type="number" class="form-control" name="edadMin" value="{{ old('edadMin') }}" placeholder="edadMin"
                required="required" autofocus>
            <label for="floatingnombre mx-5">Edad Minima</label>
            @if ($errors->has('edadMin'))
                <span class="text-danger text-left">{{ $errors->first('edadMin') }}</span>
            @endif
        </div>

        <div class="col-lg-6 col-12 form-group mb-3">
            <label for="genero" class="form-label">Genero</label>
            <select name="genero" id="genero" class="form-control" required>
                <option value="0">Masculino</option>
                <option value="1">Feminino</option>
            </select>
        </div>

        <div class="col-lg-6 col-12 form-group mb-3">
            <label for="esElite" class="form-label">Especialidad</label>
            <select name="esElite" id="esElite" class="form-control" required>
                <option value="0">Promocional</option>
                <option value="1">Elite</option>
            </select>
        </div>

        <div class="col-lg-12 col-12 button-group mb-3 d-flex justify-content-end align-items-center">
            <button class="btn btn-outline-primary mx-2" type="submit">Guardar</button>
            <button type="button" class="btn btn-outline-secondary" onclick="history.back()">Volver</button>
        </div>
    </form>
@endsection
