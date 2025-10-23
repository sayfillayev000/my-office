<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenyuEmployeeadditionalinfo extends Model
{
    protected $table = 'Menyu_employeeadditionalinfo';
    // Explicit fillable to make migrations and controllers safer
    protected $fillable = [
        'employee_id', 'old_job_exit_reason', 'other_exit_reason', 'davlat_mukofoti', 'haydovchilik_guvohnomasi',
        'soliq_id', 'inps', 'qiziqishlari', 'akfa_tanish', 'akfa_tanish_ism', 'akfa_tanish_lavozim', 'shaxsiy_avtomobil',
        'sudlanganmi', 'sudlanganlik_sana', 'boy', 'vazn', 'bosh_razmer', 'kostyum_razmer', 'poyabzal_razmer',
    'telegram_username', 'exit_reasons', 'conviction_document_path', 'insanity_certificate_path', 'tanish_ism', 'tanish_telfoni', 'sudlanganlik_sabab'
    ];

    protected $casts = [
        'akfa_tanish' => 'boolean',
        'sudlanganmi' => 'boolean',
        'exit_reasons' => 'array'
    ];

    public function employee()
    {
        return $this->belongsTo(User::class);
    }
}
