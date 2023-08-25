<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Competidor;
use App\Models\Competencia;
use App\Models\Escuela;
use App\Models\CompetenciaCompetidor;
use App\Models\CompetenciaCompetidorPoomsae;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use App\Models\Puntaje;
use Illuminate\Support\Facades\DB;
use App\Models\Reloj;

/* Necesarios para enviar mails */
use App\Notifications\NotificacionGeneral;
use Illuminate\Support\Facades\Notification;


class CompetenciaCompetidorController extends Controller
{

    
    public function create()
    {
        //ni idea momento de locura
        return view('inscripcion.create');
    }


    public function guardar_preinscripcion($id_competidor, $id_competencia, $id_categoria)
    {
        $competenciacompetidor = new CompetenciaCompetidor();
        $competenciacompetidor->idCompetidor = $id_competidor;
        $competenciacompetidor->idCompetencia = $id_competencia;
        $competenciacompetidor->idCategoria = $id_categoria;
        $competenciacompetidor->puntaje =  0;
        $competenciacompetidor->contadorPasadas =  0;
        $competenciacompetidor->estado =  0;

        $competidor = Competidor::find($id_competidor);
        $competenciacompetidor->competidor()->associate($competidor);

        $competencia = Competencia::find($id_competencia);
        $competenciacompetidor->competencia()->associate($competencia);

        $categoria = Categoria::find($id_categoria);
        $competenciacompetidor->categoria()->associate($categoria);

        $competenciacompetidor->save();

        return true;
    }


    public function store(Request $request)
    {

        $duplicado = CompetenciaCompetidor::where('idCompetencia', '=', $request->input('competencia'))->where('idCompetidor', '=', $request->input('competidor'))->first();

        if ($duplicado != null) {
            return redirect('gestionCompetencias/index')->with('error', "Ya tiene una inscripcion hecha.");
        }

        $competenciacompetidor = new CompetenciaCompetidor();
        $competenciacompetidor->idCompetidor = $request->input('competidor');
        $competenciacompetidor->idCompetencia = $request->input('competencia');
        $competenciacompetidor->idCategoria = $request->input('categoria');
        $competenciacompetidor->puntaje =  0;
        $competenciacompetidor->contadorPasadas =  0;
        $competenciacompetidor->estado =  0;

        $competidor = Competidor::find($request['competidor']);
        $competenciacompetidor->competidor()->associate($competidor);

        $competencia = Competencia::find($request['competencia']);
        $competenciacompetidor->competencia()->associate($competencia);

        $categoria = Categoria::find($request['categoria']);
        $competenciacompetidor->categoria()->associate($categoria);

        $competenciacompetidor->save();

        return redirect('/')->with('success', "Se ha registrado correctamente");
    }


    /* Habilita al competidor a participar de la competencia */
    public function habilitar($id)
    {

        $CompetidorCompetencia = CompetenciaCompetidor::find($id);
        $CompetidorCompetencia->estado = 1;
        $CompetidorCompetencia->save();

        $user = $CompetidorCompetencia->competidor->user;

        $user->notify(new NotificacionGeneral('success', 'Ha sido habilitado para competir!', 'Estas habilitado para competir en ' . $CompetidorCompetencia->competencia->nombre, 'Exitos!'));

        return redirect()->route('tabla_competidores', ['id' => $CompetidorCompetencia->idCompetencia])->with('success', 'Competidor habilitado exitosamente.');
    }

    /* rechaza al competidor a la competencia */
    public function rechazar($id)
    {

        $CompetidorCompetencia = CompetenciaCompetidor::find($id);
        $CompetidorCompetencia->estado = 2;
        $CompetidorCompetencia->save();

        $user = $CompetidorCompetencia->competidor->user;

        $user->notify(new NotificacionGeneral('restricted', 'Han rechazado tu inscripcion.', 'Por motivos administrativos no puedes competir en ' . $CompetidorCompetencia->competencia->nombre, 'Disculpe las molestias!'));


        return redirect()->route('tabla_competidores', ['id' => $CompetidorCompetencia->idCompetencia])->with('success', 'Competidor rechazado exitosamente.');
    }

    public function listarCompetidoresPorId($id)
    {
        $competidoresCompetencia = array();

        //Establezco la variable en Null
        $estadoSorteo = null;

        //Variable auxiliar para contar los competidores con estado 1
        $contador = 0;

        $arrayEscuelas = [];

        $data = CompetenciaCompetidor::where('idCompetencia', $id)->get();

        foreach ($data as $competidor) {
            $dato = array(
                'idCompetenciaCompetidor' => $competidor->idCompetenciaCompetidor,
                'gal' => $competidor->competidor->gal,
                'nombre' => $competidor->competidor->nombre,
                'apellido' => $competidor->competidor->apellido,
                'estado' => $competidor->estado,
                'escuela' => $competidor->competidor->user->escuela->nombre,
                'fecha' => $competidor->created_at->format('Y-m-d'),
                'idUser' => $competidor->competidor->user->id,
                'tieneSolicitud' => $this->tieneSolicitud($competidor->competidor->user->id),
                'tiene_poomsae_asignado' => 0
            );

            if ($competidor->estado != 0) {
                $existe_tupla = CompetenciaCompetidorPoomsae::where('idCompetenciaCompetidor', '=', $competidor->idCompetenciaCompetidor)->first();

                if ($existe_tupla != null) {
                    $dato['tiene_poomsae_asignado'] = 1;
                }
            }

            //Listo las escuelas
            $objEscuela = Escuela::where('idEscuela',$competidor->competidor->user->escuela->idEscuela)->first();

            if(!in_array($objEscuela, $arrayEscuelas)){
                array_push($arrayEscuelas,$objEscuela);
            }
            
            
            //Si el competidor tiene estado 1, incrementamos el contador
            if ($competidor->estado == 1) {
                $contador++;
            }

            $competidoresCompetencia[] = $dato;
        }

        //Si el contador es igual al número total de competidores, cambiamos el estadoSorteo a "full"
        if ($contador == count($data)) {
            $estadoSorteo = "full";
        }

        $escuelas = $arrayEscuelas;

        $competencia = Competencia::find($id);

        return view('tablaCompetenciaCompetidores.index_CompetenciaCompetidores', ['competidoresCompetencia' => $competidoresCompetencia, 'competencia' => $competencia, 'estadoSorteo' => $estadoSorteo ,'escuelas' => $escuelas]);
    }

    /* verifica si el usuario competidor tiene solicitudes */
    private function tieneSolicitud($idUser)
    {
        return Solicitud::where('idUser', '=', $idUser)->where('estadoSolicitud', '=', 4)->exists();
    }

    //Aca se setea el puntaje final del competidor de la competencia colocando el id del competidor
    public static function puntajeFinal($id)
    {

        $resp = false;

        $CompetidorCompetencia = CompetenciaCompetidor::where('idCompetidor',$id)->first();
        $categoria = $CompetidorCompetencia->idCategoria;
        $idCompetencia = $CompetidorCompetencia->idCompetencia;
        $reloj = Reloj::where('idCompetenciaCompetidor',$CompetidorCompetencia->idCompetenciaCompetidor)->first();


        //busca las 2 pasadas
        $primeraPasada = Puntaje::where('idCompetenciaCompetidor', '=', $CompetidorCompetencia->idCompetenciaCompetidor)
                ->where('pasada', '=', '1')
                ->get();
        $segundaPasada = Puntaje::where('idCompetenciaCompetidor', '=', $CompetidorCompetencia->idCompetenciaCompetidor)
                ->where('pasada', '=', '2')
                ->get();

        
        $tengoIdReloj = $reloj->idReloj; 

        $resultadoPrimeraPasada = CompetenciaCompetidorController::calcularPuntaje($primeraPasada, $reloj->idReloj);
        $resultadoSegundaPasada = CompetenciaCompetidorController::calcularPuntaje($segundaPasada, $reloj->idReloj);

        $total = round(($resultadoPrimeraPasada['totalPasada'] + $resultadoSegundaPasada['totalPasada']) / 2, 1);

        //le asigno el total al competidorCompetencia
        $CompetidorCompetencia->puntaje = $total;
        $CompetidorCompetencia->save();

        CompetenciaCompetidorController::revisarSiSePuedeSetearRanking($idCompetencia);

        $competidor = Competidor::find($CompetidorCompetencia->idCompetidor);

        $resp = true;

        return $total;
    }

    /* //Aca se setea el puntaje final del competidor de la competencia
    public function puntajeFinal($id)
    {
        $CompetidorCompetencia = CompetenciaCompetidor::find($id);
        $categoria = $CompetidorCompetencia->idCategoria;
        $idCompetencia = $CompetidorCompetencia->idCompetencia;


        //busca las 2 pasadas
        $primeraPasada = Puntaje::where('idCompetenciaCompetidor', '=', $CompetidorCompetencia->idCompetenciaCompetidor)->where('pasada', '=', '1')->get();
        $segundaPasada = Puntaje::where('idCompetenciaCompetidor', '=', $CompetidorCompetencia->idCompetenciaCompetidor)->where('pasada', '=', '2')->get();

        $resultadoPrimeraPasada = $this->calcularPuntaje($primeraPasada, $categoria, $idCompetencia);
        $resultadoSegundaPasada = $this->calcularPuntaje($segundaPasada, $categoria, $idCompetencia);

        $total = round(($resultadoPrimeraPasada['totalPasada'] + $resultadoSegundaPasada['totalPasada']) / 2, 1);

        //le asigno el total al competidorCompetencia
        $CompetidorCompetencia->puntaje = $total;
        $CompetidorCompetencia->save();

        $this->revisarSiSePuedeSetearRanking($idCompetencia);

        $competidor = Competidor::find($CompetidorCompetencia->idCompetidor);
        return view('puntuador/puntajeFinal', ['competenciaCompetidor' => $CompetidorCompetencia, 'resultadoPrimeraPasada' => $resultadoPrimeraPasada, 'resultadoSegundaPasada' => $resultadoSegundaPasada, 'competidor' => $competidor, 'id_competencia' => $idCompetencia]);
    } */


    public static function revisarSiSePuedeSetearRanking($idCompetencia)
    {
        //buscamos todas las competencia competidor con idcompetnecia
        $competencias = CompetenciaCompetidor::where('idCompetencia', $idCompetencia)
            ->where('puntaje', 0)
            ->where('contadorPasadas', '<', 2)
            ->first();

        if ($competencias == null) {
            CompetenciaCompetidorController::setearRanking($idCompetencia);
        }
    }

    /*Esto para lo del puntuador y jueces */
    // para verificar el total de jueces y recien hacer el promedio
    public function validarJueces(Request  $request)
    {
        $idCompetencia = $request['idCompetencia'];
        $idCompetidor = $request['idCompetidor'];
        $numPasada = $request['numPasada'];

        //busco todos los puntajes de esa competencia y ese competidor
        //ahora busca los que tengan puntaje exactitud y presentacion diferente de 0
        $cantJueces = Competencia::find($idCompetencia)->cantidadJueces;
        $competenciaCompetidor = CompetenciaCompetidor::where('idCompetencia', $idCompetencia)->where('idCompetidor', $idCompetidor)->first();
        $puntajes = Puntaje::where('idCompetenciaCompetidor', $competenciaCompetidor->idCompetenciaCompetidor)
            ->where('pasada', $numPasada)
            ->where('puntajeExactitud', '<>', 0)
            ->where('puntajePresentacion', '<>', 0)
            ->get();

        $reloj = Reloj::where('idCategoria', $competenciaCompetidor->idCategoria)
            ->where('idCompetencia', $idCompetencia)
            ->get();

        $cantJueces = $reloj[0]->cantJueces;

        $puntuacionCompleta = count($puntajes) == $cantJueces;
        $cantJuecesFaltantes = $cantJueces - count($puntajes);

        $response = [
            'puntuacionCompleta' => $puntuacionCompleta,
            'cantJuecesFaltantes' => $cantJuecesFaltantes,
            'pasada' => $numPasada
        ];
        // Retornar la respuesta como JSON
        return response()->json($response);
    }

    public function calcularPuntajePasada(Request $request)
    {
        //$idCompetencia = $request['idCompetencia'];
        //$idCompetidor = $request['idCompetidor'];
        $idReloj = $request['idReloj'];
        $numPasada = $request['numPasada'];

        $reloj = Reloj::find($idReloj);

        //busco los puntajes correspondientes
        //$competenciaCompetidor = CompetenciaCompetidor::where('idCompetencia', $idCompetencia)->where('idCompetidor', $idCompetidor)->first();
        
        $competenciaCompetidor = CompetenciaCompetidor::where('idCompetencia', $reloj->idCompetencia)
                ->where('idCompetidor', $reloj->competenciacompetidor->competidor->idCompetidor)
                ->first();

        $puntajes = Puntaje::select('*', DB::raw('(puntajePresentacion + puntajeExactitud) AS puntajeTotal'))
            ->where('idCompetenciaCompetidor', $competenciaCompetidor->idCompetenciaCompetidor)
            ->where('pasada', $numPasada)->orderBy('puntajeTotal')
            ->get();

        $idCategoria = $competenciaCompetidor->idCategoria;
        //$resultados = $this->calcularPuntaje($puntajes, $idCategoria, $idCompetencia);
        $resultados = $this->calcularPuntaje($puntajes, $reloj->idReloj);
        //Le aumento el contador de pasadas
        ///CAMBIAR
        $competenciaCompetidor->contadorPasadas = $competenciaCompetidor->contadorPasadas + 1;
        $competenciaCompetidor->save();

        $response = [
            'totalPresentacion' => round($resultados['totalPresentacion'], 1),
            'totalExactitud' => round($resultados['totalExactitud'], 1),
            'totalPasada' => round($resultados['totalPasada']),
        ];

        return response()->json($response);
    }


    public static function calcularPuntaje($arrayPuntajes, $idReloj)
    {
        //buco la cantidad de jueces del ob reloj
        $reloj = Reloj::find($idReloj);
        $idCompetencia = $reloj->competencia->idCompetencia;
        $idCategoria = $reloj->idCategoria;

        $cantJueces = $reloj->cantJueces;

        //por cada pasada sumo los puntajes de exactitud y presentacion
        $presentacion = 0;
        $exactitud = 0;
        foreach ($arrayPuntajes as $puntaje) {
            $presentacion = $presentacion + $puntaje->puntajePresentacion;
            $exactitud = $exactitud + $puntaje->puntajeExactitud;
        }

        if ($cantJueces != 3) {
            $presentacion = $presentacion - $arrayPuntajes[0]->puntajePresentacion  - $arrayPuntajes[$cantJueces - 1]->puntajePresentacion;
            $exactitud = $exactitud - $arrayPuntajes[0]->puntajeExactitud  - $arrayPuntajes[$cantJueces - 1]->puntajeExactitud;
        }

        $presentacion = $cantJueces == 3 ? $presentacion / $cantJueces : $presentacion / ($cantJueces - 2);
        $exactitud = $cantJueces == 3 ? $exactitud / $cantJueces : $exactitud / ($cantJueces - 2);

        //resto si hay overtime
        $overtime = $arrayPuntajes[0]->overtime == '00:00:00';
        $penalizacion = $overtime ? 0 : 0.3;

        $resultados = [
            'totalPresentacion' => round($presentacion, 1),
            'totalExactitud' => round($exactitud, 1),
            'totalPasada' => round($exactitud + $presentacion - $penalizacion, 1),
            'overtime' => $arrayPuntajes[0]->overtime,

        ];
        return $resultados;
    }

    public static function setearRanking($idCompetencia)
    {
        $competencia = Competencia::find($idCompetencia);

        if ($competencia->estadoCompetencia == 0) {

            $categorias = CompetenciaCompetidorController::obtenerCategoriasFiltradas($idCompetencia);

            foreach ($categorias as $cat) {

                $competenciaCompetidor = CompetenciaCompetidor::where('idCompetencia', $idCompetencia)
                    ->where('idCategoria', '=', $cat->idCategoria)
                    ->orderByDesc('puntaje')
                    ->take(3)
                    ->get();

                if ($competenciaCompetidor != null) {
                    $ranking = 3;
                    foreach ($competenciaCompetidor as $compeCompe) {
                        $competidor = Competidor::find($compeCompe->idCompetidor);
                        $competidor->ranking += $ranking;
                        $competidor->save();
                        $ranking--;
                    }
                }
            }

            $competencia->estadoCompetencia = 1;
            $competencia->save();
        }
    }

    public static function obtenerCategoriasFiltradas($idCompetencia)
    {
        $categorias = Categoria::select('categorias.*')
            ->join('competenciacompetidor', 'categorias.idCategoria', '=', 'competenciacompetidor.idCategoria')
            ->join('competencias', 'competenciacompetidor.idCompetencia', '=', 'competencias.idCompetencia')
            ->where('competencias.idCompetencia', '=', $idCompetencia)
            ->distinct()
            ->get();

        return $categorias;
    }

    public function destroy($id){
        $competenciaCompetidor = CompetenciaCompetidor::find($id);
        $idCompetencia = $competenciaCompetidor->idCompetencia;
        $competenciaCompetidor->delete();

        return redirect()
            ->route('tabla_competidores', ['id' => $idCompetencia])
            ->with('success', 'Competidor eliminado exitosamente de la competencia. Ahora puede volver a inscribirse');
    }

    public static function cambioEstadoCompetidoresSinGestionar($idCompetencia){

        //Seteo el campo estadoInscripcion de la competencia como 1 "cerrado".
        $competencia = Competencia::find($idCompetencia);
        $competencia->estadoInscripcion = 1;
        $competencia->save();

        //Busco a los competidores de la competencia que no se llegaron a gestionar.
        $competidoresCompetencia = CompetenciaCompetidor::where('estado',0)->where('idCompetencia', $idCompetencia)->get();

        //Si la consulta no esta vacia continua la iteracion de cambiar estado.
        if($competidoresCompetencia->isNotEmpty()){
            foreach ($competidoresCompetencia as $row){
                $row->estado = 2;
            }
        }

        return true;
    }

}
