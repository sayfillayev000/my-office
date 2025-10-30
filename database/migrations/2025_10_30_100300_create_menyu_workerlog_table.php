<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Menyu_workerlog', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('worker_id')->nullable();
            $table->timestampTz('date')->index('DateIND')->nullable();
            $table->string('photo', 255)->nullable();
            $table->string('object_name', 255)->nullable();
            $table->unsignedBigInteger('object_id')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('door', 64)->nullable();
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->string('update_status', 64)->nullable();
            $table->unsignedBigInteger('obyect_project')->nullable();
            $table->unsignedBigInteger('tashkilot_id')->nullable();
            $table->unsignedBigInteger('turniket_id')->nullable();
            $table->timestamps();

            $table->index('obyect_project', 'Menyu_workerlog_obyect_project_index');
            $table->index('organization_id', 'Menyu_workerlog_organization_id_index');
            $table->index('tashkilot_id', 'Menyu_workerlog_tashkilot_id_index');
            $table->index('turniket_id', 'Menyu_workerlog_turniket_id_index');

            $table->foreign('obyect_project')
                ->references('id')->on('Menyu_obyectproject')
                ->nullOnDelete();
            $table->foreign('organization_id')
                ->references('id')->on('Menyu_organization')
                ->nullOnDelete();
            $table->foreign('tashkilot_id')
                ->references('id')->on('Menyu_tashkilot')
                ->nullOnDelete();
            $table->foreign('turniket_id')
                ->references('id')->on('Menyu_turniket')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Menyu_workerlog');
    }
};


