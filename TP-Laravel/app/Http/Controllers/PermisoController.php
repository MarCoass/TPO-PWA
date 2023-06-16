<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permiso;
use App\Models\Rol;
use App\Models\RolPermiso;


class PermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permisos = Permiso::with('rolpermiso')->get();
        return view('gestionPermisos.index', compact('permisos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Rol::all();
        return view('gestionPermisos.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permiso = new Permiso;
        $roles = $request->input('roles');

        $permiso->nombrePermiso = $request->input('nombrePermiso');
        $permiso->rutaPermiso = $request->input('rutaPermiso');

        $permiso->save();

        if($roles){
            foreach ($roles as $idRol) {
                $rolPermiso = new RolPermiso;
                $rolPermiso->idRol = $idRol;
                $rolPermiso->idPermiso = $permiso->idPermiso;
                // set any other required data
                $rolPermiso->save();
            }
        }

        return redirect('/permisos')->with('success', "Se ha creado correctamente el permiso.");
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
        $permiso = Permiso::find($id);
        $roles = Rol::all();
        $rolPermisos = RolPermiso::where('idPermiso', $id)->get();

        return view('gestionPermisos.edit', compact('permiso', 'roles', 'rolPermisos'));
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
        $permiso = Permiso::find($id);
        $roles = $request->input('roles');

        $permiso->nombrePermiso = $request->input('nombrePermiso');
        $permiso->rutaPermiso = $request->input('rutaPermiso');

        // Logica para modificar roles
        $rolPermiso = RolPermiso::where('idPermiso', $id)->get();

        // Si se seleccionaron roles, se modifica
        if($roles){
            // Foreach para agregar roles
            foreach ($roles as $idRol) {
                $yaExiste = $rolPermiso->where('idRol', $idRol)->first();
                if (!$yaExiste) {
                    $nuevoRolPermiso = new RolPermiso;
                    $nuevoRolPermiso->idRol = $idRol;
                    $nuevoRolPermiso->idPermiso = $id;
                    // set any other required data
                    $nuevoRolPermiso->save();
                } else {
                    // Reject filtra el arreglo, eliminando todos los
                    // idRol que ya fueron procesados.
                    $rolPermiso = $rolPermiso->reject(function ($item) use ($idRol) {
                        return $item->idRol == $idRol;
                    });
                }
            }
            // Foreach para quitarlos
            foreach ($rolPermiso as $rp) {
                $rp->destroy($rp->id);
            }
        }else{
            // Si no se seleccionaron roles, se eliminan todos
            foreach ($rolPermiso as $rp) {
                $rp->destroy($rp->id);
            }
        }

        $permiso->save();

        return redirect('/permisos')->with('success', "Se ha actualizado correctamente el permiso.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permiso = Permiso::find($id);
        $rolPermiso = RolPermiso::where('idPermiso', $id)->get();

        foreach($rolPermiso as $rp){
            $rp->delete();
        }

        $permiso->delete();

        return redirect('/permisos')->with('success', "Se ha eliminado correctamente el permiso.");
    }
}
