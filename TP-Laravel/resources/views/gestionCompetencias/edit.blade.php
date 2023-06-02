<!-- edit.blade.php -->
@extends('layouts/layout')

@section('titulo')
    Editar Competencia
@endsection

@section('encabezado')
    Editar Competencia
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
            <label for="floatingName">fecha</label>
            @if ($errors->has('fecha'))
                <span class="text-danger text-left">{{ $errors->first('fecha') }}</span>
            @endif
        </div>

        @if($competencia->estadoJueces == false)
            <div class="col-lg-6 col-12 form-group mb-3">
                <label for="cantidadJueces" class="form-label">Cantidad de Jueces</label>
                <select name="cantidadJueces" id="cantidadJueces" class="form-control" required>
                    @for($i = 3; $i <= 7; $i = $i+2)
                        @if($i == $competencia->cantidadJueces)
                            <option value="{{$i}}" selected>{{$i}}</option>
                        @else
                            <option value="{{$i}}">{{$i}}</option>
                        @endif
                    @endfor
                </select>
            </div>
        @endif

        <div class="col-lg-6 col-12 form-group mb-3">
            <label for="formFile" class="form-label">Seleccione el flyer</label>
            <input class="form-control" type="file" name="flyer" id="flyer">
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
