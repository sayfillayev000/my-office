<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turniket extends Model
{
    use HasFactory;

    protected $table = 'Menyu_turniketsettings';

    protected $fillable = [
        'name',
        'turniket_ip',
        'local_ip',
        'turniket_username',
        'turniket_password',
        'door_status',
        'organization_id',
        'turniket_obyect_id',
        'oshxona_turniket',
        'types',
    ];

    protected $casts = [
        'oshxona_turniket' => 'boolean',
    ];

    public function organization()
    {
        return $this->belongsTo(MenyuOrganization::class, 'organization_id');
    }

    public function obyect()
    {
        return $this->belongsTo(Obyect::class, 'turniket_obyect_id');
    }
}


