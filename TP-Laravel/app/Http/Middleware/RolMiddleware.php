<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RolMiddleware
{
    /**
     * Este es un middleware personalizado que verifica si el usuario tiene el rol correcto para 
     * acceder a una sección específica de tu aplicación. El middleware recibe tres 
     * parámetros: $request, $next y $role. $request es la instancia de la solicitud actual, 
     * $next es el siguiente objeto Closure en la cadena de middleware y $role es el rol 
     * requerido para acceder a la sección.
     * 
     * El middleware verifica si el usuario actual tiene el rol requerido. 
     * Si es así, el middleware pasa la solicitud al siguiente objeto Closure 
     * en la cadena de middleware usando $next($request). 
     * Si el usuario no tiene el rol requerido, el middleware 
     * redirige al usuario a la página principal con un mensaje
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    
    public function handle(Request $request, Closure $next, $role)
{
     if ($request->user()->idRol == $role) { // if the current role is Administrator
        return $next($request);
     }
     return redirect('/')->with('restringed', "no tiene permisos para acceder a esta seccion");

}

}
