@extends('layouts/layout')

@section('titulo')
Gestion de Roles
@endsection

@section('encabezado')
Gestion de Roles
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
    <script> datatables("tabla_roles", 0, "asc") </script>
@endsection


@section('contenido')
<!-- despliega mensajes -->
@include('layouts.partials.messages')
<h3>Roles</h3>
<a href="{{ route('roles.create') }}" class="btn btn-outline-primary mb-3"><i class="bi bi-universal-access me-2"></i>Nuevo Rol</a>

<div class="table-responsive">
<table id="tabla_roles" class="table hover table-light table-bordered nowrap border dataTable dtr-inline collapsed" width="100%">
    <thead class="flip-content">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($roles as $row)
        <tr>
            <td>{{ $row->id }}</td>
            <td>{{ $row->nombreRol }}</td>
            <td>
                <a href="{{ route('roles.edit', ['role' => $row->id ]) }}" class="btn btn-outline-info"><i class="bi bi-pencil-square me-2"></i>Editar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection