<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenyuDistrict extends Model
{
    protected $table = 'Menyu_district';
    protected $guarded = [];

    // expose virtual 'name' attribute (prefer Uzbek name, fallback to others)
    protected $appends = ['name'];

    public function getNameAttribute()
    {
        return $this->name_uz ?? $this->name_ru ?? $this->name_oz ?? null;
    }

    public function region()
    {
        return $this->belongsTo(MenyuRegion::class, 'region_id');
    }

    public function villages()
    {
        return $this->hasMany(MenyuVillage::class, 'district_id');
    }
}
