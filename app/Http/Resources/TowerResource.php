<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TowerResource extends JsonResource
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
            'name' => $this->name,
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'branch_id' => $this->branch_id,
            'cost' => $this->cost,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            // العلاقات
            'branch' => new BranchResource($this->whenLoaded('branch')),
            'maintenance_requests_count' => $this->when($request->with_counts, fn() => $this->maintenanceRequests()->count()),
        ];
    }
}
