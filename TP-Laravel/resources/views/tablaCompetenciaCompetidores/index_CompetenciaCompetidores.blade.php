<!-- index.blade.php -->
@extends('layouts/layout')

@section('titulo')
    Gestion de Competidores de la competencia
@endsection

@section('encabezado')
    Gestion de Competidores de la competencia
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
    <script src="{{ asset('js/datatables.js') }}"></script>
@endsection

@section('scripts')
    <script>
        datatables("tabla_CompetenciaCompetidores", 3, "desc")
    </script>
    <!-- Script para hacer la petición ajax y mostrar el modal -->
    <script>
        $(document).ready(function() {
            // Seleccionar el botón que activa el modal
            var button = $('.btn-modal');

            // Seleccionar el modal
            var modal = $('#myModal');

            // Añadir un evento click al botón
            button.click(function() {
                // Obtener el id del competencia competidor desde el atributo data-id del botón
                var id = $(this).data('id');

                // Hacer una petición ajax al servidor pasando el id como parámetro
                $.ajax({
                    url: '/ver_poomsae_competidor/' + id,
                    type: 'GET',
                    dataType: 'HTML',
                    success: function(data) {
                        // Cargar el contenido del modal con los datos obtenidos
                        modal.find('.modal-content').html(data);
                    },
                    error: function(error) {
                        // Mostrar un mensaje de error en caso de fallo
                        modal.find('.modal-content').html(
                            '<p>Ocurrió un error al obtener los datos.</p>');
                    }
                });
            });
        });
    </script>
@endsection

@section('contenido')
    <!-- despliega mensajes -->
    @include('layouts.partials.messages')
    <h3>Estas viendo la <b>{{ $competencia->nombre }}</b>
        @if ($competencia->estadoCompetencia == 1)
            <p class="badge bg-info">Inscripcion finalizada</p>
        @endif
    </h3>
    <a href="{{ route('index_competencia') }}" class="btn btn-outline-secondary">Volver</a>
    @if ($competencia->estadoInscripcion != 1)

        <button type="button" class="btn btn-warning bg-opacity-50 btn-modal" data-bs-toggle="modal"
        data-bs-target="#sorteoPoom"><b>Sortear Poomsae</b></button>

        <button type="button" class="btn btn-outline-info bg-opacity-75 btn-modal" data-bs-toggle="modal"
        data-bs-target="#escuelasParticipantes"><b>Escuelas participantes</b></button>

        {{-- <a href="{{ route('asignar_poomsae_por_sorteo', ['id_competencia' => $competencia->idCompetencia]) }}"
            class="btn btn-outline-success">Sortear Poomsae</a> --}}
    @endif
    <br />

    <table id="tabla_CompetenciaCompetidores"
        class="table hover table-light table-bordered nowrap border dataTable dtr-inline collapsed" width="100%">
        <thead class="flip-content">
            <tr>
                <th data-priority="4">GAL</th>
                <th data-priority="1">Nombre Completo</th>
                <th data-priority="4">Fecha</th>
                <th data-priority="5">Escuela</th>
                <th data-priority="2">Participa</th>
                @if ($competencia->estadoCompetencia != 1)
                    <th data-priority="1">Acciones</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($competidoresCompetencia as $competidor)
                @if ($competidor['estado'] == 0)
                    @php
                        $claseTr = 'table-warning';
                        $estadoCompetidor = 'Sin verificar.';
                    @endphp
                @elseif($competidor['estado'] == 1)
                    @php
                        $claseTr = 'table-success';
                        $estadoCompetidor = 'Habilitado.';
                    @endphp
                @else
                    @php
                        $claseTr = 'table-danger';
                        $estadoCompetidor = 'Rechazado.';
                    @endphp
                @endif

                <tr class="{{ $claseTr }}">
                    <td>{{ $competidor['gal'] !== null ? $competidor['gal'] : 'Ninguno' }}</td>
                    <td>{{ $competidor['nombre'] }} {{ $competidor['apellido'] }}</td>
                    <td>{{ $competidor['fecha'] }}</td>
                    <td>{{ $competidor['escuela'] }}</td>
                    <td>{{ $estadoCompetidor }}</td>
                    @if ($competencia->estadoCompetencia != 1 && $competencia->estadoInscripcion == 0)
                        <td>
                            @if ($competidor['estado'] == 0)
                                @if ($competidor['tieneSolicitud'])
                                    <a href="{{ route('competidor_solicitudes', ['id' => $competidor['idUser']]) }}"
                                        class="btn btn-warning"><i class="bi bi-exclamation-triangle-fill me-2"></i>Atender
                                        Solicitudes</a>
                                    <a href="#" class="btn btn-outline-success disabled"><i
                                            class="bi bi-check2-square me-2"></i>Habilitar</a>
                                @else
                                    <a href="{{ route('habilitar_competidor', ['id' => $competidor['idCompetenciaCompetidor']]) }}"
                                        class="btn btn-outline-success"><i
                                            class="bi bi-check2-square me-2"></i>Habilitar</a>
                                    <a href="{{ route('rechazar_competidor', ['id' => $competidor['idCompetenciaCompetidor']]) }}"
                                        class="btn btn-outline-danger"><i class="bi bi-x-circle me-2"></i>Rechazar</a>
                                @endif
                            @elseif($competidor['estado'] == 2)
                                @if ($competidor['tieneSolicitud'])
                                    <a href="{{ route('competidor_solicitudes', ['id' => $competidor['idUser']]) }}"
                                class="btn btn-warning"><i class="bi bi-exclamation-triangle-fill me-2"></i>Atender
                                Solicitudes</a>
                                    <a href="#" class="btn btn-outline-success disabled"><i
                                    class="bi bi-check2-square me-2"></i>Habilitar</a>
                                @else
                                <a href="{{ route('habilitarIgual', ['id' => $competidor['idCompetenciaCompetidor']]) }}"
                                    class="btn btn-outline-success"><i
                                        class="bi bi-check2-square me-2"></i>Habilitar</a>

                                <a href="{{ route('delete_inscripcion_competidor', ['id' => $competidor['idCompetenciaCompetidor']]) }}"
                                    class="btn btn-outline-danger"><i class="bi bi-trash me-2"></i>Eliminar</a>
                                @endif

                            @endif

                            @if ($competidor['estado'] == 1 && $competidor['tiene_poomsae_asignado'] == 1)
                                <button type="button" class="btn btn-outline-success btn-modal" data-bs-toggle="modal"
                                    data-bs-target="#myModal" data-id="{{ $competidor['idCompetenciaCompetidor'] }}"><i
                                        class="bi bi-check2-square me-2"></i>Ver Poomsaes Asignados</button>
                            @endif

                            @if ($competidor['estado'] == 1 && $competidor['tiene_poomsae_asignado'] == 0)
                                <a href="{{ route('asignar_poomsae_competidor', ['id_competencia_competidor' => $competidor['idCompetenciaCompetidor']]) }}"
                                    class="btn btn-outline-success"><i class="bi bi-check2-square me-2"></i>Asignar
                                    Poomsae</a>
                            @endif

                        </td>
                    @elseif ($competencia->estadoInscripcion == 1 && $competencia->estadoCompetencia == 0)
                    <td>

                        @if($competidor['estado'] == 2)
                        @if ($competidor['tieneSolicitud'])
                            <a href="{{ route('competidor_solicitudes', ['id' => $competidor['idUser']]) }}"
                        class="btn btn-warning"><i class="bi bi-exclamation-triangle-fill me-2"></i>Atender
                        Solicitudes</a>
                            <a href="#" class="btn btn-outline-success disabled"><i
                            class="bi bi-check2-square me-2"></i>Habilitar</a>
                        @else
                            <a href="{{ route('habilitarIgual', ['id' => $competidor['idCompetenciaCompetidor']]) }}"
                            class="btn btn-outline-success"><i
                                class="bi bi-check2-square me-2"></i>Habilitar</a>

                          <a href="{{ route('delete_inscripcion_competidor', ['id' => $competidor['idCompetenciaCompetidor']]) }}"
                            class="btn btn-outline-danger"><i class="bi bi-trash me-2"></i>Eliminar</a>
                        @endif
                    </td>
                    @endif

                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal vacío -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Aca se cargará el contenido del modal -->
            </div>
        </div>
    </div>

    <div class="modal" id="sorteoPoom">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Sortear Poomsae</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    @php
                        $fecha_actual = new DateTime();
                        $fecha_competencia = new DateTime($competencia->fecha);
                        $fecha_competencia->modify('-1 day');
                        $diferencia = $fecha_actual->diff($fecha_competencia);
                    @endphp
                    <p>Faltan {{$diferencia->d}} días, {{$diferencia->h}} horas y {{$diferencia->i}} minutos para que se genere el sorteo automaticamente </p>
                    @if ($estadoSorteo == "full")
                    <p class="lead text-danger">¿Esta seguro de querer sortear ahora?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <a href="{{ route('asignar_poomsae_por_sorteo', ['id_competencia' => $competencia->idCompetencia]) }}"
                        class="btn btn-outline-success">Sortear Poomsae</a>
                    @else
                    <h3>Aún faltan competidores por gestionar</h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="escuelasParticipantes">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Descargar lista competidores por escuela</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    
                    <h5 class="mb-3">Genere el pdf de la escuela</h5>
                    @foreach ($escuelas as $escuela)
                    <div class="border rounded bg-secondary bg-opacity-10 mb-2">
                        <p class="leaf fw-medium pt-1">{{ $escuela->nombre}}</p>
                        <a class="btn btn-primary mb-2 ml-2" target="_blank" href="/create-pdf-file/{{$competencia->idCompetencia}}/{{$escuela->idEscuela}}"><i class="bi me-2 bi-filetype-pdf"></i>Ver Lista</a>
                    </div>
                    @endforeach
                    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

@endsection
