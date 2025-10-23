<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenyuPassportinfo extends Model
{
    protected $table = 'Menyu_passportinfo';
    protected $guarded = [];

    public function employee()
    {
        return $this->belongsTo(User::class);
    }
}
