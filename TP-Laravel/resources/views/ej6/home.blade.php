@extends('layouts/layout')

@section('titulo')
    Home
@endsection

@section('encabezado')
    Home
@endsection

@section('contenido')
<h1>Seccion 1</h1>
@include('cronometro');

<h1>Secciion 2</h1>

@include('video');

<h1>Seccion 3 </h1>
@include('tablaCompetidores');

<h1> Seccion 4 </h1>
Formulario competidor

<h1>Seccion 5</h1>

@include('imagenesRandom');

@endsection