<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MainSection;
use App\Models\User;

class MainSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            [
                'name_ar' => 'السباكة',
                'name_en' => 'Plumbing'
            ],
            [
                'name_ar' => 'الكهرباء',
                'name_en' => 'Electricity'
            ],
            [
                'name_ar' => 'التكييف',
                'name_en' => 'Air Conditioning'
            ],
            [
                'name_ar' => 'النجارة',
                'name_en' => 'Carpentry'
            ],
            [
                'name_ar' => 'الدهان',
                'name_en' => 'Painting'
            ],
            [
                'name_ar' => 'البلاط',
                'name_en' => 'Tiles'
            ],
            [
                'name_ar' => 'الألمنيوم',
                'name_en' => 'Aluminum'
            ],
            [
                'name_ar' => 'الحدادة',
                'name_en' => 'Blacksmith'
            ],
            [
                'name_ar' => 'الزجاج',
                'name_en' => 'Glass'
            ],
            [
                'name_ar' => 'العزل',
                'name_en' => 'Insulation'
            ],
            [
                'name_ar' => 'مكافحة الحرائق',
                'name_en' => 'Fire Fighting'
            ],
            [
                'name_ar' => 'الصيانة العامة',
                'name_en' => 'General Maintenance'
            ],
            [
                'name_ar' => 'قسم البناء والترميم',
                'name_en' => 'Construction and Renovation'
            ],
            [
                'name_ar' => 'قسم الحدائق',
                'name_en' => 'Gardens'
            ],
            [
                'name_ar' => 'قسم المواقف',
                'name_en' => 'Parking'
            ],
            [
                'name_ar' => 'قسم المسابح',
                'name_en' => 'Swimming Pools'
            ],
            [
                'name_ar' => 'قسم النوافذ والأبواب',
                'name_en' => 'Windows and Doors'
            ],
            [
                'name_ar' => 'قسم الديكور',
                'name_en' => 'Decoration'
            ],
            [
                'name_ar' => 'قسم العزل',
                'name_en' => 'Insulation'
            ],
            [
                'name_ar' => 'قسم الألمنيوم',
                'name_en' => 'Aluminum'
            ],
            [
                'name_ar' => 'قسم الرخام والسيراميك',
                'name_en' => 'Marble and Ceramic'
            ],
        ];

        $user = User::where('role', 'super_admin')->first();

        foreach ($sections as $section) {
            MainSection::create([
                'name_ar' => $section['name_ar'],
                'name_en' => $section['name_en'],
                'created_by' => $user->id,
                'is_active' => true
            ]);
        }
    }
}
