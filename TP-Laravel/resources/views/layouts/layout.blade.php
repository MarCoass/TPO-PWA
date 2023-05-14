<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Poomsae Reconocido Individual Élite</title>

    <!-- ICON -->
    <link rel="icon" type="image\x-icon" href="{{ asset('images/logo.ico') }}">

    <!-- Bootstrap v5.2.3 -->
    <link rel="stylesheet" href="{{ asset('bootstrap-5.2.3/css/bootstrap.min.css') }}">

    <!-- Bootstrap Icons v1.10.4 -->
    <link rel="stylesheet" href="{{ asset('bootstrap-5.2.3/bootstrap-icons-1.10.4/bootstrap-icons.css') }}">

    <!-- una font digital para cronometro -->
    <link href="https://fonts.cdnfonts.com/css/digital-7-mono" rel="stylesheet">

    <!-- estilos propios -->
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">

    <!-- Datatable -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    


</head>

<body class="transicion">
    <!-- NAVBAR -->
    @include('includes.navbar')

    <main>
        <h1>@yield('encabezado')</h1>
        @yield('contenido')
    </main>

    <!-- FOOTER -->
    @include('includes.footer')

    <script src="{{ asset('bootstrap-5.2.3/js/bootstrap.bundle.min.js') }}"></script>
    <script type="module" src="{{ asset('js/index_dom.js') }}"></script>
    <script type="module" src="{{ asset('js/tablaCompetidores.js') }}"></script>


</body>

</html>
