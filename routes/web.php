<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\SupportController;

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
// Admin Pages
// ------------------
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/admin/booking', function () {
    return view('admin.booking');
});

Route::get('/admin/doctors', function () {
    return view('admin.doctors');
});

Route::get('/admin/manage-users', function () {
    return view('admin.manage-users');
});

Route::get('/admin/reminders', function () {
    return view('admin.reminders');
});

Route::get('/admin/schedule', function () {
    return view('admin.schedule');
});

Route::get('/admin/records', function () {
    return view('admin.records');
});

// ------------------
// User Pages
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
// Custom Registration & Login
// ------------------
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [RegisterController::class, 'showLoginForm'])->name('login');

// ------------------
// Dashboard Views
// ------------------
Route::view('/admin/dashboard', 'admin.dashboard')->name('admin.dashboard');

Route::view('/dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// ------------------
// Authenticated User Settings (Volt Components)
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
// Authenticated Admin Routes (Including Support)
// ------------------
Route::middleware(['web', 'auth'])->group(function () {
    // Contact Support Page
    Route::get('/admin/contact-support', function () {
        return view('admin.contact-support');
    })->name('admin.support');

    // Handle Support Form Submission
    Route::post('/admin/support/send', [SupportController::class, 'send'])->name('admin.support.send');
});

// ------------------
// Admin Authentication Routes
// ------------------
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('admin.dashboard');

    // Optional routes
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('admin.register');
    Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('admin.password.request');
});

// ------------------
// Auth Scaffolding
// ------------------
require __DIR__ . '/auth.php';
