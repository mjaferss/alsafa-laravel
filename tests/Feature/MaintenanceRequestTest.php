<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Tower;
use App\Models\Branch;
use App\Models\MainSection;
use App\Models\MaintenanceDescription;
use App\Models\MaintenanceRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class MaintenanceRequestTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private User $user;
    private Tower $tower;
    private MainSection $mainSection;
    private MaintenanceDescription $maintenanceDescription;

    protected function setUp(): void
    {
        parent::setUp();

        // تجهيز البيانات اللازمة للاختبارات
        $this->branch = Branch::factory()->create([
            'name_ar' => 'فرع الاختبار',
            'name_en' => 'Test Branch',
            'is_active' => true
        ]);

        $this->user = User::factory()->create([
            'name' => 'مستخدم الاختبار',
            'email' => 'test@alsafa.com',
            'password' => bcrypt('password'),
            'role' => 'normal_user',
            'branch_id' => $this->branch->id,
            'is_active' => true
        ]);

        $this->tower = Tower::factory()->create([
            'name_ar' => 'برج الاختبار',
            'name_en' => 'Test Tower',
            'branch_id' => $this->branch->id,
            'created_by' => $this->user->id,
            'is_active' => true
        ]);

        $this->mainSection = MainSection::factory()->create([
            'name_ar' => 'قسم الاختبار',
            'name_en' => 'Test Section',
            'created_by' => $this->user->id,
            'is_active' => true
        ]);

        $this->maintenanceDescription = MaintenanceDescription::factory()->create([
            'name_ar' => 'وصف الاختبار',
            'name_en' => 'Test Description',
            'main_section_id' => $this->mainSection->id,
            'created_by' => $this->user->id,
            'price' => 100,
            'is_active' => true
        ]);
    }

    /** @test */
    public function user_can_create_maintenance_request()
    {
        $response = $this->actingAs($this->user)
            ->postJson('/api/maintenance-requests', [
                'branch_id' => $this->user->branch_id,
                'tower_id' => $this->tower->id,
                'main_section_id' => $this->mainSection->id,
                'notes' => 'اختبار طلب صيانة',
                'items' => [
                    [
                        'maintenance_description_id' => $this->maintenanceDescription->id,
                        'quantity' => 2,
                        'unit_price' => $this->maintenanceDescription->price,
                        'has_tax' => true,
                        'note' => 'ملاحظة على البند'
                    ]
                ],
                'is_active' => true
            ]);

        $response->assertCreated();
        $this->assertDatabaseHas('maintenance_requests', [
            'user_id' => $this->user->id,
            'tower_id' => $this->tower->id,
            'main_section_id' => $this->mainSection->id,
            'status' => 'pending',
        ]);
    }

    /** @test */
    public function user_can_view_maintenance_request()
    {
        // إنشاء طلب صيانة
        $request = MaintenanceRequest::factory()->create([
            'user_id' => $this->user->id,
            'tower_id' => $this->tower->id,
            'main_section_id' => $this->mainSection->id,
        ]);

        $response = $this->actingAs($this->user)
            ->getJson("/api/maintenance-requests/{$request->id}");

        $response->assertOk()
            ->assertJsonPath('data.id', $request->id)
            ->assertJsonPath('data.user_id', $this->user->id)
            ->assertJsonPath('data.tower_id', $this->tower->id)
            ->assertJsonPath('data.main_section_id', $this->mainSection->id);
    }

    /** @test */
    public function user_can_update_maintenance_request()
    {
        // إنشاء طلب صيانة
        $request = MaintenanceRequest::factory()->create([
            'user_id' => $this->user->id,
            'tower_id' => $this->tower->id,
            'main_section_id' => $this->mainSection->id,
        ]);

        $newTower = Tower::where('id', '!=', $this->tower->id)->first();

        $response = $this->actingAs($this->user)
            ->putJson("/api/maintenance-requests/{$request->id}", [
                'tower_id' => $newTower->id,
                'main_section_id' => $this->mainSection->id,
                'items' => [
                    [
                        'maintenance_description_id' => $this->maintenanceDescription->id,
                        'quantity' => 3,
                    ]
                ]
            ]);

        $response->assertOk();
        $this->assertDatabaseHas('maintenance_requests', [
            'id' => $request->id,
            'tower_id' => $newTower->id,
        ]);
    }

    /** @test */
    public function user_can_delete_maintenance_request()
    {
        // إنشاء طلب صيانة
        $request = MaintenanceRequest::factory()->create([
            'user_id' => $this->user->id,
            'tower_id' => $this->tower->id,
            'main_section_id' => $this->mainSection->id,
        ]);

        $response = $this->actingAs($this->user)
            ->deleteJson("/api/maintenance-requests/{$request->id}");

        $response->assertOk();
        $this->assertSoftDeleted('maintenance_requests', [
            'id' => $request->id,
        ]);
    }

    /** @test */
    public function user_can_list_maintenance_requests()
    {
        // إنشاء عدة طلبات صيانة
        MaintenanceRequest::factory()->count(3)->create([
            'user_id' => $this->user->id,
            'tower_id' => $this->tower->id,
            'main_section_id' => $this->mainSection->id,
        ]);

        $response = $this->actingAs($this->user)
            ->getJson('/api/maintenance-requests');

        $response->assertOk()
            ->assertJsonCount(3, 'data');
    }
}
