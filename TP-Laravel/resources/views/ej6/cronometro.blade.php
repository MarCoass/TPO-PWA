@extends('layouts/layout')

@section('titulo')
    Cronometro
@endsection

@section('encabezado')
   <h1 class="display-2">Cronometro</h1> 
@endsection

@section('contenido')
 
<div class="p-3" style="margin-bottom: 100px">
<div class="col-md-12 text-center">
        <h3 class="display-5" id="contador">90 seg.</h3>
</div>

<div class="col-md-12 text-center">
    <button class="btn btn-primary" id="inicio-contador">Inicia</button>

    <button class="btn btn-secondary disabled" id="fin-contador">Termina</button>
</div>
<div class="col-md-12 text-center">
        <p class="display-6" id="tiempo-total"></p>
</div>
</div>
@endsection