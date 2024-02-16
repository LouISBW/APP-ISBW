<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UpdateRoomBookingMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;


    /**
     * Create a new message instance.
     */
    public function __construct($booking)
    {
        $this->booking = $booking;

    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Mise à jour de votre réservation',
        );
    }

    public function build()
    {
        return $this->view('emails.UpdateRoomBookingMail')
            ->with([
                'booking' => $this->booking,
            ]);
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.UpdateRoomBookingMail',
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
