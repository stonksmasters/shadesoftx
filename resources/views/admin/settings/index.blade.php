@extends('admin.layouts.app')

@section('page-title', 'Settings')

@section('content')
<!-- Profile Settings -->
<div class="form-card">
    <h3>Profile Information</h3>
    <form method="POST" action="{{ route('admin.settings.profile') }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $admin->name) }}" required class="form-input">
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" value="{{ old('email', $admin->email) }}" required class="form-input">
        </div>

        <button type="submit" class="btn-primary">Update Profile</button>
    </form>
</div>

<!-- Password Change -->
<div class="form-card">
    <h3>Change Password</h3>
    <form method="POST" action="{{ route('admin.settings.password') }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="current_password">Current Password</label>
            <input type="password" name="current_password" id="current_password" required class="form-input">
        </div>

        <div class="form-group">
            <label for="password">New Password</label>
            <input type="password" name="password" id="password" required minlength="8" class="form-input">
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm New Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required class="form-input">
        </div>

        <button type="submit" class="btn-primary">Update Password</button>
    </form>
</div>

<!-- Account Info -->
<div class="info-card">
    <h3>Account Information</h3>
    <div class="info-row">
        <span class="info-label">Role:</span>
        <span class="info-value">{{ ucfirst($admin->role) }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Last Login:</span>
        <span class="info-value">{{ $admin->last_login_at ? $admin->last_login_at->format('M d, Y g:i A') : 'Never' }}</span>
    </div>
    <div class="info-row">
        <span class="info-label">Account Created:</span>
        <span class="info-value">{{ $admin->created_at->format('M d, Y') }}</span>
    </div>
</div>

@if($admin->isSuperAdmin())
<div class="info-card">
    <h3>Team Management</h3>
    <p>As a super admin, you can manage team members.</p>
    <a href="{{ route('admin.settings.team') }}" class="btn-primary">Manage Team</a>
</div>
@endif
@endsection
