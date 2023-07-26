<!-- index.blade.php -->
@extends('layouts/layout')

@section('titulo')
Gestion de Usuarios
@endsection

@section('encabezado')
Gestion de Usuarios
@endsection

@section('librerias')
        <!-- Jquery UI -->
        <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/start/jquery-ui.css" rel="stylesheet" />

        <!-- Datatable -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css" />
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script> 
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
        <script src="js/datatables.js"></script>
@endsection

@section('scripts')
    <script>datatables("tabla_usuarios", 6, "asc")</script>
@endsection

@section('contenido')
<!-- despliega mensajes -->
@include('layouts.partials.messages')
<h3>Usuarios</h3>
<a href="{{ route('create_usuario') }}" class="btn btn-outline-primary mb-3"><i class="bi bi-universal-access me-2"></i>Nuevo usuario</a>
<table id="tabla_usuarios" class="table hover table-light table-bordered nowrap border dataTable dtr-inline collapsed" width="100%">
    <thead class="flip-content">
        <tr>
            <th data-priority="3" >Id</th>
            <th data-priority="2" >Nombre</th>
            <th data-priority="2" >Apellido</th>
            <th data-priority="1" >Usuario</th>
            <th data-priority="3" >Correo</th>
            <th data-priority="4" >Escuela</th>
            <th data-priority="1" >Estado</th>
            <th data-priority="2" >Rol</th>
            <th data-priority="1" >Acciones</th>
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
            <td>
                @if($user->estado == 0)
                No Verificado
                @elseif($user->estado == 1)
                Verificado
                @else
                Rechazado
                @endif
            </td>
            <td>
                {{ ($user->idRol == 1) ? 'Administrador' : '' }}
                {{ ($user->idRol == 2) ? 'Juez' : '' }}
                {{ ($user->idRol == 3) ? 'Competidor' : '' }}
            </td>
            <td>
                @if ($user->estado == 0)
                <a href="{{ route('habilitar_usuario', ['id' => $user->id ]) }}" class="btn btn-outline-success"><i class="bi bi-check2-square me-2"></i>Verificar</a>
                <a href="{{ route('rechazar_usuario', ['id' => $user->id ]) }}" class="btn btn-outline-danger"><i class="bi bi-x-circle me-2"></i>Rechazar</a>
                @endif
                <a href="{{ route('edit_usuario', ['id' => $user->id ]) }}" class="btn btn-outline-info"><i class="bi bi-pencil-square me-2"></i>Editar</a>
                @if ($user->estado == 2)
                <a href="{{ route('delete_usuario', ['id' => $user->id ]) }}" class="btn btn-outline-danger"><i class="bi bi-trash me-2"></i>Eliminar</a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection