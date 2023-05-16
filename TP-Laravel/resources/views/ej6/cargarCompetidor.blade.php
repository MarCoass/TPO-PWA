@extends('layouts/layout')

@section('titulo')
Cargar Competidor
@endsection

@section('encabezado')
Formulario de carga de competidor
@endsection

@section('contenido')
<div class="card my-5 shadow">
    <div class="card-body">
        <div class="row" style="overflow: hidden;">
            <div class="col-4 align-self-start my-1 d-none d-lg-block">
                <img src="{{ asset('images/form-foto.png') }}" class="img-form rounded" style="width: 100%; height: 480px; object-fit: cover;">
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 mx-auto position-relative">
                <div class="mx-auto position-relative col-6 my-4">
                    <div class="progress" style="height: 5px;">
                        <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <button type="button" onclick="showTab('paso1', 0, 'cambiar')" class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-primary rounded-pill" style="width: 2rem; height: 2rem;">1</button>
                    <button type="button" onclick="showTab('paso2', 100, '')" id="botonForm2" class="position-absolute top-0 start-100 translate-middle btn btn-sm btn-secondary rounded-pill" style="width: 2rem; height: 2rem;">2</button>
                </div>
                <form id="cargaParticipante" class="needs-validation" novalidate> <!-- INICIO FORM -->
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="paso1"> <!-- INICIO CONTENIDO PASO 1 -->
                            <div class="row">
                                @include('includes.paso1')
                            </div>
                        </div> <!-- FIN CONTENIDO PASO 1 -->
                        <div class="tab-pane fade" id="paso2"> <!-- INICIO CONTENIDO PASO 2 -->
                            <div class="row">
                                @include('includes.paso2')
                            </div>
                        </div> <!-- FIN CONTENIDO PASO 2 -->
                    </div>
                </form> <!-- FIN FORM -->
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/cargaCompetidor.js') }}"></script>
@endsection