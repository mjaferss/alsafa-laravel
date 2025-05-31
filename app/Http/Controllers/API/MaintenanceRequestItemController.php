<?php

namespace App\Http\Controllers\API;

use App\Models\MaintenanceRequestItem;
use App\Models\MaintenanceDescription;
use App\Http\Resources\MaintenanceRequestItemResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MaintenanceRequestItemController extends BaseApiController
{
    /**
     * الحقول التي يمكن البحث فيها
     */
    protected $searchableFields = [];

    /**
     * الحقول التي يمكن التصفية حسبها
     */
    protected $filterableFields = [
        'maintenance_request_id',
        'maintenance_description_id',
        'has_tax'
    ];

    /**
     * عرض قائمة عناصر طلبات الصيانة
     */
    public function index(Request $request)
    {
        $query = MaintenanceRequestItem::query();

        // تطبيق البحث والتصفية والترتيب
        $query = $this->applyQueryParameters($request, $query, $this->searchableFields, $this->filterableFields);

        // تحميل العلاقات إذا تم طلبها
        if ($request->with_relations) {
            $query->with(['maintenanceRequest', 'maintenanceDescription']);
        }

        // تطبيق الصفحات
        $items = $this->applyPagination($request, $query);

        // تنسيق الاستجابة
        return $this->formatPaginatedResponse($items, MaintenanceRequestItemResource::class);
    }

    /**
     * حفظ عنصر طلب صيانة جديد
     */
    public function store(Request $request)
    {
        // التحقق من البيانات
        $validator = Validator::make($request->all(), [
            'maintenance_request_id' => 'required|exists:maintenance_requests,id',
            'maintenance_description_id' => 'required|exists:maintenance_descriptions,id',
            'quantity' => 'required|integer|min:1',
            'has_tax' => 'boolean'
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        // جلب سعر الوحدة من الوصف
        $description = MaintenanceDescription::findOrFail($request->maintenance_description_id);
        $unit_price = $description->cost;

        // حساب المبالغ
        $subtotal = $unit_price * $request->quantity;
        $tax_amount = $request->has_tax ? $subtotal * 0.15 : 0; // 15% ضريبة القيمة المضافة
        $total = $subtotal + $tax_amount;

        // إنشاء العنصر
        $item = MaintenanceRequestItem::create(array_merge(
            $validator->validated(),
            [
                'unit_price' => $unit_price,
                'subtotal' => $subtotal,
                'tax_amount' => $tax_amount,
                'total' => $total
            ]
        ));

        return $this->successResponse(
            new MaintenanceRequestItemResource($item),
            'تم إنشاء عنصر طلب الصيانة بنجاح',
            201
        );
    }

    /**
     * عرض عنصر طلب صيانة محدد
     */
    public function show(Request $request, string $id)
    {
        $item = MaintenanceRequestItem::query()
            ->when($request->with_relations, fn($q) => $q->with(['maintenanceRequest', 'maintenanceDescription']))
            ->findOrFail($id);

        return $this->successResponse(new MaintenanceRequestItemResource($item));
    }

    /**
     * تحديث عنصر طلب صيانة محدد
     */
    public function update(Request $request, string $id)
    {
        $item = MaintenanceRequestItem::findOrFail($id);

        // التحقق من البيانات
        $validator = Validator::make($request->all(), [
            'maintenance_request_id' => 'sometimes|required|exists:maintenance_requests,id',
            'maintenance_description_id' => 'sometimes|required|exists:maintenance_descriptions,id',
            'quantity' => 'sometimes|required|integer|min:1',
            'has_tax' => 'boolean'
        ]);

        if ($validator->fails()) {
            return $this->validationErrorResponse($validator->errors());
        }

        // تحديث البيانات الأساسية
        $item->update($validator->validated());

        // إعادة حساب المبالغ إذا تم تغيير الكمية أو الوصف
        if ($request->has('quantity') || $request->has('maintenance_description_id')) {
            $description = MaintenanceDescription::findOrFail($item->maintenance_description_id);
            $unit_price = $description->cost;
            $subtotal = $unit_price * $item->quantity;
            $tax_amount = $item->has_tax ? $subtotal * 0.15 : 0;
            $total = $subtotal + $tax_amount;

            $item->update([
                'unit_price' => $unit_price,
                'subtotal' => $subtotal,
                'tax_amount' => $tax_amount,
                'total' => $total
            ]);
        }

        return $this->successResponse(
            new MaintenanceRequestItemResource($item),
            'تم تحديث عنصر طلب الصيانة بنجاح'
        );
    }

    /**
     * حذف عنصر طلب صيانة محدد
     */
    public function destroy(string $id)
    {
        $item = MaintenanceRequestItem::findOrFail($id);
        $item->delete();

        return $this->successResponse(
            null,
            'تم حذف عنصر طلب الصيانة بنجاح'
        );
    }
}
