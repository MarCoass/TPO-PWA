<?php

namespace App\Http\Controllers;

use App\Models\Competencia;
use App\Models\Competidor;
use App\Models\CompetenciaCompetidor;
use App\Models\CompetenciaJuez;
use App\Models\Categoria;
use App\Models\User;
use App\Models\Escuela;
use App\Models\Poomsae;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Psy\Readline\Hoa\Console;

class CompetenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $competencias = Competencia::withCount([
            'competenciaJuez' => function ($query) {
                $query->where('estado', true);
            },
        ])->get();

        return view('gestionCompetencias.index', compact('competencias'));
    }

    public function JuecesEsperandoSerConfirmados($idCompetencia)
    {
        return CompetenciaJuez::where('estado', '=', '0')
            ->where('idCompetencia', '=', $idCompetencia)
            ->exists();
    }

    public function CompetidoresEsperandoSerConfirmados($idCompetencia)
    {
        return CompetenciaCompetidor::where('estado', '=', '0')
            ->where('idCompetencia', '=', $idCompetencia)
            ->exists();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Solo pueden crearlo los administradores
        return view('gestionCompetencias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $competencia = new Competencia();
        $competencia->nombre = $request->input('nombre');
        $competencia->fecha = $request->input('fecha');
        $competencia->cantidadJueces = $request->input('cantidadJueces');
        // estadoJueces tiene por defecto false en la db

        if ($request->hasFile('flyer')) {
            $extension = $request->file('flyer')->getClientOriginalExtension();
            $nombreSinEspacios = str_replace(' ', '', $request->input('nombre'));
            $nombreFlyer = $nombreSinEspacios . 'Flyer.' . $extension;
            $pathFlyer = $request->file('flyer')->storeAs('/img', $nombreFlyer, 'public');
            $competencia->flyer = $pathFlyer;
        }

        if ($request->hasFile('bases')) {
            $competencia->bases = $request->file('bases')->storeAs('/pdf', $nombreSinEspacios . 'Bases.pdf', 'public');
        }

        if ($request->hasFile('invitacion')) {
            $competencia->invitacion = $request->file('invitacion')->storeAs('/pdf', $nombreSinEspacios . 'Invitacion.pdf', 'public');
        }

        $competencia->save();

        return redirect()
            ->route('index_competencia')
            ->with('success', 'Competencia creada exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $competencia = Competencia::find($id);
        return view('gestionCompetencias.show', compact('competencia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $competencia = Competencia::find($id);
        $juecesAceptados = CompetenciaJuez::where('estado', true)
            ->where('idCompetencia', $id)
            ->get();
        return view('gestionCompetencias.edit', compact('competencia', 'juecesAceptados'));
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
        $competencia = Competencia::find($id);
        $competencia->nombre = $request->input('nombre');
        $competencia->fecha = $request->input('fecha');

        $juecesAceptados = CompetenciaJuez::where('estado', true)
            ->where('idCompetencia', $competencia->idCompetencia)
            ->get();

        // No permite modificar la cantidad si ya la competencia
        // está abierta a competidores o si ya existe al menos un juez cargado
        if ($competencia->estadoJueces == false && count($juecesAceptados) == 0) {
            $competencia->cantidadJueces = $request->input('cantidadJueces');
        }

        $nombreSinEspacios = str_replace(' ', '', $request->input('nombre'));
        if ($request->hasFile('flyer')) {
            $extension = $request->file('flyer')->getClientOriginalExtension();
            $nombreFlyer = $nombreSinEspacios . 'Flyer.' . $extension;
            $pathFlyer = $request->file('flyer')->storeAs('/img', $nombreFlyer, 'public');
            $competencia->flyer = $pathFlyer;
        }

        if ($request->file('bases') != null) {
            $competencia->bases = $request->file('bases')->storeAs('/pdf', $nombreSinEspacios . 'Bases.pdf', 'public');
        }

        if ($request->file('invitacion') != null) {
            $competencia->invitacion = $request->file('invitacion')->storeAs('/pdf', $nombreSinEspacios . 'Invitacion.pdf', 'public');
        }

        $competencia->save();

        return redirect()
            ->route('index_competencia')
            ->with('success', 'Competencia actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $competencia = Competencia::find($id);
        $competencia->delete();

        return redirect()
            ->route('index_competencia')
            ->with('success', 'Competencia eliminada exitosamente.');
    }

    public function verPresentacion($id)
    {
        //busco la competencia
        $competencia = Competencia::find($id);
        return view('presentacion/verCompetencia', compact('competencia'));
    }

    public function verResultados($idCompetencia)
    {
        $categoriasFiltradas = [];
        $categorias = Categoria::all();
        $competenciasCompetidores = CompetenciaCompetidor::where('idCompetencia', $idCompetencia)->get();

        // Buscamos las categorias en esa competencia
        foreach ($categorias as $categoria) {
            foreach ($competenciasCompetidores as $cC) {
                if ($cC->idCategoria === $categoria->idCategoria) {
                    // Utilizar el idCategoria como clave del array categoriasFiltradas
                    $categoriasFiltradas[$categoria->idCategoria] = $categoria;
                }
            }
        }

        // Obtener las categorías filtradas como un array sin claves
        $categoriasFiltradas = array_values($categoriasFiltradas);

        //busco la competencia
        $competencia = Competencia::find($idCompetencia);

        return view('presentacion/verResultadosCompetencia', compact('categoriasFiltradas', 'competencia'));
    }

    public function traerCompetidores(Request $request)
    {
        $competidoresFiltrados = [];
        //Traemos los competidores ordenados por puntaje
        $competidoresCompetencia = CompetenciaCompetidor::where('idCompetencia', $request['idCompetencia'])
            ->where('idCategoria', $request['idCategoria'])
            ->orderBy('puntaje', 'desc')
            ->get();

        $contador = 1;

        foreach ($competidoresCompetencia as $cC) {
            //Obtenemos el competidor
            $competidor = Competidor::find($cC->idCompetidor);
            //Obtenemos el user de ese competidor para obtener la escuela
            $userCompetidor = User::find($competidor->idUser);

            $escuelaCompetidor = Escuela::find($userCompetidor->idEscuela);

            $competidor['escuela'] = $escuelaCompetidor->nombre;

            $puntos = $cC->puntaje;

            $competidor['puntaje'] = $puntos;

            $competidor['puesto'] = $contador;

            $competidor['nombre'] = $competidor->nombre . ' ' . $competidor->apellido;

            array_push($competidoresFiltrados, $competidor);
            $contador++;
        }

        return compact('competidoresFiltrados');
    }

    public function verCompetencias()
    {
        $competencias = Competencia::where('estadoJueces', 1)->get();
        return view('presentacion.competencias', compact('competencias'));
    }

    public function competenciasCalendario()
    {
        if (auth()->user()->idRol == 1 || auth()->user()->idRol == 2) {
            $competencias = Competencia::select('idCompetencia', 'nombre', 'fecha', 'estadoJueces', 'estadoCompetencia')->get();
        } else {
            $competencias = Competencia::select('idCompetencia', 'nombre', 'fecha', 'estadoJueces', 'estadoCompetencia')
                ->where('estadoJueces', 1)
                ->get();
        }
        return compact('competencias');
    }
}
