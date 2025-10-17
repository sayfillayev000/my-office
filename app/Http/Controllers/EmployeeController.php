<?php

namespace App\Http\Controllers;

use App\Models\MenyuCollege;
use App\Models\MenyuDistrict;
use App\Models\MenyuFaculty;
use App\Models\MenyuOrganization;
use App\Models\MenyuSchool;
use App\Models\MenyuSpeciality;
use App\Models\MenyuUniversity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Validator;

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
                // Full name bo‘yicha qidiruv (masalan: "Sardor ABDULLAYEV")
                $q->whereRaw("CONCAT(first_name, ' ', last_name) ILIKE ?", ["%{$search}%"])
                ->orWhere('first_name', 'ILIKE', "%{$search}%")
                ->orWhere('last_name', 'ILIKE', "%{$search}%")
                ->orWhere('phone', 'ILIKE', "%{$search}%")
                ->orWhere('position', 'ILIKE', "%{$search}%")
                ->orWhere('department', 'ILIKE', "%{$search}%")
                ->orWhereHas('organization', function($q2) use ($search) {
                    $q2->where('name', 'ILIKE', "%{$search}%");
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

        // 📘 PASSPORT INFO
        'passport' => [
            'seria_raqam' => $employee->passportInfo->seria_raqam ?? '-',
            'kim_tomonidan_berilgan' => $employee->passportInfo->kim_tomonidan_berilgan ?? '-',
            'berilgan_sana' => $employee->passportInfo->berilgan_sana ?? '-',
            'amal_qilish_muddati' => $employee->passportInfo->amal_qilish_muddati ?? '-',
            'doimiy_yashash_joyi' => $employee->passportInfo->doimiy_yashash_joyi ?? '-',
            'yashash_joyi' => $employee->passportInfo->yashash_joyi ?? '-',
        ],

        // 📗 QO‘SHIMCHA INFO
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
    // Validatsiya qoidalari
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

    // Asosiy ma'lumotlarni tayyorlash
    $data = $request->only([
        'first_name', 'last_name', 'middle_name', 'gender', 'birth_date',
        'phone', 'fnfl', 'position', 'department', 'extradepartment',
        'worker_and_time', 'expected_arrival_time', 'hired_date', 'fired_date',
        'cardnumber', 'floor', 'room', 'organization_id'
    ]);

    // Boolean maydonlarni to'g'ri ishlov berish
    $data['parking'] = $request->boolean('parking');
    $data['office'] = $request->boolean('office');
    $data['night_working'] = $request->boolean('night_working');
    $data['car_number'] = $request->car_number;

    // Rasmni yangilash
    if ($request->hasFile('image')) {
        if ($employee->image) {
            Storage::disk('public')->delete($employee->image);
        }
        $data['image'] = $request->file('image')->store('employees', 'public');
    }

    // Asosiy ma'lumotlarni yangilash
    $employee->update($data);

    // Qo'shimcha ma'lumotlarni yangilash
    $this->updateRelatedData($employee, $request);

    return redirect()->route('employees.index')->with('success', 'Xodim ma\'lumotlari muvaffaqiyatli yangilandi!');
}

private function updateRelatedData(User $employee, Request $request)
{
    // Passport ma'lumotlari
    if ($request->has('passport')) {
        $passportData = array_filter($request->passport, function($value) {
            return !empty($value);
        });
        
        if (!empty($passportData)) {
            $requiredFields = ['seria_raqam', 'kim_tomonidan_berilgan', 'berilgan_sana', 'amal_qilish_muddati', 'doimiy_yashash_joyi', 'yashash_joyi'];
            $allRequiredFilled = true;
            
            foreach ($requiredFields as $field) {
                if (empty($passportData[$field])) {
                    $allRequiredFilled = false;
                    break;
                }
            }
            
            if ($allRequiredFilled) {
                $employee->passportInfo()->updateOrCreate(
                    ['employee_id' => $employee->id],
                    $passportData
                );
            } else {
                $employee->passportInfo()->delete();
            }
        } else {
            $employee->passportInfo()->delete();
        }
    }

    // Harbiy ma'lumotlar
    if ($request->has('military_status')) {
        if ($request->military_status === 'called' || $request->military_status === 'served') {
            if ($request->has('military')) {
                $militaryData = $request->military;
                if (isset($militaryData['reason_unfit'])) {
                    unset($militaryData['reason_unfit']);
                }
                $employee->militaryRecord()->updateOrCreate(
                    ['employee_id' => $employee->id],
                    $militaryData
                );
            }
        } elseif ($request->military_status === 'unfit') {
            $militaryData = [
                'reason_unfit' => $request->military['reason_unfit'] ?? null
            ];
            $fieldsToClear = ['hisob_guruhi', 'hisob_toifasi', 'harbiy_mutaxassislik', 'qoshin_turi', 'xizmatga_yaroqliligi', 'harbiy_unvoni', 'mudofa_bolimi', 'maxsus_xisob'];
            foreach ($fieldsToClear as $field) {
                $militaryData[$field] = null;
            }
            
            $employee->militaryRecord()->updateOrCreate(
                ['employee_id' => $employee->id],
                $militaryData
            );
        } else {
            $employee->militaryRecord()->delete();
        }
    } else {
        $employee->militaryRecord()->delete();
    }

    // Qo'shimcha ma'lumotlar
    if ($request->has('additional')) {
        $additionalData = $request->additional;
        $additionalData['akfa_tanish'] = isset($additionalData['akfa_tanish']);
        $additionalData['sudlanganmi'] = isset($additionalData['sudlanganmi']);
        
        $employee->additionalInfo()->updateOrCreate(
            ['employee_id' => $employee->id],
            $additionalData
        );
    } else {
        $employee->additionalInfo()->delete();
    }

    // Ta'lim ma'lumotlarini yangilash
    if ($request->has('educations')) {
        $employee->educations()->delete();
        
        foreach ($request->educations as $educationData) {
            // degree_type maydoni mavjudligini tekshirish
            if (empty($educationData['degree_type'])) {
                continue;
            }

            // Faculty va speciality nomlarini olish
            if (isset($educationData['faculty_id']) && $educationData['faculty_id']) {
                $faculty = MenyuFaculty::find($educationData['faculty_id']);
                $educationData['faculty_name'] = $faculty ? $faculty->name : 'Noma\'lum';
            } else {
                $educationData['faculty_name'] = 'Noma\'lum';
            }

            if (isset($educationData['speciality_id']) && $educationData['speciality_id']) {
                $speciality = MenyuSpeciality::find($educationData['speciality_id']);
                $educationData['speciality'] = $speciality ? $speciality->name : 'Noma\'lum';
            } else {
                $educationData['speciality'] = 'Noma\'lum';
            }

            // issue_date ni to'g'ri o'rnatish
            if (isset($educationData['diploma_date'])) {
                $educationData['issue_date'] = $educationData['diploma_date'];
                unset($educationData['diploma_date']);
            } elseif (empty($educationData['issue_date'])) {
                $educationData['issue_date'] = $educationData['end_date'] ?? null;
            }

            $employee->educations()->create($educationData);
        }
    } else {
        $employee->educations()->delete();
    }

    // Ish tajribasi
    if ($request->has('work_experiences')) {
        $employee->workExperiences()->delete();
        
        foreach ($request->work_experiences as $workData) {
            if (!empty($workData['lavozim']) && !empty($workData['tashkilot_nomi']) && !empty($workData['kirgan_sanasi'])) {
                $workData['current_job'] = isset($workData['current_job']);
                $employee->workExperiences()->create($workData);
            }
        }
    } else {
        $employee->workExperiences()->delete();
    }

    // Qarindoshlar
    if ($request->has('relatives')) {
        $employee->relatives()->delete();
        
        foreach ($request->relatives as $relativeData) {
            if (!empty($relativeData['qarindoshlik']) && !empty($relativeData['familiyasi']) && !empty($relativeData['ismi'])) {
                $employee->relatives()->create($relativeData);
            }
        }
    } else {
        $employee->relatives()->delete();
    }
}
    public function destroy(User $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Xodim o‘chirildi!');
    }
}
