<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

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
