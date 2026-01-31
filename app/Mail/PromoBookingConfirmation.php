<?php

namespace App\Mail;

use App\Models\Booking;
use App\Models\SpecialOffer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PromoBookingConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public Booking $booking;
    public SpecialOffer $specialOffer;
    public bool $isAdmin;

    /**
     * Create a new message instance.
     */
    public function __construct(Booking $booking, SpecialOffer $specialOffer, bool $isAdmin = false)
    {
        $this->booking = $booking;
        $this->specialOffer = $specialOffer;
        $this->isAdmin = $isAdmin;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = $this->isAdmin 
            ? 'Booking Promo Baru - Jussttrip Admin'
            : 'Konfirmasi Booking Promo - Jussttrip';

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
            ? 'emails.promo-booking-admin'
            : 'emails.promo-booking-customer';

        return new Content(
            view: $view,
            with: [
                'booking' => $this->booking,
                'specialOffer' => $this->specialOffer,
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
