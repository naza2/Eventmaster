<?php

namespace App\Notifications;

use App\Models\Ganador;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EquipoGanadorNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public Ganador $ganador;

    public function __construct(Ganador $ganador)
    {
        $this->ganador = $ganador;
    }

    /**
     * Canales de notificación: Email + Web
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Email de notificación
     */
    public function toMail(object $notifiable): MailMessage
    {
        $posiciones = [
            1 => 'Primer Lugar',
            2 => 'Segundo Lugar',
            3 => 'Tercer Lugar',
        ];

        $posicion = $posiciones[$this->ganador->posicion] ?? $this->ganador->posicion . '° Lugar';

        return (new MailMessage)
            ->subject('¡Felicidades! Han ganado el ' . $posicion . ' en ' . $this->ganador->evento->nombre)
            ->markdown('emails.equipo-ganador', [
                'ganador' => $this->ganador,
                'equipo' => $this->ganador->equipo,
                'evento' => $this->ganador->evento,
                'urlConstancia' => route('constancia.generar', $this->ganador),
            ]);
    }

    /**
     * Datos para la base de datos (campana de notificaciones)
     */
    public function toArray(object $notifiable): array
    {
        $posiciones = [
            1 => 'Primer Lugar',
            2 => 'Segundo Lugar',
            3 => 'Tercer Lugar',
        ];

        $posicion = $posiciones[$this->ganador->posicion] ?? $this->ganador->posicion . '° Lugar';

        return [
            'tipo' => 'equipo_ganador',
            'ganador_id' => $this->ganador->id,
            'equipo_id' => $this->ganador->equipo_id,
            'equipo_nombre' => $this->ganador->equipo->nombre_equipo,
            'evento_id' => $this->ganador->evento->id,
            'evento_nombre' => $this->ganador->evento->nombre,
            'posicion' => $this->ganador->posicion,
            'posicion_texto' => $posicion,
            'premio' => $this->ganador->premio,
            'mensaje' => '¡Felicidades! Su equipo ha ganado el ' . $posicion . ' en ' . $this->ganador->evento->nombre,
        ];
    }
}
