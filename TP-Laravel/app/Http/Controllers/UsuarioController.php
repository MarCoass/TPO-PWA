<?php

/* habria que ver de cambiar el nombre a user, mas que nada por compatibilidad, cambiar lo necesario */

/* modificar campos: clave -> password  */

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rol;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        return view('gestionUsuarios.index_usuarios', compact('usuarios'));
    }

    public function create()
    {
        return view('gestionUsuarios.create_usuario');
    }

    public function store(Request $request)
    {
        $usuario = new User();
        $usuario->nombre = $request->input('nombre');
        $usuario->apellido = $request->input('apellido');
        $usuario->usuario = $request->input('usuario');
        $usuario->correo = $request->input('correo');
        $usuario->password = $request->input('clave');
        $usuario->idRol = $request->input('rol');

        $usuario->save();

        return redirect()->route('index_usuarios')->with('success', 'Usuario creado exitosamente.');
    }

    public function show($id)
    {
        $usuario = User::find($id);
        return view('gestionUsuarios.show', compact('usuario'));
    }

    public function edit($id)
    {
        $usuario = User::find($id);
        return view('gestionUsuarios.edit_usuario', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $usuario = User::find($id);
        $usuario->nombre = $request->input('nombre');
        $usuario->apellido = $request->input('apellido');
        $usuario->usuario = $request->input('usuario');
        $usuario->correo = $request->input('correo');
        $usuario->password = $request->input('clave');
        $usuario->idRol = $request->input('rol');
        $usuario->save();

        return redirect()->route('index_usuarios')->with('success', 'Usuario actualizado exitosamente.');
    }

    public function habilitar($id){
        $usuario = User::find($id);
        $usuario->estado = true;
        $usuario->save();

        return redirect()->route('index_usuarios')->with('success', 'Usuario habilitado exitosamente.');
    }

    public function destroy($id)
    {
        $usuario = User::find($id);
        $usuario->delete();

        return redirect()->route('index_usuarios')->with('success', 'Usuario eliminado exitosamente.');
    }


    public function actualizarDatosPersonales(Request $request)
    {
        $usuario = User::find($request->input('id'));

    
        if (password_verify($request->input('password'), $usuario->password) ) {
            
            $usuario->nombre = $request->input('nombre');
            $usuario->apellido = $request->input('apellido');
            $usuario->usuario = $request->input('usuario');
            $usuario->correo = $request->input('correo');
            $usuario->save();

            $arregloMensaje = [
                'tipo' => 'success',
                'mensaje' => 'Tus datos se actualizaron exitosamente.'
            ];

        }else {
            
            $arregloMensaje = [
                'tipo' => 'restringed',
                'mensaje' => 'Contraseña Incorrecta.'
            ];
        }

        return redirect()->route('verPerfil')->with($arregloMensaje['tipo'], $arregloMensaje['mensaje']);
    }


}
