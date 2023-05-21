<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Middleware\RolMiddleware;
//use Illuminate\Contracts\Auth\Authenticatable;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\CompetidorController;
use App\Http\Controllers\UsuarioController;

Route::get('/cronometro', function () {
    return view('ej6.cronometro');
});
Route::get('/video', function () {
    return view('ej6.video');
});

Route::get('/competidores', [CompetidorController::class, 'index']);

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
// Trae todos los Competidores de la bd
Route::get('/competidores/data', [CompetidorController::class, 'obtenerRegistros']);

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


//Rutas de Gestion de Usuarios se pueden mejorar
Route::get('/index_usuarios', [UsuarioController::class, 'index']);

Route::get('/delete_usuario/{id}', [UsuarioController::class, 'destroy'])->name('delete_usuario');

Route::get('/create_usuario', [UsuarioController::class, 'create'])->name('create_usuario');

Route::get('/edit_usuario/{id}', [UsuarioController::class, 'edit'])->name('edit_usuario');

Route::get('/store_usuario', [UsuarioController::class, 'store'])->name('store_usuario');

Route::get('/update_usuario/{id}', [UsuarioController::class, 'update'])->name('update_usuario');


