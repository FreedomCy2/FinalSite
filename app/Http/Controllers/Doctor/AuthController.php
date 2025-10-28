<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Handle login POST for doctors.
     */
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $doctor = Doctor::where('email', $data['email'])->first();

        if (! $doctor || ! Hash::check($data['password'], $doctor->password)) {
            return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
        }

        // log doctor in using the framework auth so Auth::check() works
        Auth::login($doctor);

        // also store an explicit doctor_id in session (kept for compatibility)
        $request->session()->put('doctor_id', $doctor->id);

        return redirect()->route('doctor.dashboard');
    }

    /**
     * Logout doctor.
     */
    public function logout(Request $request)
    {
        // log out via the framework auth and clear session data
        Auth::logout();
        $request->session()->forget('doctor_id');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('doctor.login');
    }
}
