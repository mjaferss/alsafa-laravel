<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BranchFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name_ar' => 'فرع ' . $this->faker->city(),
            'name_en' => 'Branch ' . $this->faker->city(),
            'address_ar' => $this->faker->address(),
            'address_en' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'is_active' => true,
        ];
    }
}
