<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Middleware\RolMiddleware;
//use Illuminate\Contracts\Auth\Authenticatable;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\CompetidorController;
use App\Http\Controllers\EscuelaController;
use App\Http\Controllers\GraduacionController;
use App\Http\Controllers\UsuarioController;





Route::group(['namespace' => 'App\Http\Controllers'], function()
{   
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('home.index');
    
    // Trae todos los países
    Route::get('/paises', [PaisController::class, 'index']);

    // Trae todos los estados
    Route::get('/estados', [EstadoController::class, 'index']);
    // Trae todos los Competidores de la bd
    Route::get('/competidores/data', [CompetidorController::class, 'obtenerRegistros']);
    
    Route::post('/estado', 'EstadoController@obtenerEstadoPorNombre')->name('estado.autocomplete');
    Route::post('/pais', 'PaisController@obtenerPaisPorNombre')->name('pais.autocomplete');
    
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
    
    
    /* esta es la ruta para los que iniciaron sesion */
    Route::group(['middleware' => ['auth']], function() {
        
        /* rutas para todes */
        Route::get('/presentacion', function () {return view('presentacion.video');});
        /* reloj */
        Route::get('/resultados', function(){return view('resultados.resultados');});
        /* Logout Routes   */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
        
        
        /* rutas para administradores */
        Route::get('/competidores', [CompetidorController::class, 'index'])->middleware(['rol:1'])->name('tablaCompetidores');
        /* Rutas de Gestion de Usuarios se pueden mejorar */
        Route::get('/index_usuarios', [UsuarioController::class, 'index'])->middleware(['rol:1'])->name('index_usuarios');
        Route::get('/delete_usuario/{id}', [UsuarioController::class, 'destroy'])->middleware(['rol:1'])->name('delete_usuario');
        Route::get('/create_usuario', [UsuarioController::class, 'create'])->middleware(['rol:1'])->name('create_usuario');
        Route::get('/edit_usuario/{id}', [UsuarioController::class, 'edit'])->middleware(['rol:1'])->name('edit_usuario');
        Route::post('/store_usuario', [UsuarioController::class, 'store'])->middleware(['rol:1'])->name('store_usuario');
        Route::put('/update_usuario/{id}', [UsuarioController::class, 'update'])->middleware(['rol:1'])->name('update_usuario');
        
        
        /* rutas para jueces y administradores */
        Route::get('/cronometro', function () {return view('reloj.cronometro');})->middleware(['rol:1,2']);
        
        
        /* rutas para Competidores */
        Route::get('/cargarCompetidor', function () {return view('cargarCompetidor.cargarCompetidor');})->middleware(['rol:3'])->name('cargarCompetidor');
        Route::post('/cargarCompetidor/add', 'CompetidorController@store')->middleware(['rol:3'])->name('cargarCompetidor.perform');
        Route::post('/cargarCompetidor/validar', 'CompetidorController@validar')->middleware(['rol:3'])->name('cargarCompetidor.validar');
        
    });
    
});