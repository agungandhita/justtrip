<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\DestinationController;
use App\Http\Controllers\Frontend\PackageController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\ArticleController;
use App\Http\Controllers\Frontend\GalleryController as FrontendGalleryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SpecialOfferController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LayananController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('beranda');
Route::get('/destinasi', [DestinationController::class, 'index'])->name('destinasi');
Route::get('/paket-tour', [PackageController::class, 'index'])->name('paket-tour');
Route::get('/tentang-kami', [AboutController::class, 'index'])->name('tentang-kami');
Route::get('/artikel', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/artikel/{slug}', [ArticleController::class, 'show'])->name('articles.show');

// Gallery routes (public)
Route::get('/gallery', [FrontendGalleryController::class, 'index'])->name('gallery');
Route::get('/gallery/{slug}', [FrontendGalleryController::class, 'show'])->name('gallery.show');
Route::post('/gallery/{gallery}/like', [FrontendGalleryController::class, 'toggleLike'])->name('gallery.like');
Route::get('/api/gallery/search', [FrontendGalleryController::class, 'search'])->name('gallery.search');

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

    // News CRUD routes
    Route::resource('news', NewsController::class);

    // Gallery CRUD routes
    Route::resource('galleries', GalleryController::class);
    Route::post('galleries/{gallery}/like', [GalleryController::class, 'toggleLike'])->name('galleries.like');

    // Additional gallery routes for image management
    Route::delete('galleries/{gallery}/images/{imageIndex}', [GalleryController::class, 'deleteImage'])->name('galleries.delete-image');
    Route::post('galleries/{gallery}/add-images', [GalleryController::class, 'addImages'])->name('galleries.add-images');
    Route::post('galleries/cleanup-orphaned', [GalleryController::class, 'cleanupOrphanedFiles'])->name('galleries.cleanup-orphaned');
    Route::get('galleries/storage-stats', [GalleryController::class, 'getStorageStats'])->name('galleries.storage-stats');

    // User Management CRUD routes
    Route::resource('users', UserController::class);
    Route::post('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');

    // Layanan CRUD routes
    Route::resource('layanan', LayananController::class);
    Route::post('layanan/{layanan}/toggle-status', [LayananController::class, 'toggleStatus'])->name('layanan.toggle-status');
});

// User routes (user role only)
Route::middleware(['auth', 'user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/profile', function () {
        return view('user.profile');
    })->name('profile');

    // Add more user routes here
    // Route::get('/bookings', [BookingController::class, 'index'])->name('bookings');
    // Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
});
