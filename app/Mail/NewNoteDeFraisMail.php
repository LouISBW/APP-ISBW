<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewNoteDeFraisMail extends Mailable
{
    use Queueable, SerializesModels;

    public $record;

    /**
     * Create a new message instance.
     */
    public function __construct($record)
    {
        $this->record = $record;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmation réception NF',
        );
    }

    public function build()
    {
        return $this->view('emails.NewNoteDeFraisMail')
            ->with([
                'record' => $this->record,
            ]);
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.NewNoteDeFraisMail',
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
