<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenyuSchool extends Model
{
    use HasFactory;

    protected $table = 'Menyu_school';
    
    protected $fillable = ['name', 'address', 'district_id'];

    public function district()
    {
        return $this->belongsTo(MenyuDistrict::class);
    }
}