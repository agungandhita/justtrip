<?php

namespace App\DTOs\Inquiry;

readonly class WhatsAppInquiryDTO
{
    /**
     * @param array<int, array<string, mixed>> $selectedOptionsBreakdown
     */
    public function __construct(
        public string $whatsappUrl,
        public string $formattedMessage,
        public float $totalEstimasi,
        public string $packageName,
        public array $selectedOptionsBreakdown = [],
    ) {}
}
