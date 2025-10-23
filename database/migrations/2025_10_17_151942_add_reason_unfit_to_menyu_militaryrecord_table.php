<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
     public function up()
    {
        Schema::table('Menyu_militaryrecord', function (Blueprint $table) {
            $table->text('reason_unfit')->nullable()->after('maxsus_xisob');
        });
    }

    /**
     * Reverse the migrations.
     */
       public function down()
    {
        Schema::table('Menyu_militaryrecord', function (Blueprint $table) {
            $table->dropColumn('reason_unfit');
        });
    }
};
