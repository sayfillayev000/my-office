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
            $table->string('tab_number')->unique()->nullable()->after('fnfl');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Menyu_employee', function (Blueprint $table) {
            $table->dropColumn('tab_number');
        });
    }
};
