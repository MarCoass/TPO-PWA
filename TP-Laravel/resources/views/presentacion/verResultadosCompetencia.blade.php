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
    <span>Seleccione una Categoría:</span>
    <select class="form-select form-select-lg mb-3" id="selectCategorias">
        @foreach($categoriasFiltradas as $categoria)
        <option value="{{ $categoria->idCategoria }}">{{ $categoria->nombre }} - {{ $categoria->genero == 1 ? "Masculino" : "Femenino" }}</option>
        @endforeach
      </select>
</div>

<table class="table table-primary table-hover table-striped-columns text-center mt-5" id="tablaVerCompetidores">
    <thead>
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
    
<script src="{{ asset('js/verResultadosCompetencia.js') }}"></script>
@endsection