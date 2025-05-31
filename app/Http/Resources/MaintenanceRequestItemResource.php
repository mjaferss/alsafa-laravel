<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaintenanceRequestItemResource extends JsonResource
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
            'maintenance_request_id' => $this->maintenance_request_id,
            'maintenance_description_id' => $this->maintenance_description_id,
            'quantity' => $this->quantity,
            'unit_price' => $this->unit_price,
            'has_tax' => $this->has_tax,
            'tax_amount' => $this->tax_amount,
            'subtotal' => $this->subtotal,
            'total' => $this->total,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            // العلاقات
            'description' => new MaintenanceDescriptionResource($this->whenLoaded('description')),
            'maintenance_request' => new MaintenanceRequestResource($this->whenLoaded('maintenanceRequest')),
        ];
    }
}
