<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class MaintenanceRequestController extends Controller
{
    /**
     * Display a listing of the maintenance requests.
     */
    public function index(): View
    {
        $maintenanceRequests = MaintenanceRequest::with(['user', 'tower'])
            ->latest()
            ->paginate(15);

        return view('maintenance-requests.index', compact('maintenanceRequests'));
    }

    /**
     * Show the form for creating a new maintenance request.
     */
    public function create(): View
    {
        return view('maintenance-requests.create');
    }

    /**
     * Store a newly created maintenance request in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'tower_id' => 'required|exists:towers,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high',
        ]);

        $request->user()->maintenanceRequests()->create($validated);

        return redirect()->route('maintenance-requests.index')
            ->with('success', __('maintenance.created_successfully'));
    }

    /**
     * Display the specified maintenance request.
     */
    public function show(MaintenanceRequest $maintenanceRequest): View
    {
        return view('maintenance-requests.show', compact('maintenanceRequest'));
    }

    /**
     * Show the form for editing the specified maintenance request.
     */
    public function edit(MaintenanceRequest $maintenanceRequest): View
    {
        return view('maintenance-requests.edit', compact('maintenanceRequest'));
    }

    /**
     * Update the specified maintenance request in storage.
     */
    public function update(Request $request, MaintenanceRequest $maintenanceRequest): RedirectResponse
    {
        $validated = $request->validate([
            'tower_id' => 'required|exists:towers,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:pending,in_progress,completed,cancelled',
        ]);

        $maintenanceRequest->update($validated);

        return redirect()->route('maintenance-requests.index')
            ->with('success', __('maintenance.updated_successfully'));
    }

    /**
     * Remove the specified maintenance request from storage.
     */
    public function destroy(MaintenanceRequest $maintenanceRequest): RedirectResponse
    {
        $maintenanceRequest->delete();

        return redirect()->route('maintenance-requests.index')
            ->with('success', __('maintenance.deleted_successfully'));
    }
}
