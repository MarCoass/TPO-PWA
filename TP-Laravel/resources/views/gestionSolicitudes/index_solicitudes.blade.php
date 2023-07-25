<!-- index.blade.php -->
@extends('layouts/layout')

@section('titulo')
Gestion de Solicitudes
@endsection

@section('encabezado')
Gestion de Solicitudes
@endsection

@section('librerias')

@endsection

@section('contenido')
<!-- despliega mensajes -->
@include('layouts.partials.messages')

@if ( Route::currentRouteName() == "index_solicitudes")
<h3>Solicitudes.</h3>
<div class="m-2">
    <a class="btn btn-primary mb-2" href="{{ route('solicitudes_archivadas') }}"><i class="bi bi-eye-slash-fill me-2"></i> Ver Solicitudes Archivadas</a>
</div>
@else
<h3>Solicitudes Archivadas.</h3>
<div class="m-2">
    <a class="btn btn-primary" href="{{ route('index_solicitudes') }}"><i class="bi bi-bell-fill me-2"></i> Ver Solicitudes</a>
    <a class="btn btn-outline-danger" href="{{ route('borrarArchivados') }}"><i class="bi bi-trash me-2"></i> Eliminar todas</a>
</div>
@endif
<br>

<table id="tabla_solicitud" class="table hover table-light table-bordered nowrap border dataTable dtr-inline collapsed" width="100%">
    <thead class="flip-content">
        <tr>
            <th>ID</th>
            <th>fecha</th>
            <th>Usuario</th>
            <th>Apellido y Nombre</th>
            <th>estado</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        {{$solicitud = null}}

        @foreach ($solicitudes as $solicitud)
        @if($solicitud->estadoSolicitud != 0)
        <tr>
            <td>{{ $solicitud->idSolicitud }}</td>
            <td>{{ $solicitud->created_at }}</td>
            <td>{{ $solicitud->user->usuario }}</td>
            <td>{{ $solicitud->user->apellido }} {{ $solicitud->user->nombre }}</td>
            <td>{{ $solicitud->user->rol->nombreRol }}</td>
            <td>
            @if ($solicitud->estadoSolicitud == 5)
            <i class="bi bi-hand-thumbs-up-fill text-success me-2"></i>Solicitud aceptada.
            @elseif ($solicitud->estadoSolicitud == 6)
            <i class="bi bi-hand-thumbs-down-fill text-danger me-2"></i>Solicitud rechazada.
            @elseif ($solicitud->estadoSolicitud == 4)
            <i class="bi bi-bell-fill text-warning me-2"></i>Nueva Solicitud.
            @elseif ($solicitud->estadoSolicitud == 2)
            <i class="bi bi-hand-thumbs-down text-info me-2"></i>Solicitud rechazada.
            @elseif ($solicitud->estadoSolicitud == 3)
            <i class="bi bi-hand-thumbs-up text-info me-2"></i>Solicitud aceptada.
            @endif
            </td>
            <td>
                @if ($solicitud->estadoSolicitud == 6 || $solicitud->estadoSolicitud == 5)
                <a href="{{ route('ocultar_solicitud', ['id' => $solicitud->idSolicitud ]) }}" class="btn btn-outline-danger"><i class="bi bi-eye-slash-fill me-2"></i>ocultar</a>
                @elseif ($solicitud->estadoSolicitud == 4)
                <button id="verSolicitudBtn" type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="{{ $solicitud->idSolicitud }}"><i class="bi bi-pencil-square me-2"></i>Ver solicitud</button>
                @endif

            </td>
        </tr>
        @endif
        @endforeach
    </tbody>
</table>

  @if ($solicitud)

  <!-- Modal -->
  <div class="modal fade modalTemaDual" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content modalTemaDual">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">El usuario {{ $solicitud->user->usuario}} solicita</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body ">
            @if ($solicitud->newEscuela !=0)
            <div>
                <h3 class="text-danger">Actualizar su escuela:</h3>
                <p>de </p>
                <b>{{ $solicitud->user->escuela->nombre}}</b>
                <p>a </p>
                <b>{{ $escuelas->firstWhere('idEscuela', $solicitud->newEscuela)->nombre }}</b>
            </div>
            @endif
            @if ($solicitud->newGraduacion !=0)
            <hr>
            <div>
                <h3 class="text-danger">Actualizar su cinturon:</h3>
                <p>de </p>
                <b>{{ $competidores->firstWhere('idUser',$solicitud->idUser)->graduacion->nombre }} - {{ $competidores->firstWhere('idUser',$solicitud->idUser)->graduacion->color }}</b>
                <p>a </p>
                <b>{{ $graduaciones->firstWhere('idGraduacion', $solicitud->newGraduacion)->nombre }} - {{ $graduaciones->firstWhere('idGraduacion', $solicitud->newGraduacion)->color }}</b>
            </div>
            @endif
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <a id="aceptarSolicitudBtn" href="#" class="btn btn-outline-success"><i class="bi bi-check2-square me-2"></i>Aceptar Solicitud</a>
          <a id="rechazarSolicitudBtn" href="#" class="btn btn-outline-danger"><i class="bi bi-x-circle me-2"></i>Rechazar Solicitud</a>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const exampleModal = document.getElementById('exampleModal');
      const verSolicitudBtn = document.getElementById('verSolicitudBtn');
      const aceptarSolicitudBtn = document.getElementById('aceptarSolicitudBtn');
      const rechazarSolicitudBtn = document.getElementById('rechazarSolicitudBtn');

      exampleModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget; // El botón que activó el modal
        const idSolicitud = button.getAttribute('data-id'); // Extrae el data-id del botón

        // Construye la URL de la ruta 'aceptar_solicitud' utilizando el valor de 'idUser'
        const url = '{{ route("aceptar_solicitud", ["id" => ":idSolicitud"]) }}'.replace(':idSolicitud', idSolicitud);
        const url2 = '{{ route("rechazar_solicitud", ["id" => ":idSolicitud"]) }}'.replace(':idSolicitud', idSolicitud);

        // Actualiza el atributo 'href' del enlace del botón "Aceptar Solicitud" en el modal
        aceptarSolicitudBtn.setAttribute('href', url);
        rechazarSolicitudBtn.setAttribute('href', url2);
      });
    });
    </script>

    @endif



@endsection
