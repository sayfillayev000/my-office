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
        Schema::create('Menyu_employeeadditionalinfo', function (Blueprint $table) {
            $table->id();
            $table->string('old_job_exit_reason')->nullable();
            $table->string('other_exit_reason')->nullable();
            $table->string('davlat_mukofoti')->nullable();
            $table->string('haydovchilik_guvohnomasi')->nullable();
            $table->string('soliq_id')->nullable();
            $table->string('inps')->nullable();
            $table->string('qiziqishlari')->nullable();

            // To‘g‘ri variant
            $table->boolean('akfa_tanish')->default(false);
            $table->string('akfa_tanish_ism')->nullable();
            $table->string('akfa_tanish_lavozim')->nullable();

            $table->boolean('sudlanganmi')->default(false);
            $table->date('sudlanganlik_sana')->nullable();
            $table->string('boy')->nullable();
            $table->string('vazn')->nullable();
            $table->string('bosh_razmer')->nullable();
            $table->string('kostyum_razmer')->nullable();
            $table->string('poyabzal_razmer')->nullable();
            $table->string('telegram_username')->nullable();

            $table->foreignId('employee_id')->constrained('Menyu_employee')->cascadeOnDelete();

            $table->string('sudlanganlik_sabab')->nullable();
            $table->string('tanish_ism')->nullable();
            $table->string('tanish_telfoni')->nullable();

            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Menyu_employeeadditionalinfo');
    }
};
