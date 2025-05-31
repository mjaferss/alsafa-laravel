<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // إنشاء مستخدم super admin لكل فرع
        $branches = Branch::all();
        $counter = 1;

        foreach ($branches as $branch) {
            // Super Admin
            User::create([
                'name' => 'مستخدم super_admin ' . $counter,
                'email' => 'super_admin' . $counter . '@alsafa.com',
                'password' => bcrypt('password'),
                'phone' => '+966510000' . str_pad($counter, 3, '0', STR_PAD_LEFT),
                'role' => 'super_admin',
                'branch_id' => $branch->id,
                'is_active' => true
            ]);

            // Manager
            User::create([
                'name' => 'مدير ' . $counter,
                'email' => 'manager' . $counter . '@alsafa.com',
                'password' => bcrypt('password'),
                'phone' => '+966520000' . str_pad($counter, 3, '0', STR_PAD_LEFT),
                'role' => 'manager',
                'branch_id' => $branch->id,
                'is_active' => true
            ]);

            // Supervisor
            User::create([
                'name' => 'مشرف ' . $counter,
                'email' => 'supervisor' . $counter . '@alsafa.com',
                'password' => bcrypt('password'),
                'phone' => '+966530000' . str_pad($counter, 3, '0', STR_PAD_LEFT),
                'role' => 'supervisor',
                'branch_id' => $branch->id,
                'is_active' => true
            ]);

            // User
            User::create([
                'name' => 'مستخدم ' . $counter,
                'email' => 'user' . $counter . '@alsafa.com',
                'password' => bcrypt('password'),
                'phone' => '+966540000' . str_pad($counter, 3, '0', STR_PAD_LEFT),
                'role' => 'user',
                'branch_id' => $branch->id,
                'is_active' => true
            ]);

            $counter++;
        }
    }
}
