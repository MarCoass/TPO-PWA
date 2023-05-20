<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() 
    {
        /* redirecciona a la pagina home, por ahora redireccionara a otra, despues se mudara */
        return view('home2.index');
    }
}
