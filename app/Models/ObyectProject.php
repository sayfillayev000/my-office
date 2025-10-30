<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObyectProject extends Model
{
    use HasFactory;

    protected $table = 'Menyu_obyectproject';

    protected $fillable = [
        'name',
        'obyect_id',
    ];

    public function obyect()
    {
        return $this->belongsTo(Obyect::class, 'obyect_id');
    }
}


