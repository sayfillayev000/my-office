<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Menyu_turniketsettings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->string('turniket_ip', 64)->nullable();
            $table->string('local_ip', 64)->nullable();
            $table->string('turniket_username', 255)->nullable();
            $table->string('turniket_password', 255)->nullable();
            $table->string('door_status', 64)->nullable();
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->unsignedBigInteger('turniket_obyect_id')->nullable();
            $table->boolean('oshxona_turnik')->default(false);
            $table->string('types', 64)->nullable();
            $table->timestamps();

            $table->index('turniket_obyect_id', 'Menyu_turniket_turniket_obyect_id_index');
            $table->index('organization_id', 'Menyu_turniket_organization_id_index');

            $table->foreign('organization_id')
                ->references('id')->on('Menyu_organization')
                ->nullOnDelete();

            $table->foreign('turniket_obyect_id')
                ->references('id')->on('Menyu_obyect')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Menyu_turniket');
    }
};


