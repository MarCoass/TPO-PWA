<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotificacionGeneral extends Notification
{
    use Queueable;
   private $estado;
   private $titulo;
   private $mensaje;
   private $descripcion;

    /**
     * Crear una nueva instancia de la notificación
     *
     * @param string $estado $titulo $mensaje $descripcion
     * @return void
     */
    public function __construct($estado, $titulo, $mensaje, $descripcion)
    {
        $this->estado = $estado;
        $this->titulo = $titulo;
        $this->mensaje = $mensaje;
        $this->descripcion = $descripcion;
    }

    /**
     * Obtener los canales de entrega de la notificación
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database']; 
       /*  return ['database']; */
    }

    /**
     * Obtener la representación del correo de la notificación
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

    // Creas una instancia de MailMessage
    $mail = new MailMessage;

    // Le asignas las propiedades que quieras
    $mail->theme($this->estado);
    $mail->subject($this->titulo);
    $mail->greeting($this->titulo);
    $mail->line($this->mensaje);

    // Usas un bucle para agregar las líneas del array al final del email
    if (is_array($this->descripcion)) {
        // La variable es un array, puedes usar un bucle para recorrerla
        foreach ($this->descripcion as $dato) {
            $mail->line($dato);
        }
    } else {
        // La variable no es un array, puedes usarla directamente
        $mail->line($this->descripcion);
    }

    // Devuelves la instancia de MailMessage
    return $mail;
    }

    /**
     * Obtener la representación del array de la notificación
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'estado' => $this->estado,
            'titulo' => $this->titulo,
            'mensaje' => $this->mensaje,
            'descripcion' => $this->descripcion,
            'fecha' => now()->format('d/m/Y'),
        ];
    }
}
