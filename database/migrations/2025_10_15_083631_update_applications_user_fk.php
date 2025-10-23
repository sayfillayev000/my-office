<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            // Eski foreign key’ni olib tashlaymiz
            $table->dropForeign(['user_id']);

            // Yangi foreign key qo‘shamiz
            $table->foreign('user_id')
                  ->references('id')
                  ->on('Menyu_employee')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            // Rollback uchun yangi FK’ni olib tashlaymiz
            $table->dropForeign(['user_id']);

            // Eski FK qaytadan qo‘shamiz
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }
};
