<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{

    /**
     * Muestra pagina de login.
     * 
     * @return Renderable
     */
    public function show()
    {
        return view('auth.login');
    }

    /**
     * Handle account login request
     * 
     * Ver app/http/middleware/RolMiddleware.php
     * 
     * @param LoginRequest $request
     * 
     * @return \Illuminate\Http\Response
     */

    public function perform(LoginRequest $request)
    {
        $credentials = $request->getCredentials();

        if (!Auth::validate($credentials)) :
            return redirect()->to('login')
                ->withErrors(trans('auth.failed'));
        endif;

        /* Aca se carga el objeto usuario */
        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        // Si el usuario no esta habilitado no lo logueamos y lo mandamos de vuelta al formulario de login
        if ($user->estado == 0) {
            $redireccion = "/login";
            $arregloMensaje = [
                'tipo' => 'restringed',
                'mensaje' => 'Tu cuenta aún no está verificada.'
            ];
        } else { // Si esta habilitado lo logeamos y lo mandamos al home
            Auth::login($user);
            $redireccion = "/";
            $arregloMensaje = [
                'tipo' => 'success',
                'mensaje' => 'Login exitoso.'
            ];
        }

        // Hacemos la redirección
        return redirect($redireccion)->with($arregloMensaje['tipo'], $arregloMensaje['mensaje']);
    }
}
