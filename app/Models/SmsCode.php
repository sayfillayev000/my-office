<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsCode extends Model
{
    protected $table = 'sms_codes';
    protected $guarded = [];
    public $timestamps = true;
}