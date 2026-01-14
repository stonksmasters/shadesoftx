<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index(Request $request)
    {
        $query = ContactMessage::with('assignedAdmin');

        // Apply filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $messages = $query->latest()->paginate(20);
        $admins = AdminUser::all();

        return view('admin.messages.index', compact('messages', 'admins'));
    }

    public function show(ContactMessage $message)
    {
        // Mark as read
        if ($message->status === 'unread') {
            $message->update([
                'status' => 'read',
                'read_at' => now(),
            ]);
        }

        $message->load('assignedAdmin');
        $admins = AdminUser::all();

        return view('admin.messages.show', compact('message', 'admins'));
    }

    public function update(Request $request, ContactMessage $message)
    {
        $validated = $request->validate([
            'status' => 'sometimes|in:unread,read,replied,archived',
            'admin_notes' => 'nullable|string',
            'assigned_to' => 'nullable|exists:admin_users,id',
        ]);

        $message->update($validated);

        return redirect()->back()->with('success', 'Message updated successfully.');
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();

        return redirect()->route('admin.messages.index')
            ->with('success', 'Message deleted successfully.');
    }
}
