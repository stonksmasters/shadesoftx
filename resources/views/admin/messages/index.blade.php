@extends('admin.layouts.app')

@section('page-title', 'Contact Messages')

@section('content')
<!-- Filters -->
<div class="filters-card">
    <form method="GET" action="{{ route('admin.messages.index') }}" class="filters-form">
        <div class="filter-group">
            <select name="status" class="form-input">
                <option value="">All Statuses</option>
                <option value="unread" {{ request('status') === 'unread' ? 'selected' : '' }}>Unread</option>
                <option value="read" {{ request('status') === 'read' ? 'selected' : '' }}>Read</option>
                <option value="replied" {{ request('status') === 'replied' ? 'selected' : '' }}>Replied</option>
                <option value="archived" {{ request('status') === 'archived' ? 'selected' : '' }}>Archived</option>
            </select>
        </div>

        <div class="filter-group">
            <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}" class="form-input">
        </div>

        <button type="submit" class="btn-primary">Filter</button>
        <a href="{{ route('admin.messages.index') }}" class="btn-secondary">Clear</a>
    </form>
</div>

<!-- Messages List -->
<div class="messages-list">
    @forelse($messages as $message)
        <a href="{{ route('admin.messages.show', $message) }}" class="message-card {{ $message->status === 'unread' ? 'unread' : '' }}">
            <div class="message-header">
                <div class="message-from">
                    <strong>{{ $message->name }}</strong>
                    @if($message->status === 'unread')
                        <span class="badge-new">New</span>
                    @endif
                </div>
                <div class="message-date">{{ $message->created_at->diffForHumans() }}</div>
            </div>
            <div class="message-contact">
                {{ $message->email }} • {{ $message->phone }}
            </div>
            <div class="message-preview">
                {{ Str::limit($message->message, 120) }}
            </div>
            <div class="message-footer">
                <span class="status-badge status-{{ $message->status }}">{{ ucfirst($message->status) }}</span>
                @if($message->assignedAdmin)
                    <span class="assigned-to">Assigned to: {{ $message->assignedAdmin->name }}</span>
                @endif
            </div>
        </a>
    @empty
        <div class="empty-state">
            <p>No messages found</p>
        </div>
    @endforelse
</div>

<!-- Pagination -->
<div class="pagination-wrapper">
    {{ $messages->links() }}
</div>
@endsection
