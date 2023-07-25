@extends('layouts/layout')

@section('titulo')
    Crear Relacion con Poomsae
@endsection

@section('encabezado')
    Crear Relacion con Poomsae
@endsection

@section('librerias')

@endsection

@section('contenido')
    <form class="m-5 row" method="post" action="{{ route('store_categoria_poomsae')}} " enctype="multipart/form-data">

        <!-- vvvv - ver que es esto - vvvv -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="hidden" name="idCategoria" id="idCategoria" value="{{$idCategoria}}">
        <div class="col-lg-6 col-12 form-group mb-3">
            <label for="poomsae" class="form-label">Poomsae</label>
            <select name="poomsae" id="poomsae" class="form-control" required>
                @foreach($poomsae as $row)
            
                <option value="{{$row->idPoomsae}}">{{$row->nombre}}</option>
       
                @endforeach
            </select>
        </div>

        <div class="col-lg-12 col-12 button-group mb-3 d-flex justify-content-end align-items-center">
            <button class="btn btn-outline-primary mx-2" type="submit">Guardar</button>
            <button type="button" class="btn btn-outline-secondary" onclick="history.back()">Volver</button>
        </div>
    </form>
@endsection
