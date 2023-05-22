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
                <th>Id</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Usuario</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->nombre }}</td>
                <td>{{ $user->apellido }}</td>
                <td>{{ $user->usuario}}</td>
                <td>{{ $user->correo }}</td>
                @if ($user->idRol == 1)
                    <td>Administrador</td>
                @elseif ($user->idRol == 2)
                    <td>Juez</td>
                @else
                    <td>Competidor</td>
                @endif
                <td>
                        <a href="{{ route('edit_usuario', ['id' => $user->id ]) }}" class="btn btn-info">Editar</a>
                        <a href="{{ route('delete_usuario', ['id' => $user->id ]) }}" class="btn btn-danger">Eliminar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection