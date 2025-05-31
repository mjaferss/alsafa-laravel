<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('maintenance_requests', function (Blueprint $table) {
            $table->id();
            
            // العلاقات
            $table->foreignId('user_id')->constrained('users');  // مقدم الطلب
            $table->foreignId('branch_id')->constrained('branches');  // الفرع
            $table->foreignId('tower_id')->constrained('towers');  // البرج
            $table->foreignId('main_section_id')->constrained('main_sections');  // القسم الرئيسي
            
            // تفاصيل الطلب
            $table->text('notes')->nullable();  // ملاحظات
            $table->enum('status', ['pending', 'supervisor_approved', 'supervisor_rejected', 'manager_approved', 'manager_rejected'])->default('pending');  // حالة الطلب
            $table->decimal('subtotal', 10, 2)->default(0);  // الإجمالي قبل الضريبة
            $table->decimal('tax', 10, 2)->default(0);  // الضريبة
            $table->decimal('total', 10, 2)->default(0);  // الإجمالي مع الضريبة
            $table->boolean('is_active')->default(true);  // حالة النشاط
            
            // موافقة المشرف
            $table->foreignId('supervisor_id')->nullable()->constrained('users');  // المشرف
            $table->text('supervisor_notes')->nullable();  // ملاحظات المشرف
            $table->timestamp('supervisor_action_at')->nullable();  // وقت اتخاذ القرار
            
            // موافقة المدير
            $table->foreignId('manager_id')->nullable()->constrained('users');  // المدير
            $table->text('manager_notes')->nullable();  // ملاحظات المدير
            $table->timestamp('manager_action_at')->nullable();  // وقت اتخاذ القرار
            
            $table->timestamps();  // created_at, updated_at
            $table->softDeletes();  // deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_requests');
    }
};
