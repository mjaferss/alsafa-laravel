<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    public function run()
    {
        $user = User::first();

        if ($user) {
            Activity::create([
                'user_id' => $user->id,
                'description' => 'تم تسجيل الدخول',
                'action' => 'login',
            ]);

            Activity::create([
                'user_id' => $user->id,
                'description' => 'تم تحديث الملف الشخصي',
                'action' => 'update_profile',
            ]);

            Activity::create([
                'user_id' => $user->id,
                'description' => 'تم إضافة مستخدم جديد',
                'action' => 'create_user',
            ]);
        }
    }
}
