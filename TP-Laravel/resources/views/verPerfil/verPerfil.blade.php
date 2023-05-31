@extends('layouts/layout')

@section('titulo')
    Perfil
@endsection

@section('contenido')

@include('layouts.partials.messages')

@auth


    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
              class="rounded-circle img-fluid" style="width: 150px;">
            <h5 class="my-3">{{auth()->user()->usuario}}</h5>         
            <p class="text-muted mb-1">{{auth()->user()->escuela->nombre}}</p>
            <p class="text-muted mb-4"> {{auth()->user()->rol->nombreRol}} </p>
            <div class="d-flex justify-content-center mb-2">
              <button type="button" class="btn btn-primary">Follow</button>
              <button type="button" class="btn btn-outline-primary ms-1">Message</button>
            </div>
          </div>
        </div>
        <div class="card mb-4 mb-lg-0">
          <div class="card-body p-0">
            <ul class="list-group list-group-flush rounded-3">
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fas fa-globe fa-lg text-warning"></i>
                <p class="mb-0">https://mdbootstrap.com</p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-github fa-lg" style="color: #333333;"></i>
                <p class="mb-0">mdbootstrap</p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                <p class="mb-0">@mdbootstrap</p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                <p class="mb-0">mdbootstrap</p>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                <p class="mb-0">mdbootstrap</p>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Nombre Completo</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{auth()->user()->nombre}} {{auth()->user()->apellido}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{auth()->user()->correo}}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Nombre de Usuario</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{auth()->user()->usuario}}</p>
              </div>
            </div>
           
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="card mb-4 mb-md-0">
              <div class="card-body">
                <p class="mb-4"><span class="text-primary font-italic me-1">Editar</span>Datos Personales
                </p>

                <form  method="post" action="{{ route('actualizarDatosPersonales') }}">

                  @csrf
                  <input type="text" name="id" value="{{auth()->user()->id}}" hidden>
                <p class="mb-1" style="font-size: .77rem;">Nombre</p>
                <div class="input-group mb-3">
                  <input type="text" name="nombre" class="form-control" value="{{auth()->user()->nombre}}" aria-label="Nombre" aria-describedby="basic-addon1" required>
                </div>

                <p class="mt-4 mb-1" style="font-size: .77rem;">Apellido</p>
                <div class="input-group mb-3">
                  <input type="text" name="apellido" class="form-control" value="{{auth()->user()->apellido}}" aria-label="Apellido" aria-describedby="basic-addon1" required>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">Nombre de Usuario</p>
                <div class="input-group mb-3">
                  <input type="text" name="usuario" class="form-control" value="{{auth()->user()->usuario}}" aria-label="usuario" aria-describedby="basic-addon1" required>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">Email</p>
                <div class="input-group mb-3">
                  <input type="email" name="correo" class="form-control" value="{{auth()->user()->correo}}" aria-label="Email" aria-describedby="basic-addon1" required>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">Contraseña</p>
                <div class="input-group mb-3">
                  <input type="password" name="password" class="form-control" placeholder="Confirmar contraseña" aria-label="contraseña" aria-describedby="basic-addon1" required>
                </div>

                  <button class="btn btn-outline-primary" type="submit"> Actualizar </button>

              </div> 
            </div>
          </div>
        </form>
          <div class="col-md-6">
            <div class="card mb-4 mb-md-0">
              <div class="card-body">
                <p class="mb-4"><span class="text-primary font-italic me-1">Actualizar</span>Contraseña
                </p>

                <form  method="post" action="{{ route('actualizarPassword') }}">

                  @csrf
                  <input type="text" name="id" value="{{auth()->user()->id}}" hidden>
                <p class="mt-4 mb-1" style="font-size: .77rem;">Contraseña actual</p>
                <div class="input-group mb-3">
                  <input type="password" name="passwordactual" class="form-control" aria-label="contraseña" aria-describedby="basic-addon1" required>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">Contraseña nueva</p>
                <div class="input-group mb-3">
                  <input type="password" name="passwordnueva" class="form-control" aria-label="contraseña" aria-describedby="basic-addon1" required>
                </div>
                <p class="mt-4 mb-1" style="font-size: .77rem;">Confirmar contraseña nueva</p>
                <div class="input-group mb-3">
                  <input type="password" name="passwordnueva2" class="form-control" aria-label="contraseña" aria-describedby="basic-addon1" required>
                </div>

                  <button class="btn btn-outline-primary" type="submit"> Actualizar </button>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endauth
@endsection