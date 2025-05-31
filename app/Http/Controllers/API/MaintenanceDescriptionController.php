<?php

namespace App\Http\Controllers\API;

use App\Models\MaintenanceDescription;
use App\Http\Resources\MaintenanceDescriptionResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MaintenanceDescriptionController extends BaseApiController
{
    /**
     * الحقول التي يمكن البحث فيها
     */
    protected $searchableFields = [
        'description_ar',
        'description_en'
    ];

    /**
     * الحقول التي يمكن التصفية حسبها
     */
    protected $filterableFields = [
        'is_active'
    ];

    /**
     * عرض قائمة الأوصاف
     */
    public function index(Request $request)
    {
        $query = MaintenanceDescription::query();

        // تطبيق البحث والتصفية والترتيب
        $query = $this->applyQueryParameters($request, $query, $this->searchableFields, $this->filterableFields);

        // تحميل العلاقات إذا تم طلبها
        if ($request->with_relations) {
            $query->with(['maintenanceRequestItems']);
        }

        // تطبيق الصفحات
        $descriptions = $this->applyPagination($request, $query);

        // تنسيق الاستجابة
        return $this->formatPaginatedResponse($descriptions, MaintenanceDescriptionResource::class);
    }

    /**
     * حفظ وصف جديد
     */
    public function store(Request $request)
    {
        // التحقق من البيانات
        $validator = Validator::make($request->all(), [
            'description_ar' => 'required|string|max:255',
            'description_en' => 'required|string|max:255',
            'is_active' => 'boolean'
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        // إنشاء الوصف
        $description = MaintenanceDescription::create($validator->validated());

        return $this->successResponse(
            new MaintenanceDescriptionResource($description),
            'تم إنشاء الوصف بنجاح',
            201
        );
    }

    /**
     * عرض وصف محدد
     */
    public function show(Request $request, string $id)
    {
        $description = MaintenanceDescription::query()
            ->when($request->with_relations, fn($q) => $q->with(['maintenanceRequestItems']))
            ->findOrFail($id);

        return $this->successResponse(new MaintenanceDescriptionResource($description));
    }

    /**
     * تحديث وصف محدد
     */
    public function update(Request $request, string $id)
    {
        $description = MaintenanceDescription::findOrFail($id);

        // التحقق من البيانات
        $validator = Validator::make($request->all(), [
            'description_ar' => 'sometimes|required|string|max:255',
            'description_en' => 'sometimes|required|string|max:255',
            'is_active' => 'boolean'
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        // تحديث الوصف
        $description->update($validator->validated());

        return $this->successResponse(
            new MaintenanceDescriptionResource($description),
            'تم تحديث الوصف بنجاح'
        );
    }

    /**
     * حذف وصف محدد
     */
    public function destroy(string $id)
    {
        $description = MaintenanceDescription::findOrFail($id);
        $description->delete();

        return $this->successResponse(
            null,
            'تم حذف الوصف بنجاح'
        );
    }
}
