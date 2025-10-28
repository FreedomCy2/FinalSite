<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class DoctorForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('doctor.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        // adjust 'users' => 'doctors' if your doctor emails are in a different table
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        return back()->withErrors(['email' => __($status)]);
    }
}