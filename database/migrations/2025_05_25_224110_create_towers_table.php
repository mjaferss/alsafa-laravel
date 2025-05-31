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
        Schema::create('towers', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');  // اسم البرج بالعربية
            $table->string('name_en');  // اسم البرج بالإنجليزية
            $table->text('description_ar')->nullable();  // وصف البرج بالعربية
            $table->text('description_en')->nullable();  // وصف البرج بالإنجليزية
            $table->decimal('cost', 10, 2)->default(0);  // تكلفة البرج
            $table->boolean('is_active')->default(true);  // حالة البرج
            
            // العلاقات
            $table->foreignId('branch_id')->constrained('branches');  // الفرع التابع له
            $table->foreignId('created_by')->nullable()->constrained('users');  // المستخدم الذي أنشأ البرج
            $table->foreignId('updated_by')->nullable()->constrained('users');  // المستخدم الذي قام بالتعديل
            
            $table->timestamps();  // created_at, updated_at
            $table->softDeletes();  // deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('towers');
    }
};
