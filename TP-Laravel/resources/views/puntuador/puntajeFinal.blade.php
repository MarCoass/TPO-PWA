@extends('layouts/puntuador')

@section('titulo')
    Puntuacion
@endsection

@section('encabezado')
    Puntuacion Final: <span class="display-3 bg-danger p-1 rounded">{{$competenciaCompetidor->puntaje}}</span>
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
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Pasada n°</th>
                    <th scope="col">Exactitud</th>
                    <th scope="col">Presentacion</th>
                    <th scope="col">Overtime</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">{{$primeraPasada->pasada}}</th>
                    <td>{{$primeraPasada->puntajeExactitud}}</td>
                    <td>{{$primeraPasada->puntajePresentacion}}</td>
                    <td>{{$primeraPasada->overtime}}</td>
                  </tr>
                  <tr>
                    <th scope="row">{{$segundaPasada->pasada}}</th>
                    <td>{{$segundaPasada->puntajeExactitud}}</td>
                    <td>{{$segundaPasada->puntajePresentacion}}</td>
                    <td>{{$segundaPasada->overtime}}</td>
                  </tr>
                  
                </tbody>
              </table>
            
              <div class="button-group">
                <a href=""><button class="btn btn-success">Ver resultados.</button></a>
                <a href="{{route('puntuador_index')}}"><button class="btn btn-success">Puntuador.</button></a>
              </div>
        </div>


    </div>
@endsection
