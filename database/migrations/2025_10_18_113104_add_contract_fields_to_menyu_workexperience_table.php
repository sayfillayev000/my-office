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
        Schema::table('Menyu_workexperience', function (Blueprint $table) {
            $table->string('shartnoma_raqami')->nullable()->after('employee_id');
            $table->date('shartnoma_tuzilgan_sana')->nullable()->after('shartnoma_raqami');
        });
    }

    public function down()
    {
        Schema::table('Menyu_workexperience', function (Blueprint $table) {
            $table->dropColumn(['shartnoma_raqami', 'shartnoma_tuzilgan_sana']);
        });
    }
};
