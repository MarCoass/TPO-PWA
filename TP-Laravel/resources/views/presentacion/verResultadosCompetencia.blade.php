@extends('layouts/layout')

@section('titulo')
{{ $competencia->nombre }}
@endsection

@section('encabezado')
{{ $competencia->nombre }}
@endsection

@section('contenido')


<table class="table table-hover text-center mt-3">
    <thead>
        <tr>
            <th scope="col">Puesto</th>
            <th scope="col">Nombre</th>
            <th scope="col">Escuela</th>
            <th scope="col">Puntaje</th>
        </tr>
    </thead>
    <tbody>
        @foreach($competidores as $competidor)
        <tr>
            <th scope="row">
                @if($competidor->puesto>0 && $competidor->puesto<=3) <i class="bi bi-award-fill fs-5 text-warning me-2"></i>@endif
                {{ $competidor->puesto }}
            </th>
            <td>{{ $competidor->nombre }}</td>
            <td>{{ $competidor->escuela }}</td>
            <td>{{ $competidor->puntaje }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection