@extends('layouts/layout')

@section('titulo')
    Cronometro
@endsection

@section('encabezado')
   Cronometro
@endsection

@section('contenido')
 
<div class="p-3" style="margin-bottom: 100px">
<div class="col-md-12 text-center">
        <h3 class="display-5" id="contador">90 seg.</h3>
</div>

<div class="col-md-12 text-center">
    <button class="btn btn-outline-primary btn-lg me-2" id="inicio-contador"><i class="bi bi-play me-1"></i>Inicia</button>

    <button class="btn btn-outline-warning btn-lg disabled" id="fin-contador"><i class="bi bi-stop me-1"></i>Termina</button>
</div>
<div class="col-md-12 text-center">
        <p class="display-6" id="tiempo-total"></p>
</div>
</div>
@endsection