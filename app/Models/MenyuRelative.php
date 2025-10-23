<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenyuRelative extends Model
{
    use HasFactory;

    protected $table = 'Menyu_relative';
    
    protected $fillable = [
        'qarindoshlik',
        'familiyasi',
        'ismi',
        'otasi_ismi',
        'tugilgan_yili',
        'tugilgan_joy_viloyat',
        'tugilgan_joy_tuman',
        'tugilgan_joy_qishloq',
        'tugilgan_joy_soato',
        'ishi_joyi',
        'lavozimi',
        'nafaqada',
        'oqishda',
        'oquv_yurti',
        'old_ishi_joyi',
        'old_lavozimi',
        'employee_id'
    ];

    protected $casts = [
        'nafaqada' => 'boolean',
        'oqishda' => 'boolean',
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}

