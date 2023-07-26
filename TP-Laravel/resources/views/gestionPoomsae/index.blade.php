<!-- index.blade.php -->
@extends('layouts/layout')

@section('titulo')
Gestion de Poomsaes
@endsection

@section('encabezado')
Gestion de Poomsaes
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
    <script> datatables("tabla_graduacion", 0, "asc") </script>
@endsection

@section('contenido')
<!-- despliega mensajes -->
@include('layouts.partials.messages')
<h3>Poomsaes</h3>
<a href="{{ route('create_poomsae') }}" class="btn btn-outline-primary mb-3"><i class="bi bi-plus-square me-2"></i>Nuevo Poomsae</a>

<div class="table-responsive">
<table id="tabla_graduacion" class="table hover table-light table-bordered nowrap border dataTable dtr-inline collapsed" width="100%">
    <thead class="flip-content">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($poomsaes as $row)
        <tr>
            <td>{{ $row->idPoomsae }}</td>
            <td>{{ $row->nombre }}</td>
            <td>
                <a href="{{ route('edit_poomsae', ['id' => $row->idPoomsae ]) }}" class="btn btn-outline-info"><i class="bi bi-pencil-square me-2"></i>Editar</a>
                @if (!$row->relacion)
                <a href="{{ route('delete_poomsae', ['id' => $row->idPoomsae ]) }}" class="btn btn-outline-danger"><i class="bi bi-pencil-square me-2"></i>Eliminar</a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection