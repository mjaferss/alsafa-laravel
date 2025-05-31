<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\BranchController;
use App\Http\Controllers\API\TowerController;
use App\Http\Controllers\API\MainSectionController;
use App\Http\Controllers\API\MaintenanceDescriptionController;
use App\Http\Controllers\API\MaintenanceRequestController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Authentication Routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

Route::middleware('auth:sanctum')->group(function () {
    // Authentication
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/change-password', [AuthController::class, 'changePassword']);
    
    // User Profile
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::put('/profile', [AuthController::class, 'updateProfile']);
    
    // Users Management
    Route::apiResource('users', UserController::class);
    Route::post('/users/{id}/activate', [UserController::class, 'activate']);
    Route::post('/users/{id}/deactivate', [UserController::class, 'deactivate']);
    Route::post('/users/{id}/change-role', [UserController::class, 'changeRole']);
    
    // User Info
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Branches
    Route::apiResource('branches', BranchController::class);

    // Towers
    Route::apiResource('towers', TowerController::class);

    // Main Sections
    Route::apiResource('main-sections', MainSectionController::class);

    // Maintenance Descriptions
    Route::apiResource('maintenance-descriptions', MaintenanceDescriptionController::class);

    // Maintenance Requests
    Route::apiResource('maintenance-requests', MaintenanceRequestController::class);

    // Towers
    Route::apiResource('towers', TowerController::class);

    // Main Sections
    Route::apiResource('main-sections', MainSectionController::class);

    // Maintenance Descriptions
    Route::apiResource('maintenance-descriptions', MaintenanceDescriptionController::class);

    // Maintenance Requests
    Route::apiResource('maintenance-requests', MaintenanceRequestController::class);
    Route::post('maintenance-requests/{id}/supervisor-approval', [MaintenanceRequestController::class, 'supervisorApproval']);
    Route::post('maintenance-requests/{id}/manager-approval', [MaintenanceRequestController::class, 'managerApproval']);
});
