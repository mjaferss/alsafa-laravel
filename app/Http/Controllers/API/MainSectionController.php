<?php

namespace App\Http\Controllers\API;

use App\Models\MainSection;
use App\Http\Resources\MainSectionResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MainSectionController extends BaseApiController
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
        'is_active'
    ];

    /**
     * عرض قائمة الأقسام الرئيسية
     */
    public function index(Request $request)
    {
        $query = MainSection::query();

        // تطبيق البحث والتصفية والترتيب
        $query = $this->applyQueryParameters($request, $query, $this->searchableFields, $this->filterableFields);

        // تحميل العلاقات إذا تم طلبها
        if ($request->with_relations) {
            $query->with(['maintenanceRequests']);
        }

        // تطبيق الصفحات
        $sections = $this->applyPagination($request, $query);

        // تنسيق الاستجابة
        return $this->formatPaginatedResponse($sections, MainSectionResource::class);
    }

    /**
     * حفظ قسم رئيسي جديد
     */
    public function store(Request $request)
    {
        // التحقق من البيانات
        $validator = Validator::make($request->all(), [
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'cost' => 'required|numeric|min:0',
            'is_active' => 'boolean'
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        // إنشاء القسم
        $section = MainSection::create($validator->validated());

        return $this->successResponse(
            new MainSectionResource($section),
            'تم إنشاء القسم الرئيسي بنجاح',
            201
        );
    }

    /**
     * عرض قسم رئيسي محدد
     */
    public function show(Request $request, string $id)
    {
        $section = MainSection::query()
            ->when($request->with_relations, fn($q) => $q->with(['maintenanceRequests']))
            ->findOrFail($id);

        return $this->successResponse(new MainSectionResource($section));
    }

    /**
     * تحديث قسم رئيسي محدد
     */
    public function update(Request $request, string $id)
    {
        $section = MainSection::findOrFail($id);

        // التحقق من البيانات
        $validator = Validator::make($request->all(), [
            'name_ar' => 'sometimes|required|string|max:255',
            'name_en' => 'sometimes|required|string|max:255',
            'cost' => 'sometimes|required|numeric|min:0',
            'is_active' => 'boolean'
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        // تحديث القسم
        $section->update($validator->validated());

        return $this->successResponse(
            new MainSectionResource($section),
            'تم تحديث القسم الرئيسي بنجاح'
        );
    }

    /**
     * حذف قسم رئيسي محدد
     */
    public function destroy(string $id)
    {
        $section = MainSection::findOrFail($id);
        $section->delete();

        return $this->successResponse(
            null,
            'تم حذف القسم الرئيسي بنجاح'
        );
    }
}
