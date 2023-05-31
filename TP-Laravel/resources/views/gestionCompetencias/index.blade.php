<!-- index.blade.php -->
@extends('layouts/layout')

@section('titulo')
Gestion de Competencias
@endsection

@section('encabezado')
Gestion de Competencias
@endsection

@section('contenido')
<!-- despliega mensajes -->
@include('layouts.partials.messages')
<h3>Competencias</h3>
<a href="{{ route('create_competencia') }}" class="btn btn-outline-primary mb-3"><i class="bi bi-universal-access me-2"></i>Nueva Competencia</a>



<table id="tabla_competencia" class="table hover table-light table-bordered nowrap border dataTable dtr-inline collapsed" width="100%">
    <thead class="flip-content">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($competencias as $row)
        <tr>
            <td>{{ $row->idCompetencia }}</td>
            <td>{{ $row->nombre }}</td>
            <td>{{ $row->fecha }}</td>
            <td>
                <a href="{{ route('edit_competencia', ['id' => $row->idCompetencia ]) }}" class="btn btn-outline-info"><i class="bi bi-pencil-square me-2"></i>Editar</a>
                <a href="{{ route('ver_inscriptos_competencia', ['id' => $row->idCompetencia ]) }}" class="btn btn-outline-info">Ver Competidores inscriptos</a>
                <a href="{{ route('tabla_jueces', ['id' => $row->idCompetencia ]) }}" class="btn btn-outline-info">Ver Jueces inscriptos</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

   <!-- Modal -->
   <div class="modal fade" id="competitorModal" tabindex="-1" role="dialog" aria-labelledby="competitorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="competitorModalLabel">Seleccionar competidor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('store_competencia_competidor') }}">
            @csrf
            <div class="form-group">
              <label for="competidor">Competidor</label>
              <select class="form-control" id="competidor" name="competidor">
                @foreach ($competidores as $row)
                  <option value="{{ $row->idCompetidor }}">{{ $row->nombre }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
                <label for="poomsae">Poomsae</label>
                <select class="form-control" id="poomsae" name="poomsae">
                  @foreach ($poomsae as $row)
                    <option value="{{ $row->idPoomsae }}">{{ $row->nombre }}</option>
                  @endforeach
                </select>
              </div>
            <button type="submit" class="btn btn-primary">Generar inscripcion</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection