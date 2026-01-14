@extends('admin.layouts.app')

@section('page-title', 'Message Details')

@section('header-actions')
<form method="POST" action="{{ route('admin.messages.destroy', $message) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this message?')">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn-danger">Delete</button>
</form>
@endsection

@section('content')
<!-- Message Display -->
<div class="message-display">
    <div class="message-info">
        <h2>{{ $message->name }}</h2>
        <div class="contact-info">
            <span>✉️ {{ $message->email }}</span>
            <span>📞 {{ $message->phone }}</span>
            <span>🕒 {{ $message->created_at->format('M d, Y g:i A') }}</span>
        </div>
        <div class="message-status">
            <span class="status-badge status-{{ $message->status }}">{{ ucfirst($message->status) }}</span>
            @if($message->read_at)
                <span class="read-indicator">Read {{ $message->read_at->diffForHumans() }}</span>
            @endif
        </div>
    </div>

    <div class="message-body">
        <h3>Message:</h3>
        <p>{{ $message->message }}</p>
    </div>

    @if($message->admin_notes)
    <div class="admin-notes-display">
        <h3>Admin Notes:</h3>
        <p>{{ $message->admin_notes }}</p>
    </div>
    @endif
</div>

<!-- Quick Actions -->
<div class="quick-actions">
    <a href="mailto:{{ $message->email }}" class="btn-primary">📧 Reply via Email</a>
    <a href="tel:{{ $message->phone }}" class="btn-secondary">📞 Call</a>
</div>

<!-- Update Form -->
<div class="form-card">
    <h3>Update Message</h3>
    <form method="POST" action="{{ route('admin.messages.update', $message) }}">
        @csrf
        @method('PUT')

        <div class="form-row">
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-input">
                    <option value="unread" {{ $message->status === 'unread' ? 'selected' : '' }}>Unread</option>
                    <option value="read" {{ $message->status === 'read' ? 'selected' : '' }}>Read</option>
                    <option value="replied" {{ $message->status === 'replied' ? 'selected' : '' }}>Replied</option>
                    <option value="archived" {{ $message->status === 'archived' ? 'selected' : '' }}>Archived</option>
                </select>
            </div>

            <div class="form-group">
                <label for="assigned_to">Assign To</label>
                <select name="assigned_to" id="assigned_to" class="form-input">
                    <option value="">Unassigned</option>
                    @foreach($admins as $admin)
                        <option value="{{ $admin->id }}" {{ $message->assigned_to == $admin->id ? 'selected' : '' }}>
                            {{ $admin->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="admin_notes">Admin Notes</label>
            <textarea name="admin_notes" id="admin_notes" rows="4" class="form-input" placeholder="Add notes about this message...">{{ $message->admin_notes }}</textarea>
        </div>

        <button type="submit" class="btn-primary">Update Message</button>
    </form>
</div>
@endsection
