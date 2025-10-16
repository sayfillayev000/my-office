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
          Schema::create('Menyu_education', function (Blueprint $table) {
            $table->id();
            $table->string('degree_type');
            $table->string('faculty_name');
            $table->string('speciality');
            $table->string('diploma_number');
            $table->date('start_date');
            $table->date('end_date');
            $table->date('issue_date');
            $table->foreignId('employee_id')->constrained('Menyu_employee')->cascadeOnDelete();
            $table->foreignId('university_id')->constrained('Menyu_university')->cascadeOnDelete();
            $table->jsonb('languages_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Menyu_education');
    }
};
