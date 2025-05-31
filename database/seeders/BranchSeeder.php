<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Branch;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branches = [
            [
                'name_ar' => 'فرع الرياض',
                'name_en' => 'Riyadh Branch',
                'address_ar' => 'الرياض، حي الملقا',
                'address_en' => 'Riyadh, Al Malqa District',
                'phone' => '+966512345678',
                'is_active' => true
            ],
            [
                'name_ar' => 'فرع شمال الرياض',
                'name_en' => 'North Riyadh Branch',
                'address_ar' => 'حي النخيل، الرياض',
                'address_en' => 'Al Nakheel District, Riyadh',
                'phone' => '+966500000002',
                'is_active' => true
            ],
            [
                'name_ar' => 'فرع شرق الرياض',
                'name_en' => 'East Riyadh Branch',
                'address_ar' => 'حي الروضة، الرياض',
                'address_en' => 'Al Rawdah District, Riyadh',
                'phone' => '+966500000003',
                'is_active' => true
            ],
            [
                'name_ar' => 'فرع غرب الرياض',
                'name_en' => 'West Riyadh Branch',
                'address_ar' => 'حي السويدي، الرياض',
                'address_en' => 'Al Suwaidi District, Riyadh',
                'phone' => '+966500000004',
                'is_active' => true
            ],
            [
                'name_ar' => 'فرع جنوب الرياض',
                'name_en' => 'South Riyadh Branch',
                'address_ar' => 'حي السلي، الرياض',
                'address_en' => 'Al Sulay District, Riyadh',
                'phone' => '+966500000005',
                'is_active' => true
            ],
        ];

        foreach ($branches as $branch) {
            Branch::create($branch);
        }
    }
}
