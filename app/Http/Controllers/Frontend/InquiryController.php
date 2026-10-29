<?php

namespace App\Http\Controllers\Frontend;

use App\DTOs\Inquiry\InquiryDataDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Inquiry\SendInquiryRequest;
use App\Services\Inquiry\InquiryServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class InquiryController extends Controller
{
    /**
     * Inject InquiryServiceInterface (Zero Concrete Class Injection).
     */
    public function __construct(
        protected readonly InquiryServiceInterface $inquiryService
    ) {}

    /**
     * Handle incoming inquiry submission and dispatch to WhatsApp.
     */
    public function send(SendInquiryRequest $request): JsonResponse|RedirectResponse
    {
        $dto = InquiryDataDTO::fromRequest($request);

        $result = $this->inquiryService->processInquiry($dto);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success'      => true,
                'message'      => 'Inquiry berhasil diproses. Membuka WhatsApp...',
                'whatsapp_url' => $result->whatsappUrl,
                'package_name' => $result->packageName,
                'total'        => $result->totalEstimasi,
            ]);
        }

        return redirect()->away($result->whatsappUrl);
    }
}
