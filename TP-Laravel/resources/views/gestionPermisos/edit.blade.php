@extends('layouts/layout')

@section('titulo')
    Editar Permiso
@endsection

@section('encabezado')
    Editar Permiso
@endsection

@section('librerias')

@endsection

@section('contenido')
    <form class="m-5 row" method="POST" action="{{ route('permisos.update', ['permiso' => $permiso->idPermiso])}} ">
        @csrf
        @method('PUT')

        <div class="col-lg-6 col-12 form-group form-floating mb-3">
            <input type="text" class="form-control" name="nombrePermiso" id="nombrePermiso" value="{{ $permiso->nombrePermiso }}" placeholder="nombre"
                required="required" autofocus>
            <label for="floatingnombrepermiso"  class="mx-2">Nombre</label>
            @if ($errors->has('nombrePermiso'))
                <span class="text-danger text-left">{{ $errors->first('nombrePermiso') }}</span>
            @endif
        </div>

        <div class="col-lg-6 col-12 form-group form-floating mb-3">
            <input type="text" class="form-control" name="rutaPermiso" id="rutaPermiso" value="{{ $permiso->rutaPermiso }}" placeholder="ruta"
                required="required">
            <label for="floatruta"  class="mx-2">Ruta</label>
            @if ($errors->has('rutaPermiso'))
                <span class="text-danger text-left">{{ $errors->first('rutaPermiso') }}</span>
            @endif
        </div>

        <div class="col-lg-6 col-12 form-group mb-3">
            <label for="roles" class="form-label">Roles</label><br>
            @foreach($roles as $rol)
                    <input type="checkbox" class="form-check-input roles" name="roles[]" value="{{ $rol->id }}" {{ ($rolPermisos->contains('idRol', $rol->id)) ? "checked" : "" }}> 
                    <label for="roles" class="form-check-label">{{ $rol->nombreRol }}</label><br>
            @endforeach
        </div>


        <div class="col-lg-12 col-12 button-group mb-3 d-flex justify-content-end align-items-center">
            <button class="btn btn-outline-primary mx-2" type="submit">Guardar</button>
            <button type="button" class="btn btn-outline-secondary" onclick="history.back()">Volver</button>
        </div>

    </form>
@endsection
