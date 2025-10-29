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
        // Reasons jadval (sabablar)
        Schema::create('employee_reasons', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Sabab nomi');
            $table->string('color', 50)->nullable()->comment('Rang kodi (hex)');
            $table->text('description')->nullable()->comment('Sabab tavsifi');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Employee reasons jadval (xodim sabablari)
        Schema::create('employee_reason_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('Menyu_employee')->onDelete('cascade');
            $table->foreignId('reason_id')->constrained('employee_reasons')->onDelete('cascade');
            $table->enum('type', ['daily', 'hourly'])->comment('kunlik yoki soatlik');
            $table->date('start_date')->nullable()->comment('Boshlanish sanasi (kunlik uchun)');
            $table->date('end_date')->nullable()->comment('Tugash sanasi (kunlik uchun)');
            $table->timestamp('start_datetime')->nullable()->comment('Boshlanish sanasi va vaqti (soatlik uchun)');
            $table->timestamp('end_datetime')->nullable()->comment('Tugash sanasi va vaqti (soatlik uchun)');
            $table->text('comment')->nullable()->comment('Izoh');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_reason_items');
        Schema::dropIfExists('employee_reasons');
    }
};

