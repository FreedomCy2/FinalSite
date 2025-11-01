<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\UserBooking;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = UserBooking::orderBy('name')->get();
        return view('admin.manage-users', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'service' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|string|max:50',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'age' => 'nullable|integer|min:0',
            'gender' => 'nullable|string|max:20',
            'symptom' => 'nullable|string',
        ]);

        $booking = UserBooking::create($data);
        return response()->json(['message' => 'Booking created', 'data' => $booking], Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $user = UserBooking::findOrFail($id);
        return response()->json(['data' => $user]);
    }

    public function update(Request $request, $id)
    {
        $user = UserBooking::findOrFail($id);

        $data = $request->validate([
            'service' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|string|max:50',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'age' => 'nullable|integer|min:0',
            'gender' => 'nullable|string|max:20',
            'symptom' => 'nullable|string',
        ]);

        $user->update($data);
        return response()->json(['message' => 'Booking updated', 'data' => $user]);
    }

    public function destroy($id)
    {
        $user = UserBooking::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'Booking deleted']);
    }
}
