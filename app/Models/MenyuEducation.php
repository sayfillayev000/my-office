<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenyuEducation extends Model
{
    use HasFactory;

    protected $table = 'Menyu_education';
    public $timestamps = true;

    protected $fillable = [
        'employee_id',
        'degree_type',
        'university_id',
        'faculty_id',
        'speciality_id',
        'college_id',
        'school_id',
        'course',
        'start_date',
        'end_date',
        'diploma_number',
        'issue_date',
        'certificate_number',
        'certificate_date',
        'faculty_name',
        'speciality',  // Bu maydon muhim!
        'languages_data'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'issue_date' => 'date',
        'certificate_date' => 'date',
        'languages_data' => 'array',
    ];

    // Boot metodini soddalashtiramiz
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($education) {
            // Faculty nomini to'ldirish
            if ($education->faculty_id && empty($education->faculty_name)) {
                $faculty = \App\Models\MenyuFaculty::find($education->faculty_id);
                $education->faculty_name = $faculty ? $faculty->name : 'Noma\'lum';
            }

            // Mutaxassislik nomini to'ldirish
            if ($education->speciality_id && empty($education->speciality)) {
                $speciality = \App\Models\MenyuSpeciality::find($education->speciality_id);
                $education->speciality = $speciality ? $speciality->name : 'Noma\'lum';
            }
        });
    }

    // Aloqalarni to'g'ri belgilash
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function university()
    {
        return $this->belongsTo(MenyuUniversity::class, 'university_id');
    }

    public function faculty()
    {
        return $this->belongsTo(MenyuFaculty::class, 'faculty_id');
    }

    public function specialityRelation()
    {
        return $this->belongsTo(MenyuSpeciality::class, 'speciality_id');
    }

    public function college()
    {
        return $this->belongsTo(MenyuCollege::class, 'college_id');
    }

    public function school()
    {
        return $this->belongsTo(MenyuSchool::class, 'school_id');
    }

    // Mutaxassislikni olish uchun qo'shimcha metod
    public function getSpecialityNameAttribute()
    {
        return $this->speciality ?? $this->specialityRelation?->name ?? 'Noma\'lum';
    }
}