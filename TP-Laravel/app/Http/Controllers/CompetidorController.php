<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Models\Pais;
use App\Models\Competidor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompetidorController extends Controller
{
 
    public function index()
    {
        return view('ej6\tablaCompetidores',);
    }

   public function obtenerRegistros()
    {
        
        $competidores = Competidor::select('competidores.*', 'paises.nombrePais as nombre_pais')
        ->join('paises', 'competidores.idPais', '=', 'paises.idPais')
        ->get();
    
        return response()->json($competidores);
    } 

    public function create()
    {
        return view('competidores.create');
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
        $competidor->ranking = $request->input('ranking');
        $competidor->graduacion = $request->input('graduacion');
        $competidor->genero = $request->input('genero');

        // Creamos el objeto Pais
        $pais = Pais::find($request['idPais']);
        $competidor->pais()->associate($pais);

        // Creamos el objeto Estado
        $estado = Estado::find($request['idEstado']);
        $competidor->estado()->associate($estado);

        $competidor->save();

        // Respuesta JSON
        $data = [
            'message' => 'El competidor se ha registrado correctamente',
            'data' => $request->all()
        ];

        // Devolver una respuesta JSON
        /* return response()->json($data, 200); */
        return redirect('/competidores')->with('success', "El competidor se ha registrado correctamente");
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
        $competidor->graduacion = $request->input('graduacion');
        $competidor->genero = $request->input('genero');
        $competidor->idPais = $request->input('idPais');
        $competidor->idEstado = $request->input('idEstado');

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
    public function validar(Request $request){
        $result = [];

        $duplicado = Competidor::where($request->input('campo'), "=", $request->input('valor'))->first();

        if(!is_null($duplicado)){
            $result["success"] = 0;
            $result["error"] = "Este " . strtoupper($request->input('campo')) . " ya se encuentra registrado.";
        }

        if(count($result) == 0){
            $result['success'] = 1;
        }

        return response()->json($result);
    }
}



