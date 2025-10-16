<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenyuMilitaryrecord extends Model
{
    protected $table = 'Menyu_militaryrecord';
    protected $guarded = [];

    public function employee()
    {
        return $this->belongsTo(User::class);
    }
}
