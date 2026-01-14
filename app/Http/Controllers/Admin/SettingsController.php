<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class SettingsController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.settings.index', compact('admin'));
    }

    public function updateProfile(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('admin_users')->ignore($admin->id),
            ],
        ]);

        $admin->update($validated);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $validated = $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        // Verify current password
        if (!Hash::check($validated['current_password'], $admin->password)) {
            return back()->withErrors([
                'current_password' => 'The current password is incorrect.',
            ]);
        }

        $admin->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->back()->with('success', 'Password updated successfully.');
    }

    public function team()
    {
        $currentAdmin = Auth::guard('admin')->user();

        if (!$currentAdmin->isSuperAdmin()) {
            abort(403, 'Only super admins can access team management.');
        }

        $admins = AdminUser::latest()->get();

        return view('admin.settings.team', compact('admins', 'currentAdmin'));
    }

    public function createAdmin(Request $request)
    {
        $currentAdmin = Auth::guard('admin')->user();

        if (!$currentAdmin->isSuperAdmin()) {
            abort(403, 'Only super admins can create admin users.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admin_users,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:admin,super_admin,viewer',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        AdminUser::create($validated);

        return redirect()->back()->with('success', 'Admin user created successfully.');
    }

    public function deleteAdmin(AdminUser $admin)
    {
        $currentAdmin = Auth::guard('admin')->user();

        if (!$currentAdmin->isSuperAdmin()) {
            abort(403, 'Only super admins can delete admin users.');
        }

        if ($admin->id === $currentAdmin->id) {
            return redirect()->back()->withErrors([
                'error' => 'You cannot delete your own account.',
            ]);
        }

        $admin->delete();

        return redirect()->back()->with('success', 'Admin user deleted successfully.');
    }
}
