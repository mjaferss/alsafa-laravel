<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\ApartmentType;
use App\Models\Tower;
use App\Models\Branch;
use Illuminate\Http\Request;

class TowerController extends Controller
{
    /**
     * Display a listing of the towers.
     */
    public function index()
    {
        $towers = Tower::query()
            ->when(request('search'), function ($query) {
                $search = request('search');
                $query->where(function ($q) use ($search) {
                    $q->where('name_ar', 'like', "%{$search}%")
                      ->orWhere('name_en', 'like', "%{$search}%");
                });
            })
            ->when(request('is_active') !== null, function ($query) {
                $query->where('is_active', request('is_active'));
            })
            ->latest()
            ->paginate(10);

        return view('admin.towers.index', compact('towers'));
    }

    /**
     * Show the form for creating a new tower.
     */
    public function create()
    {
        $branches = Branch::where('is_active', true)->get();
        return view('admin.towers.create', compact('branches'));
    }

    /**
     * Store a newly created tower in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'branch_id' => 'required|exists:branches,id',
            'is_active' => 'required|boolean',
        ]);

        $tower = new Tower($validated);
        $tower->created_by = auth()->id();
        $tower->save();

        return redirect()
            ->route('admin.towers.index')
            ->with('success', __('towers.messages.created'));
    }

    /**
     * Show the form for editing the specified tower.
     */
    public function edit(Tower $tower)
    {
        $branches = Branch::where('is_active', true)->get();
        return view('admin.towers.edit', compact('tower', 'branches'));
    }

    /**
     * Update the specified tower in storage.
     */
    public function update(Request $request, Tower $tower)
    {
        $validated = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'branch_id' => 'required|exists:branches,id',
            'is_active' => 'required|boolean',
        ]);

        $tower->fill($validated);
        $tower->updated_by = auth()->id();
        $tower->save();

        return redirect()
            ->route('admin.towers.index')
            ->with('success', __('towers.messages.updated'));
    }

    /**
     * Remove the specified tower from storage.
     */
    public function destroy(Tower $tower)
    {
        $tower->delete();

        return redirect()
            ->route('admin.towers.index')
            ->with('success', __('towers.messages.deleted'));
    }

    /**
     * Toggle the status of the specified tower.
     */
    public function toggleStatus(Tower $tower)
    {
        $tower->is_active = !$tower->is_active;
        $tower->save();

        return redirect()
            ->route('admin.towers.index')
            ->with('success', __('towers.messages.status_updated'));
    }

    /**
     * Show the form for creating a new apartment in the tower.
     */
    public function createApartment(Tower $tower)
    {
        $types = ApartmentType::where('is_active', true)->get();
        return view('admin.towers.create-apartment', compact('tower', 'types'));
    }

    /**
     * Store a newly created apartment in the tower.
     */
    public function storeApartment(Request $request, Tower $tower)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'apartment_type_id' => 'required|exists:apartment_types,id',
            'floor_number' => 'required|integer|min:1',
            'cost' => 'required|numeric|min:0',
        ]);

        $apartment = new Apartment($validated);
        $apartment->tower_id = $tower->id;
        $apartment->created_by = auth()->id();
        $apartment->save();

        return redirect()
            ->route('admin.towers.index')
            ->with('success', __('apartments.messages.created'));
    }
} 