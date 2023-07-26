<!-- index.blade.php -->
@extends('layouts/layout')

@section('titulo')
Gestion de Permisos
@endsection

@section('encabezado')
Gestion de Permisos
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
    <script> datatables("tabla_permisos", 0, "asc") </script>
@endsection

@section('contenido')
<!-- despliega mensajes -->
@include('layouts.partials.messages')
<h3>Permisos</h3>
<a href="{{ route('permisos.create') }}" class="btn btn-outline-primary mb-3"><i class="bi bi-universal-access me-2"></i>Nuevo Permiso</a>

<div class="table-responsive">
<table id="tabla_permisos" class="table hover table-light table-bordered nowrap border dataTable dtr-inline collapsed" width="100%">
    <thead class="flip-content">
        <tr>
            <th data-priority="3" >Id</th>
            <th data-priority="1" >Nombre</th>
            <th data-priority="2" >Ruta</th>
            <th data-priority="1" >Roles</th>
            <th data-priority="1" >Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($permisos as $row)
        <tr>
            <td>{{ $row->idPermiso }}</td>
            <td>{{ $row->nombrePermiso }}</td>
            <td>{{ $row->rutaPermiso }}</td>
            <td>
                @foreach($row->rolpermiso as $rolpermiso)
                    <span class="badge rounded-pill text-bg-primary">{{ $rolpermiso->rol->nombreRol }}</span>
                @endforeach
            </td>
            <td>
                <a href="{{ route('permisos.edit', ['permiso' => $row->idPermiso ]) }}" class="btn btn-outline-info"><i class="bi bi-pencil-square me-2"></i>Editar</a>
                <a href="{{ route('permisos.delete', ['permiso' => $row->idPermiso ]) }}" class="btn btn-outline-danger"><i class="bi bi-trash me-2"></i>Eliminar</a>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection