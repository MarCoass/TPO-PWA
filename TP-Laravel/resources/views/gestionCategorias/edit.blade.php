<!-- edit.blade.php -->
@extends('layouts/layout')

@section('titulo')
    Editar Categoria
@endsection

@section('encabezado')
    Editar Categoria
@endsection

@section('librerias')

@endsection

@section('contenido')
    <h3>Editar Categoria #{{ $categoria->idCategoria }}</h3>
    <form class="row m-5" method="POST"  enctype="multipart/form-data" action="{{ route('update_categoria', ['id' => $categoria->idCategoria ]) }}">
        @csrf
        @method('PUT')
        <div class="col-lg-6 col-12 form-group form-floating mb-3">
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $categoria->nombre }}"
                placeholder="nombre" required="required" autofocus>
            <label for="floatingnombre">Nombre</label>
            @if ($errors->has('nombre'))
                <span class="text-danger text-left">{{ $errors->first('nombre') }}</span>
            @endif
        </div>


        <div class="col-lg-6 col-12 form-group form-floating mb-3">
            <input type="text" class="form-control" name="edadMax" value="{{ $categoria->edadMax }}" placeholder="edadMax"
                required="required" autofocus>
            <label for="floatingnombre mx-5">Edad Maxima</label>
            @if ($errors->has('edadMax'))
                <span class="text-danger text-left">{{ $errors->first('edadMax') }}</span>
            @endif
        </div>
        
        <div class="col-lg-6 col-12 form-group form-floating mb-3">
            <input type="text" class="form-control" name="edadMin" value="{{ $categoria->edadMin }}" placeholder="edadMin"
                required="required" autofocus>
            <label for="floatingnombre mx-5">Edad Minima</label>
            @if ($errors->has('edadMin'))
                <span class="text-danger text-left">{{ $errors->first('edadMin') }}</span>
            @endif
        </div>

        <div class="col-lg-6 col-12 form-group mb-3">
            <label for="genero" class="form-label">Genero</label>
            <select name="genero" id="genero" class="form-control" required>
                <option value="0" {{($categoria->genero == 0 ? 'selected' : '')}}>Masculino</option>
                <option value="1" {{($categoria->genero == 1 ? 'selected' : '')}}>Feminino</option>
            </select>
        </div>

        <div class="col-lg-6 col-12 form-group mb-3">
            <label for="esElite" class="form-label">Especialidad</label>
            <select name="esElite" id="esElite" class="form-control" required>
                <option value="0"  {{($categoria->esElite == 0 ? 'selected' : '')}}>Promocional</option>
                <option value="1"  {{($categoria->esElite == 1 ? 'selected' : '')}}>Elite</option>
            </select>
        </div>


        <div class="col-lg-12 col-12 button-group mb-3 d-flex justify-content-end align-items-center">
            <button type="submit" class="btn btn-outline-primary mx-2"><i class="bi bi-cloud-upload-fill me-2"></i>Guardar cambios</button>
            <button type="button" class="btn btn-outline-secondary" onclick="history.back()"><i class="bi bi-arrow-left me-2"></i>Volver</button>
        </div>

    </form>
@endsection
