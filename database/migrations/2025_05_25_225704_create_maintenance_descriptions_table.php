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
        Schema::create('maintenance_descriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('main_section_id')->constrained('main_sections');  // القسم الرئيسي
            $table->string('name_ar');  // اسم الصيانة بالعربي
            $table->string('name_en');  // اسم الصيانة بالإنجليزي
            $table->text('description_ar')->nullable();  // وصف الصيانة بالعربي
            $table->text('description_en')->nullable();  // وصف الصيانة بالإنجليزي
            $table->boolean('is_active')->default(true);  // حالة النشاط
            $table->foreignId('created_by')->nullable()->constrained('users');  // منشئ الوصف
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_descriptions');
    }
};
