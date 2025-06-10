<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Branch::query();
        
        // Search
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name_ar', 'like', "%{$request->search}%")
                  ->orWhere('name_en', 'like', "%{$request->search}%")
                  ->orWhere('phone', 'like', "%{$request->search}%");
            });
        }
        
        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('is_active', $request->status);
        }
        
        // Sort
        $sortField = $request->sort_by ?? 'created_at';
        $sortDirection = $request->sort_direction ?? 'desc';
        $query->orderBy($sortField, $sortDirection);
        
        $branches = $query->paginate($request->per_page ?? 10);
        return view('admin.branches.index', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!in_array(auth()->user()->role, ['super_admin', 'manager'])) {
            return redirect()->route('admin.branches.index')
                ->with('error', __('branches.unauthorized_edit'));
        }
        
        return view('admin.branches.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!in_array(auth()->user()->role, ['super_admin', 'manager'])) {
            return redirect()->route('admin.branches.index')
                ->with('error', __('branches.unauthorized_edit'));
        }
        
        $validated = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'address_ar' => 'required|string',
            'address_en' => 'required|string',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ]);
        
        $validated['is_active'] = $request->has('is_active');

        Branch::create($validated);

        return redirect()->route('admin.branches.index')
            ->with('success', __('branches.messages.created'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        if (!in_array(auth()->user()->role, ['super_admin', 'manager'])) {
            return redirect()->route('admin.branches.index')
                ->with('error', __('branches.unauthorized_edit'));
        }
        
        return view('admin.branches.edit', compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $branch)
    {
        if (!in_array(auth()->user()->role, ['super_admin', 'manager'])) {
            return redirect()->route('admin.branches.index')
                ->with('error', __('branches.unauthorized_edit'));
        }
        
        $validated = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'address_ar' => 'required|string',
            'address_en' => 'required|string',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ]);
        
        $validated['is_active'] = $request->has('is_active');

        try {
            $branch->update($validated);
            
            return redirect()->route('admin.branches.index')
                ->with('success', __('branches.messages.updated'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', __('branches.messages.update_failed'))
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        if (!in_array(auth()->user()->role, ['super_admin', 'manager'])) {
            return redirect()->route('admin.branches.index')
                ->with('error', __('branches.unauthorized_edit'));
        }
        
        if ($branch->users()->count() > 0) {
            return redirect()->route('admin.branches.index')
                ->with('error', __('branches.messages.cannot_delete_with_users'));
        }
        
        $branch->delete();

        return redirect()->route('admin.branches.index')
            ->with('success', __('branches.messages.deleted'));
    }

    /**
     * Toggle the status of the specified resource.
     */
    public function toggleStatus(Branch $branch)
    {
        if (!in_array(auth()->user()->role, ['super_admin', 'manager'])) {
            return response()->json([
                'success' => false,
                'message' => __('branches.unauthorized_edit')
            ], 403);
        }
        
        try {
            $branch->update(['is_active' => !$branch->is_active]);
            
            return response()->json([
                'success' => true,
                'message' => __('branches.messages.status_updated'),
                'is_active' => $branch->is_active
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => __('branches.messages.update_failed')
            ], 500);
        }
    }
}
