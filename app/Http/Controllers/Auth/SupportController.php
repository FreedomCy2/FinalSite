<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminSupportRequest;

class SupportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // adjust middleware if you use a different guard
    }

    public function send(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        // destination address (fallback to support@clinicflow.com)
        $to = config('mail.support_address', 'support@clinicflow.com');

        Mail::to($to)->send(new AdminSupportRequest($data));

        return redirect()->back()->with('status', 'Your message has been sent. Our support team will contact you shortly.');
    }
}