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
        Schema::table('Menyu_relative', function (Blueprint $table) {
            // Yangi fieldlarni qo'shish
            $table->string('tugilgan_joy_viloyat')->nullable()->after('tugilgan_joy_soato');
            $table->string('tugilgan_joy_tuman')->nullable()->after('tugilgan_joy_viloyat');
            $table->string('tugilgan_joy_qishloq')->nullable()->after('tugilgan_joy_tuman');
            $table->boolean('nafaqada')->default(false)->after('lavozimi');
            $table->boolean('oqishda')->default(false)->after('nafaqada');
            $table->string('oquv_yurti')->nullable()->after('oqishda');
            
            // Mavjud fieldni nullable qilish (agar kerak bo'lsa)
            $table->string('tugilgan_joy_soato')->nullable()->change();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menu_relatives', function (Blueprint $table) {
            //
        });
    }
};
