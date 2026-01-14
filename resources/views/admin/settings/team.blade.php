@extends('admin.layouts.app')

@section('page-title', 'Team Management')

@section('content')
<!-- Current Team Members -->
<div class="data-card">
    <h3>Team Members</h3>
    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Last Login</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($admins as $admin)
                    <tr>
                        <td>{{ $admin->name }}</td>
                        <td>{{ $admin->email }}</td>
                        <td><span class="role-badge role-{{ $admin->role }}">{{ ucfirst(str_replace('_', ' ', $admin->role)) }}</span></td>
                        <td>{{ $admin->last_login_at ? $admin->last_login_at->diffForHumans() : 'Never' }}</td>
                        <td>
                            @if($admin->id !== $currentAdmin->id)
                                <form method="POST" action="{{ route('admin.settings.team.delete', $admin) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this admin?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger btn-sm">Delete</button>
                                </form>
                            @else
                                <span class="text-muted">Current User</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Create New Admin -->
<div class="form-card">
    <h3>Create New Admin User</h3>
    <form method="POST" action="{{ route('admin.settings.team.create') }}">
        @csrf

        <div class="form-row">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required class="form-input">
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required class="form-input">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required minlength="8" class="form-input">
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required class="form-input">
            </div>
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <select name="role" id="role" required class="form-input">
                <option value="viewer">Viewer (Read-only access)</option>
                <option value="admin" selected>Admin (Full access)</option>
                <option value="super_admin">Super Admin (Full access + team management)</option>
            </select>
        </div>

        <button type="submit" class="btn-primary">Create Admin User</button>
    </form>
</div>

<div class="info-card">
    <h3>Role Descriptions</h3>
    <ul class="role-descriptions">
        <li><strong>Viewer:</strong> Read-only access to view appointments, messages, and analytics.</li>
        <li><strong>Admin:</strong> Full access to manage appointments, messages, and view analytics.</li>
        <li><strong>Super Admin:</strong> Full admin access plus ability to manage team members.</li>
    </ul>
</div>
@endsection
