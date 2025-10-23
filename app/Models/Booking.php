<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserBooking;

class UserBookingController extends Controller
{
    // Show the booking form
    public function create()
    {
        return view('user.information'); // your Blade file
    }

    // Handle form submission
    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'service' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'age' => 'required|integer|min:0|max:120',
            'gender' => 'required|string',
            'symptom' => 'nullable|string',
        ]);

        // Store in database
        UserBooking::create($validated);

        // Redirect somewhere after submission
        return redirect()->route('user.login')->with('success', 'Booking successfully created!');
    }
}
