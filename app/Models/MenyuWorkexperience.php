<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenyuWorkexperience extends Model
{
    protected $table = 'Menyu_workexperience';
    
    // protected $guarded = []; // Bu xavfli, o'rniga fillable ishlating
    protected $fillable = [
        'tashkilot_nomi',
        'lavozim', 
        'kirgan_sanasi',
        'boshagan_sanasi',
        'current_job',
        'employee_id',
        'shartnoma_raqami',        // YANGI
        'shartnoma_tuzilgan_sana'  // YANGI
    ];

    protected $casts = [
        'kirgan_sanasi' => 'date',
        'boshagan_sanasi' => 'date',
        'current_job' => 'boolean',
        'shartnoma_tuzilgan_sana' => 'date', // YANGI
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}