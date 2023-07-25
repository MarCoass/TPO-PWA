<!-- index.blade.php -->
@extends('layouts/layout')

@section('titulo')
Gestion de Poomsaes
@endsection

@section('encabezado')
Gestion de Poomsaes
@endsection

@section('librerias')

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