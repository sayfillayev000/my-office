<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KitchenCheckLog extends Model
{
    use HasFactory;

    protected $table = 'Menyu_kitchenchecklog';

    protected $fillable = [
        'date',
        'employee_id',
        'turniket_id',
        'organization_id',
        'door_schedule',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function turniket()
    {
        return $this->belongsTo(Turniket::class, 'turniket_id');
    }

    public function organization()
    {
        return $this->belongsTo(MenyuOrganization::class, 'organization_id');
    }
}


