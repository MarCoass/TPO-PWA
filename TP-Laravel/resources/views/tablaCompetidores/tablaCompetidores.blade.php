@extends('layouts/layout')

@section('titulo')
    Tabla de competidores
@endsection

@section('encabezado')
    Tabla de competidores
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
        <script src="js/datatables.js"></script>
@endsection

@section('scripts')
    <script> datatables("competidores_tabla", 6, "asc") </script>
@endsection

@section('contenido')

<!-- despliega mensaje cuando se crea la cuenta -->
@include('layouts.partials.messages')

<div class="my-3">
        <table id="competidores_tabla"
            class="table hover table-light table-bordered nowrap border dataTable dtr-inline collapsed" width="100%">
            <thead class="flip-content">
                <tr>
                    <th data-priority="1"> GAL </th>
                    <th data-priority="1"> Apellido </th>
                    <th data-priority="1"> Nombre </th>
                    <th data-priority="2"> DU </th>
                    <th data-priority="3"> Fecha Nacimiento </th>
                    <th data-priority="4"> Pais</th>
                    <th data-priority="2"> Ranking </th>
                    <th data-priority="3"> Graduacion</th>
                    <th data-priority="5"> Email </th>
                    <th data-priority="2"> Genero </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($competidores as $competidor)
                <tr>
                    <td>{{ $competidor->gal }}</td>
                    <td>{{ $competidor->apellido }}</td>
                    <td>{{ $competidor->nombre }}</td>
                    <td>{{ $competidor->du }}</td>
                    <td>{{ $competidor->fechaNacimiento }}</td>
                    <td>
                        <img
                        src="https://flagcdn.com/{{ strtolower($competidor->pais->nomenclatura) }}.svg"
                        width="30"
                        alt="{{ $competidor->pais->nomenclatura }}"
                        >
                        {{ $competidor->pais->nombrePais }}</td>
                    <td>{{ $competidor->ranking }}</td>
                    <td>{{ $competidor->graduacion->nombre }}, {{ $competidor->graduacion->color }}</td>
                    <td>{{ $competidor->email }}</td>
                    <td>{{ (($competidor->genero)? "Masculino." : "Femenino." ) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
</div>


@endsection


