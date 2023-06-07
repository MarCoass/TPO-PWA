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
use App\Http\Controllers\CompetenciaJuezController;
use App\Http\Controllers\PuntajeController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\CompetenciaCompetidorPoomsaeController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CategoriaGraduacionController;
use App\Http\Controllers\CategoriaPoomsaeController;
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
    // Trae todos los categorias
    Route::get('/categorias', [CategoriaController::class, 'obtenerCategorias']);
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
        Route::get('/presentacion', [CompetenciaController::class, 'verCompetencias']);
        Route::get('/verPerfil', function (){return view('verPerfil.verPerfil');})->name('verPerfil');
        Route::post('/actualizarDatosPersonales', [UsuarioController::class, 'actualizarDatosPersonales'])->name('actualizarDatosPersonales');
        Route::post('/actualizarPassword', [UsuarioController::class, 'actualizarPassword'])->name('actualizarPassword');
        Route::get('/misSolicitudes/{id}', [SolicitudController::class, 'misSolicitudes'])->name('misSolicitudes');
        Route::post('/solicitudLeida/{id}', [SolicitudController::class, 'solicitudLeida'])->name('solicitudLeida');


        //Rutas de presentacion
        Route::get('/verPresentacion/{id}', [CompetenciaController::class, 'verPresentacion'])->name('verPresentacion');
        Route::get('/verResultados/{id}',[CompetenciaController::class, 'verResultados'])->name('verResultados');
        Route::post('/traerCompetidores',[CompetenciaController::class, 'traerCompetidores'])->name('traerCompetidores');

        /* reloj */
        Route::get('/resultados', function(){return view('resultados.resultados');});

        /* Logout Routes   */
        Route::get('/logout', [LogoutController::class, 'perform'])->name('logout.perform');

        /* ####   R u t a s   p a r a   a d m i n i s t r a d o r e s   #### */
        Route::group(['middleware' => ['rol:1']], function(){

                /* Rutas de Gestion de Solicitudes */
            Route::get('/index_solicitudes', [SolicitudController::class, 'index'])->name('index_solicitudes');
            Route::get('/ocultar_solicitud/{id}', [SolicitudController::class, 'ocultarSolicitud'])->name('ocultar_solicitud');
            Route::get('/aceptar_solicitud/{id}', [SolicitudController::class, 'aceptarSolicitud'])->name('aceptar_solicitud');
            Route::get('/rechazar_solicitud/{id}', [SolicitudController::class, 'rechazarSolicitud'])->name('rechazar_solicitud');

                /* Rutas de Gestion de Usuarios se pueden mejorar */
            Route::get('/index_usuarios', [UsuarioController::class, 'index'])->name('index_usuarios');
            Route::get('/delete_usuario/{id}', [UsuarioController::class, 'destroy'])->name('delete_usuario');
            Route::get('/create_usuario', [UsuarioController::class, 'create'])->name('create_usuario');
            Route::get('/edit_usuario/{id}', [UsuarioController::class, 'edit'])->name('edit_usuario');
            Route::post('/store_usuario', [UsuarioController::class, 'store'])->name('store_usuario');
            Route::put('/update_usuario/{id}', [UsuarioController::class, 'update'])->name('update_usuario');
            Route::get('/habilitar_usuario/{id}', [UsuarioController::class, 'habilitar'])->name('habilitar_usuario');

                /* Rutas de Gestion de Competencias se pueden mejorar */
            Route::get('gestionCompetencias/index', [CompetenciaController::class, 'index'])->name('index_competencia');
            Route::get('gestionCompetencias/create', [CompetenciaController::class, 'create'])->name('create_competencia');
            Route::get('gestionCompetencias/edit/{id}', [CompetenciaController::class, 'edit'])->name('edit_competencia');
            Route::post('gestionCompetencias/store', [CompetenciaController::class, 'store'])->name('store_competencia');
            Route::put('/update_competidor/{id}', [CompetenciaController::class, 'update'])->name('update_competencia');
            Route::get('/ver_inscriptos_competencia/{id}', [CompetenciaCompetidorController::class, 'listarCompetidoresPorId'])->name('ver_inscriptos_competencia');
            Route::get('/asignar_poomsae_competencia/{id_competencia_competidor}', [CompetenciaCompetidorPoomsaeController::class, 'create'])->name('asignar_poomsae_competidor');
            Route::post('/store_asignar_poomsae', [CompetenciaCompetidorPoomsaeController::class, 'store'])->name('store_asignar_poomsae');
            
            /* Rutas de Gestion de Categorias se pueden mejorar */
            Route::get('gestionCategorias/index', [CategoriaController::class, 'index'])->name('index_categoria');
            Route::get('gestionCategorias/create', [CategoriaController::class, 'create'])->name('create_categoria');
            Route::get('gestionCategorias/edit/{id}', [CategoriaController::class, 'edit'])->name('edit_categoria');
            Route::post('gestionCategorias/store', [CategoriaController::class, 'store'])->name('store_categoria');
            Route::put('/update_categoria/{id}', [CategoriaController::class, 'update'])->name('update_categoria');
            Route::get('/gestionCategoriaGraduaciones/index/{idCategoria}', [CategoriaGraduacionController::class, 'index'])->name('ver_graduaciones');
            Route::get('/gestionCategoriaPoomsae/index/{idCategoria}', [CategoriaPoomsaeController::class, 'index'])->name('ver_poomsae');
           
            /* Rutas de Gestion de Categorias Graduacion se pueden mejorar */
            Route::get('gestionCategoriaGraduaciones/create/{idCategoria}', [CategoriaGraduacionController::class, 'create'])->name('create_categoria_graduacion');
            Route::post('gestionCategoriaGraduaciones/store', [CategoriaGraduacionController::class, 'store'])->name('store_categoria_graduacion');
            Route::get('/delete_categoria_graduacion/{id}', [CategoriaGraduacionController::class, 'destroy'])->name('delete_categoria_graduacion');
            
            /* Rutas de Gestion de Categorias Poomsae se pueden mejorar */
            Route::get('gestionCategoriaPoomsae/create/{idCategoria}', [CategoriaPoomsaeController::class, 'create'])->name('create_categoria_poomsae');
            Route::post('gestionCategoriaPoomsae/store', [CategoriaPoomsaeController::class, 'store'])->name('store_categoria_poomsae');
            Route::get('/delete_categoria_poomsae/{id}', [CategoriaPoomsaeController::class, 'destroy'])->name('delete_categoria_poomsae');
            

            //ruta de ejemplo para hacer la inscripcion desde un competidor
            Route::get('inscripcion/create/{idCompetidor}', [CompetenciaCompetidorController::class, 'create'])->name('create_competencia_competidor');

                /* Lista de competidores */
            Route::get('/competidores', [CompetidorController::class, 'index'])->name('tablaCompetidores');

                /* lista competidores de una competencia */
            Route::get('/competidoresCompetencia/{id}', [CompetenciaCompetidorController::class, 'listarCompetidoresPorId'])->name('tabla_competidores');
            Route::get('/habilitar_competidor/{id}', [CompetenciaCompetidorController::class, 'habilitar'])->name('habilitar_competidor');

                /* lista jueces de una competencia */
            Route::get('/JuezCompetencia/{id}', [CompetenciaJuezController::class, 'listarJuecesPorIdCompetencia'])->name('tabla_jueces');
            Route::get('/habilitar_juez/{id}', [CompetenciaJuezController::class, 'habilitar'])->name('habilitar_juez');
        }); //fin rutas administradores

        //guardar inscripcion de competidor
        Route::post('inscripcion/store', [CompetenciaCompetidorController::class, 'store'])->middleware(['rol:1,3'])->name('store_competencia_competidor');

        //guardar inscripcion de Juez
        Route::post('inscripcionJuez/store', [CompetenciaJuezController::class, 'store'])->middleware(['rol:1,2'])->name('store_competencia_juez');

        /* rutas para generar solicitudes */
        Route::get('/solicitar_cambios/{id}', [SolicitudController::class, 'crearSolicitud'])->middleware(['rol:2,3'])->name('solicitar_cambios');
        Route::post('/generar_solicitud', [SolicitudController::class, 'generarSolicitud'])->middleware(['rol:2,3'])->name('generar_solicitud');

        /* rutas para jueces y administradores */
        Route::get('/cronometro', function () {return view('reloj.cronometro');})->middleware(['rol:1,2']);

        /* rutas para Competidores */
        Route::get('/cargarCompetidor',  [CompetidorController::class, 'cargarCompetidor'])->middleware(['rol:3'])->name('cargarCompetidor');
        Route::post('/cargarCompetidor/add', [CompetidorController::class, 'store'])->middleware(['rol:3'])->name('cargarCompetidor.perform');
        Route::post('/cargarCompetidor/validar', [CompetidorController::class, 'validar'])->middleware(['rol:3'])->name('cargarCompetidor.validar');

        /* Rutas de Puntuador se pueden mejorar */
        Route::get('/puntuador/puntuador', function(){return view('puntuador.puntuador');})->middleware(['rol:2'])->name('puntuador');
        Route::get('/puntuador/index',  [PuntajeController::class, 'puntuadorindex'])->middleware(['rol:2'])->name('puntuador_index');
        Route::get('/opciones_competidor', [PuntajeController::class, 'obtenerOpcionesCompetidorCategoria'])->middleware(['rol:2']);
        Route::get('/opciones_poomsae', [PuntajeController::class, 'obtenerOpcionesPoomsae'])->middleware(['rol:2']);
        Route::post('/iniciar_puntaje', [PuntajeController::class, 'iniciar_puntaje'])->middleware(['rol:2'])->name('iniciar_puntaje');
        Route::post('/actualizar_puntaje', [PuntajeController::class, 'actualizar_puntaje'])->middleware(['rol:2'])->name('actualizar_puntaje');
        Route::post('/validarJueces',[CompetenciaCompetidorController::class, 'validarJueces']);

        Route::post('/cargarPuntaje', [PuntajeController::class, 'store'])->middleware(['rol:2'])->name('puntaje.store');
        //Route::get('/verPuntaje', [PuntajeController::class, 'show'])->middleware(['rol:2'])->name('puntaje.show');
        Route::get('/verPuntaje/{puntaje}', [PuntajeController::class, 'show'])->middleware(['rol:2'])->name('puntuador.show');
        Route::get('/verPuntajeFinal/{competenciaCompetidor}', [CompetenciaCompetidorController::class, 'puntajeFinal'])->name('puntajeFinal.show');
    });

});
