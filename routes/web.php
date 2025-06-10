<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\ApartmentController;
use App\Http\Controllers\Admin\ApartmentTypeController;
use App\Http\Controllers\Admin\TowerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// الصفحة الرئيسية
Route::get('/', function () {
    // إذا كان المستخدم مسجل دخوله
    if (Auth::check()) {
        $user = Auth::user();
        
        // التحقق من صلاحيات المستخدم
        if ($user->hasRole(['super_admin', 'manager'])) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('dashboard');
        }
    }
    
    // إذا لم يكن مسجل دخوله، عرض الصفحة الرئيسية
    return view('welcome');
})->name('home');

// لوحة التحكم العامة
Route::get('/dashboard', function () {
    $user = Auth::user();
    
    // التوجيه حسب صلاحيات المستخدم
    if ($user && $user->hasRole(['super_admin', 'manager'])) {
        return redirect()->route('admin.dashboard');
    }
    
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth', 'role:super_admin,manager'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Users routes
    Route::resource('users', UserController::class);
    Route::post('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
    
    // Branches routes
    Route::resource('branches', BranchController::class);
    Route::post('branches/{branch}/toggle-status', [BranchController::class, 'toggleStatus'])->name('branches.toggle-status');
    
    // Sections routes
    Route::resource('sections', SectionController::class);
    Route::post('sections/{section}/toggle-status', [SectionController::class, 'toggleStatus'])->name('sections.toggle-status');
    
    // Apartment Types routes
    Route::resource('apartment-types', ApartmentTypeController::class);
    Route::post('apartment-types/{apartmentType}/toggle-status', [ApartmentTypeController::class, 'toggleStatus'])->name('apartment-types.toggle-status');
    
    // Apartments routes
    Route::resource('apartments', ApartmentController::class);
    
    // Maintenance requests routes
    Route::resource('maintenance-requests', 'App\Http\Controllers\MaintenanceRequestController');
    
    // Activities routes
    Route::get('/activities', 'App\Http\Controllers\ActivityController@index')->name('activities.index');

    // Towers routes
    Route::prefix('towers')->name('towers.')->group(function () {
        Route::get('/', [TowerController::class, 'index'])->name('index');
        Route::get('/create', [TowerController::class, 'create'])->name('create');
        Route::post('/', [TowerController::class, 'store'])->name('store');
        Route::get('/{tower}/edit', [TowerController::class, 'edit'])->name('edit');
        Route::put('/{tower}', [TowerController::class, 'update'])->name('update');
        Route::delete('/{tower}', [TowerController::class, 'destroy'])->name('destroy');
        Route::post('/{tower}/toggle-status', [TowerController::class, 'toggleStatus'])->name('toggle-status');
        
        // Add apartment from tower routes
        Route::get('/{tower}/create-apartment', [TowerController::class, 'createApartment'])->name('create-apartment');
        Route::post('/{tower}/store-apartment', [TowerController::class, 'storeApartment'])->name('store-apartment');
    });
});

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Language Switcher
Route::get('/language/{locale}', [LanguageController::class, 'switchLanguage'])
    ->middleware('web')
    ->name('change.language');

require __DIR__.'/auth.php';
