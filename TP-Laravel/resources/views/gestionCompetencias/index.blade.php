<!-- index.blade.php -->
@extends('layouts/layout')

@section('titulo')
Gestion de Competencias
@endsection

@section('encabezado')
Gestion de Competencias
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
    <script> datatables("tabla_competencia",0, "asc") </script>
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
            <th data-priority="4" >Id</th>
            <th data-priority="1" >Nombre</th>
            <th data-priority="3" >Fecha</th>
            <th data-priority="2" >Inscripciones</th>
            <th data-priority="3" >Cupo Jueces</th>
            <th data-priority="1" >Acciones</th>
        </tr>
    </thead
    <tbody>
        @foreach ($competencias as $row)
        <tr>
            <td>{{ $row->idCompetencia }}</td>
            <td>
                <div class="text-wrap">
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
            @if ($row->estadoCompetencia == 1)
            <td class="badge bg-secondary text-wrap mx-2">Finalizada</td>
            <td>{{$row->competencia_juez_count}} de {{ $row->cantidadJueces }}</td>
            <td class="list-group my-2">
                <a href="{{ route('verPresentacion', ['id' => $row->idCompetencia ]) }}" class="btn btn-outline-secondary text-wrap">Ir a presentacion.</a>
                <a href="{{ route('verResultados', ['id' => $row->idCompetencia]) }}" class="btn btn-outline-secondary text-wrap"><i class="bi bi-trophy me-2"></i>Ver resultados competencia</a>
                <a href="{{ route('ver_inscriptos_competencia', ['id' => $row->idCompetencia ]) }}" class="btn btn-outline-secondary text-wrap">Ver Competidores inscriptos</a>
                <a href="{{ route('tabla_jueces', ['id' => $row->idCompetencia ]) }}" class="btn btn-outline-secondary text-wrap">Ver Jueces inscriptos</a>
            </td>
            @else
                
            <td class="badge bg-info text-wrap mx-2">{{ ($row->estadoJueces) ? 'Abiertas a Competidores' : 'Abiertas a Jueces'}}</td>
            <td>{{$row->competencia_juez_count}} de {{ $row->cantidadJueces }}</td>
            <td class="list-group my-2">
                <a href="{{ route('edit_competencia', ['id' => $row->idCompetencia ]) }}" class="btn btn-outline-success text-wrap"><i class="bi bi-pencil-square me-2"></i>Editar</a>
                <a href="{{ route('ver_inscriptos_competencia', ['id' => $row->idCompetencia ]) }}" class="btn btn-outline-success text-wrap">Ver Competidores inscriptos</a>
                <a href="{{ route('tabla_jueces', ['id' => $row->idCompetencia ]) }}" class="btn btn-outline-success text-wrap">Ver Jueces inscriptos</a>
                <a href="{{ route('verPresentacion', ['id' => $row->idCompetencia ]) }}" class="btn btn-outline-success text-wrap">Ir a presentacion.</a>
            </td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection
