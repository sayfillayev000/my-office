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
        Schema::create('Menyu_militaryrecord', function (Blueprint $table) {
            $table->id();
            $table->string('hisob_guruhi')->nullable();
            $table->string('hisob_toifasi')->nullable();
            $table->string('harbiy_mutaxassislik')->nullable();
            $table->string('qoshin_turi')->nullable();
            $table->string('xizmatga_yaroqliligi')->nullable();
            $table->string('harbiy_unvoni')->nullable();
            $table->string('mudofa_bolimi')->nullable();
            $table->string('maxsus_xisob')->nullable();
            $table->foreignId('employee_id')->constrained('Menyu_employee')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Menyu_militaryrecord');
    }
};
