<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RecruitmentVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $nama_lengkap;
    public string $nim;
    public string $short_uuid;

    /**
     * Create a new message instance.
     */
    public function __construct(string $nama_lengkap, string $nim, string $short_uuid)
    {
        $this->nama_lengkap = $nama_lengkap;
        $this->nim = $nim;
        $this->short_uuid = $short_uuid;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Kode Edit Recruitment Anda',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.recruitment.verification',
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