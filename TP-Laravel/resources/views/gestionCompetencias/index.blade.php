<!-- index.blade.php -->
@extends('layouts/layout')

@section('titulo')
Gestion de Competencias
@endsection

@section('encabezado')
Gestion de Competencias
@endsection

@section('librerias')

@endsection

@section('contenido')
<!-- despliega mensajes -->
@include('layouts.partials.messages')
<h3>Competencias</h3>
<a href="{{ route('create_competencia') }}" class="btn btn-outline-primary mb-3"><i class="bi bi-universal-access me-2"></i>Nueva Competencia</a>

<div class="table-responsive">
<table id="tabla_competencia" class="table hover table-light table-bordered nowrap border dataTable dtr-inline collapsed" width="100%">
    <thead class="flip-content">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Fecha</th>
            <th>Inscripciones</th>
            <th>Cantidad de Jueces</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($competencias as $row)
        <tr>
            <td>{{ $row->idCompetencia }}</td>
            <td class="d-flex ">
                <div class="">
                    {{ $row->nombre }}
                </div>
                @if (App::make('App\Http\Controllers\CompetenciaController')->JuecesEsperandoSerConfirmados($row->idCompetencia))
                <div class="badge rounded-pill text-bg-warning spinner-grow mx-1" style="width: 25px; height: 25px;">
                    <div class="align-item-center ">
                        <i class="bi bi-asterisk"></i>
                    </div>
                </div>
                @endif
                @if (App::make('App\Http\Controllers\CompetenciaController')->CompetidoresEsperandoSerConfirmados($row->idCompetencia))
                <div class="badge rounded-pill text-bg-warning spinner-grow mx-1" style="width: 25px; height: 25px;">
                    <div class="align-item-center ">
                        <i class="bi bi-person-fill-exclamation"></i>
                    </div>
                </div>
                @endif

            </td>
            <td>
            @php $fecha = date('d/m/Y', strtotime($row->fecha)) @endphp
            {{ $fecha }}
            </td>
            <td>{{ ($row->estadoJueces) ? 'Abiertas a Competidores' : 'Abiertas a Jueces'}}</td>
            <td>{{$row->competencia_juez_count}} de {{ $row->cantidadJueces }}</td>
            <td>
                <a href="{{ route('edit_competencia', ['id' => $row->idCompetencia ]) }}" class="btn btn-outline-success"><i class="bi bi-pencil-square me-2"></i>Editar</a>
                <a href="{{ route('ver_inscriptos_competencia', ['id' => $row->idCompetencia ]) }}" class="btn btn-outline-success">Ver Competidores inscriptos</a>
                <a href="{{ route('tabla_jueces', ['id' => $row->idCompetencia ]) }}" class="btn btn-outline-success">Ver Jueces inscriptos</a>
                <a href="{{ route('verPresentacion', ['id' => $row->idCompetencia ]) }}" class="btn btn-outline-success">Ir a presentacion.</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection
