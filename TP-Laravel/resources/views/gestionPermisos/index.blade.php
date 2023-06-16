<!-- index.blade.php -->
@extends('layouts/layout')

@section('titulo')
Gestion de Permisos
@endsection

@section('encabezado')
Gestion de Permisos
@endsection

@section('contenido')
<!-- despliega mensajes -->
@include('layouts.partials.messages')
<h3>Permisos</h3>
<a href="{{ route('permisos.create') }}" class="btn btn-outline-primary mb-3"><i class="bi bi-universal-access me-2"></i>Nuevo Permiso</a>

<div class="table-responsive">
<table id="tabla_graduacion" class="table hover table-light table-bordered nowrap border dataTable dtr-inline collapsed" width="100%">
    <thead class="flip-content">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Ruta</th>
            <th>Roles</th>
            <th>Acciones</th>
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