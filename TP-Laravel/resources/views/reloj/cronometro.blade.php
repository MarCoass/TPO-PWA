@extends('layouts/layout')

@section('titulo')
    Cronómetro
@endsection

@section('encabezado')
   Cronómetro
@endsection

@section('contenido')
 
<div class="p-3" style="margin-bottom: 100px">
<div class="col-md-12 text-center">
        <h3 class="display-5" id="contador_{{$id_competencia}}">90 seg.</h3>
</div>

<div class="col-md-12 text-center">
    <button onChange="iniciar_cronometro({{$id_competencia}})" class="btn btn-outline-primary btn-lg me-2" id="inicio-contador_{{$id_competencia}}"><i class="bi bi-play me-1"></i>Inicia</button>

    <button onChange="finalizar_cronometro({{$id_competencia}})" class="btn btn-outline-warning btn-lg disabled" id="fin-contador_{{$id_competencia}}"><i class="bi bi-stop me-1"></i>Termina</button>
</div>

<input type="hidden" id='overtime_{{$id_competencia}}' name="overtime_{{$id_competencia}}">

<div class="col-md-12 text-center">
        <p class="display-6" id="tiempo-total_{{$id_competencia}}"></p>
</div>
</div>
<script src="{{ asset('js/cronometro.js') }}"></script>
    
@endsection