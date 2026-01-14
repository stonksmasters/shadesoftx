<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\PageView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $range = $request->get('range', 30);
        $startDate = now()->subDays($range);

        // Traffic stats
        $totalViews = PageView::where('created_at', '>=', $startDate)->count();
        $uniqueVisitors = PageView::where('created_at', '>=', $startDate)
            ->distinct('session_id')
            ->count('session_id');
        $avgDailyViews = round($totalViews / $range);

        // Daily traffic
        $dailyTraffic = PageView::where('created_at', '>=', $startDate)
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as views'))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('views', 'date');

        // Hourly traffic (using database-agnostic approach)
        $hourlyTrafficRaw = PageView::where('created_at', '>=', $startDate)
            ->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('H');
            })
            ->map(function ($group) {
                return $group->count();
            });
        
        $hourlyTraffic = $hourlyTrafficRaw->sortKeys();

        // Top pages
        $topPages = PageView::where('created_at', '>=', $startDate)
            ->select('page_name', DB::raw('count(*) as views'))
            ->whereNotNull('page_name')
            ->groupBy('page_name')
            ->orderByDesc('views')
            ->take(15)
            ->get();

        // Top referrers
        $topReferrers = PageView::where('created_at', '>=', $startDate)
            ->select('referrer', DB::raw('count(*) as views'))
            ->whereNotNull('referrer')
            ->where('referrer', '!=', '')
            ->groupBy('referrer')
            ->orderByDesc('views')
            ->take(10)
            ->get();

        // Device breakdown
        $deviceBreakdown = PageView::where('created_at', '>=', $startDate)
            ->select('device_type', DB::raw('count(*) as count'))
            ->whereNotNull('device_type')
            ->groupBy('device_type')
            ->get();

        // Service popularity (appointments)
        $servicePopularity = Appointment::where('created_at', '>=', $startDate)
            ->select('service_type', DB::raw('count(*) as count'))
            ->groupBy('service_type')
            ->orderByDesc('count')
            ->get();

        return view('admin.analytics.index', compact(
            'range',
            'totalViews',
            'uniqueVisitors',
            'avgDailyViews',
            'dailyTraffic',
            'hourlyTraffic',
            'topPages',
            'topReferrers',
            'deviceBreakdown',
            'servicePopularity'
        ));
    }

    public function funnel(Request $request)
    {
        $range = $request->get('range', 30);
        $startDate = now()->subDays($range);

        // Funnel stages
        $homepageViews = PageView::where('created_at', '>=', $startDate)
            ->where('page_url', 'like', '%' . url('/') . '%')
            ->orWhere('page_name', 'Homepage')
            ->count();

        $serviceListViews = PageView::where('created_at', '>=', $startDate)
            ->where(function ($q) {
                $q->where('page_name', 'like', '%residential%')
                    ->orWhere('page_name', 'like', '%commercial%');
            })
            ->count();

        $serviceDetailViews = PageView::where('created_at', '>=', $startDate)
            ->where(function ($q) {
                $q->where('page_name', 'like', '%window tint%')
                    ->orWhere('page_name', 'like', '%shades%')
                    ->orWhere('page_name', 'like', '%shutters%')
                    ->orWhere('page_name', 'like', '%blinds%')
                    ->orWhere('page_name', 'like', '%awnings%');
            })
            ->count();

        $bookingPageViews = PageView::where('created_at', '>=', $startDate)
            ->where('page_name', 'like', '%booking%')
            ->count();

        $completedBookings = Appointment::where('created_at', '>=', $startDate)
            ->where('status', 'completed')
            ->count();

        // Calculate conversion rates
        $homepageToServices = $homepageViews > 0 
            ? round(($serviceListViews / $homepageViews) * 100, 2) 
            : 0;
        $servicesToDetails = $serviceListViews > 0 
            ? round(($serviceDetailViews / $serviceListViews) * 100, 2) 
            : 0;
        $detailsToBooking = $serviceDetailViews > 0 
            ? round(($bookingPageViews / $serviceDetailViews) * 100, 2) 
            : 0;
        $bookingToComplete = $bookingPageViews > 0 
            ? round(($completedBookings / $bookingPageViews) * 100, 2) 
            : 0;

        // Bookings by service type
        $bookingsByService = Appointment::where('created_at', '>=', $startDate)
            ->select('service_type', DB::raw('count(*) as count'))
            ->groupBy('service_type')
            ->orderByDesc('count')
            ->get();

        return view('admin.analytics.funnel', compact(
            'range',
            'homepageViews',
            'serviceListViews',
            'serviceDetailViews',
            'bookingPageViews',
            'completedBookings',
            'homepageToServices',
            'servicesToDetails',
            'detailsToBooking',
            'bookingToComplete',
            'bookingsByService'
        ));
    }
}
