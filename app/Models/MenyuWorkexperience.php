<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenyuWorkexperience extends Model
{
    protected $table = 'Menyu_workexperience';
    protected $guarded = [];

    public function employee()
    {
        return $this->belongsTo(User::class);
    }
}
