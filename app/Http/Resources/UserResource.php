<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'email' => $this->email,
            'role' => $this->role,
            'branch_id' => $this->branch_id,
            'is_active' => $this->is_active,
            'last_login' => $this->last_login,
            'password_changed_at' => $this->password_changed_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            // العلاقات
            'branch' => new BranchResource($this->whenLoaded('branch')),
            // العدد
            'maintenance_requests_count' => $this->when($request->with_counts, fn() => $this->maintenanceRequests()->count()),
            'supervised_requests_count' => $this->when($request->with_counts, fn() => $this->supervisedRequests()->count()),
            'managed_requests_count' => $this->when($request->with_counts, fn() => $this->managedRequests()->count()),
        ];
    }
}
