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
            Schema::table('Menyu_employee', function (Blueprint $table) {
                // Shaxsiy ma'lumotlar
                $table->string('gender')->nullable()->after('middle_name');
                $table->date('birth_date')->nullable()->after('gender');
                $table->string('fnfl', 20)->nullable()->after('phone');
                
                // Ish vaqtlari
                $table->time('expected_arrival_time')->nullable()->after('worker_and_time');
                
                // Ishga olish/bo'shatish
                $table->date('hired_date')->nullable()->after('expected_arrival_time');
                $table->date('fired_date')->nullable()->after('hired_date');
                
                // Qo'shimcha bo'lim
                $table->string('extradepartment')->nullable()->after('department');
                
                // Card ma'lumotlari
                $table->string('cardnumber')->nullable()->after('fired_date');
                
                // Maosh ma'lumotlari
                $table->decimal('hourly_rate', 10, 2)->nullable()->after('cardnumber');
                $table->decimal('monthly_salary', 10, 2)->nullable()->after('hourly_rate');
                $table->boolean('salary_active')->default(false)->after('monthly_salary');
                
                // Yuz ma'lumotlari
                $table->binary('face1')->nullable()->after('salary_active');
                $table->binary('face2')->nullable()->after('face1');
                $table->binary('face3')->nullable()->after('face2');
                $table->boolean('updateface')->default(false)->after('face3');
                
                // Status va rasmlar
                $table->boolean('status')->default(true)->after('updateface');
                $table->text('thumbnail')->nullable()->after('status');
                $table->integer('turniket_image_status')->default(0)->after('thumbnail');
                $table->jsonb('unreachable_turniket_ids')->nullable()->after('turniket_image_status');
                $table->integer('status_card_image')->default(0)->after('unreachable_turniket_ids');
                
                // Tashkilot tuzilmasi
                $table->integer('s_bolim_id')->nullable()->after('status_card_image');
                $table->integer('s_tashkilot_id')->nullable()->after('s_bolim_id');
                $table->integer('department_fk_id')->nullable()->after('s_tashkilot_id');
                $table->string('extradepartment_fk')->nullable()->after('department_fk_id');
                $table->integer('position_fk_id')->nullable()->after('extradepartment_fk');
                $table->integer('tashkilot_fk_id')->nullable()->after('position_fk_id');
                
                // Jadval ma'lumotlari
                $table->jsonb('door_schedule_ids')->nullable()->after('tashkilot_fk_id');
                
                // Timestamps
                $table->timestamp('created_at')->nullable()->after('door_schedule_ids');
            });
        }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('Menyu_employee', function (Blueprint $table) {
            $table->dropColumn([
                'gender',
                'birth_date',
                'fnfl',
                'expected_arrival_time',
                'hired_date',
                'fired_date',
                'extradepartment',
                'cardnumber',
                'hourly_rate',
                'monthly_salary',
                'salary_active',
                'face1',
                'face2',
                'face3',
                'updateface',
                'status',
                'thumbnail',
                'turniket_image_status',
                'unreachable_turniket_ids',
                'status_card_image',
                's_bolim_id',
                's_tashkilot_id',
                'department_fk_id',
                'extradepartment_fk',
                'position_fk_id',
                'tashkilot_fk_id',
                'door_schedule_ids',
                'created_at'
            ]);
        });
    }
};
