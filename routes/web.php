<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\DestinationController;
use App\Http\Controllers\Frontend\PackageController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\ArticleController;
use App\Http\Controllers\Frontend\GalleryController as FrontendGalleryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SpecialOfferController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Frontend\BookingController;
use App\Http\Controllers\Frontend\InvoiceController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\SpecialOfferController as FrontendSpecialOfferController;
use App\Http\Controllers\GuestBookingController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('beranda');
Route::get('/destinasi', [DestinationController::class, 'index'])->name('destinasi');
Route::get('/paket-tour', [PackageController::class, 'index'])->name('paket-tour');
Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
Route::get('/packages/{slug}', [PackageController::class, 'show'])->name('packages.show');
Route::get('/tentang-kami', [AboutController::class, 'index'])->name('tentang-kami');
Route::get('/artikel', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/artikel/{slug}', [ArticleController::class, 'show'])->name('articles.show');

// Special Offers routes (public)
Route::get('/special-offers', [FrontendSpecialOfferController::class, 'index'])->name('special-offers.index');
Route::get('/special-offers/{specialOffer}', [FrontendSpecialOfferController::class, 'show'])->name('special-offers.show');

// Gallery routes (public)
Route::get('/gallery', [FrontendGalleryController::class, 'index'])->name('gallery');
Route::get('/gallery/{slug}', [FrontendGalleryController::class, 'show'])->name('gallery.show');
Route::post('/gallery/{gallery}/like', [FrontendGalleryController::class, 'toggleLike'])->name('gallery.like');
Route::get('/api/gallery/search', [FrontendGalleryController::class, 'search'])->name('gallery.search');

// Layanan routes (public)
Route::get('/layanan', [LayananController::class, 'publicIndex'])->name('layanan.index');
Route::get('/layanan/{layanan}', [LayananController::class, 'publicShow'])->name('layanan.show');

// API: cari layanan berdasarkan destinasi (dipakai oleh guest-booking frontend JS)
Route::get('/api/layanan/search', [GuestBookingController::class, 'getLayananByDestination'])->name('api.layanan.search');

// Guest Booking routes (public)
Route::prefix('guest-booking')->name('guest-booking.')->group(function () {
    Route::get('/', [GuestBookingController::class, 'index'])->name('index');
    Route::post('/search', [GuestBookingController::class, 'search'])->name('search');
    Route::get('/form', [GuestBookingController::class, 'showForm'])->name('form');
    Route::post('/store', [GuestBookingController::class, 'store'])->name('store');
    Route::get('/success/{booking_number}', [GuestBookingController::class, 'success'])->name('success');
});

// Authentication routes (guest only)
Route::middleware('guest')->group(function () {
    // Login routes
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');

    // Register routes
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
});

// Logout route (authenticated users only)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Admin routes (admin role only)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/statistics', [DashboardController::class, 'getStatistics'])->name('dashboard.statistics');
    Route::get('/dashboard/chart-data', [DashboardController::class, 'getChartData'])->name('dashboard.chart-data');

    // Special Offers CRUD routes
    Route::resource('special-offers', SpecialOfferController::class, ['names' => 'special-offers']);

    // Standalone Special Offers routes
    Route::get('special-offers-standalone/create', [SpecialOfferController::class, 'createStandalone'])->name('special-offers.create-standalone');
    Route::post('special-offers-standalone', [SpecialOfferController::class, 'storeStandalone'])->name('special-offers.store-standalone');

    // News CRUD routes
    Route::resource('news', NewsController::class);

    // Gallery CRUD routes
    Route::resource('galleries', GalleryController::class);
    Route::post('galleries/{gallery}/like', [GalleryController::class, 'toggleLike'])->name('galleries.like');

    // Additional gallery routes for image management
    Route::delete('galleries/{gallery}/images/{imageIndex}', [GalleryController::class, 'deleteImage'])->name('galleries.delete-image');
    Route::post('galleries/{gallery}/add-images', [GalleryController::class, 'addImages'])->name('galleries.add-images');
    Route::post('galleries/{gallery}/set-main-image', [GalleryController::class, 'setMainImage'])->name('galleries.set-main-image');
    Route::post('galleries/cleanup-orphaned', [GalleryController::class, 'cleanupOrphanedFiles'])->name('galleries.cleanup-orphaned');
    Route::get('galleries/storage-stats', [GalleryController::class, 'getStorageStats'])->name('galleries.storage-stats');

    // User Management CRUD routes
    Route::resource('users', UserController::class);
    Route::post('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');

    // Layanan CRUD routes
    Route::resource('layanan', LayananController::class);
    Route::post('layanan/{layanan}/toggle-status', [LayananController::class, 'toggleStatus'])->name('layanan.toggle-status');

    // Booking Management routes
    Route::resource('bookings', AdminBookingController::class);
    Route::patch('bookings/{booking}/confirm', [AdminBookingController::class, 'confirm'])->name('bookings.confirm');
    Route::patch('bookings/{booking}/reject', [AdminBookingController::class, 'reject'])->name('bookings.reject');
    Route::patch('bookings/{booking}/complete', [AdminBookingController::class, 'complete'])->name('bookings.complete');
    Route::get('bookings/statistics', [AdminBookingController::class, 'getStatistics'])->name('bookings.statistics');
    Route::get('bookings/export', [AdminBookingController::class, 'export'])->name('bookings.export');

    // Guest Booking Management routes
    Route::prefix('guest-bookings')->name('guest-bookings.')->group(function () {
        Route::get('/', [GuestBookingController::class, 'adminIndex'])->name('index');
        Route::get('/{guestBooking}', [GuestBookingController::class, 'adminShow'])->name('show');
        Route::patch('/{guestBooking}/status', [GuestBookingController::class, 'updateStatus'])->name('update-status');
        Route::get('/{guestBooking}/contact-whatsapp', [GuestBookingController::class, 'contactViaWhatsApp'])->name('contact-whatsapp');
        Route::post('/{guestBooking}/send-email', [GuestBookingController::class, 'sendCustomEmail'])->name('send-email');
        Route::get('/export/excel', [GuestBookingController::class, 'exportExcel'])->name('export-excel');
        Route::get('/statistics', [GuestBookingController::class, 'getStatistics'])->name('statistics');
    });


    // Payment confirmation management
    Route::resource('payment-confirmations', \App\Http\Controllers\Admin\PaymentConfirmationController::class)->only(['index', 'show']);
    Route::patch('payment-confirmations/{paymentConfirmation}/approve', [\App\Http\Controllers\Admin\PaymentConfirmationController::class, 'approve'])->name('payment-confirmations.approve');
    Route::patch('payment-confirmations/{paymentConfirmation}/reject', [\App\Http\Controllers\Admin\PaymentConfirmationController::class, 'reject'])->name('payment-confirmations.reject');
    Route::get('payment-confirmations/{paymentConfirmation}/download-proof', [\App\Http\Controllers\Admin\PaymentConfirmationController::class, 'downloadProof'])->name('payment-confirmations.download-proof');
});

// Booking routes (authenticated users)
Route::middleware('auth')->group(function () {
    // Booking management
    Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
    Route::get('/booking/create/{layanan}', [BookingController::class, 'create'])->name('booking.create');
    Route::get('/booking/create-from-offer/{specialOffer}', [BookingController::class, 'createFromOffer'])->name('booking.create-from-offer');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store'); // Alternative route for special offers
    Route::get('/booking/{booking}', [BookingController::class, 'show'])->name('booking.show');
    Route::patch('/booking/{booking}/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');

    // Invoice routes
    Route::get('/booking/{booking}/invoice', [InvoiceController::class, 'generatePDF'])->name('booking.invoice');
    Route::get('/invoice/{invoice}/download', [InvoiceController::class, 'download'])->name('invoice.download');
    Route::get('/invoice/{invoice}/view', [InvoiceController::class, 'view'])->name('invoice.view');
    Route::get('/invoice/{invoice}/preview', [InvoiceController::class, 'preview'])->name('invoice.preview');
    Route::post('/invoice/{invoice}/send-whatsapp', [InvoiceController::class, 'sendToWhatsApp'])->name('invoice.send-whatsapp');

    // Payment routes
    Route::post('/payment/upload', [PaymentController::class, 'store'])->name('payment.store');
    Route::get('/payment/{booking}/upload', [PaymentController::class, 'showUploadForm'])->name('payment.upload');
    Route::get('/payment/{paymentConfirmation}/download', [PaymentController::class, 'downloadProof'])->name('payment.download-proof');
});

// User routes (user role only)
Route::middleware(['auth', 'user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/profile', function () {
        return view('Frontend.user.profile');
    })->name('profile');


    Route::get('/settings', function () {
        return view('Frontend.user.settings');
    })->name('settings');
});

// Admin Invoice Management
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
    Route::get('/invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');
    Route::patch('/invoices/{invoice}/regenerate', [InvoiceController::class, 'regenerate'])->name('invoices.regenerate');
    Route::post('/invoices/{invoice}/send-email', [InvoiceController::class, 'sendEmail'])->name('invoices.send-email');
    Route::get('/invoices/statistics', [InvoiceController::class, 'statistics'])->name('invoices.statistics');
});
