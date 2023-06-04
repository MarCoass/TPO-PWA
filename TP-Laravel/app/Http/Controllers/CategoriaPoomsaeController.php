<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\CategoriaPoomsae;
use App\Models\Poomsae;
use Illuminate\Http\Request;


class CategoriaPoomsaeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idCategoria)
    {
        $categoria = Categoria::find($idCategoria);

        $categoriaPoomsae = Poomsae::select('poomsae.nombre','categoriapoomsae.idCategoriaPoomsae')
        ->join('categoriapoomsae', 'poomsae.idPoomsae', '=', 'categoriapoomsae.idPoomsae')->
        where('categoriapoomsae.idCategoria','=',$idCategoria)->get();

        return view('gestionCategoriaPoomsae.index', compact('categoriaPoomsae','categoria'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idCategoria)
    {
        //falta filtrar que no esten ya relacionadas con la categoria
        $poomsae = Poomsae::all();
        return view('gestionCategoriaPoomsae.create', compact('idCategoria','poomsae'));
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $duplicado = CategoriaPoomsae::where('idCategoria','=', $request->input('idCategoria'))->
        where('idPoomsae','=', $request->input('poomsae'))->first();

        if( $duplicado != null){
            return redirect()->route('ver_poomsae', ['idCategoria' => $request->input('idCategoria') ])->with('success', 'Ya existe esa relacion Categoria Graduacion.');
        }

        $data = new CategoriaPoomsae();
        $data->idCategoria = $request->input('idCategoria');
        $data->idPoomsae = $request->input('poomsae');
     
        $data->save();

        return redirect()->route('ver_poomsae', ['idCategoria' => $request->input('idCategoria') ])->with('success', 'Categoria Poomsae se creo exitosamente.');
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
        $categoriaPoomsae = CategoriaPoomsae::find($id);
        $poomsae = Poomsae::all();
        
        return view('gestionCategorias.edit', compact('categoriaPoomsae','poomsae'));
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
        $data = CategoriaPoomsae::find($id);
        $data->idPoomsae = $request->input('poomsae');
        $data->save();

        return redirect()->route('ver_poomsae', ['idCategoria' => $data->idCategoria ])->with('success', 'Categoria Poomsae actualizada exitosamente.');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = CategoriaPoomsae::find($id);
        $id_categoria = $data->idCategoria;
        $data->delete();

        return redirect()->route('ver_poomsae', ['idCategoria' => $id_categoria ])->with('success', 'Categoria Poomsae eliminada exitosamente.');
    
    }

}
