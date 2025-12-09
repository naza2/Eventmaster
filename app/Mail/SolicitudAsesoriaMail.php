<?php

namespace App\Mail;

use App\Models\Asesoria;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SolicitudAsesoriaMail extends Mailable
{
    use Queueable, SerializesModels;

    public Asesoria $asesoria;

    /**
     * Create a new message instance.
     */
    public function __construct(Asesoria $asesoria)
    {
        $this->asesoria = $asesoria;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Solicitud de Asesoría del equipo ' . $this->asesoria->equipo->nombre_equipo,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.solicitud-asesoria',
            with: [
                'asesoria' => $this->asesoria,
                'equipo' => $this->asesoria->equipo,
                'evento' => $this->asesoria->equipo->evento,
                'urlAceptar' => route('asesorias.aceptar', $this->asesoria),
                'urlSolicitudes' => route('asesorias.mis-solicitudes'),
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
