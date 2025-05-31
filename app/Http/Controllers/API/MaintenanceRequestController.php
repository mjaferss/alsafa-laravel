<?php

namespace App\Http\Controllers\API;

use App\Models\MaintenanceRequest;
use App\Models\MaintenanceDescription;
use App\Models\Tower;
use App\Models\MainSection;
use App\Http\Resources\MaintenanceRequestResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MaintenanceRequestController extends BaseApiController
{
    /**
     * الحقول التي يمكن البحث فيها
     */
    protected $searchableFields = [
        'title',
        'description'
    ];

    /**
     * الحقول التي يمكن التصفية حسبها
     */
    protected $filterableFields = [
        'status',
        'branch_id',
        'tower_id',
        'main_section_id',
        'user_id',
        'supervisor_id',
        'manager_id',
        'supervisor_approval',
        'manager_approval'
    ];

    /**
     * عرض قائمة طلبات الصيانة
     */
    public function index(Request $request)
    {
        $query = MaintenanceRequest::query();

        // تطبيق البحث والتصفية والترتيب
        $query = $this->applyQueryParameters($request, $query, $this->searchableFields, $this->filterableFields);

        // تحميل العلاقات إذا تم طلبها
        if ($request->with_relations) {
            $query->with([
                'branch',
                'tower',
                'mainSection',
                'user',
                'assignedTo',
                'maintenanceRequestItems.maintenanceDescription'
            ]);
        }

        // تطبيق الصفحات
        $requests = $this->applyPagination($request, $query);

        // تنسيق الاستجابة
        return $this->formatPaginatedResponse($requests, MaintenanceRequestResource::class);
    }

    /**
     * حفظ طلب صيانة جديد
     */
    public function store(Request $request)
    {
        // التحقق من البيانات
        $validator = Validator::make($request->all(), [
            'branch_id' => 'required|exists:branches,id',
            'tower_id' => ['required', 'exists:towers,id', function ($attribute, $value, $fail) use ($request) {
                $tower = Tower::find($value);
                if ($tower && $tower->branch_id != $request->branch_id) {
                    $fail('البرج لا ينتمي للفرع المحدد');
                }
            }],
            'main_section_id' => 'required|exists:main_sections,id',
            'notes' => 'nullable|string|max:500',
            'items' => 'required|array|min:1',
            'items.*.maintenance_description_id' => ['required', 'exists:maintenance_descriptions,id', function ($attribute, $value, $fail) use ($request) {
                $description = MaintenanceDescription::find($value);
                if ($description && $description->main_section_id != $request->main_section_id) {
                    $fail('وصف الصيانة لا ينتمي للقسم المحدد');
                }
            }],
            'items.*.quantity' => 'required|numeric|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'items.*.has_tax' => 'required|boolean',
            'items.*.note' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        try {
            DB::beginTransaction();

            // حساب المبالغ
            $subtotal = 0;
            $tax = 0;
            $items = [];
            
            foreach ($request->items as $item) {
                $description = MaintenanceDescription::findOrFail($item['maintenance_description_id']);
                $itemSubtotal = $item['unit_price'] * $item['quantity'];
                $subtotal += $itemSubtotal;
                
                if ($item['has_tax']) {
                    $itemTax = $itemSubtotal * 0.15; // 15% ضريبة القيمة المضافة
                    $tax += $itemTax;
                } else {
                    $itemTax = 0;
                }
                
                $items[] = [
                    'maintenance_description_id' => $item['maintenance_description_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'has_tax' => $item['has_tax'],
                    'tax_amount' => $itemTax,
                    'subtotal' => $itemSubtotal,
                    'total' => $itemSubtotal + $itemTax,
                    'note' => $item['note'] ?? null
                ];
            }

            // حساب الإجمالي
            $total = $subtotal + $tax;

            // إنشاء الطلب
            $maintenanceRequest = MaintenanceRequest::create([
                'user_id' => Auth::id(),
                'branch_id' => $request->branch_id,
                'tower_id' => $request->tower_id,
                'main_section_id' => $request->main_section_id,
                'notes' => $request->notes,
                'status' => 'pending',
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total' => $total,
                'is_active' => true
            ]);

            // إنشاء عناصر الطلب
            $maintenanceRequest->maintenanceRequestItems()->createMany($items);

            // تحديث تكلفة البرج
            $tower = Tower::findOrFail($request->tower_id);
            $tower->increment('cost', $total);

            // تحديث تكلفة القسم الرئيسي
            $mainSection = MainSection::findOrFail($request->main_section_id);
            $mainSection->increment('cost', $total);

            DB::commit();

            return $this->successResponse(
                new MaintenanceRequestResource($maintenanceRequest),
                'تم إنشاء طلب الصيانة بنجاح',
                201
            );
        } catch (\Exception $e) {
            DB::rollback();
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * عرض طلب صيانة محدد
     */
    public function show(Request $request, string $id)
    {
        $maintenanceRequest = MaintenanceRequest::query()
            ->when($request->with_relations, fn($q) => $q->with([
                'branch',
                'tower',
                'mainSection',
                'user',
                'assignedTo',
                'maintenanceRequestItems.maintenanceDescription'
            ]))
            ->findOrFail($id);

        return $this->successResponse(new MaintenanceRequestResource($maintenanceRequest));
    }

    /**
     * تحديث طلب صيانة محدد
     */
    public function update(Request $request, string $id)
    {
        $maintenanceRequest = MaintenanceRequest::findOrFail($id);

        // التحقق من البيانات
        $validator = Validator::make($request->all(), [
            'branch_id' => 'sometimes|required|exists:branches,id',
            'tower_id' => 'sometimes|required|exists:towers,id',
            'main_section_id' => 'sometimes|required|exists:main_sections,id',
            'notes' => 'nullable|string',
            'supervisor_id' => 'nullable|exists:users,id',
            'supervisor_approval' => 'boolean',
            'supervisor_notes' => 'nullable|string',
            'supervisor_action_at' => 'nullable|date',
            'manager_id' => 'nullable|exists:users,id',
            'manager_approval' => 'boolean',
            'manager_notes' => 'nullable|string',
            'manager_action_at' => 'nullable|date',
            'status' => 'sometimes|required|in:pending,supervisor_approved,supervisor_rejected,manager_approved,manager_rejected',
            'items' => 'sometimes|required|array|min:1',
            'items.*.maintenance_description_id' => 'required_with:items|exists:maintenance_descriptions,id',
            'items.*.quantity' => 'required_with:items|integer|min:1',
            'items.*.note' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        try {
            DB::beginTransaction();

            // حفظ القيم القديمة للطلب
            $oldTotal = $maintenanceRequest->total;
            $oldTowerId = $maintenanceRequest->tower_id;
            $oldMainSectionId = $maintenanceRequest->main_section_id;

            // تحديث الطلب
            $maintenanceRequest->update($validator->validated());

            // تحديث عناصر الطلب إذا تم توفيرها
            if ($request->has('items')) {
                $maintenanceRequest->maintenanceRequestItems()->delete();
                
                // حساب المبالغ الجديدة
                $subtotal = 0;
                foreach ($request->items as $item) {
                    $description = MaintenanceDescription::findOrFail($item['maintenance_description_id']);
                    $subtotal += $description->cost * $item['quantity'];
                }

                // حساب الضريبة والإجمالي
                $tax = $subtotal * 0.15;
                $total = $subtotal + $tax;

                // تحديث المبالغ في الطلب
                $maintenanceRequest->update([
                    'subtotal' => $subtotal,
                    'tax' => $tax,
                    'total' => $total
                ]);

                // إنشاء العناصر الجديدة
                $maintenanceRequest->maintenanceRequestItems()->createMany($request->items);
            }

            // تحديث تكلفة البرج القديم
            if ($oldTowerId) {
                $oldTower = Tower::findOrFail($oldTowerId);
                $oldTower->decrement('cost', $oldTotal);
            }

            // تحديث تكلفة القسم القديم
            if ($oldMainSectionId) {
                $oldMainSection = MainSection::findOrFail($oldMainSectionId);
                $oldMainSection->decrement('cost', $oldTotal);
            }

            // تحديث تكلفة البرج الجديد
            $tower = Tower::findOrFail($maintenanceRequest->tower_id);
            $tower->increment('cost', $maintenanceRequest->total);

            // تحديث تكلفة القسم الجديد
            $mainSection = MainSection::findOrFail($maintenanceRequest->main_section_id);
            $mainSection->increment('cost', $maintenanceRequest->total);

            DB::commit();

            return $this->successResponse(
                new MaintenanceRequestResource($maintenanceRequest),
                'تم تحديث طلب الصيانة بنجاح'
            );

            DB::commit();

            return $this->successResponse(
                new MaintenanceRequestResource($maintenanceRequest),
                'تم تحديث طلب الصيانة بنجاح'
            );
        } catch (\Exception $e) {
            DB::rollback();
            return $this->errorResponse($e->getMessage());
        }

        // تحديث عناصر الطلب إذا تم توفيرها
        if ($request->has('items')) {
            $maintenanceRequest->maintenanceRequestItems()->delete();
            $maintenanceRequest->maintenanceRequestItems()->createMany($request->items);
        }

        return $this->successResponse(
            new MaintenanceRequestResource($maintenanceRequest),
            'تم تحديث طلب الصيانة بنجاح'
        );
    }

    /**
     * حذف طلب صيانة محدد
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();

            $maintenanceRequest = MaintenanceRequest::findOrFail($id);

            // تحديث تكلفة البرج
            $tower = Tower::findOrFail($maintenanceRequest->tower_id);
            $tower->decrement('cost', $maintenanceRequest->total);

            // تحديث تكلفة القسم الرئيسي
            $mainSection = MainSection::findOrFail($maintenanceRequest->main_section_id);
            $mainSection->decrement('cost', $maintenanceRequest->total);

            // حذف الطلب
            $maintenanceRequest->delete();

            DB::commit();

            return $this->successResponse(
                null,
                'تم حذف طلب الصيانة بنجاح'
            );
        } catch (\Exception $e) {
            DB::rollback();
            return $this->errorResponse($e->getMessage());
        }
    }
}
