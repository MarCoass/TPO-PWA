<!doctype html>
<html lang="es">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Pagina principal, que no es</title>

    <!-- esta deberia ser la plantilla principal del home -->

    <!-- Bootstrap core CSS -->
    <link href="{!! url('assets/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="{!! url('assets/css/app.css') !!}" rel="stylesheet">
</head>
<body>
    <!-- este deberia ser el navbar -->
    @include('layouts.partials.navbar')

    <main class="container">
        @yield('content')
    </main>


    <script src="{!! url('assets/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
      
  </body>
</html>