<?php

namespace App\Mail;

use App\Models\SpecialOffer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SpecialOfferNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $specialOffer;

    /**
     * Create a new message instance.
     */
    public function __construct(SpecialOffer $specialOffer)
    {
        $this->specialOffer = $specialOffer;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Special Offer Baru dari JustTrip!')
            ->markdown('emails.special-offer-notification', [
                'specialOffer' => $this->specialOffer
            ]);
    }
}
