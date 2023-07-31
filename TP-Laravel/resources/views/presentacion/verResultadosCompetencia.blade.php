@extends('layouts/layout')

@section('titulo')
Tabla de Resultados de {{ $competencia->nombre }}
@endsection

@section('encabezado')
Tabla de Resultados de {{ $competencia->nombre }}
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
    <script src="{{ asset('js/verResultadosCompetencia.js') }}"></script>
@endsection

@section('contenido')

<span id="idCompetenciaOculto" hidden>{{ $competencia->idCompetencia }}</span>

<div class="row col-6 offset-3 mt-5">
    <label for="selectCategorias" class="form-label"><span class="fs-4">Seleccione una categoría:</span></label>
    <select class="form-select form-select-lg" id="selectCategorias">
        @foreach($categoriasFiltradas as $categoria)
        <option value="{{ $categoria->idCategoria }}">{{ $categoria->nombre }} - {{ $categoria->genero == 1 ? "Femenino" : "Masculino" }}</option>
        @endforeach
    </select>
    <span class="text-secondary text-center mt-1">Sólo se mostrarán las categorías en las que exista al menos un competidor.</span>
</div>

<div class="table-responsive">
    <table  class="table hover table-light table-bordered nowrap border dataTable dtr-inline collapsed" width="100%" id="tablaVerCompetidores">
        <thead class="flip-content">
            <tr>
                <th scope="col" data-priority="1">Puesto</th>
                <th scope="col" data-priority="1" >Nombre</th>
                <th scope="col" data-priority="4" >Escuela</th>
                <th scope="col" data-priority="1" >Puntaje</th>
            </tr>
        </thead>
        <tbody id="tbodyCompetidores">
            {{-- Aquí se listarán dinámicamente los competidores --}}
        </tbody>
    </table>
</div>


@endsection