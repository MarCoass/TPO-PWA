<!-- index.blade.php -->
@extends('layouts/layout')

@section('titulo')
Gestion de Poomsae
@endsection

@section('encabezado')
Gestion de Poomsae
@endsection

@section('librerias')

@endsection

@section('contenido')
<!-- despliega mensajes -->
@include('layouts.partials.messages')
<button type="button" class="btn btn-outline-secondary mb-3" onclick="history.back()"><i class="bi bi-arrow-left me-2"></i>Volver</button>
       
<h3>Gestion de Poomsae de Categoria: {{$categoria->nombre}}</h3>

<a href="{{ route('create_categoria_poomsae',['idCategoria' => $categoria->idCategoria ]) }}" class="btn btn-outline-primary mb-3"><i class="bi bi-universal-access me-2"></i>Nueva Poomsae de Categoria</a>

<div class="table-responsive">
<table id="tabla_poomsae" class="table hover table-light table-bordered nowrap border dataTable dtr-inline collapsed" width="100%">
    <thead class="flip-content">
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categoriaPoomsae as $row)
        <tr>
            <td>{{ $row->idCategoriaPoomsae }}</td>
            <td>{{ $row->nombre }}</td>
           <td>
                <a href="{{ route('delete_categoria_poomsae', ['id' => $row->idCategoriaPoomsae ]) }}" class="btn btn-outline-info">Eliminar</a>
          </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection