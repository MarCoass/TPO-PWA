@extends('layouts/layout')

@section('titulo')
    Imagenes random
@endsection

@section('encabezado')
    Imagenes random
@endsection

@section('contenido')
    <div class="row my-3 justify-content-center d-none mx-3" id="contenedorImagenes"></div>

    <div class="row my-3 justify-content-center parpadear" id="contenedorImagenesFake">
        @for ($i = 0; $i < 5; $i++)
            @include('includes.cardPlaceholder')
        @endfor
    </div>

    @include('includes.modalVerImagen')

    <script defer src="{{ asset('js/imagenes.js') }}"></script>
@endsection