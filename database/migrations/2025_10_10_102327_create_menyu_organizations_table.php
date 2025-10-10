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
        Schema::create('Menyu_organization', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('password');
            $table->integer('user_id');
            $table->boolean('robot_auto');
            $table->boolean('turniket');
            $table->boolean('last_check');
            $table->time('late_time')->nullable();
            $table->jsonb('non_workdays');
            $table->jsonb('extra_user');
            $table->jsonb('user_ids');
            $table->string('subdomain');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Menyu_organization');
    }
};
