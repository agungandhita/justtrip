<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\SpecialOffer;
use App\Models\Invoice;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmation;
use App\Mail\PromoBookingConfirmation;

class NotificationService
{
    protected $whatsAppService;

    public function __construct(\App\Services\WhatsAppService $whatsAppService)
    {
        $this->whatsAppService = $whatsAppService;
    }

    /**
     * Send all notifications for promo booking
     * This runs OUTSIDE of database transaction for better performance
     */
    public function sendPromoBookingNotifications(Booking $booking, SpecialOffer $specialOffer, Invoice $invoice): void
    {
        try {
            // Send customer email
            $this->sendPromoBookingEmail($booking, $specialOffer);

            // Send admin email
            $this->sendAdminPromoNotification($booking, $specialOffer);

            // Send WhatsApp notification to admin
            $this->sendPromoWhatsAppNotification($booking, $specialOffer);

            // Send invoice WhatsApp notification
            $this->sendInvoiceWhatsAppNotification($invoice);

            Log::info('All promo booking notifications sent successfully', [
                'booking_number' => $booking->booking_number
            ]);
        } catch (\Exception $e) {
            // Log error but don't fail the booking process
            Log::error('Failed to send some promo booking notifications', [
                'booking_number' => $booking->booking_number,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Send promo booking email to customer
     */
    protected function sendPromoBookingEmail(Booking $booking, SpecialOffer $specialOffer): void
    {
        try {
            Mail::to($booking->customer_info['email'])
                ->send(new PromoBookingConfirmation($booking, $specialOffer));

            Log::info('Promo booking email sent to customer', [
                'booking_number' => $booking->booking_number,
                'email' => $booking->customer_info['email']
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send promo booking email to customer', [
                'booking_number' => $booking->booking_number,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Send promo booking notification to admin
     */
    protected function sendAdminPromoNotification(Booking $booking, SpecialOffer $specialOffer): void
    {
        try {
            $adminEmail = config('mail.admin_email', 'admin@justtrip.com');
            
            Mail::to($adminEmail)
                ->send(new PromoBookingConfirmation($booking, $specialOffer, true));

            Log::info('Promo booking notification sent to admin', [
                'booking_number' => $booking->booking_number
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send promo booking notification to admin', [
                'booking_number' => $booking->booking_number,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Send WhatsApp notification for promo booking to admin
     */
    protected function sendPromoWhatsAppNotification(Booking $booking, SpecialOffer $specialOffer): void
    {
        try {
            $this->whatsAppService->sendPromoBookingNotification($booking, $specialOffer);

            Log::info('Promo booking WhatsApp notification sent', [
                'booking_number' => $booking->booking_number
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send promo booking WhatsApp notification', [
                'booking_number' => $booking->booking_number,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Send invoice WhatsApp notification
     */
    protected function sendInvoiceWhatsAppNotification(Invoice $invoice): void
    {
        try {
            // Skip WhatsApp for now - invoice pdf_path is not saved in database
            // This would cause null error in WhatsAppService
            
            Log::info('WhatsApp notification skipped (pdf_path not in database)', [
                'invoice_number' => $invoice->invoice_number
            ]);
            
            // TODO: If you want WhatsApp notifications:
            // 1. Add pdf_path column to invoices table
            // 2. Save PDF path when creating invoice
            // 3. Uncomment the code below
            
            /*
            // Prepare complete data for PDF generation
            $data = [
                'invoice' => $invoice,
                'booking' => $invoice->booking,
                'customer' => $invoice->booking->customer_info,
                'company' => [
                    'name' => 'Justtrip Tour Organizer',
                    'address' => 'Malang – Sleman – Bali',
                    'phone' => '+62 822-6647-8147',
                    'email' => 'justtrip.tour@gmail.com',
                    'website' => 'www.justtrip.id',
                    'service_areas' => 'Malang – Sleman – Bali'
                ],
                'generated_at' => now()->format('d F Y H:i:s')
            ];

            // Try to load and encode logo
            $logoPath = public_path('image/LOGO TOSCA.png');
            if (file_exists($logoPath)) {
                $logoData = base64_encode(file_get_contents($logoPath));
                $data['logoData'] = $logoData;
            }

            // Generate PDF with complete data
            $pdf = \PDF::loadView('pdf.invoice', $data);
            $pdfPath = storage_path('app/invoices/invoice-' . $invoice->invoice_number . '.pdf');
            
            // Ensure directory exists
            if (!file_exists(dirname($pdfPath))) {
                mkdir(dirname($pdfPath), 0755, true);
            }
            
            $pdf->save($pdfPath);

            // Send WhatsApp with PDF to admin
            $this->whatsAppService->sendInvoiceToAdmin($invoice);

            Log::info('Invoice WhatsApp notification sent', [
                'invoice_number' => $invoice->invoice_number
            ]);

            // Clean up PDF file
            if (file_exists($pdfPath)) {
                unlink($pdfPath);
            }
            */
            
        } catch (\Exception $e) {
            Log::error('Failed to send invoice WhatsApp notification', [
                'invoice_number' => $invoice->invoice_number ?? 'unknown',
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Send all notifications for regular booking
     */
    public function sendRegularBookingNotifications(Booking $booking, Invoice $invoice): void
    {
        try {
            // Send customer email
            $this->sendBookingEmail($booking);

            // Send admin notification
            $this->sendAdminBookingNotification($booking);

            // Send invoice notification
            $this->sendInvoiceWhatsAppNotification($invoice);

            Log::info('All regular booking notifications sent successfully', [
                'booking_number' => $booking->booking_number
            ]);
        } catch (\Exception $e) {
            // Log error but don't fail the booking process
            Log::error('Failed to send some regular booking notifications', [
                'booking_number' => $booking->booking_number,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Send booking confirmation email to customer
     */
    protected function sendBookingEmail(Booking $booking): void
    {
        try {
            Mail::to($booking->customer_info['email'])
                ->send(new BookingConfirmation($booking));

            Log::info('Booking email sent to customer', [
                'booking_number' => $booking->booking_number,
                'email' => $booking->customer_info['email']
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send booking email to customer', [
                'booking_number' => $booking->booking_number,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Send regular booking notification to admin
     */
    protected function sendAdminBookingNotification(Booking $booking): void
    {
        try {
            $adminEmail = config('mail.admin_email', 'justtrip20@gmail.com');
            
            Mail::to($adminEmail)
                ->send(new BookingConfirmation($booking, true));

            Log::info('Regular booking notification sent to admin', [
                'booking_number' => $booking->booking_number,
                'admin_email' => $adminEmail
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to send regular booking notification to admin', [
                'booking_number' => $booking->booking_number,
                'error' => $e->getMessage()
            ]);
        }
    }
}
