<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class EmployeeReasonItem extends Model
{
    protected $table = 'employee_reason_items';
    
    protected $fillable = [
        'employee_id',
        'reason_id',
        'type',
        'start_date',
        'end_date',
        'start_datetime',
        'end_datetime',
        'comment'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'start_datetime' => 'datetime',
        'end_datetime' => 'datetime'
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function reason()
    {
        return $this->belongsTo(EmployeeReason::class, 'reason_id');
    }
}

