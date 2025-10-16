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
        Schema::create('Menyu_region', function (Blueprint $table) {
            $table->id();
            $table->string('soato_id');
            $table->string('name_uz');
            $table->string('name_ru');
            $table->string('name_oz');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Menyu_region');
    }
};
