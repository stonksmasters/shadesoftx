@extends('admin.layouts.app')

@section('page-title', 'Analytics')

@section('header-actions')
<form method="GET" action="{{ route('admin.analytics.index') }}" style="display: inline;">
    <select name="range" class="form-input" onchange="this.form.submit()">
        <option value="7" {{ $range == 7 ? 'selected' : '' }}>Last 7 Days</option>
        <option value="30" {{ $range == 30 ? 'selected' : '' }}>Last 30 Days</option>
        <option value="90" {{ $range == 90 ? 'selected' : '' }}>Last 90 Days</option>
    </select>
</form>
<a href="{{ route('admin.analytics.funnel') }}" class="btn-primary">View Funnel</a>
@endsection

@section('content')
<!-- Traffic Metrics -->
<div class="metrics-grid">
    <div class="metric-card">
        <div class="metric-icon">👁️</div>
        <div class="metric-content">
            <div class="metric-label">Total Views</div>
            <div class="metric-value">{{ number_format($totalViews) }}</div>
        </div>
    </div>

    <div class="metric-card">
        <div class="metric-icon">👥</div>
        <div class="metric-content">
            <div class="metric-label">Unique Visitors</div>
            <div class="metric-value">{{ number_format($uniqueVisitors) }}</div>
        </div>
    </div>

    <div class="metric-card">
        <div class="metric-icon">📊</div>
        <div class="metric-content">
            <div class="metric-label">Avg Daily Views</div>
            <div class="metric-value">{{ number_format($avgDailyViews) }}</div>
        </div>
    </div>
</div>

<!-- Daily Traffic Chart -->
<div class="chart-card">
    <h3>Daily Traffic</h3>
    <canvas id="dailyTrafficChart"></canvas>
</div>

<!-- Hourly Traffic Chart -->
<div class="chart-card">
    <h3>Traffic by Hour</h3>
    <canvas id="hourlyTrafficChart"></canvas>
</div>

<!-- Device and Browser Breakdown -->
<div class="charts-row">
    <div class="chart-card">
        <h3>Device Breakdown</h3>
        <canvas id="deviceChart"></canvas>
    </div>

    <div class="data-card">
        <h3>Service Popularity</h3>
        <div class="table-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Service</th>
                        <th>Bookings</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($servicePopularity as $service)
                        <tr>
                            <td>{{ $service->service_type }}</td>
                            <td>{{ $service->count }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="2" class="text-center">No data</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Top Pages and Referrers -->
<div class="data-row">
    <div class="data-card">
        <h3>Top Pages</h3>
        <div class="table-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Page</th>
                        <th>Views</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($topPages as $page)
                        <tr>
                            <td>{{ $page->page_name }}</td>
                            <td>{{ number_format($page->views) }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="2" class="text-center">No data</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="data-card">
        <h3>Top Referrers</h3>
        <div class="table-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Source</th>
                        <th>Views</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($topReferrers as $referrer)
                        <tr>
                            <td><small>{{ Str::limit($referrer->referrer, 40) }}</small></td>
                            <td>{{ number_format($referrer->views) }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="2" class="text-center">No data</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Daily Traffic Chart
const dailyData = @json($dailyTraffic);
const dailyLabels = Object.keys(dailyData);
const dailyValues = Object.values(dailyData);

new Chart(document.getElementById('dailyTrafficChart'), {
    type: 'line',
    data: {
        labels: dailyLabels,
        datasets: [{
            label: 'Page Views',
            data: dailyValues,
            borderColor: '#C8102E',
            backgroundColor: 'rgba(200, 16, 46, 0.1)',
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Hourly Traffic Chart
const hourlyData = @json($hourlyTraffic);
const hourlyLabels = Object.keys(hourlyData).map(h => h + ':00');
const hourlyValues = Object.values(hourlyData);

new Chart(document.getElementById('hourlyTrafficChart'), {
    type: 'bar',
    data: {
        labels: hourlyLabels,
        datasets: [{
            label: 'Page Views',
            data: hourlyValues,
            backgroundColor: '#0033A0'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Device Chart
const deviceData = @json($deviceBreakdown);
const deviceLabels = deviceData.map(d => d.device_type.charAt(0).toUpperCase() + d.device_type.slice(1));
const deviceCounts = deviceData.map(d => d.count);

new Chart(document.getElementById('deviceChart'), {
    type: 'pie',
    data: {
        labels: deviceLabels,
        datasets: [{
            data: deviceCounts,
            backgroundColor: ['#C8102E', '#0033A0', '#2A2A2A']
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});
</script>
@endsection
