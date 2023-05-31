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
<a href="{{ route('create_usuario') }}" class="btn btn-outline-primary mb-3"><i class="bi bi-universal-access me-2"></i>Nuevo usuario</a>
<table id="tabla_usuarios" class="table hover table-light table-bordered nowrap border dataTable dtr-inline collapsed" width="100%">
    <thead class="flip-content">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Usuario</th>
            <th>Correo</th>
            <th>Escuela</th>
            <th>Estado</th>
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
            <td>{{ (isset($user->escuela) ? $user->escuela->nombre : 'N/A') }}</td>
            <td>{{ ($user->estado == 0) ? 'Sin Verificar' : 'Verificado' }}</td>
            <td>
                {{ ($user->idRol == 1) ? 'Administrador' : '' }}
                {{ ($user->idRol == 2) ? 'Juez' : '' }}
                {{ ($user->idRol == 3) ? 'Competidor' : '' }}
            </td>
            <td>
                @if ($user->estado == 0)
                <a href="{{ route('habilitar_usuario', ['id' => $user->id ]) }}" class="btn btn-outline-success"><i class="bi bi-check2-square me-2"></i>Verificar</a>
                @endif
                <a href="{{ route('edit_usuario', ['id' => $user->id ]) }}" class="btn btn-outline-info"><i class="bi bi-pencil-square me-2"></i>Editar</a>
                <a href="{{ route('delete_usuario', ['id' => $user->id ]) }}" class="btn btn-outline-danger"><i class="bi bi-trash me-2"></i>Eliminar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection