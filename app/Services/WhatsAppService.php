<?php

namespace App\Services;

use App\Models\Invoice;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Exception;

class WhatsAppService
{
    protected $apiUrl;
    protected $token;
    protected $adminPhoneNumber;

    public function __construct()
    {
        $this->apiUrl = config('whatsapp.api_url', 'https://api.whatsapp.com/send');
        $this->token = config('whatsapp.token');
        $this->adminPhoneNumber = config('whatsapp.admin_phone', '+6281234567890');
    }

    /**
     * Send invoice PDF to admin via WhatsApp
     */
    public function sendInvoiceToAdmin(Invoice $invoice)
    {
        try {
            // Load invoice with booking data
            $invoice->load(['booking.layanan', 'booking.user']);

            // Prepare message
            $message = $this->prepareInvoiceMessage($invoice);

            // Send message with PDF attachment
            $response = $this->sendMessageWithDocument(
                $this->adminPhoneNumber,
                $message,
                $invoice->pdf_path
            );

            if ($response['success']) {
                Log::info('Invoice sent to admin via WhatsApp', [
                    'invoice_id' => $invoice->invoice_id,
                    'booking_id' => $invoice->booking_id,
                    'admin_phone' => $this->adminPhoneNumber
                ]);

                return true;
            } else {
                Log::error('Failed to send invoice via WhatsApp', [
                    'invoice_id' => $invoice->invoice_id,
                    'error' => $response['error']
                ]);

                return false;
            }

        } catch (Exception $e) {
            Log::error('WhatsApp service error: ' . $e->getMessage(), [
                'invoice_id' => $invoice->invoice_id ?? null,
                'trace' => $e->getTraceAsString()
            ]);

            return false;
        }
    }

    /**
     * Send booking confirmation to customer
     */
    public function sendBookingConfirmation($booking)
    {
        try {
            $customerPhone = $this->formatPhoneNumber($booking->customer_info['phone']);

            $message = $this->prepareBookingConfirmationMessage($booking);

            $response = $this->sendMessage($customerPhone, $message);

            if ($response['success']) {
                Log::info('Booking confirmation sent to customer', [
                    'booking_id' => $booking->booking_id,
                    'customer_phone' => $customerPhone
                ]);

                return true;
            }

            return false;

        } catch (Exception $e) {
            Log::error('Failed to send booking confirmation: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Send payment reminder to customer
     */
    public function sendPaymentReminder(Invoice $invoice)
    {
        try {
            $invoice->load(['booking']);
            $customerPhone = $this->formatPhoneNumber($invoice->booking->customer_info['phone']);

            $message = $this->preparePaymentReminderMessage($invoice);

            $response = $this->sendMessage($customerPhone, $message);

            if ($response['success']) {
                Log::info('Payment reminder sent to customer', [
                    'invoice_id' => $invoice->invoice_id,
                    'customer_phone' => $customerPhone
                ]);

                return true;
            }

            return false;

        } catch (Exception $e) {
            Log::error('Failed to send payment reminder: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Send message with document attachment
     */
    private function sendMessageWithDocument($phoneNumber, $message, $documentPath)
    {
        try {
            // For demo purposes, using a simple HTTP client
            // In production, you would integrate with actual WhatsApp Business API

            if (!Storage::disk('public')->exists($documentPath)) {
                throw new Exception('Document file not found: ' . $documentPath);
            }

            // Simulate API call to WhatsApp Business API
            $response = Http::timeout(30)->post($this->apiUrl . '/messages', [
                'messaging_product' => 'whatsapp',
                'to' => $this->formatPhoneNumber($phoneNumber),
                'type' => 'document',
                'document' => [
                    'link' => Storage::disk('public')->path($documentPath),
                    'caption' => $message,
                    'filename' => basename($documentPath)
                ]
            ], [
                'Authorization' => 'Bearer ' . $this->token,
                'Content-Type' => 'application/json'
            ]);

            if ($response->successful()) {
                return ['success' => true, 'data' => $response->json()];
            } else {
                return [
                    'success' => false,
                    'error' => 'HTTP ' . $response->status() . ': ' . $response->body()
                ];
            }

        } catch (Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Send text message
     */
    private function sendMessage($phoneNumber, $message)
    {
        try {
            // Simulate API call to WhatsApp Business API
            $response = Http::timeout(30)->post($this->apiUrl . '/messages', [
                'messaging_product' => 'whatsapp',
                'to' => $this->formatPhoneNumber($phoneNumber),
                'type' => 'text',
                'text' => [
                    'body' => $message
                ]
            ], [
                'Authorization' => 'Bearer ' . $this->token,
                'Content-Type' => 'application/json'
            ]);

            if ($response->successful()) {
                return ['success' => true, 'data' => $response->json()];
            } else {
                return [
                    'success' => false,
                    'error' => 'HTTP ' . $response->status() . ': ' . $response->body()
                ];
            }

        } catch (Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Prepare invoice message for admin
     */
    private function prepareInvoiceMessage(Invoice $invoice)
    {
        $booking = $invoice->booking;
        $layanan = $booking->layanan;
        $customer = $booking->customer_info;

        $message = "🧾 *INVOICE BARU - JUSTTRIP*\n\n";
        $message .= "📋 *Detail Invoice:*\n";
        $message .= "• Invoice: {$invoice->invoice_number}\n";
        $message .= "• Booking: {$booking->booking_number}\n";
        $message .= "• Tanggal: " . $invoice->invoice_date->format('d/m/Y H:i') . "\n\n";

        $message .= "👤 *Data Customer:*\n";
        $message .= "• Nama: {$customer['name']}\n";
        $message .= "• Email: {$customer['email']}\n";
        $message .= "• Telepon: {$customer['phone']}\n\n";

        $message .= "🏖️ *Detail Layanan:*\n";
        $message .= "• Destinasi: {$layanan->nama_layanan}\n";
        $message .= "• Jumlah Peserta: {$booking->jumlah_peserta} orang\n";
        $message .= "• Tanggal Keberangkatan: " . $booking->tanggal_keberangkatan->format('d/m/Y') . "\n\n";

        $message .= "💰 *Detail Pembayaran:*\n";
        $message .= "• Subtotal: Rp " . number_format($invoice->subtotal, 0, ',', '.') . "\n";

        if ($invoice->discount_amount > 0) {
            $message .= "• Diskon: Rp " . number_format($invoice->discount_amount, 0, ',', '.') . "\n";
        }

        $message .= "• Pajak (11%): Rp " . number_format($invoice->tax_amount, 0, ',', '.') . "\n";
        $message .= "• *Total: Rp " . number_format($invoice->total_amount, 0, ',', '.') . "*\n\n";

        $message .= "📄 Invoice PDF terlampir di atas.\n\n";
        $message .= "Silakan proses booking ini segera. Terima kasih! 🙏";

        return $message;
    }

    /**
     * Prepare booking confirmation message
     */
    private function prepareBookingConfirmationMessage($booking)
    {
        $layanan = $booking->layanan;

        $message = "✅ *BOOKING KONFIRMASI - JUSTTRIP*\n\n";
        $message .= "Halo {$booking->customer_info['name']},\n\n";
        $message .= "Booking Anda telah berhasil dibuat!\n\n";

        $message .= "📋 *Detail Booking:*\n";
        $message .= "• Booking ID: {$booking->booking_number}\n";
        $message .= "• Destinasi: {$layanan->nama_layanan}\n";
        $message .= "• Jumlah Peserta: {$booking->jumlah_peserta} orang\n";
        $message .= "• Tanggal Keberangkatan: " . $booking->tanggal_keberangkatan->format('d/m/Y') . "\n";
        $message .= "• Total Pembayaran: Rp " . number_format($booking->total_amount, 0, ',', '.') . "\n\n";

        $message .= "📧 Invoice akan segera dikirim ke email Anda.\n\n";
        $message .= "Tim kami akan segera menghubungi Anda untuk konfirmasi lebih lanjut.\n\n";
        $message .= "Terima kasih telah memilih JustTrip! 🏖️";

        return $message;
    }

    /**
     * Prepare payment reminder message
     */
    private function preparePaymentReminderMessage(Invoice $invoice)
    {
        $booking = $invoice->booking;

        $message = "⏰ *REMINDER PEMBAYARAN - JUSTTRIP*\n\n";
        $message .= "Halo {$booking->customer_info['name']},\n\n";
        $message .= "Ini adalah pengingat untuk pembayaran booking Anda:\n\n";

        $message .= "📋 *Detail:*\n";
        $message .= "• Invoice: {$invoice->invoice_number}\n";
        $message .= "• Booking: {$booking->booking_number}\n";
        $message .= "• Total: Rp " . number_format($invoice->total_amount, 0, ',', '.') . "\n";
        $message .= "• Jatuh Tempo: " . $invoice->due_date->format('d/m/Y') . "\n\n";

        $message .= "💳 Silakan lakukan pembayaran sebelum tanggal jatuh tempo.\n\n";
        $message .= "Jika sudah melakukan pembayaran, mohon konfirmasi ke kami.\n\n";
        $message .= "Terima kasih! 🙏";

        return $message;
    }

    /**
     * Format phone number for WhatsApp API
     */
    private function formatPhoneNumber($phoneNumber)
    {
        // Remove all non-numeric characters
        $phone = preg_replace('/[^0-9]/', '', $phoneNumber);

        // Add country code if not present
        if (substr($phone, 0, 2) !== '62') {
            if (substr($phone, 0, 1) === '0') {
                $phone = '62' . substr($phone, 1);
            } else {
                $phone = '62' . $phone;
            }
        }

        return $phone;
    }

    /**
     * Check if WhatsApp service is configured
     */
    public function isConfigured()
    {
        return !empty($this->token) && !empty($this->adminPhoneNumber);
    }

    /**
     * Test WhatsApp connection
     */
    public function testConnection()
    {
        try {
            $response = $this->sendMessage(
                $this->adminPhoneNumber,
                '🧪 Test message from JustTrip system - ' . now()->format('d/m/Y H:i:s')
            );

            return $response;

        } catch (Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
}
