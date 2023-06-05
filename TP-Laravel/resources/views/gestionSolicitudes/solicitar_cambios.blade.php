@extends('layouts/layout')

@section('titulo')
Solicitar cambios
@endsection

@section('encabezado')
Solicitar cambios
@endsection

@section('contenido')
<!-- despliega mensajes -->
@include('layouts.partials.messages')


@if (auth()->user()->id == $idSolicitante)

<div class="card shadow">
    <div class="card-body text-center">
        <div class="row">
            <h3 class="text-decoration-underline mb-4">Solicitar cambio de escuela.</h3>
            <div class="col-6">
                <h4>Su escuela actual:</h4>
                <p class="text-success mt-3"><b>{{ auth()->user()->escuela->nombre }}</b></p>
            </div>
            <div class="col-6">
                <h4>Seleccione la escuela a la que desea cambiar:</h4>
                <div class="form-group">
                    <select name="newEscuela" id="newEscuela" class="form-select" required>
                        @if(!isset($escuelas) || empty($escuelas))
                        <option value="" selected>No hay escuelas cargadas. Contactar administrador.</option>
                        @else
                        <option value="0" selected>No cambiar de escuela.</option>
                        @foreach($escuelas as $escuela)
                        <option value="{{ $escuela->idEscuela }}">{{ $escuela->nombre }}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
            </div>

            {{-- condicional para no permitir cambio de graduacion a jueces --}}
            @if (auth()->user()->idRol != 2)
            <hr class="col-10 offset-1 my-3">
            <h3 class="text-decoration-underline mb-4">Solicitar cambio de graduación.</h3>
            @if ( $competidor == null )
            <input type="hidden" id="newGraduacion" name="newGraduacion" value="0">
            <p class="text-secondary">Para aplicar el cambio, es necesario que te registres como competidor primero.</p>
            @else
            <div class="col-6">
                <h4>Su graduacion actual es:</h4>
                <p class="text-success mt-3"><b>{{ $competidor->graduacion->nombre}} - {{ $competidor->graduacion->color}}</b></p>
            </div>
            <div class="col-6">
                <h4>Seleccione la graduacion a la que necesita actualizar:</h4>
                <div class="form-group">
                    <select class="form-control validar" id="newGraduacion" name="newGraduacion" required>
                        <option value="" disabled selected data-error="Por favor seleccione una graduacion válida">Selecciona una graduación.</option>
                        <option value="0" selected>No cambiar de graduación.</option>
                        @foreach ($graduaciones as $row)
                        @if ($row->idGraduacion > $competidor->idGraduacion)
                        <option value="{{$row->idGraduacion}}">{{$row->nombre}} - {{$row->color}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>
            @endif
            @else
            <input type="hidden" name="newGraduacion" id="newGraduacion" value="0">
            @endif

            <div class="col-6 offset-3 my-3 d-flex justify-content-center align-items-center">
                <a class="w-50 btn btn-outline-secondary mt-3 me-2" href="{{ asset('/verPerfil')}}"><i class="bi bi-arrow-left me-2"></i>Volver a Mi Perfil</a>
                <button type="submit" class="w-50 btn btn-outline-primary mt-3"> <i class="bi bi-send me-2"></i>Generar solicitud</button>
            </div>
        </div>
    </div>
</div>

<h2 class="">Solicitar cambiar de escuela</h2>

<form method="POST" action="{{ route('generar_solicitud') }}">
    @csrf
    <input type="hidden" name="idUser" id="idUser" value="{{ auth()->user()->id }}">

    <h3>Su escuela actual:</h3>

    <p class="text-info"><b>{{ auth()->user()->escuela->nombre }}</b></p>
    <h3>Seleccione la escuela a la que desea cambiar</h3>
    <div class="form-group form-floating col-lg-6 col-12 mb-3">
        <select name="newEscuela" id="newEscuela" class="form-select" required>
            @if(!isset($escuelas) || empty($escuelas))
            <option value="" selected>No hay escuelas cargadas. Contactar administrador.</option>
            @else
            <option value="0" selected>No cambiar de escuela</option>
            @foreach($escuelas as $escuela)
            <option value="{{ $escuela->idEscuela }}">{{ $escuela->nombre }}</option>
            @endforeach
            @endif
        </select>
        <label for="floatingSelect" class="mx-2">Seleccionar escuela</label>
    </div>

    {{-- condicional para no permitir cambio de graduacion a jueces --}}
    @if (auth()->user()->idRol != 2)
    <hr>
    <h2>Solicitar cambiar de graduacion</h2>
    @if ( $competidor == null )
    <input type="hidden" id="newGraduacion" name="newGraduacion" value="0">
    <h3>aun no te has registrado como competidor para generar cambio alguno</h3>
    @else
    <h3>Su graduacion actual es: </h3>
    <p class="text-info"><b>{{ $competidor->graduacion->nombre}} - {{ $competidor->graduacion->color}}</b></p>
    <h3>Seleccione la graduacion que necesita actualizar</h3>
    <div class="form-group form-floating col-lg-6 col-12 mb-3">
        <select class="form-control validar" id="newGraduacion" name="newGraduacion" required>
            <option value="" disabled selected data-error="Por favor seleccione una graduacion válida">Selecciona una graduación.</option>
            <option value="0" selected>No pedir cambio de graduacion</option>
            @foreach ($graduaciones as $row)
            @if ($row->idGraduacion > $competidor->idGraduacion)
            <option value="{{$row->idGraduacion}}">{{$row->nombre}} - {{$row->color}}</option>
            @endif
            @endforeach
        </select>
        <label for="floatingSelect" class="mx-2">Graduacion:</label>
    </div>
    @endif
    @else
    <input type="hidden" name="newGraduacion" id="newGraduacion" value="0">
    @endif

    <a class="w-50 btn btn-outline-secondary mt-3" href="{{ asset('/')}}"><i class="bi bi-arrow-left me-2"></i>Volver al inicio</a>
    <button type="submit" class="w-50 btn btn-primary mt-3"> <i class="bi bi-send me-2"></i> Generar solicitud</button>
</form>

@else
<h2>Ud. no puede solicitar cambios para otro usuario</h2>
@endif


@endsection