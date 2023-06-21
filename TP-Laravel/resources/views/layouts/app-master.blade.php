<!doctype html>
<html lang="es">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <!-- otros elementos del head -->
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- agrega el elemento meta con el token CSRF -->
    <title>@yield('titulo', 'NeuPoom')</title>

    <!-- ICON -->
    <link rel="icon" type="image\x-icon" href="{{ asset('images/logo.ico') }}">

    <!-- esta deberia ser la plantilla principal del home -->
    <!-- Bootstrap v5.2.3 -->
    <link rel="stylesheet" href="{{ asset('bootstrap-5.2.3/css/bootstrap.min.css') }}">

    <!-- Bootstrap Icons v1.10.4 -->
    <link rel="stylesheet" href="{{ asset('bootstrap-5.2.3/bootstrap-icons-1.10.4/bootstrap-icons.css') }}">

    <!-- una font digital para cronometro -->
    <link href="https://fonts.cdnfonts.com/css/digital-7-mono" rel="stylesheet">

    <!-- Datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">

    <!-- estilos propios -->
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cards.css') }}">
</head>
<body class="transicion">
    <!-- este deberia ser el navbar -->
    @include('layouts.partials.navbar')

    <main class="container-fluid my-4">
        <h1 class="display-5 text-center">@yield('encabezado')</h1>
        @yield('contenido')
    </main>

    @include('layouts.partials.footer')


    @auth
    <script src="{{ asset('js/notificaciones.js') }}"></script>
    @endauth
        <!-- librerias -->
        <script src="{{ asset('bootstrap-5.2.3/js/bootstrap.bundle.min.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>


        <!-- index dom -->
        <script type="module" src="{{ asset('js/index_dom.js') }}"></script>


  </body>
</html>
