<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MainSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    /**
     * عرض قائمة الأقسام
     */
    public function index()
    {
        $sections = MainSection::query()
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

        return view('admin.sections.index', compact('sections'));
    }

    /**
     * عرض نموذج إنشاء قسم جديد
     */
    public function create()
    {
        return view('admin.sections.create');
    }

    /**
     * حفظ قسم جديد
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'cost' => 'required|numeric|min:0',
            'is_active' => 'required|boolean',
        ]);

        $validated['created_by'] = Auth::id();

        MainSection::create($validated);

        return redirect()
            ->route('admin.sections.index')
            ->with('success', __('sections.messages.created'));
    }

    /**
     * عرض تفاصيل القسم
     */
    public function show(MainSection $section)
    {
        return view('admin.sections.show', compact('section'));
    }

    /**
     * عرض نموذج تعديل القسم
     */
    public function edit(MainSection $section)
    {
        return view('admin.sections.edit', compact('section'));
    }

    /**
     * تحديث بيانات القسم
     */
    public function update(Request $request, MainSection $section)
    {
        $validated = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'cost' => 'required|numeric|min:0',
            'is_active' => 'required|boolean',
        ]);

        $validated['updated_by'] = Auth::id();

        $section->update($validated);

        return redirect()
            ->route('admin.sections.index')
            ->with('success', __('sections.messages.updated'));
    }

    /**
     * حذف القسم
     */
    public function destroy(MainSection $section)
    {
        $section->delete();

        return redirect()
            ->route('admin.sections.index')
            ->with('success', __('sections.messages.deleted'));
    }

    /**
     * تغيير حالة القسم
     */
    public function toggleStatus(MainSection $section)
    {
        $section->update([
            'is_active' => !$section->is_active,
            'updated_by' => Auth::id()
        ]);

        return redirect()
            ->route('admin.sections.index')
            ->with('success', __('sections.messages.status_updated'));
    }
} 