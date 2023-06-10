<!-- index.blade.php -->
@extends('layouts/layout')

@section('titulo')
Asignar Poomse a Competidor
@endsection

@section('encabezado')
Asignar Poomse a Competidor
@endsection

@section('contenido')
<!-- despliega mensajes -->
@include('layouts.partials.messages')

@section('contenido')
<h3>Asignar Poomse a Competidor {{$competidor[0]->nombre}} {{$competidor[0]->apellido}} </h3>
 <form class="m-5 row" method="post" action="{{ route('store_asignar_poomsae') }}">

            <!-- vvvv - ver que es esto - vvvv -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        
        <input type="hidden" name="id_competencia_competidor", id="id_competencia_competidor" value="{{$competencia_competidor[0]->idCompetenciaCompetidor}}">
        <!-- vvvv - ver que es esto - vvvv -->
        <h3>Poomsae de Pasada uno</h3>

        <div class="col-lg-6 col-12 form-group mb-3">
            <label for="poomsae_uno" class="form-label">Poomsae</label>
            <select name="poomsae_uno" id="poomsae_uno" class="form-select form-control" required>
                @foreach ($poomsae as $row)
                    <option value="{{ $row->idPoomsae }}">{{ $row->nombre }}</option>
                @endforeach
            </select>
     
        </div>

        <h3>Poomsae de Pasada Dos</h3>

        <div class="col-lg-6 col-12 form-group mb-3">
            <label for="poomsae_dos" class="form-label">Poomsae</label>
            <select name="poomsae_dos" id="poomsae_dos" class="form-control" required>
                @foreach ($poomsae as $row)
                <option value="{{ $row->idPoomsae }}">{{ $row->nombre }}</option>
                @endforeach
             </select>
        </div>

        <div class="col-lg-12 col-12 button-group mb-3 d-flex justify-content-end align-items-center">
            <button class="btn btn-outline-primary mx-2" type="submit">Guardar</button>
            <button type="button" class="btn btn-outline-secondary" onclick="history.back()">Volver</button>
        </div>


    </form>
@endsection