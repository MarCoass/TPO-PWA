<?php

namespace App\Http\Controllers;

use App\Models\Poomsae;
use App\Models\CompetenciaCompetidor;
use App\Models\CompetenciaCompetidorPoomsae;
use App\Models\CategoriaPoomsae;
use App\Models\Competidor;
use Illuminate\Http\Request;
use App\Notifications\NotificacionGeneral;
use Illuminate\Support\Facades\Mail;

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

    public function listar_poomsae_asignados_por_competencia_competidor($idCompetenciaCompetidor){

        $poomsae = Poomsae::select('poomsae.idPoomsae','poomsae.nombre','competenciacompetidorpoomsae.pasadas')->
        join('competenciacompetidorpoomsae','poomsae.idPoomsae','competenciacompetidorpoomsae.idPoomsae')->
        where('idCompetenciaCompetidor','=',$idCompetenciaCompetidor)->get();
        
        $competidor = CompetenciaCompetidor::select('competidores.*')->
        join('competidores','competenciacompetidor.idCompetidor','competidores.idCompetidor')->
        where('competenciacompetidor.idCompetenciaCompetidor','=',$idCompetenciaCompetidor)->get();
       
        return view('tablaCompetenciaCompetidores.verpoomsaecompetidor', compact('poomsae','competidor'));
   

    }

    public function registrar_poomsae_en_competidor($id_poomsae,$id_competencia_competidor,$numero_pasada){

        $duplicado = CompetenciaCompetidorPoomsae::where('idCompetenciaCompetidor','=',
         $id_competencia_competidor)->where('pasadas','=', $numero_pasada)->first();

        if( $duplicado != null){
            return false;
        }

        $competencia_competidor_poomsae = new CompetenciaCompetidorPoomsae();

        $competencia_competidor_poomsae->pasadas = $numero_pasada;
        $competencia_competidor = CompetenciaCompetidor::find($id_competencia_competidor);
        $competencia_competidor_poomsae->competencia_competidor()->associate($competencia_competidor);

        $poomsae = Poomsae::find($id_poomsae);
        $competencia_competidor_poomsae->poomsae()->associate($poomsae);
    
        $competencia_competidor_poomsae->save();  

        return true;
    }

      public function asignar_poomsae_por_sorteo($id_competencia){

        $competidoresCompetencia = CompetenciaCompetidor::where('idCompetencia', $id_competencia)->get();
        $pasadas = [1,2];

        foreach($competidoresCompetencia as $row){
            $poomsae_pasada_1 = ''; 
            $poomsae_pasada_2 = ''; 
            foreach($pasadas as $numero_pasada){
                $id_poomsae = CategoriaPoomsae::where('idCategoria','=', $row->idCategoria)->inRandomOrder()->first()->idPoomsae;
                $this->registrar_poomsae_en_competidor($id_poomsae,$row->idCompetenciaCompetidor,$numero_pasada);

                $poomsae = Poomsae::find($id_poomsae); 
                $user = $row->competidor->user;

                if($numero_pasada == 1){ 
                    $poomsae_pasada_1 = $poomsae->nombre; 
                }else if($numero_pasada == 2){ 
                    $poomsae_pasada_2 = $poomsae->nombre; 
                } 
              
                $user->notify(new NotificacionGeneral('success','Poomsae Asignado!','Poomsae Pasada 1: '.$poomsae_pasada_1.' Poomsae Pasada 2: '.$poomsae_pasada_2.'  ',' A prepararse!'));  
            }
        }
    
        $CompetenciaCompetidorController = new CompetenciaCompetidorController();
    
        return $CompetenciaCompetidorController->listarCompetidoresPorId($id_competencia);
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
            $competencia_competidor = CompetenciaCompetidor::where('idCompetenciaCompetidor', '=',$id_competencia_competidor)->get();
        
            $CompetenciaCompetidorController = new CompetenciaCompetidorController();

            return $CompetenciaCompetidorController->listarCompetidoresPorId($competencia_competidor[0]->idCompetencia);
        }

        $poomsae_uno = $request->input('poomsae_uno');
        $poomsae_dos = $request->input('poomsae_dos');

        //Primer poomsae
        $this->registrar_poomsae_en_competidor($poomsae_uno,$id_competencia_competidor,1);

        //Segundo poomsae
        $this->registrar_poomsae_en_competidor($poomsae_dos,$id_competencia_competidor,2);

        $CompetenciaController = new CompetenciaController();

        $competenciaCompetidor = CompetenciaCompetidor::find($id_competencia_competidor);
        $user = $competenciaCompetidor->competidor->user;

        $poomsaeUno = Poomsae::find($poomsae_uno);
        $poomsaeDos = Poomsae::find($poomsae_dos);
        $user->notify(new NotificacionGeneral('success','Poomsae Asignado!','Poomsae Pasada 1: '.$poomsaeUno->nombre.' Poomsae Pasada 2: '.$poomsaeDos->nombre.'  ',' A prepararse!'));

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
