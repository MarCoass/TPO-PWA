<!-- este carga la plantilla app-master -->
@extends('layouts.app-master')

@section('titulo')
    Home
@endsection

@section('contenido')
    <div>

        <!-- despliega mensaje cuando se crea la cuenta -->
        @include('layouts.partials.messages')

        <!-- aca se vuelven a ver los grupos -->

        @auth
            <h1>Bienvenido</h1>

            <div class="row justify-content-around">

                <div class="format-container">

                    <div class="seccion_box">

                        @if (auth()->user()->idRol == 2 || auth()->user()->idRol == 1)
                            <div class="seccion_item">
                                <a href="/cronometro" class="seccion-item_link">
                                    <div class="seccion-item_bg"></div>
                                    <div class="seccion-item_title">
                                        Cronometro
                                    </div>
                                </a>
                            </div>
                        @endif


                        <div class="seccion_item">
                            <a href="/video" class="seccion-item_link">
                                <div class="seccion-item_bg"></div>
                                <div class="seccion-item_title">
                                    Presentacion del torneo
                                </div>
                            </a>
                        </div>

                        @if (auth()->user()->idRol == 1)
                            <div class="seccion_item">
                                <a href="/tablaCompetidores" class="seccion-item_link">
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
                                        Cargar competidor
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
                        

                        @if( auth()->user()->idRol == 1 )
                        <div class="seccion_item">
                            <a href="{{ route('index_usuarios') }}"
                                class="seccion-item_link">
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
            <h1>No logueado</h1>
            <p class="lead">esto se muestra porque no estas logueado.</p>
        @endguest

    </div>
@endsection
