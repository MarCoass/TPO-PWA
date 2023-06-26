<!-- index.blade.php -->
@extends('layouts/layout')

@section('titulo')
Gestion de Competidores de la competencia
@endsection

@section('encabezado')
Gestion de Competidores de la competencia
@endsection

@section('contenido')
<!-- despliega mensajes -->
@include('layouts.partials.messages')
<h3>Estas viendo la <b>{{ $competencia->nombre }}</b></h3>
<a href="{{ route('index_competencia') }}" class="btn btn-outline-secondary">Volver</a>
<a href="{{ route('asignar_poomsae_por_sorteo', ['id_competencia' => $competencia->idCompetencia]) }}" class="btn btn-outline-success">Sortear Poomsae</a>
<br/>

<table id="tabla_CompetenciaCompetidores" class="table hover table-light table-bordered nowrap border dataTable dtr-inline collapsed" width="100%">
    <thead class="flip-content">
        <tr>
            <th>GAL</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Participa</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($competidoresCompetencia as $competidor)
        @if ($competidor['estado'] == 0)
        @php
            $claseTr = "table-primary";
            $estadoCompetidor = "Sin habilitar.";
        @endphp
        @elseif($competidor['estado'] == 1)
        @php
            $claseTr = "table-success";
            $estadoCompetidor = "Habilitado.";
        @endphp
        @else
        @php
            $claseTr = "table-danger";
            $estadoCompetidor = "Rechazado.";
        @endphp
        @endif

        <tr class="{{$claseTr}}">
            <td>{{ $competidor['gal'] }}</td>
            <td>{{ $competidor['nombre'] }}</td>
            <td>{{ $competidor['apellido'] }}</td>


            <td>{{ $estadoCompetidor }}</td>
            <td>
                @if ($competidor['estado'] == 0)
                    @if ($competidor['tieneSolicitud'])
                    <a href="{{ route('competidor_solicitudes', ['id' => $competidor['idUser'] ]) }}" class="btn btn-warning"><i class="bi bi-exclamation-triangle-fill me-2"></i>Atender Solicitudes</a>
                    <a href="#" class="btn btn-outline-success disabled"><i class="bi bi-check2-square me-2"></i>Habilitar</a>

                    @else
                    <a href="{{ route('habilitar_competidor', ['id' => $competidor['idCompetenciaCompetidor'] ]) }}" class="btn btn-outline-success"><i class="bi bi-check2-square me-2"></i>Habilitar</a>
                    <a href="{{ route('rechazar_competidor', ['id' => $competidor['idCompetenciaCompetidor'] ]) }}" class="btn btn-outline-danger"><i class="bi bi-x-circle me-2"></i>Rechazar</a>

                    @endif
                @elseif($competidor['estado'] == 2)
                <a href="{{ route('delete_inscripcion_competidor', ['id' => $competidor['idCompetenciaCompetidor']]) }}" class="btn btn-outline-danger"><i class="bi bi-trash me-2"></i>Eliminar</a>
                @endif

                @if ($competidor['estado'] == 1 && $competidor['tiene_poomsae_asignado'] == 1)
                    <a href="{{ route('ver_poomsae_competidor', ['idCompetenciaCompetidor' => $competidor['idCompetenciaCompetidor'] ]) }}" class="btn btn-outline-success"><i class="bi bi-check2-square me-2"></i>Ver Poomsaes Asignados</a>
                @endif

                @if ($competidor['estado'] == 1 && $competidor['tiene_poomsae_asignado'] == 0)
                <a href="{{ route('asignar_poomsae_competidor', ['id_competencia_competidor' => $competidor['idCompetenciaCompetidor'] ]) }}" class="btn btn-outline-success"><i class="bi bi-check2-square me-2"></i>Asignar Poomsae</a>
                @endif

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
