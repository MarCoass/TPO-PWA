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
            
        
            $duplicadoUser = User::where('usuario', "=",$request->input('usuario'))->first();
            $duplicadoCorreo = User::where('correo', "=",$request->input('correo'))->first();

            //Verificar que el el noombre de usuario no este registrado en la tabla usuarios y despues verifica si el nombre del usuario
            //actual se puede modificar
            if ($duplicadoUser != null && $usuario->usuario != $request->input('usuario') ) {
        
                $arregloMensaje = [
                    'tipo' => 'restringed',
                    'mensaje' => 'Nombre de usuario ya existe, por favor ingrese otro.'
                ];

                //este hace lo mismo pero con el campo correo
            }elseif ($duplicadoCorreo != null && $usuario->correo != $request->input('correo')) {
                
                $arregloMensaje = [
                    'tipo' => 'restringed',
                    'mensaje' => 'El Correo ya existe, por favor ingrese otro.'
                ];
            }else {
                $usuario->nombre = $request->input('nombre');
                $usuario->apellido = $request->input('apellido');
                $usuario->usuario = $request->input('usuario');
                $usuario->correo = $request->input('correo');
                $usuario->save();
                $arregloMensaje = [
                    'tipo' => 'success',
                    'mensaje' => 'Datos Actualizados Correctamente.'
                ];
            }
               
        }else {
            
            $arregloMensaje = [
                'tipo' => 'restringed',
                'mensaje' => 'Contraseña Incorrecta.'
            ];
        }

        return redirect()->route('verPerfil')->with($arregloMensaje['tipo'], $arregloMensaje['mensaje']);
    }

    public function actualizarPassword(Request $request)
    {
        $usuario = User::find($request->input('id'));

        if($request->input('passwordnueva') == $request->input('passwordnueva2')){
            if(password_verify($request->input('passwordactual'), $usuario->password) ) {
            
                $usuario->password = $request->input('passwordnueva');
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
        }else{
            $arregloMensaje = [
                'tipo' => 'restringed',
                'mensaje' => 'Las contraseñas deben coincidir.'
            ];
        }

        return redirect()->route('verPerfil')->with($arregloMensaje['tipo'], $arregloMensaje['mensaje']);
    }


}
