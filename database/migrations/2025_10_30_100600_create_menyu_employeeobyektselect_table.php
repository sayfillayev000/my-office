<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Menyu_employeeobyektselect', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('select', 255)->nullable();
            $table->timestampTz('create_time')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->unsignedBigInteger('obyekt_id')->nullable();
            $table->timestamps();

            $table->index('employee_id', 'Menyu_employeeobyektselect_employee_id_index');
            $table->index('obyekt_id', 'Menyu_employeeobyektselect_obyekt_id_index');

            $table->foreign('employee_id')
                ->references('id')->on('Menyu_employee')
                ->nullOnDelete();
            $table->foreign('obyekt_id')
                ->references('id')->on('Menyu_obyect')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Menyu_employeeobyektselect');
    }
};


