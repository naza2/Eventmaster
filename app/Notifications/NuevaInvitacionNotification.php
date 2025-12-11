<?php

namespace App\Notifications;

use App\Models\Invitacion;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NuevaInvitacionNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public Invitacion $invitacion;

    public function __construct(Invitacion $invitacion)
    {
        $this->invitacion = $invitacion;
    }

    /**
     * Canales de notificación
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Email de notificación
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('¡Te han invitado a unirte a ' . $this->invitacion->equipo->nombre_equipo . '!')
            ->markdown('emails.invitacion-equipo', [
                'invitacion' => $this->invitacion,
                'equipo' => $this->invitacion->equipo,
                'evento' => $this->invitacion->equipo->evento,
                'invitante' => $this->invitacion->invitante,
                'urlAceptar' => route('invitaciones.aceptar', $this->invitacion),
                'urlRechazar' => route('invitaciones.rechazar', $this->invitacion),
            ]);
    }

    /**
     * Datos para la base de datos
     */
    public function toArray(object $notifiable): array
    {
        return [
            'tipo' => 'invitacion_equipo',
            'invitacion_id' => $this->invitacion->id,
            'equipo_id' => $this->invitacion->equipo_id,
            'equipo_nombre' => $this->invitacion->equipo->nombre_equipo,
            'evento_nombre' => $this->invitacion->equipo->evento->nombre,
            'invitante_nombre' => $this->invitacion->invitante->name,
            'mensaje' => $this->invitacion->mensaje,
        ];
    }
}
