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
    public function index(Request $request)
    {
        try {
            $query = Tower::with(['branch' => function($query) {
                $query->select('id', 'name_ar', 'name_en');
            }]);

            // Search
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('name_ar', 'like', "%{$search}%")
                      ->orWhere('name_en', 'like', "%{$search}%");
                });
            }

            // Filter by branch
            if ($request->filled('branch_id')) {
                $query->where('branch_id', $request->branch_id);
            }

            // Filter by status
            if ($request->filled('is_active')) {
                $query->where('is_active', $request->is_active == 'active');
            }

            $towers = $query->select('id', 'name_ar', 'name_en', 'branch_id', 'is_active', 'cost', 'description_ar', 'description_en', 'created_at', 'updated_at')
                          ->latest()
                          ->paginate(10);

            $branches = Branch::select('id', 'name_ar', 'name_en')->get();

            return view('admin.towers.index', [
                'towers' => $towers,
                'branches' => $branches,
                'total_count' => $query->count()
            ]);

        } catch (\Exception $e) {
            \Log::error('Error in TowerController@index: ' . $e->getMessage());
            return view('admin.towers.index', [
                'towers' => collect([]),
                'branches' => Branch::select('id', 'name_ar', 'name_en')->get(),
                'error' => __('towers.messages.error_loading')
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::all();
        return view('admin.towers.create', compact('branches'));
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
            'cost' => 'required|numeric|min:0',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['created_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        Tower::create($validated);

        return redirect()->route('admin.towers.index')
            ->with('success', __('towers.messages.created'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tower $tower)
    {
        $branches = Branch::all();
        return view('admin.towers.edit', compact('tower', 'branches'));
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
            'cost' => 'required|numeric|min:0',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['updated_by'] = auth()->id();

        $tower->update($validated);

        return redirect()->route('admin.towers.index')
            ->with('success', __('towers.messages.updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tower $tower)
    {
        $tower->delete();

        return redirect()->route('admin.towers.index')
            ->with('success', __('towers.messages.deleted'));
    }

    /**
     * Toggle the status of the specified resource.
     */
    public function toggleStatus(Tower $tower)
    {
        $tower->update([
            'is_active' => !$tower->is_active,
            'updated_by' => auth()->id()
        ]);

        return redirect()->route('admin.towers.index')
            ->with('success', __('towers.messages.status_updated'));
    }
}
