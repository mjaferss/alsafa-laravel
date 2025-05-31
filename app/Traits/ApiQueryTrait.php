<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait ApiQueryTrait
{
    /**
     * تطبيق البحث والترتيب والتصفية على الاستعلام
     */
    protected function applyQueryParameters(Request $request, Builder $query, array $searchableFields = [], array $filterableFields = []): Builder
    {
        // البحث في الحقول
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm, $searchableFields) {
                foreach ($searchableFields as $field) {
                    // البحث في الحقول العربية والإنجليزية
                    if (str_ends_with($field, '_ar') || str_ends_with($field, '_en')) {
                        $q->orWhere($field, 'LIKE', "%{$searchTerm}%");
                    } else {
                        // للحقول العادية
                        $q->orWhere($field, 'LIKE', "%{$searchTerm}%");
                    }
                }
            });
        }

        // التصفية
        foreach ($filterableFields as $field) {
            if ($request->has($field)) {
                $value = $request->get($field);
                if ($value === 'true') $value = true;
                if ($value === 'false') $value = false;
                $query->where($field, $value);
            }
        }

        // الترتيب
        if ($request->has('sort')) {
            $sortField = ltrim($request->sort, '-');
            $sortDirection = str_starts_with($request->sort, '-') ? 'desc' : 'asc';
            
            // التحقق من أن الحقل المطلوب للترتيب موجود في القائمة المسموح بها
            if (in_array($sortField, array_merge($searchableFields, $filterableFields))) {
                $query->orderBy($sortField, $sortDirection);
            }
        } else {
            // الترتيب الافتراضي حسب آخر تحديث
            $query->latest();
        }

        return $query;
    }

    /**
     * تطبيق الصفحات على الاستعلام
     */
    protected function applyPagination(Request $request, Builder $query, int $defaultPerPage = 15): mixed
    {
        $perPage = (int) $request->get('per_page', $defaultPerPage);
        
        // التحقق من أن عدد العناصر في الصفحة ضمن الحدود المسموح بها
        if ($perPage < 1) $perPage = 1;
        if ($perPage > 100) $perPage = 100;

        return $query->paginate($perPage);
    }

    /**
     * تنسيق استجابة الصفحات
     */
    protected function formatPaginatedResponse($paginator, $resourceClass = null): array
    {
        $data = $paginator->items();
        
        // تطبيق Resource Transformation إذا تم تحديده
        if ($resourceClass) {
            $data = $resourceClass::collection($data)->resolve();
        }

        return [
            'data' => $data,
            'meta' => [
                'current_page' => $paginator->currentPage(),
                'from' => $paginator->firstItem(),
                'last_page' => $paginator->lastPage(),
                'per_page' => $paginator->perPage(),
                'to' => $paginator->lastItem(),
                'total' => $paginator->total(),
            ],
            'links' => [
                'first' => $paginator->url(1),
                'last' => $paginator->url($paginator->lastPage()),
                'prev' => $paginator->previousPageUrl(),
                'next' => $paginator->nextPageUrl(),
            ]
        ];
    }
}
