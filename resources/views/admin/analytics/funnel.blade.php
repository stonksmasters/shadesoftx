@extends('admin.layouts.app')

@section('page-title', 'Sales Funnel')

@section('header-actions')
<form method="GET" action="{{ route('admin.analytics.funnel') }}" style="display: inline;">
    <select name="range" class="form-input" onchange="this.form.submit()">
        <option value="7" {{ $range == 7 ? 'selected' : '' }}>Last 7 Days</option>
        <option value="30" {{ $range == 30 ? 'selected' : '' }}>Last 30 Days</option>
        <option value="90" {{ $range == 90 ? 'selected' : '' }}>Last 90 Days</option>
    </select>
</form>
<a href="{{ route('admin.analytics.index') }}" class="btn-secondary">Back to Analytics</a>
@endsection

@section('content')
<!-- Funnel Visualization -->
<div class="funnel-card">
    <h2>Conversion Funnel</h2>
    
    <div class="funnel-stage">
        <div class="funnel-bar" style="width: 100%;">
            <div class="funnel-label">Homepage Views</div>
            <div class="funnel-value">{{ number_format($homepageViews) }}</div>
            <div class="funnel-percent">100%</div>
        </div>
    </div>

    <div class="funnel-arrow">
        <div class="conversion-rate">{{ $homepageToServices }}% conversion</div>
    </div>

    <div class="funnel-stage">
        <div class="funnel-bar" style="width: {{ $homepageViews > 0 ? ($serviceListViews / $homepageViews * 100) : 0 }}%;">
            <div class="funnel-label">Service List Views</div>
            <div class="funnel-value">{{ number_format($serviceListViews) }}</div>
            <div class="funnel-percent">{{ $homepageViews > 0 ? round($serviceListViews / $homepageViews * 100) : 0 }}%</div>
        </div>
    </div>

    <div class="funnel-arrow">
        <div class="conversion-rate">{{ $servicesToDetails }}% conversion</div>
    </div>

    <div class="funnel-stage">
        <div class="funnel-bar" style="width: {{ $homepageViews > 0 ? ($serviceDetailViews / $homepageViews * 100) : 0 }}%;">
            <div class="funnel-label">Service Detail Views</div>
            <div class="funnel-value">{{ number_format($serviceDetailViews) }}</div>
            <div class="funnel-percent">{{ $homepageViews > 0 ? round($serviceDetailViews / $homepageViews * 100) : 0 }}%</div>
        </div>
    </div>

    <div class="funnel-arrow">
        <div class="conversion-rate">{{ $detailsToBooking }}% conversion</div>
    </div>

    <div class="funnel-stage">
        <div class="funnel-bar" style="width: {{ $homepageViews > 0 ? ($bookingPageViews / $homepageViews * 100) : 0 }}%;">
            <div class="funnel-label">Booking Page Views</div>
            <div class="funnel-value">{{ number_format($bookingPageViews) }}</div>
            <div class="funnel-percent">{{ $homepageViews > 0 ? round($bookingPageViews / $homepageViews * 100) : 0 }}%</div>
        </div>
    </div>

    <div class="funnel-arrow">
        <div class="conversion-rate">{{ $bookingToComplete }}% conversion</div>
    </div>

    <div class="funnel-stage">
        <div class="funnel-bar" style="width: {{ $homepageViews > 0 ? ($completedBookings / $homepageViews * 100) : 0 }}%;">
            <div class="funnel-label">Completed Bookings</div>
            <div class="funnel-value">{{ number_format($completedBookings) }}</div>
            <div class="funnel-percent">{{ $homepageViews > 0 ? round($completedBookings / $homepageViews * 100, 2) : 0 }}%</div>
        </div>
    </div>
</div>

<!-- Drop-off Analysis -->
<div class="dropoff-card">
    <h3>Drop-off Analysis</h3>
    
    <div class="dropoff-item">
        <div class="dropoff-label">Homepage → Service List</div>
        <div class="progress-bar">
            <div class="progress-fill" style="width: {{ $homepageToServices }}%"></div>
        </div>
        <div class="dropoff-stats">
            <span>{{ $homepageToServices }}% continued</span>
            <span class="dropoff-rate">{{ 100 - $homepageToServices }}% dropped</span>
        </div>
    </div>

    <div class="dropoff-item">
        <div class="dropoff-label">Service List → Service Details</div>
        <div class="progress-bar">
            <div class="progress-fill" style="width: {{ $servicesToDetails }}%"></div>
        </div>
        <div class="dropoff-stats">
            <span>{{ $servicesToDetails }}% continued</span>
            <span class="dropoff-rate">{{ 100 - $servicesToDetails }}% dropped</span>
        </div>
    </div>

    <div class="dropoff-item">
        <div class="dropoff-label">Service Details → Booking Page</div>
        <div class="progress-bar">
            <div class="progress-fill" style="width: {{ $detailsToBooking }}%"></div>
        </div>
        <div class="dropoff-stats">
            <span>{{ $detailsToBooking }}% continued</span>
            <span class="dropoff-rate">{{ 100 - $detailsToBooking }}% dropped</span>
        </div>
    </div>

    <div class="dropoff-item">
        <div class="dropoff-label">Booking Page → Completed</div>
        <div class="progress-bar">
            <div class="progress-fill" style="width: {{ $bookingToComplete }}%"></div>
        </div>
        <div class="dropoff-stats">
            <span>{{ $bookingToComplete }}% completed</span>
            <span class="dropoff-rate">{{ 100 - $bookingToComplete }}% dropped</span>
        </div>
    </div>
</div>

<!-- Bookings by Service -->
<div class="data-card">
    <h3>Bookings by Service Type</h3>
    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Bookings</th>
                    <th>Percentage</th>
                </tr>
            </thead>
            <tbody>
                @php $totalBookings = $bookingsByService->sum('count'); @endphp
                @forelse($bookingsByService as $service)
                    <tr>
                        <td>{{ $service->service_type }}</td>
                        <td>{{ $service->count }}</td>
                        <td>{{ $totalBookings > 0 ? round($service->count / $totalBookings * 100, 1) : 0 }}%</td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="text-center">No bookings in this period</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
