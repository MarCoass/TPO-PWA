<?php

use App\Http\Controllers\CompetenciaController;
use Illuminate\Support\Facades\Route;
//use App\Http\Middleware\RolMiddleware;
//use Illuminate\Contracts\Auth\Authenticatable;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\CompetidorController;
use App\Http\Controllers\EscuelaController;
use App\Http\Controllers\GraduacionController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CompetenciaCompetidorController;
use App\Models\CompetenciaCompetidor;

Route::group(['namespace' => 'App\Http\Controllers'], function()
{
    /**
     * Home Routes
     */
    Route::get('/', [HomeController::class, 'index'])->name('home.index');

    // Trae todos los países
    Route::get('/paises', [PaisController::class, 'index']);

    // Trae todos los estados
    Route::get('/estados', [EstadoController::class, 'index']);
    // Trae todos los Competidores de la bd
    Route::get('/competidores/data', [CompetidorController::class, 'obtenerRegistros']);

    Route::post('/estado', [EstadoController::class, 'obtenerEstadoPorNombre'])->name('estado.autocomplete');
    Route::post('/pais', [PaisController::class, 'obtenerPaisPorNombre'])->name('pais.autocomplete');





    /* esta son las rutas para invitados */
    Route::group(['middleware' => ['guest']], function() {
        /**
         * registro Routes
         */
        Route::get('/registro', [RegistroController::class, 'show'])->name('registro.show');
        Route::post('/registro', [RegistroController::class, 'register'])->name('registro.perform');

        /**
         * Login Routes
         */
        Route::get('/login', [LoginController::class, 'show'])->name('login.show');
        Route::post('/login', [LoginController::class, 'perform'])->name('login.perform');

    });


    /* esta es la ruta para los que iniciaron sesion */
    Route::group(['middleware' => ['auth']], function() {

        /* rutas para todes */
        Route::get('/presentacion', function () {return view('presentacion.video');});
        Route::get('/verPerfil', function (){return view('verPerfil.verPerfil');})->name('verPerfil');
        Route::post('/actualizarDatosPersonales', [UsuarioController::class, 'actualizarDatosPersonales'])->name('actualizarDatosPersonales');
        Route::post('/actualizarPassword', [UsuarioController::class, 'actualizarPassword'])->name('actualizarPassword');

        /* reloj */
        Route::get('/resultados', function(){return view('resultados.resultados');});
        /* Logout Routes   */
        Route::get('/logout', [LogoutController::class, 'perform'])->name('logout.perform');


        /* rutas para administradores */
        Route::get('/competidores', [CompetidorController::class, 'index'])->middleware(['rol:1'])->name('tablaCompetidores');
        /* Rutas de Gestion de Usuarios se pueden mejorar */
        Route::get('/index_usuarios', [UsuarioController::class, 'index'])->middleware(['rol:1'])->name('index_usuarios');
        Route::get('/delete_usuario/{id}', [UsuarioController::class, 'destroy'])->middleware(['rol:1'])->name('delete_usuario');
        Route::get('/create_usuario', [UsuarioController::class, 'create'])->middleware(['rol:1'])->name('create_usuario');
        Route::get('/edit_usuario/{id}', [UsuarioController::class, 'edit'])->middleware(['rol:1'])->name('edit_usuario');
        Route::post('/store_usuario', [UsuarioController::class, 'store'])->middleware(['rol:1'])->name('store_usuario');
        Route::put('/update_usuario/{id}', [UsuarioController::class, 'update'])->middleware(['rol:1'])->name('update_usuario');
        Route::get('/habilitar_usuario/{id}', [UsuarioController::class, 'habilitar'])->middleware(['rol:1'])->name('habilitar_usuario');
        
        /* Rutas de Gestion de Competencias se pueden mejorar */
        Route::get('gestionCompetencias/index', [CompetenciaController::class, 'index'])->middleware(['rol:1'])->name('index_competencia');
        Route::get('gestionCompetencias/create', [CompetenciaController::class, 'create'])->middleware(['rol:1'])->name('create_competencia');
        Route::get('gestionCompetencias/edit/{id}', [CompetenciaController::class, 'edit'])->middleware(['rol:1'])->name('edit_competencia');
        Route::post('gestionCompetencias/store', [CompetenciaController::class, 'store'])->middleware(['rol:1'])->name('store_competencia');
        Route::put('/update_competidor/{id}', [CompetenciaController::class, 'update'])->middleware(['rol:1'])->name('update_competencia');
        Route::get('/ver_inscriptos_competencia/{id}', [CompetenciaCompetidorController::class, 'listarCompetidoresPorId'])->middleware(['rol:1'])->name('ver_inscriptos_competencia');
       
        //ruta de ejemplo para hacer la inscripcion desde un competidor
        Route::get('inscripcion/create/{idCompetidor}', [CompetenciaCompetidorController::class, 'create'])->middleware(['rol:1'])->name('create_competencia_competidor');
        
        //guardar inscripcion de competidor
        Route::post('inscripcion/store', [CompetenciaCompetidorController::class, 'store'])->middleware(['rol:1,3'])->name('store_competencia_competidor');
        

        /* lista competidores de una competencia */
        Route::get('/competidoresCompetencia/{id}', [CompetenciaCompetidorController::class, 'listarCompetidoresPorId'])->middleware(['rol:1'])->name('tabla_competidores');
        Route::get('/habilitar_competidor/{id}', [CompetenciaCompetidorController::class, 'habilitar'])->middleware(['rol:1'])->name('habilitar_competidor');

        /* rutas para jueces y administradores */
        Route::get('/cronometro', function () {return view('reloj.cronometro');})->middleware(['rol:1,2']);

        /* rutas para Competidores */
        Route::get('/cargarCompetidor',  [CompetidorController::class, 'cargarCompetidor'])->middleware(['rol:3'])->name('cargarCompetidor');
        Route::post('/cargarCompetidor/add', [CompetidorController::class, 'store'])->middleware(['rol:3'])->name('cargarCompetidor.perform');
        Route::post('/cargarCompetidor/validar', [CompetidorController::class, 'validar'])->middleware(['rol:3'])->name('cargarCompetidor.validar');

        /* Rutas de Puntuador se pueden mejorar */
        Route::get('/puntuador/puntuador', function(){return view('puntuador.puntuador');})->middleware(['rol:2'])->name('puntuador');
        Route::get('/puntuador/index',  [CompetenciaCompetidorController::class, 'puntuadorindex'])->middleware(['rol:2'])->name('puntuador_index');
        Route::get('/opciones_competidor', [CompetenciaCompetidorController::class, 'obtenerOpcionesCompetidor'])->middleware(['rol:2']);
        Route::post('/iniciar_puntaje', [CompetenciaCompetidorController::class, 'iniciar_puntaje'])->middleware(['rol:2'])->name('iniciar_puntaje');
        Route::post('/actualizar_puntaje', [CompetenciaCompetidorController::class, 'actualizar_puntaje'])->middleware(['rol:2'])->name('actualizar_puntaje');
        
    });

});
