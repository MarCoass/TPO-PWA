@extends('layouts/layout')

@section('titulo')
    Ranking General
@endsection

@section('encabezado')
    Ranking General
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
@endsection

@section('scripts')
    <script type="module" src="{{ asset('js/tabResultadosRanking.js') }}"></script>
@endsection

@section('contenido')

<!-- despliega mensaje cuando se crea la cuenta -->
@include('layouts.partials.messages')

<div class="my-3">

    <div class="row col-6 offset-3 mt-5">
        <label for="selectCategorias" class="form-label"><span class="fs-4">Seleccione una categoría:</span></label>
        <select class="form-select form-select-lg" id="selectCategorias">
            <option value="0" > Indique categoria disponible </option>
            @foreach($categorias as $categoria)
            <option value="{{ $categoria->idCategoria }}" data-genero="{{ $categoria->genero }}">{{ $categoria->nombre }} - {{ $categoria->genero == 1 ? "Femenino" : "Masculino"}}</option>
            @endforeach
        </select>
    </div>

        <h2 class="mt-5 mb-2 " id="titulo-masc" ></h2>
        <table id="ranking_tabla_masc" class="table hover table-light table-bordered nowrap border dataTable dtr-inline collapsed tabla-ranking " width="100%" >
            <thead class="flip-content">
                <tr>
                    <th data-priority="1"> Puesto </th>
                    <th data-priority="1"> Provincia </th>
                    <th data-priority="1"> Nombre </th>
                    <th data-priority="1"> Ranking </th>        
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
        
        
        
        <h2 class="mt-5 mb-2 "id="titulo-fem" ></h2>
        <table id="ranking_tabla_fem" class="table hover table-light table-bordered nowrap border dataTable dtr-inline collapsed tabla-ranking " width="100%">
            <thead class="flip-content">
                <tr>
                    <th data-priority="1"> Puesto </th>
                    <th data-priority="1"> Provincia </th>
                    <th data-priority="1"> Nombre </th>
                    <th data-priority="1"> Ranking </th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>

</div>
@endsection