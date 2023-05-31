<?php

namespace App\Http\Controllers;

use App\Models\Competidor;
use App\Models\Competencia;
use App\Models\Poomsae;
use App\Models\CompetenciaCompetidor;
use Illuminate\Http\Request;
use App\Models\Puntaje;

class CompetenciaCompetidorController extends Controller
{

    public function create()
    {
        //ni idea momento de locura
        return view('inscripcion.create');
    }

    public function store(Request $request){

            $duplicado = CompetenciaCompetidor::where('idCompetencia','=', $request->input('competencia'))->
            where('idCompetidor','=', $request->input('competidor'))->first();

            if( $duplicado != null){
                return redirect('gestionCompetencias/index')->with('error', "Ya tiene una inscripcion hecha.");
            }

            $competenciacompetidor = new CompetenciaCompetidor();
            $competenciacompetidor->idCompetidor = $request->input('competidor');
            $competenciacompetidor->idCompetencia = $request->input('competencia');
            $competenciacompetidor->idPoomsae = $request->input('poomsae');
            $competenciacompetidor->puntaje =  10; 
            $competenciacompetidor->contadorPasadas =  0; 
            $competenciacompetidor->estado =  0; 
    
            $competidor = Competidor::find($request['competidor']);
            $competenciacompetidor->competidor()->associate($competidor);
    
            $competencia = Competencia::find($request['competencia']);
            $competenciacompetidor->competencia()->associate($competencia);

            $poomsae = Poomsae::find($request['poomsae']);
            $competenciacompetidor->poomsae()->associate($poomsae);
    
            $competenciacompetidor->save();
    
            return redirect('gestionCompetencias/index')->with('success', "Se ha registrado correctamente");
    }

    public function habilitar($id){

        $CompetidorCompetencia = CompetenciaCompetidor::find($id);
        $CompetidorCompetencia->estado = true;
        $CompetidorCompetencia->save();

        /* todavia tengo que arreglar la redireccion */
        return redirect()->route('tabla_competidores', ['id' => $CompetidorCompetencia->idCompetencia])->with('success', 'Competidor habilitado exitosamente.');
    }

    public function listarCompetidoresPorId($id)
    {
        $competidoresCompetencia = CompetenciaCompetidor::where('idCompetencia', $id)->get();
        $nombreCompetencia = Competencia::find($id);

        return view('tablaCompetenciaCompetidores.index_CompetenciaCompetidores', ['competidoresCompetencia' => $competidoresCompetencia, 'nombreCompetencia' => $nombreCompetencia]);
    }

    public function puntajeFinal($id){
        $CompetidorCompetencia = CompetenciaCompetidor::find($id);

        //busca las 2 pasadas
        $primeraPasada = Puntaje::where('idCompetenciaCompetidor', '=', $CompetidorCompetencia->idCompetenciaCompetidor)->where('pasada', '=', '1')->first();
        $segundaPasada = Puntaje::where('idCompetenciaCompetidor', '=', $CompetidorCompetencia->idCompetenciaCompetidor)->where('pasada', '=', '2')->first();
        
        //calcula el puntaje de exactitud
        $exactitud = ($primeraPasada->puntajeExactitud + $segundaPasada->puntajeExactitud)/2;

        //calcula el puntaje de presentacion
        $presentacion = ($primeraPasada->puntajePresentacion + $segundaPasada->puntajePresentacion)/2;

        $total = $exactitud + $presentacion;

        //le asigno el total al competidorCompetencia
        $CompetidorCompetencia->puntaje = $total;

        $competidor = Competidor::find($CompetidorCompetencia->idCompetidor);
        return view('puntuador/puntajeFinal', ['competenciaCompetidor'=>$CompetidorCompetencia, 'primeraPasada'=>$primeraPasada, 'segundaPasada'=>$segundaPasada, 'competidor'=>$competidor]);
    
    }
}
