<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenyuRegion extends Model
{
    protected $table = 'Menyu_region';
    protected $guarded = [];

    // expose virtual 'name' attribute (prefer Uzbek name, fallback to others)
    protected $appends = ['name'];

    public function getNameAttribute()
    {
        return $this->name_uz ?? $this->name_ru ?? $this->name_oz ?? null;
    }

    public function districts()
    {
        return $this->hasMany(MenyuDistrict::class, 'region_id');
    }
}
