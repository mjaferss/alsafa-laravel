<?php

namespace App\Http\Controllers\API;

use App\Models\Branch;
use App\Http\Resources\BranchResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BranchController extends BaseApiController
{
    /**
     * الحقول التي يمكن البحث فيها
     */
    protected $searchableFields = [
        'name_ar',
        'name_en',
        'address_ar',
        'address_en',
        'phone'
    ];

    /**
     * الحقول التي يمكن التصفية حسبها
     */
    protected $filterableFields = [
        'is_active'
    ];

    /**
     * عرض قائمة الفروع
     */
    public function index(Request $request)
    {
        $query = Branch::query();

        // تطبيق البحث والتصفية والترتيب
        $query = $this->applyQueryParameters($request, $query, $this->searchableFields, $this->filterableFields);

        // تحميل العلاقات إذا تم طلبها
        if ($request->with_relations) {
            $query->with(['users', 'towers']);
        }

        // تطبيق الصفحات
        $branches = $this->applyPagination($request, $query);

        // تنسيق الاستجابة
        return $this->formatPaginatedResponse($branches, BranchResource::class);
    }

    /**
     * حفظ فرع جديد
     */
    public function store(Request $request)
    {
        // التحقق من البيانات
        $validator = Validator::make($request->all(), [
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'address_ar' => 'required|string|max:255',
            'address_en' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'is_active' => 'boolean'
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        // إنشاء الفرع
        $branch = Branch::create($validator->validated());

        return $this->successResponse(
            new BranchResource($branch),
            'تم إنشاء الفرع بنجاح',
            201
        );
    }

    /**
     * عرض فرع محدد
     */
    public function show(Request $request, string $id)
    {
        $branch = Branch::query()
            ->when($request->with_relations, fn($q) => $q->with(['users', 'towers']))
            ->findOrFail($id);

        return $this->successResponse(new BranchResource($branch));
    }

    /**
     * تحديث فرع محدد
     */
    public function update(Request $request, string $id)
    {
        $branch = Branch::findOrFail($id);

        // التحقق من البيانات
        $validator = Validator::make($request->all(), [
            'name_ar' => 'sometimes|required|string|max:255',
            'name_en' => 'sometimes|required|string|max:255',
            'address_ar' => 'sometimes|required|string|max:255',
            'address_en' => 'sometimes|required|string|max:255',
            'phone' => 'sometimes|required|string|max:20',
            'is_active' => 'boolean'
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        // تحديث الفرع
        $branch->update($validator->validated());

        return $this->successResponse(
            new BranchResource($branch),
            'تم تحديث الفرع بنجاح'
        );
    }

    /**
     * حذف فرع محدد
     */
    public function destroy(string $id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();

        return $this->successResponse(
            null,
            'تم حذف الفرع بنجاح'
        );
    }
}
