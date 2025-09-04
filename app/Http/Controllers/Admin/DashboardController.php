<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
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

        // Since this is a travel system, we'll prepare placeholders for travel-related data
        // These can be updated when the actual models are created
        $totalDestinations = 0; // Placeholder for destinations
        $activeDestinations = 0;
        $inactiveDestinations = 0;
        
        $totalBookings = 0; // Placeholder for bookings
        $pendingBookings = 0;
        $completedBookings = 0;
        $cancelledBookings = 0;
        
        $totalRevenue = 0; // Placeholder for revenue
        $revenueToday = 0;
        $revenueThisMonth = 0;
        $revenueLastMonth = 0;
        $revenueGrowthPercentage = 0;
        
        $totalServices = 0; // Placeholder for services/packages
        $activeServices = 0;
        $inactiveServices = 0;

        // Recent activities (using users as example)
        $recentUsers = User::latest()->take(5)->get();

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
     * Get booking chart data (placeholder).
     *
     * @param string $period
     * @return \Illuminate\Http\JsonResponse
     */
    private function getBookingChartData($period)
    {
        // Placeholder for booking chart data
        // This will be implemented when booking model is available
        
        $days = $period === 'week' ? 7 : 30;
        $data = [];
        
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            
            $data[] = [
                'date' => $date->format('Y-m-d'),
                'label' => $date->format('d M'),
                'value' => 0 // Placeholder
            ];
        }
        
        return response()->json([
            'labels' => array_column($data, 'label'),
            'data' => array_column($data, 'value'),
            'title' => 'Booking Harian'
        ]);
    }

    /**
     * Get revenue chart data (placeholder).
     *
     * @param string $period
     * @return \Illuminate\Http\JsonResponse
     */
    private function getRevenueChartData($period)
    {
        // Placeholder for revenue chart data
        // This will be implemented when booking/payment models are available
        
        $days = $period === 'week' ? 7 : 30;
        $data = [];
        
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            
            $data[] = [
                'date' => $date->format('Y-m-d'),
                'label' => $date->format('d M'),
                'value' => 0 // Placeholder
            ];
        }
        
        return response()->json([
            'labels' => array_column($data, 'label'),
            'data' => array_column($data, 'value'),
            'title' => 'Pendapatan Harian'
        ]);
    }
}