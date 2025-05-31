<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\MainSection;
use App\Models\MaintenanceDescription;

class MaintenanceDescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mainSections = MainSection::all();
        $user = User::where('role', 'super_admin')->first();

        foreach ($mainSections as $section) {
            // إنشاء 5 أوصاف لكل قسم
            for ($i = 1; $i <= 5; $i++) {
                MaintenanceDescription::create([
                    'name_ar' => "صيانة {$i} - {$section->name_ar}",
                    'name_en' => "Maintenance {$i} - {$section->name_en}",
                    'description_ar' => "وصف الصيانة {$i} للقسم {$section->name_ar}",
                    'description_en' => "Description for maintenance {$i} in section {$section->name_en}",
                    'main_section_id' => $section->id,
                    'created_by' => $user->id,
                    'is_active' => true
                ]);
            }
        }
    }
}
