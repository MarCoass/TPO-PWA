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
            return redirect('/')->with('error', "Ya tiene una inscripcion hecha.");
        }

        $competencia_juez = new CompetenciaJuez();
        $competencia_juez->idJuez = $request->input('juez');
        $competencia_juez->idCompetencia = $request->input('competencia');
        $competencia_juez->estado =  0;

        $competencia = Competencia::find($request->input('competencia'));
        $competencia_juez->competencia()->associate($competencia);

        $juez = User::find($request->input('juez'));
        $competencia_juez->juez()->associate($juez);

        /* busco posibles competencias en las que el juez se registro */
        $yaParticipoEnCompetencias = CompetenciaJuez::where('idJuez',$request->input('juez'))->first();

        $competencia_juez->save();

        /* verifico si el juez ya estuvo en otra competencia */
        if($yaParticipoEnCompetencias){
            $redirigir = [
                'url' => '/',
                'tipo' => 'modalConsulta',
                'mensaje' => 'show'
            ];
        }else{
            $redirigir = [
                'url' => '/',
                'tipo' => 'success',
                'mensaje' => 'Se ha registrado correctamente el Juez'
            ];
        }

        return redirect($redirigir['url'])->with($redirigir['tipo'],$redirigir['mensaje']);
    }

    public function habilitar($id){
        // Habilitar solo si hay menos que la cantidad definida en competencia
        // Caso contrario msj de error
        // Habría que deshabilitar el botón
        // Hacer que estadoJueces cambie al aceptar al ultimo juez requerido

        // El competenciaJuez actual
        $competencia_juez = CompetenciaJuez::find($id);

        // La lista completa de jueces aceptados para esta competencia
        $juecesAceptados = CompetenciaJuez::
                where('estado', true)
                ->where('idCompetencia', $competencia_juez->idCompetencia)
                ->get();


        $mensaje = [];
        $cantJueces = $competencia_juez->competencia->cantidadJueces;
        $cantJuecesAceptados = count($juecesAceptados);

        if($cantJuecesAceptados + 1 > $cantJueces){
            // Mayor muestra msj de error
            $mensaje = ["tipo" => 'restringed', 'mensaje' => 'No puede habilitar más jueces. La competencia ya está completa.'];
        }elseif($cantJuecesAceptados + 1 == $cantJueces){
            // Igual carga y cambia estadoJueces
            $competencia_juez->competencia->estadoJueces = true;
            $competencia_juez->competencia->save();
            $competencia_juez->estado = 1;
            $competencia_juez->save();
            $mensaje = ["tipo" => 'success', 'mensaje' => 'Juez habilitado exitosamente. La competencia ya está completa.'];
        }elseif($cantJuecesAceptados + 1 < $cantJueces){
            // Menor solo carga
            $competencia_juez->estado = 1;
            $competencia_juez->save();
            $mensaje =["tipo" => 'success', 'mensaje' => 'Juez habilitado exitosamente.'];
        }




        return redirect()->route('tabla_jueces', ['id' => $competencia_juez->idCompetencia])->with($mensaje['tipo'], $mensaje['mensaje']);
    }

    public function listarJuecesPorIdCompetencia($id)
    {

        $competencia_juez = CompetenciaJuez::where('idCompetencia', $id)->get();
        $nombreCompetencia = Competencia::find($id);
        $juecesAceptados = CompetenciaJuez::
                where('estado', true)
                ->where('idCompetencia', $id)
                ->get();

        return view('tablaCompetenciaJueces.index', ['CompetenciaJuez' => $competencia_juez, 'nombreCompetencia' => $nombreCompetencia, 'juecesAceptados' => $juecesAceptados]);
    }
}
