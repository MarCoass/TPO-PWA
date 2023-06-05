@extends('layouts/layout')

@section('titulo')
    {{ $competencia->nombre }}
@endsection

@section('encabezado')
    {{ $competencia->nombre }}
@endsection

@section('contenido')
    <div class="text-center">
        @if (auth()->user()->idRol == 1)
            <a href="{{ route('edit_competencia', ['id' => $competencia->idCompetencia]) }}" class="btn btn-outline-info"><i
                    class="bi bi-pencil-square me-2"></i>Editar competencia</a>
        @endif
        <p>Fecha: {{ $competencia->fecha }}</p>
        <div class="row my-5 d-block d-md-none">
            <div class="col-12">
                <a href="https://www.youtube.com/watch?v=ermNRSmkGF8" target="_blank" class="btn btn-danger">Haga clic acá para
                    ver un vídeo</a>
            </div>
        </div>

        <div class="row my-5 d-none d-md-block">
            <div class="col-12">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/ermNRSmkGF8"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>
            </div>
        </div>
        <div class="row">
            <section class="col-12 col-md-4">
                <div class="row justify-content-center align-items-center">
                    <p class="display-5 mx-3">Invitacion</p>

                    @if ($competencia->invitacion != '' )
                        <a href="{{ asset('storage/' . $competencia->invitacion) }}" download>
                            <button id="botones" class="btn btn-outline-dark mb-2 ">Descargar<i class="bi bi-download px-2"></i></button>
                        </a>

                        <iframe width="400" height="400" src="{{ asset('storage/' . $competencia->invitacion) }}"
                            frameborder="0"></iframe>
                    @else
                        <p>No se ha cargado el archivo.</p>
                    @endif

                </div>

            </section>
            <section class="col-12 col-md-4">
                <div class="row justify-content-center align-items-center">
                    <p class="display-5 mx-3">Bases</p>
                    @if ($competencia->bases != '')
                        <a href="{{ asset('storage/' . $competencia->bases) }}" download>
                            <button id="botones" class="btn btn-outline-dark col mb-2">Descargar<i class="bi bi-download px-2"></i></button>
                        </a>

                        <iframe class="col" width="400" height="400" src="{{ asset('storage/' . $competencia->bases) }}"
                            frameborder="0"></iframe>
                    @else
                
                        <p>No se ha cargado el archivo.</p>
                    @endif

                </div>

            </section>
            <section class="col-12 col-md-4">
                <div class="row justify-content-center align-items-center">
                    <p class="display-5 mx-3">Flyer</p>
                    @if ($competencia->flyer !='')
                        <a href="{{ asset('storage/' . $competencia->flyer) }}" download>
                            <button id="botones" class="btn btn-outline-dark mb-2">Descargar<i class="bi bi-download px-2"></i></button>
                        </a>
                    </div>
                      
                            <img src="{{ asset('storage/' . $competencia->flyer) }}" alt="" class="img-fluid">
                    @else
                </div>
                        <p>No se ha cargado el archivo.</p>
                    @endif
            </section>
            <button type="button" id="botones" class="btn btn-outline-secondary mt-3" onclick="history.back()" style="width: 25%; margin:auto"><i class="bi bi-arrow-left me-2"></i>Volver</button>
        </div>
    </div>
@endsection
