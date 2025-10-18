<?php

namespace App\Http\Controllers;

use App\Models\MenyuCollege;
use App\Models\MenyuDistrict;
use App\Models\MenyuEducation;
use App\Models\MenyuFaculty;
use App\Models\MenyuOrganization;
use App\Models\MenyuSchool;
use App\Models\MenyuSpeciality;
use App\Models\MenyuUniversity;
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
        $employee->load([
            'organization',
            'passportInfo',
            'additionalInfo',
        ]);

        return response()->json([
            'id' => $employee->id,
            'full_name' => trim("{$employee->first_name} {$employee->last_name} {$employee->middle_name}"),
            'phone' => $employee->phone,
            'position' => $employee->position,
            'department' => $employee->department,
            'organization' => $employee->organization->name ?? '-',
            'image' => $employee->image && file_exists(public_path('storage/' . $employee->image))
                ? asset('storage/' . $employee->image)
                : asset('assets/img/modern-ai-image/user-3.jpg'),

            'passport' => [
                'seria_raqam' => $employee->passportInfo->seria_raqam ?? '-',
                'kim_tomonidan_berilgan' => $employee->passportInfo->kim_tomonidan_berilgan ?? '-',
                'berilgan_sana' => $employee->passportInfo->berilgan_sana ?? '-',
                'amal_qilish_muddati' => $employee->passportInfo->amal_qilish_muddati ?? '-',
                'doimiy_yashash_joyi' => $employee->passportInfo->doimiy_yashash_joyi ?? '-',
                'yashash_joyi' => $employee->passportInfo->yashash_joyi ?? '-',
            ],

            'additional' => [
                'boy' => $employee->additionalInfo->boy ?? '-',
                'vazn' => $employee->additionalInfo->vazn ?? '-',
                'kostyum_razmer' => $employee->additionalInfo->kostyum_razmer ?? '-',
                'poyabzal_razmer' => $employee->additionalInfo->poyabzal_razmer ?? '-',
                'telegram_username' => $employee->additionalInfo->telegram_username ?? '-',
                'sudlanganmi' => $employee->additionalInfo->sudlanganmi ? 'Ha' : 'Yo‘q',
                'sudlanganlik_sabab' => $employee->additionalInfo->sudlanganlik_sabab ?? '-',
                'sudlanganlik_sana' => $employee->additionalInfo->sudlanganlik_sana ?? '-',
                'davlat_mukofoti' => $employee->additionalInfo->davlat_mukofoti ?? '-',
                'soliq_id' => $employee->additionalInfo->soliq_id ?? '-',
                'inps' => $employee->additionalInfo->inps ?? '-',
            ],
        ]);
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
            'districts'
        ));
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

            $validationRules = $this->getValidationRules($step);
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
            $this->saveStepData($employee, $request, $step);
            Log::info("=== Step {$step} Update Completed Successfully ===");

            return response()->json([
                'success' => true,
                'message' => "Step {$step} ma'lumotlari muvaffaqiyatli saqlandi",
                'step' => $step
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

    private function getValidationRules($step)
    {
        $rules = [];

        switch ($step) {
            case 1:
                $rules = [
                    'last_name' => 'required|string|max:255',
                    'first_name' => 'required|string|max:255', 
                    'middle_name' => 'required|string|max:255',
                    'fnfl' => 'required|string|max:20',
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
                    'relatives.*.qarindoshlik' => 'nullable|string|max:255',
                    'relatives.*.familiyasi' => 'nullable|string|max:255',
                    'relatives.*.ismi' => 'nullable|string|max:255',
                    'relatives.*.sharfi' => 'nullable|string|max:255',
                    'relatives.*.tugilgan_yili' => 'nullable|integer|min:1900|max:' . date('Y'),
                    'relatives.*.ishi_joyi' => 'nullable|string|max:255',
                    'relatives.*.lavozimi' => 'nullable|string|max:255',
                    'relatives.*.tugilgan_joy_soato' => 'nullable|string|max:255',
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

    private function saveStepData($employee, $request, $step)
    {
        switch ($step) {
            case 1:
                $data = $request->only([
                    'first_name', 'last_name', 'middle_name', 'gender', 'birth_date',
                    'phone', 'fnfl', 'position', 'department', 'extradepartment',
                    'worker_and_time', 'expected_arrival_time', 'hired_date',
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
                    $employee->relatives()->delete();
                    
                    foreach ($request->input('relatives', []) as $relativeData) {
                        if (!empty($relativeData['ismi']) && !empty($relativeData['familiyasi'])) {
                            $employee->relatives()->create($relativeData);
                        }
                    }
                }
                break;

            case 5:
                // Qo'shimcha ma'lumotlar
                if ($request->has('additional')) {
                    $additionalData = $request->input('additional');
                    $additionalData['akfa_tanish'] = $request->boolean('additional.akfa_tanish');
                    $additionalData['sudlanganmi'] = $request->boolean('additional.sudlanganmi');
                    
                    if ($employee->additionalInfo) {
                        $employee->additionalInfo->update($additionalData);
                    } else {
                        $employee->additionalInfo()->create($additionalData);
                    }
                }
                break;
        }
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
        $educations = $employee->educations()->with(['university', 'college', 'school', 'faculty', 'specialityRelation'])->get();
        
        $html = '';
        foreach ($educations as $education) {
            $html .= '
            <tr data-id="' . $education->id . '" data-type="' . $education->degree_type . '">
                <td>' . $education->degree_type . '</td>
                <td>
                    ' . ($education->university ? $education->university->name : 
                        ($education->college ? $education->college->name : 
                        ($education->school ? $education->school->name : '-'))) . '
                </td>
                <td>
                    ' . ($education->specialityRelation ? $education->specialityRelation->name : 
                        ($education->faculty ? $education->faculty->name : '-')) . '
                </td>
                <td>' . ($education->start_date ? \Carbon\Carbon::parse($education->start_date)->format('d.m.Y') : '') . '</td>
                <td>
                    ' . ($education->degree_type == 'Tugallanmagan oliy' ? 
                        $education->course . '-kurs' : 
                        ($education->end_date ? \Carbon\Carbon::parse($education->end_date)->format('d.m.Y') : '')) . '
                </td>
                <td>' . ($education->diploma_number ?: $education->certificate_number ?: '-') . '</td>
                <td>
                    <div class="btn-group btn-group-sm" role="group">
                        <button type="button" class="btn btn-outline-primary" onclick="editEducation(' . $education->id . ')" title="Tahrirlash">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button type="button" class="btn btn-outline-danger" onclick="deleteEducation(' . $education->id . ')" title="O\'chirish">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>';
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
            <td>' . $work->tashkilot_nomi . '</td>
            <td>' . $work->lavozim . '</td>
            <td>' . \Carbon\Carbon::parse($work->kirgan_sanasi)->format('d.m.Y') . '</td>
            <td>
                ' . ($work->current_job ? 
                    '<span class="badge bg-success">Hozirgi ish</span>' : 
                    \Carbon\Carbon::parse($work->boshagan_sanasi)->format('d.m.Y')) . '
            </td>
            <td>' . ($work->shartnoma_raqami ?: '-') . '</td>
            <td>' . ($work->shartnoma_tuzilgan_sana ? \Carbon\Carbon::parse($work->shartnoma_tuzilgan_sana)->format('d.m.Y') : '-') . '</td>
            <td>
                ' . ($work->current_job ? 
                    '<span class="badge bg-success">Hozirgi ish</span>' : 
                    '<span class="badge bg-secondary">Tugatilgan</span>') . '
            </td>
            <td>
                <div class="btn-group btn-group-sm" role="group">
                    <button type="button" class="btn btn-outline-primary" onclick="editWorkExperience(' . $work->id . ')" title="Tahrirlash">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <button type="button" class="btn btn-outline-danger" onclick="deleteWorkExperience(' . $work->id . ')" title="O\'chirish">
                        <i class="bi bi-trash"></i>
                    </button>
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
  /**
 * Ish tajribasi ma'lumotlarini saqlash
 */
/**
 * Ish tajribasi ma'lumotlarini saqlash
 */
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
        return redirect()->route('employees.index')->with('success', 'Xodim o‘chirildi!');
    }
}