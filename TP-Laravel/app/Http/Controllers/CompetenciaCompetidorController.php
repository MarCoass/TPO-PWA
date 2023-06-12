<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Competidor;
use App\Models\Competencia;
use App\Models\CompetenciaCompetidor;
use App\Models\CompetenciaCompetidorPoomsae;
use Illuminate\Http\Request;
use App\Models\Puntaje;

class CompetenciaCompetidorController extends Controller
{

    public function create()
    {
        //ni idea momento de locura
        return view('inscripcion.create');
    }

    public function guardar_preinscripcion($id_competidor, $id_competencia, $id_categoria)
    {
        $duplicado = CompetenciaCompetidor::where('idCompetencia', '=', $id_competencia)->where('idCompetidor', '=', $id_competidor)->first();

        if ($duplicado != null) {
            return false;
        }

        $competenciacompetidor = new CompetenciaCompetidor();
        $competenciacompetidor->idCompetidor = $id_competidor;
        $competenciacompetidor->idCompetencia = $id_competencia;
        $competenciacompetidor->idCategoria = $id_categoria;
        $competenciacompetidor->puntaje =  10;
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
        $competenciacompetidor->puntaje =  10;
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

    public function habilitar($id)
    {

        $CompetidorCompetencia = CompetenciaCompetidor::find($id);
        $CompetidorCompetencia->estado = true;
        $CompetidorCompetencia->save();

        return redirect()->route('tabla_competidores', ['id' => $CompetidorCompetencia->idCompetencia])->with('success', 'Competidor habilitado exitosamente.');
    }

    public function listarCompetidoresPorId($id)
    {
        $competidoresCompetencia = array();

        $data = CompetenciaCompetidor::where('idCompetencia', $id)->get();

        foreach ($data as $competidor) {
            $dato = array(
                'idCompetenciaCompetidor' => $competidor->idCompetenciaCompetidor,
                'gal' => $competidor->competidor->gal,
                'nombre' => $competidor->competidor->nombre,
                'apellido' => $competidor->competidor->apellido,
                'estado' => $competidor->estado,
                'idUser' => $competidor->idCompetidor,
                'tiene_poomsae_asignado' => 0
            );

            if ($competidor->estado != 0) {
                $existe_tupla = CompetenciaCompetidorPoomsae::where('idCompetenciaCompetidor', '=', $competidor->idCompetenciaCompetidor)->first();

                if ($existe_tupla != null) {
                    $dato['tiene_poomsae_asignado'] = 1;
                }
            }

            $competidoresCompetencia[] = $dato;
        }

        $competencia = Competencia::find($id);

        return view('tablaCompetenciaCompetidores.index_CompetenciaCompetidores', ['competidoresCompetencia' => $competidoresCompetencia, 'competencia' => $competencia]);
    }

    public function puntajeFinal($id)
    {
        $CompetidorCompetencia = CompetenciaCompetidor::find($id);

        //busca las 2 pasadas
        $primeraPasada = Puntaje::where('idCompetenciaCompetidor', '=', $CompetidorCompetencia->idCompetenciaCompetidor)->where('pasada', '=', '1')->first();
        $segundaPasada = Puntaje::where('idCompetenciaCompetidor', '=', $CompetidorCompetencia->idCompetenciaCompetidor)->where('pasada', '=', '2')->first();

        //calcula el puntaje de exactitud
        $exactitud = ($primeraPasada->puntajeExactitud + $segundaPasada->puntajeExactitud) / 2;

        //calcula el puntaje de presentacion
        $presentacion = ($primeraPasada->puntajePresentacion + $segundaPasada->puntajePresentacion) / 2;

        $total = $exactitud + $presentacion;

        //le asigno el total al competidorCompetencia
        $CompetidorCompetencia->puntaje = $total;
        $CompetidorCompetencia->save();

        $competidor = Competidor::find($CompetidorCompetencia->idCompetidor);
        return view('puntuador/puntajeFinal', ['competenciaCompetidor' => $CompetidorCompetencia, 'primeraPasada' => $primeraPasada, 'segundaPasada' => $segundaPasada, 'competidor' => $competidor]);
    }


    /*Esto para lo del puntuador y jueces */
    public function validarJueces(Request  $request)
    {
        $idCompetencia = $request['idCompetencia'];
        $idCompetidor = $request['idCompetidor'];
        $numPasada = $request['numPasada'];


        //busco todos los puntajes de esa competencia y ese competidor
        $cantJueces = Competencia::find($idCompetencia)->cantidadJueces;
        $competenciaCompetidor = CompetenciaCompetidor::where('idCompetencia', $idCompetencia)->where('idCompetidor', $idCompetidor)->first();
        $puntajes = Puntaje::where('idCompetenciaCompetidor', $competenciaCompetidor->idCompetenciaCompetidor)->where('pasada', $numPasada)->get();


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
        $idCompetencia = $request['idCompetencia'];
        $idCompetidor = $request['idCompetidor'];
        $numPasada = $request['numPasada'];

        //busco los puntajes correspondientes
        $competenciaCompetidor = CompetenciaCompetidor::where('idCompetencia', $idCompetencia)->where('idCompetidor', $idCompetidor)->first();
        $puntajes = Puntaje::where('idCompetenciaCompetidor', $competenciaCompetidor->idCompetenciaCompetidor)->where('pasada', $numPasada)->get();

        //por cada pasada sumo los puntajes de exactitud y presentacion
        $presentacion = 0;
        $exactitud = 0;
        foreach ($puntajes as $puntaje) { {
                $presentacion = $presentacion + $puntaje->puntajePresentacion;
                $exactitud = $exactitud + $puntaje->puntajeExactitud;
            }
        }

        $cantJueces = Competencia::find($idCompetencia)->cantidadJueces;
        $presentacion = $presentacion / $cantJueces;
        $exactitud = $exactitud / $cantJueces;

        //Le aumento el contador de pasadas
        $competenciaCompetidor->contadorPasadas = $competenciaCompetidor->contadorPasadas + 1;
        $competenciaCompetidor->save();

        $response = [
            'totalPresentacion' => round($presentacion, 1),
            'totalExactitud' => round($exactitud, 1),
            'totalPasada' => round($exactitud + $presentacion, 1),
        ];

        return response()->json($response);
    }
}
