<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function index()
    {
        // If you only want appointments for the logged-in doctor
        $bookings = Appointment::all();

        // Pass $bookings to the view
        return view('doctor.appointments', compact('bookings'));
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'status' => 'required|in:accepted,declined',
        ]);

        $appointment->update(['status' => $validated['status']]);

        return back()->with('status', 'Appointment ' . $validated['status'] . ' successfully.');
    }
}
