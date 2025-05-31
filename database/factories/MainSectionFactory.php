<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MainSectionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name_ar' => 'قسم ' . $this->faker->word(),
            'name_en' => 'Section ' . $this->faker->word(),
            'cost' => 0,
            'is_active' => true,
            'created_by' => User::factory(),
        ];
    }
}
