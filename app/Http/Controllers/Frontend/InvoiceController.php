<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Booking;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    /**
     * Generate PDF for invoice
     */
    public function generatePDF(Invoice $invoice)
    {
        try {
            // Load invoice with relationships
            $invoice->load(['booking.layanan', 'booking.specialOffer', 'booking.user']);

            // Prepare data for PDF
            $data = [
                'invoice' => $invoice,
                'booking' => $invoice->booking,
                'layanan' => $invoice->booking->layanan,
                'customer' => $invoice->booking->customer_info,
                'company' => [
                    'name' => 'JustTrip Travel',
                    'address' => 'Jl. Raya Pariwisata No. 123, Jakarta',
                    'phone' => '+62 21 1234 5678',
                    'email' => 'info@justtrip.com',
                    'website' => 'www.justtrip.com'
                ],
                'generated_at' => now()->format('d F Y H:i:s')
            ];

            // Generate PDF
            $pdf = Pdf::loadView('pdf.invoice', $data)
                     ->setPaper('a4', 'portrait')
                     ->setOptions([
                         'defaultFont' => 'sans-serif',
                         'isHtml5ParserEnabled' => true,
                         'isRemoteEnabled' => true
                     ]);

            // Create filename
            $filename = 'invoice_' . $invoice->invoice_number . '_' . now()->format('YmdHis') . '.pdf';
            $filePath = 'invoices/' . $filename;

            // Save PDF to storage
            Storage::disk('public')->put($filePath, $pdf->output());

            return $filePath;

        } catch (\Exception $e) {
            Log::error('Failed to generate PDF: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Download invoice PDF
     */
    public function download(Request $request, $invoice_id)
    {
        $invoice = Invoice::where('invoice_id', $invoice_id)->firstOrFail();

        // Check if user has permission to download
        if (!$this->canAccessInvoice($invoice)) {
            abort(403, 'Unauthorized access to invoice');
        }

        if (!$invoice->pdf_path || !Storage::disk('public')->exists($invoice->pdf_path)) {
            // Generate PDF if not exists
            $pdfPath = $this->generatePDF($invoice);
            $invoice->update(['pdf_path' => $pdfPath]);
        }

        $filename = 'Invoice_' . $invoice->invoice_number . '.pdf';

        $filePath = storage_path('app/public/' . $invoice->pdf_path);
        return response()->download($filePath, $filename);
    }

    /**
     * View invoice PDF in browser
     */
    public function view(Request $request, $invoice_id)
    {
        $invoice = Invoice::where('invoice_id', $invoice_id)->firstOrFail();

        // Check if user has permission to view
        if (!$this->canAccessInvoice($invoice)) {
            abort(403, 'Unauthorized access to invoice');
        }

        if (!$invoice->pdf_path || !Storage::disk('public')->exists($invoice->pdf_path)) {
            // Generate PDF if not exists
            $pdfPath = $this->generatePDF($invoice);
            $invoice->update(['pdf_path' => $pdfPath]);
        }

        $pdfContent = Storage::disk('public')->get($invoice->pdf_path);

        return response($pdfContent)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="Invoice_' . $invoice->invoice_number . '.pdf"');
    }

    /**
     * Regenerate invoice PDF
     */
    public function regenerate(Request $request, $invoice_id)
    {
        $invoice = Invoice::where('invoice_id', $invoice_id)->firstOrFail();

        // Check if user has permission
        if (!$this->canAccessInvoice($invoice)) {
            abort(403, 'Unauthorized access to invoice');
        }

        // Delete old PDF if exists
        if ($invoice->pdf_path && Storage::disk('public')->exists($invoice->pdf_path)) {
            Storage::disk('public')->delete($invoice->pdf_path);
        }

        // Generate new PDF
        $pdfPath = $this->generatePDF($invoice);
        $invoice->update(['pdf_path' => $pdfPath]);

        return response()->json([
            'success' => true,
            'message' => 'Invoice PDF has been regenerated successfully',
            'pdf_path' => $pdfPath
        ]);
    }

    /**
     * Send invoice via email
     */
    public function sendEmail(Request $request, $invoice_id)
    {
        $invoice = Invoice::where('invoice_id', $invoice_id)->firstOrFail();

        // Check if user has permission
        if (!$this->canAccessInvoice($invoice)) {
            abort(403, 'Unauthorized access to invoice');
        }

        try {
            // Ensure PDF exists
            if (!$invoice->pdf_path || !Storage::disk('public')->exists($invoice->pdf_path)) {
                $pdfPath = $this->generatePDF($invoice);
                $invoice->update(['pdf_path' => $pdfPath]);
            }

            // Send email (implement email service)
            // Mail::to($invoice->booking->customer_info['email'])->send(new InvoiceMail($invoice));

            $invoice->markAsSent();

            return response()->json([
                'success' => true,
                'message' => 'Invoice has been sent successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send invoice: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get invoice data for preview
     */
    public function preview(Request $request, $invoice_id)
    {
        $invoice = Invoice::with(['booking.layanan', 'booking.specialOffer', 'booking.user'])
                         ->where('invoice_id', $invoice_id)
                         ->firstOrFail();

        // Check if user has permission
        if (!$this->canAccessInvoice($invoice)) {
            abort(403, 'Unauthorized access to invoice');
        }

        $data = [
            'invoice' => $invoice,
            'booking' => $invoice->booking,
            'layanan' => $invoice->booking->layanan,
            'customer' => $invoice->booking->customer_info,
            'company' => [
                'name' => 'JustTrip Travel',
                'address' => 'Jl. Raya Pariwisata No. 123, Jakarta',
                'phone' => '+62 21 1234 5678',
                'email' => 'info@justtrip.com',
                'website' => 'www.justtrip.com'
            ]
        ];

        return view('pdf.invoice-preview', $data);
    }

    /**
     * Check if current user can access invoice
     */
    private function canAccessInvoice(Invoice $invoice)
    {
        /** @var User|null $user */
        $user = Auth::user();
        
        if (!$user) {
            return false;
        }

        // Admin can access all invoices
        if ($user->role === 'admin') {
            return true;
        }

        // Customer can only access their own invoices
        if ($invoice->booking->user_id === $user->id) {
            return true;
        }

        return false;
    }

    /**
     * Get invoice statistics for admin
     */
    public function statistics()
    {
        $stats = [
            'total_invoices' => Invoice::count(),
            'pending_invoices' => Invoice::where('status', 'draft')->count(),
            'sent_invoices' => Invoice::where('status', 'sent')->count(),
            'paid_invoices' => Invoice::where('status', 'paid')->count(),
            'cancelled_invoices' => Invoice::where('status', 'cancelled')->count(),
            'total_amount' => Invoice::where('status', '!=', 'cancelled')->sum('total_amount'),
            'paid_amount' => Invoice::where('status', 'paid')->sum('total_amount'),
            'pending_amount' => Invoice::whereIn('status', ['draft', 'sent'])->sum('total_amount')
        ];

        return response()->json($stats);
    }
}
