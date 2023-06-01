@extends('layouts/layout')

@section('titulo')
    {{$competencia->nombre}}
@endsection

@section('encabezado')
    {{$competencia->nombre}}
@endsection

@section('contenido')
    <div class="text-center">
        <p>Fecha: {{$competencia->fecha}}</p>
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
                <h3>Invitacion</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Non necessitatibus earum, velit inventore
                    assumenda cupiditate molestiae ullam, ea nobis esse totam aliquid, vitae perspiciatis accusantium quae!
                    Voluptate inventore porro quod?</p>
            </section>
            <section class="col-12 col-md-4">
                <h3>Bases</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Non necessitatibus earum, velit inventore
                    assumenda cupiditate molestiae ullam, ea nobis esse totam aliquid, vitae perspiciatis accusantium quae!
                    Voluptate inventore porro quod?</p>
            </section>
            <section class="col-12 col-md-4">
                <div class="d-flex flex-row justify-content-center align-items-center">
                <p class="display-5 mx-3">Flyer</p>
                <a href="{{ asset('storage/' . $competencia->flyer) }}" download>
                    <button class="btn btn-outline-dark">Descargar<i class="bi bi-download px-2"></i></button>
                  </a>
                  
                </div>
                <img class="img-fluid" src="{{ asset('storage/' . $competencia->flyer) }}" alt="">
            </section>
        </div>
    </div>
@endsection
