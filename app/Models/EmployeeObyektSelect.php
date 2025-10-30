<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeObyektSelect extends Model
{
    use HasFactory;

    protected $table = 'Menyu_employeeobyektselect';

    protected $fillable = [
        'select',
        'create_time',
        'employee_id',
        'obyekt_id',
    ];

    protected $casts = [
        'create_time' => 'datetime',
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function obyect()
    {
        return $this->belongsTo(Obyect::class, 'obyekt_id');
    }
}


