<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\TowerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Redirect root to login
Route::get('/', function () {
    return redirect('/login');
});

// Redirect old dashboard URL to new admin dashboard
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware('auth');

Route::middleware(['auth', 'role:super_admin,manager'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Users routes
    Route::resource('users', UserController::class);
    Route::post('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
    
    // Branches routes
    Route::resource('branches', BranchController::class);
    Route::post('branches/{branch}/toggle-status', [BranchController::class, 'toggleStatus'])->name('branches.toggle-status');
    
    // Towers routes
    Route::resource('towers', TowerController::class);
    Route::post('towers/{tower}/toggle-status', [TowerController::class, 'toggleStatus'])->name('towers.toggle-status');
    
    // Sections routes
    Route::resource('sections', SectionController::class);
    Route::post('sections/{section}/toggle-status', [SectionController::class, 'toggleStatus'])->name('sections.toggle-status');
    
    // Maintenance requests routes
    Route::resource('maintenance-requests', 'App\Http\Controllers\MaintenanceRequestController');
    
    // Activities routes
    Route::get('/activities', 'App\Http\Controllers\ActivityController@index')->name('activities.index');
});

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Language Switcher
Route::get('/language/{locale}', function ($locale) {
    if (in_array($locale, ['ar', 'en'])) {
        session(['locale' => $locale]);
        app()->setLocale($locale);
    }
    return redirect()->back();
})->middleware('web')->name('change.language');

require __DIR__.'/auth.php';
