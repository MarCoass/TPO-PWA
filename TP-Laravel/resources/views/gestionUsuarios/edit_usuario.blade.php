<!-- edit.blade.php -->
@extends('layouts/layout')

@section('titulo')
    Editar Usuario
@endsection

@section('encabezado')
    Editar Usuario
@endsection

@section('contenido')
    <h3>Editar usuario #{{ $usuario->id }}</h3>
    <form class="row m-5" method="POST" action="{{ route('update_usuario', ['id' => $usuario->id]) }}">
        @csrf
        @method('PUT')
                
        <div class="col-lg-6 col-12 form-group form-floating mb-3">
            <input type="text" class="form-control" name="nombre"  placeholder="nombre" required="required" value="{{ $usuario->nombre }}" autofocus>
            <label for="floatingnombre" class="mx-2">Nombre</label>
            @if ($errors->has('nombre'))
                <span class="text-danger text-left">{{ $errors->first('nombre') }}</span>
            @endif
        </div>

        <div class="col-lg-6 col-12 form-group form-floating mb-3">
            <input type="text" class="form-control" name="apellido"  placeholder="apellido" required="required" value="{{ $usuario->apellido }}"  autofocus>
            <label for="floatingName" class="mx-2">Apellido</label>
            @if ($errors->has('apellido'))
                <span class="text-danger text-left">{{ $errors->first('apellido') }}</span>
            @endif
        </div>

        <div class="col-lg-6 col-12 form-group form-floating mb-3">
            <input type="email" class="form-control" name="correo"  placeholder="name@example.com" required="required" value="{{ $usuario->correo }}" autofocus>
            <label for="floatingcorreo" class="mx-2">Correo</label>
            @if ($errors->has('correo'))
                <span class="text-danger text-left">{{ $errors->first('correo') }}</span>
            @endif
        </div>

        <div class="col-lg-6 col-12 form-group form-floating mb-3">
            <input type="text" class="form-control" name="usuario"  placeholder="usuario" required="required" value="{{ $usuario->usuario }}" autofocus>
            <label for="floatingName" class="mx-2">Usuario</label>
            @if ($errors->has('usuario'))
                <span class="text-danger text-left">{{ $errors->first('usuario') }}</span>
            @endif
        </div>

        <div class="col-lg-6 col-12 form-group form-floating mb-3">
            <select name="rol" id="rol" class="form-control" required value="{{ $usuario->idRol }}">
                @if(!isset($roles) || empty($roles))
                    <option value="" selected>No hay roles cargados. Contactar administrador.</option>
                @else
                    @foreach($roles as $rol)
                        @if($rol->id == $usuario->idRol)
                            <option value="{{ $rol->id }}" selected>{{ $rol->nombreRol }}</option>
                        @else
                            <option value="{{ $rol->id }}">{{ $rol->nombreRol }}</option>
                        @endif
                    @endforeach
                @endif
            </select>
            <label for="floatingSelect" class="mx-2">Rol</label>
        </div>

        <div class="form-group form-floating col-lg-6 col-12 mb-3">
            <select name="idEscuela" id="idEscuela" class="form-select" required {{ ($usuario->idRol == 1) ? 'disabled' : '' }}>
                @if(!isset($escuelas) || empty($escuelas))
                    <option value="" selected>No hay escuelas cargadas. Contactar administrador.</option>
                @else
                    <option value="" selected></option>
                    @foreach($escuelas as $escuela)
                        @if($escuela->idEscuela == $usuario->idEscuela)
                            <option value="{{ $escuela->idEscuela }}" selected>{{ $escuela->nombre }}</option>
                        @else
                            <option value="{{ $escuela->idEscuela }}">{{ $escuela->nombre }}</option>
                        @endif
                    @endforeach
                @endif
            </select>
            <label for="floatingSelect" class="mx-2">Seleccionar escuela</label>
            @if ($errors->has('idEscuela'))
                <span class="text-danger text-left">{{ $errors->first('idEscuela') }}</span>
            @endif
        </div>




        <div class="col-12 button-group mb-3 d-flex justify-content-end align-items-center">
            <button type="submit" class="btn btn-outline-primary mx-2"><i class="bi bi-cloud-upload-fill me-2"></i>Guardar cambios</button>
            <button type="button" class="btn btn-outline-secondary" onclick="history.back()"><i class="bi bi-arrow-left me-2"></i>Volver</button>
        </div>

    </form>

    <script src="{{ asset('js/createUsuario.js') }}"></script>
@endsection
