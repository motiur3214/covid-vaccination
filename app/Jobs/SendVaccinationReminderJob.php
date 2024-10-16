<?php

namespace App\Jobs;

use App\Mail\VaccinationReminderMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;

class SendVaccinationReminderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected User $user;
    protected Carbon $schedule_date;

    public function __construct($user, $schedule_date)
    {
        \Log::info('Job executed for user: ' . json_encode($schedule_date));
        $this->user = $user;
        $this->schedule_date = $schedule_date;
    }

    public function handle()
    {
        Mail::to($this->user->email)->send(new VaccinationReminderMail($this->user, $this->schedule_date));
    }

}
