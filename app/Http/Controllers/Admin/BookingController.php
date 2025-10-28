<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::orderBy('appointment_date', 'desc')->get();
        // If the request expects JSON (AJAX) return JSON, otherwise render view
        if (request()->wantsJson()) {
            return response()->json(['data' => $bookings], 200);
        }

        return view('admin.booking', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.booking');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_name' => 'required|string|max:255',
            'doctor_name' => 'required|string|max:255',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required', // we'll validate format below
            'status' => 'required|string|in:pending,confirmed,cancelled,completed',
        ]);

        // Combine date and time into a single datetime for appointment_time column
        try {
            $date = Carbon::parse($validated['appointment_date'])->toDateString();
            // appointment_time may be `HH:MM` or `HH:MM:SS` or a full datetime; try to normalize
            $timeInput = $validated['appointment_time'];

            // If time input contains a T or full datetime, parse directly
            if (str_contains($timeInput, 'T') || str_contains($timeInput, '-')) {
                $appointmentTime = Carbon::parse($timeInput);
            } else {
                // combine date and time
                $appointmentTime = Carbon::createFromFormat('Y-m-d H:i', $date.' '.substr($timeInput,0,5));
            }

            // appointment_date column is stored as datetime as well (use start of day)
            $appointmentDate = Carbon::parse($date)->startOfDay();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Invalid date/time format.'], 422);
        }

        $booking = Booking::create([
            'patient_name' => $validated['patient_name'],
            'doctor_name' => $validated['doctor_name'],
            'appointment_date' => $appointmentDate->toDateTimeString(),
            'appointment_time' => $appointmentTime->toDateTimeString(),
            'status' => $validated['status'],
        ]);

        return response()->json(['message' => 'Booking created', 'data' => $booking], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $booking = Booking::find($id);
        if (! $booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        return response()->json(['data' => $booking], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $booking = Booking::find($id);
        if (! $booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        $validated = $request->validate([
            'patient_name' => 'required|string|max:255',
            'doctor_name' => 'required|string|max:255',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'status' => 'required|string|in:pending,confirmed,cancelled,completed',
        ]);

        try {
            $date = Carbon::parse($validated['appointment_date'])->toDateString();
            $timeInput = $validated['appointment_time'];

            if (str_contains($timeInput, 'T') || str_contains($timeInput, '-')) {
                $appointmentTime = Carbon::parse($timeInput);
            } else {
                $appointmentTime = Carbon::createFromFormat('Y-m-d H:i', $date.' '.substr($timeInput,0,5));
            }

            $appointmentDate = Carbon::parse($date)->startOfDay();
        } catch (\Exception $e) {
            return response()->json(['message' => 'Invalid date/time format.'], 422);
        }

        $booking->update([
            'patient_name' => $validated['patient_name'],
            'doctor_name' => $validated['doctor_name'],
            'appointment_date' => $appointmentDate->toDateTimeString(),
            'appointment_time' => $appointmentTime->toDateTimeString(),
            'status' => $validated['status'],
        ]);

        return response()->json(['message' => 'Booking updated', 'data' => $booking], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $booking = Booking::find($id);
        if (! $booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        $booking->delete();
        return response()->json(['message' => 'Booking deleted'], 200);
    }
}
