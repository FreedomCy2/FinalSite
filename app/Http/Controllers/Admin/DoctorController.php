<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Doctor::orderBy('name')->get();
        return view('admin.doctors', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // modal handled in index view
        return redirect()->route('admin.doctors.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $doctorTable = (new Doctor())->getTable();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique($doctorTable, 'email'),
            ],
            'password' => 'nullable|string|min:6',
        ]);

        // Defensive check in case of race or duplicate attempt
        if (Doctor::where('email', $data['email'])->exists()) {
            return response()->json(['message' => 'A doctor with that email already exists.'], 422);
        }

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        try {
            $doctor = Doctor::create($data);
            return response()->json(['message' => 'Doctor created', 'data' => $doctor], Response::HTTP_CREATED);
        } catch (QueryException $e) {
            // Handle possible duplicate key race condition
            return response()->json(['message' => 'Email already in use'], 409);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $doctor = Doctor::findOrFail($id);
        return response()->json(['data' => $doctor]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // editing handled via AJAX/modal on index page
        return redirect()->route('admin.doctors.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $doctor = Doctor::findOrFail($id);

        $doctorTable = (new Doctor())->getTable();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique($doctorTable, 'email')->ignore($doctor->id),
            ],
            'password' => 'nullable|string|min:6',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $doctor->update($data);

        return response()->json(['message' => 'Doctor updated', 'data' => $doctor]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();
        return response()->json(['message' => 'Doctor deleted']);
    }
}
