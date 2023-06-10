<!-- index.blade.php -->
@extends('layouts/layout')

@section('titulo')
Poomse de Competidor
@endsection

@section('encabezado')
Poomses de Competidor {{$competidor[0]->nombre}} {{$competidor[0]->apellido}}
@endsection

@section('contenido')
<!-- despliega mensajes -->
@include('layouts.partials.messages')

@section('contenido')
@foreach ($poomsae as $row)
<h3>Pasada Numero {{$row->pasadas}}</h3>
<b> Nombre de Poomsae:</b> {{$row->nombre}}
@endforeach

<div class="col-lg-12 col-12 button-group mb-3 d-flex justify-content-end align-items-center">
    <button type="button" class="btn btn-outline-secondary" onclick="history.back()">Volver</button>
</div
@endsection