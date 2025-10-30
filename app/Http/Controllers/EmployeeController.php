<?php

namespace App\Http\Controllers;

use App\Models\MenyuCollege;
use App\Models\MenyuDistrict;
use App\Models\MenyuEducation;
use App\Models\MenyuFaculty;
use App\Models\MenyuOrganization;
use App\Models\MenyuRegion;
use App\Models\MenyuRelative;
use App\Models\MenyuSchool;
use App\Models\MenyuSpeciality;
use App\Models\MenyuUniversity;
use App\Models\MenyuVillage;
use App\Models\MenyuWorkexperience;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    #[Middleware('permission:employee.view', only: ['index', 'show'])]
    #[Middleware('permission:employee.create', only: ['create', 'store'])]
    #[Middleware('permission:employee.edit', only: ['edit', 'update'])]
    #[Middleware('permission:employee.delete', only: ['destroy'])]
    public function __construct()
    {
        //
    }

    public function index(Request $request)
    {
        $query = User::with('organization');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function($q) use ($search) {
                $q->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$search}%"])
                ->orWhere('first_name', 'LIKE', "%{$search}%")
                ->orWhere('last_name', 'LIKE', "%{$search}%")
                ->orWhere('phone', 'LIKE', "%{$search}%")
                ->orWhere('position', 'LIKE', "%{$search}%")
                ->orWhere('department', 'LIKE', "%{$search}%")
                ->orWhereHas('organization', function($q2) use ($search) {
                    $q2->where('name', 'LIKE', "%{$search}%");
                });
            });
        }

        $employees = $query->paginate(10)->withQueryString();

        return view('pages.employee.index', compact('employees'));
    }

    public function create()
    {
        return view('pages.employee.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'position'   => 'nullable|string|max:255',
            'organization_id' => 'nullable|exists:Menyu_organization,id',
            'image'      => 'nullable|image|max:2048',
        ]);

        if($request->hasFile('image')){
            $data['image'] = $request->file('image')->store('employees', 'public');
        }

        User::create($data);

        return redirect()->route('employees.index')->with('success', 'Xodim qo‘shildi!');
    }

    public function show(User $employee)
    {
        try {
            Log::info('=== SHOW METHOD CALLED ===');
            Log::info('Loading employee data for ID: ' . $employee->id);
            
            // Har bir relationshipni alohida yuklab ko'ramiz
            $employee->load([
                'organization',
                'passportInfo',
                'additionalInfo',
                'militaryRecord',
                'educations.university',
                'educations.faculty', 
                'educations.specialityRelation',
                'educations.college',
                'educations.school',
                'workExperiences',
                'relatives'
            ]);
    
            Log::info('Employee loaded successfully');
    
            $response = [
                'id' => $employee->id,
                'last_name' => $employee->last_name ?? '-',
                'first_name' => $employee->first_name ?? '-',
                'middle_name' => $employee->middle_name ?? '-',
                'phone' => $employee->phone ?? '-',
                'position' => $employee->position ?? '-',
                'department' => $employee->department ?? '-',
                'birth_date' => $employee->birth_date ?? null,
                'gender' => $employee->gender ?? '-',
                'fnfl' => $employee->fnfl ?? '-',
                'tab_number' => $employee->tab_number ?? '-',
                'organization' => $employee->organization->name ?? '-',
                'image' => $employee->image && file_exists(public_path('storage/' . $employee->image))
                    ? asset('storage/' . $employee->image)
                    : asset('assets/img/modern-ai-image/user-3.jpg'),
    
                // Pasport ma'lumotlari
                'passport' => [
                    'seria_raqam' => $employee->passportInfo->seria_raqam ?? '-',
                    'kim_tomonidan_berilgan' => $employee->passportInfo->kim_tomonidan_berilgan ?? '-',
                    'berilgan_sana' => $employee->passportInfo->berilgan_sana ?? null,
                    'amal_qilish_muddati' => $employee->passportInfo->amal_qilish_muddati ?? null,
                    'doimiy_yashash_joyi' => $employee->passportInfo->doimiy_yashash_joyi ?? '-',
                    'yashash_joyi' => $employee->passportInfo->yashash_joyi ?? '-',
                ],
    
                // Harbiy ma'lumotlar
                'military' => [
                    'category' => $employee->militaryRecord->hisob_toifasi ?? '-',
                    'rank' => $employee->militaryRecord->harbiy_unvoni ?? '-',
                    'composition' => $employee->militaryRecord->qoshin_turi ?? '-',
                    'accounting_group' => $employee->militaryRecord->hisob_guruhi ?? '-',
                    'military_speciality' => $employee->militaryRecord->harbiy_mutaxassislik ?? '-',
                    'suitable' => $employee->militaryRecord->xizmatga_yaroqliligi ?? '-',
                    'reason_unfit' => $employee->militaryRecord->reason_unfit ?? '-',
                ],
    
                // Ta'lim ma'lumotlari
                'educations' => $employee->educations->map(function($education) {
                    // O'quv yurti nomini aniqlash
                    $institutionName = '-';
                    if ($education->university && $education->university->name) {
                        $institutionName = $education->university->name;
                    } elseif ($education->college && $education->college->name) {
                        $institutionName = $education->college->name;
                    } elseif ($education->school && $education->school->name) {
                        $institutionName = $education->school->name;
                    }
    
                    // Fakultet nomini aniqlash
                    $facultyName = $education->faculty_name ?? '-';
                    if ($education->faculty && $education->faculty->name) {
                        $facultyName = $education->faculty->name;
                    }
    
                    // Mutaxassislik nomini aniqlash
                    $specialityName = $education->speciality ?? '-';
                    if ($education->specialityRelation && $education->specialityRelation->name) {
                        $specialityName = $education->specialityRelation->name;
                    }
    
                    return [
                        'type' => $education->degree_type ?? '-',
                        'education_type' => $education->education_type ?? '-',
                        'university' => $institutionName,
                        'faculty' => $facultyName,
                        'speciality' => $specialityName,
                        'diploma_number' => $education->diploma_number ?? '-',
                        'start_date' => $education->start_date ?? null,
                        'end_date' => $education->end_date ?? null,
                        'issue_date' => $education->issue_date ?? null,
                        'course' => $education->course ?? null,
                    ];
                })->toArray(),
    
                // Ish tajribasi
                'work_experiences' => $employee->workExperiences->map(function($work) {
                    return [
                        'organization' => $work->tashkilot_nomi ?? '-',
                        'position' => $work->lavozim ?? '-',
                        'start_date' => $work->kirgan_sanasi ?? null,
                        'end_date' => $work->boshagan_sanasi ?? null,
                        'current_job' => $work->current_job ? 'Ha' : 'Yo\'q',
                        'contract_number' => $work->shartnoma_raqami ?? '-',
                        'contract_date' => $work->shartnoma_tuzilgan_sana ?? null,
                    ];
                })->toArray(),
    
                // Qarindoshlar
                'relatives' => $employee->relatives->map(function($relative) {
                    return [
                        'qarindoshlik' => $relative->qarindoshlik ?? '-',
                        'familiyasi' => $relative->familiyasi ?? '-',
                        'ismi' => $relative->ismi ?? '-',
                        'otasi_ismi' => $relative->otasi_ismi ?? $relative->sharfi ?? '-',
                        'tugilgan_yili' => $relative->tugilgan_yili ?? '-',
                        'tugilgan_joy_viloyat' => $relative->tugilgan_joy_viloyat ?? '-',
                        'tugilgan_joy_tuman' => $relative->tugilgan_joy_tuman ?? '-',
                        'tugilgan_joy_qishloq' => $relative->tugilgan_joy_qishloq ?? '-',
                        'ishi_joyi' => $relative->ishi_joyi ?? '-',
                        'lavozimi' => $relative->lavozimi ?? '-',
                        'nafaqada' => $relative->nafaqada ? 'Ha' : 'Yo\'q',
                        'oqishda' => $relative->oqishda ? 'Ha' : 'Yo\'q',
                        'oquv_yurti' => $relative->oquv_yurti ?? '-',
                        'old_ishi_joyi' => $relative->old_ishi_joyi ?? '-',
                        'old_lavozimi' => $relative->old_lavozimi ?? '-',
                    ];
                })->toArray(),
    
                // Qo'shimcha ma'lumotlar - XATOLARNI TUZATAMIZ
                'additional' => [
                    'boy' => $employee->additionalInfo->boy ?? '-',
                    'vazn' => $employee->additionalInfo->vazn ?? '-',
                    'kostyum_razmer' => $employee->additionalInfo->kostyum_razmer ?? '-',
                    'poyabzal_razmer' => $employee->additionalInfo->poyabzal_razmer ?? '-',
                    'telegram_username' => $employee->additionalInfo->telegram_username ?? '-',
                    'sudlanganmi' => $employee->additionalInfo->sudlanganmi ? 'Ha' : 'Yo\'q',
                    'sudlanganlik_sabab' => $employee->additionalInfo->sudlanganlik_sabab ?? '-',
                    'sudlanganlik_sana' => $employee->additionalInfo->sudlanganlik_sana ?? '-',
                    'davlat_mukofoti' => $employee->additionalInfo->davlat_mukofoti ?? '-',
                    'soliq_id' => $employee->additionalInfo->soliq_id ?? '-',
                    'inps' => $employee->additionalInfo->inps ?? '-', // $user -> $employee
                    'akfa_tanish' => $employee->additionalInfo->akfa_tanish ? 'Ha' : 'Yo\'q', // $user -> $employee
                    'akfa_tanish_ism' => $employee->additionalInfo->akfa_tanish_ism ?? '-', // $user -> $employee
                    'akfa_tanish_lavozim' => $employee->additionalInfo->akfa_tanish_lavozim ?? '-', // $user -> $employee
                    'shaxsiy_avtomobil' => $employee->additionalInfo->shaxsiy_avtomobil ?? '-', // $user -> $employee
                    'conviction_document_path' => $employee->additionalInfo->conviction_document_path
                        ? Storage::url($employee->additionalInfo->conviction_document_path)
                        : null,
                    'insanity_certificate_path' => $employee->additionalInfo->insanity_certificate_path
                        ? Storage::url($employee->additionalInfo->insanity_certificate_path)
                        : null,
                    'parking' => $employee->additionalInfo->parking ? 'Ha' : 'Yo\'q',
                    'office' => $employee->additionalInfo->office ? 'Ha' : 'Yo\'q',
                ],
            ];
            
            \Log::info('Response prepared successfully');
            return response()->json($response);
    
        } catch (\Exception $e) {
            \Log::error('Employee show error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Ma\'lumotlarni yuklashda xatolik yuz berdi',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function edit(User $employee)
    {
        $employee->load([
            'passportInfo',
            'militaryRecord',
            'additionalInfo',
            'workExperiences',
            'relatives',
            'educations.university',
            'educations.faculty',
            'educations.specialityRelation'
        ]);

        $organizations = MenyuOrganization::all();
        $universities = MenyuUniversity::all();
        $faculties = MenyuFaculty::all();
        $specialities = MenyuSpeciality::all();
        $colleges = MenyuCollege::all();
        $regions = MenyuRegion::all();
        $villages = MenyuVillage::all();
        $schools = MenyuSchool::all();
        $districts = MenyuDistrict::all();
        return view('pages.employee.edit', compact(
            'employee', 
            'organizations', 
            'universities',
            'faculties',
            'specialities',
            'colleges',
            'schools',
            'districts',
            'regions', 
            'villages' 
        ));
    }
    // EmployeeController ga qo'shing
    public function updateImage(Request $request, User $employee)
    {
        try {
            \Log::info('Rasm yuklash boshlanmoqda', [
                'employee_id' => $employee->id,
                'has_file' => $request->hasFile('image'),
                'file_size' => $request->hasFile('image') ? $request->file('image')->getSize() : null
            ]);

            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            if ($request->hasFile('image')) {
                // Eskı rasmni o'chirish
                if ($employee->image && Storage::exists($employee->image)) {
                    Storage::delete($employee->image);
                }

                // Yangi rasmni saqlash
                $imagePath = $request->file('image')->store('employee-images', 'public');
                
                \Log::info('Rasm saqlandi', ['path' => $imagePath]);
                
                // Employee ni yangilash
                $employee->update([
                    'image' => $imagePath
                ]);

                \Log::info('Employee yangilandi', ['image_path' => $imagePath]);

                return response()->json([
                    'success' => true,
                    'message' => 'Rasm muvaffaqiyatli yangilandi',
                    'image_url' => asset('storage/' . $imagePath)
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Rasm fayli topilmadi'
            ], 400);

        } catch (\Exception $e) {
            \Log::error('Rasm yangilashda xatolik', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Rasm yangilashda xatolik: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, User $employee)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'gender' => 'required|string|in:male,female',
            'birth_date' => 'required|date',
            'phone' => 'required|string|max:20',
            'fnfl' => 'required|string|max:20',
            'tab_number' => 'nullable|string|max:50|unique:Menyu_employee,tab_number,' . $employee->id . '|regex:/^[0-9]+$/',
            'position' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'extradepartment' => 'nullable|string|max:255',
            'worker_and_time' => 'required|numeric|min:0|max:24',
            'expected_arrival_time' => 'nullable|string',
            'hired_date' => 'required|date',
            'fired_date' => 'nullable|date',
            'cardnumber' => 'nullable|string|max:255',
            'floor' => 'nullable|integer',
            'room' => 'nullable|integer',
            'organization_id' => 'required|exists:Menyu_organization,id',
            'image' => 'nullable|image|max:2048',
            'parking' => 'nullable|boolean',
            'office' => 'nullable|boolean',
            'night_working' => 'nullable|boolean',
            'car_number' => 'nullable|string|max:20',
            'passport_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'military_status' => 'nullable|in:called,served,unfit',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->only([
            'first_name', 'last_name', 'middle_name', 'gender', 'birth_date',
            'phone', 'fnfl', 'position', 'department', 'extradepartment',
            'worker_and_time', 'expected_arrival_time', 'hired_date', 'fired_date',
            'cardnumber', 'floor', 'room', 'organization_id'
        ]);

        $data['parking'] = $request->boolean('parking');
        $data['office'] = $request->boolean('office');
        $data['night_working'] = $request->boolean('night_working');
        $data['car_number'] = $request->car_number;

        if ($request->hasFile('image')) {
            if ($employee->image) {
                Storage::disk('public')->delete($employee->image);
            }
            $data['image'] = $request->file('image')->store('employees', 'public');
        }

        $employee->update($data);

        return redirect()->route('employees.index')->with('success', 'Xodim ma\'lumotlari muvaffaqiyatli yangilandi!');
    }

    /**
     * Step-by-step yangilash
     */
    public function updateStep(Request $request, User $employee, $step)
    {
        try {
            Log::info("=== Step {$step} Update Started ===");
            Log::info("Employee ID: {$employee->id}");
            Log::info("Request Data:", $request->all());

            $validationRules = $this->getValidationRules($step, $employee);
            Log::info("Validation Rules:", $validationRules);

            $validator = Validator::make($request->all(), $validationRules);

            if ($validator->fails()) {
                Log::error("Validation Failed:", $validator->errors()->toArray());
                return response()->json([
                    'success' => false,
                    'message' => 'Validatsiya xatosi',
                    'errors' => $validator->errors()
                ], 422);
            }

            Log::info("Validation Passed");
            // Save step data and capture the returned additional model (if any)
            $savedAdditional = $this->saveStepData($employee, $request, $step);
            Log::info("=== Step {$step} Update Completed Successfully ===");

            // Return updated employee snapshot to help the client refresh fields immediately
            $employee->refresh();

            $additional = null;
            // Prefer the freshly saved additional model if saveStepData returned it
            if (!empty($savedAdditional) && $savedAdditional instanceof \Illuminate\Database\Eloquent\Model) {
                $additional = $savedAdditional->toArray();
                if (!empty($additional['conviction_document_path'])) {
                    $additional['conviction_document_url'] = Storage::url($additional['conviction_document_path']);
                }
                if (!empty($additional['insanity_certificate_path'])) {
                    $additional['insanity_certificate_url'] = Storage::url($additional['insanity_certificate_path']);
                }
            } elseif ($employee->additionalInfo) {
                // Fall back to the relation on the employee
                $additional = $employee->additionalInfo->toArray();
                if (!empty($additional['conviction_document_path'])) {
                    $additional['conviction_document_url'] = Storage::url($additional['conviction_document_path']);
                }
                if (!empty($additional['insanity_certificate_path'])) {
                    $additional['insanity_certificate_url'] = Storage::url($additional['insanity_certificate_path']);
                }
            }

            return response()->json([
                'success' => true,
                'message' => "Step {$step} ma'lumotlari muvaffaqiyatli saqlandi",
                'step' => $step,
                'employee' => [
                    'id' => $employee->id,
                    'first_name' => $employee->first_name,
                    'last_name' => $employee->last_name,
                    'middle_name' => $employee->middle_name,
                    'fnfl' => $employee->fnfl,
                    'tab_number' => $employee->tab_number,
                    'phone' => $employee->phone,
                    'position' => $employee->position,
                    'department' => $employee->department,
                    'car_number' => $employee->car_number,
                    // include full additionalInfo array when available so frontend can update inputs
                    'additional' => $additional
                ]
            ]);

        } catch (\Exception $e) {
            Log::error("Step {$step} Update Error: " . $e->getMessage());
            Log::error("Stack Trace: " . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'Xatolik yuz berdi: ' . $e->getMessage()
            ], 500);
        }
    }
    private function getValidationRules($step, $employee = null)
    {
        $rules = [];

        switch ($step) {
            case 1:
                $rules = [
                    'last_name' => 'required|string|max:255',
                    'first_name' => 'required|string|max:255', 
                    'middle_name' => 'required|string|max:255',
                    'fnfl' => 'required|string|max:20',
                    'tab_number' => 'nullable|string|max:50|unique:Menyu_employee,tab_number' . ($employee ? ',' . $employee->id : '') . '|regex:/^[0-9]+$/',
                    'gender' => 'required|string|in:male,female',
                    'birth_date' => 'required|date',
                    'phone' => 'required|string|max:20',
                    'hired_date' => 'required|date',
                    'organization_id' => 'required|exists:Menyu_organization,id',
                    'department' => 'required|string|max:255',
                    'position' => 'required|string|max:255',
                    'worker_and_time' => 'required|numeric|min:0|max:168',
                    'extradepartment' => 'nullable|string|max:255',
                    'expected_arrival_time' => 'nullable|string',
                    'cardnumber' => 'nullable|string|max:255',
                    'floor' => 'nullable|integer',
                    'room' => 'nullable|integer',
                    'car_number' => 'nullable|string|max:20',
                    'image' => 'nullable|image|max:2048',
                    'parking' => 'nullable|boolean',
                    'office' => 'nullable|boolean',
                    'night_working' => 'nullable|boolean',
                ];
                break;

            case 2:
                $rules = [
                    'passport.seria_raqam' => 'required|string|max:255',
                    'passport.kim_tomonidan_berilgan' => 'required|string|max:255',
                    'passport.berilgan_sana' => 'required|date',
                    'passport.amal_qilish_muddati' => 'required|date',
                    'passport.doimiy_yashash_joyi' => 'required|string|max:255',
                    'passport.yashash_joyi' => 'required|string|max:255',
                    'military_status' => 'required|in:called,served,unfit',
                    'military.reason_unfit' => 'nullable|string|max:500',
                    'military.hisob_guruhi' => 'nullable|string|max:255',
                    'military.hisob_toifasi' => 'nullable|string|max:255',
                    'military.harbiy_mutaxassislik' => 'nullable|string|max:255',
                    'military.qoshin_turi' => 'nullable|string|max:255',
                    'military.xizmatga_yaroqliligi' => 'nullable|string|max:255',
                    'military.harbiy_unvoni' => 'nullable|string|max:255',
                    'military.mudofa_bolimi' => 'nullable|string|max:255',
                    'military.maxsus_xisob' => 'nullable|string|max:255',
                ];
                break;

            case 3:
                // Step 3 uchun validatsiyani o'chirib qo'yamiz, chunki bu yerda faqat jadvallar ko'rsatiladi
                $rules = [];
                break;

           case 4:
                $rules = [
                    'relatives' => 'sometimes|array',
                    'relatives.*.qarindoshlik' => 'required|string|max:255|in:Otasi,Onasi,Akasi,Ukasi,Singlisi,Opasi,Turmush o\'rtog\'i,Farzandi',
                    'relatives.*.familiyasi' => 'required|string|max:255',
                    'relatives.*.ismi' => 'required|string|max:255',
                    'relatives.*.otasi_ismi' => 'required|string|max:255',
                    'relatives.*.sharfi' => 'nullable|string|max:255',
                    'relatives.*.tugilgan_yili' => 'required|integer|min:1900|max:' . date('Y'),
                    'relatives.*.tugilgan_joy_viloyat' => 'nullable|string|max:255',
                    'relatives.*.tugilgan_joy_tuman' => 'nullable|string|max:255',
                    'relatives.*.tugilgan_joy_qishloq' => 'nullable|string|max:255',
                    'relatives.*.tugilgan_joy_soato' => 'nullable|string|max:255',
                    'relatives.*.ishi_joyi' => 'nullable|string|max:255',
                    'relatives.*.lavozimi' => 'nullable|string|max:255',
                    'relatives.*.nafaqada' => 'nullable|boolean',
                    'relatives.*.oqishda' => 'nullable|boolean',
                    'relatives.*.oquv_yurti' => 'nullable|string|max:255',
                    'relatives.*.old_ishi_joyi' => 'nullable|string|max:255',
                    'relatives.*.old_lavozimi' => 'nullable|string|max:255',
                ];
                break;

            case 5:
                $rules = [
                    'additional.soliq_id' => 'nullable|string|max:255',
                    'additional.inps' => 'nullable|string|max:255',
                    'additional.qiziqishlari' => 'nullable|string|max:500',
                    'additional.haydovchilik_guvohnomasi' => 'nullable|string|max:255',
                    'additional.davlat_mukofoti' => 'nullable|string|max:255',
                    'additional.boy' => 'nullable|string|max:50',
                    'additional.vazn' => 'nullable|string|max:50',
                    'additional.bosh_razmer' => 'nullable|string|max:50',
                    'additional.akfa_tanish' => 'nullable|boolean',
                    'additional.sudlanganmi' => 'nullable|boolean',
                ];
                break;
        }

        return $rules;
    }
    public function getRelativesTable(User $employee)
    {
        $relatives = $employee->relatives;
        
        $html = '';
        foreach ($relatives as $relative) {
            $html .= '
            <tr data-id="' . $relative->id . '">
                <td class="dtr-control" tabindex="0">' . $relative->qarindoshlik . '</td>
                <td>
                    <div class="row align-items-center flex-nowrap">
                        <div class="col-auto">
                            <figure class="avatar avatar-40 mb-0 coverimg rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center">
                                ' . strtoupper(substr($relative->familiyasi,0,1) . substr($relative->ismi,0,1)) . '
                            </figure>
                        </div>
                        <div class="col ps-0">
                            <p class="mb-0 fw-medium">' . $relative->familiyasi . ' ' . $relative->ismi . '</p>
                            <small class="text-muted">' . ($relative->otasi_ismi ?: '') . '</small>
                        </div>
                    </div>
                </td>
                <td>' . ($relative->tugilgan_yili ?: '-') . '</td>
                <td>
                    ' . ($relative->tugilgan_joy_viloyat || $relative->tugilgan_joy_tuman ?
                        '<small class="text-muted">' . $relative->tugilgan_joy_viloyat . ', ' . $relative->tugilgan_joy_tuman . ($relative->tugilgan_joy_qishloq ? ', ' . $relative->tugilgan_joy_qishloq : '') . '</small>' :
                        '<small class="text-muted">' . ($relative->tugilgan_joy_soato ?: '-') . '</small>') . '
                </td>
                <td>
                    ' . ($relative->nafaqada ?
                        ('<div class="d-flex flex-column"><span class="badge badge-light rounded-pill text-bg-warning">Nafaqada</span>' .
                            (($relative->old_ishi_joyi || $relative->old_lavozimi) ? ('<small class="text-muted">Oldingi ish: ' . ($relative->old_ishi_joyi ?: '-') . ($relative->old_lavozimi ? ' / ' . $relative->old_lavozimi : '') . '</small>') :
                                (($relative->ishi_joyi || $relative->lavozimi) ? ('<small class="text-muted">Oldingi ish: ' . ($relative->ishi_joyi ?: '-') . ($relative->lavozimi ? ' / ' . $relative->lavozimi : '') . '</small>') : ''))) :
                        ($relative->oqishda ? '<small>' . ($relative->oquv_yurti ?: 'O\'qiydi') . '</small>' : '<small>' . ($relative->ishi_joyi ?: '-') . ($relative->lavozimi ? ' / ' . $relative->lavozimi : '') . '</small>')) . '
                </td>
                <td>
                    <a href="javascript:void(0)" class="btn btn-square btn-link" onclick="editRelative(' . $relative->id . ')" data-bs-toggle="tooltip" aria-label="Tahrirlash" data-bs-original-title="Tahrirlash">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <div class="dropdown d-inline-block">
                        <a class="btn btn-link no-caret" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="javascript:void(0)" onclick="editRelative(' . $relative->id . ')">Tahrirlash</a></li>
                            <li><a class="dropdown-item theme-red" href="javascript:void(0)" onclick="deleteRelative(' . $relative->id . ')">O\'chirish</a></li>
                        </ul>
                    </div>
                </td>
            </tr>';
        }
        
        return $html;
    }

    public function getRelative($employeeId, $relativeId)
    {
        try {
            $relative = MenyuRelative::where('employee_id', $employeeId)
                                    ->where('id', $relativeId)
                                    ->firstOrFail();
            
            return response()->json([
                'success' => true,
                'relative' => $relative
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Qarindosh topilmadi'
            ], 404);
        }
    }

// O'ZGARISH: Field nomlarini tekshirish
    public function saveRelative(Request $request, $employeeId, $relativeId = null)
    {
        try {
            // Debug: log incoming request data to help diagnose missing fields
            Log::info('saveRelative called', [
                'employee_id_param' => $employeeId,
                'relative_id_param' => $relativeId,
                'request_all' => $request->all(),
                'request_content' => $request->getContent()
            ]);
            $validator = Validator::make($request->all(), [
                'qarindoshlik' => 'required|string|max:255|in:Otasi,Onasi,Akasi,Ukasi,Singlisi,Opasi,Turmush o\'rtog\'i,Farzandi',
                'familiyasi' => 'required|string|max:255',
                'ismi' => 'required|string|max:255',
                'otasi_ismi' => 'required|string|max:255',
                'tugilgan_yili' => 'required|integer|min:1900|max:' . date('Y'),
                'tugilgan_joy_viloyat' => 'nullable|string|max:255',
                'tugilgan_joy_tuman' => 'nullable|string|max:255',
                'tugilgan_joy_qishloq' => 'nullable|string|max:255',
                'tugilgan_joy_soato' => 'nullable|string|max:255',
                'ishi_joyi' => 'nullable|string|max:255',
                'lavozimi' => 'nullable|string|max:255',
                'old_ishi_joyi' => 'nullable|string|max:255',
                'old_lavozimi' => 'nullable|string|max:255',
                'nafaqada' => 'nullable|boolean',
                'oqishda' => 'nullable|boolean',
                'oquv_yurti' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validatsiya xatosi',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Start with only allowed inputs to avoid unintentionally overwriting existing columns
            $data = $request->only([
                'qarindoshlik','familiyasi','ismi','otasi_ismi','tugilgan_yili',
                'tugilgan_joy_viloyat','tugilgan_joy_tuman','tugilgan_joy_qishloq','tugilgan_joy_soato',
                'ishi_joyi','lavozimi','oquv_yurti'
            ]);
            $data['employee_id'] = $employeeId;

            // Checkbox qiymatlarini to'g'ri o'rnatish
            $data['nafaqada'] = $request->boolean('nafaqada');
            $data['oqishda'] = $request->boolean('oqishda');

            // Handle old job fields carefully:
            // - If the request explicitly includes non-empty old_* fields, set them.
            // - If updating and old_* are not provided, leave existing values untouched.
            // - If creating and nafaqada is true but old_* not provided, fallback to current ishi_joyi/lavozimi from request.
            if ($request->filled('old_ishi_joyi')) {
                $data['old_ishi_joyi'] = $request->input('old_ishi_joyi');
            }
            if ($request->filled('old_lavozimi')) {
                $data['old_lavozimi'] = $request->input('old_lavozimi');
            }

            // If creating a new relative and nafaqada is true, but old_* fields
            // were not provided, fallback to the provided current ishi_joyi/lavozimi
            // so historical job isn't lost.
            if (!$relativeId && $data['nafaqada']) {
                if (empty($data['old_ishi_joyi']) && $request->filled('ishi_joyi')) {
                    $data['old_ishi_joyi'] = $request->input('ishi_joyi');
                }
                if (empty($data['old_lavozimi']) && $request->filled('lavozimi')) {
                    $data['old_lavozimi'] = $request->input('lavozimi');
                }
            }

            // NOTE: we no longer automatically clear previous job fields when a relative is
            // marked `nafaqada`. Many users want to preserve the historical job (e.g. "IIB - Mayor").
            // For updates, if the request doesn't provide new values for `ishi_joyi` or `lavozimi`,
            // we'll keep existing values.
            
            if ($relativeId) {
                $relative = MenyuRelative::where('employee_id', $employeeId)
                                        ->where('id', $relativeId)
                                        ->firstOrFail();
                $relative->update($data);
                $message = 'Qarindosh ma\'lumotlari yangilandi';
            } else {
                MenyuRelative::create($data);
                $message = 'Qarindosh qo\'shildi';
            }
            
            return response()->json([
                'success' => true,
                'message' => $message
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Xatolik: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteRelative($employeeId, $relativeId)
    {
        try {
            $relative = MenyuRelative::where('employee_id', $employeeId)
                                    ->where('id', $relativeId)
                                    ->firstOrFail();
            $relative->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Qarindosh o\'chirildi'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Xatolik: ' . $e->getMessage()
            ], 500);
        }
    }
    private function saveStepData($employee, $request, $step)
    {
        $saved = null;
        switch ($step) {
            case 1:
                $data = $request->only([
                    'first_name', 'last_name', 'middle_name', 'gender', 'birth_date',
                    'phone', 'fnfl', 'tab_number', 'position', 'department', 'extradepartment',
                    'worker_and_time', 'expected_arrival_time', 'hired_date',
                    'cardnumber', 'floor', 'room', 'organization_id', 'car_number'
                ]);

                $data['parking'] = $request->boolean('parking');
                $data['office'] = $request->boolean('office');
                $data['night_working'] = $request->boolean('night_working');
                $data['car_number'] = $request->car_number;

                if ($request->hasFile('image')) {
                    if ($employee->image) {
                        Storage::disk('public')->delete($employee->image);
                    }
                    $data['image'] = $request->file('image')->store('employees', 'public');
                }

                $employee->update($data);
                Log::info('After step1 update, car_number=' . ($employee->car_number ?? 'NULL'));
                Log::info('After step1 update, tab_number=' . ($employee->tab_number ?? 'NULL'));
                break;

            case 2:
                // Pasport ma'lumotlari
                if ($request->has('passport')) {
                    $passportData = $request->input('passport');
                    
                    if ($employee->passportInfo) {
                        $employee->passportInfo->update($passportData);
                    } else {
                        $employee->passportInfo()->create($passportData);
                    }
                }

                // Harbiy ma'lumotlar
                $militaryStatus = $request->input('military_status');
                $militaryData = [];

                if ($militaryStatus === 'served') {
                    $militaryData = $request->input('military', []);
                    $militaryData['reason_unfit'] = null;
                } elseif ($militaryStatus === 'unfit') {
                    $militaryData = [
                        'reason_unfit' => $request->input('military.reason_unfit')
                    ];
                }

                if ($employee->militaryRecord) {
                    $employee->militaryRecord->update($militaryData);
                } elseif (!empty($militaryData)) {
                    $employee->militaryRecord()->create($militaryData);
                }
                break;

            case 3:
                // Step 3 - Ta'lim va ish tajribasi AJAX orqali alohida boshqariladi
                Log::info("Step 3 - No data to save, handled by separate AJAX calls");
                break;

            case 4:
                // Qarindoshlar
                if ($request->has('relatives')) {
                    $relativesInput = $request->input('relatives', []);

                    // Collect incoming IDs to determine deletions
                    $incomingIds = [];
                    foreach ($relativesInput as $rel) {
                        if (!empty($rel['id'])) $incomingIds[] = $rel['id'];
                    }

                    // Delete relatives that were removed on client
                    if (!empty($incomingIds)) {
                        $employee->relatives()->whereNotIn('id', $incomingIds)->delete();
                    } else {
                        // if no relatives provided, remove all
                        $employee->relatives()->delete();
                    }

                    // Process each incoming relative: update if id present, create otherwise
                    foreach ($relativesInput as $relativeData) {
                        if (empty($relativeData['ismi']) || empty($relativeData['familiyasi'])) continue;

                        // Normalize boolean-like fields
                        $nafaqada = isset($relativeData['nafaqada']) && ($relativeData['nafaqada'] == 1 || $relativeData['nafaqada'] === '1' || $relativeData['nafaqada'] === true);

                        // If pension and old fields missing, fallback to current job fields
                        if ($nafaqada) {
                            if (empty($relativeData['old_ishi_joyi']) && !empty($relativeData['ishi_joyi'])) {
                                $relativeData['old_ishi_joyi'] = $relativeData['ishi_joyi'];
                            }
                            if (empty($relativeData['old_lavozimi']) && !empty($relativeData['lavozimi'])) {
                                $relativeData['old_lavozimi'] = $relativeData['lavozimi'];
                            }
                        }

                        if (!empty($relativeData['id'])) {
                            // Update existing
                            $existing = $employee->relatives()->where('id', $relativeData['id'])->first();
                            if ($existing) {
                                // Preserve old_* if not provided in incoming data
                                if (empty($relativeData['old_ishi_joyi']) && $existing->old_ishi_joyi) {
                                    $relativeData['old_ishi_joyi'] = $existing->old_ishi_joyi;
                                }
                                if (empty($relativeData['old_lavozimi']) && $existing->old_lavozimi) {
                                    $relativeData['old_lavozimi'] = $existing->old_lavozimi;
                                }

                                $existing->update($relativeData);
                            } else {
                                // fallback to create if ID not found
                                $employee->relatives()->create($relativeData);
                            }
                        } else {
                            // Create new
                            $employee->relatives()->create($relativeData);
                        }
                    }
                }
                break;

            case 5:
                // Qo'shimcha ma'lumotlar
                if ($request->has('additional')) {
                    $additionalData = $request->input('additional', []);

                    // Prevent creating a second additionalInfo record if one already exists
                    $forceCreate = $request->input('additional._create_new') == '1';
                    if ($employee->additionalInfo && $forceCreate) {
                        // This indicates a client attempted to create when record already exists
                        throw new \Exception('Qo\'shimcha ma\'lumotlar allaqachon mavjud — faqat tahrirlash mumkin');
                    }


                    // Normalize boolean fields
                    $additionalData['akfa_tanish'] = $request->boolean('additional.akfa_tanish');
                    $additionalData['sudlanganmi'] = $request->boolean('additional.sudlanganmi');

                    // Map form keys to DB column names where they differ
                    // conviction_date -> sudlanganlik_sana
                    if ($request->filled('additional.conviction_date')) {
                        $additionalData['sudlanganlik_sana'] = $request->input('additional.conviction_date');
                    }
                    // conviction_article -> sudlanganlik_sabab
                    if ($request->filled('additional.conviction_article')) {
                        $additionalData['sudlanganlik_sabab'] = $request->input('additional.conviction_article');
                    }

                    // emergency fields -> tanish_ism / tanish_telfoni
                    if ($request->filled('additional.emergency_name')) {
                        $additionalData['tanish_ism'] = $request->input('additional.emergency_name');
                    }
                    if ($request->filled('additional.emergency_phone')) {
                        $additionalData['tanish_telfoni'] = $request->input('additional.emergency_phone');
                    }

                    // shaxsiy_avtomobil (store as-is)
                    if ($request->filled('additional.shaxsiy_avtomobil')) {
                        $additionalData['shaxsiy_avtomobil'] = $request->input('additional.shaxsiy_avtomobil');
                    }

                    // Exit reasons may come as array of strings
                    if ($request->has('additional.exit_reasons')) {
                        $additionalData['exit_reasons'] = $request->input('additional.exit_reasons', []);
                    }

                    // File uploads: conviction document and insanity certificate
                    if ($request->hasFile('additional.conviction_document')) {
                        $file = $request->file('additional.conviction_document');
                        $path = $file->store('additional', 'public');
                        $additionalData['conviction_document_path'] = $path;
                    }
                    if ($request->hasFile('additional.insanity_certificate')) {
                        $file = $request->file('additional.insanity_certificate');
                        $path = $file->store('additional', 'public');
                        $additionalData['insanity_certificate_path'] = $path;
                    }

                    // Normalize numeric fields to null if empty
                    foreach (['soliq_id', 'inps'] as $numField) {
                        if (array_key_exists($numField, $additionalData) && $additionalData[$numField] === '') {
                            $additionalData[$numField] = null;
                        }
                    }

                    // Save or update and capture the saved model
                    $forceCreate = $request->input('additional._create_new') == '1';
                    if ($employee->additionalInfo && !$forceCreate) {
                        $employee->additionalInfo->update($additionalData);
                        $saved = $employee->additionalInfo;
                    } else {
                        // If forceCreate is true OR no existing additionalInfo, create a fresh record
                        $additionalData['employee_id'] = $employee->id;
                        $saved = $employee->additionalInfo()->create($additionalData);
                    }
                }
                break;
        }

        return $saved;
    }

    /**
     * Ta'lim ma'lumotlarini olish (AJAX)
     */
    public function getEducation($employeeId, $educationId)
    {
        try {
            $education = MenyuEducation::where('employee_id', $employeeId)
                                 ->where('id', $educationId)
                                 ->firstOrFail();
            
            return response()->json([
                'success' => true,
                'education' => $education
            ]);
        } catch (\Exception $e) {
            Log::error('Education get error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Ta\'lim ma\'lumoti topilmadi'
            ], 404);
        }
    }

    /**
     * Ta'lim ma'lumotlarini saqlash
     */
 
/**
 * Ta'lim ma'lumotlarini saqlash
 */
/**
 * Ta'lim ma'lumotlarini saqlash
 */
public function saveEducation(Request $request, $employeeId)
{
    try {
        Log::info('Saving education data:', $request->all());
        
        // Validatsiya qoidalari
        $validator = Validator::make($request->all(), [
            'degree_type' => 'required|string|max:255',
            'start_date' => 'required|date',
            // Qo'shimcha maydonlar uchun validatsiya
            'university_id' => 'nullable|exists:Menyu_university,id',
            'college_id' => 'nullable|exists:Menyu_college,id',
            'school_id' => 'nullable|exists:Menyu_school,id',
            'faculty_id' => 'nullable|exists:Menyu_faculty,id',
            'speciality_id' => 'nullable|exists:Menyu_speciality,id',
            'course' => 'nullable|integer|min:1|max:6',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'diploma_number' => 'nullable|string|max:255',
            'issue_date' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            Log::error('Education validation errors:', $validator->errors()->toArray());
            return response()->json([
                'success' => false,
                'message' => 'Validatsiya xatosi',
                'errors' => $validator->errors()
            ], 422);
        }

        // Faqat mavjud maydonlarni olish
        $data = $request->only([
            'degree_type', 'start_date', 'university_id', 'college_id', 'school_id',
            'faculty_id', 'speciality_id', 'course', 'end_date', 'diploma_number', 'issue_date'
        ]);
        
        $data['employee_id'] = $employeeId;
        
        // Bo'sh maydonlarni null qilish
        foreach ($data as $key => $value) {
            if (empty($value)) {
                $data[$key] = null;
            }
        }
        
        Log::info('Processed education data:', $data);
        
        if ($request->has('education_id') && $request->education_id) {
            $education = MenyuEducation::where('employee_id', $employeeId)
                                 ->where('id', $request->education_id)
                                 ->firstOrFail();
            $education->update($data);
            $message = 'Ta\'lim ma\'lumotlari muvaffaqiyatli yangilandi';
        } else {
            MenyuEducation::create($data);
            $message = 'Ta\'lim ma\'lumotlari muvaffaqiyatli qo\'shildi';
        }
        
        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    } catch (\Exception $e) {
        Log::error('Education save error: ' . $e->getMessage());
        Log::error('Stack trace: ' . $e->getTraceAsString());
        return response()->json([
            'success' => false,
            'message' => 'Xatolik yuz berdi: ' . $e->getMessage()
        ], 500);
    }
}
    /**
     * Ta'lim ma'lumotlarini o'chirish
     */
    public function deleteEducation($employeeId, $educationId)
    {
        try {
            $education = MenyuEducation::where('employee_id', $employeeId)
                                 ->where('id', $educationId)
                                 ->firstOrFail();
            $education->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Ta\'lim ma\'lumotlari muvaffaqiyatli o\'chirildi'
            ]);
        } catch (\Exception $e) {
            Log::error('Education delete error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Xatolik yuz berdi: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Ta'lim jadvali uchun HTML
        */
    public function getEducationsTable(User $employee)
    {
        $educations = $employee->educations()
            ->with([
                'university', 
                'college', 
                'school', 
                'faculty', 
                'specialityRelation'
            ])
            ->get();
        
        $html = '';
        foreach ($educations as $education) {
            // Identity cell
            $initials = strtoupper(substr($education->degree_type ?? '-', 0, 1));
            $institution = $education->university->name ?? $education->college->name ?? $education->school->name ?? '-';
            
            $identity = '<div class="row align-items-center flex-nowrap">'
                . '<div class="col-auto">'
                    . '<figure class="avatar avatar-40 mb-0 coverimg rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center">'
                        . e($initials)
                    . '</figure>'
                . '</div>'
                . '<div class="col ps-0">'
                    . '<p class="mb-0 fw-medium">' . e($education->degree_type) . '</p>'
                    . '<small class="text-muted">' . e($institution) . '</small>'
                . '</div>'
            . '</div>';

            // Mutaxassislikni aniqlash
            $speciality = '-';
            if (!empty($education->speciality)) {
                $speciality = e($education->speciality);
            } elseif ($education->specialityRelation) {
                $speciality = e($education->specialityRelation->name);
            }

            $html .= '<tr data-id="' . $education->id . '" data-type="' . e($education->degree_type) . '">';
            $html .= '<td class="dtr-control" tabindex="0">' . $identity . '</td>';
            $html .= '<td>' . ($education->faculty ? e($education->faculty->name) : '-') . '</td>';
            $html .= '<td>' . $speciality . '</td>';
            $html .= '<td>' . ($education->start_date ? \Carbon\Carbon::parse($education->start_date)->format('d.m.Y') : '') . '</td>';
            $html .= '<td>' . ($education->degree_type == 'Tugallanmagan oliy' 
                ? ($education->course ? $education->course . '-kurs' : 'O\'qimoqda')
                : ($education->end_date ? \Carbon\Carbon::parse($education->end_date)->format('d.m.Y') : '')) . '</td>';
            $html .= '<td>' . ($education->diploma_number ?: $education->certificate_number ?: '-') . '</td>';
            $html .= '<td>
                <a href="javascript:void(0)" class="btn btn-square btn-link" onclick="editEducation(' . $education->id . ')" data-bs-toggle="tooltip" aria-label="Tahrirlash" data-bs-original-title="Tahrirlash">
                    <i class="bi bi-pencil"></i>
                </a>
                <div class="dropdown d-inline-block">
                    <a class="btn btn-link no-caret" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-three-dots"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="javascript:void(0)" onclick="editEducation(' . $education->id . ')">Tahrirlash</a></li>
                        <li><a class="dropdown-item theme-red" href="javascript:void(0)" onclick="deleteEducation(' . $education->id . ')">O\'chirish</a></li>
                    </ul>
                </div>
            </td>';
            $html .= '</tr>';
        }
        
        return $html;
    }

    /**
     * Ish tajribasi jadvali uchun HTML
     */
    public function getWorkExperiencesTable(User $employee)
    {
        $workExperiences = $employee->workExperiences;
        
        $html = '';
        foreach ($workExperiences as $work) {
            $html .= '
            <tr data-id="' . $work->id . '">
                <td class="dtr-control" tabindex="0">
                    <div class="row align-items-center flex-nowrap">
                        <div class="col-auto">
                            <figure class="avatar avatar-40 mb-0 coverimg rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center">
                                ' . strtoupper(substr($work->tashkilot_nomi,0,1) ?? '-') . '
                            </figure>
                        </div>
                        <div class="col ps-0">
                            <p class="mb-0 fw-medium">' . $work->tashkilot_nomi . '</p>
                            <small class="text-muted">' . ($work->lavozim ?? '-') . '</small>
                        </div>
                    </div>
                </td>
                <td>' . $work->lavozim . '</td>
                <td>' . \Carbon\Carbon::parse($work->kirgan_sanasi)->format('d.m.Y') . '</td>
                <td>
                    ' . ($work->current_job ? 
                        '<span class="badge badge-light rounded-pill text-bg-success">Hozirgi ish</span>' : 
                        \Carbon\Carbon::parse($work->boshagan_sanasi)->format('d.m.Y')) . '
                </td>
                <td>' . ($work->shartnoma_raqami ?: '-') . '</td>
                <td>' . ($work->shartnoma_tuzilgan_sana ? \Carbon\Carbon::parse($work->shartnoma_tuzilgan_sana)->format('d.m.Y') : '-') . '</td>
                <td>
                    <a href="javascript:void(0)" class="btn btn-square btn-link" onclick="editWorkExperience(' . $work->id . ')" data-bs-toggle="tooltip" aria-label="Tahrirlash" data-bs-original-title="Tahrirlash">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <div class="dropdown d-inline-block">
                        <a class="btn btn-link no-caret" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="javascript:void(0)" onclick="editWorkExperience(' . $work->id . ')">Tahrirlash</a></li>
                            <li><a class="dropdown-item theme-red" href="javascript:void(0)" onclick="deleteWorkExperience(' . $work->id . ')">O\'chirish</a></li>
                        </ul>
                    </div>
                </td>
            </tr>';
        }
        
        return $html;
    }

    /**
     * Ish tajribasi ma'lumotini olish
     */
    public function getWorkExperience($employeeId, $workExperienceId)
    {
        try {
            $workExperience = MenyuWorkexperience::where('employee_id', $employeeId)
                                           ->where('id', $workExperienceId)
                                           ->firstOrFail();
            
            return response()->json([
                'success' => true,
                'workExperience' => $workExperience
            ]);
        } catch (\Exception $e) {
            Log::error('Work experience get error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Ish tajribasi topilmadi'
            ], 404);
        }
    }

    /**
     * Ish tajribasi ma'lumotlarini saqlash
     */

    public function saveWorkExperience(Request $request, $employeeId)
    {
        try {
            Log::info('Saving work experience data:', $request->all());
            
            $validator = Validator::make($request->all(), [
                'tashkilot_nomi' => 'required|string|max:255',
                'lavozim' => 'required|string|max:255',
                'kirgan_sanasi' => 'required|date',
                'boshagan_sanasi' => 'nullable|date|after:kirgan_sanasi',
                'current_job' => 'nullable|boolean',
                'shartnoma_raqami' => 'nullable|string|max:255',        // YANGI
                'shartnoma_tuzilgan_sana' => 'nullable|date',           // YANGI
            ]);

            if ($validator->fails()) {
                Log::error('Work experience validation errors:', $validator->errors()->toArray());
                return response()->json([
                    'success' => false,
                    'message' => 'Validatsiya xatosi',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Faqat mavjud maydonlarni olish
            $data = $request->only([
                'tashkilot_nomi',
                'lavozim', 
                'kirgan_sanasi',
                'boshagan_sanasi',
                'current_job',
                'shartnoma_raqami',        // YANGI
                'shartnoma_tuzilgan_sana'  // YANGI
            ]);
            
            $data['employee_id'] = $employeeId;
            
            // Agar current_job belgilangan bo'lsa, boshagan_sanasi null bo'ladi
            if ($request->boolean('current_job')) {
                $data['boshagan_sanasi'] = null;
            }
            
            // Bo'sh maydonlarni null qilish
            foreach ($data as $key => $value) {
                if (empty($value) && $value !== false && $value !== 0) {
                    $data[$key] = null;
                }
            }
            
            Log::info('Processed work experience data:', $data);
            
            // work_experience_id o'rniga id dan foydalanish
            if ($request->has('work_experience_id') && $request->work_experience_id) {
                $workExperience = MenyuWorkexperience::where('employee_id', $employeeId)
                                        ->where('id', $request->work_experience_id)
                                        ->firstOrFail();
                $workExperience->update($data);
                $message = 'Ish tajribasi muvaffaqiyatli yangilandi';
            } else {
                MenyuWorkexperience::create($data);
                $message = 'Ish tajribasi muvaffaqiyatli qo\'shildi';
            }
            
            return response()->json([
                'success' => true,
                'message' => $message
            ]);
        } catch (\Exception $e) {
            Log::error('Work experience save error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return response()->json([
                'success' => false,
                'message' => 'Xatolik yuz berdi: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Ish tajribasi ma'lumotlarini o'chirish
     */
    public function deleteWorkExperience($employeeId, $workExperienceId)
    {
        try {
            $workExperience = MenyuWorkexperience::where('employee_id', $employeeId)
                                       ->where('id', $workExperienceId)
                                       ->firstOrFail();
            $workExperience->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Ish tajribasi muvaffaqiyatli o\'chirildi'
            ]);
        } catch (\Exception $e) {
            Log::error('Work experience delete error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Xatolik yuz berdi: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(User $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Xodim o\'chirildi!');
    }

    /**
     * Passport fayl yuklash
     */
    public function uploadPassport(Request $request, User $employee)
    {
        try {
            Log::info('Passport upload started for employee: ' . $employee->id);
            
            $request->validate([
                'passport_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240' // 10MB max
            ]);

            Log::info('Validation passed');

            // Eski faylni o'chirish
            if ($employee->passport_file_path && Storage::exists($employee->passport_file_path)) {
                Storage::delete($employee->passport_file_path);
                Log::info('Old file deleted');
            }

            // Yangi faylni yuklash
            $file = $request->file('passport_file');
            $fileName = 'passport_' . $employee->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('passports', $fileName, 'public');

            Log::info('File stored at: ' . $filePath);

            // Database ga saqlash
            $employee->update(['passport_file_path' => $filePath]);

            Log::info('Database updated');

            return response()->json([
                'success' => true,
                'message' => 'Passport fayli muvaffaqiyatli yuklandi!',
                'file_path' => $filePath,
                'file_url' => Storage::url($filePath)
            ]);

        } catch (\Exception $e) {
            Log::error('Passport upload error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Fayl yuklashda xatolik: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Passport faylni ko'rish
     */
    public function viewPassport(User $employee)
    {
        try {
            Log::info('View passport request for employee: ' . $employee->id);
            Log::info('Employee passport_file_path: ' . ($employee->passport_file_path ?? 'null'));
            
            if (!$employee->passport_file_path) {
                Log::info('No passport file path in database');
                return response()->json([
                    'success' => false,
                    'message' => 'Passport fayli topilmadi!'
                ], 404);
            }

            $filePath = storage_path('app/public/' . $employee->passport_file_path);
            Log::info('Looking for file at: ' . $filePath);
            
            if (!file_exists($filePath)) {
                Log::info('File does not exist at: ' . $filePath);
                return response()->json([
                    'success' => false,
                    'message' => 'Passport fayli topilmadi!'
                ], 404);
            }

            $fileUrl = Storage::url($employee->passport_file_path);
            Log::info('File URL: ' . $fileUrl);
            
            return response()->json([
                'success' => true,
                'file_url' => $fileUrl,
                'file_path' => $employee->passport_file_path
            ]);

        } catch (\Exception $e) {
            Log::error('Passport view error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Faylni ko\'rishda xatolik: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Passport faylni o'chirish
     */
    public function deletePassport(User $employee)
    {
        try {
            if ($employee->passport_file_path && Storage::exists($employee->passport_file_path)) {
                Storage::delete($employee->passport_file_path);
            }

            $employee->update(['passport_file_path' => null]);

            return response()->json([
                'success' => true,
                'message' => 'Passport fayli o\'chirildi!'
            ]);

        } catch (\Exception $e) {
            Log::error('Passport delete error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Faylni o\'chirishda xatolik: ' . $e->getMessage()
            ], 500);
        }
    }
}