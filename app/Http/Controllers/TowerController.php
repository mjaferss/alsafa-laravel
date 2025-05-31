<?php

namespace App\Http\Controllers;

use App\Models\Tower;
use App\Models\Branch;
use Illuminate\Http\Request;

class TowerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $towers = Tower::with('branch')->latest()->paginate(10);
        return view('towers.index', compact('towers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::all();
        return view('towers.create', compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'branch_id' => 'required|exists:branches,id',
            'floors_count' => 'required|integer|min:1',
            'apartments_per_floor' => 'required|integer|min:1',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'status' => 'required|in:active,under_maintenance,inactive',
        ]);

        Tower::create($validated);

        return redirect()->route('towers.index')
            ->with('success', __('towers.messages.created'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tower $tower)
    {
        $branches = Branch::all();
        return view('towers.edit', compact('tower', 'branches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tower $tower)
    {
        $validated = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'branch_id' => 'required|exists:branches,id',
            'floors_count' => 'required|integer|min:1',
            'apartments_per_floor' => 'required|integer|min:1',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'status' => 'required|in:active,under_maintenance,inactive',
        ]);

        $tower->update($validated);

        return redirect()->route('towers.index')
            ->with('success', __('towers.messages.updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tower $tower)
    {
        $tower->delete();

        return redirect()->route('towers.index')
            ->with('success', __('towers.messages.deleted'));
    }

    /**
     * Toggle the status of the specified resource.
     */
    public function toggleStatus(Tower $tower)
    {
        $tower->update([
            'status' => $tower->status === 'active' ? 'inactive' : 'active'
        ]);

        return redirect()->route('towers.index')
            ->with('success', __('towers.messages.status_updated'));
    }
}
