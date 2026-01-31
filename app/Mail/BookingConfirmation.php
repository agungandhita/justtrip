<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public Booking $booking;
    public bool $isAdmin;

    /**
     * Create a new message instance.
     */
    public function __construct(Booking $booking, bool $isAdmin = false)
    {
        $this->booking = $booking;
        $this->isAdmin = $isAdmin;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = $this->isAdmin 
            ? 'Booking Paket Baru - Jussttrip Admin'
            : 'Konfirmasi Booking - Jussttrip';

        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $view = $this->isAdmin 
            ? 'emails.booking-admin'
            : 'emails.booking-customer';

        return new Content(
            view: $view,
            with: [
                'booking' => $this->booking,
                'customerName' => $this->booking->customer_info['name'] ?? 'Customer',
            ],
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
