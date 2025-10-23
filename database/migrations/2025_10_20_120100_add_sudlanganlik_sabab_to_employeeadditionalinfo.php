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
        Schema::table('Menyu_employeeadditionalinfo', function (Blueprint $table) {
            if (!Schema::hasColumn('Menyu_employeeadditionalinfo', 'sudlanganlik_sabab')) {
                $table->string('sudlanganlik_sabab')->nullable()->after('inps');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Menyu_employeeadditionalinfo', function (Blueprint $table) {
            if (Schema::hasColumn('Menyu_employeeadditionalinfo', 'sudlanganlik_sabab')) {
                $table->dropColumn('sudlanganlik_sabab');
            }
        });
    }
};
