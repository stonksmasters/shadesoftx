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

        // Store the appointment data in the database
        // Add your database logic here (example below):
        // Appointment::create($validated);

        // Redirect with a success message
        return redirect()->back()->with('success', 'Appointment booked successfully!');
    }

    public function contact(Request $request)
    {
        // Validate form input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|regex:/^[\d\-\+\(\)\s]+$/',
            'message' => 'required|string|max:1000',
        ]);

        // Process contact form data (e.g., save to DB or send an email)
        // Add your database or email-sending logic here:
        // ContactMessage::create($validated);

        // Redirect with a success message
        return redirect()->back()->with('success', 'Message sent successfully!');
    }
}
