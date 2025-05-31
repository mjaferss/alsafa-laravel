<?php

namespace App\Http\Controllers\API;

use App\Models\Tower;
use App\Http\Resources\TowerResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TowerController extends BaseApiController
{
    /**
     * الحقول التي يمكن البحث فيها
     */
    protected $searchableFields = [
        'name_ar',
        'name_en'
    ];

    /**
     * الحقول التي يمكن التصفية حسبها
     */
    protected $filterableFields = [
        'branch_id',
        'is_active'
    ];

    /**
     * عرض قائمة الأبراج
     */
    public function index(Request $request)
    {
        $query = Tower::query();

        // تطبيق البحث والتصفية والترتيب
        $query = $this->applyQueryParameters($request, $query, $this->searchableFields, $this->filterableFields);

        // تحميل العلاقات إذا تم طلبها
        if ($request->with_relations) {
            $query->with(['branch', 'maintenanceRequests']);
        }

        // تطبيق الصفحات
        $towers = $this->applyPagination($request, $query);

        // تنسيق الاستجابة
        return $this->formatPaginatedResponse($towers, TowerResource::class);
    }

    /**
     * حفظ برج جديد
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // التحقق من البيانات
        $validator = Validator::make($request->all(), [
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'branch_id' => 'required|exists:branches,id',
            'cost' => 'required|numeric|min:0',
            'is_active' => 'boolean'
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        // إنشاء البرج
        $tower = Tower::create($validator->validated());

        return $this->successResponse(
            new TowerResource($tower),
            'تم إنشاء البرج بنجاح',
            201
        );
    }

    /**
     * عرض برج محدد
     */
    public function show(Request $request, string $id)
    {
        $tower = Tower::query()
            ->when($request->with_relations, fn($q) => $q->with(['branch', 'maintenanceRequests']))
            ->findOrFail($id);

        return $this->successResponse(new TowerResource($tower));
    }

    /**
     * تحديث برج محدد
     */
    public function update(Request $request, string $id)
    {
        $tower = Tower::findOrFail($id);

        // التحقق من البيانات
        $validator = Validator::make($request->all(), [
            'name_ar' => 'sometimes|required|string|max:255',
            'name_en' => 'sometimes|required|string|max:255',
            'branch_id' => 'sometimes|required|exists:branches,id',
            'cost' => 'sometimes|required|numeric|min:0',
            'is_active' => 'boolean'
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        // تحديث البرج
        $tower->update($validator->validated());

        return $this->successResponse(
            new TowerResource($tower),
            'تم تحديث البرج بنجاح'
        );
    }

    /**
     * حذف برج محدد
     */
    public function destroy(string $id)
    {
        $tower = Tower::findOrFail($id);
        $tower->delete();

        return $this->successResponse(
            null,
            'تم حذف البرج بنجاح'
        );
    }
}
