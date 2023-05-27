<?php

namespace App\Http\Controllers;

use App\Models\Competidor;
use App\Models\Graduacion;
use Illuminate\Http\Request;

class CompetenciaCompetidorController extends Controller
{
    public function  Puntuadorindex(){
        $competidores = Competidor::all();
        $graduaciones = Graduacion::all();

        return view('puntuador.index', compact('graduaciones','competidores'));

    }
}
