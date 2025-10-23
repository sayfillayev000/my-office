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
        Schema::table('Menyu_employeeadditionalinfo', function (Blueprint $table) {
            $table->boolean('parking')->default(false);
            $table->boolean('office')->default(false);
        });
    }

    public function down()
    {
        Schema::table('Menyu_employeeadditionalinfo', function (Blueprint $table) {
            $table->dropColumn(['parking', 'office']);
        });
    }
};
