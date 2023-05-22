<!-- edit.blade.php -->
@extends('layouts/layout')

@section('titulo')
    Editar Usuario
@endsection

@section('encabezado')
    Editar Usuario
@endsection

@section('contenido')
    <h3>Editar usuario #{{ $usuario->id }}</h3>
    <form class="row m-5" method="POST" action="{{ route('update_usuario', ['id' => $usuario->id]) }}">
        @csrf
        @method('PUT')
        <div class="col-lg-6 col-12 form-group form-floating mb-3">
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $usuario->nombre }}"
                placeholder="nombre" required="required" autofocus>
            <label for="floatingnombre">Nombre</label>
            @if ($errors->has('nombre'))
                <span class="text-danger text-left">{{ $errors->first('nombre') }}</span>
            @endif
        </div>

        <div class="col-lg-6 col-12 form-group form-floating mb-3">
            <input type="text" class="form-control" name="apellido" id="apellido" value="{{ $usuario->apellido }}"
                placeholder="apellido" required="required" autofocus>
            <label for="floatingName">Apellido</label>
            @if ($errors->has('apellido'))
                <span class="text-danger text-left">{{ $errors->first('apellido') }}</span>
            @endif
        </div>

        <div class="col-lg-6 col-12 form-group form-floating mb-3">
            <input type="email" class="form-control" name="correo" value="{{ $usuario->correo }}"
                placeholder="name@example.com" required="required" autofocus>
            <label for="floatingcorreo">Correo</label>
            @if ($errors->has('correo'))
                <span class="text-danger text-left">{{ $errors->first('correo') }}</span>
            @endif
        </div>

        <div class="col-lg-6 col-12 form-group form-floating mb-3">
            <input type="text" class="form-control" name="usuario" value="{{ $usuario->usuario }}" placeholder="usuario"
                required="required" autofocus>
            <label for="floatingName">Usuario</label>
            @if ($errors->has('usuario'))
                <span class="text-danger text-left">{{ $errors->first('usuario') }}</span>
            @endif
        </div>

        <div class="col-lg-6 col-12 form-group form-floating mb-3">
            <input type="password" class="form-control" id="password" name="password" value="{{ $usuario->password }}"
                placeholder="Password" required="required">
            <label for="floatingPassword">Password</label>
            @if ($errors->has('password'))
                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <div class="col-lg-6 col-12 form-group form-floating mb-3">
            <input type="password" class="form-control" id="confirmacion_clave" name="confirmacion_clave"
                value="{{ $usuario->password }}" placeholder="Confirm Password" required="required">
            <label for="floatingConfirmPassword">Confirmar clave</label>
            @if ($errors->has('confirmacion_clave'))
                <span class="text-danger text-left">{{ $errors->first('confirmacion_clave') }}</span>
            @endif
        </div>

        <div class="col-lg-6 col-12 form-group mb-3">
            <label for="select">Roles:</label>
            <select name="rol" id="rol" class="form-control">

                <option value="">Selecciona un rol</option>
                <option value="1" {{ $usuario->idRol == 1 ? 'selected' : '' }}>Administrador</option>
                <option value="2" {{ $usuario->idRol == 2 ? 'selected' : '' }}>Juez</option>
                <option value="3" {{ $usuario->idRol == 3 ? 'selected' : '' }}>Competidor</option>

            </select>
        </div>


        <div class="col-lg-6 col-12 button-group mb-3 d-flex justify-content-end align-items-center">
            <button type="submit" class="btn btn-outline-primary mx-2">Guardar</button>
            <button type="button" class="btn btn-outline-secondary" onclick="history.back()">Volver</button>
        </div>

    </form>
@endsection
