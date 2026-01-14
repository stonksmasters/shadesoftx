@extends('admin.layouts.app')

@section('page-title', 'Appointments')

@section('header-actions')
<a href="{{ route('admin.appointments.export', request()->query()) }}" class="btn-secondary">Export CSV</a>
@endsection

@section('content')
<!-- Filters -->
<div class="filters-card">
    <form method="GET" action="{{ route('admin.appointments.index') }}" class="filters-form">
        <div class="filter-group">
            <select name="status" class="form-input">
                <option value="">All Statuses</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                <option value="no_show" {{ request('status') === 'no_show' ? 'selected' : '' }}>No Show</option>
            </select>
        </div>

        <div class="filter-group">
            <input type="text" name="service_type" placeholder="Service Type" value="{{ request('service_type') }}" class="form-input">
        </div>

        <div class="filter-group">
            <input type="date" name="date_from" placeholder="From" value="{{ request('date_from') }}" class="form-input">
        </div>

        <div class="filter-group">
            <input type="date" name="date_to" placeholder="To" value="{{ request('date_to') }}" class="form-input">
        </div>

        <div class="filter-group">
            <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}" class="form-input">
        </div>

        <button type="submit" class="btn-primary">Filter</button>
        <a href="{{ route('admin.appointments.index') }}" class="btn-secondary">Clear</a>
    </form>
</div>

<!-- Bulk Actions -->
<div class="bulk-actions">
    <form method="POST" action="{{ route('admin.appointments.bulk') }}" id="bulkForm">
        @csrf
        <select name="action" id="bulkAction" class="form-input" required>
            <option value="">Bulk Actions</option>
            <option value="confirm">Confirm Selected</option>
            <option value="complete">Complete Selected</option>
            <option value="cancel">Cancel Selected</option>
            <option value="assign">Assign Selected</option>
            <option value="delete">Delete Selected</option>
        </select>

        <select name="assigned_to" id="assignAdmin" class="form-input" style="display: none;">
            <option value="">Select Admin</option>
            @foreach($admins as $admin)
                <option value="{{ $admin->id }}">{{ $admin->name }}</option>
            @endforeach
        </select>

        <button type="submit" class="btn-primary">Apply</button>
    </form>
</div>

<!-- Appointments Table -->
<div class="table-card">
    <table class="data-table">
        <thead>
            <tr>
                <th><input type="checkbox" id="selectAll"></th>
                <th>Date</th>
                <th>Customer</th>
                <th>Contact</th>
                <th>Service</th>
                <th>Status</th>
                <th>Quote</th>
                <th>Sale</th>
                <th>Assigned</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($appointments as $appointment)
                <tr>
                    <td><input type="checkbox" name="appointment_ids[]" value="{{ $appointment->id }}" form="bulkForm" class="appointment-checkbox"></td>
                    <td>{{ $appointment->selected_date->format('M d, Y') }}</td>
                    <td>{{ $appointment->name }}</td>
                    <td>
                        {{ $appointment->phone }}<br>
                        <small>{{ $appointment->email }}</small>
                    </td>
                    <td>{{ $appointment->service_type }}</td>
                    <td><span class="status-badge status-{{ $appointment->status }}">{{ ucfirst($appointment->status) }}</span></td>
                    <td>{{ $appointment->quote_amount ? '$' . number_format($appointment->quote_amount, 2) : '-' }}</td>
                    <td>{{ $appointment->sale_amount ? '$' . number_format($appointment->sale_amount, 2) : '-' }}</td>
                    <td>{{ $appointment->assignedAdmin?->name ?? '-' }}</td>
                    <td>
                        <a href="{{ route('admin.appointments.show', $appointment) }}" class="btn-link">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">No appointments found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="pagination-wrapper">
    {{ $appointments->links() }}
</div>
@endsection

@section('scripts')
<script>
document.getElementById('selectAll').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.appointment-checkbox');
    checkboxes.forEach(cb => cb.checked = this.checked);
});

document.getElementById('bulkAction').addEventListener('change', function() {
    const assignAdmin = document.getElementById('assignAdmin');
    if (this.value === 'assign') {
        assignAdmin.style.display = 'inline-block';
        assignAdmin.required = true;
    } else {
        assignAdmin.style.display = 'none';
        assignAdmin.required = false;
    }
});
</script>
@endsection
