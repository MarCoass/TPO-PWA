
@extends('layouts/layout')

@section('titulo')
    Crear Usuario
@endsection

@section('encabezado')
    Crear Usuario
@endsection

@section('contenido')
    <form class="m-5 row" method="post" action="{{ route('store_usuario') }}">

        <!-- vvvv - ver que es esto - vvvv -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        
        <div class="col-lg-6 col-12 form-group form-floating mb-3">
            <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" placeholder="nombre" required="required" autofocus>
            <label for="floatingnombre">Nombre</label>
            @if ($errors->has('nombre'))
                <span class="text-danger text-left">{{ $errors->first('nombre') }}</span>
            @endif
        </div>

        <div class="col-lg-6 col-12 form-group form-floating mb-3">
            <input type="text" class="form-control" name="apellido" value="{{ old('apellido') }}" placeholder="apellido" required="required" autofocus>
            <label for="floatingName">Apellido</label>
            @if ($errors->has('apellido'))
                <span class="text-danger text-left">{{ $errors->first('apellido') }}</span>
            @endif
        </div>

        <div class="col-lg-6 col-12 form-group form-floating mb-3">
            <input type="email" class="form-control" name="correo" value="{{ old('correo') }}" placeholder="name@example.com" required="required" autofocus>
            <label for="floatingcorreo">Correo</label>
            @if ($errors->has('correo'))
                <span class="text-danger text-left">{{ $errors->first('correo') }}</span>
            @endif
        </div>

        <div class="col-lg-6 col-12 form-group form-floating mb-3">
            <input type="text" class="form-control" name="usuario" value="{{ old('usuario') }}" placeholder="usuario" required="required" autofocus>
            <label for="floatingName">Usuario</label>
            @if ($errors->has('usuario'))
                <span class="text-danger text-left">{{ $errors->first('usuario') }}</span>
            @endif
        </div>
        
        <div class="col-lg-6 col-12 form-group form-floating mb-3">
            <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" required="required">
            <label for="floatingPassword">Password</label>
            @if ($errors->has('password'))
                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <div class="col-lg-6 col-12 form-group form-floating mb-3">
            <input type="password" class="form-control" name="confirmacion_clave" value="{{ old('confirmacion_clave') }}" placeholder="Confirm Password" required="required">
            <label for="floatingConfirmPassword">Confirmar clave</label>
            @if ($errors->has('confirmacion_clave'))
                <span class="text-danger text-left">{{ $errors->first('confirmacion_clave') }}</span>
            @endif
        </div>

        <div class="col-lg-6 col-12 form-group mb-3">
        <label for="select">Roles:</label>
        <select name="rol" id="rol" class="form-control">
            <option value="">Selecciona un rol</option>
            <option value="1">Administrador</option>
            <option value="2">Juez</option>
            <option value="3">Competidor</option>
        </select>
        </div>

        <div class="col-lg-6 col-12 button-group mb-3 d-flex justify-content-end align-items-center">
             <button class="btn btn-outline-primary mx-2" type="submit">Guardar</button>
             <button type="button" class="btn btn-outline-secondary" onclick="history.back()">Volver</button>
        </div>
       
        
    </form>
@endsection