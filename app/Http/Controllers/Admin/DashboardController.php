<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\News;
use App\Models\SpecialOffer;
use App\Models\Gallery;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get dashboard statistics
        $statistics = $this->getDashboardStatistics();

        return view('admin.dashboard.index', $statistics);
    }

    /**
     * Get dashboard statistics data.
     *
     * @return array
     */
    private function getDashboardStatistics()
    {
        // Get current date ranges
        $today = Carbon::today();
        $thisMonth = Carbon::now()->startOfMonth();
        $lastMonth = Carbon::now()->subMonth()->startOfMonth();
        $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth();

        // User statistics
        $totalUsers = User::count();
        $newUsersToday = User::whereDate('created_at', $today)->count();
        $newUsersThisMonth = User::where('created_at', '>=', $thisMonth)->count();
        $newUsersLastMonth = User::whereBetween('created_at', [$lastMonth, $lastMonthEnd])->count();

        // Calculate user growth percentage
        $userGrowthPercentage = $this->calculateGrowthPercentage($newUsersThisMonth, $newUsersLastMonth);

        // Admin and regular user counts
        $totalAdmins = User::where('role', 'admin')->count();
        $totalRegularUsers = User::where('role', 'user')->count();

        // Layanan/Service statistics (replacing Product/Destination)
        $totalDestinations = Layanan::count();
        $activeDestinations = Layanan::where('status', 'aktif')->count();
        $inactiveDestinations = Layanan::where('status', 'nonaktif')->count();

        // Special Offers statistics (as booking placeholder)
        $totalBookings = SpecialOffer::count();
        $pendingBookings = SpecialOffer::where('is_active', true)->where('valid_until', '>=', now())->count();
        $completedBookings = SpecialOffer::where('valid_until', '<', now())->count();
        $cancelledBookings = SpecialOffer::where('is_active', false)->count();

        // Revenue calculation from layanan and special offers
        $totalRevenue = Layanan::sum('harga_mulai') + SpecialOffer::sum('discounted_price');
        $revenueToday = Layanan::whereDate('created_at', $today)->sum('harga_mulai') +
                       SpecialOffer::whereDate('created_at', $today)->sum('discounted_price');
        $revenueThisMonth = Layanan::where('created_at', '>=', $thisMonth)->sum('harga_mulai') +
                           SpecialOffer::where('created_at', '>=', $thisMonth)->sum('discounted_price');
        $revenueLastMonth = Layanan::whereBetween('created_at', [$lastMonth, $lastMonthEnd])->sum('harga_mulai') +
                           SpecialOffer::whereBetween('created_at', [$lastMonth, $lastMonthEnd])->sum('discounted_price');
        $revenueGrowthPercentage = $this->calculateGrowthPercentage($revenueThisMonth, $revenueLastMonth);

        // Layanan statistics
        $totalServices = Layanan::count();
        $activeServices = Layanan::where('status', 'aktif')->count();
        $inactiveServices = Layanan::where('status', 'nonaktif')->count();

        // Recent activities
        $recentUsers = User::latest()->take(5)->get();

        // News statistics
        $totalNews = News::count();
        $publishedNews = News::where('is_published', true)->count();
        $featuredNews = News::where('is_featured', true)->count();

        // Gallery statistics
        $totalGallery = Gallery::count();
        $publicGallery = Gallery::where('is_public', true)->count();
        $featuredGallery = Gallery::where('featured', true)->count();

        // Additional metrics
        $totalViews = News::sum('views') + Gallery::sum('views');
        $averageLayananPrice = Layanan::avg('harga_mulai') ?? 0;
        $featuredLayanan = Layanan::where('status', 'aktif')->count();

        return [
            // User statistics
            'totalUsers' => $totalUsers,
            'newUsersToday' => $newUsersToday,
            'newUsersThisMonth' => $newUsersThisMonth,
            'userGrowthPercentage' => $userGrowthPercentage,
            'totalAdmins' => $totalAdmins,
            'totalRegularUsers' => $totalRegularUsers,

            // Destination statistics (placeholders)
            'totalDestinations' => $totalDestinations,
            'activeDestinations' => $activeDestinations,
            'inactiveDestinations' => $inactiveDestinations,

            // Booking statistics (placeholders)
            'totalBookings' => $totalBookings,
            'pendingBookings' => $pendingBookings,
            'completedBookings' => $completedBookings,
            'cancelledBookings' => $cancelledBookings,

            // Revenue statistics (placeholders)
            'totalRevenue' => $totalRevenue,
            'pendapatanHariIni' => $revenueToday,
            'pendapatanBulanIni' => $revenueThisMonth,
            'pendapatanBulanLalu' => $revenueLastMonth,
            'perubahanPendapatan' => $revenueGrowthPercentage,
            'totalPendapatanKeseluruhan' => $totalRevenue,

            // Service statistics (placeholders)
            'totalServices' => $totalServices,
            'activeServices' => $activeServices,
            'inactiveServices' => $inactiveServices,

            // Recent activities
            'recentUsers' => $recentUsers,

            // News statistics
            'totalNews' => $totalNews,
            'publishedNews' => $publishedNews,
            'featuredNews' => $featuredNews,

            // Gallery statistics
            'totalGallery' => $totalGallery,
            'publicGallery' => $publicGallery,
            'featuredGallery' => $featuredGallery,

            // Additional metrics
            'averageProductPrice' => $averageLayananPrice,
            'totalViews' => $totalViews,
            'featuredProducts' => $featuredLayanan,

            // Layanan specific data for view
            'totalLayanan' => $totalServices,
            'layananAktif' => $activeServices,
            'layananNonaktif' => $inactiveServices,
            'totalLayananUkuran' => $totalServices, // Same as total for now

            // Performance metrics
            'averageOrdersPerDay' => round($totalBookings / 30, 1), // Rough calculation
            'averageRevenuePerOrder' => $totalBookings > 0 ? round($totalRevenue / $totalBookings, 0) : 0,
            'conversionRate' => $totalDestinations > 0 ? round(($activeDestinations / $totalDestinations) * 100, 1) : 0,
            'cancellationRate' => $totalBookings > 0 ? round(($cancelledBookings / $totalBookings) * 100, 1) : 0,

            // Size/Category metrics (placeholder)
            'totalUkuran' => $totalServices,
            'ukuranAktif' => $activeServices,
            'ukuranNonaktif' => $inactiveServices,
            'ukuranPerKategori' => [],

            // System info
            'systemStatus' => 'online',
            'lastUpdated' => now()->format('d M Y, H:i'),
        ];
    }

    /**
     * Calculate growth percentage between two periods.
     *
     * @param int $current
     * @param int $previous
     * @return float
     */
    private function calculateGrowthPercentage($current, $previous)
    {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }

        return round((($current - $previous) / $previous) * 100, 1);
    }

    /**
     * Get statistics for AJAX requests.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStatistics(Request $request)
    {
        $period = $request->get('period', 'month');

        // Get statistics based on period
        $statistics = $this->getDashboardStatistics();

        // You can modify statistics based on the period here
        // For example, filter by week, month, year, etc.

        return response()->json($statistics);
    }

    /**
     * Get chart data for dashboard.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getChartData(Request $request)
    {
        $type = $request->get('type', 'users');
        $period = $request->get('period', 'month');

        switch ($type) {
            case 'users':
                return $this->getUserChartData($period);
            case 'bookings':
                return $this->getBookingChartData($period);
            case 'revenue':
                return $this->getRevenueChartData($period);
            default:
                return response()->json(['error' => 'Invalid chart type'], 400);
        }
    }

    /**
     * Get user registration chart data.
     *
     * @param string $period
     * @return \Illuminate\Http\JsonResponse
     */
    private function getUserChartData($period)
    {
        $days = $period === 'week' ? 7 : 30;
        $data = [];

        for ($i = $days - 1; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $count = User::whereDate('created_at', $date)->count();

            $data[] = [
                'date' => $date->format('Y-m-d'),
                'label' => $date->format('d M'),
                'value' => $count
            ];
        }

        return response()->json([
            'labels' => array_column($data, 'label'),
            'data' => array_column($data, 'value'),
            'title' => 'Registrasi Pengguna'
        ]);
    }

    /**
     * Get booking chart data (using special offers as booking proxy).
     *
     * @param string $period
     * @return \Illuminate\Http\JsonResponse
     */
    private function getBookingChartData($period)
    {
        $days = $period === 'week' ? 7 : 30;
        $data = [];

        for ($i = $days - 1; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $count = SpecialOffer::whereDate('created_at', $date)->count();

            $data[] = [
                'date' => $date->format('Y-m-d'),
                'label' => $date->format('d M'),
                'value' => $count
            ];
        }

        return response()->json([
            'labels' => array_column($data, 'label'),
            'data' => array_column($data, 'value'),
            'title' => 'Special Offers Harian'
        ]);
    }

    /**
     * Get revenue chart data (using products and special offers).
     *
     * @param string $period
     * @return \Illuminate\Http\JsonResponse
     */
    private function getRevenueChartData($period)
    {
        $days = $period === 'week' ? 7 : 30;
        $data = [];

        for ($i = $days - 1; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $layananRevenue = Layanan::whereDate('created_at', $date)->sum('harga_mulai');
            $offerRevenue = SpecialOffer::whereDate('created_at', $date)->sum('discounted_price');
            $totalRevenue = $layananRevenue + $offerRevenue;

            $data[] = [
                'date' => $date->format('Y-m-d'),
                'label' => $date->format('d M'),
                'value' => (int) $totalRevenue
            ];
        }

        return response()->json([
            'labels' => array_column($data, 'label'),
            'data' => array_column($data, 'value'),
            'title' => 'Pendapatan Harian'
        ]);
    }
}
