<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenyuEducation extends Model
{
    protected $table = 'Menyu_education';
    protected $guarded = [];
    protected $casts = [
        'languages_data' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
        'issue_date' => 'date',
    ];

    public function employee()
    {
        return $this->belongsTo(User::class);
    }

    public function university()
    {
        return $this->belongsTo(MenyuUniversity::class, 'university_id');
    }
}
