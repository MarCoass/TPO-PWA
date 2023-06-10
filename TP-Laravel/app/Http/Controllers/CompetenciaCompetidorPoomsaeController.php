<?php

namespace App\Http\Controllers;

use App\Models\Poomsae;
use App\Models\CompetenciaCompetidor;
use App\Models\CompetenciaCompetidorPoomsae;
use App\Models\Competidor;
use Illuminate\Http\Request;


class CompetenciaCompetidorPoomsaeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $poomsae = Poomsae::all();
        return $poomsae;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_competencia_competidor)
    {
        //visualizar los poomsae de la categoria
        //el competidor al que se van a asignar
        $competencia_competidor = CompetenciaCompetidor::where('idCompetenciaCompetidor', '=',$id_competencia_competidor)->get();
        $competidor = Competidor::where('idCompetidor','=',$competencia_competidor[0]->idCompetidor)->get();
        $poomsae = Poomsae::select('poomsae.idPoomsae','poomsae.nombre')->join('categoriapoomsae','poomsae.idPoomsae','categoriapoomsae.idPoomsae')->where('categoriapoomsae.idCategoria','=',$competencia_competidor[0]->idCategoria)->get();
        return view('tablaCompetenciaCompetidores.asignarpoomsecompetidor', compact('competidor','poomsae','competencia_competidor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_competencia_competidor = $request->input('id_competencia_competidor');

        $duplicado = CompetenciaCompetidorPoomsae::where('idCompetenciaCompetidor','=', $id_competencia_competidor)->first();

        if( $duplicado != null){
            return redirect('/')->with('error', "Ya tiene los poomsae asignados.");
        }

        $poomsae_uno = $request->input('poomsae_uno');
        $poomsae_dos = $request->input('poomsae_dos');

        //Primer poomsae
        $competencia_competidor_poomsae = new CompetenciaCompetidorPoomsae();

        $competencia_competidor_poomsae->pasadas = 1;
        $competencia_competidor = CompetenciaCompetidor::find($id_competencia_competidor);
        $competencia_competidor_poomsae->competencia_competidor()->associate($competencia_competidor);

        $poomsae = Poomsae::find($poomsae_uno);
        $competencia_competidor_poomsae->poomsae()->associate($poomsae);
    
        $competencia_competidor_poomsae->save();

        //Segundo poomsae
        $competencia_competidor_poomsae = new CompetenciaCompetidorPoomsae();

        $competencia_competidor_poomsae->pasadas = 2;
        $competencia_competidor = CompetenciaCompetidor::find($id_competencia_competidor);
        $competencia_competidor_poomsae->competencia_competidor()->associate($competencia_competidor);

        $poomsae = Poomsae::find($poomsae_dos);
        $competencia_competidor_poomsae->poomsae()->associate($poomsae);
    
        $competencia_competidor_poomsae->save();
     

        $CompetenciaController = new CompetenciaController();

        return $CompetenciaController->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
