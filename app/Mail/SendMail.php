<?php

namespace App\Mail;

use App\Models\Curriculo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    private Curriculo $curriculo;

    /**
     * Create a new message instance.
     */
    public function __construct(Curriculo $curriculo)
    {
        $this->curriculo = $curriculo;
    

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Envio do email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.message',
            with: [
                'nome' => $this->curriculo->nome,
                'email' => $this->curriculo->email,
                'telefone' => $this->curriculo->telefone,
                'cargo' => $this->curriculo->cargo,
                'escolaridade' => $this->curriculo->escolaridade,
                'observacoes' => $this->curriculo->observacoes,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromPath(public_path('arquivos/curriculos/') . $this->curriculo->arquivo)
        ];
    }
}
