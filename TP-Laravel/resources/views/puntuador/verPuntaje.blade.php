@extends('layouts/puntuador')

@section('titulo')
    Puntuacion
@endsection

@section('encabezado')
    Puntuacion pasada n°{{ $puntaje->pasada }}
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


        <div class="horizontal row mt-5 justify-content-center align-items-center">

            <p>Competidor: {{ $competidor->nombre }} {{ $competidor->apellido }}</p>
            <div class="row">
                <div class="col-4">
                    <div class="card bg-c-blue order-card">
                        <div class="card-block">
                            <h6 class="m-b-20">Exactitud</h6>
                            <h2 class="text-right"><span>{{ $puntaje->puntajeExactitud }}</span></h2>
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="card bg-c-yellow order-card">
                        <div class="card-block">
                            <h6 class="m-b-20">Presentacion</h6>
                            <h2 class="text-right"><span>{{ $puntaje->puntajePresentacion }}</span></h2>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card bg-c-pink order-card">
                        <div class="card-block">
                            <h6 class="m-b-20">Total pasada</h6>
                            <h2 class="text-right">
                                <span>{{ $puntaje->puntajeExactitud + $puntaje->puntajePresentacion }}</span></h2>

                        </div>
                    </div>
                </div>
            </div>
            
            <button class="btn btn-primary btn-lg">Siguiente pasada <i class="bi bi-arrow-right"></i></button>
        </div>


    </div>
@endsection
