<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenyuCollege extends Model
{
    use HasFactory;

    protected $table = 'Menyu_college';
    
    protected $fillable = ['name', 'address', 'district_id'];

    public function district()
    {
        return $this->belongsTo(MenyuDistrict::class);
    }
}