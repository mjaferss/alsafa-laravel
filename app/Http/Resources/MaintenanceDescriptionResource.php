<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaintenanceDescriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'description_ar' => $this->description_ar,
            'description_en' => $this->description_en,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            // العلاقات
            'maintenance_request_items_count' => $this->when($request->with_counts, fn() => $this->maintenanceRequestItems()->count()),
        ];
    }
}
