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
        Schema::create('Menyu_workexperience', function (Blueprint $table) {
            $table->id();
            $table->string('lavozim');
            $table->string('tashkilot_nomi');
            $table->date('kirgan_sanasi');
            $table->date('boshagan_sanasi')->nullable();
            $table->boolean('current_job')->default(false);
            $table->foreignId('employee_id')->constrained('Menyu_employee')->cascadeOnDelete();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Menyu_workexperience');
    }
};
