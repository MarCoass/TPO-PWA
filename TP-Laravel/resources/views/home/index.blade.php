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
                    <a href="/cronometro" class="seccion-item_link">
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
                            Presentacion del torneo
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