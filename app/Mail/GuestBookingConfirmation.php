<?php

namespace App\Mail;

use App\Models\GuestBooking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GuestBookingConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public GuestBooking $guestBooking;

    /**
     * Create a new message instance.
     */
    public function __construct(GuestBooking $guestBooking)
    {
        $this->guestBooking = $guestBooking;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Konfirmasi Booking #' . $this->guestBooking->booking_number . ' - Jussttrip',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.guest-booking-confirmation',
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
