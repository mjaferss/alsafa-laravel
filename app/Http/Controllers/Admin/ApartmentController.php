<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\ApartmentType;
use App\Models\Tower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApartmentController extends Controller
{
    /**
     * عرض قائمة الشقق
     */
    public function index()
    {
        $apartments = Apartment::query()
            ->with(['tower', 'type'])
            ->when(request('search'), function ($query) {
                $search = request('search');
                $query->where('name', 'like', "%{$search}%");
            })
            ->when(request('tower_id'), function ($query) {
                $query->where('tower_id', request('tower_id'));
            })
            ->when(request('apartment_type_id'), function ($query) {
                $query->where('apartment_type_id', request('apartment_type_id'));
            })
            ->latest()
            ->paginate(10);

        $towers = Tower::where('is_active', true)->get();
        $types = ApartmentType::where('is_active', true)->get();

        return view('admin.apartments.index', compact('apartments', 'towers', 'types'));
    }

    /**
     * عرض نموذج إنشاء شقة جديدة
     */
    public function create()
    {
        $towers = Tower::where('is_active', true)->get();
        $types = ApartmentType::where('is_active', true)->get();

        return view('admin.apartments.create', compact('towers', 'types'));
    }

    /**
     * حفظ شقة جديدة
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tower_id' => 'required|exists:towers,id',
            'apartment_type_id' => 'required|exists:apartment_types,id',
            'name' => 'required|string|max:255',
            'floor_number' => 'required|integer',
            'cost' => 'required|numeric|min:0',
        ]);

        $validated['created_by'] = Auth::id();

        Apartment::create($validated);

        return redirect()
            ->route('admin.apartments.index')
            ->with('success', __('apartments.messages.created'));
    }

    /**
     * عرض تفاصيل الشقة
     */
    public function show(Apartment $apartment)
    {
        $apartment->load(['tower', 'type', 'creator', 'updater']);
        
        return view('admin.apartments.show', compact('apartment'));
    }

    /**
     * عرض نموذج تعديل الشقة
     */
    public function edit(Apartment $apartment)
    {
        $towers = Tower::where('is_active', true)->get();
        $types = ApartmentType::where('is_active', true)->get();

        return view('admin.apartments.edit', compact('apartment', 'towers', 'types'));
    }

    /**
     * تحديث بيانات الشقة
     */
    public function update(Request $request, Apartment $apartment)
    {
        $validated = $request->validate([
            'tower_id' => 'required|exists:towers,id',
            'apartment_type_id' => 'required|exists:apartment_types,id',
            'name' => 'required|string|max:255',
            'floor_number' => 'required|integer',
            'cost' => 'required|numeric|min:0',
        ]);

        $validated['updated_by'] = Auth::id();

        // إذا تم تغيير التكلفة، نضيف رسالة تحذير
        if ($apartment->cost != $validated['cost']) {
            session()->flash('warning', __('apartments.messages.cost_changed'));
        }

        $apartment->update($validated);

        return redirect()
            ->route('admin.apartments.index')
            ->with('success', __('apartments.messages.updated'));
    }

    /**
     * حذف الشقة
     */
    public function destroy(Apartment $apartment)
    {
        $apartment->delete();

        return redirect()
            ->route('admin.apartments.index')
            ->with('success', __('apartments.messages.deleted'));
    }
}
