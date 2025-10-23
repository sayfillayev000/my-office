<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOldJobColumnsToMenyuRelatives extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('menyu_relatives')) {
            Schema::table('menyu_relatives', function (Blueprint $table) {
                if (!Schema::hasColumn('menyu_relatives', 'old_ishi_joyi')) {
                    $table->string('old_ishi_joyi')->nullable()->after('ishi_joyi');
                }
                if (!Schema::hasColumn('menyu_relatives', 'old_lavozimi')) {
                    $table->string('old_lavozimi')->nullable()->after('old_ishi_joyi');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('menyu_relatives')) {
            Schema::table('menyu_relatives', function (Blueprint $table) {
                if (Schema::hasColumn('menyu_relatives', 'old_lavozimi')) {
                    $table->dropColumn('old_lavozimi');
                }
                if (Schema::hasColumn('menyu_relatives', 'old_ishi_joyi')) {
                    $table->dropColumn('old_ishi_joyi');
                }
            });
        }
    }
}
