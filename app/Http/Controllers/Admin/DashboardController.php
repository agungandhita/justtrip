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
        $userGrowthPercentage = $this->calculateGrowthPercentage($newUsersThisMonth, $newUsersLastMonth);
        $totalAdmins = User::where('role', 'admin')->count();
        $totalRegularUsers = User::where('role', 'user')->count();

        // Layanan statistics
        $totalLayanan = \App\Models\Layanan::count();
        $layananAktif = \App\Models\Layanan::where('status', 'aktif')->count();
        $layananNonaktif = \App\Models\Layanan::where('status', 'nonaktif')->count();

        // Booking statistics (Real data from Booking model)
        $bookingModel = new \App\Models\Booking();
        $totalBookings = \App\Models\Booking::count();
        $pendingBookings = \App\Models\Booking::where('status', 'pending')->count();
        $confirmedBookings = \App\Models\Booking::where('status', 'confirmed')->count();
        $completedBookings = \App\Models\Booking::where('status', 'completed')->count();
        $cancelledBookings = \App\Models\Booking::where('status', 'cancelled')->count();
        $newBookingsToday = \App\Models\Booking::whereDate('created_at', $today)->count();

        // Revenue calculation from approved/completed bookings
        $revenueQuery = \App\Models\Booking::whereIn('status', ['confirmed', 'approved', 'completed', 'payment_uploaded']);
        $totalRevenue = (float) $revenueQuery->sum('total_amount');
        $revenueToday = (float) $revenueQuery->whereDate('created_at', $today)->sum('total_amount');
        $revenueThisMonth = (float) \App\Models\Booking::whereIn('status', ['confirmed', 'approved', 'completed', 'payment_uploaded'])
                                    ->where('created_at', '>=', $thisMonth)
                                    ->sum('total_amount');
        $revenueLastMonth = (float) \App\Models\Booking::whereIn('status', ['confirmed', 'approved', 'completed', 'payment_uploaded'])
                                    ->whereBetween('created_at', [$lastMonth, $lastMonthEnd])
                                    ->sum('total_amount');
        $revenueGrowthPercentage = $this->calculateGrowthPercentage($revenueThisMonth, $revenueLastMonth);

        // Recent Bookings
        $recentBookings = \App\Models\Booking::with(['user', 'layanan'])
                                            ->latest()
                                            ->take(5)
                                            ->get();

        // Top Services (based on booking count)
        $topServices = \App\Models\Layanan::withCount('bookings')
                                        ->orderBy('bookings_count', 'desc')
                                        ->take(5)
                                        ->get();

        // Special Offers statistics
        $totalOffers = SpecialOffer::count();
        $activeOffers = SpecialOffer::where('is_active', true)->where('valid_until', '>=', now())->count();

        // News statistics
        $totalNews = News::count();
        $featuredNews = News::where('is_featured', true)->count();

        // Gallery statistics
        $totalGallery = Gallery::count();
        $featuredGallery = Gallery::where('featured', true)->count();

        // Additional metrics
        $totalViews = News::sum('views'); // Gallery views removed from optimization
        $averageLayananPrice = \App\Models\Layanan::avg('harga_mulai') ?? 0;

        return [
            // User statistics
            'totalUsers' => $totalUsers,
            'newUsersToday' => $newUsersToday,
            'newUsersThisMonth' => $newUsersThisMonth,
            'userGrowthPercentage' => $userGrowthPercentage,
            'totalAdmins' => $totalAdmins,
            'totalRegularUsers' => $totalRegularUsers,

            // Layanan statistics
            'totalLayanan' => $totalLayanan,
            'layananAktif' => $layananAktif,
            'layananNonaktif' => $layananNonaktif,

            // Booking statistics
            'totalBookings' => $totalBookings,
            'pendingBookings' => $pendingBookings,
            'confirmedBookings' => $confirmedBookings,
            'completedBookings' => $completedBookings,
            'cancelledBookings' => $cancelledBookings,
            'newBookingsToday' => $newBookingsToday,
            'recentBookings' => $recentBookings,

            // Revenue statistics
            'totalRevenue' => $totalRevenue,
            'pendapatanHariIni' => $revenueToday,
            'pendapatanBulanIni' => $revenueThisMonth,
            'pendapatanBulanLalu' => $revenueLastMonth,
            'perubahanPendapatan' => $revenueGrowthPercentage,
            'totalPendapatanKeseluruhan' => $totalRevenue,

            // Other content statistics
            'totalOffers' => $totalOffers,
            'activeOffers' => $activeOffers,
            'totalNews' => $totalNews,
            'featuredNews' => $featuredNews,
            'totalGallery' => $totalGallery,
            'featuredGallery' => $featuredGallery,

            // Metrics
            'topServices' => $topServices,
            'totalViews' => $totalViews,
            'averageLayananPrice' => $averageLayananPrice,
            'conversionRate' => $totalBookings > 0 ? round(($completedBookings / $totalBookings) * 100, 1) : 0,
            
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
