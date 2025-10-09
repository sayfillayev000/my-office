<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; // <-- bu juda muhim
use Illuminate\Notifications\Notifiable;

class MenyuEmployee extends Authenticatable
{
    protected $table = 'Menyu_employee';
    protected $guarded = [];


    protected $hidden = [
        'password', // <-- xavfsizlik uchun parolni yashirish
        'remember_token',
    ];
}
