<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::latest()->paginate(10);
        return view('sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'icon' => 'required|string|max:50',
            'active' => 'boolean',
        ]);

        Section::create($validated);

        return redirect()->route('sections.index')
            ->with('success', __('sections.messages.created'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        return view('sections.edit', compact('section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Section $section)
    {
        $validated = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'icon' => 'required|string|max:50',
            'active' => 'boolean',
        ]);

        $section->update($validated);

        return redirect()->route('sections.index')
            ->with('success', __('sections.messages.updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        $section->delete();

        return redirect()->route('sections.index')
            ->with('success', __('sections.messages.deleted'));
    }

    /**
     * Toggle the status of the specified resource.
     */
    public function toggleStatus(Section $section)
    {
        $section->update([
            'active' => !$section->active
        ]);

        return redirect()->route('sections.index')
            ->with('success', __('sections.messages.status_updated'));
    }
}
