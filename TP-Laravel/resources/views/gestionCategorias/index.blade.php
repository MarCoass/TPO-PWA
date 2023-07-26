<!-- index.blade.php -->
@extends('layouts/layout')

@section('titulo')
Gestion de Categorias
@endsection

@section('encabezado')
Gestion de Categorias
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
    <script> datatables("tabla_competencia", 0, "asc") </script>
@endsection

@section('contenido')
<!-- despliega mensajes -->
@include('layouts.partials.messages')
<h3>Categorias</h3>
<a href="{{ route('create_categoria') }}" class="btn btn-outline-primary mb-3"><i class="bi bi-universal-access me-2"></i>Nueva Categoria</a>

<div class="table-responsive">
<table id="tabla_competencia" class="table hover table-light table-bordered nowrap border dataTable dtr-inline collapsed" width="100%">
    <thead class="flip-content">
        <tr>
            <th data-priority="5" >#</th>
            <th data-priority="1" >Nombre</th>
            <th data-priority="3" >Edad Min.</th>
            <th data-priority="3" >Edad Max.</th>
            <th data-priority="2" >Especialidad</th>
            <th data-priority="1" >Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categorias as $row)
        <tr>
            <td>{{ $row->idCategoria }}</td>
            <td class="text-wrap">{{ $row->nombre }} - {{ ($row->genero == 1) ? '♀️ Fem.' : '♂️ Masc.' }}</td>
            <td>{{ $row->edadMin }}</td>
            <td>{{ $row->edadMax }}</td>
            <td>{{ ($row->esElite == 1) ? 'Elite' : 'Promocional' }}</td>
            <td class="list-group my-2">
                <a href="{{ route('edit_categoria', ['id' => $row->idCategoria ]) }}" class="btn btn-outline-info"><i class="bi bi-pencil-square me-2"></i>Editar</a>
                <a href="{{ route('ver_graduaciones', ['idCategoria' => $row->idCategoria ]) }}" class="btn btn-outline-info">Ver Graduaciones</a>
                <a href="{{ route('ver_poomsae', ['idCategoria' => $row->idCategoria ]) }}" class="btn btn-outline-info">Ver Poomsae</a>
            
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection