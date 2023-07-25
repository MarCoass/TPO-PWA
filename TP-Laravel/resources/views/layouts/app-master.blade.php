<!doctype html>
<html lang="es">
<head>
    <title>@yield('titulo', 'NeuPoom')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- agrega el elemento meta con el token CSRF -->
    
    <!-- ICON -->
    <link rel="icon" type="image\x-icon" href="{{ asset('images/logo.png') }}">

    <!-- Bootstrap v5.2.3 -->
    {{-- <link rel="stylesheet" href="{{ asset('bootstrap-5.2.3/css/bootstrap.min.css') }}"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Bootstrap Icons v1.10.4 -->
    {{-- <link rel="stylesheet" href="{{ asset('bootstrap-5.2.3/bootstrap-icons-1.10.4/bootstrap-icons.css') }}"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <!-- estilos propios -->
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cards.css') }}">
    <link rel="stylesheet" href="{{ asset('css/calendario.css') }}">
    
    <!-- index dom -->
    <script type="module" src="{{ asset('js/index_dom.js') }}"></script>    
    
    <!-- librerias -->
    @yield('librerias')
    

</head>
<body class="transicion">

    @include('layouts.partials.navbar')

    <main class="container-fluid my-4">
        <h1 class="display-5 text-center">@yield('encabezado')</h1>
        @yield('contenido')
    </main>

    @include('layouts.partials.footer')


    @auth
    <script src="{{ asset('js/notificaciones.js') }}"></script>
    @endauth

    @yield('scripts')
  </body>
</html>
