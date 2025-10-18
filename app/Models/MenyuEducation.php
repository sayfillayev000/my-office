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
        'certificate_number',  // Bu ustun mavjudligiga ishonch hosil qiling
        'certificate_date',    // Bu ustun mavjudligiga ishonch hosil qiling
        'faculty_name',
        'speciality',
        'languages_data'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'issue_date' => 'date',
        'certificate_date' => 'date',
        'languages_data' => 'array',
    ];

    // Automatik ravishda faculty_name va speciality ni to'ldirish
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($education) {
            // Agar faculty_id bo'lsa, faculty nomini olish
            if ($education->faculty_id && empty($education->faculty_name)) {
                $faculty = \App\Models\MenyuFaculty::find($education->faculty_id);
                if ($faculty) {
                    $education->faculty_name = $faculty->name;
                }
            }

            // Agar speciality_id bo'lsa, speciality nomini olish
            if ($education->speciality_id && empty($education->speciality)) {
                $speciality = \App\Models\MenyuSpeciality::find($education->speciality_id);
                if ($speciality) {
                    $education->speciality = $speciality->name;
                }
            }

            // Agar hali ham faculty_name bo'sh bo'lsa, default qiymat berish
            if (empty($education->faculty_name)) {
                $education->faculty_name = 'Noma\'lum';
            }

            // Agar hali ham speciality bo'sh bo'lsa, default qiymat berish
            if (empty($education->speciality)) {
                $education->speciality = 'Noma\'lum';
            }
        });

        static::updating(function ($education) {
            // Yangilash paytida ham nomlarni yangilash
            if ($education->faculty_id && empty($education->faculty_name)) {
                $faculty = \App\Models\MenyuFaculty::find($education->faculty_id);
                if ($faculty) {
                    $education->faculty_name = $faculty->name;
                }
            }

            if ($education->speciality_id && empty($education->speciality)) {
                $speciality = \App\Models\MenyuSpeciality::find($education->speciality_id);
                if ($speciality) {
                    $education->speciality = $speciality->name;
                }
            }
        });
    }

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
}