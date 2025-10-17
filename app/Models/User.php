<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $table = 'Menyu_employee';
    public $timestamps = false;

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
        'hourly_rate',
        'monthly_salary',
        'salary_active',
        'fnfl',
        'face1',
        'face2',
        'face3',
        'updateface',
        'status',
        'birth_date',
        'gender',
        'extradepartment',
        'expected_arrival_time',
        'cardnumber',
        'thumbnail',
        'turniket_image_status',
        'unreachable_turniket_ids',
        'created_at',
        'fired_date',
        'hired_date',
        's_bolim_id',
        's_tashkilot_id',
        'department_fk_id',
        'extradepartment_fk',
        'position_fk_id',
        'tashkilot_fk_id',
        'status_card_image',
        'door_schedule_ids'
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

    /*
     * Asosiy organization
     */
    public function organization()
    {
        return $this->belongsTo(MenyuOrganization::class, 'organization_id');
    }

    /*
     * Bir nechta organization bilan ko‘p-ko‘p aloqasi
     */
    public function organizations()
    {
        return $this->belongsToMany(
            MenyuOrganization::class,
            'organization_user_role',
            'user_id',
            'organization_id'
        )->withPivot('role_id')->withTimestamps();
    }

    /*
     * Berilgan organizationdagi foydalanuvchi roli(lar)i
     */
    public function rolesInOrganization($orgId)
    {
        return $this->organizations()
                    ->wherePivot('organization_id', $orgId)
                    ->get()
                    ->map(fn($org) => \Spatie\Permission\Models\Role::find($org->pivot->role_id));
    }

    /*
     * ========== Relational aloqalar ==========
     */

    public function educations()
    {
        return $this->hasMany(MenyuEducation::class, 'employee_id');
    }

    public function workExperiences()
    {
        return $this->hasMany(MenyuWorkexperience::class, 'employee_id');
    }

    public function relatives()
    {
        return $this->hasMany(MenyuRelative::class, 'employee_id');
    }

    public function militaryRecord()
    {
        return $this->hasOne(MenyuMilitaryrecord::class, 'employee_id');
    }

    public function passportInfo()
    {
        return $this->hasOne(MenyuPassportinfo::class, 'employee_id');
    }

    public function additionalInfo()
    {
        return $this->hasOne(MenyuEmployeeadditionalinfo::class, 'employee_id');
    }
}
