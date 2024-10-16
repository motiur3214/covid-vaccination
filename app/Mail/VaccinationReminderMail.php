<?php

namespace App\Mail;

namespace App\Mail;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Content;

class VaccinationReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public Carbon $schedule_date;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $schedule_date)
    {
        $this->user = $user;
        $this->schedule_date = $schedule_date;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Vaccination Reminder',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.vaccination_reminder',
            with: [
                'user' => $this->user,
                'date' => $this->schedule_date->format('d-m-Y'),
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments(): array
    {
        return [];
    }
}

