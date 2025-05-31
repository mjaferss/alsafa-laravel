<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MaintenanceRequest;
use App\Models\MaintenanceRequestItem;
use App\Models\MaintenanceDescription;
use App\Models\Branch;
use App\Models\Tower;
use App\Models\MainSection;
use App\Models\User;

class MaintenanceRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branches = Branch::all();
        $mainSections = MainSection::all();
        $maintenanceDescriptions = MaintenanceDescription::all();

        foreach ($branches as $branch) {
            // الحصول على المستخدمين في الفرع
            $user = User::where('branch_id', $branch->id)
                ->where('role', 'user')
                ->first();
            
            $supervisor = User::where('branch_id', $branch->id)
                ->where('role', 'supervisor')
                ->first();
            
            $manager = User::where('branch_id', $branch->id)
                ->where('role', 'manager')
                ->first();

            // الحصول على الأبراج في الفرع
            $towers = Tower::where('branch_id', $branch->id)->get();

            // إنشاء طلبات صيانة لكل برج
            foreach ($towers as $tower) {
                // إنشاء طلب صيانة واحد لكل برج
                $maintenanceRequest = MaintenanceRequest::create([
                    'user_id' => $user->id,
                    'branch_id' => $branch->id,
                    'tower_id' => $tower->id,
                    'main_section_id' => $mainSections->random()->id,
                    'notes' => 'ملاحظات على الطلب',
                    'status' => 'pending',
                    'is_active' => true,
                    'supervisor_id' => $supervisor ? $supervisor->id : null,
                    'supervisor_notes' => $supervisor ? 'ملاحظات المشرف' : null,
                    'supervisor_action_at' => $supervisor ? now() : null,
                    'manager_id' => null,
                    'manager_notes' => null,
                    'manager_action_at' => null,
                ]);

                // إضافة عناصر لطلب الصيانة
                $items = $maintenanceDescriptions->random(3);
                foreach ($items as $item) {
                    $quantity = rand(1, 5);
                    $unitPrice = rand(100, 1000);
                    $subtotal = $quantity * $unitPrice;
                    $taxAmount = $subtotal * 0.15; // 15% ضريبة
                    $total = $subtotal + $taxAmount;

                    MaintenanceRequestItem::create([
                        'maintenance_request_id' => $maintenanceRequest->id,
                        'maintenance_description_id' => $item->id,
                        'quantity' => $quantity,
                        'unit_price' => $unitPrice,
                        'has_tax' => true,
                        'tax_amount' => $taxAmount,
                        'subtotal' => $subtotal,
                        'total' => $total,
                    ]);
                }

                // تحديث إجماليات الطلب
                $items = $maintenanceRequest->items;
                $maintenanceRequest->update([
                    'subtotal' => $items->sum('subtotal'),
                    'tax' => $items->sum('tax_amount'),
                    'total' => $items->sum('total'),
                ]);
            }
        }
    }
}
