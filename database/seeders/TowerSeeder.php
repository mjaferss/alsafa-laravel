<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tower;
use App\Models\Branch;
use App\Models\User;

class TowerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branches = Branch::all();
        $user = User::where('role', 'super_admin')->first();

        foreach ($branches as $branch) {
            // إنشاء 4 أبراج لكل فرع
            for ($i = 1; $i <= 4; $i++) {
                Tower::create([
                    'name_ar' => "برج {$i} - {$branch->name_ar}",
                    'name_en' => "Tower {$i} - {$branch->name_en}",
                    'description_ar' => "وصف البرج {$i} - {$branch->name_ar}",
                    'description_en' => "Description for Tower {$i} - {$branch->name_en}",
                    'branch_id' => $branch->id,
                    'created_by' => $user->id,
                    'is_active' => true
                ]);
            }
        }
    }
}
