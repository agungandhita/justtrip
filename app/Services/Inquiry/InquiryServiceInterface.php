<?php

namespace App\Services\Inquiry;

use App\DTOs\Inquiry\InquiryDataDTO;
use App\DTOs\Inquiry\WhatsAppInquiryDTO;

interface InquiryServiceInterface
{
    /**
     * Process inquiry data, calculate pricing, format WhatsApp message and URL.
     */
    public function processInquiry(InquiryDataDTO $dto): WhatsAppInquiryDTO;
}
