<?php

use App\Http\Controllers\{
    CompetenciaController,
    EstadoController,
    CompetidorController,
    PerfilController,
    UsuarioController,
    LogoutController,
    HomeController,
    RegistroController,
    LoginController,
    CompetenciaCompetidorController,
    CompetenciaJuezController,
    PuntajeController,
    SolicitudController,
    CompetenciaCompetidorPoomsaeController,
    CategoriaController,
    CategoriaGraduacionController,
    CategoriaPoomsaeController,
    PaisController,
    PermisoController,
    PoomsaeController,
    RelojController,
    NotificacionController
};
use Illuminate\Support\Facades\Route;

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
        Route::get('/presentacion', [CompetenciaController::class, 'verCompetencias'])->name('presentacion');
        Route::get('/verPerfil', [PerfilController::class, 'index'])->name('verPerfil');
        Route::post('/actualizarDatosPersonales', [UsuarioController::class, 'actualizarDatosPersonales'])->name('actualizarDatosPersonales');
        Route::post('/actualizarPassword', [UsuarioController::class, 'actualizarPassword'])->name('actualizarPassword');
        Route::post('/actualizarImagenPerfil', [UsuarioController::class, 'actualizarFoto'])->name('actualizarImagenPerfil');
        Route::get('/misSolicitudes/{id}', [SolicitudController::class, 'misSolicitudes'])->name('misSolicitudes');
        Route::post('/solicitudLeida/{id}', [SolicitudController::class, 'solicitudLeida'])->name('solicitudLeida');
        Route::get('/resultadosRanking', [CategoriaController::class, 'vistaVerRanking'])->name('resultadosRanking');
        Route::post('/obtenerRanking', [CompetidorController::class, 'obtenerRanking'])->name('obtenerRanking'); //traer competidores por genero para ranking

        /* rutas para notificaciones */
        Route::get('/misNotificaciones', [NotificacionController::class, 'index'])->name('misNotificaciones');
        Route::put('/marcarLeido/{id}', [NotificacionController::class, 'marcarLeido'])->name('marcarLeido');


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

                /* Rutas de Gestion de Poomsaes */
            Route::get('/index_poomsae', [PoomsaeController::class, 'index'])->name('index_poomsae');
            Route::get('/create_poomsae', function(){return view('gestionPoomsae.create');})->name('create_poomsae');
            Route::post('/store_poomsae', [PoomsaeController::class, 'store'])->name('store_poomsae');
            Route::get('/edit_poomsae/{id}', [PoomsaeController::class, 'edit'])->name('edit_poomsae');
            Route::put('/update_poomsae/{id}', [PoomsaeController::class, 'update'])->name('update_poomsae');
            Route::get('/delete_poomsae/{id}', [PoomsaeController::class, 'destroy'])->name('delete_poomsae');

                /* Rutas de Gestion de Solicitudes */
            Route::get('/index_solicitudes', [SolicitudController::class, 'index'])->name('index_solicitudes');
            Route::get('/index_solicitudes/{id}', [SolicitudController::class, 'solicitudesPorIdUser'])->name('competidor_solicitudes');
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

            Route::get('/asignar_poomsae_por_sorteo/{id_competencia}', [CompetenciaCompetidorPoomsaeController::class, 'asignar_poomsae_por_sorteo'])->name('asignar_poomsae_por_sorteo');
            Route::get('/ver_poomsae_competidor/{idCompetenciaCompetidor}', [CompetenciaCompetidorPoomsaeController::class, 'listar_poomsae_asignados_por_competencia_competidor'])->name('ver_poomsae_competidor');
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
            Route::get('/rechazar_competidor/{id}', [CompetenciaCompetidorController::class, 'rechazar'])->name('rechazar_competidor');

                /* lista jueces de una competencia */
            Route::get('/JuezCompetencia/{id}', [CompetenciaJuezController::class, 'listarJuecesPorIdCompetencia'])->name('tabla_jueces');
            Route::get('/habilitar_juez/{id}', [CompetenciaJuezController::class, 'habilitar'])->name('habilitar_juez');
            Route::get('/rechazar_juez/{id}', [CompetenciaJuezController::class, 'rechazar'])->name('rechazar_juez');

            // ruta gestión de graduaciones
            Route::resource('graduaciones', 'GraduacionController');

            // ruta gestión de permisos
            Route::resource('permisos', 'PermisoController');
            Route::get('/permisos/{permiso}/destroy', [PermisoController::class, 'destroy'])->name('permisos.delete');

             //ruta para setear ranking
             Route::get('/setear_ranking', [CompetenciaCompetidorController::class, 'setearRanking']);


        }); //fin rutas administradores

        //guardar inscripcion de competidor
        Route::post('inscripcion/store', [CompetenciaCompetidorController::class, 'store'])->middleware(['rol:1,3'])->name('store_competencia_competidor');

        //guardar inscripcion de Juez
        Route::post('inscripcionJuez/store', [CompetenciaJuezController::class, 'store'])->middleware(['rol:1,2'])->name('store_competencia_juez');

        /* rutas para generar solicitudes */
        Route::get('/solicitar_cambios/{id}', [SolicitudController::class, 'crearSolicitud'])->middleware(['rol:2,3'])->name('solicitar_cambios');
        Route::post('/generar_solicitud', [SolicitudController::class, 'generarSolicitud'])->middleware(['rol:2,3'])->name('generar_solicitud');

        /* rutas para Competidores */
        Route::get('/cargarCompetidor',  [CompetidorController::class, 'cargarCompetidor'])->middleware(['rol:3'])->name('cargarCompetidor');
        Route::post('/cargarCompetidor/add', [CompetidorController::class, 'store'])->middleware(['rol:3'])->name('cargarCompetidor.perform');
        Route::post('/cargarCompetidor/validar', [CompetidorController::class, 'validar'])->middleware(['rol:3'])->name('cargarCompetidor.validar');
        Route::get('/reinscribirCompetidor', [CompetidorController::class, 'vistaReinscribirCompetidor'])->middleware(['rol:3'])->name('reinscribirCompetidor');
        Route::post('/reinscribirCompetidor/add', [CompetidorController::class, 'reinscribirCompetidor'])->middleware(['rol:3'])->name('reinscribirCompetidor.perform');

        /* Rutas de Puntuador se pueden mejorar */
        Route::get('/puntuador/puntuador', function(){return view('puntuador.puntuador');})->middleware(['rol:2'])->name('puntuador');
        Route::get('/puntuador/index',  [PuntajeController::class, 'puntuadorindex'])->middleware(['rol:2'])->name('puntuador_index');
        Route::get('/opciones_competidor', [PuntajeController::class, 'obtenerOpcionesCompetidorCategoria'])->middleware(['rol:1,2']);
        Route::post('/iniciar_puntaje', [PuntajeController::class, 'iniciar_puntaje'])->middleware(['rol:2'])->name('iniciar_puntaje');
        Route::post('/actualizar_puntaje', [PuntajeController::class, 'actualizar_puntaje'])->middleware(['rol:2'])->name('actualizar_puntaje');
        Route::post('/validarJueces',[CompetenciaCompetidorController::class, 'validarJueces']);
        Route::post('/calcularPuntajePasada',[CompetenciaCompetidorController::class, 'calcularPuntajePasada']);

        Route::post('/cargarPuntaje', [PuntajeController::class, 'store'])->middleware(['rol:2'])->name('puntaje.store');
        Route::post('/actualizarPuntaje', [PuntajeController::class, 'update'])->middleware(['rol:2'])->name('puntaje.update');
        //Route::get('/verPuntaje', [PuntajeController::class, 'show'])->middleware(['rol:2'])->name('puntaje.show');
        Route::get('/verPuntaje/{puntaje}', [PuntajeController::class, 'show'])->middleware(['rol:2'])->name('puntuador.show');
        Route::get('/verPuntajeFinal/{competenciaCompetidor}', [CompetenciaCompetidorController::class, 'puntajeFinal'])->name('puntajeFinal.show');

        //rutas del reloj
        Route::get('/iniciar_cronometro', [RelojController::class, 'cronometro'])->middleware(['rol:1']);
        Route::get('/index_reloj', [RelojController::class, 'index'])->middleware(['rol:1'])->name('index_reloj');
        Route::get('/opciones_categoria',[RelojController::class, 'obtenerCategoria']);

        Route::get('/start', [RelojController::class, 'start'])->middleware(['rol:1']);
        Route::get('/stop', [RelojController::class, 'stop'])->middleware(['rol:1']);
        Route::get('/actualizar_reloj', [RelojController::class, 'obtener_estado_reloj']);
        Route::get('/actualizar_informacion', [RelojController::class, 'buscarPuntuacionActual']);
    });

});
