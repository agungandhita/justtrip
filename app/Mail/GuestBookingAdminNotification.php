<?php

namespace App\Mail;

use App\Models\GuestBooking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GuestBookingAdminNotification extends Mailable
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
        $subject = $this->guestBooking->is_custom_request
            ? 'PERMINTAAN KHUSUS BARU #' . $this->guestBooking->booking_number
            : 'BOOKING BARU #' . $this->guestBooking->booking_number;

        return new Envelope(
            subject: $subject . ' - Jussttrip Admin',
            from: config('mail.from.address', 'system@justtrip.com'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.admin-guest-booking-notification',
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
