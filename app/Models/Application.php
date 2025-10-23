<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = ['user_id', 'status', 'message'];

    public function user()
    {
        // User modeli aslida Menyu_employee jadvali bilan bog‘liq
        return $this->belongsTo(User::class, 'user_id');
    } 
}