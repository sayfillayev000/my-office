<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenyuUniversity extends Model
{
    protected $table = 'Menyu_university';
    protected $guarded = [];

    public function educations()
    {
        return $this->hasMany(MenyuEducation::class, 'university_id');
    }
}
