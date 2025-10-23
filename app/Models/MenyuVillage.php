<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenyuVillage extends Model
{
    protected $table = 'Menyu_village';
    protected $guarded = [];

    // expose virtual 'name' attribute (prefer Uzbek name, fallback to others)
    protected $appends = ['name'];

    public function getNameAttribute()
    {
        return $this->name_uz ?? $this->name_ru ?? $this->name_oz ?? null;
    }

    public function district()
    {
        return $this->belongsTo(MenyuDistrict::class, 'district_id');
    }
}
