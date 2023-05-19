<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Middleware\RolMiddleware;
//use Illuminate\Contracts\Auth\Authenticatable;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\CompetidorController;

Route::get('/', function () {
    return view('ej6.home');
});

/**
 * Rutas creadas por el ejercicio 5.4
 */
Route::get('/materiaYTema', function () {
    return view('ej5.materiaYTema');
});


/**
 * Rutas creadas por el ejercicio 5.6
 */
Route::get('/about', function () {
    return view('ej5.about');
});
Route::get('/login', function () {
    return view('ej5.login');
});
Route::get('/logout', function () {
    return view('ej5.logout');
});
Route::get('/help', function () {
    return view('ej5.help');
});

/**
 * Rutas creadas por el ejercicio 6
 */
Route::get('/cronometro', function () {
    return view('ej6.cronometro');
});
Route::get('/video', function () {
    return view('ej6.video');
});
Route::get('/tablaCompetidores', function () {
    return view('ej6.tablaCompetidores');
});
Route::get('/cargarCompetidor', function () {
    return view('ej6.cargarCompetidor');
});
Route::get('/imagenesRandom', function () {
    return view('ej6.imagenesRandom');
});

// Trae todos los países
Route::get('/paises', [PaisController::class, 'index']);
// Trae todos los estados
Route::get('/estados', [EstadoController::class, 'index']);
// Trae todos los estados
Route::get('/competidores', [CompetidorController::class, 'index']);

// Rutas verificadas por rol

/*Route::middleware([RolMiddleware::class . ':competidor'])->group(function () {
    Route::get('/ruta', function (Authenticatable $user) {
        // Accede al objeto $user y realiza las acciones necesarias
    });
});

Route::middleware([RolMiddleware::class . ':juez'])->group(function () {
    Route::get('/ruta', function (Authenticatable $user) {
        // Accede al objeto $user y realiza las acciones necesarias
    });
});

Route::middleware([RolMiddleware::class . ':administrador'])->group(function () {
    Route::get('/ruta', function (Authenticatable $user) {
        // Accede al objeto $user y realiza las acciones necesarias
    });
});*/
