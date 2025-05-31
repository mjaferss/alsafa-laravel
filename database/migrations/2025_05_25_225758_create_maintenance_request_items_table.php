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
        Schema::create('maintenance_request_items', function (Blueprint $table) {
            $table->id();
            
            // العلاقات
            $table->foreignId('maintenance_request_id')->constrained('maintenance_requests')->cascadeOnDelete();  // رقم طلب الصيانة
            $table->foreignId('maintenance_description_id')->constrained('maintenance_descriptions');  // رقم الوصف
            
            // تفاصيل البند
            $table->integer('quantity')->default(1);  // العدد
            $table->decimal('unit_price', 10, 2);  // سعر الوحدة
            $table->boolean('has_tax')->default(true);  // هل يخضع للضريبة
            $table->decimal('tax_amount', 10, 2)->default(0);  // قيمة الضريبة
            $table->decimal('subtotal', 10, 2);  // الإجمالي قبل الضريبة
            $table->decimal('total', 10, 2);  // الإجمالي بعد الضريبة
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_request_items');
    }
};
