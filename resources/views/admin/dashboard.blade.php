@extends('admin.layouts.app')

@section('page-title', 'Dashboard')

@section('content')
<!-- Metrics Cards -->
<div class="metrics-grid">
    <div class="metric-card">
        <div class="metric-icon">📋</div>
        <div class="metric-content">
            <div class="metric-label">Pending Appointments</div>
            <div class="metric-value">{{ $pendingAppointments }}</div>
            <div class="metric-sub">of {{ $totalAppointments }} total</div>
        </div>
    </div>

    <div class="metric-card">
        <div class="metric-icon">📅</div>
        <div class="metric-content">
            <div class="metric-label">This Week</div>
            <div class="metric-value">{{ $appointmentsThisWeek }}</div>
            <div class="metric-sub">{{ $appointmentsThisMonth }} this month</div>
        </div>
    </div>

    <div class="metric-card">
        <div class="metric-icon">✉️</div>
        <div class="metric-content">
            <div class="metric-label">Unread Messages</div>
            <div class="metric-value">{{ $unreadMessages }}</div>
        </div>
    </div>

    <div class="metric-card">
        <div class="metric-icon">👁️</div>
        <div class="metric-content">
            <div class="metric-label">Page Views Today</div>
            <div class="metric-value">{{ $todayPageViews }}</div>
        </div>
    </div>

    <div class="metric-card">
        <div class="metric-icon">📊</div>
        <div class="metric-content">
            <div class="metric-label">Conversion Rate</div>
            <div class="metric-value">{{ $conversionRate }}%</div>
            <div class="metric-sub">30-day average</div>
        </div>
    </div>

    <div class="metric-card">
        <div class="metric-icon">💰</div>
        <div class="metric-content">
            <div class="metric-label">Total Quoted</div>
            <div class="metric-value">${{ number_format($totalQuoted, 0) }}</div>
        </div>
    </div>

    <div class="metric-card">
        <div class="metric-icon">💵</div>
        <div class="metric-content">
            <div class="metric-label">Total Sales</div>
            <div class="metric-value">${{ number_format($totalSales, 0) }}</div>
        </div>
    </div>

    <div class="metric-card">
        <div class="metric-icon">🎯</div>
        <div class="metric-content">
            <div class="metric-label">Close Rate</div>
            <div class="metric-value">{{ $closeRate }}%</div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="charts-row">
    <div class="chart-card">
        <h3>Appointments (Last 30 Days)</h3>
        <canvas id="appointmentsChart"></canvas>
    </div>

    <div class="chart-card">
        <h3>Page Views (Last 30 Days)</h3>
        <canvas id="pageViewsChart"></canvas>
    </div>
</div>

<!-- Data Tables Row -->
<div class="data-row">
    <!-- Recent Appointments -->
    <div class="data-card">
        <h3>Recent Appointments</h3>
        <div class="table-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Customer</th>
                        <th>Service</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentAppointments as $appointment)
                        <tr>
                            <td>{{ $appointment->selected_date->format('M d') }}</td>
                            <td>{{ $appointment->name }}</td>
                            <td>{{ $appointment->service_type }}</td>
                            <td><span class="status-badge status-{{ $appointment->status }}">{{ ucfirst($appointment->status) }}</span></td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center">No appointments yet</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recent Messages -->
    <div class="data-card">
        <h3>Recent Messages</h3>
        <div class="table-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>From</th>
                        <th>Message</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentMessages as $message)
                        <tr>
                            <td>{{ $message->name }}</td>
                            <td>{{ Str::limit($message->message, 40) }}</td>
                            <td><span class="status-badge status-{{ $message->status }}">{{ ucfirst($message->status) }}</span></td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="text-center">No messages yet</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Analytics Row -->
<div class="data-row">
    <!-- Service Popularity -->
    <div class="data-card">
        <h3>Popular Services</h3>
        <div class="table-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Service</th>
                        <th>Bookings</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($appointmentsByService as $service)
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

    <!-- Top Pages -->
    <div class="data-card">
        <h3>Top Pages (30 Days)</h3>
        <div class="table-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Page</th>
                        <th>Views</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($topPages->take(10) as $page)
                        <tr>
                            <td>{{ $page->page_name }}</td>
                            <td>{{ $page->views }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="2" class="text-center">No data</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Device Breakdown -->
    <div class="data-card">
        <h3>Device Breakdown</h3>
        <canvas id="deviceChart" style="max-height: 250px;"></canvas>
    </div>
</div>

<!-- Upcoming Appointments -->
<div class="data-card">
    <h3>Upcoming Appointments</h3>
    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Service</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($upcomingAppointments as $appointment)
                    <tr>
                        <td>{{ $appointment->selected_date->format('M d, Y') }}</td>
                        <td>{{ $appointment->name }}</td>
                        <td>{{ $appointment->phone }}</td>
                        <td>{{ $appointment->email }}</td>
                        <td>{{ $appointment->service_type }}</td>
                        <td><span class="status-badge status-{{ $appointment->status }}">{{ ucfirst($appointment->status) }}</span></td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center">No upcoming appointments</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Appointments Chart
const appointmentsData = @json($dailyAppointments);
const appointmentsLabels = Object.keys(appointmentsData);
const appointmentsValues = Object.values(appointmentsData);

new Chart(document.getElementById('appointmentsChart'), {
    type: 'line',
    data: {
        labels: appointmentsLabels,
        datasets: [{
            label: 'Appointments',
            data: appointmentsValues,
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
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                }
            }
        }
    }
});

// Page Views Chart
const pageViewsData = @json($dailyPageViews);
const pageViewsLabels = Object.keys(pageViewsData);
const pageViewsValues = Object.values(pageViewsData);

new Chart(document.getElementById('pageViewsChart'), {
    type: 'line',
    data: {
        labels: pageViewsLabels,
        datasets: [{
            label: 'Page Views',
            data: pageViewsValues,
            borderColor: '#0033A0',
            backgroundColor: 'rgba(0, 51, 160, 0.1)',
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

// Device Breakdown Chart
const deviceData = @json($deviceBreakdown);
const deviceLabels = deviceData.map(d => d.device_type.charAt(0).toUpperCase() + d.device_type.slice(1));
const deviceCounts = deviceData.map(d => d.count);

new Chart(document.getElementById('deviceChart'), {
    type: 'doughnut',
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
