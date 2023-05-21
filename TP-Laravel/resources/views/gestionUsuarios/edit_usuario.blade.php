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
     <form method="POST" action="{{ route('update_usuario',['id' =>$usuario->id]) }}">
        @csrf
        @method('PUT')
         <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $usuario->nombre }}" required>
        </div>
         <div class="form-group">
            <label for="email">Correo electrónico</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $usuario->correo }}" required>
        </div>
         <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
         <div class="form-group">
            <label for="password_confirmation">Confirmar contraseña</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>
         <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
@endsection