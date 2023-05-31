<?php

namespace App\Http\Controllers;
use App\Models\CompetenciaJuez;
use App\Models\Competencia;
use App\Models\User;
use Illuminate\Http\Request;

class CompetenciaJuezController extends Controller
{
    public function store(Request $request){

        $duplicado = CompetenciaJuez::where('idCompetencia','=', $request->input('competencia'))->
        where('idJuez','=', $request->input('juez'))->first();

        if( $duplicado != null){
            return redirect('gestionCompetencias/index')->with('error', "Ya tiene una inscripcion hecha.");
        }

        $competencia_juez = new CompetenciaJuez();
        $competencia_juez->idJuez = $request->input('juez');
        $competencia_juez->idCompetencia = $request->input('competencia');
        $competencia_juez->estado =  0; 

        $competencia = Competencia::find($request->input('competencia'));
        $competencia_juez->competencia()->associate($competencia);

        $juez = User::find($request->input('juez'));
        $competencia_juez->juez()->associate($juez);

        $competencia_juez->save();

        return redirect('gestionCompetencias/index')->with('success', "Se ha registrado correctamente el Juez");
    }

    public function habilitar($id){

        $competencia_juez = CompetenciaJuez::find($id);
        $competencia_juez->estado = 1;
        $competencia_juez->save();

        return redirect()->route('tabla_jueces', ['id' => $competencia_juez->idCompetencia])->with('success', 'Juez habilitado exitosamente.');
    }

    public function listarJuecesPorIdCompetencia($id)
    {
        
        $competencia_juez = CompetenciaJuez::select('competenciajueces.*', 'users.nombre','users.apellido','users.id')
        ->join('users', 'competenciajueces.idJuez', '=', 'users.id')
        ->get();
        $nombreCompetencia = Competencia::find($id);

        return view('tablaCompetenciaJueces.index', ['JuecesCompetencia' => $competencia_juez, 'nombreCompetencia' => $nombreCompetencia]);
    }
}
