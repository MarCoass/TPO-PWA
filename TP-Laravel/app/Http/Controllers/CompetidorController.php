<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Models\Pais;
use App\Models\Competidor;
use App\Models\Graduacion;
use App\Models\Competencia;
use App\Models\Escuela;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CompetenciaCompetidorController;
use App\Models\CompetenciaCompetidor;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\SolicitudController;
use Illuminate\Http\Request;

class CompetidorController extends Controller
{

    public function cargarCompetidor()
    {
        // Obtiene todas las competencias que ya tienen todos los jueces requeridos
        $competencias = Competencia::where('estadoJueces', true)->where('estadoCompetencia', 0)->get();

        $graduaciones = Graduacion::all();

        return view('cargarCompetidor.cargarCompetidor', compact('graduaciones', 'competencias'));
    }

    public function index()
    {
        $competidores = Competidor::all();

        return view('tablaCompetidores.tablaCompetidores', ['competidores' => $competidores]);
    }

    public function obtenerRegistros()
    {

        $competidores = Competidor::select('competidores.*', 'paises.nombrePais as nombre_pais')
            ->join('paises', 'competidores.idPais', '=', 'paises.idPais')
            ->get();

        return response()->json($competidores);
    }

    public function obtenerRanking(Request $request)
    {
        $competidoresMasculinos = $this->buscarCompetidoresPorGeneroYcategoria($request['idCategoria'], 0);
        $competidoresFemeninos = $this->buscarCompetidoresPorGeneroYcategoria($request['idCategoria'], 1);

        /*   $competidoresTotal[0] = $competidoresMasculinos;
        $competidoresTotal[1] = $competidoresFemeninos; */

        return compact('competidoresMasculinos', 'competidoresFemeninos');
    }


    public function buscarCompetidoresPorGeneroYcategoria($idCategoria, $genero)
    {
        $competidores = CompetenciaCompetidor::join('competidores', function ($join) {
            $join->on('competenciacompetidor.idCompetidor', '=', 'competidores.idCompetidor')
                ->where('competidores.ranking', '>', 0);
        })
            ->join('competencias', 'competenciacompetidor.idCompetencia', '=', 'competencias.idCompetencia')
            ->select('competenciacompetidor.*', 'competidores.nombre')
            ->where('competenciacompetidor.idCategoria', $idCategoria)
            ->where('competidores.genero', $genero)
            ->whereYear('competencias.fecha', 2023)
            ->orderBy('competidores.ranking', 'desc')
            ->get();


        $puesto = 1;
        foreach ($competidores as $comp) {

            $comp['puesto'] = $puesto;

            $competidor = Competidor::find($comp->idCompetidor);
            $comp['nombre'] = $competidor->nombre . " " . $competidor->apellido;

            $pais = Pais::find($competidor->idPais);
            $estado = Estado::find($competidor->idEstado);
            $comp['lugar'] = $pais->nombrePais . " - " . $estado->nombreEstado;

            $comp['ranking'] = $competidor->ranking;

            $comp['genero'] = $competidor->genero;

            $puesto++;
        }

        return $competidores;
    }


    public function create()
    {
        return view('competidores.create');
    }

    public function vistaReinscribirCompetidor()
    {
        $usuario = auth()->user();
        $idUsuario = $usuario->id;
        $idEscuela = $usuario->idEscuela;

        $competidor = Competidor::where('idUser', '=', $idUsuario)->first();
        $pais = Pais::find($competidor->idPais);
        $estado = Estado::find($competidor->idEstado);

        // Obtiene todas las competencias que ya tienen todos los jueces requeridos
        $competencias = Competencia::whereNotExists(function ($query) use ($competidor) {
            $query->select(DB::raw(1))
                ->from('competenciaCompetidor')
                ->whereRaw('competenciaCompetidor.idCompetencia = competencias.idCompetencia')
                ->where('competenciaCompetidor.idCompetidor', $competidor->idCompetidor);
        })->get();
        $graduacion1 = Graduacion::where('idGraduacion', '=', $competidor->idGraduacion)->first();
        $graduaciones = Graduacion::where('idGraduacion', '>', $competidor->idGraduacion)
            ->orderBy('idGraduacion', 'desc')
            ->get();

        if ($graduacion1->color != "Cinturón negro") {
            $galDesactivado = "disabled";
        } else {
            $galDesactivado = "";
        }

        $graduaciones->prepend($graduacion1);

        //Obtenemos las escuelas
        $escuela1 = Escuela::where('idEscuela', '=', $idEscuela)->first();
        
        // Obtenemos todas las escuelas excepto la escuela1
        $escuelas = Escuela::whereNotIn('idEscuela', [$escuela1->idEscuela])
            ->orderBy('idEscuela', 'desc')
            ->get();

        // Agregamos la escuela1 al principio de la colección
        $escuelas->prepend($escuela1);

        return view('cargarCompetidor.reinscribirseCompetencia', compact('graduaciones', 'competencias', 'competidor', 'escuelas', 'galDesactivado'));
    }

    public function reinscribirCompetidor(Request $request)
    {
        $competidor = Competidor::find($request['idCompetidor']);
        $competidor->nombre = $request->input('nombre');
        $competidor->apellido = $request->input('apellido');
        $competidor->du = $request->input('du');
        $competidor->gal = $request->input('gal');
        $competidor->fechaNacimiento = $request->input('fechaNacimiento');
        $competidor->email = $request->input('correo');
        $competidor->genero = $request->input('genero');

        // Creamos el objeto Pais
        $pais = Pais::find($request['idPais']);
        $competidor->pais()->associate($pais);

        // Creamos el objeto Estado
        $estado = Estado::find($request['idEstado']);
        $competidor->estado()->associate($estado);

        //Actualizamos los datos del competidor
        $competidor->save();

        //Generamos la inscripcion a la competencia
        $CompetenciaCompetidorController = new CompetenciaCompetidorController();

        $categoria = Graduacion::select('categoriagraduacion.idCategoria')
            ->join('categoriagraduacion', 'graduaciones.idGraduacion', '=', 'categoriagraduacion.idGraduacion')->where('graduaciones.idGraduacion', '=', $request->input('graduacionActual'))->get();

        $CompetenciaCompetidorController->guardar_preinscripcion($competidor->idCompetidor, $request->input('competencia'), $categoria[0]->idCategoria);

        //Solicitar cambios de escuela o graduacion si uno de los check fue seleccionado
        if ($request->boolean('checkGraduacion') || $request->boolean('checkEscuela')) {
            //Preparamos el request
            $arregloSolicitud = [
                'idUser' => $competidor->idUser,
                'newEscuela' => 0,
                'newGraduacion' => 0
            ];

            //Verificamos ambos check para saber si hacemos el cambio o no y de qué

            if ($request->boolean('checkEscuela')) {
                $arregloSolicitud['newEscuela'] = $request->input('idEscuela');
            }
            if ($request->boolean('checkGraduacion')) {
                $arregloSolicitud['newGraduacion'] = $request->input('idGraduacion');
            }

            $objSolicitud = new SolicitudController;
            $objSolicitud->generarSolicitud(new Request($arregloSolicitud));
        }
        return redirect('/')->with('success', "Se ha inscripto correctamente a la competencia. Quedó en espera de verificación.");
    }

    public function store(Request $request)
    {
        $competidor = new Competidor();
        $competidor->du = $request->input('du');
        $competidor->gal = $request->input('gal');
        $competidor->nombre = $request->input('nombre');
        $competidor->apellido = $request->input('apellido');
        $competidor->fechaNacimiento = $request->input('fechaNacimiento');
        $competidor->email = $request->input('correo');
        $competidor->ranking = 0; // 0 por defecto
        $competidor->genero = $request->input('genero');

        // Estado base
        $competidor->estado = false;

        // Creamos el objeto Graduacion
        $graduacion = Graduacion::find($request['idGraduacion']);
        $competidor->graduacion()->associate($graduacion);

        // Creamos el objeto Pais
        $pais = Pais::find($request['idPais']);
        $competidor->pais()->associate($pais);

        // Creamos el objeto Estado
        $estado = Estado::find($request['idEstado']);
        $competidor->estado()->associate($estado);

        // Creamos el objeto User
        $user = User::find($request['idUser']);
        $competidor->user()->associate($user);

        $competidor->save();

        $CompetenciaCompetidorController = new CompetenciaCompetidorController();

        $categoria = Graduacion::select('categoriagraduacion.idCategoria')
            ->join('categoriagraduacion', 'graduaciones.idGraduacion', '=', 'categoriagraduacion.idGraduacion')->where('graduaciones.idGraduacion', '=', $request['idGraduacion'])->get();

        $CompetenciaCompetidorController->guardar_preinscripcion($competidor->idCompetidor, $request->input('competencia'), $categoria[0]->idCategoria);

        return redirect('/')->with('success', "Se ha inscripto correctamente a la competencia. Quedó en espera de verificación.");
    }

    public function show($id)
    {
        $competidor = Competidor::find($id);
        return $competidor;
    }

    public function edit($id)
    {
        $competidor = Competidor::find($id);
        return $competidor;
    }

    public function update(Request $request, $id)
    {
        $competidor = Competidor::find($id);
        $competidor->du = $request->input('du');
        $competidor->gal = $request->input('gal');
        $competidor->nombre = $request->input('nombre');
        $competidor->apellido = $request->input('apellido');
        $competidor->fechaNacimiento = $request->input('fechaNacimiento');
        $competidor->correo = $request->input('correo');
        $competidor->ranking = $request->input('ranking');
        $competidor->idGraduacion = $request->input('idGraduacion');
        $competidor->genero = $request->input('genero');
        $competidor->idPais = $request->input('idPais');
        $competidor->idEstado = $request->input('idEstado');
        $competidor->idUser = $request->input('idUser');

        $competidor->save();

        return $competidor;
    }

    public function destroy($id)
    {
        $competidor = Competidor::find($id);
        $competidor->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado exitosamente.');
    }

    /**
     * Dado un campo especial (gal, du, email), valida si este ya existe en la db
     * @return JSON claves "success" (1 si no existe | 0 si existe) y "error" (mensaje de error)
     */
    public function validar(Request $request)
    {
        $result = [];

        $duplicado = Competidor::where($request->input('campo'), "=", $request->input('valor'))->first();

        if (!is_null($duplicado)) {
            $result["success"] = 0;
            $result["error"] = "Este " . strtoupper($request->input('campo')) . " ya se encuentra registrado.";
        }

        if (count($result) == 0) {
            $result['success'] = 1;
        }

        return response()->json($result);
    }
}
