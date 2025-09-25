<?php

namespace App\Jobs;

use App\Models\Recruitment;
use App\Mail\RecruitmentStatusMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendRecruitmentStatusEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Recruitment $recruitment
    ) {}

    public function handle(): void
    {
        try {
            Mail::to($this->recruitment->email_pribadi)
                ->send(new RecruitmentStatusMail($this->recruitment));
        } catch (\Exception $e) {
            \Log::error('Failed to send recruitment status email: ' . $e->getMessage());
            throw $e;
        }
    }
}
