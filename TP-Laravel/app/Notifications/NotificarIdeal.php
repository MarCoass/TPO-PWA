<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotificarIdeal extends Notification
{
    use Queueable;

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
                    ->theme($this->estado)
                    ->subject($this->titulo)
                    ->greeting($this->titulo)
                    ->line($this->mensaje)
                    ->line($this->descripcion);
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
