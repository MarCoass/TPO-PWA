<!-- create.blade.php -->
@extends('layouts/layout')

@section('titulo')
    Crear Usuario
@endsection

@section('encabezado')
Crear Usuario
@endsection

 @section('contenido')
     <form method="POST" action="{{ route('store_usuario') }}">
        @csrf
         <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
         <div class="form-group">
            <label for="email">Correo electrónico</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
         <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
         <div class="form-group">
            <label for="password_confirmation">Confirmar contraseña</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>
         <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
@endsection