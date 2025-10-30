<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkerLog extends Model
{
    use HasFactory;

    protected $table = 'Menyu_workerlog';

    protected $fillable = [
        'worker_id',
        'date',
        'photo',
        'object_name',
        'object_id',
        'latitude',
        'longitude',
        'door',
        'organization_id',
        'update_status',
        'obyect_project',
        'tashkilot_id',
        'turniket_id',
    ];

    protected $casts = [
        'date' => 'datetime',
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    public function project()
    {
        return $this->belongsTo(ObyectProject::class, 'obyect_project');
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


