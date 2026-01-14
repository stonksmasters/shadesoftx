<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function store(Request $request)
    {
        // Validate form input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|regex:/^[\d\-\+\(\)\s]+$/',
            'email' => 'required|email',
            'service_type' => 'required|string',
            'selected_date' => 'required|date',
        ]);

        // Save the appointment to the database
        Appointment::create($validated);

        // Redirect with a success message
        return redirect()->back()->with('success', 'Appointment booked successfully!');
    }

    public function contact(Request $request)
    {
        // Validate form input
        $validated = $request->validate([
            'name' => 'required|string|max: 255',
            'email' => 'required|email',
            'phone' => 'required|string|regex:/^[\d\-\+\(\)\s]+$/',
            'message' => 'required|string|max: 1000',
        ]);

        // Save the contact message to the database
        ContactMessage::create($validated);

        // Redirect with a success message
        return redirect()->back()->with('success', 'Message sent successfully!');
    }
}