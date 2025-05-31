<?php

namespace Database\Factories;

use App\Models\MainSection;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaintenanceDescriptionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'description_ar' => 'صيانة ' . $this->faker->word(),
            'description_en' => 'Maintenance ' . $this->faker->word(),
            'price' => $this->faker->randomFloat(2, 100, 1000),
            'main_section_id' => MainSection::factory(),
            'is_active' => true,
            'created_by' => User::factory(),
        ];
    }
}
