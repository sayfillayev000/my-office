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
        Schema::table('Menyu_employee', function (Blueprint $table) {
            if (!Schema::hasColumn('Menyu_employee', 'car_number')) {
                $table->string('car_number')->nullable()->after('night_working');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Menyu_employee', function (Blueprint $table) {
            if (Schema::hasColumn('Menyu_employee', 'car_number')) {
                $table->dropColumn('car_number');
            }
        });
    }
};
