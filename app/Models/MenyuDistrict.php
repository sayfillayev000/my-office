<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenyuDistrict extends Model
{
    protected $table = 'Menyu_district';
    protected $guarded = [];

    public function region()
    {
        return $this->belongsTo(MenyuRegion::class, 'region_id');
    }

    public function villages()
    {
        return $this->hasMany(MenyuVillage::class, 'district_id');
    }
}
