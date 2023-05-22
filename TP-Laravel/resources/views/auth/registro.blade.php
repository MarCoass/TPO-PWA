@extends('layouts.auth-master')

@section('titulo')
    Registro
@endsection

@section('contenido')
    <form method="post" action="{{ route('registro.perform') }}" class=" bg-light rounded p-5">

        <!-- vvvv - ver que es esto - vvvv -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        
        <img class="mb-4" src="{{ url('images/World_Taekwondo.png') }}" alt="logo TKD" width="300px" />
        
        <h1 class="h3 mb-3 fw-normal">Registro</h1>
        
        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" placeholder="nombre" required="required" autofocus>
            <label for="floatingnombre">Nombre</label>
            @if ($errors->has('nombre'))
            <span class="text-danger text-left">{{ $errors->first('nombre') }}</span>
            @endif
        </div>
        
        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="apellido" value="{{ old('apellido') }}" placeholder="apellido" required="required" autofocus>
            <label for="floatingName">Apellido</label>
            @if ($errors->has('apellido'))
            <span class="text-danger text-left">{{ $errors->first('apellido') }}</span>
            @endif
        </div>
        
        <div class="form-group form-floating mb-3">
            <input type="email" class="form-control" name="correo" value="{{ old('correo') }}" placeholder="name@example.com" required="required" autofocus>
            <label for="floatingcorreo">Correo</label>
            @if ($errors->has('correo'))
            <span class="text-danger text-left">{{ $errors->first('correo') }}</span>
            @endif
        </div>
        
        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="usuario" value="{{ old('usuario') }}" placeholder="usuario" required="required" autofocus>
            <label for="floatingName">Nombre de usuario</label>
            @if ($errors->has('usuario'))
            <span class="text-danger text-left">{{ $errors->first('usuario') }}</span>
            @endif
        </div>
        
        <div class="form-group form-floating mb-3">
            <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" required="required">
            <label for="floatingPassword">Contraseña</label>
            @if ($errors->has('password'))
            <span class="text-danger text-left">{{ $errors->first('password') }}</span>
            @endif
        </div>
        
        <div class="form-group form-floating mb-3">
            <input type="password" class="form-control" name="confirmacion_clave" value="{{ old('confirmacion_clave') }}" placeholder="Confirm Password" required="required">
            <label for="floatingConfirmPassword">Confirmar contraseña</label>
            @if ($errors->has('confirmacion_clave'))
            <span class="text-danger text-left">{{ $errors->first('confirmacion_clave') }}</span>
            @endif
        </div>
        
        <input type="hidden" name="idRol" value="3" />

        <button class="w-100 btn btn-lg btn-outline-success" type="submit"><i class="bi bi-person-add me-2"></i>Registrarse</button>
        <a class="w-100 btn btn-lg btn-outline-secondary mt-2" href="{{ asset('/')}}"><i class="bi bi-arrow-left me-2"></i>Volver al inicio</a>
        
        @include('auth.partials.copy')
    </form>
@endsection