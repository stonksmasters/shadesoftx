<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Appointment::with('assignedAdmin');

        // Apply filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('service_type')) {
            $query->where('service_type', $request->service_type);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('selected_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('selected_date', '<=', $request->date_to);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $appointments = $query->latest()->paginate(20);
        $admins = AdminUser::all();

        return view('admin.appointments.index', compact('appointments', 'admins'));
    }

    public function show(Appointment $appointment)
    {
        $appointment->load('assignedAdmin');
        $admins = AdminUser::all();

        return view('admin.appointments.show', compact('appointment', 'admins'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'status' => 'sometimes|in:pending,confirmed,completed,cancelled,no_show',
            'admin_notes' => 'nullable|string',
            'quote_amount' => 'nullable|numeric|min:0',
            'sale_amount' => 'nullable|numeric|min:0',
            'assigned_to' => 'nullable|exists:admin_users,id',
        ]);

        // Set timestamps based on status
        if (isset($validated['status'])) {
            if ($validated['status'] === 'confirmed' && $appointment->status !== 'confirmed') {
                $validated['confirmed_at'] = now();
            }
            if ($validated['status'] === 'completed' && $appointment->status !== 'completed') {
                $validated['completed_at'] = now();
            }
        }

        $appointment->update($validated);

        return redirect()->back()->with('success', 'Appointment updated successfully.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('admin.appointments.index')
            ->with('success', 'Appointment deleted successfully.');
    }

    public function bulkAction(Request $request)
    {
        $validated = $request->validate([
            'action' => 'required|in:confirm,complete,cancel,delete,assign',
            'appointment_ids' => 'required|array',
            'appointment_ids.*' => 'exists:appointments,id',
            'assigned_to' => 'required_if:action,assign|nullable|exists:admin_users,id',
        ]);

        $appointments = Appointment::whereIn('id', $validated['appointment_ids']);

        switch ($validated['action']) {
            case 'confirm':
                $appointments->update(['status' => 'confirmed', 'confirmed_at' => now()]);
                $message = 'Appointments confirmed successfully.';
                break;
            case 'complete':
                $appointments->update(['status' => 'completed', 'completed_at' => now()]);
                $message = 'Appointments completed successfully.';
                break;
            case 'cancel':
                $appointments->update(['status' => 'cancelled']);
                $message = 'Appointments cancelled successfully.';
                break;
            case 'delete':
                $appointments->delete();
                $message = 'Appointments deleted successfully.';
                break;
            case 'assign':
                $appointments->update(['assigned_to' => $validated['assigned_to']]);
                $message = 'Appointments assigned successfully.';
                break;
        }

        return redirect()->back()->with('success', $message);
    }

    public function export(Request $request)
    {
        $query = Appointment::with('assignedAdmin');

        // Apply same filters as index
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('service_type')) {
            $query->where('service_type', $request->service_type);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('selected_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('selected_date', '<=', $request->date_to);
        }

        $appointments = $query->latest()->get();

        $filename = 'appointments_' . now()->format('Y-m-d_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($appointments) {
            $file = fopen('php://output', 'w');
            
            // Headers
            fputcsv($file, [
                'ID',
                'Date',
                'Customer Name',
                'Email',
                'Phone',
                'Service Type',
                'Status',
                'Quote Amount',
                'Sale Amount',
                'Assigned To',
                'Admin Notes',
                'Created At',
            ]);

            // Data rows
            foreach ($appointments as $appointment) {
                fputcsv($file, [
                    $appointment->id,
                    $appointment->selected_date->format('Y-m-d'),
                    $appointment->name,
                    $appointment->email,
                    $appointment->phone,
                    $appointment->service_type,
                    $appointment->status,
                    $appointment->quote_amount,
                    $appointment->sale_amount,
                    $appointment->assignedAdmin?->name,
                    $appointment->admin_notes,
                    $appointment->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
