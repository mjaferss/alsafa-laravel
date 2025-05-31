<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaintenanceRequestResource extends JsonResource
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
            'user_id' => $this->user_id,
            'branch_id' => $this->branch_id,
            'tower_id' => $this->tower_id,
            'main_section_id' => $this->main_section_id,
            'notes' => $this->notes,
            'subtotal' => $this->subtotal,
            'tax' => $this->tax,
            'total' => $this->total,
            'status' => $this->status,
            'supervisor_approval' => $this->supervisor_approval,
            'supervisor_notes' => $this->supervisor_notes,
            'manager_approval' => $this->manager_approval,
            'manager_notes' => $this->manager_notes,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            // العلاقات
            'user' => new UserResource($this->whenLoaded('user')),
            'branch' => new BranchResource($this->whenLoaded('branch')),
            'tower' => new TowerResource($this->whenLoaded('tower')),
            'main_section' => new MainSectionResource($this->whenLoaded('mainSection')),
            'supervisor' => new UserResource($this->whenLoaded('supervisor')),
            'manager' => new UserResource($this->whenLoaded('manager')),
            'items' => MaintenanceRequestItemResource::collection($this->whenLoaded('items')),
            // العدد
            'items_count' => $this->when($request->with_counts, fn() => $this->items()->count()),
        ];
    }
}
