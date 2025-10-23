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
        if (Schema::hasTable('Menyu_relative')) {
            Schema::table('Menyu_relative', function (Blueprint $table) {
                if (!Schema::hasColumn('Menyu_relative', 'old_ishi_joyi')) {
                    $table->string('old_ishi_joyi')->nullable()->after('ishi_joyi');
                }
                if (!Schema::hasColumn('Menyu_relative', 'old_lavozimi')) {
                    $table->string('old_lavozimi')->nullable()->after('old_ishi_joyi');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('Menyu_relative')) {
            Schema::table('Menyu_relative', function (Blueprint $table) {
                if (Schema::hasColumn('Menyu_relative', 'old_lavozimi')) {
                    $table->dropColumn('old_lavozimi');
                }
                if (Schema::hasColumn('Menyu_relative', 'old_ishi_joyi')) {
                    $table->dropColumn('old_ishi_joyi');
                }
            });
        }
    }
};
