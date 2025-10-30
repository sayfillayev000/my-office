<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Menyu_employee_turniket_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('turniketsettings_id');
            $table->timestamps();

            $table->unique(['employee_id', 'turniketsettings_id'], 'menyu_emp_turniket_unique');

            $table->foreign('employee_id')
                ->references('id')->on('Menyu_employee')
                ->cascadeOnDelete();
            $table->foreign('turniketsettings_id')
                ->references('id')->on('Menyu_turniket')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Menyu_employee_turniket_settings');
    }
};


