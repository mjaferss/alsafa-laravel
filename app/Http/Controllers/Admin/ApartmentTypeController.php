<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApartmentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApartmentTypeController extends Controller
{
    /**
     * عرض قائمة أنواع الشقق
     */
    public function index()
    {
        $types = ApartmentType::query()
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

        return view('admin.apartment_types.index', compact('types'));
    }

    /**
     * عرض نموذج إنشاء نوع شقة جديد
     */
    public function create()
    {
        return view('admin.apartment_types.create');
    }

    /**
     * حفظ نوع شقة جديد
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        $validated['created_by'] = Auth::id();

        ApartmentType::create($validated);

        return redirect()
            ->route('admin.apartment-types.index')
            ->with('success', __('apartment_types.messages.created'));
    }

    /**
     * عرض تفاصيل نوع الشقة
     */
    public function show(ApartmentType $apartmentType)
    {
        return view('admin.apartment_types.show', compact('apartmentType'));
    }

    /**
     * عرض نموذج تعديل نوع الشقة
     */
    public function edit(ApartmentType $apartmentType)
    {
        return view('admin.apartment_types.edit', compact('apartmentType'));
    }

    /**
     * تحديث بيانات نوع الشقة
     */
    public function update(Request $request, ApartmentType $apartmentType)
    {
        $validated = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        $validated['updated_by'] = Auth::id();

        $apartmentType->update($validated);

        return redirect()
            ->route('admin.apartment-types.index')
            ->with('success', __('apartment_types.messages.updated'));
    }

    /**
     * حذف نوع الشقة
     */
    public function destroy(ApartmentType $apartmentType)
    {
        $apartmentType->delete();

        return redirect()
            ->route('admin.apartment-types.index')
            ->with('success', __('apartment_types.messages.deleted'));
    }

    /**
     * تغيير حالة نوع الشقة
     */
    public function toggleStatus(ApartmentType $apartmentType)
    {
        $apartmentType->update([
            'is_active' => !$apartmentType->is_active,
            'updated_by' => Auth::id()
        ]);

        return redirect()
            ->route('admin.apartment-types.index')
            ->with('success', __('apartment_types.messages.status_updated'));
    }
}
