<?php

namespace App\Mail;

use App\Models\Recruitment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RecruitmentStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Recruitment $recruitment
    ) {}

    public function envelope(): Envelope
    {
        $subject = match($this->recruitment->status) {
            'approved' => '🎉 Selamat! Anda Diterima di DOSCOM',
            'rejected' => 'Pemberitahuan Status Recruitment DOSCOM',
            default => 'Update Status Recruitment DOSCOM'
        };

        return new Envelope(
            subject: $subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.recruitment.status',
            with: [
                'recruitment' => $this->recruitment,
                'isApproved' => $this->recruitment->status === 'approved',
                'isRejected' => $this->recruitment->status === 'rejected',
            ]
        );
    }
}
