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
            <span class="fs-1">Bienvenido <b class="text-danger">{{ auth()->user()->usuario }}</b>.</span>

            <div class="row ">
                <div class="col">
                    @include('includes.calendar')
                </div>
                <div class="col-lg-8 col-md-12 ">

                    <div class="seccion_box">
                        {{-- Todo lo que no son gestiones primero --}}
                        @foreach ($menus as $menu)
                            @if ($menu->idPermiso == 11)
                                @if ($objCompetidor == null)
                                    <div class="seccion_item">
                                        <a href="{{ Route::has($menu->permiso->rutaPermiso) ? route($menu->permiso->rutaPermiso) : '#' }}"
                                            class="seccion-item_link {{ Route::has($menu->permiso->rutaPermiso) ? '' : 'bg-danger' }}">
                                            <div class="seccion-item_bg"></div>
                                            <div class="seccion-item_title">
                                                {{ $menu->permiso->nombrePermiso }}
                                            </div>
                                        </a>
                                    </div>
                                @else
                                    <div class="seccion_item">
                                        <a href="{{ route('reinscribirCompetidor') }}" class="seccion-item_link">
                                            <div class="seccion-item_bg"></div>
                                            <div class="seccion-item_title">
                                                Inscribirse a una Competencia.
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            @else
                                <div class="seccion_item">
                                    <a href="{{ Route::has($menu->permiso->rutaPermiso) ? route($menu->permiso->rutaPermiso) : '#' }}"
                                        class="seccion-item_link {{ Route::has($menu->permiso->rutaPermiso) ? '' : 'bg-danger' }}">
                                        <div class="seccion-item_bg"></div>
                                        <div class="seccion-item_title d-flex justify-content-between">
                                            <div>
                                                {{ $menu->permiso->nombrePermiso }}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @endforeach

                        {{-- Gestiones (sólo para admins) --}}
                        @foreach ($menusGestiones as $menu)
                            <div class="seccion_item">
                                <a href="{{ Route::has($menu->permiso->rutaPermiso) ? route($menu->permiso->rutaPermiso) : '#' }}"
                                    class="seccion-item_link {{ Route::has($menu->permiso->rutaPermiso) ? '' : 'bg-danger' }}">
                                    <div class="seccion-item_bg"></div>
                                    <div class="seccion-item_title d-flex justify-content-between">
                                        <div>
                                            {{ $menu->permiso->nombrePermiso }}
                                        </div>
                                        @if ($menu->idPermiso == 5 && $cantSolicitudes > 0)
                                            <div>
                                                <div
                                                    class="badge rounded-pill text-bg-warning spinner-grow d-flex justify-content-center">
                                                    <div class="align-item-center ">
                                                        <i class="bi bi-bell-fill me-2"></i>
                                                        {{ $cantSolicitudes }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($menu->idPermiso == 4 && $cantUsuarios > 0)
                                            <div>
                                                <div
                                                    class="badge rounded-pill text-bg-warning spinner-grow d-flex justify-content-center">
                                                    <div class="align-item-center ">
                                                        <i class="bi bi-bell-fill me-2"></i>
                                                        {{ $cantUsuarios }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                </a>

                            </div>
                        @endforeach

                        {{-- MODAL INSCRIPCIÓN A COMPETENCIA JUEZ --}}
                        @if (auth()->user()->idRol == 2 && auth()->user()->estado === 1)
                            @include('layouts.modales.modalCompetenciasJueces')
                        @endif
                        @if (Session::get('modalConsulta', false))
                            @include('layouts.modales.modalSolicitarCambios')
                        @endif
                    </div>
                </div>
                <!-- /.col-lg-4 -->
               
            </div>
        @endauth

        {{-- HOME SIN SESIÓN --}}

        @guest
            @include('home.invitados.vistaInvitados')

        @endguest
    @endsection
