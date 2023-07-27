<!-- index.blade.php -->
@extends('layouts/layout')

@section('titulo')
Gestion de Graduacion
@endsection

@section('encabezado')
Gestion de Graduacion
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
        <script src="{{ asset('js/datatables.js') }}"> </script>
@endsection

@section('scripts')
    <script> datatables("tabla_catgraduaciones", 0, "asc") </script>
@endsection

@section('contenido')
<!-- despliega mensajes -->
@include('layouts.partials.messages')
<button type="button" class="btn btn-outline-secondary mb-3" onclick="history.back()"><i class="bi bi-arrow-left me-2"></i>Volver</button>
       
<h3>Gestion de Graduacion de Categoria: {{$categoria->nombre}}</h3>

<a href="{{ route('create_categoria_graduacion',['idCategoria' => $categoria->idCategoria ]) }}" class="btn btn-outline-primary mb-3"><i class="bi bi-universal-access me-2"></i>Nueva Graduacion de Categoria</a>

<div class="table-responsive">
<table id="tabla_catgraduaciones" class="table hover table-light table-bordered nowrap border dataTable dtr-inline collapsed" width="100%">
    <thead class="flip-content">
        <tr>
            <th data-priority="2" >#</th>
            <th data-priority="1" >Nombre</th>
            <th data-priority="1" >Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categoriaGraduacion as $row)
        <tr>
            <td>{{ $row->idCategoriaGraduacion }}</td>
            <td>{{ $row->nombre }}</td>
           <td>
                <a href="{{ route('delete_categoria_graduacion', ['id' => $row->idCategoriaGraduacion ]) }}" class="btn btn-outline-info">Eliminar</a>
          </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection
