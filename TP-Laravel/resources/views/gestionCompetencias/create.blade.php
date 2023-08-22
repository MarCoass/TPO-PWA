@extends('layouts/layout')

@section('titulo')
    Crear Competencia
@endsection

@section('encabezado')
    Crear Competencia
@endsection

@section('librerias')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
@endsection

@section('scripts')
    <script>
        function validarFechas() {
            var fecha = document.getElementById("fecha").value;
            var fechaCierra = document.getElementById("fechaCierra").value;
            var fechaCompetencia = moment(fecha);
            var fechaLimite = moment(fechaCierra);
            var diferencia = fechaCompetencia.diff(fechaLimite, "days");
            if (diferencia < 2) {
                alert("La fecha de competencia debe ser al menos dos días después de la fecha de cierre");
                $('#fechaCierra').val("")
                return false;
            }
            return true;
        }

        $('#fechaCierra').on('change', function() {
            if (!validarFechas()) {
                /* $('#fechaCierra').val(""); */
            }
        })

        $('#fecha').on('change', function() {
            if (!validarFechas()) {
                /*  $('#fecha').val(""); */
            }
        })
    </script>
@endsection

@section('contenido')
    <form class="m-5 row" method="post" action="{{ route('store_competencia') }} " enctype="multipart/form-data">

        <!-- vvvv - ver que es esto - vvvv -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        <div class="col-lg-6 col-12 form-group form-floating mb-3">
            <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" placeholder="nombre"
                required="required" autofocus>
            <label for="floatingnombre mx-5">Nombre</label>
            @if ($errors->has('nombre'))
                <span class="text-danger text-left">{{ $errors->first('nombre') }}</span>
            @endif
        </div>

        <div class="col-lg-6 col-12 form-group form-floating mb-3">
            <input type="date" class="form-control" name="fecha" id="fecha" value="{{ old('fecha') }}"
                placeholder="fecha" required="required" autofocus>
            <label for="floatingName">Fecha Competencia</label>
            @if ($errors->has('fecha'))
                <span class="text-danger text-left">{{ $errors->first('fecha') }}</span>
            @endif
        </div>


        <div class="col-lg-6 col-12 form-group form-floating mb-3">
            <input type="date" class="form-control" name="fechaCierra" id="fechaCierra" value="{{ old('fechaCierra') }}"
                placeholder="fecha Limite" required="required" autofocus>
            <label for="floatingName">Fecha limite de inscripcion</label>
            @if ($errors->has('fechaCierra'))
                <span class="text-danger text-left">{{ $errors->first('fechaCierra') }}</span>
            @endif
        </div>


        <div class="col-lg-6 col-12 form-group mb-3 row align-items-between">
            <label class="form-label" for="cantidadJueces">Cantidad de jueces:</label>
            <div class="col-2">
                <input class="form-check-input validar" type="radio" name="cantidadJueces" value="3" id="radio3"
                    checked>
                <label class="form-check-label" for="radio3">
                    3
                </label>
            </div>
            <div class="col-2">
                <input class="form-check-input validar" type="radio" name="cantidadJueces" value="5" id="radio5">
                <label class="form-check-label" for="radio5">
                    5
                </label>
            </div>
            <div class="col-2">
                <input class="form-check-input validar" type="radio" name="cantidadJueces" value="7" id="radio7">
                <label class="form-check-label" for="radio7">
                    7
                </label>
            </div>

                <div class="valid-feedback">
                    ¡Correcto!
                </div>
                <div class="invalid-feedback">Seleccione una opcion valida.</div>
        </div>

        <div class="col-lg-6 col-12 form-group mb-3">
            <label for="formFile" class="form-label">Seleccione el flyer</label>
            <input class="form-control" accept=".jpg,.png,.jpeg" type="file" name="flyer" id="flyer">
        </div>

        <div class="col-lg-6 col-12 form-group mb-3">
            <label for="formFile" class="form-label">Seleccione las bases</label>
            <input class="form-control" type="file" name="bases" id="bases" accept="application/pdf">
        </div>

        <div class="col-lg-6 col-12 form-group mb-3">
            <label for="formFile" class="form-label">Seleccione la invitacion</label>
            <input class="form-control" type="file" name="invitacion" id="invitacion" accept="application/pdf">
        </div>

        <div class="col-lg-12 col-12 button-group mb-3 d-flex justify-content-end align-items-center">
            <button class="btn btn-outline-primary mx-2" type="submit">Guardar</button>
            <button type="button" class="btn btn-outline-secondary" onclick="history.back()">Volver</button>
        </div>


    </form>
@endsection
