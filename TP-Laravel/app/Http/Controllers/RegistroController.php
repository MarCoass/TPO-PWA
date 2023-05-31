<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\Escuela;

class RegistroController extends Controller
{
    /**
     * Despliega la vista registro ubicada en auth/registro
     * 
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $escuelas = Escuela::all();
        return view('auth.registro', compact('escuelas'));
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

        /* redirecciona al home ya logueado */
        return redirect('/login')->with('success', "Cuenta creada exitosamente. Quedó en espera de verificación.");
    }
}
