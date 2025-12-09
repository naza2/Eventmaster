<?php

namespace App\Mail;

use App\Models\Invitacion;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvitacionRechazadaMail extends Mailable
{
    use Queueable, SerializesModels;

    public Invitacion $invitacion;

    /**
     * Create a new message instance.
     */
    public function __construct(Invitacion $invitacion)
    {
        $this->invitacion = $invitacion;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->invitacion->invitado->name . ' ha rechazado la invitación a tu equipo',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.invitacion-rechazada',
            with: [
                'invitacion' => $this->invitacion,
                'equipo' => $this->invitacion->equipo,
                'evento' => $this->invitacion->equipo->evento,
                'usuarioRechazado' => $this->invitacion->invitado,
                'urlInvitar' => route('equipos.invitar', $this->invitacion->equipo),
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
