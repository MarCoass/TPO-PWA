<!-- index.blade.php -->
@extends('layouts/layout')

@section('titulo')
Gestion de Graduacion
@endsection

@section('encabezado')
Gestion de Graduacion
@endsection

@section('contenido')
<!-- despliega mensajes -->
@include('layouts.partials.messages')
<h3>Gestion de Graduacion de Categoria: {{$categoria->nombre}}</h3>
<a href="{{ route('create_categoria_graduacion',['idCategoria' => $categoria->idCategoria ]) }}" class="btn btn-outline-primary mb-3"><i class="bi bi-universal-access me-2"></i>Nueva Graduacion de Categoria</a>

<div class="table-responsive">
<table id="tabla_graduaciones" class="table hover table-light table-bordered nowrap border dataTable dtr-inline collapsed" width="100%">
    <thead class="flip-content">
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Acciones</th>
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