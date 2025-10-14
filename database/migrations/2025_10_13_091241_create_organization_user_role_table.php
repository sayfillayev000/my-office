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
        Schema::create('organization_user_role', function (Blueprint $table) {
            $table->id();

            $table->foreignId('organization_id')
                ->constrained('Menyu_organization')
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained('Menyu_employee')
                ->cascadeOnDelete();

            $table->foreignId('role_id')
                ->constrained('roles')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_user_role');
    }
};
