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
                                <i class="bi bi-check-circle"></i> Saqlash va keyingi qadam
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
                                <i class="bi bi-check-circle"></i> Saqlash va keyingi qadam
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
                            <div class="col-md-6">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <p class="h6 py-2 mb-0">Ta'lim ma'lumotlari</p>
                                    <button type="button" class="btn btn-sm btn-success" onclick="openEducationModal()">
                                        <i class="bi bi-plus-circle"></i> Ta'lim qo'shish
                                    </button>
                                </div>
                                
                                <!-- Ta'lim ma'lumotlari konteyneri -->
                                <div id="education-container">
                                    @foreach($employee->educations as $education)
                                    <div class="education-item border p-3 mb-3 rounded" data-type="{{ $education->degree_type }}">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h6 class="mb-0 text-primary">{{ $education->degree_type }}</h6>
                                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeEducation(this)">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                        
                                        <input type="hidden" name="educations[{{ $education->id }}][degree_type]" value="{{ $education->degree_type }}">
                                        
                                        @if($education->degree_type == 'Tugallanmagan oliy')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <select name="educations[{{ $education->id }}][university_id]" class="form-control" required>
                                                        <option value="">Universitetni tanlang</option>
                                                        @foreach($universities as $university)
                                                            <option value="{{ $university->id }}" {{ $education->university_id == $university->id ? 'selected' : '' }}>{{ $university->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <label>Universitet nomi *</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <select name="educations[{{ $education->id }}][faculty_id]" class="form-control" required>
                                                        <option value="">Fakultetni tanlang</option>
                                                        @foreach($faculties as $faculty)
                                                            <option value="{{ $faculty->id }}" {{ $education->faculty_id == $faculty->id ? 'selected' : '' }}>{{ $faculty->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <label>Fakultet nomi *</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <select name="educations[{{ $education->id }}][speciality_id]" class="form-control" required>
                                                        <option value="">Mutaxassislikni tanlang</option>
                                                        @foreach($specialities as $speciality)
                                                            <option value="{{ $speciality->id }}" {{ $education->speciality_id == $speciality->id ? 'selected' : '' }}>{{ $speciality->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <label>Mutaxassislik *</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <select name="educations[{{ $education->id }}][course]" class="form-control" required>
                                                        <option value="1" {{ $education->course == 1 ? 'selected' : '' }}>1-kurs</option>
                                                        <option value="2" {{ $education->course == 2 ? 'selected' : '' }}>2-kurs</option>
                                                        <option value="3" {{ $education->course == 3 ? 'selected' : '' }}>3-kurs</option>
                                                        <option value="4" {{ $education->course == 4 ? 'selected' : '' }}>4-kurs</option>
                                                    </select>
                                                    <label>Kurs *</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-floating mb-3">
                                                    <input type="date" name="educations[{{ $education->id }}][start_date]" class="form-control" value="{{ $education->start_date }}" required>
                                                    <label>O'qishga kirgan sanasi *</label>
                                                </div>
                                            </div>
                                        </div>
                                        @elseif(in_array($education->degree_type, ['Bakalavr', 'Magistr']))
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <select name="educations[{{ $education->id }}][university_id]" class="form-control" required>
                                                        <option value="">Universitetni tanlang</option>
                                                        @foreach($universities as $university)
                                                            <option value="{{ $university->id }}" {{ $education->university_id == $university->id ? 'selected' : '' }}>{{ $university->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <label>Universitet nomi *</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <select name="educations[{{ $education->id }}][faculty_id]" class="form-control" required>
                                                        <option value="">Fakultetni tanlang</option>
                                                        @foreach($faculties as $faculty)
                                                            <option value="{{ $faculty->id }}" {{ $education->faculty_id == $faculty->id ? 'selected' : '' }}>{{ $faculty->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <label>Fakultet nomi *</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <select name="educations[{{ $education->id }}][speciality_id]" class="form-control" required>
                                                        <option value="">Mutaxassislikni tanlang</option>
                                                        @foreach($specialities as $speciality)
                                                            <option value="{{ $speciality->id }}" {{ $education->speciality_id == $speciality->id ? 'selected' : '' }}>{{ $speciality->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <label>Mutaxassislik *</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="date" name="educations[{{ $education->id }}][start_date]" class="form-control" value="{{ $education->start_date }}" required>
                                                    <label>O'qishga kirgan sanasi *</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="date" name="educations[{{ $education->id }}][end_date]" class="form-control" value="{{ $education->end_date }}" required>
                                                    <label>O'qishni bitirgan sanasi *</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="educations[{{ $education->id }}][diploma_number]" class="form-control" placeholder="Diplom seriya va raqami" value="{{ $education->diploma_number }}" required>
                                                    <label>Diplom seriya va raqami *</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-floating mb-3">
                                                    <input type="date" name="educations[{{ $education->id }}][issue_date]" class="form-control" value="{{ $education->issue_date }}" required>
                                                    <label>Diplom berilgan sana *</label>
                                                </div>
                                            </div>
                                        </div>
                                        @elseif($education->degree_type == 'O\'rta maxsus')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <select name="educations[{{ $education->id }}][college_id]" class="form-control" required>
                                                        <option value="">Kollej/Litseyni tanlang</option>
                                                        @foreach($colleges as $college)
                                                            <option value="{{ $college->id }}" {{ $education->college_id == $college->id ? 'selected' : '' }}>{{ $college->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <label>Kollej yoki litsey nomi *</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <select name="educations[{{ $education->id }}][faculty_id]" class="form-control" required>
                                                        <option value="">Fakultetni tanlang</option>
                                                        @foreach($faculties as $faculty)
                                                            <option value="{{ $faculty->id }}" {{ $education->faculty_id == $faculty->id ? 'selected' : '' }}>{{ $faculty->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <label>Fakultet *</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <select name="educations[{{ $education->id }}][speciality_id]" class="form-control" required>
                                                        <option value="">Mutaxassislikni tanlang</option>
                                                        @foreach($specialities as $speciality)
                                                            <option value="{{ $speciality->id }}" {{ $education->speciality_id == $speciality->id ? 'selected' : '' }}>{{ $speciality->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <label>Mutaxassislik *</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="date" name="educations[{{ $education->id }}][start_date]" class="form-control" value="{{ $education->start_date }}" required>
                                                    <label>Kirgan sana *</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="date" name="educations[{{ $education->id }}][end_date]" class="form-control" value="{{ $education->end_date }}" required>
                                                    <label>Tugatgan sana *</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="educations[{{ $education->id }}][diploma_number]" class="form-control" placeholder="Diplom seriya va raqami" value="{{ $education->diploma_number }}" required>
                                                    <label>Diplom seriya va raqami *</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-floating mb-3">
                                                    <input type="date" name="educations[{{ $education->id }}][issue_date]" class="form-control" value="{{ $education->issue_date }}" required>
                                                    <label>Diplom berilgan sana *</label>
                                                </div>
                                            </div>
                                        </div>
                                        @elseif($education->degree_type == 'O\'rta')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <select name="educations[{{ $education->id }}][school_id]" class="form-control" required>
                                                        <option value="">Maktabni tanlang</option>
                                                        @foreach($schools as $school)
                                                            <option value="{{ $school->id }}" {{ $education->school_id == $school->id ? 'selected' : '' }}>{{ $school->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <label>Maktab nomi *</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="date" name="educations[{{ $education->id }}][start_date]" class="form-control" value="{{ $education->start_date }}" required>
                                                    <label>Kirgan sana *</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="date" name="educations[{{ $education->id }}][end_date]" class="form-control" value="{{ $education->end_date }}" required>
                                                    <label>Tugatgan sana *</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="educations[{{ $education->id }}][certificate_number]" class="form-control" placeholder="Atestat raqami" value="{{ $education->certificate_number }}" required>
                                                    <label>Atestat raqami *</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-floating mb-3">
                                                    <input type="date" name="educations[{{ $education->id }}][certificate_date]" class="form-control" value="{{ $education->certificate_date }}" required>
                                                    <label>Atestat berilgan sana *</label>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Ish tajribasi -->
                            <div class="col-md-6">
                                <p class="h6 py-2 mb-3">Ish tajribasi</p>
                                <div id="work-experience-container">
                                    @foreach($employee->workExperiences as $index => $work)
                                    <div class="work-item border p-3 mb-3 rounded">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="work_experiences[{{ $index }}][lavozim]" class="form-control" placeholder="Lavozim" value="{{ $work->lavozim }}">
                                                    <label>Lavozim</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="work_experiences[{{ $index }}][tashkilot_nomi]" class="form-control" placeholder="Tashkilot nomi" value="{{ $work->tashkilot_nomi }}">
                                                    <label>Tashkilot nomi</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="date" name="work_experiences[{{ $index }}][kirgan_sanasi]" class="form-control" value="{{ $work->kirgan_sanasi }}">
                                                    <label>Kirgan sanasi</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <input type="date" name="work_experiences[{{ $index }}][boshagan_sanasi]" class="form-control" value="{{ $work->boshagan_sanasi }}">
                                                    <label>Tugatgan sanasi</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check mb-3">
                                                    <input type="checkbox" name="work_experiences[{{ $index }}][current_job]" class="form-check-input" value="1" {{ $work->current_job ? 'checked' : '' }}>
                                                    <label class="form-check-label">Hozirgi ish joyi</label>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-danger remove-work" onclick="removeWork(this)">O'chirish</button>
                                    </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-sm btn-success" onclick="addWorkExperience()">+ Ish tajribasi qo'shish</button>
                            </div>
                        </div>
                        
                        <!-- Step 3 uchun saqlash tugmasi -->
                        <div class="mt-4 text-end">
                            <button type="button" class="btn btn-secondary" onclick="showStep(2)">
                                <i class="bi bi-arrow-left"></i> Orqaga
                            </button>
                            <button type="button" class="btn btn-success save-step" data-step="3">
                                <i class="bi bi-check-circle"></i> Saqlash va keyingi qadam
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
                                <i class="bi bi-check-circle"></i> Saqlash va keyingi qadam
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
                            <button type="button" class="btn btn-theme save-step" data-step="5">
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

<style>
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
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const avatarFigure = document.querySelector('.coverimg');
                avatarFigure.style.backgroundImage = `url(${e.target.result})`;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    console.log('Employee form initialized successfully');
});

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
    // Joriy stepni validatsiya qilish
    if (!validateStep(step)) {
        showToast('Iltimos, barcha majburiy maydonlarni to\'ldiring', 'error');
        return;
    }

    // Form ma'lumotlarini yig'ish
    const form = document.getElementById(`step${step}Form`);
    const formData = new FormData(form);

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
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message, 'success');
            // Keyingi stepga o'tish (agar 5-step bo'lmasa)
            if (step < 5) {
                setTimeout(() => {
                    showStep(step);
                }, 1000);
            } else {
                // Yakuniy saqlash - bosh sahifaga yo'naltirish
                setTimeout(() => {
                    window.location.href = '{{ route("employees.index") }}';
                }, 1500);
            }
        } else {
            throw new Error(data.message || 'Xatolik yuz berdi');
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

// Step validatsiyasi
function validateStep(stepIndex) {
    const currentPane = document.querySelectorAll('.tab-pane')[stepIndex];
    const requiredFields = currentPane.querySelectorAll('[required]');
    
    let isValid = true;
    
    for (let field of requiredFields) {
        if (!field.value.trim()) {
            field.focus();
            field.classList.add('is-invalid');
            isValid = false;
        } else {
            field.classList.remove('is-invalid');
        }
    }
    
    return isValid;
}

// Toast xabarlari
function showToast(message, type = 'info') {
    // Bootstrap toast yoki oddiy alert
    const toast = document.createElement('div');
    toast.className = `alert alert-${type === 'error' ? 'danger' : 'success'} alert-dismissible fade show`;
    toast.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(toast);
    
    // 5 soniyadan so'ng o'chirish
    setTimeout(() => {
        toast.remove();
    }, 5000);
}

// ==================== TA'LIM FUNKSIYALARI ====================

function openEducationModal() {
    const modal = new bootstrap.Modal(document.getElementById('educationModal'));
    modal.show();
}

function addEducation(degreeType) {
    const modal = bootstrap.Modal.getInstance(document.getElementById('educationModal'));
    modal.hide();

    const newId = 'new_' + Date.now();
    let educationHTML = '';

    switch(degreeType) {
        case 'Tugallanmagan oliy':
            educationHTML = getUnfinishedHigherHTML(newId, degreeType);
            break;
        case 'Bakalavr':
        case 'Magistr':
            educationHTML = getHigherEducationHTML(newId, degreeType);
            break;
        case 'O\'rta maxsus':
            educationHTML = getSecondarySpecialHTML(newId, degreeType);
            break;
        case 'O\'rta':
            educationHTML = getSecondaryHTML(newId, degreeType);
            break;
    }

    const container = document.getElementById('education-container');
    if (container) {
        container.insertAdjacentHTML('beforeend', educationHTML);
    }
}

function getUnfinishedHigherHTML(id, degreeType) {
    return `
        <div class="education-item border p-3 mb-3 rounded" data-type="${degreeType}">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="mb-0 text-primary">${degreeType}</h6>
                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeEducation(this)">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
            <input type="hidden" name="educations[${id}][degree_type]" value="${degreeType}">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <select name="educations[${id}][university_id]" class="form-control" required>
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
                        <select name="educations[${id}][faculty_id]" class="form-control" required>
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
                        <select name="educations[${id}][speciality_id]" class="form-control" required>
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
                        <select name="educations[${id}][course]" class="form-control" required>
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
                        <input type="date" name="educations[${id}][start_date]" class="form-control" required>
                        <label>O'qishga kirgan sanasi *</label>
                    </div>
                </div>
            </div>
        </div>
    `;
}

function getHigherEducationHTML(id, degreeType) {
    return `
        <div class="education-item border p-3 mb-3 rounded" data-type="${degreeType}">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="mb-0 text-primary">${degreeType}</h6>
                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeEducation(this)">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
            <input type="hidden" name="educations[${id}][degree_type]" value="${degreeType}">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <select name="educations[${id}][university_id]" class="form-control" required>
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
                        <select name="educations[${id}][faculty_id]" class="form-control" required>
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
                        <select name="educations[${id}][speciality_id]" class="form-control" required>
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
                        <input type="date" name="educations[${id}][start_date]" class="form-control" required>
                        <label>O'qishga kirgan sanasi *</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="date" name="educations[${id}][end_date]" class="form-control" required>
                        <label>O'qishni bitirgan sanasi *</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" name="educations[${id}][diploma_number]" class="form-control" placeholder="Diplom seriya va raqami" required>
                        <label>Diplom seriya va raqami *</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating mb-3">
                        <input type="date" name="educations[${id}][issue_date]" class="form-control" required>
                        <label>Diplom berilgan sana *</label>
                    </div>
                </div>
            </div>
        </div>
    `;
}

function getSecondarySpecialHTML(id, degreeType) {
    return `
        <div class="education-item border p-3 mb-3 rounded" data-type="${degreeType}">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="mb-0 text-primary">${degreeType}</h6>
                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeEducation(this)">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
            <input type="hidden" name="educations[${id}][degree_type]" value="${degreeType}">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <select name="educations[${id}][college_id]" class="form-control" required>
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
                        <select name="educations[${id}][faculty_id]" class="form-control" required>
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
                        <select name="educations[${id}][speciality_id]" class="form-control" required>
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
                        <input type="date" name="educations[${id}][start_date]" class="form-control" required>
                        <label>Kirgan sana *</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="date" name="educations[${id}][end_date]" class="form-control" required>
                        <label>Tugatgan sana *</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" name="educations[${id}][diploma_number]" class="form-control" placeholder="Diplom seriya va raqami" required>
                        <label>Diplom seriya va raqami *</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating mb-3">
                        <input type="date" name="educations[${id}][issue_date]" class="form-control" required>
                        <label>Diplom berilgan sana *</label>
                    </div>
                </div>
            </div>
        </div>
    `;
}

function getSecondaryHTML(id, degreeType) {
    return `
        <div class="education-item border p-3 mb-3 rounded" data-type="${degreeType}">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="mb-0 text-primary">${degreeType}</h6>
                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeEducation(this)">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
            <input type="hidden" name="educations[${id}][degree_type]" value="${degreeType}">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <select name="educations[${id}][school_id]" class="form-control" required>
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
                        <input type="date" name="educations[${id}][start_date]" class="form-control" required>
                        <label>Kirgan sana *</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="date" name="educations[${id}][end_date]" class="form-control" required>
                        <label>Tugatgan sana *</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" name="educations[${id}][certificate_number]" class="form-control" placeholder="Atestat raqami" required>
                        <label>Atestat raqami *</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating mb-3">
                        <input type="date" name="educations[${id}][certificate_date]" class="form-control" required>
                        <label>Atestat berilgan sana *</label>
                    </div>
                </div>
            </div>
        </div>
    `;
}

function removeEducation(button) {
    const educationItem = button.closest('.education-item');
    if (educationItem) {
        educationItem.remove();
    }
}

// ==================== ISH TAJRIBASI FUNKSIYALARI ====================

function addWorkExperience() {
    const container = document.getElementById('work-experience-container');
    if (!container) return;
    
    const workItems = container.querySelectorAll('.work-item');
    const workCount = workItems.length;
    
    const newItem = document.createElement('div');
    newItem.className = 'work-item border p-3 mb-3 rounded';
    newItem.innerHTML = `
        <div class="row">
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" name="work_experiences[${workCount}][lavozim]" class="form-control" placeholder="Lavozim">
                    <label>Lavozim</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" name="work_experiences[${workCount}][tashkilot_nomi]" class="form-control" placeholder="Tashkilot nomi">
                    <label>Tashkilot nomi</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="date" name="work_experiences[${workCount}][kirgan_sanasi]" class="form-control">
                    <label>Kirgan sanasi</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="date" name="work_experiences[${workCount}][boshagan_sanasi]" class="form-control">
                    <label>Tugatgan sanasi</label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-check mb-3">
                    <input type="checkbox" name="work_experiences[${workCount}][current_job]" class="form-check-input" value="1">
                    <label class="form-check-label">Hozirgi ish joyi</label>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-sm btn-danger remove-work" onclick="removeWork(this)">O'chirish</button>
    `;
    container.appendChild(newItem);
}

function removeWork(button) {
    const workItem = button.closest('.work-item');
    if (workItem) {
        workItem.remove();
    }
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
</script>
@endsection