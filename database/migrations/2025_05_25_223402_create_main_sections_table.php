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
        Schema::create('main_sections', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');  // اسم القسم باللغة العربية
            $table->string('name_en');  // اسم القسم باللغة الإنجليزية
            $table->decimal('cost', 10, 2)->default(0);  // تكلفة القسم
            $table->boolean('is_active')->default(true);  // حالة القسم
            
            // العلاقة مع جدول المستخدمين
            $table->foreignId('created_by')->constrained('users');  // المستخدم الذي أنشأ القسم
            $table->foreignId('updated_by')->nullable()->constrained('users');  // المستخدم الذي قام بالتعديل
            
            $table->timestamps();  // created_at, updated_at
            $table->softDeletes();  // deleted_at للحذف الناعم
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main_sections');
    }
};
