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
           Schema::create('Menyu_employee', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name');
            $table->string('department');
            $table->string('position');
            $table->integer('phone');
            $table->longText('image');
            $table->integer('floor');
            $table->integer('room');
            $table->binary('embedding');
            $table->boolean('parking');
            $table->boolean('office');
            $table->float('worker_and_time');
            $table->integer('organization_id');
            $table->boolean('night_working');
            $table->string('tashkilot');
          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Menyu_employee');   
        
    }
};
