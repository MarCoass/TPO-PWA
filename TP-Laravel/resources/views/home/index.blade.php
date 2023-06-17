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
                @foreach($menus as $menu)
                    <div class="seccion_item">
                        <a href="{{ Route::has($menu->permiso->rutaPermiso) ? route($menu->permiso->rutaPermiso) : "#" }}" class="seccion-item_link {{ Route::has($menu->permiso->rutaPermiso) ? '' : "bg-danger" }}">
                            <div class="seccion-item_bg"></div>
                            <div class="seccion-item_title">
                                {{ $menu->permiso->nombrePermiso }}
                            </div>
                        </a>
                    </div>
                @endforeach

                {{-- MODAL INSCRIPCIÓN A COMPETENCIA JUEZ --}}
                @if (auth()->user()->idRol == 2 && auth()->user()->estado === 1)
                    @include('layouts.modales.modalCompetenciasJueces')

                @endif
                @if(Session::get('modalConsulta', false))
                    @include('layouts.modales.modalSolicitarCambios')
                @endif
                </div>
        </div><!-- /.col-lg-4 -->

    </div>
    @endauth

    {{-- HOME SIN SESIÓN --}}

    @guest
    <h1>Usted no esta registrado</h1>
    <div class="row justify-content-around">

        <div class="format-container">

            <div class="seccion_box">
                <div class="seccion_item">
                    <a href="{{ route('login.perform') }}" class="seccion-item_link">
                        <div class="seccion-item_bg"></div>
                        <div class="seccion-item_title">
                            Iniciar sesión.
                        </div>
                    </a>
                </div>


                <div class="seccion_item">
                    <a href="{{ route('registro.perform') }}" class="seccion-item_link">
                        <div class="seccion-item_bg"></div>
                        <div class="seccion-item_title">
                            Registrarse.
                        </div>
                    </a>
                </div>
            </div>
        </div>
        @endguest

    </div>
    @endsection
