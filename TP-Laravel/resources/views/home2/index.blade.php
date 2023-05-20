<!-- este appmaster deberia ser la plantilla layout -->

@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-5 rounded">

    <!-- despliega mensaje cuando se crea la cuenta -->
    @include('layouts.partials.messages')

<!-- aca se vuelven a ver los grupos -->

        @auth
        <h1>Logueado</h1>
        <p class="lead">esto se muestra porque estas logueado.</p>
        <a class="btn btn-lg btn-primary" href="#" role="button">No hace nada</a>
        @endauth

        @guest
        <h1>No logueado</h1>
        <p class="lead">esto se muestra porque no estas logueado.</p>
        @endguest
    </div>
@endsection