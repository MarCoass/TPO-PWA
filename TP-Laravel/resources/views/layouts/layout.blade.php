<!DOCTYPE html>
<html lang="es">
<head>
    <title>@yield('titulo', 'NeuPoom')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- ICON -->
    <link rel="icon" type="image\x-icon" href="{{ asset('images/logo.png') }}">

    <!-- Bootstrap v5.2.3 -->
    <link rel="stylesheet" href="{{ asset('bootstrap-5.2.3/css/bootstrap.min.css') }}">
    <script src="{{ asset('bootstrap-5.2.3/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Bootstrap Icons v1.10.4 -->
    <link rel="stylesheet" href="{{ asset('bootstrap-5.2.3/bootstrap-icons-1.10.4/bootstrap-icons.css') }}">

    {{-- Jquery --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    {{--     <!-- Jquery UI -->
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/start/jquery-ui.css" rel="stylesheet" />

    <!-- Datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
 --}}
 
    @yield('librerias')

    <!-- estilos propios -->
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cards.css') }}">
    <link rel="stylesheet" href="{{ asset('css/puntuador.css') }}">

    
    {{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script> 
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script> --}}
    
    <!-- index dom -->
    <script type="module" src="{{ asset('js/index_dom.js') }}"></script>
</head>

<body class="transicion" >

    <div id="wrapper">
        <!-- NAVBAR -->
        @include('layouts.partials.navbar')

        <main class="justify-content-center container-fluid p-3">
            <h1 class="display-5 text-center">@yield('encabezado')</h1>
            @yield('contenido')
        </main>

        @auth
        <script src="{{ asset('js/notificaciones.js') }}"></script>
        @endauth

        <!-- FOOTER -->
        @include('layouts.partials.footer')
    </div>
    @yield('scripts')
</body>

</html>
