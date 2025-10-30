<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Redirect authenticated users to appropriate dashboard
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->isAdministrator()) {
            return redirect()->route('admin.positions.index');
        }
        return redirect()->route('user.dashboard');
    })->name('dashboard');
});

// User routes
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
	Route::get('/positions', [UserDashboardController::class, 'positions'])->name('positions.index');
	Route::get('/positions/{position}', [UserDashboardController::class, 'details'])->name('positions.details');
	Route::post('/positions/{position}/apply', [ApplicationController::class, 'apply'])->name('positions.apply');
	Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
	Route::get('/messages/{id}/read', [MessageController::class, 'read'])->name('messages.read');
	Route::get('/messages/{id}/unread', [MessageController::class, 'unread'])->name('messages.unread');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminDashboardController::class, 'users'])->name('users.index');
	Route::get('/users/{user}', [AdminDashboardController::class, 'viewUser'])->name('users.show');

	Route::resource('positions', PositionController::class);
	Route::post('/applications/{application}/accept', [ApplicationController::class, 'accept'])->name('applications.accept');
	Route::post('/applications/{application}/reject', [ApplicationController::class, 'reject'])->name('applications.reject');
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
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
