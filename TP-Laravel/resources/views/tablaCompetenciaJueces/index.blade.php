<!-- index.blade.php -->
@extends('layouts/layout')

@section('titulo')
Gestion de Jueces de la competencia
@endsection

@section('encabezado')
Gestion de Jueces de la competencia
@endsection

@section('contenido')
<!-- despliega mensajes -->
@include('layouts.partials.messages')
<h3>Estas viendo la <b>{{ $nombreCompetencia->nombre }}</b> <span class="badge bg-secondary">Jueces Aceptados {{ count($juecesAceptados) .' de ' . $nombreCompetencia->cantidadJueces }}</span></h3>
<a href="{{ route('index_competencia') }}" class="btn btn-outline-secondary">Volver</a>
<table id="tabla_CompetenciaCompetidores" class="table hover table-light table-bordered nowrap border dataTable dtr-inline collapsed" width="100%">
    <thead class="flip-content">
        <tr>
            <th>id</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($CompetenciaJuez as $row)
        @if ($row['estado'] == 0)
        @php
            $claseTr = "table-primary";
            $estadoJuez = "Sin habilitar.";
        @endphp
        @elseif($row['estado'] == 1)
        @php
            $claseTr = "table-success";
            $estadoJuez = "Habilitado.";
        @endphp
        @else
        @php
            $claseTr = "table-danger";
            $estadoJuez = "Rechazado.";
        @endphp
        @endif
        <tr class="{{$claseTr}}">
            <td>{{ $row->juez->id }}</td>
            <td>{{ $row->juez->nombre }}</td>
            <td>{{ $row->juez->apellido }}</td>
            <td>{{ $estadoJuez }}</td>
            <td>
                @if ($row['estado'] == 0)
                    @php
                        $tieneSolicitud = App\models\Solicitud::where('idUser', $row->juez->id)->where('estadoSolicitud', 4)->first();
                    @endphp
                    @if ($tieneSolicitud)
                    <a href="{{ route('competidor_solicitudes', ['id' => $row->juez->id ]) }}" class="btn btn-outline-warning"><i class="bi bi-exclamation-triangle-fill me-2"></i>Atender Solicitudes</a>
                    <a href="#" class="btn btn-outline-success disabled"><i class="bi bi-check2-square me-2"></i>Habilitar</a>

                    @else
                    <a href="{{ route('habilitar_juez', ['id' => $row->idCompetenciaJuez ]) }}" class="btn btn-outline-success"><i class="bi bi-check2-square me-2"></i>Habilitar</a>
                    <a href="{{ route('rechazar_juez', ['id' => $row->idCompetenciaJuez ]) }}" class="btn btn-outline-danger"><i class="bi bi-x-circle me-2"></i>Rechazar</a>
                    @endif
                @endif

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
