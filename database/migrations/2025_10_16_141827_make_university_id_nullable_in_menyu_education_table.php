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
        Schema::table('Menyu_education', function (Blueprint $table) {
            $table->foreignId('university_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('Menyu_education', function (Blueprint $table) {
            $table->foreignId('university_id')->nullable(false)->change();
        });
    }
};
