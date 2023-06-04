<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\CategoriaGraduacion;
use App\Models\Graduacion;
use Illuminate\Http\Request;


class CategoriaGraduacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idCategoria)
    {
        $categoria = Categoria::find($idCategoria);
        
        $categoriaGraduacion = Graduacion::select('graduaciones.nombre','categoriagraduacion.idCategoriaGraduacion')
        ->join('categoriagraduacion', 'graduaciones.idGraduacion', '=', 'categoriagraduacion.idGraduacion')->
        where('categoriagraduacion.idCategoria','=',$idCategoria)->get();

        return view('gestionCategoriaGraduaciones.index', compact('categoriaGraduacion','categoria'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idCategoria)
    {
        //filtrar que no esten ya relacionadas con la categoria
        $graduaciones = Graduacion::all();
        $categoria_graduaciones = CategoriaGraduacion::where('idCategoria','=',$idCategoria);

        return view('gestionCategoriaGraduaciones.create', compact('idCategoria','graduaciones','categoria_graduaciones'));
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $duplicado = CategoriaGraduacion::where('idCategoria','=', $request->input('idCategoria'))->
        where('idGraduacion','=', $request->input('graduacion'))->first();

        if( $duplicado != null){
            return redirect()->route('ver_graduaciones', ['idCategoria' => $request->input('idCategoria') ])->with('success', 'Ya existe esa relacion Categoria Graduacion.');
        }

        $data = new CategoriaGraduacion();
        $data->idCategoria = $request->input('idCategoria');
        $data->idGraduacion = $request->input('graduacion');
     
        $data->save();

        return redirect()->route('ver_graduaciones', ['idCategoria' => $request->input('idCategoria') ])->with('success', 'Categoria Graduacion se creo exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoriaGraduacion = CategoriaGraduacion::find($id);
        $graduaciones = Graduacion::all();
        
        return view('gestionCategorias.edit', compact('categoriaGraduacion','graduaciones'));
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
        $categoria_graduacion = CategoriaGraduacion::find($id);
        $categoria_graduacion->idGraduacion = $request->input('graduacion');
        $categoria_graduacion->save();

        return redirect()->route('ver_graduaciones', ['idCategoria' => $categoria_graduacion->idCategoria ])->with('success', 'Categoria Graduacion actualizada exitosamente.');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria_graduacion = CategoriaGraduacion::find($id);
        $id_categoria = $categoria_graduacion->idCategoria;
        $categoria_graduacion->delete();

        return redirect()->route('ver_graduaciones', ['idCategoria' => $id_categoria ])->with('success', 'Categoria Graduacion eliminada exitosamente.');
    
    }

}
