<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeReason extends Model
{
    protected $table = 'employee_reasons';
    
    protected $fillable = [
        'name',
        'color',
        'description',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function employeeReasonItems()
    {
        return $this->hasMany(EmployeeReasonItem::class, 'reason_id');
    }
}

