@extends('layouts/layout')

@section('titulo')
Tabla de Resultados de {{ $competencia->nombre }}
@endsection

@section('encabezado')
Tabla de Resultados de {{ $competencia->nombre }}
@endsection

@section('contenido')

<span id="idCompetenciaOculto" hidden>{{ $competencia->idCompetencia }}</span>

<div class="row col-6 offset-3 mt-5">
    <label for="selectCategorias" class="form-label"><span class="fs-4">Seleccione una categoría:</span></label>
    <select class="form-select form-select-lg" id="selectCategorias">
        @foreach($categoriasFiltradas as $categoria)
        <option value="{{ $categoria->idCategoria }}">{{ $categoria->nombre }} - {{ $categoria->genero == 1 ? "Masculino" : "Femenino" }}</option>
        @endforeach
    </select>
    <span class="text-secondary text-center mt-1">Sólo se mostrarán las categorías en las que exista al menos un competidor.</span>
</div>

<div class="table-responsive">
    <table class="table hover" width="100%" id="tablaVerCompetidores">
        <thead class="flip-content">
            <tr>
                <th scope="col">Puesto</th>
                <th scope="col">Nombre</th>
                <th scope="col">Escuela</th>
                <th scope="col">Puntaje</th>
            </tr>
        </thead>
        <tbody id="tbodyCompetidores">
            {{-- Aquí se listarán dinámicamente los competidores --}}
        </tbody>
    </table>
</div>

<script src="{{ asset('js/verResultadosCompetencia.js') }}"></script>
@endsection