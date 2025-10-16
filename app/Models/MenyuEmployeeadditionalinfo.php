<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenyuEmployeeadditionalinfo extends Model
{
    protected $table = 'Menyu_employeeadditionalinfo';
    protected $guarded = [];

    public function employee()
    {
        return $this->belongsTo(User::class);
    }
}
