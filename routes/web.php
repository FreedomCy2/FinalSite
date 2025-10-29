<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\AdminForgotPasswordController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\SupportController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\UserBookingController;
use App\Http\Controllers\Doctor\DoctorRegisterController;
use App\Http\Controllers\Doctor\AuthController as DoctorAuthController;
use App\Http\Controllers\Doctor\AppointmentController;

// ------------------
// Home Route
// ------------------
Route::get('/', function () {
    return view('welcome');
})->name('home');

// ------------------
// Admin Public Routes
// ------------------
Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin.login');

Route::get('/admin/register', function () {
    return view('admin.register');
})->name('admin.register');

// ------------------
// Admin Pages with Login Check
// ------------------
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', function () {
        if (!Auth::check()) {
            return view('admin.login');
        }
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('booking', function () {
        if (!Auth::check()) {
            return view('admin.login');
        }
        // Call the BookingController so the view receives $bookings
        return app(\App\Http\Controllers\Admin\BookingController::class)->index();
    })->name('booking');

    Route::get('doctors', function () {
        if (!Auth::check()) {
            return view('admin.login');
        }
        // Call the DoctorController so the view receives $doctors
        return app(\App\Http\Controllers\Admin\DoctorController::class)->index();
    })->name('doctors');

    Route::get('manage-users', function () {
        if (!Auth::check()) {
            return view('admin.login');
        }
        // Use the admin UserController so the view receives $users
        return app(\App\Http\Controllers\Admin\UserController::class)->index();
    })->name('manage-users');

    Route::get('reminders', function () {
        if (!Auth::check()) {
            return view('admin.login');
        }
        return view('admin.reminders');
    })->name('reminders');

    Route::get('schedule', function () {
        if (!Auth::check()) {
            return view('admin.login');
        }
        return view('admin.schedule');
    })->name('schedule');

    Route::get('records', function () {
        if (!Auth::check()) {
            return view('admin.login');
        }
        return app(\App\Http\Controllers\Admin\RecordsController::class)->index();
        return view('admin.records');
    })->name('records');

    Route::get('contact-support', function () {
        if (!Auth::check()) {
            return view('admin.login');
        }
        return view('admin.contact-support');
    })->name('support');

    Route::post('support/send', [SupportController::class, 'send'])->name('support.send');
});

// ------------------
// Doctor Pages (unchanged)
// ------------------
Route::get('/doctor/login', function () {
    return view('doctor.login');
})->name('doctor.login');

Route::get('/doctor/register', function () {
    return view('doctor.register');
})->name('doctor.register');

// Doctor authentication (POST login and logout)

Route::post('/doctor/login', [DoctorAuthController::class, 'login'])->name('doctor.login.submit');
Route::post('/doctor/logout', [DoctorAuthController::class, 'logout'])->name('doctor.logout');


Route::prefix('doctor')->name('doctor.')->group(function () {
    Route::get('dashboard', function () {
        if (!Auth::check()) {
            return redirect()->route('doctor.login');
        }
        return view('doctor.dashboard');
    })->name('dashboard');
});

Route::get('/doctor/forgot-password', function () {
    return view('doctor.forgot-password');
})->name('doctor.forgot-password');

Route::get('/doctor/appointments', function () {
    return view('doctor.appointments');
})->name('doctor.appointments');

Route::get('/doctor/availability', function () {
    return view('doctor.availability');
})->name('doctor.availability');

Route::get('/doctor/profile', function () {
    return view('doctor.profile');
})->name('doctor.profile');

Route::get('/doctor/notifications', function () {
    return view('doctor.notifications');
})->name('doctor.notifications');

Route::get('/doctor/appointments', [AppointmentController::class, 'index'])
    ->name('doctor.appointments.index');

Route::patch('/doctor/appointments/{appointment}/update-status', [AppointmentController::class, 'updateStatus'])
    ->name('doctor.appointments.updateStatus');    

Route::get('/doctor/register', [DoctorRegisterController::class, 'showRegisterForm'])->name('doctor.showRegister');
Route::post('/doctor/register', [DoctorRegisterController::class, 'register'])->name('doctor.register');


/// ------------------
// Doctor Forgot-Password
// ------------------

Route::get('doctor/forgot-password', function () {
    return view('doctor.forgot-password');
})->name('password.request');

Route::post('doctor/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->name('password.email');


// ------------------
// User Pages (unchanged)
// ------------------

Route::get('/user/login', function () {
    return view('user.login');
})->name('user.login');

Route::get('/user/register', function () {
    return view('user.register');
})->name('user.register');

Route::get('/user/introduction', function () {
    return view('user.introduction');
})->name('user.introduction');

Route::get('/user/booking', function () {
    return view('user.booking');
})->name('user.booking');

Route::get('/user/service', function () {
    return view('user.service');
})->name('user.service');

Route::get('/information', function () {
    return view('user.information');
})->name('user.information');

Route::get('/information', [UserBookingController::class, 'create'])
    ->name('user.information.form');

Route::post('/information', [UserBookingController::class, 'store'])
    ->name('user.information');

Route::get('/login', function () {
    return view('user.login');
})->name('user.login');



// ------------------
// Admin Authentication Routes
// ------------------
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('admin.register');
    Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('admin.password.request');

    Route::get('/bookings', [\App\Http\Controllers\Admin\BookingController::class, 'index'])->name('admin.bookings.index');
    Route::post('/bookings', [\App\Http\Controllers\Admin\BookingController::class, 'store'])->name('admin.bookings.store');
    Route::delete('/bookings/{id}', [\App\Http\Controllers\Admin\BookingController::class, 'destroy'])->name('admin.bookings.destroy');
    Route::get('/bookings/{id}', [\App\Http\Controllers\Admin\BookingController::class, 'show'])->name('admin.bookings.show');
    Route::put('/bookings/{id}', [\App\Http\Controllers\Admin\BookingController::class, 'update'])->name('admin.bookings.update');
    // Doctors CRUD endpoints (AJAX)
    Route::post('/doctors', [\App\Http\Controllers\Admin\DoctorController::class, 'store'])->name('admin.doctors.store');
    Route::get('/doctors/{id}', [\App\Http\Controllers\Admin\DoctorController::class, 'show'])->name('admin.doctors.show');
    Route::put('/doctors/{id}', [\App\Http\Controllers\Admin\DoctorController::class, 'update'])->name('admin.doctors.update');
    Route::delete('/doctors/{id}', [\App\Http\Controllers\Admin\DoctorController::class, 'destroy'])->name('admin.doctors.destroy');
    // Users CRUD endpoints (AJAX)
    Route::post('/users', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{id}', [\App\Http\Controllers\Admin\UserController::class, 'show'])->name('admin.users.show');
    Route::put('/users/{id}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('admin.users.destroy');
    // Records CRUD endpoints (AJAX)
    Route::get('/records', [\App\Http\Controllers\Admin\RecordsController::class, 'index'])->name('admin.records.index');
    Route::post('/records', [\App\Http\Controllers\Admin\RecordsController::class, 'store'])->name('admin.records.store');
    Route::get('/records/{id}', [\App\Http\Controllers\Admin\RecordsController::class, 'show'])->name('admin.records.show');
    Route::put('/records/{id}', [\App\Http\Controllers\Admin\RecordsController::class, 'update'])->name('admin.records.update');
    Route::delete('/records/{id}', [\App\Http\Controllers\Admin\RecordsController::class, 'destroy'])->name('admin.records.destroy');
});

// ------------------
// Admin Forgot Password
// ------------------
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('forgot-password', [AdminForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('forgot-password', [AdminForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
});

// ------------------
// Admin Logout
// ------------------
Route::post('logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('admin.login');
})->name('logout');

// ------------------
// User Pages (unchanged)
// ------------------
Route::get('/user/login', function () {
    return view('user.login');
})->name('user.login');

Route::get('/user/register', function () {
    return view('user.register');
})->name('user.register');

Route::get('/user/introduction', function () {
    return view('user.introduction');
})->name('user.introduction');

// ------------------
// Custom Registration & Login (unchanged)
// ------------------
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [RegisterController::class, 'showLoginForm'])->name('login');

// NOTE: admin dashboard route is handled in the admin prefix group above.

// ------------------
// Authenticated User Settings (Volt Components)
// ------------------
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route(
        'settings/two-factor',
        'settings.two-factor'
    )->middleware(
        when(
            Features::canManageTwoFactorAuthentication() &&
            Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
            ['password.confirm'],
            [],
        )
    )->name('two-factor.show');
});

// ------------------
// Auth Scaffolding
// ------------------
require __DIR__ . '/auth.php';