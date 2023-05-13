<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield('titulo', 'Home')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <header class="d-flex justify-content-center py-3">
          <ul class="nav nav-pills">
            <li class="nav-item"><a href="/" class="nav-link ">Home</a></li>
            <li class="nav-item"><a href="/cronometro" class="nav-link">Cronometro</a></li>
            <li class="nav-item"><a href="/video" class="nav-link">Video</a></li>
            <li class="nav-item"><a href="/tablaCompetidores" class="nav-link">Competidores</a></li>
            <li class="nav-item"><a href="/imagenesRandom" class="nav-link">Imagenes</a></li>
          </ul>
        </header>
      </div>

    <h1> @yield('encabezado')</h1>
    <div>@yield('contenido')</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>