<!-- index.blade.php -->
@extends('layouts/layout')

@section('titulo')
    Gestion de Usuarios
@endsection

@section('encabezado')
Gestion de Usuarios
@endsection

 @section('contenido')
 <!-- despliega mensajes -->
 @include('layouts.partials.messages')
    <h3>Usuarios</h3>
     <a href="{{ route('create_usuario') }}" class="btn btn-outline-primary mb-3">Nuevo usuario</a>
     <table id="tabla_usuarios" class="table hover table-light table-bordered nowrap border dataTable dtr-inline collapsed" width="100%">
        <thead class="flip-content">
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
                <td>
                    {{ ($user->idRol == 1) ? 'Administrador' : '' }}
                    {{ ($user->idRol == 2) ? 'Juez' : '' }}
                    {{ ($user->idRol == 3) ? 'Competidor' : '' }}
                </td>
                <td>
                        <a href="{{ route('edit_usuario', ['id' => $user->id ]) }}" class="btn btn-outline-info">Editar</a>
                        <a href="{{ route('delete_usuario', ['id' => $user->id ]) }}" class="btn btn-outline-danger">Eliminar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection