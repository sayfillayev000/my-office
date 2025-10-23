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
        Schema::create('Menyu_passportinfo', function (Blueprint $table) {
            $table->id();
            $table->string('seria_raqam');
            $table->string('kim_tomonidan_berilgan');
            $table->date('berilgan_sana');
            $table->date('amal_qilish_muddati');
            $table->string('doimiy_yashash_joyi');
            $table->string('yashash_joyi');
            $table->foreignId('employee_id')->constrained('Menyu_employee')->cascadeOnDelete();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Menyu_passportinfo');
    }
};
