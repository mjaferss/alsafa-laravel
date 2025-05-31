<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // 1. إنشاء الفروع
        $this->call(BranchSeeder::class);

        // 2. إنشاء المستخدمين
        $this->call(UserSeeder::class);

        // 3. إنشاء الأبراج
        $this->call(TowerSeeder::class);

        // 4. إنشاء الأقسام الرئيسية
        $this->call(MainSectionSeeder::class);

        // 5. إنشاء أوصاف الصيانة
        $this->call(MaintenanceDescriptionSeeder::class);

        // 6. إنشاء طلبات الصيانة
        $this->call(MaintenanceRequestSeeder::class);

        // 7. إنشاء الأنشطة
        $this->call(ActivitySeeder::class);
    }
}
