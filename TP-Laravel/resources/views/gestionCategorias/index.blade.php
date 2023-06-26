<!-- index.blade.php -->
@extends('layouts/layout')

@section('titulo')
Gestion de Categorias
@endsection

@section('encabezado')
Gestion de Categorias
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
            <th>#</th>
            <th>Nombre</th>
            <th>Edad Maxima</th>
            <th>Edad Minima</th>
            <th>Genero</th>
            <th>Especialidad</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categorias as $row)
        <tr>
            <td>{{ $row->idCategoria }}</td>
            <td>{{ $row->nombre }}</td>
            <td>{{ $row->edadMax }}</td>
            <td>{{ $row->edadMin }}</td>
            <td>{{ ($row->genero == 1) ? 'Femenino' : 'Masculino' }}</td>
            <td>{{ ($row->esElite == 1) ? 'Elite' : 'Promocional' }}</td>
           <td>
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