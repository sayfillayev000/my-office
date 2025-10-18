@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="card border overflow-hidden mb-4" id="employeeWizard">
        <ul class="nav nav-pills nav-justified">
            <li class="nav-item">
                <a class="nav-link active" href="#step-1" data-bs-toggle="tab">
                    <div class="num">1</div>
                    <div>
                        <p class="h5 mb-0">Asosiy ma'lumotlar</p>
                        <p class="opacity-75 small">Shaxsiy ma'lumotlar</p>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#step-2" data-bs-toggle="tab">
                    <div class="num">2</div>
                    <div>
                        <p class="h5 mb-0">Pasport ma'lumotlari</p>
                        <p class="opacity-75 small">Pasport va harbiy</p>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#step-3" data-bs-toggle="tab">
                    <div class="num">3</div>
                    <div>
                        <p class="h5 mb-0">Ta'lim va ish tajribasi</p>
                        <p class="opacity-75 small">Ta'lim va ish joylari</p>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#step-4" data-bs-toggle="tab">
                    <div class="num">4</div>
                    <div>
                        <p class="h5 mb-0">Qarindoshlar</p>
                        <p class="opacity-75 small">Qarindoshlik ma'lumotlari</p>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#step-5" data-bs-toggle="tab">
                    <div class="num">5</div>
                    <div>
                        <p class="h5 mb-0">Qo'shimcha ma'lumotlar</p>
                        <p class="opacity-75 small">Boshqa ma'lumotlar</p>
                    </div>
                </a>
            </li>
        </ul>

        <div class="card-body">
            <div class="tab-content">
                <!-- Step 1: Asosiy ma'lumotlar -->
                <div id="step-1" class="tab-pane fade show active">
                    <form id="step1Form">
                        @csrf
                        <div class="row gx-3 align-items-center">
                            <div class="col-12 col-lg-3 text-center mb-3">
                                <figure class="avatar avatar-140 coverimg rounded-circle mt-3 mb-3" style="background-image: url('{{ $employee->image ? Storage::url($employee->image) : asset('assets/img/modern-ai-image/user-3.jpg') }}');">
                                    <img src="{{ $employee->image ? Storage::url($employee->image) : asset('assets/img/modern-ai-image/user-3.jpg') }}" alt="" style="display:none;">
                                    <button class="btn btn-square btn-accent rounded-circle" onclick="$(this).next().click()" type="button">
                                        <i class="bi bi-upload"></i>
                                    </button>
                                    <input type="file" name="image" class="d-none" onchange="previewImage(this)">
                                </figure>
                                <p class="h5">{{ $employee->last_name }} {{ $employee->first_name }} {{ $employee->middle_name }}</p>
                            </div>
                            <div class="col">
                                <p class="h6 py-2 mb-2">Shaxsiy ma'lumotlar</p>
                                <div class="row">
                                    <!-- 1-qator: Familiya, Ism, Sharif -->
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="last_name" class="form-control" placeholder="Familiya" value="{{ $employee->last_name }}" required>
                                            <label>Familiya *</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="first_name" class="form-control" placeholder="Ism" value="{{ $employee->first_name }}" required>
                                            <label>Ism *</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="middle_name" class="form-control" placeholder="Sharif" value="{{ $employee->middle_name }}">
                                            <label>Sharif</label>
                                        </div>
                                    </div>

                                    <!-- 2-qator: PINFL, Jinsi, Tug'ilgan sana -->
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="fnfl" class="form-control" placeholder="PINFL" value="{{ $employee->fnfl }}" required>
                                            <label>PINFL *</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <select name="gender" class="form-control" required>
                                                <option value="">Tanlang</option>
                                                <option value="male" {{ $employee->gender == 'male' ? 'selected' : '' }}>Erkak</option>
                                                <option value="female" {{ $employee->gender == 'female' ? 'selected' : '' }}>Ayol</option>
                                            </select>
                                            <label>Jinsi *</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="date" name="birth_date" class="form-control" value="{{ $employee->birth_date }}" required>
                                            <label>Tug'ilgan sana *</label>
                                        </div>
                                    </div>

                                    <!-- 3-qator: Telefon, Ishga olingan sana, Tashkilot -->
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="phone" id="phone" class="form-control" placeholder="+998901234567" value="{{ $employee->phone }}" required>
                                            <label>Telefon *</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="date" name="hired_date" class="form-control" value="{{ $employee->hired_date }}" required>
                                            <label>Ishga olingan sana *</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <select name="organization_id" class="form-control" required>
                                                <option value="">Tashkilotni tanlang</option>
                                                @foreach($organizations as $org)
                                                    <option value="{{ $org->id }}" {{ $employee->organization_id == $org->id ? 'selected' : '' }}>{{ $org->name }}</option>
                                                @endforeach
                                            </select>
                                            <label>Tashkilot *</label>
                                        </div>
                                    </div>

                                    <!-- 4-qator: Bo'lim, Qo'shimcha bo'lim, Lavozim -->
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="department" class="form-control" placeholder="Bo'lim" value="{{ $employee->department }}" required>
                                            <label>Bo'lim *</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="extradepartment" class="form-control" placeholder="Qo'shimcha bo'lim" value="{{ $employee->extradepartment }}">
                                            <label>Qo'shimcha bo'lim</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="position" class="form-control" placeholder="Lavozim" value="{{ $employee->position }}" required>
                                            <label>Lavozim *</label>
                                        </div>
                                    </div>

                                    <!-- 5-qator: Kundalik ish soati, Kelish vaqti, Card raqami -->
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="number" name="worker_and_time" class="form-control" placeholder="Kundalik ish soati" value="{{ $employee->worker_and_time }}" step="0.1" required>
                                            <label>Kundalik ish soati *</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="time" name="expected_arrival_time" class="form-control" value="{{ $employee->expected_arrival_time ? \Carbon\Carbon::parse($employee->expected_arrival_time)->format('H:i') : '' }}">
                                            <label>Kelishi kerak bo'lgan vaqt</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="cardnumber" class="form-control" placeholder="Card raqami (NFC)" value="{{ $employee->cardnumber }}">
                                            <label>Card raqami (NFC)</label>
                                        </div>
                                    </div>

                                    <!-- 6-qator: Qo'shimcha parametrlar -->
                                    <div class="col-12">
                                        <p class="h6 py-2 mb-2">Qo'shimcha parametrlar</p>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check mb-3">
                                            <input type="checkbox" name="night_working" class="form-check-input" value="1" {{ $employee->night_working ? 'checked' : '' }} id="night_working">
                                            <label class="form-check-label">Kechki smena</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check mb-3">
                                            <input type="checkbox" name="parking" class="form-check-input" value="1" {{ $employee->parking ? 'checked' : '' }} id="parking">
                                            <label class="form-check-label">Avtoturargoh</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check mb-3">
                                            <input type="checkbox" name="office" class="form-check-input" value="1" {{ $employee->office ? 'checked' : '' }} id="office">
                                            <label class="form-check-label">Ofis</label>
                                        </div>
                                    </div>

                                    <!-- 7-qator: Ofis uchun qavat va xona -->
                                    <div class="col-md-4 office-fields" style="display: {{ $employee->office ? 'block' : 'none' }};">
                                        <div class="form-floating mb-3">
                                            <input type="number" name="floor" class="form-control" placeholder="Qavat" value="{{ $employee->floor }}">
                                            <label>Qavat</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 office-fields" style="display: {{ $employee->office ? 'block' : 'none' }};">
                                        <div class="form-floating mb-3">
                                            <input type="number" name="room" class="form-control" placeholder="Xona" value="{{ $employee->room }}">
                                            <label>Xona</label>
                                        </div>
                                    </div>

                                    <!-- 8-qator: Avtoturargoh uchun mashina raqami -->
                                    <div class="col-md-4 parking-fields" style="display: {{ $employee->parking ? 'block' : 'none' }};">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="car_number" class="form-control" placeholder="Mashina raqami" value="{{ $employee->car_number }}">
                                            <label>Mashina raqami</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Step 1 uchun saqlash tugmasi -->
                        <div class="mt-4 text-end">
                            <button type="button" class="btn btn-success save-step" data-step="1">
                                <i class="bi bi-check-circle"></i> Saqlash
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Step 2: Pasport va harbiy ma'lumotlar -->
                <div id="step-2" class="tab-pane fade">
                    <form id="step2Form">
                        @csrf
                        <!-- Pasport ma'lumotlari -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <p class="h6 py-2 mb-3 border-bottom">Pasport ma'lumotlari</p>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="passport[seria_raqam]" class="form-control" placeholder="AA 1234567" value="{{ $employee->passportInfo?->seria_raqam }}" required>
                                    <label>Seriya va raqam *</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="passport[kim_tomonidan_berilgan]" class="form-control" placeholder="IV BOB TUMAN" value="{{ $employee->passportInfo?->kim_tomonidan_berilgan }}" required>
                                    <label>Kim tomonidan berilgan *</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="date" name="passport[berilgan_sana]" class="form-control" value="{{ $employee->passportInfo?->berilgan_sana }}" required>
                                    <label>Berilgan sana *</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="date" name="passport[amal_qilish_muddati]" class="form-control" value="{{ $employee->passportInfo?->amal_qilish_muddati }}" required>
                                    <label>Amal qilish muddati *</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="passport[doimiy_yashash_joyi]" class="form-control" placeholder="Toshkent shahar" value="{{ $employee->passportInfo?->doimiy_yashash_joyi }}" required>
                                    <label>Doimiy yashash manzili *</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="passport[yashash_joyi]" class="form-control" placeholder="Toshkent shahar" value="{{ $employee->passportInfo?->yashash_joyi }}" required>
                                    <label>Hozirgi yashash manzili *</label>
                                </div>
                            </div>
                        </div>

                        <!-- Harbiy ma'lumotlar -->
                        <div class="row">
                            <div class="col-12">
                                <p class="h6 py-2 mb-3 border-bottom">Harbiy hisob ma'lumotlari</p>
                            </div>
                            
                            <!-- Harbiy status toggle buttonlari -->
                            <div class="col-12 mb-4">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="military-option">
                                            <input type="radio" name="military_status" id="military_called" value="called" class="military-radio d-none" {{ !$employee->militaryRecord || (!$employee->militaryRecord->hisob_guruhi && !$employee->militaryRecord->reason_unfit) ? 'checked' : '' }}>
                                            <label for="military_called" class="military-label btn btn-outline-primary w-100 py-3">
                                                <i class="bi bi-person-check fs-2 d-block mb-2"></i>
                                                <span class="fw-bold">Chaqiruvda</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="military-option">
                                            <input type="radio" name="military_status" id="military_served" value="served" class="military-radio d-none" {{ $employee->militaryRecord && $employee->militaryRecord->hisob_guruhi ? 'checked' : '' }}>
                                            <label for="military_served" class="military-label btn btn-outline-primary w-100 py-3">
                                                <i class="bi bi-shield-check fs-2 d-block mb-2"></i>
                                                <span class="fw-bold">Xizmat o'tagan</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="military-option">
                                            <input type="radio" name="military_status" id="military_unfit" value="unfit" class="military-radio d-none" {{ $employee->militaryRecord && $employee->militaryRecord->reason_unfit ? 'checked' : '' }}>
                                            <label for="military_unfit" class="military-label btn btn-outline-primary w-100 py-3">
                                                <i class="bi bi-person-x fs-2 d-block mb-2"></i>
                                                <span class="fw-bold">Yaroqsiz</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Yaroqsizlik sababi -->
                            <div class="col-12" id="unfit-reason-container" style="display: {{ $employee->militaryRecord && $employee->militaryRecord->reason_unfit ? 'block' : 'none' }};">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" name="military[reason_unfit]" placeholder="Yaroqsizligi sababini yozing" style="height: 100px;">{{ $employee->militaryRecord?->reason_unfit }}</textarea>
                                    <label>Yaroqsizligi sababi</label>
                                </div>
                            </div>

                            <!-- Harbiy ma'lumotlar formasi -->
                            <div id="military-fields" class="row" style="display: {{ $employee->militaryRecord && $employee->militaryRecord->hisob_guruhi ? 'block' : 'none' }};">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="military[hisob_guruhi]" class="form-control" placeholder="1-guruh" value="{{ $employee->militaryRecord?->hisob_guruhi }}">
                                        <label>Hisob guruhi</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="military[hisob_toifasi]" class="form-control" placeholder="1-toifa" value="{{ $employee->militaryRecord?->hisob_toifasi }}">
                                        <label>Hisob toifasi</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="military[harbiy_mutaxassislik]" class="form-control" placeholder="Tankchi" value="{{ $employee->militaryRecord?->harbiy_mutaxassislik }}">
                                        <label>Harbiy mutaxassislik</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="military[qoshin_turi]" class="form-control" placeholder="Quruqlik qo'shinlari" value="{{ $employee->militaryRecord?->qoshin_turi }}">
                                        <label>Qo'shin turi</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="military[xizmatga_yaroqliligi]" class="form-control" placeholder="Yaroqli" value="{{ $employee->militaryRecord?->xizmatga_yaroqliligi }}">
                                        <label>Xizmatga yaroqliligi</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="military[harbiy_unvoni]" class="form-control" placeholder="Serjant" value="{{ $employee->militaryRecord?->harbiy_unvoni }}">
                                        <label>Harbiy unvoni</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="military[mudofa_bolimi]" class="form-control" placeholder="1-bo'lim" value="{{ $employee->militaryRecord?->mudofa_bolimi }}">
                                        <label>Mudofaa bo'limi</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="military[maxsus_xisob]" class="form-control" placeholder="Maxsus hisob" value="{{ $employee->militaryRecord?->maxsus_xisob }}">
                                        <label>Maxsus hisob</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Step 2 uchun saqlash tugmasi -->
                        <div class="mt-4 text-end">
                            <button type="button" class="btn btn-secondary" onclick="showStep(1)">
                                <i class="bi bi-arrow-left"></i> Orqaga
                            </button>
                            <button type="button" class="btn btn-success save-step" data-step="2">
                                <i class="bi bi-check-circle"></i> Saqlash
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Step 3: Ta'lim va ish tajribasi -->
                <div id="step-3" class="tab-pane fade">
                    <form id="step3Form">
                        @csrf
                        <div class="row">
                            <!-- Ta'lim ma'lumotlari -->
                            <div class="col-md-12 mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <p class="h6 py-2 mb-0">Ta'lim ma'lumotlari</p>
                                    <button type="button" class="btn btn-sm btn-success" onclick="openEducationModal()">
                                        <i class="bi bi-plus-circle"></i> Ta'lim qo'shish
                                    </button>
                                </div>
                                
                                <!-- Ta'lim ma'lumotlari jadvali -->
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover" id="educationTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Ta'lim darajasi</th>
                                                <th>O'quv muassasasi</th>
                                                <th>Mutaxassislik</th>
                                                <th>Boshlanish sanasi</th>
                                                <th>Tugash sanasi</th>
                                                <th>Diplom/Atestat raqami</th>
                                                <th width="120px">Harakatlar</th>
                                            </tr>
                                        </thead>
                                        <tbody id="educationTableBody">
                                            @foreach($employee->educations as $education)
                                            <tr data-id="{{ $education->id }}" data-type="{{ $education->degree_type }}">
                                                <td>{{ $education->degree_type }}</td>
                                                <td>
                                                    @if($education->university) {{ $education->university->name }}
                                                    @elseif($education->college) {{ $education->college->name }}
                                                    @elseif($education->school) {{ $education->school->name }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($education->speciality) {{ $education->speciality }}
                                                    @elseif($education->faculty) {{ $education->faculty->name }}
                                                    @endif
                                                </td>
                                                <td>{{ $education->start_date ? \Carbon\Carbon::parse($education->start_date)->format('d.m.Y') : '' }}</td>
                                                <td>
                                                    @if($education->degree_type == 'Tugallanmagan oliy')
                                                    {{ $education->course }}-kurs
                                                    @else
                                                    {{ $education->end_date ? \Carbon\Carbon::parse($education->end_date)->format('d.m.Y') : '' }}
                                                    @endif
                                                </td>
                                                <td>{{ $education->diploma_number ?: $education->certificate_number ?: '-' }}</td>
                                                <td>
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <button type="button" class="btn btn-outline-primary" onclick="editEducation({{ $education->id }})" title="Tahrirlash">
                                                            <i class="bi bi-pencil"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-outline-danger" onclick="deleteEducation({{ $education->id }})" title="O'chirish">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Ish tajribasi -->
                            <div class="col-md-12">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <p class="h6 py-2 mb-0">Ish tajribasi</p>
                                    <button type="button" class="btn btn-sm btn-success" onclick="showWorkExperienceForm()">
                                        <i class="bi bi-plus-circle"></i> Ish tajribasi qo'shish
                                    </button>
                                </div>
                                
                                <!-- Ish tajribasi jadvali -->
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover" id="workExperienceTable">
                                        <thead class="table-light">
                                               <tr>
                                                    <th>Tashkilot nomi</th>
                                                    <th>Lavozim</th>
                                                    <th>Boshlanish sanasi</th>
                                                    <th>Tugash sanasi</th>
                                                    <th>Shartnoma raqami</th>
                                                    <th>Shartnoma sanasi</th>
                                                    <th width="120px">Harakatlar</th>
                                                </tr>
                                        </thead>
                                        <tbody id="workExperienceTableBody">
                                            @foreach($employee->workExperiences as $work)
                                            <tr data-id="{{ $work->id }}">
                                                <td>{{ $work->tashkilot_nomi }}</td>
                                                <td>{{ $work->lavozim }}</td>
                                                <td>{{ \Carbon\Carbon::parse($work->kirgan_sanasi)->format('d.m.Y') }}</td>
                                                <td>
                                                    @if($work->current_job)
                                                    <span class="badge bg-success">Hozirgi ish</span>
                                                    @else
                                                    {{ \Carbon\Carbon::parse($work->boshagan_sanasi)->format('d.m.Y') }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($work->current_job)
                                                    <span class="badge bg-success">Hozirgi ish</span>
                                                    @else
                                                    <span class="badge bg-secondary">Tugatilgan</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <button type="button" class="btn btn-outline-primary" onclick="editWorkExperience({{ $work->id }})" title="Tahrirlash">
                                                            <i class="bi bi-pencil"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-outline-danger" onclick="deleteWorkExperience({{ $work->id }})" title="O'chirish">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Step 3 uchun saqlash tugmasi -->
                        <div class="mt-4 text-end">
                            <button type="button" class="btn btn-secondary" onclick="showStep(2)">
                                <i class="bi bi-arrow-left"></i> Orqaga
                            </button>
                            <button type="button" class="btn btn-success save-step" data-step="3">
                                <i class="bi bi-check-circle"></i> Saqlash
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Step 4: Qarindoshlar -->
                <div id="step-4" class="tab-pane fade">
                    <form id="step4Form">
                        @csrf
                        <p class="h6 py-2 mb-3">Qarindoshlik ma'lumotlari</p>
                        <div id="relatives-container">
                            @foreach($employee->relatives as $index => $relative)
                            <div class="relative-item border p-3 mb-3 rounded">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="relatives[{{ $index }}][qarindoshlik]" class="form-control" placeholder="Qarindoshlik darajasi" value="{{ $relative->qarindoshlik }}">
                                            <label>Qarindoshlik darajasi</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="relatives[{{ $index }}][familiyasi]" class="form-control" placeholder="Familiyasi" value="{{ $relative->familiyasi }}">
                                            <label>Familiyasi</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="relatives[{{ $index }}][ismi]" class="form-control" placeholder="Ismi" value="{{ $relative->ismi }}">
                                            <label>Ismi</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="relatives[{{ $index }}][sharfi]" class="form-control" placeholder="Sharifi" value="{{ $relative->sharfi }}">
                                            <label>Sharifi</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="number" name="relatives[{{ $index }}][tugilgan_yili]" class="form-control" placeholder="Tug'ilgan yili" value="{{ $relative->tugilgan_yili }}">
                                            <label>Tug'ilgan yili</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="relatives[{{ $index }}][ishi_joyi]" class="form-control" placeholder="Ish joyi" value="{{ $relative->ishi_joyi }}">
                                            <label>Ish joyi</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="relatives[{{ $index }}][lavozimi]" class="form-control" placeholder="Lavozimi" value="{{ $relative->lavozimi }}">
                                            <label>Lavozimi</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="relatives[{{ $index }}][tugilgan_joy_soato]" class="form-control" placeholder="Tug'ilgan joyi (SOATO)" value="{{ $relative->tugilgan_joy_soato }}">
                                            <label>Tug'ilgan joyi (SOATO)</label>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-sm btn-danger remove-relative" onclick="removeRelative(this)">O'chirish</button>
                            </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-sm btn-success" onclick="addRelative()">+ Qarindosh qo'shish</button>
                        
                        <!-- Step 4 uchun saqlash tugmasi -->
                        <div class="mt-4 text-end">
                            <button type="button" class="btn btn-secondary" onclick="showStep(3)">
                                <i class="bi bi-arrow-left"></i> Orqaga
                            </button>
                            <button type="button" class="btn btn-success save-step" data-step="4">
                                <i class="bi bi-check-circle"></i> Saqlash
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Step 5: Qo'shimcha ma'lumotlar -->
                <div id="step-5" class="tab-pane fade">
                    <form id="step5Form">
                        @csrf
                        <p class="h6 py-2 mb-3">Qo'shimcha ma'lumotlar</p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="additional[soliq_id]" class="form-control" placeholder="Soliq ID" value="{{ $employee->additionalInfo?->soliq_id }}">
                                    <label>Soliq ID</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="additional[inps]" class="form-control" placeholder="INPS" value="{{ $employee->additionalInfo?->inps }}">
                                    <label>INPS</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="text" name="additional[qiziqishlari]" class="form-control" placeholder="Qiziqishlari" value="{{ $employee->additionalInfo?->qiziqishlari }}">
                                    <label>Qiziqishlari</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="additional[haydovchilik_guvohnomasi]" class="form-control" placeholder="Haydovchilik guvohnomasi" value="{{ $employee->additionalInfo?->haydovchilik_guvohnomasi }}">
                                    <label>Haydovchilik guvohnomasi</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="additional[davlat_mukofoti]" class="form-control" placeholder="Davlat mukofoti" value="{{ $employee->additionalInfo?->davlat_mukofoti }}">
                                    <label>Davlat mukofoti</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="text" name="additional[boy]" class="form-control" placeholder="Bo'y" value="{{ $employee->additionalInfo?->boy }}">
                                    <label>Bo'y</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="text" name="additional[vazn]" class="form-control" placeholder="Vazn" value="{{ $employee->additionalInfo?->vazn }}">
                                    <label>Vazn</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input type="text" name="additional[bosh_razmer]" class="form-control" placeholder="Bosh razmeri" value="{{ $employee->additionalInfo?->bosh_razmer }}">
                                    <label>Bosh razmeri</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check mb-3">
                                    <input type="checkbox" name="additional[akfa_tanish]" class="form-check-input" value="1" {{ $employee->additionalInfo?->akfa_tanish ? 'checked' : '' }}>
                                    <label class="form-check-label">Akfa tanish</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check mb-3">
                                    <input type="checkbox" name="additional[sudlanganmi]" class="form-check-input" value="1" {{ $employee->additionalInfo?->sudlanganmi ? 'checked' : '' }}>
                                    <label class="form-check-label">Sudlanganmi</label>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Step 5 uchun saqlash tugmasi -->
                        <div class="mt-4 text-end">
                            <button type="button" class="btn btn-secondary" onclick="showStep(4)">
                                <i class="bi bi-arrow-left"></i> Orqaga
                            </button>
                            <button type="button" class="btn btn-primary save-step" data-step="5">
                                <i class="bi bi-check-circle"></i> Yakuniy saqlash
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Ta'lim qo'shish modal oynasi -->
<div class="modal fade" id="educationModal" tabindex="-1" aria-labelledby="educationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="educationModalLabel">Ta'lim ma'lumotlarini qo'shish</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="list-group">
                    <a href="javascript:void(0)" class="list-group-item list-group-item-action" onclick="addEducation('Tugallanmagan oliy')">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">Tugallanmagan oliy</h6>
                        </div>
                        <p class="mb-1">Oliy ta'lim muassasasida hozirda o'qiyotgan talaba</p>
                    </a>
                    <a href="javascript:void(0)" class="list-group-item list-group-item-action" onclick="addEducation('Bakalavr')">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">Bakalavr</h6>
                        </div>
                        <p class="mb-1">Oliy ta'limni bakalavr darajasida tamomlagan</p>
                    </a>
                    <a href="javascript:void(0)" class="list-group-item list-group-item-action" onclick="addEducation('Magistr')">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">Magistr</h6>
                        </div>
                        <p class="mb-1">Oliy ta'limni magistr darajasida tamomlagan</p>
                    </a>
                    <a href="javascript:void(0)" class="list-group-item list-group-item-action" onclick="addEducation('O\'rta maxsus')">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">O'rta maxsus</h6>
                        </div>
                        <p class="mb-1">Kollej yoki litseyni tamomlagan</p>
                    </a>
                    <a href="javascript:void(0)" class="list-group-item list-group-item-action" onclick="addEducation('O\'rta')">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">O'rta</h6>
                        </div>
                        <p class="mb-1">Maktabni tamomlagan</p>
                    </a>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
            </div>
        </div>
    </div>
</div>

<!-- Ta'lim formasi modal oynasi -->
<div class="modal fade" id="educationFormModal" tabindex="-1" aria-labelledby="educationFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="educationFormModalLabel">Ta'lim ma'lumotlarini qo'shish</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="educationFormModalBody">
                <!-- Form kontenti JavaScript orqali to'ldiriladi -->
            </div>
        </div>
    </div>
</div>

<!-- Ish tajribasi formasi modal oynasi -->
<!-- Work Experience Modal -->
<div class="modal fade" id="workExperienceModal" tabindex="-1" aria-labelledby="workExperienceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="workExperienceModalLabel">Ish tajribasini qo'shish</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="workExperienceForm">
                    <input type="hidden" name="work_experience_id" id="workExperienceId">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" name="tashkilot_nomi" id="workTashkilotNomi" class="form-control" placeholder="Tashkilot nomi" required>
                                <label for="workTashkilotNomi">Tashkilot nomi *</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" name="lavozim" id="workLavozim" class="form-control" placeholder="Lavozim" required>
                                <label for="workLavozim">Lavozim *</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="date" name="kirgan_sanasi" id="workKirganSanasi" class="form-control" required>
                                <label for="workKirganSanasi">Kirgan sanasi *</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="date" name="boshagan_sanasi" id="workBoshaganSanasi" class="form-control">
                                <label for="workBoshaganSanasi">Tugatgan sanasi</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" name="shartnoma_raqami" id="workShartnomaRaqami" class="form-control" placeholder="Shartnoma raqami">
                                <label for="workShartnomaRaqami">Shartnoma raqami</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="date" name="shartnoma_tuzilgan_sana" id="workShartnomaSana" class="form-control">
                                <label for="workShartnomaSana">Shartnoma tuzilgan sana</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check mb-3">
                                <input type="checkbox" name="current_job" id="workCurrentJob" class="form-check-input" value="1" onchange="toggleWorkEndDate()">
                                <label class="form-check-label" for="workCurrentJob">Hozirgi ish joyi</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                <button type="button" class="btn btn-success" onclick="saveWorkExperience()">
                    <i class="bi bi-check-circle"></i> Saqlash
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    /* Modal o'lchamlarini bir xil qilish */
#educationFormModal .modal-dialog,
#workExperienceModal .modal-dialog {
    max-width: 800px; /* Bir xil kenglik */
    width: 95%;
}

/* Responsive dizayn */
@media (max-width: 768px) {
    #educationFormModal .modal-dialog,
    #workExperienceModal .modal-dialog {
        max-width: 95%;
        margin: 1rem auto;
    }
}

/* Form elementlari uchun bir xil stil */
.modal-body .form-floating {
    margin-bottom: 1rem;
}

.modal-body .row {
    margin-bottom: 0.5rem;
}
.military-option {
    position: relative;
}

.military-label {
    border: 2px solid #dee2e6;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
}

.military-label:hover {
    border-color: #007bff;
    background-color: #f8f9fa;
}

.military-radio:checked + .military-label {
    border-color: #007bff;
    background-color: #007bff;
    color: white;
    box-shadow: 0 0 10px rgba(0, 123, 255, 0.3);
}

.office-fields, .parking-fields {
    transition: all 0.3s ease;
}

.work-item, .relative-item, .education-item {
    position: relative;
    transition: all 0.3s ease;
}

.work-item:hover, .relative-item:hover, .education-item:hover {
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.list-group-item {
    border: none;
    padding: 15px 20px;
    margin-bottom: 5px;
    border-radius: 8px !important;
    transition: all 0.3s ease;
}

.list-group-item:hover {
    background-color: #007bff;
    color: white;
    transform: translateX(5px);
}

.nav-link.active {
    background-color: #007bff !important;
    color: white !important;
}

.save-step {
    margin-left: 10px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Employee form initialized successfully');
    
    // Telefon formati
    const phoneInput = document.getElementById("phone");
    if (phoneInput) {
        phoneInput.addEventListener("input", function () {
            let val = this.value;
            let digits = val.replace(/\D/g, "");

            if (!digits.startsWith("998")) {
                if (digits.length === 9) {
                    digits = "998" + digits;
                }
            }

            digits = digits.substring(0, 12);

            let formatted = "+998 ";
            if (digits.length > 3) formatted += digits.substring(3, 5);
            if (digits.length > 5) formatted += " " + digits.substring(5, 8);
            if (digits.length > 8) formatted += " " + digits.substring(8, 10);
            if (digits.length > 10) formatted += " " + digits.substring(10, 12);

            this.value = formatted;
        });

        if (phoneInput.value && phoneInput.value !== '+998 ') {
            phoneInput.dispatchEvent(new Event('input'));
        }
    }

    // Harbiy ma'lumotlar toggle sistemasi
    const militaryRadios = document.querySelectorAll('.military-radio');
    const militaryFields = document.getElementById('military-fields');
    const unfitReasonContainer = document.getElementById('unfit-reason-container');

    function updateMilitaryFields() {
        const selectedRadio = document.querySelector('input[name="military_status"]:checked');
        
        if (!selectedRadio) {
            if (militaryFields) militaryFields.style.display = 'none';
            if (unfitReasonContainer) unfitReasonContainer.style.display = 'none';
            return;
        }

        const value = selectedRadio.value;

        if (value === 'served') {
            if (militaryFields) militaryFields.style.display = 'block';
            if (unfitReasonContainer) unfitReasonContainer.style.display = 'none';
        } else if (value === 'unfit') {
            if (militaryFields) militaryFields.style.display = 'none';
            if (unfitReasonContainer) unfitReasonContainer.style.display = 'block';
        } else {
            if (militaryFields) militaryFields.style.display = 'none';
            if (unfitReasonContainer) unfitReasonContainer.style.display = 'none';
        }
    }

    militaryRadios.forEach(radio => {
        radio.addEventListener('change', updateMilitaryFields);
    });

    // Ofis va Parking maydonlari
    const officeCheckbox = document.getElementById('office');
    const officeFields = document.querySelectorAll('.office-fields');
    const parkingCheckbox = document.getElementById('parking');
    const parkingFields = document.querySelectorAll('.parking-fields');

    function updateOptionalFields() {
        // Ofis maydonlari
        if (officeCheckbox && officeCheckbox.checked) {
            officeFields.forEach(field => {
                field.style.display = 'block';
            });
        } else {
            officeFields.forEach(field => {
                field.style.display = 'none';
            });
        }

        // Parking maydonlari
        if (parkingCheckbox && parkingCheckbox.checked) {
            parkingFields.forEach(field => {
                field.style.display = 'block';
            });
        } else {
            parkingFields.forEach(field => {
                field.style.display = 'none';
            });
        }
    }

    updateOptionalFields();

    if (officeCheckbox) {
        officeCheckbox.addEventListener('change', updateOptionalFields);
    }
    if (parkingCheckbox) {
        parkingCheckbox.addEventListener('change', updateOptionalFields);
    }

    // Saqlash tugmalariga event listener qo'shish
    document.querySelectorAll('.save-step').forEach(button => {
        button.addEventListener('click', function() {
            const step = parseInt(this.getAttribute('data-step'));
            saveStep(step);
        });
    });

    // Rasmni ko'rsatish
    window.previewImage = function(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const avatarFigure = document.querySelector('.coverimg');
                avatarFigure.style.backgroundImage = `url(${e.target.result})`;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
});

// ==================== STEP FUNKSIYALARI ====================

// Step ko'rsatish funksiyasi
function showStep(stepIndex) {
    const tabPanes = document.querySelectorAll('.tab-pane');
    const navLinks = document.querySelectorAll('.nav-link');
    
    // Barcha tab-pane va nav-link larni yashirish
    tabPanes.forEach(pane => {
        pane.classList.remove('show', 'active');
    });
    navLinks.forEach(link => {
        link.classList.remove('active');
    });
    
    // Faqat tanlangan step ni ko'rsatish
    tabPanes[stepIndex].classList.add('show', 'active');
    navLinks[stepIndex].classList.add('active');
}

// Step saqlash funksiyasi
function saveStep(step) {
    console.log('Saving step:', step);
    
    // Form ma'lumotlarini yig'ish
    const form = document.getElementById(`step${step}Form`);
    if (!form) {
        console.error(`Step ${step} form not found`);
        showToast(`Step ${step} form topilmadi`, 'error');
        return;
    }
    
    const formData = new FormData(form);

    // Debug: form ma'lumotlarini ko'rsatish
    console.log('Form data for step', step);
    for (let [key, value] of formData.entries()) {
        console.log(key + ': ' + value);
    }

    // Saqlash indikatorini ko'rsatish
    const saveButton = document.querySelector(`.save-step[data-step="${step}"]`);
    const originalText = saveButton.innerHTML;
    saveButton.innerHTML = '<i class="bi bi-hourglass-split"></i> Saqlanmoqda...';
    saveButton.disabled = true;

    // AJAX orqali saqlash
    fetch(`/employees/{{ $employee->id }}/update-step/${step}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(response => {
        console.log('Response status:', response.status);
        if (!response.ok) {
            return response.text().then(text => {
                console.log('Response text:', text);
                throw new Error(`HTTP error! status: ${response.status}, response: ${text}`);
            });
        }
        return response.json();
    })
    .then(data => {
        console.log('Response data:', data);
        
        if (data.success) {
            showToast(data.message, 'success');
            // Keyingi stepga o'tish (agar soxta bo'lsa)
            if (step < 5) {
                showStep(step);
            }
        } else {
            if (data.errors) {
                let errorMessages = Object.values(data.errors).flat().join(', ');
                showToast('Validatsiya xatolari: ' + errorMessages, 'error');
            } else {
                throw new Error(data.message || 'Xatolik yuz berdi');
            }
        }
    })
    .catch(error => {
        console.error('Xatolik:', error);
        showToast('Saqlashda xatolik yuz berdi: ' + error.message, 'error');
    })
    .finally(() => {
        // Tugmani qayta tiklash
        saveButton.innerHTML = originalText;
        saveButton.disabled = false;
    });
}

// ==================== TA'LIM FUNKSIYALARI ====================

function openEducationModal() {
    const modal = new bootstrap.Modal(document.getElementById('educationModal'));
    modal.show();
}

function addEducation(degreeType) {
    const modal = bootstrap.Modal.getInstance(document.getElementById('educationModal'));
    if (modal) {
        modal.hide();
    }
    
    showEducationForm(null, degreeType);
}

function showEducationForm(educationId = null, degreeType = null) {
    console.log('showEducationForm called with:', { educationId, degreeType });
    
    if (educationId) {
        // Tahrirlash rejimi
        loadEducationData(educationId);
    } else {
        // Qo'shish rejimi
        loadEducationForm(degreeType);
    }
}
function loadEducationForm(degreeType) {
    console.log('Loading education form for:', degreeType);
    
    let formHTML = `<form id="educationForm">
        <!-- degree_type hidden input qo'shish -->
        <input type="hidden" name="degree_type" value="${degreeType}">
        <input type="hidden" name="education_id" id="educationId">`;
    
    switch(degreeType) {
        case 'Tugallanmagan oliy':
            formHTML += getUnfinishedHigherForm();
            break;
        case 'Bakalavr':
        case 'Magistr':
            formHTML += getHigherEducationForm(degreeType);
            break;
        case 'O\'rta maxsus':
            formHTML += getSecondarySpecialForm();
            break;
        case 'O\'rta':
            formHTML += getSecondaryForm();
            break;
    }
    
    formHTML += `
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Bekor qilish</button>
                    <button type="button" class="btn btn-success" onclick="saveEducation()">
                        <i class="bi bi-check-circle"></i> Saqlash
                    </button>
                </div>
            </div>
        </div>
    </form>`;
    
    document.getElementById('educationFormModalBody').innerHTML = formHTML;
    document.getElementById('educationFormModalLabel').textContent = "Ta'lim ma'lumotlarini qo'shish";
    
    const modal = new bootstrap.Modal(document.getElementById('educationFormModal'));
    modal.show();
}
function loadEducationData(educationId) {
    console.log('Loading education data for ID:', educationId);
    
    fetch(`/employees/{{ $employee->id }}/education/${educationId}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => {
        console.log('Response status:', response.status);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('Education data loaded:', data);
        if (data.success) {
            const education = data.education;
            
            // Modal sarlavhasini o'zgartirish
            document.getElementById('educationFormModalLabel').textContent = "Ta'lim ma'lumotlarini tahrirlash";
            
            // Formani yuklash
            loadEducationForm(education.degree_type);
            
            // Formani ma'lumotlar bilan to'ldirish
            setTimeout(() => {
                const form = document.getElementById('educationForm');
                if (form) {
                    // ID ni to'g'ri o'rnatish
                    document.getElementById('educationId').value = education.id;
                    
                    // degree_type ni to'g'ri o'rnatish
                    const degreeTypeInput = form.querySelector('input[name="degree_type"]');
                    if (degreeTypeInput) {
                        degreeTypeInput.value = education.degree_type;
                    }
                    
                    // Barcha maydonlarni to'ldirish
                    Object.keys(education).forEach(key => {
                        const input = form.querySelector(`[name="${key}"]`);
                        if (input && education[key] !== null) {
                            // Sanalarni to'g'ri formatda ko'rsatish
                            if (key.includes('_date') && education[key]) {
                                const date = new Date(education[key]);
                                input.value = date.toISOString().split('T')[0];
                            } else {
                                input.value = education[key];
                            }
                        }
                    });
                    
                    // Selectlarni to'ldirish
                    const selects = form.querySelectorAll('select');
                    selects.forEach(select => {
                        const value = education[select.name];
                        if (value !== null && value !== undefined) {
                            select.value = value;
                        }
                    });
                    
                    console.log('Form filled with data');
                }
            }, 100);
        } else {
            throw new Error(data.message || 'Ma\'lumotlarni yuklashda xatolik');
        }
    })
    .catch(error => {
        console.error('Xatolik:', error);
        showToast('Ma\'lumotlarni yuklashda xatolik: ' + error.message, 'error');
    });
}
// ==================== TA'LIM FUNKSIYALARI ====================

function saveEducation() {
    console.log('saveEducation function called');
    
    const form = document.getElementById('educationForm');
    console.log('Education form:', form);
    
    if (!form) {
        console.error('Education form not found!');
        showToast('Ta\'lim formasi topilmadi.', 'error');
        return;
    }
    
    // FormData o'rniga oddiy object yaratish
    const formData = new FormData(form);
    const data = {};
    
    // FormData ni object ga aylantirish
    for (let [key, value] of formData.entries()) {
        data[key] = value;
    }
    
    // Debug: form ma'lumotlarini ko'rsatish
    console.log('Form data for education:', data);
    
    // Majburiy maydonlarni tekshirish
    const degreeType = data.degree_type;
    const startDate = data.start_date;
    
    console.log('Degree type:', degreeType);
    console.log('Start date:', startDate);
    
    if (!degreeType || !startDate) {
        showToast('Iltimos, barcha majburiy maydonlarni to\'ldiring', 'error');
        return;
    }
    
    const educationId = document.getElementById('educationId')?.value || '';
    const url = educationId 
        ? `/employees/{{ $employee->id }}/education/${educationId}`
        : `/employees/{{ $employee->id }}/education`;
        
    const method = educationId ? 'PUT' : 'POST';
    
    console.log('Sending request to:', url, 'Method:', method);
    
    const saveButton = document.querySelector('#educationFormModal .btn-success');
    if (!saveButton) {
        console.error('Save button not found');
        showToast('Saqlash tugmasi topilmadi', 'error');
        return;
    }
    
    const originalText = saveButton.innerHTML;
    saveButton.innerHTML = '<i class="bi bi-hourglass-split"></i> Saqlanmoqda...';
    saveButton.disabled = true;
    
    // FormData o'rniga JSON yuborish
    fetch(url, {
        method: method,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        console.log('Response status:', response.status);
        if (!response.ok) {
            return response.text().then(text => {
                console.log('Response text:', text);
                throw new Error(`HTTP error! status: ${response.status}, response: ${text}`);
            });
        }
        return response.json();
    })
    .then(data => {
        console.log('Response data:', data);
        
        if (data.success) {
            showToast(data.message, 'success');
            const modal = bootstrap.Modal.getInstance(document.getElementById('educationFormModal'));
            if (modal) modal.hide();
            refreshEducationTable();
        } else {
            if (data.errors) {
                let errorMessages = Object.values(data.errors).flat().join(', ');
                showToast('Validatsiya xatolari: ' + errorMessages, 'error');
            } else {
                showToast(data.message || 'Saqlashda xatolik', 'error');
            }
        }
    })
    .catch(error => {
        console.error('Xatolik:', error);
        showToast('Saqlashda xatolik yuz berdi: ' + error.message, 'error');
    })
    .finally(() => {
        saveButton.innerHTML = originalText;
        saveButton.disabled = false;
    });
}
function loadEducationData(educationId) {
    console.log('Loading education data for ID:', educationId);
    
    fetch(`/employees/{{ $employee->id }}/education/${educationId}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => {
        console.log('Response status:', response.status);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('Education data loaded:', data);
        if (data.success) {
            const education = data.education;
            
            // Modal sarlavhasini o'zgartirish
            document.getElementById('educationFormModalLabel').textContent = "Ta'lim ma'lumotlarini tahrirlash";
            
            // Formani yuklash
            loadEducationForm(education.degree_type);
            
            // Formani ma'lumotlar bilan to'ldirish
            setTimeout(() => {
                const form = document.getElementById('educationForm');
                if (form) {
                    document.getElementById('educationId').value = education.id;
                    
                    // Barcha maydonlarni to'ldirish
                    Object.keys(education).forEach(key => {
                        const input = form.querySelector(`[name="${key}"]`);
                        if (input && education[key] !== null) {
                            // Sanalarni to'g'ri formatda ko'rsatish
                            if (key.includes('_date') && education[key]) {
                                const date = new Date(education[key]);
                                input.value = date.toISOString().split('T')[0];
                            } else {
                                input.value = education[key];
                            }
                        }
                    });
                    
                    // Selectlarni to'ldirish
                    const selects = form.querySelectorAll('select');
                    selects.forEach(select => {
                        const value = education[select.name];
                        if (value !== null && value !== undefined) {
                            select.value = value;
                        }
                    });
                }
            }, 100);
        } else {
            throw new Error(data.message || 'Ma\'lumotlarni yuklashda xatolik');
        }
    })
    .catch(error => {
        console.error('Xatolik:', error);
        showToast('Ma\'lumotlarni yuklashda xatolik: ' + error.message, 'error');
    });
}
function editEducation(educationId) {
    showEducationForm(educationId);
}

function deleteEducation(educationId) {
    if (confirm('Haqiqatan ham ushbu ta\'lim ma\'lumotini o\'chirmoqchimisiz?')) {
        fetch(`/employees/{{ $employee->id }}/education/${educationId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                showToast(data.message, 'success');
                refreshEducationTable();
            } else {
                showToast(data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Xatolik:', error);
            showToast('O\'chirishda xatolik yuz berdi', 'error');
        });
    }
}

function refreshEducationTable() {
    fetch(`/employees/{{ $employee->id }}/educations`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.text();
    })
    .then(html => {
        document.getElementById('educationTableBody').innerHTML = html;
    })
    .catch(error => {
        console.error('Xatolik:', error);
        showToast('Jadvalni yangilashda xatolik', 'error');
    });
}

// ==================== ISH TAJRIBASI FUNKSIYALARI ====================

function showWorkExperienceForm(workId = null) {
    console.log('showWorkExperienceForm called with:', workId);
    
    const modal = new bootstrap.Modal(document.getElementById('workExperienceModal'));
    
    if (workId) {
        // Tahrirlash rejimi
        document.getElementById('workExperienceModalLabel').textContent = "Ish tajribasini tahrirlash";
        
        // Ma'lumotlarni serverdan olish va forma bilan to'ldirish
        fetch(`/employees/{{ $employee->id }}/work-experience/${workId}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                const work = data.workExperience;
                
                // Formani ma'lumotlar bilan to'ldirish
                document.getElementById('workExperienceId').value = work.id;
                document.getElementById('workTashkilotNomi').value = work.tashkilot_nomi;
                document.getElementById('workLavozim').value = work.lavozim;
                document.getElementById('workKirganSanasi').value = work.kirgan_sanasi ? new Date(work.kirgan_sanasi).toISOString().split('T')[0] : '';
                document.getElementById('workBoshaganSanasi').value = work.boshagan_sanasi ? new Date(work.boshagan_sanasi).toISOString().split('T')[0] : '';
                document.getElementById('workShartnomaRaqami').value = work.shartnoma_raqami || '';
                document.getElementById('workShartnomaSana').value = work.shartnoma_tuzilgan_sana ? new Date(work.shartnoma_tuzilgan_sana).toISOString().split('T')[0] : '';
                document.getElementById('workCurrentJob').checked = work.current_job;
                
                toggleWorkEndDate();
            } else {
                throw new Error(data.message || 'Ma\'lumotlarni yuklashda xatolik');
            }
        })
        .catch(error => {
            console.error('Xatolik:', error);
            showToast('Ma\'lumotlarni yuklashda xatolik: ' + error.message, 'error');
        });
    } else {
        // Qo'shish rejimi
        document.getElementById('workExperienceModalLabel').textContent = "Ish tajribasini qo'shish";
        resetWorkExperienceForm();
    }
    
    modal.show();
}

function resetWorkExperienceForm() {
    document.getElementById('workExperienceId').value = '';
    document.getElementById('workExperienceForm').reset();
    document.getElementById('workCurrentJob').checked = false;
    toggleWorkEndDate();
}
function loadWorkExperienceData(workId) {
    console.log('Loading work experience data for ID:', workId);
    
    fetch(`/employees/{{ $employee->id }}/work-experience/${workId}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => {
        console.log('Response status:', response.status);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('Work experience data loaded:', data);
        if (data.success) {
            const work = data.workExperience;
            
            document.getElementById('workExperienceId').value = work.id;
            document.getElementById('workTashkilotNomi').value = work.tashkilot_nomi;
            document.getElementById('workLavozim').value = work.lavozim;
            document.getElementById('workKirganSanasi').value = work.kirgan_sanasi;
            document.getElementById('workBoshaganSanasi').value = work.boshagan_sanasi;
            document.getElementById('workCurrentJob').checked = work.current_job;
            
            toggleWorkEndDate();
        }
    })
    .catch(error => {
        console.error('Xatolik:', error);
        showToast('Ma\'lumotlarni yuklashda xatolik: ' + error.message, 'error');
    });
}

function resetWorkExperienceForm() {
    document.getElementById('workExperienceId').value = '';
    document.getElementById('workExperienceForm').reset();
    document.getElementById('workCurrentJob').checked = false;
    toggleWorkEndDate();
}
function toggleWorkEndDate() {
    const currentJobCheckbox = document.getElementById('workCurrentJob');
    const endDateInput = document.getElementById('workBoshaganSanasi');
    
    if (!currentJobCheckbox || !endDateInput) {
        console.error('Work experience form elements not found');
        return;
    }
    
    if (currentJobCheckbox.checked) {
        endDateInput.disabled = true;
        endDateInput.value = '';
        endDateInput.removeAttribute('required');
    } else {
        endDateInput.disabled = false;
        endDateInput.setAttribute('required', 'required');
    }
}

// ==================== ISH TAJRIBASI FUNKSIYALARI ====================
function saveWorkExperience() {
    console.log('saveWorkExperience function called');
    
    const form = document.getElementById('workExperienceForm');
    if (!form) {
        showToast('Ish tajribasi formasi topilmadi.', 'error');
        return;
    }
    
    // Form ma'lumotlarini object ga aylantirish
    const formData = {
        tashkilot_nomi: document.getElementById('workTashkilotNomi').value,
        lavozim: document.getElementById('workLavozim').value,
        kirgan_sanasi: document.getElementById('workKirganSanasi').value,
        boshagan_sanasi: document.getElementById('workBoshaganSanasi').value,
        shartnoma_raqami: document.getElementById('workShartnomaRaqami').value,
        shartnoma_tuzilgan_sana: document.getElementById('workShartnomaSana').value,
        current_job: document.getElementById('workCurrentJob').checked ? 1 : 0
    };
    
    const workId = document.getElementById('workExperienceId')?.value || '';
    
    // URL va methodni aniqlash
    let url, method;
    
    if (workId) {
        url = `/employees/{{ $employee->id }}/work-experience/${workId}`;
        method = 'PUT';
        formData.work_experience_id = workId;
    } else {
        url = `/employees/{{ $employee->id }}/work-experience`;
        method = 'POST';
    }
    
    console.log('Sending request to:', url, 'Method:', method);
    console.log('Data:', formData);
    
    const saveButton = document.querySelector('#workExperienceModal .btn-success');
    if (!saveButton) {
        showToast('Saqlash tugmasi topilmadi', 'error');
        return;
    }
    
    const originalText = saveButton.innerHTML;
    saveButton.innerHTML = '<i class="bi bi-hourglass-split"></i> Saqlanmoqda...';
    saveButton.disabled = true;
    
    fetch(url, {
        method: method,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(formData)
    })
    .then(response => {
        console.log('Response status:', response.status);
        if (!response.ok) {
            return response.text().then(text => {
                console.log('Response text:', text);
                throw new Error(`HTTP error! status: ${response.status}`);
            });
        }
        return response.json();
    })
    .then(data => {
        console.log('Response data:', data);
        
        if (data.success) {
            showToast(data.message, 'success');
            const modal = bootstrap.Modal.getInstance(document.getElementById('workExperienceModal'));
            if (modal) modal.hide();
            refreshWorkExperienceTable();
        } else {
            if (data.errors) {
                let errorMessages = Object.values(data.errors).flat().join(', ');
                showToast('Validatsiya xatolari: ' + errorMessages, 'error');
            } else {
                showToast(data.message || 'Saqlashda xatolik', 'error');
            }
        }
    })
    .catch(error => {
        console.error('Xatolik:', error);
        showToast('Saqlashda xatolik yuz berdi: ' + error.message, 'error');
    })
    .finally(() => {
        saveButton.innerHTML = originalText;
        saveButton.disabled = false;
    });
}
function editWorkExperience(workId) {
    console.log('Editing work experience with ID:', workId);
    
    // GET so'rovini to'g'ri URL ga yuborish
    fetch(`/employees/{{ $employee->id }}/work-experience/${workId}`, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => {
        console.log('Response status:', response.status);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('Work experience data loaded:', data);
        if (data.success) {
            showWorkExperienceForm(workId); // Ma'lumotlarni forma bilan to'ldirish
        } else {
            throw new Error(data.message || 'Ma\'lumotlarni yuklashda xatolik');
        }
    })
    .catch(error => {
        console.error('Xatolik:', error);
        showToast('Ma\'lumotlarni yuklashda xatolik: ' + error.message, 'error');
    });
}
function deleteWorkExperience(workId) {
    if (confirm('Haqiqatan ham ushbu ish tajribasini o\'chirmoqchimisiz?')) {
        fetch(`/employees/{{ $employee->id }}/work-experience/${workId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                showToast(data.message, 'success');
                refreshWorkExperienceTable();
            } else {
                showToast(data.message, 'error');
            }
        })
    .catch(error => {
        console.error('Xatolik:', error);
        showToast('O\'chirishda xatolik yuz berdi', 'error');
    });
    }
}

function refreshWorkExperienceTable() {
    fetch(`/employees/{{ $employee->id }}/work-experiences`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.text();
    })
    .then(html => {
        document.getElementById('workExperienceTableBody').innerHTML = html;
    })
    .catch(error => {
        console.error('Xatolik:', error);
        showToast('Jadvalni yangilashda xatolik', 'error');
    });
}

// ==================== FORM GENERATOR FUNKSIYALARI ====================
function getUnfinishedHigherForm() {
    return `
        <div class="row">
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <select name="university_id" class="form-control" required>
                        <option value="">Universitetni tanlang</option>
                        @foreach($universities as $university)
                            <option value="{{ $university->id }}">{{ $university->name }}</option>
                        @endforeach
                    </select>
                    <label>Universitet nomi *</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <select name="faculty_id" class="form-control" required>
                        <option value="">Fakultetni tanlang</option>
                        @foreach($faculties as $faculty)
                            <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                        @endforeach
                    </select>
                    <label>Fakultet nomi *</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <select name="speciality_id" class="form-control" required>
                        <option value="">Mutaxassislikni tanlang</option>
                        @foreach($specialities as $speciality)
                            <option value="{{ $speciality->id }}">{{ $speciality->name }}</option>
                        @endforeach
                    </select>
                    <label>Mutaxassislik *</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <select name="course" class="form-control" required>
                        <option value="1">1-kurs</option>
                        <option value="2">2-kurs</option>
                        <option value="3">3-kurs</option>
                        <option value="4">4-kurs</option>
                    </select>
                    <label>Kurs *</label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-floating mb-3">
                    <input type="date" name="start_date" class="form-control" required>
                    <label>O'qishga kirgan sanasi *</label>
                </div>
            </div>
        </div>
    `;
}

function getHigherEducationForm(degreeType) {
    return `
        <div class="row">
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <select name="university_id" class="form-control" required>
                        <option value="">Universitetni tanlang</option>
                        @foreach($universities as $university)
                            <option value="{{ $university->id }}">{{ $university->name }}</option>
                        @endforeach
                    </select>
                    <label>Universitet nomi *</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <select name="faculty_id" class="form-control" required>
                        <option value="">Fakultetni tanlang</option>
                        @foreach($faculties as $faculty)
                            <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                        @endforeach
                    </select>
                    <label>Fakultet nomi *</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <select name="speciality_id" class="form-control" required>
                        <option value="">Mutaxassislikni tanlang</option>
                        @foreach($specialities as $speciality)
                            <option value="{{ $speciality->id }}">{{ $speciality->name }}</option>
                        @endforeach
                    </select>
                    <label>Mutaxassislik *</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="date" name="start_date" class="form-control" required>
                    <label>O'qishga kirgan sanasi *</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="date" name="end_date" class="form-control" required>
                    <label>O'qishni bitirgan sanasi *</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" name="diploma_number" class="form-control" placeholder="Diplom seriya va raqami" required>
                    <label>Diplom seriya va raqami *</label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-floating mb-3">
                    <input type="date" name="issue_date" class="form-control" required>
                    <label>Diplom berilgan sana *</label>
                </div>
            </div>
        </div>
    `;
}

function getSecondarySpecialForm() {
    return `
        <div class="row">
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <select name="college_id" class="form-control" required>
                        <option value="">Kollej/Litseyni tanlang</option>
                        @foreach($colleges as $college)
                            <option value="{{ $college->id }}">{{ $college->name }}</option>
                        @endforeach
                    </select>
                    <label>Kollej yoki litsey nomi *</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <select name="faculty_id" class="form-control" required>
                        <option value="">Fakultetni tanlang</option>
                        @foreach($faculties as $faculty)
                            <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                        @endforeach
                    </select>
                    <label>Fakultet *</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <select name="speciality_id" class="form-control" required>
                        <option value="">Mutaxassislikni tanlang</option>
                        @foreach($specialities as $speciality)
                            <option value="{{ $speciality->id }}">{{ $speciality->name }}</option>
                        @endforeach
                    </select>
                    <label>Mutaxassislik *</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="date" name="start_date" class="form-control" required>
                    <label>Kirgan sana *</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="date" name="end_date" class="form-control" required>
                    <label>Tugatgan sana *</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" name="diploma_number" class="form-control" placeholder="Diplom seriya va raqami" required>
                    <label>Diplom seriya va raqami *</label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-floating mb-3">
                    <input type="date" name="issue_date" class="form-control" required>
                    <label>Diplom berilgan sana *</label>
                </div>
            </div>
        </div>
    `;
}

function getSecondaryForm() {
    return `
        <div class="row">
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <select name="school_id" class="form-control" required>
                        <option value="">Maktabni tanlang</option>
                        @foreach($schools as $school)
                            <option value="{{ $school->id }}">{{ $school->name }}</option>
                        @endforeach
                    </select>
                    <label>Maktab nomi *</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="date" name="start_date" class="form-control" required>
                    <label>Kirgan sana *</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="date" name="end_date" class="form-control" required>
                    <label>Tugatgan sana *</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" name="certificate_number" class="form-control" placeholder="Atestat raqami">
                    <label>Atestat raqami</label>
                </div>
            </div>
        </div>
    `;
}
// ==================== QARINDOSHLAR FUNKSIYALARI ====================

function addRelative() {
    const container = document.getElementById('relatives-container');
    if (!container) return;
    
    const relativeItems = container.querySelectorAll('.relative-item');
    const relativeCount = relativeItems.length;
    
    const newItem = document.createElement('div');
    newItem.className = 'relative-item border p-3 mb-3 rounded';
    newItem.innerHTML = `
        <div class="row">
            <div class="col-md-4">
                <div class="form-floating mb-3">
                    <input type="text" name="relatives[${relativeCount}][qarindoshlik]" class="form-control" placeholder="Qarindoshlik darajasi">
                    <label>Qarindoshlik darajasi</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating mb-3">
                    <input type="text" name="relatives[${relativeCount}][familiyasi]" class="form-control" placeholder="Familiyasi">
                    <label>Familiyasi</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating mb-3">
                    <input type="text" name="relatives[${relativeCount}][ismi]" class="form-control" placeholder="Ismi">
                    <label>Ismi</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating mb-3">
                    <input type="text" name="relatives[${relativeCount}][sharfi]" class="form-control" placeholder="Sharifi">
                    <label>Sharifi</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating mb-3">
                    <input type="number" name="relatives[${relativeCount}][tugilgan_yili]" class="form-control" placeholder="Tug'ilgan yili">
                    <label>Tug'ilgan yili</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating mb-3">
                    <input type="text" name="relatives[${relativeCount}][ishi_joyi]" class="form-control" placeholder="Ish joyi">
                    <label>Ish joyi</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" name="relatives[${relativeCount}][lavozimi]" class="form-control" placeholder="Lavozimi">
                    <label>Lavozimi</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" name="relatives[${relativeCount}][tugilgan_joy_soato]" class="form-control" placeholder="Tug'ilgan joyi (SOATO)">
                    <label>Tug'ilgan joyi (SOATO)</label>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-sm btn-danger remove-relative" onclick="removeRelative(this)">O'chirish</button>
    `;
    container.appendChild(newItem);
}

function removeRelative(button) {
    const relativeItem = button.closest('.relative-item');
    if (relativeItem) {
        relativeItem.remove();
    }
}

// ==================== YORDAMCHI FUNKSIYALAR ====================

// Toast xabarlari
function showToast(message, type = 'info') {
    // Bootstrap toast yoki oddiy alert
    const toast = document.createElement('div');
    toast.className = `alert alert-${type === 'error' ? 'danger' : 'success'} alert-dismissible fade show position-fixed`;
    toast.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    toast.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(toast);
    
    // 5 soniyadan so'ng o'chirish
    setTimeout(() => {
        if (toast.parentNode) {
            toast.remove();
        }
    }, 5000);
}
</script>
@endsection