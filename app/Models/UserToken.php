<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserToken extends Model
{
    protected $fillable = ['employee_id', 'session_key_id', 'expires_at'];
}
