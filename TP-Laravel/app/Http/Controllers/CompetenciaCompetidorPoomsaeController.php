<?php

namespace App\Http\Controllers;

use App\Models\Poomsae;
use App\Models\CompetenciaCompetidor;
use App\Models\Competencia;
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


    /* Funcion que devuelve el poomsae de un competidor y lo renderiza en un modal */
    public function listar_poomsae_asignados_por_competencia_competidor($idCompetenciaCompetidor){

        $poomsae = Poomsae::select('poomsae.idPoomsae','poomsae.nombre','competenciacompetidorpoomsae.pasadas')->
        join('competenciacompetidorpoomsae','poomsae.idPoomsae','competenciacompetidorpoomsae.idPoomsae')->
        where('idCompetenciaCompetidor','=',$idCompetenciaCompetidor)->get();

        $competidor = CompetenciaCompetidor::select('competidores.*')->
        join('competidores','competenciacompetidor.idCompetidor','competidores.idCompetidor')->
        where('competenciacompetidor.idCompetenciaCompetidor','=',$idCompetenciaCompetidor)->get();

        return view('tablaCompetenciaCompetidores.modalVerPoomsae', compact('poomsae','competidor'))->render();

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

        //asignar poomsae a todos los competidores
        /* $competidoresCompetencia = CompetenciaCompetidor::where('estado',1)->where('idCompetencia', $id_competencia)->get(); */
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
        
                if($poomsae_pasada_1 && $poomsae_pasada_2){
                    if($row->estado == 1){
                        $user->notify(new NotificacionGeneral('success','Poomsae Asignado!','Poomsae Pasada 1: '.$poomsae_pasada_1.' Poomsae Pasada 2: '.$poomsae_pasada_2.'  ',' A prepararse!'));
                    }
                }
            }
        }

        //una vez sorteado el poomsae se cierran las inscripciones y se eliminan competidores no gestionados
        CompetenciaCompetidorController::cambioEstadoCompetidoresSinGestionar($id_competencia);
        
        //Llama al controlador para despues retornar la ruta con el id de la competencia
        $CompetenciaCompetidorController = new CompetenciaCompetidorController();

        return $CompetenciaCompetidorController->listarCompetidoresPorId($id_competencia);
    }

    public function habAunFinalizadaInscripcion($idCompCompe){
        /* $objCompetenciaCompetidor = new CompetenciaCompetidor(); */
        $objCompetenciaCompetidor = CompetenciaCompetidor::find($idCompCompe);

        // OBTENEMOS LOS POOMSAES del competidor DE ESA COMPETENCIA
        $poomsaes = Poomsae::join('competenciacompetidorpoomsae', 'poomsae.idPoomsae', 'competenciacompetidorpoomsae.idPoomsae')
        ->where('idCompetenciaCompetidor', '=', $objCompetenciaCompetidor->idCompetenciaCompetidor)
        ->select('poomsae.idPoomsae', 'poomsae.nombre', 'competenciacompetidorpoomsae.pasadas')
        ->get();

        $objCompetenciaCompetidor->estado = 1;
        $objCompetenciaCompetidor->save();
        
        $objCompetenciaCompetidor->competidor->user->notify(new NotificacionGeneral('success','Poomsae Asignado!','Poomsae Pasada 1: '.$poomsaes[0]->nombre.' Poomsae Pasada 2: '.$poomsaes[1]->nombre.'  ',' A prepararse!'));
        //Llama al controlador para despues retornar la ruta con el id de la competencia
        $CompetenciaCompetidorController = new CompetenciaCompetidorController();
        
        return $CompetenciaCompetidorController->listarCompetidoresPorId($objCompetenciaCompetidor->competencia->idCompetencia);
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

}
