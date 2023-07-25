@extends('layouts/layout')

@section('titulo')
    Crear Relacion con Graduacion
@endsection

@section('encabezado')
    Crear Relacion con Graduacion
@endsection

@section('librerias')

@endsection

@section('contenido')
    <form class="m-5 row" method="post" action="{{ route('store_categoria_graduacion')}} " enctype="multipart/form-data">

        <!-- vvvv - ver que es esto - vvvv -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="hidden" name="idCategoria" id="idCategoria" value="{{$idCategoria}}">
        <div class="col-lg-6 col-12 form-group mb-3">
            <label for="graduacion" class="form-label">Graduacion</label>
            <select name="graduacion" id="graduacion" class="form-control" required>
                @foreach($graduaciones as $row)
            
                <option value="{{$row->idGraduacion}}">{{$row->nombre}}</option>
       
                @endforeach
            </select>
        </div>

        <div class="col-lg-12 col-12 button-group mb-3 d-flex justify-content-end align-items-center">
            <button class="btn btn-outline-primary mx-2" type="submit">Guardar</button>
            <button type="button" class="btn btn-outline-secondary" onclick="history.back()">Volver</button>
        </div>
    </form>
@endsection
