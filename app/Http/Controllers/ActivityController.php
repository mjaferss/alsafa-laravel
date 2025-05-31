<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ActivityController extends Controller
{
    /**
     * Display a listing of the activities.
     */
    public function index(): View
    {
        $activities = Activity::with('user')
            ->latest()
            ->paginate(15);

        return view('activities.index', compact('activities'));
    }
}
