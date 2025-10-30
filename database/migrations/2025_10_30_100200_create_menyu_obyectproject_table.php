<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Menyu_obyectproject', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->unsignedBigInteger('obyect_id');
            $table->timestamps();

            $table->index('obyect_id', 'Menyu_obyectproject_obyect_id_index');
            $table->foreign('obyect_id')
                ->references('id')->on('Menyu_obyect')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Menyu_obyectproject');
    }
};


