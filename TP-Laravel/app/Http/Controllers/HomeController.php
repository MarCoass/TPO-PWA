<?php

namespace App\Http\Controllers;

use App\Models\Competencia;
use App\Models\Competidor;
use App\Models\User;
use App\Models\Poomsae;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() 
    {
        $competencias = Competencia::all();
        //solo listar jueces verificados
        $jueces = User::where('estado','=','1')->where('idRol','=','2')->get();

        return view('home.index', compact('competencias','jueces'));
    }
}
