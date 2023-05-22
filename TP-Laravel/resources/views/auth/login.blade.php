@extends('layouts.auth-master')

@section('titulo')
    Login
@endsection

@section('contenido')
    <form method="post" action="{{ route('login.perform') }}">
        
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <img class="mb-4" src="{{ url('images/World_Taekwondo.png') }}" alt="logo TKD" width="300px" />
        
        <h1 class="h3 mb-3 fw-normal">Login</h1>

        @include('layouts.partials.messages')

        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="usuario" value="{{ old('usuario') }}" placeholder="Nombre de usuario" required="required" autofocus>
            <label for="floatingName">Correo o nombre de usuario</label>
            @if ($errors->has('usuario'))
                <span class="text-danger text-left">{{ $errors->first('usuario') }}</span>
            @endif
        </div>
        
        <div class="form-group form-floating mb-3">
            <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Contraseña" required="required">
            <label for="floatingPassword">Contraseña</label>
            @if ($errors->has('password'))
                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <button class="w-100 btn btn-lg btn-outline-primary" type="submit"><i class="bi bi-box-arrow-in-right me-2"></i>Login</button>
        <a class="w-100 btn btn-lg btn-outline-success mt-2" href="{{ asset('/registro')}}"><i class="bi bi-person-add me-2"></i>Registrarse</a>
        <a class="w-100 btn btn-lg btn-outline-secondary mt-2" href="{{ asset('/')}}"><i class="bi bi-arrow-left me-2"></i>Volver al inicio</a>

        <!-- esto es la marca de agua que esta debajo del submit -->
        @include('auth.partials.copy')
    </form>
@endsection