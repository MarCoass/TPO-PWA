<!-- index.blade.php -->
@extends('layouts/layout')

@section('titulo')
Gestion de Graduaciones
@endsection

@section('encabezado')
Gestion de Graduaciones
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
<h3>Graduaciones</h3>
<a href="{{ route('graduaciones.create') }}" class="btn btn-outline-primary mb-3"><i class="bi bi-universal-access me-2"></i>Nueva Graduación</a>

<div class="table-responsive">
<table id="tabla_graduacion" class="table hover table-light table-bordered nowrap border dataTable dtr-inline collapsed" width="100%">
    <thead class="flip-content">
        <tr>
            <th data-priority="4" >Id</th>
            <th data-priority="1" >Nombre</th>
            <th data-priority="2" >Color</th>
            <th data-priority="2" >Tipo</th>
            <th data-priority="1" >Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($graduaciones as $row)
        <tr>
            <td>{{ $row->idGraduacion }}</td>
            <td>{{ $row->nombre }}</td>
            <td>{{ $row->color }}</td>
            <td>{{ $row->tipo }}</td>
            <td>
                <a href="{{ route('graduaciones.edit', ['graduacione' => $row->idGraduacion ]) }}" class="btn btn-outline-info"><i class="bi bi-pencil-square me-2"></i>Editar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection