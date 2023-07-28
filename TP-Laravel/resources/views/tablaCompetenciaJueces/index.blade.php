<!-- index.blade.php -->
@extends('layouts/layout')

@section('titulo')
Gestion de Jueces de la competencia
@endsection

@section('encabezado')
Gestion de Jueces de la competencia
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
    <script> datatables("tabla_CompetenciaCompetidores", 3, "desc") </script>
@endsection

@section('contenido')
<!-- despliega mensajes -->
@include('layouts.partials.messages')
<h3>Estas viendo la <b>{{ $nombreCompetencia->nombre }}</b> <span class="badge bg-secondary">Jueces Aceptados {{ count($juecesAceptados) .' de ' . $nombreCompetencia->cantidadJueces }}</span></h3>
<a href="{{ route('index_competencia') }}" class="btn btn-outline-secondary">Volver</a>
<table id="tabla_CompetenciaCompetidores" class="table hover table-light table-bordered nowrap border dataTable dtr-inline collapsed" width="100%">
    <thead class="flip-content">
        <tr>
            <th data-priority="4" >id</th>
            <th data-priority="2" >Nombre</th>
            <th data-priority="1" >Apellido</th>
            <th data-priority="1" >Estado</th>
            <th data-priority="1" >Acciones</th>
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
            <td class="list-group my-auto">
                @if ($row['estado'] == 0)
                    @if ($row->tieneSolicitud)
                    <a href="{{ route('competidor_solicitudes', ['id' => $row->juez->id ]) }}" class="btn btn-warning"><i class="bi bi-exclamation-triangle-fill me-2"></i>Atender Solicitudes</a>
                    <a href="#" class="btn btn-outline-success disabled"><i class="bi bi-check2-square me-2"></i>Habilitar</a>

                    @else
                    <a href="{{ route('habilitar_juez', ['id' => $row->idCompetenciaJuez ]) }}" class="btn btn-outline-success"><i class="bi bi-check2-square me-2"></i>Habilitar</a>
                    <a href="{{ route('rechazar_juez', ['id' => $row->idCompetenciaJuez ]) }}" class="btn btn-outline-danger"><i class="bi bi-x-circle me-2"></i>Rechazar</a>
                    @endif
                @elseif($row['estado'] == 2)
                <a href="{{ route('delete_juez_competencia', ['id' => $row->idCompetenciaJuez]) }}" class="btn btn-outline-danger"><i class="bi bi-trash me-2"></i>Eliminar</a>
                
                @endif

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
