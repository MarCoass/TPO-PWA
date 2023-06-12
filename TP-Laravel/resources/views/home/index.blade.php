<!-- este carga la plantilla app-master -->
@extends('layouts.app-master')

@section('titulo')
NeuPoom
@endsection

@section('contenido')
<div>

    <!-- despliega mensajes -->
    @include('layouts.partials.messages')

    <!-- aca se vuelven a ver los grupos -->

    @auth
    <span class="fs-1">Bienvenido <b class="text-danger">{{auth()->user()->usuario}}</b>.</span>

    <div class="row justify-content-around">

        <div class="format-container">

            <div class="seccion_box">

                @if ( auth()->user()->idRol == 1)
                <div class="seccion_item">
                    <a href="/index_reloj" class="seccion-item_link">
                        <div class="seccion-item_bg"></div>
                        <div class="seccion-item_title">
                            Cronómetro
                        </div>
                    </a>
                </div>
                @endif
                @if (auth()->user()->idRol == 2)
                <div class="seccion_item">
                    <a href="/puntuador/index" class="seccion-item_link">
                        <div class="seccion-item_bg"></div>
                        <div class="seccion-item_title">
                            Puntuador
                        </div>
                    </a>
                </div>
                @endif


                <div class="seccion_item">
                    <a href="/presentacion" class="seccion-item_link">
                        <div class="seccion-item_bg"></div>
                        <div class="seccion-item_title">
                            Ver Competencias
                        </div>
                    </a>
                </div>

                @if (auth()->user()->idRol == 2 && auth()->user()->estado === 1)
                <div class="seccion_item">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#inscripcionJuez" class="seccion-item_link">
                        <div class="seccion-item_bg"></div>
                        <div class="seccion-item_title">
                           Inscripcion <!-- JUEZ -->
                        </div>
                    </a>
                    <!-- Modal INSCRIPCION JUEZ -->
                    <div class="modal fade" id="inscripcionJuez" tabindex="-1" aria-labelledby="inscripcionJuezLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form method="POST" action="{{ route('store_competencia_juez') }}">

                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5" id="inscripcionJuezLabel">Inscripcion Juez</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @csrf
                                    <div class="form-group">
                                    <label for="juez">Juez</label>
                                    <select class="form-control" id="juez" name="juez" required>
                                        @foreach ($jueces as $row)
                                        @if($row->id == auth()->user()->id){
                                        <option value="{{ $row->id }}">{{ $row->nombre }} {{ $row->apellido }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="competencia">Competencia</label>
                                        <select class="form-control" id="competencia" name="competencia" required>
                                            @if(!isset($competencias) || count($competencias) == 0)
                                                <option value="" disabled selected>No hay competencias habilitadas. Vuelva más tarde.</option>
                                            @else
                                                @foreach ($competencias as $row)
                                                <option value="{{$row->idCompetencia}}">{{$row->nombre}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Generar Inscripcion</button>
                            </div>
                        </div>
                        </form>
                        </div>
                    </div>
                </div>


                @if(Session::get('modalConsulta', false))
                <?php $data = Session::get('modalConsulta'); ?>
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        var modalConsulta = new bootstrap.Modal(document.getElementById('modalConsulta'), {
                            keyboard: false,
                            backdrop: 'static'
                        });
                        modalConsulta.show();
                    });
                </script>

                <!-- Modal -->
                <div class="modal fade" id="modalConsulta" tabindex="-1" aria-labelledby="modalConsultaLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="modalConsultaLabel">Desea actualizar datos?</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Usted ya ha participado en otras competencias, desea actualizar algunos datos? </p>
                                <p>Tu institucion registrada es: <b>{{ auth()->user()->escuela->nombre }}</b></p>
                                @if (auth()->user()->idRol == 3)
                                @php
                                    $miGraduacionActual = App\Models\Competidor::where('idUser', auth()->user()->id)->first();
                                @endphp
                                <p>Tu Graduacion registrada es: <b>{{ $miGraduacionActual->graduacion->nombre }} - {{ $miGraduacionActual->graduacion->color }}</b></p>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No gracias</button>
                                <a href="/solicitar_cambios/{{auth()->user()->id}}" class="btn btn-outline-primary ms-1"><i class="bi bi-person-gear me-2"></i>Solicitar cambios</a>
                            </div>
                        </div>
                    </div>
                </div>


                @endif



                @endif
                @if (auth()->user()->idRol == 1)
                <div class="seccion_item">
                    <a href="/competidores" class="seccion-item_link">
                        <div class="seccion-item_bg"></div>
                        <div class="seccion-item_title">
                            Ver competidores
                        </div>
                    </a>
                </div>
                @endif

                @if (auth()->user()->idRol == 3)
                <div class="seccion_item">
                    <a href="/cargarCompetidor" class="seccion-item_link">
                        <div class="seccion-item_bg"></div>
                        <div class="seccion-item_title">
                            Inscribirse a una Competencia
                        </div>
                    </a>
                </div>
                @endif


                <div class="seccion_item">
                    <a href="/resultados" class="seccion-item_link">
                        <div class="seccion-item_bg"></div>
                        <div class="seccion-item_title">
                            Resultados
                        </div>
                    </a>
                </div>


                @if (auth()->user()->idRol == 1)
                <div class="seccion_item">
                    <a href="{{ route('index_usuarios') }}" class="seccion-item_link">
                        <div class="seccion-item_bg"></div>
                        <div class="seccion-item_title">
                            Gestion de usuarios
                        </div>
                    </a>
                </div>
                @endif
            </div>
        </div><!-- /.col-lg-4 -->

    </div>
    @endauth

    @guest
    <h1>Usted no esta registrado</h1>
    <div class="row justify-content-around">

        <div class="format-container">

            <div class="seccion_box">
                <div class="seccion_item">
                    <a href="{{ route('login.perform') }}" class="seccion-item_link">
                        <div class="seccion-item_bg"></div>
                        <div class="seccion-item_title">
                            Iniciar sesion
                        </div>
                    </a>
                </div>


                <div class="seccion_item">
                    <a href="{{ route('registro.perform') }}" class="seccion-item_link">
                        <div class="seccion-item_bg"></div>
                        <div class="seccion-item_title">
                            Registrarse
                        </div>
                    </a>
                </div>
            </div>
        </div>
        @endguest



    </div>
    @endsection
