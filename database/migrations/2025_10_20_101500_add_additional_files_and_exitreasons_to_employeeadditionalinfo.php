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
        Schema::table('Menyu_employeeadditionalinfo', function (Blueprint $table) {
            if (!Schema::hasColumn('Menyu_employeeadditionalinfo', 'exit_reasons')) {
                $table->json('exit_reasons')->nullable()->after('qiziqishlari');
            }
            if (!Schema::hasColumn('Menyu_employeeadditionalinfo', 'conviction_document_path')) {
                $table->string('conviction_document_path')->nullable()->after('sudlanganlik_sabab');
            }
            if (!Schema::hasColumn('Menyu_employeeadditionalinfo', 'insanity_certificate_path')) {
                $table->string('insanity_certificate_path')->nullable()->after('conviction_document_path');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Menyu_employeeadditionalinfo', function (Blueprint $table) {
            if (Schema::hasColumn('Menyu_employeeadditionalinfo', 'exit_reasons')) {
                $table->dropColumn('exit_reasons');
            }
            if (Schema::hasColumn('Menyu_employeeadditionalinfo', 'conviction_document_path')) {
                $table->dropColumn('conviction_document_path');
            }
            if (Schema::hasColumn('Menyu_employeeadditionalinfo', 'insanity_certificate_path')) {
                $table->dropColumn('insanity_certificate_path');
            }
        });
    }
};
