@extends('layouts/puntuador')

@section('titulo')
    Resultado pasada
@endsection

@section('encabezado')
    Resultado pasada
@endsection

@section('contenido')
    <div class="desktop">
        <div class="alert alert-danger" role="alert">
            Acceda desde un celular.
            
        </div>
        
    </div>

    <div class="mobile">
        <div class="vertical alert alert-danger" role="alert">
            Gire la pantalla.
            @include('layouts.partials.navbar')
        </div>


        <div class="horizontal row mt-5">

            aca va el resultado
        </div>


    </div>
@endsection
