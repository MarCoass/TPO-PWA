<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Middleware\RolMiddleware;
//use Illuminate\Contracts\Auth\Authenticatable;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\CompetidorController;


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



Route::group(['namespace' => 'App\Http\Controllers'], function()
{   
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('home.index');

    /* esta son las rutas para invitados */
    Route::group(['middleware' => ['guest']], function() {
        /**
         * registro Routes
         */
        Route::get('/registro', 'RegistroController@show')->name('registro.show');
        Route::post('/registro', 'RegistroController@register')->name('registro.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');

    });


    /* esta es la ruta para los registrados */
    Route::group(['middleware' => ['auth']], function() {
        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    });

});
