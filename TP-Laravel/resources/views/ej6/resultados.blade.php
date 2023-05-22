@extends('layouts/layout')

@section('titulo')
    Resultados
@endsection

@section('encabezado')
    Resultados - Individual Élite
@endsection

@section('contenido')
    <div class="row justify-content-center text-center bg-carru">
        <div id="recipeCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner text-dark" role="listbox" id="carouselCategorias">
                <!-- EL JS LISTA LOS ITEMS AQUÍ-->
            </div>
            <a class="carousel-control-prev bg-transparent w-aut" href="#recipeCarousel" role="button"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </a>
            <a class="carousel-control-next bg-transparent w-aut" href="#recipeCarousel" role="button"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </a>
        </div>
    </div>

    <div class="text-center mt-3 mb-0 row">
        <div class="col-12 my-2">
            @include('includes.tab')
        </div>
    </div>

    <script src="{{ asset('js/carousel.js') }}"></script>
    <script src="{{ asset('js/botonCambioGenero.js') }}"></script>
    <script src="{{ asset('js/tab.js') }}"></script>
@endsection
