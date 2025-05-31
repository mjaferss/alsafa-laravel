<?php

namespace Database\Factories;

use App\Models\MaintenanceRequest;
use App\Models\MaintenanceDescription;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaintenanceRequestItemFactory extends Factory
{
    public function definition(): array
    {
        $quantity = $this->faker->numberBetween(1, 5);
        $unitPrice = $this->faker->randomFloat(2, 100, 1000);
        $subtotal = $quantity * $unitPrice;
        $taxAmount = $subtotal * 0.15; // 15% VAT
        $total = $subtotal + $taxAmount;

        return [
            'maintenance_request_id' => MaintenanceRequest::factory(),
            'maintenance_description_id' => MaintenanceDescription::factory(),
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'has_tax' => true,
            'tax_amount' => $taxAmount,
            'subtotal' => $subtotal,
            'total' => $total,
        ];
    }
}
