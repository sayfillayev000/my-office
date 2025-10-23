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
        Schema::table('Menyu_passportinfo', function (Blueprint $table) {
            $table->string('seria_raqam')->nullable()->change();
            $table->string('kim_tomonidan_berilgan')->nullable()->change();
            $table->date('berilgan_sana')->nullable()->change();
            $table->date('amal_qilish_muddati')->nullable()->change();
            $table->string('doimiy_yashash_joyi')->nullable()->change();
            $table->string('yashash_joyi')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('Menyu_passportinfo', function (Blueprint $table) {
            $table->string('seria_raqam')->nullable(false)->change();
            $table->string('kim_tomonidan_berilgan')->nullable(false)->change();
            $table->date('berilgan_sana')->nullable(false)->change();
            $table->date('amal_qilish_muddati')->nullable(false)->change();
            $table->string('doimiy_yashash_joyi')->nullable(false)->change();
            $table->string('yashash_joyi')->nullable(false)->change();
        });
    }
};
