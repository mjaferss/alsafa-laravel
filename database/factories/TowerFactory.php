<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TowerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name_ar' => 'برج ' . $this->faker->word(),
            'name_en' => 'Tower ' . $this->faker->word(),
            'cost' => 0,
            'is_active' => true,
            'branch_id' => Branch::factory(),
            'created_by' => User::factory(),
        ];
    }
}
