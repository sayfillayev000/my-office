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
            $table->string('passport_file_path')->nullable()->after('passport_expiry');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Menyu_employee', function (Blueprint $table) {
            $table->dropColumn('passport_file_path');
        });
    }
};
