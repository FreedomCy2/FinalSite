<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DoctorProfile;
use Illuminate\Http\Response;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = DoctorProfile::orderBy('doctor_name')->get();
        return view('admin.doctors', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view with empty form/modal; list view handles modal so redirect to index
        return redirect()->route('admin.doctors.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'doctor_name' => 'required|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'doctor_email' => 'required|email|max:255|unique:doctors,doctor_email',
            'doctor_phone' => 'nullable|string|max:50|unique:doctors,doctor_phone',
            'doctor_status' => 'required|string|max:50',
        ]);

        $doctor = DoctorProfile::create($data);

        return response()->json(['message' => 'Doctor created', 'data' => $doctor], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $doctor = DoctorProfile::findOrFail($id);
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
        $doctor = DoctorProfile::findOrFail($id);
        $data = $request->validate([
            'doctor_name' => 'required|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'doctor_email' => ['required','email','max:255', \Illuminate\Validation\Rule::unique('doctors','doctor_email')->ignore($doctor->id)],
            'doctor_phone' => ['nullable','string','max:50', \Illuminate\Validation\Rule::unique('doctors','doctor_phone')->ignore($doctor->id)],
            'doctor_status' => 'required|string|max:50',
        ]);

        $doctor->update($data);
        return response()->json(['message' => 'Doctor updated', 'data' => $doctor]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $doctor = DoctorProfile::findOrFail($id);
        $doctor->delete();
        return response()->json(['message' => 'Doctor deleted']);
    }
}
