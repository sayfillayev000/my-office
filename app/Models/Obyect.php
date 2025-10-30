<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obyect extends Model
{
    use HasFactory;

    protected $table = 'Menyu_obyect';

    protected $fillable = [
        'name',
        'coordinates',
        'organization_id',
        'bolim_id',
    ];

    public function organization()
    {
        return $this->belongsTo(MenyuOrganization::class, 'organization_id');
    }

    public function bolim()
    {
        return $this->belongsTo(ObyektBolim::class, 'bolim_id');
    }

    public function projects()
    {
        return $this->hasMany(ObyectProject::class, 'obyect_id');
    }
}


