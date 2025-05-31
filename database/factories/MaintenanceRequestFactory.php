<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Tower;
use App\Models\MainSection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MaintenanceRequest>
 */
class MaintenanceRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => function () {
                return User::factory()->create(['branch_id' => Branch::factory()])->id;
            },
            'tower_id' => function () {
                return Tower::factory()->create(['branch_id' => Branch::factory()])->id;
            },
            'main_section_id' => function () {
                return MainSection::factory()->create(['created_by' => User::factory()->create(['branch_id' => Branch::factory()])])->id;
            },
            'status' => 'pending',
            'subtotal' => $this->faker->randomFloat(2, 100, 1000),
            'tax' => function (array $attributes) {
                return $attributes['subtotal'] * 0.15; // 15% VAT
            },
            'total' => function (array $attributes) {
                return $attributes['subtotal'] + $attributes['tax'];
            },
            'is_active' => true,
        ];
    }
}
