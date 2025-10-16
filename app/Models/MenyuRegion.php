<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenyuRegion extends Model
{
    protected $table = 'Menyu_region';
    protected $guarded = [];

    public function districts()
    {
        return $this->hasMany(MenyuDistrict::class, 'region_id');
    }
}
