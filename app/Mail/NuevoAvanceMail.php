<?php

namespace App\Mail;

use App\Models\Avance;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NuevoAvanceMail extends Mailable
{
    use Queueable, SerializesModels;

    public Avance $avance;

    /**
     * Create a new message instance.
     */
    public function __construct(Avance $avance)
    {
        $this->avance = $avance;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nuevo avance registrado: ' . $this->avance->titulo,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.nuevo-avance',
            with: [
                'avance' => $this->avance,
                'equipo' => $this->avance->proyecto->equipo,
                'autor' => $this->avance->user,
                'urlEquipo' => route('equipos.show', $this->avance->proyecto->equipo),
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
