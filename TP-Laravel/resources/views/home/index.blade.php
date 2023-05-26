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

                @if (auth()->user()->idRol == 2 || auth()->user()->idRol == 1)
                <div class="seccion_item">
                    <a href="/cronometro" class="seccion-item_link">
                        <div class="seccion-item_bg"></div>
                        <div class="seccion-item_title">
                            Cronómetro
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