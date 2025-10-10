<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenyuOrganization extends Model
{
    protected $table = 'Menyu_organization';

    protected $fillable = [
        'name',
        'password',
        'user_id',
        'robot_auto',
        'turniket',
        'last_check',
        'last_time',
        'non_workdays',
        'extra_user',
        'user_ids',
        'subdomain',
    ];

    public function employees()
    {
        return $this->hasMany(User::class, 'organization_id');
    }
}
