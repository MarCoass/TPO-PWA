<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;

class RegistroController extends Controller
{
    /**
     * Despliega la vista registro ubicada en auth/registro
     * 
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('auth.registro');
    }

    /**
     * una vez completo el registro, al hacer submit, valida que los datos sean correctos
     * Si son correctos 
     * 
     * @param RegisterRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request) 
    {
        /* se valida los datos */
        $user = User::create($request->validated());

        /* autologuea el registro creado */
        auth()->login($user);

        /* redirecciona al home ya logueado */
        return redirect('/')->with('success', "cuenta creada");
    }
}
