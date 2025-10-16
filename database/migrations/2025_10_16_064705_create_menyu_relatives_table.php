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
        Schema::create('Menyu_relative', function (Blueprint $table) {
            $table->id();
            $table->string('qarindoshlik');
            $table->string('familiyasi');
            $table->string('ismi');
            $table->string('sharfi')->nullable();
            $table->integer('tugilgan_yili');
            $table->string('tugilgan_joy_soato');
            $table->string('ishi_joyi')->nullable();
            $table->string('lavozimi')->nullable();
            $table->foreignId('employee_id')->constrained('Menyu_employee')->cascadeOnDelete();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Menyu_relative');
    }
};
