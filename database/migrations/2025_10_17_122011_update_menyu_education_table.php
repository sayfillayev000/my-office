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
            $table->foreignId('faculty_id')->nullable()->constrained('Menyu_faculty')->nullOnDelete();
            $table->foreignId('speciality_id')->nullable()->constrained('Menyu_speciality')->nullOnDelete();
            $table->foreignId('college_id')->nullable()->constrained('Menyu_college')->nullOnDelete();
            $table->foreignId('school_id')->nullable()->constrained('Menyu_school')->nullOnDelete();
            $table->integer('course')->nullable()->comment('Kurs raqami (1-4)');
            $table->string('education_type')->nullable()->comment('Ta\'lim turi: bachelor, master, secondary_special, secondary');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
