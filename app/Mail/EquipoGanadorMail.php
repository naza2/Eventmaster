<?php

namespace App\Mail;

use App\Models\Ganador;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EquipoGanadorMail extends Mailable
{
    use Queueable, SerializesModels;

    public Ganador $ganador;

    /**
     * Create a new message instance.
     */
    public function __construct(Ganador $ganador)
    {
        $this->ganador = $ganador;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $posiciones = [
            1 => 'Primer Lugar',
            2 => 'Segundo Lugar',
            3 => 'Tercer Lugar',
        ];

        $posicion = $posiciones[$this->ganador->posicion] ?? $this->ganador->posicion . '° Lugar';

        return new Envelope(
            subject: '¡Felicidades! Han ganado el ' . $posicion . ' en ' . $this->ganador->evento->nombre,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.equipo-ganador',
            with: [
                'ganador' => $this->ganador,
                'equipo' => $this->ganador->equipo,
                'evento' => $this->ganador->evento,
                'urlConstancia' => route('constancia.generar', $this->ganador),
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
