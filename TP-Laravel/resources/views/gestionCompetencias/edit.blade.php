<!-- edit.blade.php -->
@extends('layouts/layout')

@section('titulo')
    Editar Competencia
@endsection

@section('encabezado')
    Editar Competencia
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
    <h3>Editar Competencia #{{ $competencia->idCompetencia }}</h3>
    <form class="row m-5" method="POST"  enctype="multipart/form-data" action="{{ route('update_competencia', ['id' => $competencia->idCompetencia ]) }}">
        @csrf
        @method('PUT')
        <div class="col-lg-6 col-12 form-group form-floating mb-3">
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $competencia->nombre }}"
                placeholder="nombre" required="required" autofocus>
            <label for="floatingnombre">Nombre</label>
            @if ($errors->has('nombre'))
                <span class="text-danger text-left">{{ $errors->first('nombre') }}</span>
            @endif
        </div>

        <div class="col-lg-6 col-12 form-group form-floating mb-3">
            <input type="date" class="form-control" name="fecha" id="fecha" value="{{ $competencia->fecha }}"
                placeholder="fecha" required="required" autofocus>
            <label for="floatingName">Fecha Competencia</label>
            @if ($errors->has('fecha'))
                <span class="text-danger text-left">{{ $errors->first('fecha') }}</span>
            @endif
        </div>


        <div class="col-lg-6 col-12 form-group form-floating mb-3">
            <input type="date" class="form-control" name="fechaCierra" id="fechaCierra" value="{{ $competencia->fechaCierra }}"
                placeholder="fecha Limite" required="required" autofocus>
            <label for="floatingName">Fecha limite de inscripcion</label>
            @if ($errors->has('fechaCierra'))
                <span class="text-danger text-left">{{ $errors->first('fechaCierra') }}</span>
            @endif
        </div>

        @if($competencia->estadoJueces == false && count($juecesAceptados) == 0)
            <div class="col-lg-6 col-12 form-group mb-3 row align-items-between">
                <label for="cantidadJueces" class="form-label">Cantidad de jueces mínima</label>
                    @for($i = 3; $i <= 7; $i = $i+2)
                    <div class="col-2">
                        @if($i == $competencia->cantidadJueces)
                        <input class="form-check-input validar" type="radio" name="cantidadJueces" value="{{$i}}" id="radio{{$i}}"
                    checked>
                        <label class="form-check-label" for="radio{{$i}}">
                            {{$i}}
                        </label>
                        @else
                            <input class="form-check-input validar" type="radio" name="cantidadJueces" value="{{$i}}" id="radio{{$i}}">
                        <label class="form-check-label" for="radio{{$i}}">
                            {{$i}}
                        </label>
                        @endif
                    </div>
                    @endfor
                </select>
            </div>
        @endif

        <div class="col-lg-6 col-12 form-group mb-3">
            <label for="formFile" class="form-label">Seleccione el flyer</label>
            <input class="form-control" accept=".jpg,.png,.jpeg" type="file" name="flyer" id="flyer">
        </div>

        <div class="col-lg-6 col-12 form-group mb-3" >
            <label for="formFile" class="form-label">Seleccione las bases</label>
            <input class="form-control" type="file" name="bases" id="bases" accept="application/pdf">
        </div>

        <div class="col-lg-6 col-12 form-group mb-3">
            <label for="formFile" class="form-label">Seleccione la invitacion</label>
            <input class="form-control" type="file" name="invitacion" id="invitacion" accept="application/pdf">
        </div>

        <div class="col-lg-12 col-12 button-group mb-3 d-flex justify-content-end align-items-center">
            <button type="submit" class="btn btn-outline-primary mx-2"><i class="bi bi-cloud-upload-fill me-2"></i>Guardar cambios</button>
            <button type="button" class="btn btn-outline-secondary" onclick="history.back()"><i class="bi bi-arrow-left me-2"></i>Volver</button>
        </div>

    </form>
@endsection
