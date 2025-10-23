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
        // Add columns only if they do not exist yet
        if (!Schema::hasTable('Menyu_relative')) {
            // Table doesn't exist — nothing to do here
            return;
        }

        // otasi_ismi (father name) — missing and required by the form
        if (!Schema::hasColumn('Menyu_relative', 'otasi_ismi')) {
            Schema::table('Menyu_relative', function (Blueprint $table) {
                $table->string('otasi_ismi')->nullable()->after('ismi');
            });
        }

        // Tugilgan joy fields
        if (!Schema::hasColumn('Menyu_relative', 'tugilgan_joy_viloyat')) {
            Schema::table('Menyu_relative', function (Blueprint $table) {
                $table->string('tugilgan_joy_viloyat')->nullable()->after('tugilgan_joy_soato');
            });
        }

        if (!Schema::hasColumn('Menyu_relative', 'tugilgan_joy_tuman')) {
            Schema::table('Menyu_relative', function (Blueprint $table) {
                $table->string('tugilgan_joy_tuman')->nullable()->after('tugilgan_joy_viloyat');
            });
        }

        if (!Schema::hasColumn('Menyu_relative', 'tugilgan_joy_qishloq')) {
            Schema::table('Menyu_relative', function (Blueprint $table) {
                $table->string('tugilgan_joy_qishloq')->nullable()->after('tugilgan_joy_tuman');
            });
        }

        // Naqafada/oqishda flags and oquv_yurti
        if (!Schema::hasColumn('Menyu_relative', 'nafaqada')) {
            Schema::table('Menyu_relative', function (Blueprint $table) {
                $table->boolean('nafaqada')->default(false)->after('lavozimi');
            });
        }

        if (!Schema::hasColumn('Menyu_relative', 'oqishda')) {
            Schema::table('Menyu_relative', function (Blueprint $table) {
                $table->boolean('oqishda')->default(false)->after('nafaqada');
            });
        }

        if (!Schema::hasColumn('Menyu_relative', 'oquv_yurti')) {
            Schema::table('Menyu_relative', function (Blueprint $table) {
                $table->string('oquv_yurti')->nullable()->after('oqishda');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasTable('Menyu_relative')) {
            return;
        }

        Schema::table('Menyu_relative', function (Blueprint $table) {
            if (Schema::hasColumn('Menyu_relative', 'otasi_ismi')) {
                $table->dropColumn('otasi_ismi');
            }
            if (Schema::hasColumn('Menyu_relative', 'tugilgan_joy_viloyat')) {
                $table->dropColumn('tugilgan_joy_viloyat');
            }
            if (Schema::hasColumn('Menyu_relative', 'tugilgan_joy_tuman')) {
                $table->dropColumn('tugilgan_joy_tuman');
            }
            if (Schema::hasColumn('Menyu_relative', 'tugilgan_joy_qishloq')) {
                $table->dropColumn('tugilgan_joy_qishloq');
            }
            if (Schema::hasColumn('Menyu_relative', 'nafaqada')) {
                $table->dropColumn('nafaqada');
            }
            if (Schema::hasColumn('Menyu_relative', 'oqishda')) {
                $table->dropColumn('oqishda');
            }
            if (Schema::hasColumn('Menyu_relative', 'oquv_yurti')) {
                $table->dropColumn('oquv_yurti');
            }
        });
    }
};
