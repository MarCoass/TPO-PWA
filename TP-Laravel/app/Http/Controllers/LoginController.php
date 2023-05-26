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

    public function login(LoginRequest $request)
    {
        $credentials = $request->getCredentials();

        if (!Auth::validate($credentials)) :
            return redirect()->to('login')
                ->withErrors(trans('auth.failed'));
        endif;

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        if ($user->estado == 0) {
            $redireccion = "/login";
            $arregloMensaje = [
                'tipo' => 'restringed',
                'mensaje' => 'Tu cuenta aún sigue sin ser verificada.'
            ];
        } else {
            Auth::login($user);
            $redireccion = "/";
            $arregloMensaje = [
                'tipo' => 'success',
                'mensaje' => 'Login exitoso.'
            ];
        }

        return redirect($redireccion)->with($arregloMensaje['tipo'], $arregloMensaje['mensaje']);
        //return $this->authenticated($request, $user);
    }

    /**
     * Handle response after user authenticated
     * 
     * @param Request $request
     * @param Auth $user
     * 
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended();
    }
}
