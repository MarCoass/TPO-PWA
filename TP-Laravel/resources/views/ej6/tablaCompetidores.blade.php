@extends('layouts/layout')

@section('titulo')
    Tabla de competidores
@endsection

@section('encabezado')
    Tabla de competidores
@endsection

@section('contenido')
    
<div class="my-3">
        <table id="competidores_tabla"
            class="table hover table-light table-bordered nowrap border dataTable dtr-inline collapsed" width="100%">
            <thead class="flip-content">
                <tr>
                    <th data-priority="1"> GAL </th>
                    <th data-priority="1"> Apellido </th>
                    <th data-priority="1"> Nombre </th>
                    <th data-priority="1"> DU </th>
                    <th data-priority="3"> Fecha de Nacimiento </th>
                    <th data-priority="3"> Pais</th>
                    <th data-priority="3"> Ranking </th>
                    <th data-priority="3"> Graduacion</th>
                    <th data-priority="3"> Email </th>
                    <th data-priority="3"> Genero </th>
                </tr>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
                <tr>
                    <th> GAL </th>
                    <th> Apellido </th>
                    <th> Nombre </th>
                    <th> DU </th>
                    <th> Fecha de Nacimiento </th>
                    <th> Pais</th>
                    <th> Ranking </th>
                    <th> Graduacion</th>
                    <th> Email </th>
                    <th> Genero </th>
                </tr>
            </tfoot>
        </table>
</div>


@endsection