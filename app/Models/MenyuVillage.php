<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenyuVillage extends Model
{
    protected $table = 'Menyu_village';
    protected $guarded = [];

    public function district()
    {
        return $this->belongsTo(MenyuDistrict::class, 'district_id');
    }
}
