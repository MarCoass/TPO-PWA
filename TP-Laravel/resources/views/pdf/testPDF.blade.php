<!DOCTYPE html>
<html>
<head>
    <title>Laravel 9 Generate PDF From View</title>
</head>
<body>
@php
    setlocale(LC_TIME, 'es_ES');
    \Carbon\Carbon::setLocale('es');
@endphp


    <h1>{{ $title }}</h1>
    <p>Competencia: {{ $nombreCompetencia }} </p>
    <p>Sorteo de poomsae: {{ \Carbon\Carbon::parse($sorteoPoomsae)->formatLocalized('%d de %B del %Y') }} </p>
    <p>Escuela: {{ $escuela->nombre }}</p>
    <p>Instructor: {{ $escuela->nombreApellidoInstructor }}</p>
    <table style="border: 1px solid black; width:90%;">
        <thead style="border-bottom: 1px solid black;"">
            <tr>
                <td >
                    GAL
                </td>
                <td >
                    DU
                </td>
                <td>
                    Competidor
                </td>
                <td>
                    Categoria
                </td>
                <td>
                    Graduacion
                </td>
                <td>
                    Solicita <br> cambios
                </td>
            </tr>
        </thead>
        <tbody>
            @foreach ($competidoresComp as $competidorComp)
            <tr>
                <td>
                    {{$competidorComp->competidor->gal}}
                </td>
                <td>
                    {{$competidorComp->competidor->du}}
                </td>
                <td>
                    {{$competidorComp->competidor->nombre . " " .$competidorComp->competidor->apellido}}
                </td>
                <td>
                    {{$competidorComp->categoria->nombre}}
                </td>
                <td>
                    {{$competidorComp->competidor->graduacion->nombre}} <br> {{$competidorComp->competidor->graduacion->color}}
                </td>
                <td>
                    {{ $competidorComp->tieneSolicitud ? "si" : "no"; }}
                </td>
            </tr> 
            @endforeach
        </tbody>
    </table>
</body>
</html>