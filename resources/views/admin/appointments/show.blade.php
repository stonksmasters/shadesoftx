@extends('admin.layouts.app')

@section('page-title', 'Appointment Details')

@section('header-actions')
<form method="POST" action="{{ route('admin.appointments.destroy', $appointment) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this appointment?')">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn-danger">Delete</button>
</form>
@endsection

@section('content')
<div class="details-row">
    <!-- Customer Info -->
    <div class="info-card">
        <h3>Customer Information</h3>
        <div class="info-row">
            <span class="info-label">Name:</span>
            <span class="info-value">{{ $appointment->name }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Email:</span>
            <span class="info-value">{{ $appointment->email }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Phone:</span>
            <span class="info-value">{{ $appointment->phone }}</span>
        </div>
    </div>

    <!-- Appointment Details -->
    <div class="info-card">
        <h3>Appointment Details</h3>
        <div class="info-row">
            <span class="info-label">Service:</span>
            <span class="info-value">{{ $appointment->service_type }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Date:</span>
            <span class="info-value">{{ $appointment->selected_date->format('F d, Y') }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Status:</span>
            <span class="status-badge status-{{ $appointment->status }}">{{ ucfirst($appointment->status) }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Source:</span>
            <span class="info-value">{{ $appointment->source_page ?? 'Direct' }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Created:</span>
            <span class="info-value">{{ $appointment->created_at->format('M d, Y g:i A') }}</span>
        </div>
    </div>

    <!-- Financial Info -->
    <div class="info-card">
        <h3>Financial</h3>
        <div class="info-row">
            <span class="info-label">Quote Amount:</span>
            <span class="info-value">{{ $appointment->quote_amount ? '$' . number_format($appointment->quote_amount, 2) : 'Not set' }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Sale Amount:</span>
            <span class="info-value">{{ $appointment->sale_amount ? '$' . number_format($appointment->sale_amount, 2) : 'Not set' }}</span>
        </div>
        @if($appointment->quote_amount && $appointment->sale_amount)
        <div class="info-row">
            <span class="info-label">Close Rate:</span>
            <span class="info-value">{{ round(($appointment->sale_amount / $appointment->quote_amount) * 100) }}%</span>
        </div>
        @endif
        <div class="info-row">
            <span class="info-label">Assigned To:</span>
            <span class="info-value">{{ $appointment->assignedAdmin?->name ?? 'Unassigned' }}</span>
        </div>
    </div>
</div>

<!-- Update Form -->
<div class="form-card">
    <h3>Update Appointment</h3>
    <form method="POST" action="{{ route('admin.appointments.update', $appointment) }}">
        @csrf
        @method('PUT')

        <div class="form-row">
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-input">
                    <option value="pending" {{ $appointment->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ $appointment->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="completed" {{ $appointment->status === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $appointment->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    <option value="no_show" {{ $appointment->status === 'no_show' ? 'selected' : '' }}>No Show</option>
                </select>
            </div>

            <div class="form-group">
                <label for="assigned_to">Assign To</label>
                <select name="assigned_to" id="assigned_to" class="form-input">
                    <option value="">Unassigned</option>
                    @foreach($admins as $admin)
                        <option value="{{ $admin->id }}" {{ $appointment->assigned_to == $admin->id ? 'selected' : '' }}>
                            {{ $admin->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="quote_amount">Quote Amount ($)</label>
                <input type="number" name="quote_amount" id="quote_amount" step="0.01" min="0" value="{{ $appointment->quote_amount }}" class="form-input">
            </div>

            <div class="form-group">
                <label for="sale_amount">Sale Amount ($)</label>
                <input type="number" name="sale_amount" id="sale_amount" step="0.01" min="0" value="{{ $appointment->sale_amount }}" class="form-input">
            </div>
        </div>

        <div class="form-group">
            <label for="admin_notes">Admin Notes</label>
            <textarea name="admin_notes" id="admin_notes" rows="4" class="form-input">{{ $appointment->admin_notes }}</textarea>
        </div>

        <button type="submit" class="btn-primary">Update Appointment</button>
    </form>
</div>

<!-- Timeline -->
<div class="timeline-card">
    <h3>Timeline</h3>
    <div class="timeline">
        <div class="timeline-item">
            <div class="timeline-icon">📝</div>
            <div class="timeline-content">
                <div class="timeline-title">Appointment Created</div>
                <div class="timeline-date">{{ $appointment->created_at->format('M d, Y g:i A') }}</div>
            </div>
        </div>

        @if($appointment->confirmed_at)
        <div class="timeline-item">
            <div class="timeline-icon">✅</div>
            <div class="timeline-content">
                <div class="timeline-title">Confirmed</div>
                <div class="timeline-date">{{ $appointment->confirmed_at->format('M d, Y g:i A') }}</div>
            </div>
        </div>
        @endif

        @if($appointment->completed_at)
        <div class="timeline-item">
            <div class="timeline-icon">🎉</div>
            <div class="timeline-content">
                <div class="timeline-title">Completed</div>
                <div class="timeline-date">{{ $appointment->completed_at->format('M d, Y g:i A') }}</div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
