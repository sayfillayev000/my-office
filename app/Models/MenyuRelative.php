<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenyuRelative extends Model
{
    protected $table = 'Menyu_relative';
    protected $guarded = [];

    public function employee()
    {
        return $this->belongsTo(User::class);
    }
}
