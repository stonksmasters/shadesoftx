<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\ContactMessage;
use App\Models\PageView;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Appointments metrics
        $pendingAppointments = Appointment::where('status', 'pending')->count();
        $totalAppointments = Appointment::count();
        $appointmentsThisWeek = Appointment::thisWeek()->count();
        $appointmentsThisMonth = Appointment::thisMonth()->count();

        // Messages metrics
        $unreadMessages = ContactMessage::where('status', 'unread')->count();

        // Page views metrics
        $todayPageViews = PageView::whereDate('created_at', today())->count();

        // Conversion metrics
        $bookingPageViews = PageView::where('page_url', 'like', '%/booking%')
            ->whereBetween('created_at', [now()->subDays(30), now()])
            ->count();
        $completedBookings = Appointment::where('status', 'completed')
            ->whereBetween('created_at', [now()->subDays(30), now()])
            ->count();
        $conversionRate = $bookingPageViews > 0 
            ? round(($completedBookings / $bookingPageViews) * 100, 2) 
            : 0;

        // Financial metrics
        $totalQuoted = Appointment::sum('quote_amount') ?? 0;
        $totalSales = Appointment::sum('sale_amount') ?? 0;
        $appointmentsWithQuotes = Appointment::whereNotNull('quote_amount')->count();
        $appointmentsWithSales = Appointment::whereNotNull('sale_amount')->count();
        $closeRate = $appointmentsWithQuotes > 0 
            ? round(($appointmentsWithSales / $appointmentsWithQuotes) * 100, 2) 
            : 0;

        // Recent items
        $recentAppointments = Appointment::with('assignedAdmin')
            ->latest()
            ->take(10)
            ->get();
        $recentMessages = ContactMessage::latest()->take(10)->get();

        // Appointments by service type
        $appointmentsByService = Appointment::select('service_type', DB::raw('count(*) as count'))
            ->groupBy('service_type')
            ->orderByDesc('count')
            ->get();

        // Appointments by status
        $appointmentsByStatus = Appointment::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();

        // Daily appointments for chart (last 30 days)
        $dailyAppointments = Appointment::whereBetween('created_at', [now()->subDays(30), now()])
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('count', 'date');

        // Daily page views for chart (last 30 days)
        $dailyPageViews = PageView::whereBetween('created_at', [now()->subDays(30), now()])
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('count', 'date');

        // Top pages
        $topPages = PageView::select('page_name', DB::raw('count(*) as views'))
            ->whereNotNull('page_name')
            ->whereBetween('created_at', [now()->subDays(30), now()])
            ->groupBy('page_name')
            ->orderByDesc('views')
            ->take(10)
            ->get();

        // Device breakdown
        $deviceBreakdown = PageView::select('device_type', DB::raw('count(*) as count'))
            ->whereNotNull('device_type')
            ->whereBetween('created_at', [now()->subDays(30), now()])
            ->groupBy('device_type')
            ->get();

        // Upcoming appointments
        $upcomingAppointments = Appointment::where('selected_date', '>=', today())
            ->where('status', '!=', 'cancelled')
            ->orderBy('selected_date')
            ->take(10)
            ->get();

        return view('admin.dashboard', compact(
            'pendingAppointments',
            'totalAppointments',
            'appointmentsThisWeek',
            'appointmentsThisMonth',
            'unreadMessages',
            'todayPageViews',
            'conversionRate',
            'totalQuoted',
            'totalSales',
            'closeRate',
            'recentAppointments',
            'recentMessages',
            'appointmentsByService',
            'appointmentsByStatus',
            'dailyAppointments',
            'dailyPageViews',
            'topPages',
            'deviceBreakdown',
            'upcomingAppointments'
        ));
    }
}
