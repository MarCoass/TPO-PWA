<!-- index.blade.php -->
@extends('layouts/layout')

@section('titulo')
    Gestion de Usuarios
@endsection

@section('encabezado')
Gestion de Usuarios
@endsection

 @section('contenido')
    <h3>Usuarios</h3>
     <a href="{{ route('create_usuario') }}" class="btn btn-primary mb-3">Nuevo usuario</a>
     <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo electrónico</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->nombre }}</td>
                <td>{{ $user->apellido }}</td>
                <td>{{ $user->correo }}</td>
                <td>
                    <form action="{{ route('delete_usuario',['id' =>  $user->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('edit_usuario', ['id' => $user->id ]) }}" class="btn btn-info">Editar</a>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection