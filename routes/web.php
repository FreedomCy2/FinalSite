<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\AdminForgotPasswordController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\SupportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('admin.booking');
    })->name('booking');

    Route::get('doctors', function () {
        if (!Auth::check()) {
            return view('admin.login');
        }
        return view('admin.doctors');
    })->name('doctors');

    Route::get('manage-users', function () {
        if (!Auth::check()) {
            return view('admin.login');
        }
        return view('admin.manage-users');
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
// Doctor Pages (unchanged)
// ------------------
Route::get('/doctor/login', function () {
    return view('doctor.login');
})->name('doctor.login');

Route::get('/doctor/register', function () {
    return view('doctor.register');
})->name('doctor.register');

Route::get('/doctor/introduction', function () {
    return view('doctor.introduction');
})->name('doctor.introduction');

// ------------------
// Custom Registration & Login (unchanged)
// ------------------
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [RegisterController::class, 'showLoginForm'])->name('login');

// ------------------
// Dashboard Views (unchanged, extra login check not needed for user dashboard)
// ------------------
Route::view('/dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('admin.dashboard');

// ------------------
// Authenticated User Settings (Volt Components) (unchanged)
// ------------------
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

// ------------------
// Auth Scaffolding
// ------------------
require __DIR__ . '/auth.php';
