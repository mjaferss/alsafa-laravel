<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Traits\ApiQueryTrait;
use Illuminate\Http\JsonResponse;

class BaseApiController extends Controller
{
    use ApiQueryTrait;

    /**
     * إرجاع استجابة نجاح
     */
    protected function successResponse($data = null, string $message = 'Success', int $code = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * إرجاع استجابة خطأ
     */
    protected function errorResponse(string $message = 'Error', int $code = 400): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $code);
    }

    /**
     * إرجاع استجابة خطأ التحقق
     */
    protected function validationErrorResponse($errors)
    {
        return response()->json([
            'message' => 'Validation error',
            'errors' => is_array($errors) ? $errors : $errors->toArray()
        ], 422);
    }
}
