<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeTurniketSetting extends Model
{
    use HasFactory;

    protected $table = 'Menyu_employee_turniket_settings';

    protected $fillable = [
        'employee_id',
        'turniketsettings_id',
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function turniket()
    {
        return $this->belongsTo(Turniket::class, 'turniketsettings_id');
    }
}


