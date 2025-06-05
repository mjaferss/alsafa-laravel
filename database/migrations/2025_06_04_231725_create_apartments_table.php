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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tower_id')->constrained('towers');
            $table->foreignId('apartment_type_id')->constrained('apartment_types');
            $table->string('name');
            $table->integer('floor_number');
            $table->decimal('cost', 10, 2); // تكلفة الشقة
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();

            // Add indices for better performance
            $table->index('tower_id');
            $table->index('apartment_type_id');
            $table->index('floor_number');
            $table->index(['tower_id', 'floor_number']); // للبحث عن الشقق في طابق معين في برج معين
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartments');
    }
};
