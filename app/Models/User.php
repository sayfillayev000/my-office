<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $table = 'Menyu_employee';
    protected $guard_name = 'web';
    public $timestamps = true; // Spatie table-ga yozuvlar uchun true qilamiz

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
        'tab_number',
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
        'car_number',
        's_bolim_id',
        's_tashkilot_id',
        'department_fk_id',
        'extradepartment_fk',
        'position_fk_id',
        'tashkilot_fk_id',
        'status_card_image',
        'door_schedule_ids',
        'passport_file_path'
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
     * Bir nechta organization bilan ko‘p-ko‘p aloqasi (pivot orqali role_id saqlanadi)
     */
    public function organizations()
    {
        return $this->belongsToMany(
            MenyuOrganization::class,
            'organization_role',
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
                    ->map(fn($org) => Role::find($org->pivot->role_id));
    }

    /*
     * Spatie roles bilan bog‘lash va biriktirish
     */
    public function assignRoleToEmployee(Role $role): bool
    {
        try {
            // Spatie table-ga yoziladi
            $this->assignRole($role->name);

            // Cache tozalash
            app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

            return true;
        } catch (\Exception $e) {
            \Log::error('Role assignment failed', [
                'error' => $e->getMessage(),
                'role_id' => $role->id,
                'employee_id' => $this->id,
            ]);
            return false;
        }
    }

    /*
     * Cache tozalash
     */
    public function clearPermissionCache()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }

    /*
     * ========= Relational aloqalar ==========
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

    public function employeeReasonItems()
    {
        return $this->hasMany(EmployeeReasonItem::class, 'employee_id');
    }
    
}
