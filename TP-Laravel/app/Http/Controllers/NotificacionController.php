<?php
namespace App\Http\Controllers;
use App\Models\Notificacion;
use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    public function index()
    {
        $notificaciones = Notificacion::all();

        // Recorre las notificaciones y convierte los datos a arrays
        foreach ($notificaciones as $notificacion) {
            $notificacion->data = json_decode($notificacion->data, true);
        }
        return view('zeta.index', compact('notificaciones'));
    }

    public function marcarLeido($id)
    {
        $notification = auth()->user()->notifications()->where('id', $id)->first();

    if ($notification) {
        $notification->markAsRead();
    }

    return redirect()->back();
    }
}
