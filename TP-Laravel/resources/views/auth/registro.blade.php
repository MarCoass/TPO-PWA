@extends('layouts.auth-master')

@section('titulo')
Registro
@endsection

@section('contenido')
<form method="post" action="{{ route('registro.perform') }}" class="bg-light rounded px-5 py-2">

    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <img class="mb-4" src="{{ url('images/World_Taekwondo.png') }}" alt="logo TKD" width="300px" />

    <h1 class="h3 mb-3 fw-normal">Registro</h1>

    <div class="row">
        <div class="form-group form-floating col-6 mb-3">
            <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" placeholder="nombre" required="required" autofocus>
            <label for="floatingnombre " class="mx-2">Nombre</label>
            @if ($errors->has('nombre'))
            <span class="text-danger text-left">{{ $errors->first('nombre') }}</span>
            @endif
        </div>

        <div class="form-group form-floating col-6 mb-3">
            <input type="text" class="form-control" name="apellido" value="{{ old('apellido') }}" placeholder="apellido" required="required" autofocus>
            <label for="floatingName" class="mx-2">Apellido</label>
            @if ($errors->has('apellido'))
            <span class="text-danger text-left">{{ $errors->first('apellido') }}</span>
            @endif
        </div>

        <div class="form-group form-floating col-6 mb-3">
            <input type="email" class="form-control" name="correo" value="{{ old('correo') }}" placeholder="name@example.com" required="required" autofocus>
            <label for="floatingcorreo" class="mx-2">Correo</label>
            @if ($errors->has('correo'))
            <span class="text-danger text-left">{{ $errors->first('correo') }}</span>
            @endif
        </div>

        <div class="form-group form-floating col-6 mb-3">
            <input type="text" class="form-control" name="usuario" value="{{ old('usuario') }}" placeholder="usuario" required="required" autofocus>
            <label for="floatingName" class="mx-2">Nombre de usuario</label>
            @if ($errors->has('usuario'))
            <span class="text-danger text-left">{{ $errors->first('usuario') }}</span>
            @endif
        </div>

        <div class="form-group form-floating col-6 mb-3">
            <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" required="required">
            <label for="floatingPassword" class="mx-2">Contraseña</label>
            @if ($errors->has('password'))
            <span class="text-danger text-left">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <div class="form-group form-floating col-6 mb-3">
            <input type="password" class="form-control" name="confirmacion_clave" value="{{ old('confirmacion_clave') }}" placeholder="Confirm Password" required="required">
            <label for="floatingConfirmPassword" class="mx-2">Confirmar contraseña</label>
            @if ($errors->has('confirmacion_clave'))
            <span class="text-danger text-left">{{ $errors->first('confirmacion_clave') }}</span>
            @endif
        </div>

        <div class="form-group form-floating col-12 mb-3">
            <select name="idEscuela" id="idEscuela" class="form-select" required>
                @if(!isset($escuelas) || empty($escuelas))
                    <option value="" selected>No hay escuelas cargadas. Contactar administrador.</option>
                @else
                    <option value="" selected></option>
                    @foreach($escuelas as $escuela)
                        <option value="{{ $escuela->idEscuela }}">{{ $escuela->nombre }}</option>
                    @endforeach
                @endif
            </select>
            <label for="floatingSelect" class="mx-2">Seleccionar escuela</label>
            @if ($errors->has('idEscuela'))
                <span class="text-danger text-left">{{ $errors->first('idEscuela') }}</span>
            @endif
        </div>

       {{--  <div class="form-group form-floating col-6 mb-3">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="idRol" id="idRol1" value="3" checked>
                <label class="form-check-label" for="idRol1">
                    Competidor
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="idRol" id="idRol2" value="2">
                <label class="form-check-label" for="idRol2">
                    Juez
                </label>
            </div>
        </div> --}}
<p>Registrarse como:</p>
        <div class="wrapper">
            
            <input type="radio" name="idRol" id="idRol1" value="3" checked>
            <input type="radio" name="idRol" id="idRol2" value="2">
              <label for="idRol1" class="option option-1">
                <div class="dot"></div>
                 <span>Competidor</span>
                 </label>
              <label for="idRol2" class="option option-2">
                <div class="dot"></div>
                 <span>Juez</span>
              </label>
           </div>

    </div>

    <button class="w-50 btn btn-lg btn-outline-success" type="submit"><i class="bi bi-person-add me-2"></i>Registrarse</button>
    <a class="w-50 btn btn-lg btn-outline-secondary mt-3" href="{{ asset('/')}}"><i class="bi bi-arrow-left me-2"></i>Volver al inicio</a>

    @include('auth.partials.copy')
</form>
@endsection