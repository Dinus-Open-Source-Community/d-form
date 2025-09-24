<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GroupInvite extends Mailable
{
    use Queueable, SerializesModels;
    public string $nama_lengkap;

    /**
     * Create a new message instance.
     */
    public function __construct(string $nama_lengkap)
    {
        $this->nama_lengkap = $nama_lengkap;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Group Invite',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.recruitment.group-invite',

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

    /**
     * Tambah header Content-Language supaya Gmail ngerti ini email bahasa Indonesia
     */
    public function build()
    {
        return $this
            ->withSymfonyMessage(function ($message) {
                $headers = $message->getHeaders();
                $headers->addTextHeader('Content-Language', 'id');
            });
    }
}
