<!doctype html>
<html lang="es">

<!-- PLANTILLA EN LA QUE SE VERA EN LOGIN Y REGISTRO -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>@yield('titulo', 'Poomsae Reconocido Individual Élite')</title>

    <!-- Bootstrap core CSS -->
    <!-- ICON -->
    <link rel="icon" type="image\x-icon" href="{{ asset('images/logo.ico') }}">
        <!-- Bootstrap Icons v1.10.4 -->
    <link rel="stylesheet" href="{{ asset('bootstrap-5.2.3/bootstrap-icons-1.10.4/bootstrap-icons.css') }}">
    
    <link href="{!! url('bootstrap-5.2.3/css/bootstrap.min.css') !!}" rel="stylesheet">
    <link href="{!! url('css/signin.css') !!}" rel="stylesheet">
    <link href="{!! url('css/registro.css') !!}" rel="stylesheet">

    
</head>
<body class="text-center">
    
    <main class="form-signin">

        @yield('contenido')
        
    </main>
    

</body>
</html>