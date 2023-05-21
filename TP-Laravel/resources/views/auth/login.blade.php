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
            <input type="text" class="form-control" name="usuario" value="{{ old('usuario') }}" placeholder="usuario" required="required" autofocus>
            <label for="floatingName">correo o usuario</label>
            @if ($errors->has('usuario'))
                <span class="text-danger text-left">{{ $errors->first('usuario') }}</span>
            @endif
        </div>
        
        <div class="form-group form-floating mb-3">
            <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" required="required">
            <label for="floatingPassword">Password</label>
            @if ($errors->has('password'))
                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
        <a class="w-100 btn btn-lg btn-secondary mt-2" href="{{ asset('/')}}">Volver</a>
        
        <!-- esto es la marca de agua que esta debajo del submit -->
        @include('auth.partials.copy')
    </form>
@endsection