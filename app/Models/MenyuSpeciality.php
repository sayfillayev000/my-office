<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenyuSpeciality extends Model
{
    use HasFactory;

    protected $table = 'Menyu_speciality';
    
    protected $fillable = ['name', 'faculty_id'];

    public function faculty()
    {
        return $this->belongsTo(MenyuFaculty::class);
    }
}