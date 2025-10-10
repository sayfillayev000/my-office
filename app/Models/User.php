<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'Menyu_employee';

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'department',
        'position',
        'phone',
        'image',
        'floor',
        'room',
        'embedding',
        'parking',
        'office',
        'worker_and_time',
        'organization_id',
        'night_working',
        'tashkilot',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'parking' => 'boolean',
            'office' => 'boolean',
            'night_working' => 'boolean',
            'worker_and_time' => 'float',
        ];
    }

    public function username()
    {
        return 'phone';
    }
    public function organization()
    {
        return $this->belongsTo(MenyuOrganization::class, 'organization_id');
    }

}
