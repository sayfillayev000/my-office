<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenyuFaculty extends Model
{
    use HasFactory;

    protected $table = 'Menyu_faculty';
    
    protected $fillable = ['name', 'university_id'];

    public function university()
    {
        return $this->belongsTo(MenyuUniversity::class);
    }

    public function specialities()
    {
        return $this->hasMany(MenyuSpeciality::class);
    }
}