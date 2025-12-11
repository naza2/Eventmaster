<?php

namespace App\Notifications;

use App\Models\Invitacion;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvitacionAceptadaNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public Invitacion $invitacion;

    public function __construct(Invitacion $invitacion)
    {
        $this->invitacion = $invitacion;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject($this->invitacion->invitado->name . ' aceptó tu invitación')
            ->markdown('emails.invitacion-aceptada', [
                'invitacion' => $this->invitacion,
                'equipo' => $this->invitacion->equipo,
            ]);
    }

    public function toArray(object $notifiable): array
    {
        return [
            'tipo' => 'invitacion_aceptada',
            'invitacion_id' => $this->invitacion->id,
            'equipo_id' => $this->invitacion->equipo_id,
            'equipo_nombre' => $this->invitacion->equipo->nombre_equipo,
            'invitado_nombre' => $this->invitacion->invitado->name,
        ];
    }
}
