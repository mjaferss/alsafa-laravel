<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Branch;
use App\Models\Tower;
use App\Models\Activity;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the dashboard view.
     */
    public function index(): View
    {
        $statistics = [
            'users' => User::count(),
            'branches' => Branch::count(),
            'towers' => Tower::count(),
            'activities' => Activity::count(),
        ];

        $recentActivities = Activity::with('user')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard.index', compact('statistics', 'recentActivities'));
    }
}
