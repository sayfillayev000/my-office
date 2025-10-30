<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Menyu_kitchenchecklog', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestampTz('date')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->unsignedBigInteger('turniket_id')->nullable();
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->unsignedBigInteger('door_schedule')->nullable();
            $table->timestamps();

            $table->index('date', 'Menyu_kitchenchecklog_date_index');
            $table->index('employee_id', 'Menyu_kitchenchecklog_employee_id_index');
            $table->index('turniket_id', 'Menyu_kitchenchecklog_turniket_id_index');

            $table->foreign('employee_id')
                ->references('id')->on('Menyu_employee')
                ->nullOnDelete();
            $table->foreign('turniket_id')
                ->references('id')->on('Menyu_turniket')
                ->nullOnDelete();
            $table->foreign('organization_id')
                ->references('id')->on('Menyu_organization')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Menyu_kitchenchecklog');
    }
};


