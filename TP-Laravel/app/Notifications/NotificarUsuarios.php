<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotificarUsuarios extends Notification
{
    use Queueable;

    /**
     * Crear una nueva instancia de la notificación
     *
     * @return void
     */
    public function __construct($mensaje, $saludo)
    {
        $this->mensaje = $mensaje;
        $this->saludo = $saludo;
    }

    /**
     * Obtener los canales de entrega de la notificación
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Obtener la representación del correo de la notificación
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Introduccion a las notificaciones.'.$this->mensaje)
                    ->action('Ir a la notificacion', url('/verPerfil'))
                    ->line('Gracias por usar nuestra App!'.$this->saludo ." " .$notifiable->nombre);
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
            //
        ];
    }
}
