@extends('layouts/carga-competidor')

@section('titulo')
Inscripción a Competencia.
@endsection

@section('encabezado')
Formulario de Registro de Competidor.
@endsection

@section('contenido')
<span>Carga tus datos de competidor, estos se autocompletarán en futuras inscripciones.</span>
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
                {{-- Mensaje de error para campos erroneos y error en petición ajax (en el segundo caso, revisar consola) --}}
                <div class="alert alert-danger d-none" id="error-js">Algún campo tiene datos incorrectos. Haga click en volver si no ve el error.</div>
                <div class="alert alert-danger d-none" id="error">Ocurrió un error. Por favor, intente otra vez más tarde.</div>
                <form method="post" id="cargaParticipante" action="{{ route('cargarCompetidor.perform') }}" class="needs-validation" novalidate> <!-- INICIO FORM -->
                    {{-- CSRF token para poder enviar el formulario --}}
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}" />

                    {{-- Rutas varias utilizadas con AJAX (ver cargaCompetidor.js y autocompletado.js) --}}
                    <input type="hidden" id="validar" value="{{ route('cargarCompetidor.validar') }}" />
                    <input type="hidden" id="postEnvio" value="{{ route('home.index') }}" />
                    <input type="hidden" id="rutaPais" value="{{ route('pais.autocomplete') }}" />
                    <input type="hidden" id="rutaEstado" value="{{ route('estado.autocomplete') }}" />

                    <input type="hidden" id="idUser" name="idUser" value="{{ auth()->user()->id }}">

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
@endsection
