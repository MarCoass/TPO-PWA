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
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $usuario->nombre }}" required>
        </div>
        <div class="form-group">
         <label for="name">Apellido</label>
         <input type="text" class="form-control" id="apellido" name="apellido" value="{{ $usuario->nombre }}" required>
        </div>
         <div class="form-group">
            <label for="email">Correo electrónico</label>
            <input type="email" class="form-control" id="correo" name="correo" value="{{ $usuario->correo }}" required>
        </div>
        <div class="form-group">
         <label for="usuario">Usuario</label>
         <input type="text" class="form-control" id="usuario" name="usuario" value="{{ $usuario->usuario }}" required>
        </div>
        <div class="form-group">
         <label for="pass">Nueva Password</label>
         <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
         <label for="pass">Confirmar Clave</label>
         <input type="password" class="form-control" id="password" name="password" required>
        </div>
         <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
@endsection