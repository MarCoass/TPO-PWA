<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RelojCompJuez;
use App\Models\Reloj;
use App\Models\CompetenciaJuez;
use App\Models\Competencia;
use App\Models\User;

class RelojCompJuezController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function unirseASala(request $id)
    {

        /* validar que sea un juez de esa competencia */
        $user = auth()->user();
        $idReloj = $id->input('idReloj');

        $objReloj = Reloj::find($idReloj);
        $idCompetencia = $objReloj['idCompetencia'];

        $idCompetenciaJuez = $this->competenciaDeUnJuez($idCompetencia);
        
            
        /* si la sala ya esta llena o el administrador ya la inicio con el minimo de jueces no debe crear nada */
        if($this->cantJuecesEnReloj($idReloj) < $objReloj['cantJueces']){

            if(!$this->yaExisteJuezEnReloj($idReloj)){
                /* se une a la sala del reloj */
                $nuevoRelojCompJuez = new RelojCompJuez();
                $nuevoRelojCompJuez->reloj()->associate($idReloj);
                $nuevoRelojCompJuez->competenciaJuez()->associate($idCompetenciaJuez);
                $nuevoRelojCompJuez->save();

                return response()->json(['mensaje' => 'Se ha unido a la sala']);
            }else{
                return response()->json(['mensaje' => 'Ya esta inscripto']);
            }

        }else{
            return response()->json(['mensaje' => 'Cantidad de jueces completa']);
        }

        return response()->json($mensaje);
    }

    /* Devuelve un objeto CompetenciaJuez de una competencia */
    public static function competenciaDeUnJuez($idCompetencia){
        $user = auth()->user();

        return $objCompetenciaJuez = CompetenciaJuez::where('idJuez',$user->id)
        ->where('idCompetencia',$idCompetencia)
        ->first();
    }
    
    
    /* Verifica si el juez ya existe en la competencia */
    public static function yaExisteJuezEnReloj($idReloj){
        $objReloj = Reloj::find($idReloj);
        
        $idCompetencia = $objReloj['idCompetencia'];

        $idCompetenciaJuez = self::competenciaDeUnJuez($idCompetencia);
        
        return $existe = RelojCompJuez::where([
            'idReloj' => $objReloj['idReloj'],
            'idCompetenciaJuez' => $idCompetenciaJuez['idCompetenciaJuez'],
            ])->exists();
        }


    /* Devuelve la cantidad de jueces de un reloj */
    public static function cantJuecesEnReloj($idReloj){
        return $cantidad = RelojCompJuez::where('idReloj', $idReloj)->count();
    }

    public function salirSala(request $id){
        $mensaje = [];

        $idReloj = $id->input('idReloj');

        $objReloj = Reloj::find($idReloj);

        $idCompetencia = $objReloj['idCompetencia'];

        $idCompetenciaJuez = self::competenciaDeUnJuez($idCompetencia);

        $RelojCompJuez = RelojCompJuez::where('idReloj',$idReloj)
                        ->where('idCompetenciaJuez',$idCompetenciaJuez['idCompetenciaJuez'])
                        ->first();

        if($RelojCompJuez->exists()){
            $RelojCompJuez->delete();

            $mensaje = ['mensaje' => true];
        }else{
            $mensaje = ['mensaje' => false];
        }
        return response()->json($mensaje);
    }
        
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idReloj,$idCompetenciaJuez)
    {
        $mensaje = [];
        $RelojCompJuez = RelojCompJuez::where('idReloj',$idReloj)
        ->where('idCompetenciaJuez',$idCompetenciaJuez)
        ->first();
        if(is_array($RelojCompJuez)){
            $RelojCompJuez->delete();

            $mensaje = ['success' => true];
        }else{
            $mensaje = ['success' => false];
        }
        
        return response()->json($mensaje);
    }
}
    