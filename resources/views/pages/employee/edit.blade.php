@extends('layouts.app')

@section('content')
<div class="card adminuiux-card mb-3">
<div class="card-body">
        <div class="card border-0 mb-4" id="employeeWizard">
        <ul class="nav nav-tabs adminuiux-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="step-1-tab" data-bs-toggle="tab" data-bs-target="#step-1" type="button" role="tab" aria-controls="step-1" aria-selected="true">
                    <div class="p-1">
                        <p class="h6 mb-0">Asosiy</p>
                        <p class="opacity-75 small">Shaxsiy</p>
                    </div>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="step-2-tab" data-bs-toggle="tab" data-bs-target="#step-2" type="button" role="tab" aria-controls="step-2" aria-selected="false" tabindex="-1">
                    <div class="p-1">
                        <p class="h6 mb-0">Pasport</p>
                        <p class="opacity-75 small">Harbiy</p>
                    </div>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="step-3-tab" data-bs-toggle="tab" data-bs-target="#step-3" type="button" role="tab" aria-controls="step-3" aria-selected="false" tabindex="-1">
                    <div class="p-1">
                        <p class="h6 mb-0">Ta'lim</p>
                        <p class="opacity-75 small">Ish tajriba</p>
                    </div>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="step-4-tab" data-bs-toggle="tab" data-bs-target="#step-4" type="button" role="tab" aria-controls="step-4" aria-selected="false" tabindex="-1">
                    <div class="p-1">
                        <p class="h6 mb-0">Qarindosh</p>
                        <p class="opacity-75 small">Ma'lumot</p>
                    </div>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="step-5-tab" data-bs-toggle="tab" data-bs-target="#step-5" type="button" role="tab" aria-controls="step-5" aria-selected="false" tabindex="-1">
                    <div class="p-1">
                        <p class="h6 mb-0">Qo'shimcha</p>
                        <p class="opacity-75 small">Ma'lumot</p>
                    </div>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="step-6-tab" data-bs-toggle="tab" data-bs-target="#step-6" type="button" role="tab" aria-controls="step-6" aria-selected="false" tabindex="-1">
                    <div class="p-1">
                        <p class="h6 mb-0">Sabablar</p>
                        <p class="opacity-75 small">Boshqarish</p>
                    </div>
                </button>
            </li>
        </ul>

        <div class="card-body">
          
            <div class="tab-content">
                <!-- Step 1: Asosiy ma'lumotlar -->
                <div id="step-1" class="tab-pane fade show active">
                    <div class="card border-0 mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0 text-primary">
                                <i class="bi bi-person-gear me-2"></i>Asosiy Ma'lumotlar
                            </h5>
                        </div>
                        <div class="card-body">
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
                                            <input type="text" name="last_name" class="form-control" placeholder="Familiya" value="{{ $employee->last_name }}" required data-type="text-only" oninput="validateInput(this)">
                                            <label>Familiya *</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="first_name" class="form-control" placeholder="Ism" value="{{ $employee->first_name }}" required data-type="text-only" oninput="validateInput(this)">
                                            <label>Ism *</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="middle_name" class="form-control" placeholder="Sharif" value="{{ $employee->middle_name }}" data-type="text-only" oninput="validateInput(this)">
                                            <label>Sharif</label>
                                        </div>
                                    </div>

                                    <!-- 2-qator: PINFL, Jinsi, Tug'ilgan sana -->
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="fnfl" class="form-control" placeholder="PINFL" value="{{ $employee->fnfl }}" required data-type="number-only" oninput="validateInput(this)">
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
                                            <label>Tug'ilgan sanasi *</label>
                                        </div>
                                    </div>

                                    <!-- 3-qator: Telefon, Ishga olingan sana, Tashkilot -->
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="phone" id="phone" class="form-control" placeholder="+998901234567" value="{{ $employee->phone }}" required data-type="number-only" oninput="validateInput(this)">
                                            <label>Telefon *</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="date" name="hired_date" class="form-control" value="{{ $employee->hired_date }}" required>
                                            <label>Ishga olingan sanasi *</label>
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

                                    <!-- 6-qator: Tab nomer -->
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="tab_number" class="form-control" placeholder="Tab nomer" value="{{ $employee->tab_number }}" data-type="number-only" oninput="validateInput(this)">
                                            <label>Tab Nº</label>
                                            <small class="text-muted">Debug: {{ $employee->tab_number ?? 'NULL' }}</small>
                                        </div>
                                    </div>

                                    <!-- 6-qator: Qo'shimcha parametrlar -->
                                    <div class="col-12">
                                        <p class="h6 py-2 mb-2">Qo'shimcha parametrlar</p>
                                    </div>
                                       <div class="col-md-4">
                                        <div class="form-check mb-3">
                                            <input type="checkbox" name="office" class="form-check-input" value="1" {{ $employee->office ? 'checked' : '' }} id="office">
                                            <label class="form-check-label">Ofis</label>
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
                                            <input type="checkbox" name="night_working" class="form-check-input" value="1" {{ $employee->night_working ? 'checked' : '' }} id="night_working">
                                            <label class="form-check-label">Kechki smena</label>
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
                                            <input type="text" name="car_number" class="form-control" placeholder="Mashina raqami" value="{{ $employee->car_number }}" data-type="mixed" oninput="validateInput(this)">
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
                    </div>
                </div>

                <!-- Step 2: Pasport va harbiy ma'lumotlar -->
                <div id="step-2" class="tab-pane fade">
                    <div class="card border-0 mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0 text-primary">
                                <i class="bi bi-passport me-2"></i>Pasport va Harbiy Ma'lumotlar
                            </h5>
                        </div>
                        <div class="card-body">
                    <form id="step2Form">
                        @csrf
                        <!-- Pasport ma'lumotlari -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <p class="h6 py-2 mb-3 border-bottom">Pasport ma'lumotlari</p>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="passport[seria_raqam]" class="form-control" placeholder="AA 1234567" value="{{ $employee->passportInfo?->seria_raqam }}" required data-type="mixed" oninput="validateInput(this)">
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
                                    <label>Berilgan sanasi *</label>
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

                        <!-- Passport fayl yuklash -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <p class="h6 py-2 mb-3 border-bottom">Passport fayli</p>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Passport fayl yuklash</label>
                                    <input type="file" id="passportFile" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                                    <div class="form-text">PDF, JPG, PNG formatida, maksimal 10MB</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Yuklangan fayl</label>
                                    <div id="passportFileInfo" class="border rounded p-3">
                                        @if($employee->passport_file_path)
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div>
                                                    <i class="bi bi-file-earmark-text text-primary me-2"></i>
                                                    <span class="fw-medium">Passport fayli yuklangan</span>
                                                </div>
                                                <div>
                                                    <button type="button" class="btn btn-square btn-link" onclick="viewPassportFile()" title="Ko'rish">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-square btn-link text-danger" onclick="deletePassportFile()" title="O'chirish">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @else
                                            <div class="text-muted">
                                                <i class="bi bi-file-earmark-plus me-2"></i>
                                                Passport fayli yuklanmagan
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Harbiy ma'lumotlar -->
                        <div class="row">
                            <div class="col-12">
                                <p class="h6 py-2 mb-3 border-bottom">Harbiy hisob ma'lumotlari</p>
                            </div>
                            
                            <!-- Harbiy status checkboxlar -->
                            <div class="col-12 mb-2">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input military-option" type="radio" name="military_status" id="military-called" value="called" {{ !$employee->militaryRecord || (!$employee->militaryRecord->hisob_guruhi && !$employee->militaryRecord->reason_unfit) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="military-called">
                                                Chaqiruvda
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input military-option" type="radio" name="military_status" id="military-served" value="served" {{ $employee->militaryRecord && $employee->militaryRecord->hisob_guruhi ? 'checked' : '' }}>
                                            <label class="form-check-label" for="military-served">
                                               Harbiy xizmatni o'tgan
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input military-option" type="radio" name="military_status" id="military-unfit" value="unfit" {{ $employee->militaryRecord && $employee->militaryRecord->reason_unfit ? 'checked' : '' }}>
                                            <label class="form-check-label" for="military-unfit">
                                              Harbiy xizmatga yaroqsiz
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Harbiy ma'lumotlar formasi -->
                            <div id="military-form-content">
                                <!-- Chaqiruvda -->
                                <div id="military-called-content" class="military-content" style="{{ !$employee->militaryRecord || (!$employee->militaryRecord->hisob_guruhi && !$employee->militaryRecord->reason_unfit) ? '' : 'display: none;' }}">
                                    <div class="p-3 text-center">
                                        <i class="bi bi-person-check fs-1 text-primary mb-3"></i>
                                        <h5>Chaqiruvda</h5>
                                        <p class="text-muted">Harbiy xizmatga chaqiruvda</p>
                                </div>
                            </div>

                                <!-- Xizmat o'tgan -->
                                <div id="military-served-content" class="military-content" style="{{ $employee->militaryRecord && $employee->militaryRecord->hisob_guruhi ? '' : 'display: none;' }}">
                                    <div class="row">
                                <!-- 1-qator -->
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

                                <!-- 2-qator -->
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

                                <!-- 3-qator -->
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

                                <!-- 4-qator -->
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
                                
                                <!-- Yaroqsiz -->
                                <div id="military-unfit-content" class="military-content" style="{{ $employee->militaryRecord && $employee->militaryRecord->reason_unfit ? '' : 'display: none;' }}">
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control" name="military[reason_unfit]" placeholder="Yaroqsizligi sababini yozing" style="height: 100px;">{{ $employee->militaryRecord?->reason_unfit }}</textarea>
                                        <label>Yaroqsizligi sababi</label>
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
                    </div>
                </div>

                <!-- Step 3: Ta'lim va ish tajribasi -->
                <div id="step-3" class="tab-pane fade">
                    <div class="card border-0 mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0 text-primary">
                                <i class="bi bi-mortarboard me-2"></i>Ta'lim va Ish Tajribasi
                            </h5>
                        </div>
                        <div class="card-body">
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
    <table class="table w-100 nowrap dataTable dtr-inline collapsed" id="educationTable" aria-describedby="educationTable_info">
        <colgroup>
            <col data-dt-column="0">
            <col data-dt-column="1">
            <col data-dt-column="2">
            <col data-dt-column="3">
            <col data-dt-column="4">
            <col data-dt-column="5">
            <col data-dt-column="6">
            <col data-dt-column="7">
        </colgroup>
        <thead>
            <tr role="row">
                <th data-dt-column="0" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc" aria-label="Ta'lim darajasi: Activate to sort" tabindex="0">
                    <span class="dt-column-title" role="button">Ta'lim darajasi</span>
                    <span class="dt-column-order"></span>
                </th>
                <th data-breakpoints="xs sm" data-dt-column="1" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc" aria-label="O'quv muassasasi: Activate to sort" tabindex="0">
                    <span class="dt-column-title" role="button">O'quv muassasasi</span>
                    <span class="dt-column-order"></span>
                </th>
                <th data-breakpoints="xs sm md" data-dt-column="2" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc" aria-label="Fakultet: Activate to sort" tabindex="0">
                    <span class="dt-column-title" role="button">Fakultet</span>
                    <span class="dt-column-order"></span>
                </th>
                <th data-breakpoints="xs sm" data-dt-column="3" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc" aria-label="Mutaxassislik: Activate to sort" tabindex="0">
                    <span class="dt-column-title" role="button">Mutaxassislik</span>
                    <span class="dt-column-order"></span>
                </th>
                <th data-breakpoints="xs sm" data-dt-column="4" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc" aria-label="Boshlanish sanasi: Activate to sort" tabindex="0">
                    <span class="dt-column-title" role="button">Boshlanish sanasi</span>
                    <span class="dt-column-order"></span>
                </th>
                <th data-breakpoints="xs sm" data-dt-column="5" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc" aria-label="Tugash sanasi: Activate to sort" tabindex="0">
                    <span class="dt-column-title" role="button">Tugash sanasi</span>
                    <span class="dt-column-order"></span>
                </th>
                <th data-breakpoints="xs sm" data-dt-column="6" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc" aria-label="Diplom/Atestat raqami: Activate to sort" tabindex="0">
                    <span class="dt-column-title" role="button">Diplom/Atestat raqami</span>
                    <span class="dt-column-order"></span>
                </th>
                <th class="all dt-orderable-none" data-dt-column="7" rowspan="1" colspan="1" aria-label="Harakatlar">
                    <span class="dt-column-title">Harakatlar</span>
                    <span class="dt-column-order"></span>
                </th>
            </tr>
        </thead>
        <tbody id="educationTableBody">
            @foreach($employee->educations as $education)
            <tr data-id="{{ $education->id }}" data-type="{{ $education->degree_type }}">
                {{-- Ta'lim darajasi + O'quv muassasasi nomi --}}
                <td class="dtr-control" tabindex="0">
                    <div class="row align-items-center flex-nowrap">
                        <div class="col-auto">
                            <figure class="avatar avatar-40 mb-0 coverimg rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center">
                                {{ strtoupper(substr($education->degree_type,0,1) ?? '-') }}
                            </figure>
                        </div>
                        <div class="col ps-0">
                            <p class="mb-0 fw-medium">{{ $education->degree_type }}</p>
                            <small class="text-muted">
                                {{ $education->university->name ?? $education->college->name ?? $education->school->name ?? '-' }}
                            </small>
                        </div>
                    </div>
                </td>

                {{-- Fakultet --}}
{{-- Fakultet --}}
<td>
    @php
        // Prefer stored faculty_name (text), otherwise related faculty name, otherwise empty
        $facultyName = trim($education->faculty_name ?? ($education->faculty?->name ?? ''));
        if (mb_strtolower($facultyName) === mb_strtolower("Noma'lum") || $facultyName === "Noma\'lum") {
            $facultyName = '';
        }
    @endphp
    {{ $facultyName ?: '-' }}
</td>
<td>
    @php
        // Prefer stored faculty_name (text), otherwise related faculty name, otherwise empty
        $facultyName = trim($education->faculty_name ?? ($education->faculty?->name ?? ''));
        if (mb_strtolower($facultyName) === mb_strtolower("Noma'lum") || $facultyName === "Noma\'lum") {
            $facultyName = '';
        }
    @endphp
    {{ $facultyName ?: '-' }}
</td>

{{-- Mutaxassislik --}}
<td>
    @php
        // Prefer stored speciality (text), otherwise related speciality name, otherwise empty
        $specialityName = trim($education->speciality ?? ($education->specialityRelation?->name ?? ''));
        if (mb_strtolower($specialityName) === mb_strtolower("Noma'lum") || $specialityName === "Noma\'lum") {
            $specialityName = '';
        }
    @endphp
    {{ $specialityName ?: '-' }}
</td>


                {{-- Boshlanish sanasi --}}
                <td>{{ $education->start_date ? \Carbon\Carbon::parse($education->start_date)->format('d.m.Y') : '' }}</td>

                {{-- Tugash sanasi yoki kurs --}}
                <td>
                    @if($education->degree_type === 'Tugallanmagan oliy')
                        {{ $education->course ? $education->course . '-kurs' : 'O&#39;qimoqda' }}
                    @else
                        {{ $education->end_date ? \Carbon\Carbon::parse($education->end_date)->format('d.m.Y') : '' }}
                    @endif
                </td>

                {{-- Diplom/Attestat raqami --}}
                <td>{{ $education->diploma_number ?? $education->certificate_number ?? '-' }}</td>

                {{-- Harakatlar --}}
                <td>
                    <a href="javascript:void(0)" class="btn btn-square btn-link" onclick="editEducation({{ $education->id }})" title="Tahrirlash">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <button type="button" class="btn btn-square btn-link text-danger" onclick="deleteEducation({{ $education->id }})" title="O'chirish">
                            <i class="bi bi-trash"></i>
                        </button>
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
                                    <table class="table w-100 nowrap dataTable dtr-inline collapsed" id="workExperienceTable" aria-describedby="workExperienceTable_info">
                                        <colgroup>
                                            <col data-dt-column="0">
                                            <col data-dt-column="1">
                                            <col data-dt-column="2">
                                            <col data-dt-column="3">
                                            <col data-dt-column="4">
                                            <col data-dt-column="5">
                                            <col data-dt-column="6">
                                        </colgroup>
                                        <thead>
                                            <tr role="row">
                                                <th data-dt-column="0" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc" aria-label="Tashkilot nomi: Activate to sort" tabindex="0">
                                                    <span class="dt-column-title" role="button">Tashkilot nomi</span>
                                                    <span class="dt-column-order"></span>
                                                </th>
                                                <th data-breakpoints="xs sm" data-dt-column="1" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc" aria-label="Lavozim: Activate to sort" tabindex="0">
                                                    <span class="dt-column-title" role="button">Lavozim</span>
                                                    <span class="dt-column-order"></span>
                                                </th>
                                                <th data-breakpoints="xs sm md" data-dt-column="2" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc" aria-label="Boshlanish sanasi: Activate to sort" tabindex="0">
                                                    <span class="dt-column-title" role="button">Boshlanish sanasi</span>
                                                    <span class="dt-column-order"></span>
                                                </th>
                                                <th data-breakpoints="xs sm" data-dt-column="3" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc" aria-label="Tugash sanasi: Activate to sort" tabindex="0">
                                                    <span class="dt-column-title" role="button">Tugash sanasi</span>
                                                    <span class="dt-column-order"></span>
                                                </th>
                                                <th data-breakpoints="xs sm" data-dt-column="4" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc" aria-label="Shartnoma raqami: Activate to sort" tabindex="0">
                                                    <span class="dt-column-title" role="button">Shartnoma raqami</span>
                                                    <span class="dt-column-order"></span>
                                                </th>
                                                <th data-breakpoints="xs sm" data-dt-column="5" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc" aria-label="Shartnoma sanasi: Activate to sort" tabindex="0">
                                                    <span class="dt-column-title" role="button">Shartnoma sanasi</span>
                                                    <span class="dt-column-order"></span>
                                                </th>
                                                <th class="all dt-orderable-none" data-dt-column="6" rowspan="1" colspan="1" aria-label="Harakatlar">
                                                    <span class="dt-column-title">Harakatlar</span>
                                                    <span class="dt-column-order"></span>
                                                </th>
                                                </tr>
                                        </thead>
                                        <tbody id="workExperienceTableBody">
                                            @foreach($employee->workExperiences as $work)
                                            <tr data-id="{{ $work->id }}">
                                                <td class="dtr-control" tabindex="0">
                                                    <div class="row align-items-center flex-nowrap">
                                                        <div class="col-auto">
                                                            <figure class="avatar avatar-40 mb-0 coverimg rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center">
                                                                {{ strtoupper(substr($work->tashkilot_nomi,0,1) ?? '-') }}
                                                            </figure>
                                                        </div>
                                                        <div class="col ps-0">
                                                            <p class="mb-0 fw-medium">{{ $work->tashkilot_nomi }}</p>
                                                            <small class="text-muted">{{ $work->lavozim ?? '-' }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $work->lavozim ?? '-' }}</td>
                                                <td>{{ \Carbon\Carbon::parse($work->kirgan_sanasi)->format('d.m.Y') }}</td>
                                                <td>
                                                    @if($work->current_job)
                                                    <span class="badge badge-light rounded-pill text-bg-success">Hozirgi ish</span>
                                                    @else
                                                    {{ $work->boshagan_sanasi ? \Carbon\Carbon::parse($work->boshagan_sanasi)->format('d.m.Y') : '-' }}
                                                    @endif
                                                </td>
                                                <td>{{ $work->shartnoma_raqami ?: '-' }}</td>
                                                <td>{{ $work->shartnoma_tuzilgan_sana ? \Carbon\Carbon::parse($work->shartnoma_tuzilgan_sana)->format('d.m.Y') : '-' }}</td>
                                                <td>
                                                    <a href="javascript:void(0)" class="btn btn-square btn-link" onclick="editWorkExperience({{ $work->id }})" title="Tahrirlash">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-square btn-link text-danger" onclick="deleteWorkExperience({{ $work->id }})" title="O'chirish">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
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
                    </div>
                </div>

                <!-- Step 4: Qarindoshlar -->
                <div id="step-4" class="tab-pane fade">
                    <div class="card border-0 mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0 text-primary">
                                <i class="bi bi-people me-2"></i>Qarindoshlik Ma'lumotlari
                            </h5>
                        </div>
                        <div class="card-body">
                    <form id="step4Form">
                        @csrf
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <p class="h6 py-2 mb-0">Qarindoshlik ma'lumotlari</p>
                                    <button type="button" class="btn btn-sm btn-success" onclick="showAddRelativeForm()">
                                        <i class="bi bi-plus-circle"></i> Qarindosh qo'shish
                                    </button>
                                </div>
                                
                                <!-- Jadval ko'rinishi -->
                                <div class="table-responsive mb-4">
                                    <table class="table w-100 nowrap dataTable dtr-inline collapsed" id="relativesTable" aria-describedby="relativesTable_info">
                                        <colgroup>
                                            <col data-dt-column="0">
                                            <col data-dt-column="1">
                                            <col data-dt-column="2">
                                            <col data-dt-column="3">
                                            <col data-dt-column="4">
                                            <col data-dt-column="5">
                                        </colgroup>
                                        <thead>
                                            <tr role="row">
                                                <th data-dt-column="0" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc" aria-label="Qarindoshlik: Activate to sort" tabindex="0">
                                                    <span class="dt-column-title" role="button">Qarindoshlik</span>
                                                    <span class="dt-column-order"></span>
                                                </th>
                                                <th data-breakpoints="xs sm" data-dt-column="1" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc" aria-label="Familiya Ism Otasi: Activate to sort" tabindex="0">
                                                    <span class="dt-column-title" role="button">Familiya Ism Otasi</span>
                                                    <span class="dt-column-order"></span>
                                                </th>
                                                <th data-breakpoints="xs sm md" data-dt-column="2" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc" aria-label="Tug'ilgan yili: Activate to sort" tabindex="0">
                                                    <span class="dt-column-title" role="button">Tug'ilgan yili</span>
                                                    <span class="dt-column-order"></span>
                                                </th>
                                                <th data-breakpoints="xs sm" data-dt-column="3" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc" aria-label="Tug'ilgan joyi: Activate to sort" tabindex="0">
                                                    <span class="dt-column-title" role="button">Tug'ilgan joyi</span>
                                                    <span class="dt-column-order"></span>
                                                </th>
                                                <th data-breakpoints="xs sm" data-dt-column="4" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc" aria-label="Ish joyi/Lavozimi: Activate to sort" tabindex="0">
                                                    <span class="dt-column-title" role="button">Ish joyi/Lavozimi</span>
                                                    <span class="dt-column-order"></span>
                                                </th>
                                                <th class="all dt-orderable-none" data-dt-column="5" rowspan="1" colspan="1" aria-label="Harakatlar">
                                                    <span class="dt-column-title">Harakatlar</span>
                                                    <span class="dt-column-order"></span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="relativesTableBody">
                                            @foreach($employee->relatives as $relative)
                                            <tr data-id="{{ $relative->id }}">
                                                <td class="dtr-control" tabindex="0">{{ $relative->qarindoshlik }}</td>
                                                <td>
                                                    <div class="row align-items-center flex-nowrap">
                                                        <div class="col-auto">
                                                            <figure class="avatar avatar-40 mb-0 coverimg rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center">
                                                                {{-- initials fallback --}}
                                                                {{ strtoupper(substr($relative->familiyasi,0,1) . substr($relative->ismi,0,1)) }}
                                                            </figure>
                                                        </div>
                                                        <div class="col ps-0">
                                                            <p class="mb-0 fw-medium">{{ $relative->familiyasi }} {{ $relative->ismi }}</p>
                                                            <small class="text-muted">{{ $relative->otasi_ismi }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $relative->tugilgan_yili ?: '-' }}</td>
                                                <td>
                                                    @if($relative->tugilgan_joy_viloyat || $relative->tugilgan_joy_tuman)
                                                        <small class="text-muted">{{ $relative->tugilgan_joy_viloyat }}, {{ $relative->tugilgan_joy_tuman }}@if($relative->tugilgan_joy_qishloq), {{ $relative->tugilgan_joy_qishloq }}@endif</small>
                                                    @else
                                                        <small class="text-muted">{{ $relative->tugilgan_joy_soato ?: '-' }}</small>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($relative->nafaqada)
                                                        <div class="d-flex flex-column">
                                                            <span class="badge badge-light rounded-pill text-bg-warning">Nafaqada</span>
                                                            @if($relative->old_ishi_joyi || $relative->old_lavozimi)
                                                                <small class="text-muted">Oldingi ish: {{ $relative->old_ishi_joyi ?: '-' }} @if($relative->old_lavozimi)/ {{ $relative->old_lavozimi }} @endif</small>
                                                            @else
                                                                @if($relative->ishi_joyi || $relative->lavozimi)
                                                                    <small class="text-muted">Oldingi ish: {{ $relative->ishi_joyi ?: '-' }} @if($relative->lavozimi)/ {{ $relative->lavozimi }} @endif</small>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    @elseif($relative->oqishda)
                                                        <small>{{ $relative->oquv_yurti ?: 'O\'qiydi' }}</small>
                                                    @else
                                                        <small>{{ $relative->ishi_joyi ?: '-' }} @if($relative->lavozimi)/ {{ $relative->lavozimi }} @endif</small>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)" class="btn btn-square btn-link" onclick="editRelative({{ $relative->id }})" title="Tahrirlash">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-square btn-link text-danger" onclick="deleteRelative({{ $relative->id }})" title="O'chirish">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Forma qismi -->
                                <div id="relatives-form-container" class="border p-3 rounded mb-3" style="display: none;">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6 class="mb-0" id="relativeFormTitle">Qarindosh qo'shish</h6>
                                        <button type="button" class="btn-close" onclick="closeRelativeForm()"></button>
                                    </div>
                                    
                                    <div id="relativeForm">
                                        <input type="hidden" name="relative_id" id="relativeId">
                                        
                                        <div class="row">
                                            <!-- Qarindoshlik darajasi -->
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                    <select name="qarindoshlik" id="relativeQarindoshlik" class="form-select" required>
                                                        <option value="">Tanlang</option>
                                                        <option value="Otasi">Otasi</option>
                                                        <option value="Onasi">Onasi</option>
                                                        <option value="Akasi">Akasi</option>
                                                        <option value="Ukasi">Ukasi</option>
                                                        <option value="Singlisi">Singlisi</option>
                                                        <option value="Opasi">Opasi</option>
                                                        <option value="Turmush o'rtog'i">Turmush o'rtog'i</option>
                                                        <option value="Farzandi">Farzandi</option>
                                                    </select>
                                                    <label>Qarindoshlik darajasi *</label>
                                                </div>
                                            </div>

                                            <!-- Familiya, Ism, Otasi ismi -->
                                            <div class="col-md-4">
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="familiyasi" id="relativeFamiliyasi" class="form-control" placeholder="Familiyasi" required>
                                                    <label>Familiyasi *</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="ismi" id="relativeIsmi" class="form-control" placeholder="Ismi" required>
                                                    <label>Ismi *</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="otasi_ismi" id="relativeOtasiIsmi" class="form-control" placeholder="Otasi ismi" required>
                                                    <label>Otasi ismi *</label>
                                                </div>
                                            </div>

                                            <!-- Tug'ilgan ma'lumotlari -->
                                            <div class="col-md-4">
                                                <div class="form-floating mb-3">
                                                    <input type="number" name="tugilgan_yili" id="relativeTugilganYili" class="form-control" placeholder="Tug'ilgan yili" min="1900" max="{{ date('Y') }}" required>
                                                    <label>Tug'ilgan yili *</label>
                                                </div>
                                            </div>

                                            <!-- Tug'ilgan joyi -->
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <select name="tugilgan_joy_viloyat" id="relativeViloyat" class="form-select" onchange="loadTumanlar(this.value)" required>
                                                    <option value="">Viloyat tanlang</option>
                                                    @foreach($regions as $r)
                                                        <option value="{{ $r->name }}" data-region-id="{{ $r->id }}">{{ $r->name }}</option>
                                                    @endforeach
                                                </select>
                                                <label>Viloyat *</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <select name="tugilgan_joy_tuman" id="relativeTuman" class="form-select" onchange="loadQishloqlar(this.value)" required>
                                                    <option value="">Tuman tanlang</option>
                                                    @foreach($districts as $d)
                                                        <option value="{{ $d->name }}" data-region-id="{{ $d->region_id }}">{{ $d->name }}</option>
                                                    @endforeach
                                                </select>
                                                <label>Tuman *</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating mb-3">
                                                <select name="tugilgan_joy_qishloq" id="relativeQishloq" class="form-select">
                                                    <option value="">Qishloq/MFY tanlang</option>
                                                    @foreach($villages as $v)
                                                        <option value="{{ $v->name }}" data-district-id="{{ $v->district_id }}">{{ $v->name }}</option>
                                                    @endforeach
                                                </select>
                                                <label>Qishloq/MFY</label>
                                            </div>
                                        </div>

                                                <!-- Ish joyi ma'lumotlari -->
                                                <!-- Ish joyi ma'lumotlari -->
                                                <div class="col-md-12">
        <div class="form-check mb-3">
            <input type="checkbox" name="nafaqada" id="relativeNafaqada" class="form-check-input" value="1" 
                {{ isset($relative) && $relative->nafaqada ? 'checked' : '' }} onchange="toggleIshJoyiFields()">
            <label class="form-check-label" for="relativeNafaqada">Nafaqada</label>
        </div>
    </div>
                                            <div class="col-md-12" id="ish-joyi-fields">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-floating mb-3">
                                                            <input type="text" name="ishi_joyi" id="relativeIshiJoyi" class="form-control" placeholder="Ish joyi">
                                                            <label>Ish joyi</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating mb-3">
                                                            <input type="text" name="lavozimi" id="relativeLavozimi" class="form-control" placeholder="Lavozimi">
                                                            <label>Lavozimi</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Oldingi (nafaqaga chiqgan) ish joyi -->
                                            <div class="col-md-12" id="previous-job-fields" style="display: none;">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-floating mb-3">
                                                            <input type="text" name="old_ishi_joyi" id="relativeOldIshiJoyi" class="form-control" placeholder="Oldingi ish joyi">
                                                            <label>Oldingi ish joyi</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating mb-3">
                                                            <input type="text" name="old_lavozimi" id="relativeOldLavozimi" class="form-control" placeholder="Oldingi lavozimi">
                                                            <label>Oldingi lavozimi</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- O'qish ma'lumotlari -->
                                            <div class="col-md-12">
                                                <div class="form-check mb-3">
                                                    <input type="checkbox" name="oqishda" id="relativeOqishda" class="form-check-input" value="1" onchange="toggleOquvYurtiField()">
                                                    <label class="form-check-label" for="relativeOqishda">O'qiydi</label>
                                                </div>
                                            </div>

                                            <div class="col-md-12" id="oquv-yurti-field" style="display: none;">
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="oquv_yurti" id="relativeOquvYurti" class="form-control" placeholder="O'quv yurti nomi">
                                                    <label>O'quv yurti nomi</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-secondary me-2" onclick="closeRelativeForm()">Bekor qilish</button>
                                            <button type="button" class="btn btn-success" onclick="saveRelative()">
                                                <i class="bi bi-check-circle"></i> Saqlash
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
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
                        </div>
                </div>

                <!-- Step 5: Qo'shimcha ma'lumotlar -->
                <div id="step-5" class="tab-pane fade">
                    <div class="card border-0 mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0 text-primary">
                                <i class="bi bi-info-circle me-2"></i>Qo'shimcha Ma'lumotlar
                            </h5>
            </div>
                        <div class="card-body">
                    <form id="step5Form">
                        @csrf
                        <input type="hidden" name="additional[_create_new]" id="additionalCreateNew" value="0">
                        <p class="h6 py-2 mb-3">Qo'shimcha ma'lumotlar</p>
                        <div class="row">
                            <!-- CHAP TOMON USTUNI -->
                            <div class="col-md-6">
                                <!-- Oldingi ishdan ketish sababi -->
                                <div class="form-floating mb-3">
                                    <select name="additional[old_job_exit_reason]" class="form-control">
                                        <option value="">Oldingi ishdan ketish sababi</option>
                                        <option value="ish_haqi_pastligi" {{ $employee->additionalInfo?->old_job_exit_reason == 'ish_haqi_pastligi' ? 'selected' : '' }}>Ish haqi pastligi</option>
                                        <option value="rahbar_tomonidan_ortiqcha_talablar" {{ $employee->additionalInfo?->old_job_exit_reason == 'rahbar_tomonidan_ortiqcha_talablar' ? 'selected' : '' }}>Rahbar tomonidan ortiqcha talablar</option>
                                        <option value="ish_sharoitlarining_ogirligi" {{ $employee->additionalInfo?->old_job_exit_reason == 'ish_sharoitlarining_ogirligi' ? 'selected' : '' }}>Ish sharoitlarining og'irligi</option>
                                        <option value="lavozim_osish_imkoniyati_yokligi" {{ $employee->additionalInfo?->old_job_exit_reason == 'lavozim_osish_imkoniyati_yokligi' ? 'selected' : '' }}>Lavozim bo'yicha o'sish imkoniyati yo'qligi</option>
                                        <option value="rahbariyat_bilan_murakkab_munosabatlar" {{ $employee->additionalInfo?->old_job_exit_reason == 'rahbariyat_bilan_murakkab_munosabatlar' ? 'selected' : '' }}>Rahbariyat bilan murakkab munosabatlar</option>
                                        <option value="tashkilot_darajasi_pastligi" {{ $employee->additionalInfo?->old_job_exit_reason == 'tashkilot_darajasi_pastligi' ? 'selected' : '' }}>Tashkilot darajasi pastligi</option>
                                        <option value="jamoada_psixologik_iqlim_yomonligi" {{ $employee->additionalInfo?->old_job_exit_reason == 'jamoada_psixologik_iqlim_yomonligi' ? 'selected' : '' }}>Jamoada psixologik iqlim yomonligi</option>
                                        <option value="boshqa_sabablar" {{ $employee->additionalInfo?->old_job_exit_reason == 'boshqa_sabablar' ? 'selected' : '' }}>Boshqa sabablar</option>
                                    </select>
                                    <label>Oldingi ishdan ketish sababi *</label>
                                </div>

                                <!-- Shaxsiy avtomobil -->
                                <div class="form-floating mb-3">
                                    <select name="additional[shaxsiy_avtomobil]" class="form-control">
                                        <option value="">Shaxsiy avtomobil</option>
                                        <option value="yoq" {{ $employee->additionalInfo?->shaxsiy_avtomobil == 'yoq' ? 'selected' : '' }}>Yo'q</option>
                                        <option value="bor" {{ $employee->additionalInfo?->shaxsiy_avtomobil == 'bor' ? 'selected' : '' }}>Bor</option>
                                    </select>
                                    <label>Shaxsiy avtomobil *</label>
                                </div>

                                <!-- Soliq to'lov identifikatsiya raqami -->
                                <div class="form-floating mb-3">
                                    <input type="number" name="additional[soliq_id]" class="form-control" placeholder="Soliq to'lov identifikatsiya raqami" value="{{ $employee->additionalInfo?->soliq_id }}">
                                    <label>Soliq to'lov identifikatsiya raqami</label>
                                </div>

                                <!-- Qiziqishlari -->
                                <div class="form-floating mb-3">
                                    <select name="additional[qiziqishlari]" class="form-control">
                                        <option value="">Qiziqishlari</option>
                                        <option value="sport" {{ $employee->additionalInfo?->qiziqishlari == 'sport' ? 'selected' : '' }}>Sport</option>
                                        <option value="kitob_oquvchilik" {{ $employee->additionalInfo?->qiziqishlari == 'kitob_oquvchilik' ? 'selected' : '' }}>Kitob o'qish</option>
                                        <option value="musiqa" {{ $employee->additionalInfo?->qiziqishlari == 'musiqa' ? 'selected' : '' }}>Musiqa</option>
                                        <option value="sayohat" {{ $employee->additionalInfo?->qiziqishlari == 'sayohat' ? 'selected' : '' }}>Sayohat</option>
                                        <option value="texnologiyalar" {{ $employee->additionalInfo?->qiziqishlari == 'texnologiyalar' ? 'selected' : '' }}>Texnologiyalar</option>
                                        <option value="sanat" {{ $employee->additionalInfo?->qiziqishlari == 'sanat' ? 'selected' : '' }}>San'at</option>
                                        <option value="dasturlash" {{ $employee->additionalInfo?->qiziqishlari == 'dasturlash' ? 'selected' : '' }}>Dasturlash</option>
                                        <option value="boshqa" {{ $employee->additionalInfo?->qiziqishlari == 'boshqa' ? 'selected' : '' }}>Boshqa</option>
                                    </select>
                                    <label>Qiziqishlari</label>
                                </div>
                            </div>

                            <!-- O'NG TOMON USTUNI -->
                            <div class="col-md-6">
                                <!-- Davlat mukofoti -->
                                <div class="form-floating mb-3">
                                    <input type="text" name="additional[davlat_mukofoti]" class="form-control" placeholder="Davlat mukofoti" value="{{ $employee->additionalInfo?->davlat_mukofoti }}">
                                    <label>Davlat mukofoti</label>
                                </div>

                                <!-- Haydovchilik guvohnomasi -->
                                <div class="form-floating mb-3">
                                    <select name="additional[haydovchilik_guvohnomasi]" class="form-control">
                                        <option value="">Haydovchilik guvohnomasi</option>
                                        <option value="A" {{ $employee->additionalInfo?->haydovchilik_guvohnomasi == 'A' ? 'selected' : '' }}>A</option>
                                        <option value="B" {{ $employee->additionalInfo?->haydovchilik_guvohnomasi == 'B' ? 'selected' : '' }}>B</option>
                                        <option value="C" {{ $employee->additionalInfo?->haydovchilik_guvohnomasi == 'C' ? 'selected' : '' }}>C</option>
                                        <option value="BC" {{ $employee->additionalInfo?->haydovchilik_guvohnomasi == 'BC' ? 'selected' : '' }}>BC</option>
                                        <option value="CD" {{ $employee->additionalInfo?->haydovchilik_guvohnomasi == 'CD' ? 'selected' : '' }}>CD</option>
                                    </select>
                                    <label>Haydovchilik guvohnomasi</label>
                                </div>

                                <!-- INPS -->
                                <div class="form-floating mb-3">
                                    <input type="number" name="additional[inps]" class="form-control" placeholder="INPS" value="{{ $employee->additionalInfo?->inps }}">
                                    <label>INPS</label>
                                </div>

                                <!-- Jismoniy ma'lumotlar -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="additional[boy]" class="form-control" placeholder="Bo'y" value="{{ $employee->additionalInfo?->boy }}">
                                            <label>Bo'y (sm)</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="additional[vazn]" class="form-control" placeholder="Vazn" value="{{ $employee->additionalInfo?->vazn }}">
                                            <label>Vazn (kg)</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kiyim-kechak razmerlari - Butun eni bo'yicha -->
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="additional[kostyum_razmer]" class="form-control" placeholder="Kostyum razmeri" value="{{ $employee->additionalInfo?->kostyum_razmer }}">
                                            <label>Kostyum razmeri</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="additional[poyabzal_razmer]" class="form-control" placeholder="Poyabzal razmeri" value="{{ $employee->additionalInfo?->poyabzal_razmer }}">
                                            <label>Poyabzal razmeri</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="additional[bosh_razmer]" class="form-control" placeholder="Bosh razmeri" value="{{ $employee->additionalInfo?->bosh_razmer }}">
                                            <label>Bosh razmeri</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Favqulodda aloqa - Bitta qatorda yonma-yon -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    {{-- Stored on DB as tanish_ism, form field name remains emergency_name for controller mapping --}}
                                    <input type="text" name="additional[emergency_name]" class="form-control" placeholder="FIO" value="{{ $employee->additionalInfo?->tanish_ism }}">
                                    <label>Murojat uchun yaqin shaxs (FIO)</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    {{-- Stored on DB as tanish_telfoni --}}
                                    <input type="text" name="additional[emergency_phone]" class="form-control" placeholder="Telefon" value="{{ $employee->additionalInfo?->tanish_telfoni }}">
                                    <label>Telefon raqami</label>
                                </div>
                            </div>
                        </div>

                        <!-- Qolgan maydonlar - 2 ustunli -->
                         
                        <div class="row">
  
                            <!-- CHAP TOMON -->
                            <div class="col-md-6">
                                <!-- Jinnimaslik malumotnomasi -->
                               <div class="mb-3">
                                    <label class="form-label">Jinnimaslik malumotnomasi (upload)</label>
                                    <input type="file" name="additional[insanity_certificate]" class="form-control" onchange="previewFile(this, 'insanity')">
                                    @if($employee->additionalInfo?->insanity_certificate_path)
                                        <div class="mt-2 existing-file-link existing-insanity-link">
                                            <a href="{{ Storage::url($employee->additionalInfo->insanity_certificate_path) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-eye"></i>Jinnimaslik malumotnomasi
                                            </a>
                                        </div>
                                    @endif
                                </div>

                                <!-- AKFA tanish checkbox -->
                                <div class="form-check mb-3">
                                    <input type="checkbox" name="additional[akfa_tanish]" class="form-check-input" value="1" {{ $employee->additionalInfo?->akfa_tanish ? 'checked' : '' }} id="akfa-tanish-checkbox">
                                    <label class="form-check-label">AKFAda tanish bormi?</label>
                                </div>

                                <!-- AKFA tanish conditional inputs -->
                                <div id="akfa-details" style="display: {{ $employee->additionalInfo?->akfa_tanish ? 'block' : 'none' }};">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" name="additional[akfa_tanish_ism]" class="form-control" placeholder="AKFA tanish ismi" value="{{ $employee->additionalInfo?->akfa_tanish_ism }}">
                                                <label>AKFA tanish ismi</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" name="additional[akfa_tanish_lavozim]" class="form-control" placeholder="AKFA tanish lavozimi" value="{{ $employee->additionalInfo?->akfa_tanish_lavozim }}">
                                                <label>AKFA tanish lavozimi</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- O'NG TOMON -->
                            <div class="col-md-6">
                                <!-- Sudlanganmi checkbox -->
                                <div class="form-check mb-3">
                                    <input type="checkbox" name="additional[sudlanganmi]" class="form-check-input" value="1" {{ $employee->additionalInfo?->sudlanganmi ? 'checked' : '' }} id="sudlanganmi-checkbox">
                                    <label class="form-check-label">Sudlanganmi?</label>
                                </div>

                                <!-- Sudlanganmi conditional details -->
                                <div id="conviction-details" style="display: {{ $employee->additionalInfo?->sudlanganmi ? 'block' : 'none' }};">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <select name="additional[sudlanganlik_sabab]" class="form-control">
                                                    <option value="">Sud qilingan modda</option>
                                                    <option value="105" {{ $employee->additionalInfo?->sudlanganlik_sabab == '105' ? 'selected' : '' }}>Modda 105 - Qasddan odam o'ldirish</option>
                                                    <option value="119" {{ $employee->additionalInfo?->sudlanganlik_sabab == '119' ? 'selected' : '' }}>Modda 119 - O'g'rilik</option>
                                                    <option value="148" {{ $employee->additionalInfo?->sudlanganlik_sabab == '148' ? 'selected' : '' }}>Modda 148 - Poraxo'rlik</option>
                                                    <option value="159" {{ $employee->additionalInfo?->sudlanganlik_sabab == '159' ? 'selected' : '' }}>Modda 159 - Firibgarlik</option>
                                                    <option value="165" {{ $employee->additionalInfo?->sudlanganlik_sabab == '165' ? 'selected' : '' }}>Modda 165 - Giyl qilish</option>
                                                    <option value="178" {{ $employee->additionalInfo?->sudlanganlik_sabab == '178' ? 'selected' : '' }}>Modda 178 - Narkotik moddalar</option>
                                                    <option value="201" {{ $employee->additionalInfo?->sudlanganlik_sabab == '201' ? 'selected' : '' }}>Modda 201 - Iqtisodiy jinoyatlar</option>
                                                    <option value="boshqa" {{ $employee->additionalInfo?->sudlanganlik_sabab == 'boshqa' ? 'selected' : '' }}>Boshqa modda</option>
                                                </select>
                                                <label>Sud qilingan modda</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="date" name="additional[sudlanganlik_sana]" class="form-control" value="{{ $employee->additionalInfo?->sudlanganlik_sana ? \Carbon\Carbon::parse($employee->additionalInfo->sudlanganlik_sana)->format('Y-m-d') : '' }}">
                                                <label>Sudlanganlik sanasi</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Sudlanganlik varaqasi (upload)</label>
                                                <input type="file" name="additional[conviction_document]" class="form-control" onchange="previewFile(this, 'conviction')">
                                                @if($employee->additionalInfo?->conviction_document_path)
                                                    <div class="mt-2 existing-file-link existing-conviction-link">
                                                        <a href="{{ Storage::url($employee->additionalInfo->conviction_document_path) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                                            <i class="bi bi-eye"></i>Sudlanganlik varaqasi
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Step 5 uchun saqlash tugmasi + Yangi qo'shish -->
                        <div class="mt-4 d-flex justify-content-between align-items-center">
                            <div>
                                @if(!$employee->additionalInfo)
                                <button type="button" id="addAdditionalBtn" class="btn btn-sm btn-outline-secondary" onclick="showNewAdditionalForm()">
                                    <i class="bi bi-plus-circle"></i> Yangi qo'shish
                                </button>
                                @else
                                <button type="button" id="addAdditionalBtn" class="btn btn-sm btn-outline-secondary" disabled title="Qo'shimcha ma'lumot mavjud — faqat tahrirlash mumkin">
                                    <i class="bi bi-plus-circle"></i> Yangi qo'shish
                                </button>
                                @endif
                            </div>
                            <div>
                                <button type="button" class="btn btn-secondary" onclick="showStep(4)">
                                    <i class="bi bi-arrow-left"></i> Orqaga
                                </button>
                                <button type="button" class="btn btn-primary save-step" data-step="5">
                                    <i class="bi bi-check-circle"></i> Saqlash
                                </button>
                            </div>
                        </div>
                    </form>
                        </div>
                    </div>
                </div>

                <!-- Step 6: Xodimning Sabablari -->
                <div id="step-6" class="tab-pane fade">
                    <div class="card border-0 mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0 text-primary">
                                <i class="bi bi-flag me-2"></i>{{ $employee->last_name }} {{ $employee->first_name }} — Sabablar
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <p class="h6 py-2 mb-0">Sabablar ro'yxati</p>
                                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#addUserReasonModal">
                                    <i class="bi bi-plus-circle"></i> Sabab qo'shish
                                </button>
                            </div>
                            
                            <!-- Jadval ko'rinishi -->
                            <div class="table-responsive mb-4">
                                <table class="table w-100 nowrap dataTable dtr-inline collapsed" id="employeeReasonsTable" aria-describedby="employeeReasonsTable_info">
                                    <colgroup>
                                        <col data-dt-column="0">
                                        <col data-dt-column="1">
                                        <col data-dt-column="2">
                                        <col data-dt-column="3">
                                        <col data-dt-column="4">
                                        <col data-dt-column="5">
                                    </colgroup>
                                    <thead>
                                        <tr role="row">
                                            <th data-dt-column="0" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc">
                                                <span class="dt-column-title">Turi</span>
                                            </th>
                                            <th data-breakpoints="xs sm" data-dt-column="1" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc">
                                                <span class="dt-column-title">Davr</span>
                                            </th>
                                            <th data-breakpoints="xs sm" data-dt-column="2" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc">
                                                <span class="dt-column-title">Sabab</span>
                                            </th>
                                            <th data-breakpoints="xs sm" data-dt-column="3" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc">
                                                <span class="dt-column-title">Holati</span>
                                            </th>
                                            <th data-breakpoints="xs sm md" data-dt-column="4" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc">
                                                <span class="dt-column-title">Kommentariya</span>
                                            </th>
                                            <th class="all dt-orderable-none" data-dt-column="5" rowspan="1" colspan="1">
                                                <span class="dt-column-title">Harakatlar</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="employeeReasonsTableBody">
                                        <tr>
                                            <td colspan="6" class="text-center py-5">
                                                <div class="spinner-border text-primary" role="status">
                                                    <span class="visually-hidden">Yuklanmoqda...</span>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Xodim sabab qo'shish modal -->
<div class="modal fade" id="addUserReasonModal" tabindex="-1" aria-labelledby="addUserReasonModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserReasonModalLabel">Sabab qo'shish</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addEmployeeReasonForm">
                    <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Sabab</label>
                        <select name="reason_id" id="modal_reason_id" class="form-select" required></select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Turi</label>
                        <div class="d-flex gap-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="reason_type" id="modal_reason_type_daily" value="daily" checked onchange="toggleUserReasonType()">
                                <label class="form-check-label" for="modal_reason_type_daily">Kunlik</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="reason_type" id="modal_reason_type_hourly" value="hourly" onchange="toggleUserReasonType()">
                                <label class="form-check-label" for="modal_reason_type_hourly">Soatlik</label>
                            </div>
                        </div>
                    </div>

                    <div id="user-daily-fields">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Boshlanish sanasi</label>
                                <input type="date" name="start_date" id="modal_start_date" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tugash sanasi</label>
                                <input type="date" name="end_date" id="modal_end_date" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div id="user-hourly-fields" style="display:none;">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Sana <span class="text-danger">*</span></label>
                            <input type="date" name="hourly_date" id="modal_hourly_date" class="form-control">
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Boshlanish vaqti <span class="text-danger">*</span></label>
                                <input type="time" name="start_time" id="modal_start_time" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tugash vaqti <span class="text-danger">*</span></label>
                                <input type="time" name="end_time" id="modal_end_time" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kommentariya</label>
                        <textarea name="comment" id="modal_reason_comment" class="form-control" rows="3" placeholder="Qo'shimcha izoh..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                <button type="button" class="btn btn-primary" onclick="saveEmployeeReason()">Saqlash</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit employee reason modal -->
<div class="modal fade" id="editUserReasonModal" tabindex="-1" aria-labelledby="editUserReasonModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserReasonModalLabel">Sababni tahrirlash</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editEmployeeReasonForm">
                    <input type="hidden" name="edit_reason_item_id" id="edit_reason_item_id">
                    <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Sabab</label>
                        <select name="reason_id" id="edit_modal_reason_id" class="form-select" required></select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Turi</label>
                        <div class="d-flex gap-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="reason_type" id="edit_modal_reason_type_daily" value="daily" onchange="toggleEditUserReasonType()">
                                <label class="form-check-label" for="edit_modal_reason_type_daily">Kunlik</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="reason_type" id="edit_modal_reason_type_hourly" value="hourly" onchange="toggleEditUserReasonType()">
                                <label class="form-check-label" for="edit_modal_reason_type_hourly">Soatlik</label>
                            </div>
                        </div>
                    </div>

                    <div id="edit-user-daily-fields">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Boshlanish sanasi</label>
                                <input type="date" name="start_date" id="edit_modal_start_date" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tugash sanasi</label>
                                <input type="date" name="end_date" id="edit_modal_end_date" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div id="edit-user-hourly-fields" style="display:none;">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Sana <span class="text-danger">*</span></label>
                            <input type="date" name="hourly_date" id="edit_modal_hourly_date" class="form-control">
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Boshlanish vaqti <span class="text-danger">*</span></label>
                                <input type="time" name="start_time" id="edit_modal_start_time" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tugash vaqti <span class="text-danger">*</span></label>
                                <input type="time" name="end_time" id="edit_modal_end_time" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Holati</label>
                        <select name="status" id="edit_modal_reason_status" class="form-select">
                            <option value="ongoing">Davom etmoqda</option>
                            <option value="completed">Tugallangan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kommentariya</label>
                        <textarea name="comment" id="edit_modal_reason_comment" class="form-control" rows="3" placeholder="Qo'shimcha izoh..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                <button type="button" class="btn btn-primary" onclick="updateEmployeeReason()">Saqlash</button>
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
    <div class="modal-dialog modal-xl">
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
    <div class="modal-dialog modal-xl">
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
                                <label>Kirgan sanasi *</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="date" name="boshagan_sanasi" id="workBoshaganSanasi" class="form-control">
                                <label>Tugatgan sanasi</label>
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
                                <label>Shartnoma tuzilgan sana</label>
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

        // remove duplicate earlier definition (kept later implementation)

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

        /* Menyular uchun adminuiux-theme-1 ranglar */
        .nav:not(.nav-pills) .nav-link.active {
            color: rgba(var(--adminuiux-theme-1-rgb), 1);
        }

        .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
            background-color: var(--bs-nav-tabs-link-active-bg);
            border-color: var(--bs-nav-tabs-link-active-border-color);
            color: var(--bs-nav-tabs-link-active-color);
        }

        .adminuiux-tabs .nav-link {
            border-width: 0 0 3px;
        }

        .nav-tabs .nav-link {
            border: var(--bs-nav-tabs-border-width) solid transparent;
            border-top-left-radius: var(--bs-nav-tabs-border-radius);
            border-top-right-radius: var(--bs-nav-tabs-border-radius);
            margin-bottom: calc(var(--bs-nav-tabs-border-width) * -1);
        }

        .nav-link {
            background: none;
            border: 0;
            color: var(--bs-nav-link-color);
            display: block;
            font-size: var(--bs-nav-link-font-size);
            font-weight: var(--bs-nav-link-font-weight);
            padding: var(--bs-nav-link-padding-y) var(--bs-nav-link-padding-x);
            text-decoration: none;
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out;
        }

        /* AdminUIUX nav-tabs ranglarini moslashtirish */
        .adminuiux-tabs {
            --bs-nav-tabs-link-hover-bg: rgba(var(--adminuiux-theme-1-rgb), 0.05);
            --bs-nav-tabs-link-active-color: rgba(var(--adminuiux-theme-1-rgb), 1);
            --bs-nav-tabs-link-active-border-color: var(--adminuiux-theme-1);
            --bs-nav-tabs-link-active-bg: rgba(var(--adminuiux-theme-1-rgb), 0.05);
            --bs-nav-tabs-border-width: 0;
        }

        .adminuiux-tabs .nav-tabs {
            --bs-nav-link-color: #495057;
            --bs-nav-tabs-link-hover-border-color: rgba(var(--adminuiux-theme-1-rgb), 0.15);
            --bs-nav-link-hover-color: rgba(var(--adminuiux-theme-1-rgb), 1);
        }

        .adminuiux-tabs .nav-tabs {
            --bs-nav-tabs-border-width: 0;
            --bs-nav-tabs-border-color: transparent;
            --bs-nav-tabs-border-radius: 8px;
            --bs-nav-tabs-link-hover-border-color: transparent;
            --bs-nav-tabs-link-active-color: rgba(var(--adminuiux-theme-1-rgb), 1);
            --bs-nav-tabs-link-active-bg: rgba(var(--adminuiux-theme-1-rgb), 0.05);
            --bs-nav-tabs-link-active-border-color: var(--adminuiux-theme-1);
            border-bottom: none;
        }

        /* Harbiy checkboxlar uchun styling */
        .military-label {
            cursor: pointer;
            padding: 10px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            transition: all 0.3s ease;
            background-color: #f8f9fa;
        }

        .military-label:hover {
            background-color: rgba(var(--adminuiux-theme-1-rgb), 0.05);
            border-color: rgba(var(--adminuiux-theme-1-rgb), 0.15);
        }

        .military-option:checked + .military-label {
            background-color: rgba(var(--adminuiux-theme-1-rgb), 0.1);
            border-color: var(--adminuiux-theme-1);
            color: rgba(var(--adminuiux-theme-1-rgb), 1);
        }

        .military-content {
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            background-color: #f8f9fa;
        }

        /* Qarindoshlar jadvalidagi familiya ustunini kengroq qilish */
        #relativesTable th:nth-child(2),
        #relativesTable td:nth-child(2) {
            min-width: 200px !important;
            width: 25% !important;
        }

        /* Table trol content olib tashlash */
        .trol:before {
            content: none !important;
        }

        /* Modal date inputlarni kengroq qilish */
        @media (min-width: 992px) {
            .col-lg-4 {
                flex: 0 0 auto;
                width: 50% !important;
            }
        }

        @media (min-width: 1200px) {
            .col-lg-4 {
                flex: 0 0 auto;
                width: 50% !important;
            }
        }

        /* Modal ichidagi date inputlar uchun */
        .modal .col-12.col-md-6.col-lg-4.col-xl-3 {
            width: 100% !important;
            flex: 0 0 auto;
        }

        .modal .input-group {
            width: 100%;
        }

        /* Harbiy ma'lumotlar nav-tabs uchun */
        #militaryTab .nav-link {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }

        #militaryTab .nav-link .h6 {
            font-size: 0.875rem;
            margin-bottom: 0.25rem;
        }

        #militaryTab .nav-link .small {
            font-size: 0.75rem;
        }
        </style>
        <script>
        // Flag set from server: whether employee already has additionalInfo
        const employeeHasAdditional = @json($employee->additionalInfo ? true : false);
        // Edit mode ni sozlash - GLOBAL FUNKSIYA
        function setEditMode(enabled) {
            isEditMode = !!enabled;
            const container = document.getElementById('step-5');
            if (!container) return;

            // Barcha input, select, textarea va button elementlarini boshqarish
            const elements = container.querySelectorAll('input, select, textarea, button');
            elements.forEach(el => {
                // Toggle tugmasini alohida boshqarish
                if (el.id === 'toggleEditBtn') {
                    // Toggle tugmasi har doim enabled bo'ladi
                    el.disabled = false;
                    // Tugma matnini o'zgartirish
                    el.textContent = isEditMode ? 'Tahrirlash' : 'Tahrirlash';
                    return;
                }

                // Saqlash tugmalari
                if (el.classList && el.classList.contains('save-step')) {
                    el.disabled = !isEditMode;
                    return;
                }

                // File inputlar
                if (el.type === 'file') {
                    el.style.display = isEditMode ? '' : 'none';
                    return;
                }

                // Boshqa buttonlar
                if (el.tagName === 'BUTTON') {
                    if (el.closest('.modal')) return;
                    el.disabled = !isEditMode;
                    return;
                }

                // Input, select, textarea elementlari - Step 5 da har doim ochiq
                if (el.tagName === 'INPUT' || el.tagName === 'SELECT' || el.tagName === 'TEXTAREA') {
                    if (el.type === 'hidden' || el.name === '_token' || el.name === '_method') return;
                    el.disabled = false; // Step 5 da har doim ochiq
                }
            });

            // AKFA va sud ma'lumotlarini boshqarish
            const akfaDetails = container.querySelector('#akfa-details');
            const convDetails = container.querySelector('#conviction-details');
            const sudCheckbox = container.querySelector('input[name="additional[sudlanganmi]"]');
            const akfaCheckbox = container.querySelector('input[name="additional[akfa_tanish]"]');

            if (isEditMode) {
                // Edit mode: barcha elementlarni ko'rsatish
                if (akfaDetails) akfaDetails.style.display = akfaCheckbox?.checked ? 'block' : 'none';
                if (convDetails) convDetails.style.display = sudCheckbox?.checked ? 'block' : 'none';
                
                // Checkboxlarni ko'rsatish
                if (akfaCheckbox) {
                    const row = akfaCheckbox.closest('.form-check') || akfaCheckbox.parentElement;
                    if (row) row.style.display = '';
                }
                if (sudCheckbox) {
                    const row = sudCheckbox.closest('.form-check') || sudCheckbox.parentElement;
                    if (row) row.style.display = '';
                }
            } else {
                // Read-only mode: faqat mavjud ma'lumotlarni ko'rsatish
                if (akfaDetails) akfaDetails.style.display = 'none';
                if (akfaCheckbox) {
                    const row = akfaCheckbox.closest('.form-check') || akfaCheckbox.parentElement;
                    if (row) row.style.display = 'none';
                }

                // Sud ma'lumotlari - faqat ma'lumot mavjud bo'lsa ko'rsatish
                let convShouldShow = false;
                if (sudCheckbox && sudCheckbox.checked) convShouldShow = true;
                if (!convShouldShow && convDetails) {
                    const selectEl = convDetails.querySelector('select[name="additional[sudlanganlik_sabab]"]');
                    const dateEl = convDetails.querySelector('input[name="additional[sudlanganlik_sana]"]');
                    const existingLink = convDetails.querySelector('.existing-conviction-link');
                    if ((selectEl && selectEl.value) || (dateEl && dateEl.value) || existingLink) {
                        convShouldShow = true;
                    }
                }

                if (convShouldShow && convDetails) {
                    convDetails.style.display = 'block';
                    // Read-only holatda inputlarni disable qilish
                    convDetails.querySelectorAll('input, select, textarea, button').forEach(el => {
                        if (el.type === 'file') {
                            el.style.display = 'none';
                        } else {
                            el.disabled = true;
                        }
                    });
                } else if (convDetails) {
                    convDetails.style.display = 'none';
                }
                
                // Sud checkboxini yashirish
                if (sudCheckbox) {
                    const row = sudCheckbox.closest('.form-check') || sudCheckbox.parentElement;
                    if (row) row.style.display = 'none';
                }
            }

            console.log('Edit mode:', isEditMode ? 'ACTIVE' : 'INACTIVE');
        }

        document.addEventListener('DOMContentLoaded', function() {
            console.log('Employee form initialized successfully');
            
            // Harbiy ma'lumotlar checkboxlarini boshqarish
            const militaryOptions = document.querySelectorAll('.military-option');
            militaryOptions.forEach(option => {
                option.addEventListener('change', function() {
                    // Barcha contentlarni yashirish
                    const allContents = document.querySelectorAll('.military-content');
                    allContents.forEach(content => {
                        content.style.display = 'none';
                    });
                    
                    // Tanlangan optionga mos contentni ko'rsatish
                    if (this.value === 'called') {
                        document.getElementById('military-called-content').style.display = 'block';
                    } else if (this.value === 'served') {
                        document.getElementById('military-served-content').style.display = 'block';
                    } else if (this.value === 'unfit') {
                        document.getElementById('military-unfit-content').style.display = 'block';
                    }
                    
                    console.log('Military status changed to:', this.value);
                });
            });
            
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
                    if (militaryFields) militaryFields.style.display = '';
                    if (unfitReasonContainer) unfitReasonContainer.style.display = 'none';
                } else if (value === 'unfit') {
                    if (militaryFields) militaryFields.style.display = 'none';
                    if (unfitReasonContainer) unfitReasonContainer.style.display = '';
                } else {
                    if (militaryFields) militaryFields.style.display = 'none';
                    if (unfitReasonContainer) unfitReasonContainer.style.display = 'none';
                }
            }

            militaryRadios.forEach(radio => {
                radio.addEventListener('change', updateMilitaryFields);
            });
            updateMilitaryFields();

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

            // ---------- YANGILANGAN EDIT MODE TOGGLE BEHAVIOR ----------
            const toggleEditBtn = document.getElementById('toggleEditBtn');
            let isEditMode = false;
            let formSnapshot = {};

            // Form holatini saqlash
            function snapshotForms() {
                formSnapshot = {};
                const form = document.getElementById('step5Form');
                if (form) {
                    const data = {};
                    new FormData(form).forEach((v, k) => data[k] = v);
                    formSnapshot[form.id] = data;
                }
                
                // Checkbox holatlarini saqlash
                document.querySelectorAll('#step-5 input[type="checkbox"]').forEach(cb => {
                    const key = `__cb__${cb.name || cb.id}`;
                    formSnapshot[key] = cb.checked;
                });
                
                // Avatar holatini saqlash
                const avatar = document.querySelector('.coverimg');
                formSnapshot['__avatar_bg'] = avatar ? avatar.style.backgroundImage : null;
            }

            // Form holatini qayta tiklash
            function restoreForms() {
                const form = document.getElementById('step5Form');
                if (form) {
                    const data = formSnapshot[form.id] || {};
                    Array.from(form.elements).forEach(el => {
                        if (!el.name) return;
                        if (el.type === 'checkbox') return;
                        try { el.value = data[el.name] || ''; } catch (e) {}
                    });
                }

                // Checkbox holatlarini qayta tiklash
                document.querySelectorAll('#step-5 input[type="checkbox"]').forEach(cb => {
                    const key = `__cb__${cb.name || cb.id}`;
                    if (formSnapshot.hasOwnProperty(key)) cb.checked = !!formSnapshot[key];
                });

                // Avatar holatini qayta tiklash
                const avatar = document.querySelector('.coverimg');
                if (avatar && formSnapshot['__avatar_bg']) {
                    avatar.style.backgroundImage = formSnapshot['__avatar_bg'];
                }
            }


            // YANGILANGAN Toggle handler
            if (toggleEditBtn) {
                toggleEditBtn.addEventListener('click', function() {
                    if (!isEditMode) {
                        // Tahrirlash rejimiga o'tish
                        snapshotForms();
                        setEditMode(true);
                        console.log('Tahrirlash rejimiga o\'tildi - inputlar enabled');
                    } else {
                        // Bekor qilish - oldingi holatga qaytarish
                        if (confirm('Barcha o\'zgarishlar bekor qilinsinmi?')) {
                            restoreForms();
                            setEditMode(false);
                            console.log('Bekor qilindi - read-only rejimiga qaytildi');
                        }
                    }
                });
            }

            // Dastlabki holat - Step 5 inputlari ochiq
            snapshotForms();
            setEditMode(true); // Step 5 da har doim ochiq

            // Qarindoshlar uchun viloyatlarni yuklash
            loadRegionsToForm();
            
            if (document.getElementById('relativeNafaqada')) {
                toggleIshJoyiFields();
                document.getElementById('relativeNafaqada').addEventListener('change', toggleIshJoyiFields);
            }
            if (document.getElementById('relativeOqishda')) {
                toggleOquvYurtiField();
                document.getElementById('relativeOqishda').addEventListener('change', toggleOquvYurtiField);
            }

            // Step 5: sudlanganmi va akfa_tanish toggles
            const sudlanganmiCheckbox = document.querySelector('input[name="additional[sudlanganmi]"]');
            const akfaTanishCheckbox = document.querySelector('input[name="additional[akfa_tanish]"]');
            if (sudlanganmiCheckbox) {
                sudlanganmiCheckbox.addEventListener('change', function() {
                    const el = document.getElementById('conviction-details');
                    if (!el) return;
                    el.style.display = this.checked ? 'block' : 'none';
                });
            }
            if (akfaTanishCheckbox) {
                akfaTanishCheckbox.addEventListener('change', function() {
                    const el = document.getElementById('akfa-details');
                    if (!el) return;
                    el.style.display = this.checked ? 'block' : 'none';
                });
            }

            console.log('Form ID larini tekshirish:');
            for (let i = 1; i <= 5; i++) {
                const form = document.getElementById(`step${i}Form`);
                console.log(`step${i}Form:`, form ? 'MAVJUD' : 'MAVJUD EMAS');
            }
        });

        // ==================== STEP FUNKSIYALARI ====================

        function loadEmployeeData(employeeId) {
            console.log('Loading employee data for ID:', employeeId);
            
            fetch(`/employees/${employeeId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Received data:', data);
                    
                    try {
                        setEditMode(false);
                        const toggleBtn = document.getElementById('toggleEditBtn');
                        if (toggleBtn) {
                            toggleBtn.disabled = false;
                            toggleBtn.textContent = 'Tahrirlash';
                        }
                    } catch (e) { 
                        console.warn('Could not finalize edit mode after save', e); 
                    }

                    document.getElementById('employeeModalLabel').textContent = 
                        `${data.last_name} ${data.first_name} ${data.middle_name} - Ma'lumotlari`;
                })
                .catch(error => {
                    console.error('Error loading employee data:', error);
                    alert('Ma\'lumotlarni yuklashda xatolik yuz berdi');
                });
        }

        // YANGILANGAN Step saqlash funksiyasi
        function saveStep(step) {
            console.log(`saveStep(${step}) chaqirildi`);
            
            const form = document.getElementById(`step${step}Form`);
            if (!form) {
                console.error(`Step ${step} form not found`);
                showToast(`Step ${step} form topilmadi`, 'error');
                return;
            }
            
            const formData = new FormData(form);

            const saveButton = document.querySelector(`.save-step[data-step="${step}"]`);
            if (!saveButton) {
                console.error(`Save button for step ${step} not found`);
                showToast(`Saqlash tugmasi topilmadi`, 'error');
                return;
            }

            const originalText = saveButton.innerHTML;
            saveButton.innerHTML = '<i class="bi bi-hourglass-split"></i> Saqlanmoqda...';
            saveButton.disabled = true;

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
                if (!response.ok) {
                    return response.text().then(text => {
                        throw new Error(`HTTP error! status: ${response.status}, response: ${text}`);
                    });
                }
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data);

                if (data.success) {
                    showToast(data.message, 'success');

                    // Agar Step 5 saqlangan bo'lsa
                    if (Number(step) === 5) {
                        // Edit mode ni o'chirish va formani yangilash
                        setEditMode(false);
                        
                        // Tahrirlash tugmasini qayta tiklash
                        const toggleBtn = document.getElementById('toggleEditBtn');
                        if (toggleBtn) {
                            toggleBtn.disabled = false;
                            toggleBtn.textContent = 'Tahrirlash';
                        }
                        
                        console.log('Step 5 saqlandi - edit mode o\'chirildi, inputlar disabled holatga qaytarildi');
                    }
                } else {
                    if (data.errors) {
                        // Chiroyli validation xatoliklarini ko'rsatish
                        showValidationErrors(data.errors);
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
                saveButton.innerHTML = originalText;
                saveButton.disabled = false;
            });
        }

        // Fayl preview funksiyasi
        function previewFile(input, fileType) {
            if (input.files && input.files[0]) {
                const file = input.files[0];
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    if (file.type === 'application/pdf') {
                        window.open(URL.createObjectURL(file), '_blank');
                    } else if (file.type.startsWith('image/')) {
                        showImagePreview(e.target.result, file.name);
                    } else {
                        showToast('Fayl yuklandi: ' + file.name, 'success');
                    }
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Rasm preview modal
        function showImagePreview(imageSrc, fileName) {
            let previewModal = document.getElementById('imagePreviewModal');
            if (!previewModal) {
                previewModal = document.createElement('div');
                previewModal.id = 'imagePreviewModal';
                previewModal.className = 'modal fade';
                previewModal.innerHTML = `
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Rasm ko'rish: ${fileName}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body text-center">
                                <img src="${imageSrc}" class="img-fluid" alt="${fileName}">
                            </div>
                        </div>
                    </div>
                `;
                document.body.appendChild(previewModal);
            }
            
            const modal = new bootstrap.Modal(previewModal);
            modal.show();
        }

        // Rasmni yuklash va yangilash funksiyasi
        function handleImageUpload(input) {
            if (input.files && input.files[0]) {
                const file = input.files[0];
                
                // Fayl hajmini tekshirish (2MB = 2 * 1024 * 1024 bytes)
                if (file.size > 2 * 1024 * 1024) {
                    showToast('Rasm hajmi 2MB dan katta bo\'lmasligi kerak', 'error');
                    return;
                }
                
                // Fayl formatini tekshirish
                const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                if (!allowedTypes.includes(file.type)) {
                    showToast('Faqat JPG, PNG, GIF formatidagi rasmlar qabul qilinadi', 'error');
                    return;
                }
                
                const formData = new FormData();
                formData.append('image', file);

                const avatarFigure = document.querySelector('.coverimg');
                const originalBackground = avatarFigure.style.backgroundImage;
                
                // Loading ko'rsatish
                showToast('Rasm yuklanmoqda...', 'info');

                fetch(`/employees/{{ $employee->id }}/update-image`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                })
            .then(response => {
                console.log('Response status:', response.status);
                console.log('Response ok:', response.ok);
                
                if (!response.ok) {
                    return response.text().then(text => {
                        console.error('Server response:', text);
                        throw new Error(`Server error: ${response.status} - ${text}`);
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    showToast('Rasm muvaffaqiyatli yangilandi', 'success');
                    
                    if (data.image_url) {
                        avatarFigure.style.backgroundImage = `url(${data.image_url})`;
                        
                        const modalImage = document.getElementById('modal-employee-image');
                        if (modalImage) {
                            modalImage.src = data.image_url;
                        }
                        
                        updateTableImages(data.image_url);
                    }
                } else {
                    throw new Error(data.message || 'Rasm yangilashda xatolik');
                }
            })
            .catch(error => {
                console.error('Rasm yuklash xatosi:', error);
                showToast('Rasm yuklashda xatolik: ' + error.message, 'error');
                avatarFigure.style.backgroundImage = originalBackground;
            });
        }
        }

        // Jadvaldagi barcha rasmlarni yangilash
        function updateTableImages(newImageUrl) {
            const employeeId = {{ $employee->id }};
            const tableImages = document.querySelectorAll(`img[alt*="{{ $employee->first_name }}"]`);
            
            tableImages.forEach(img => {
                img.src = newImageUrl;
            });
        }

        // DOM yuklanganda rasm yuklovchini yangilash
        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.querySelector('input[name="image"]');
            if (imageInput) {
                imageInput.addEventListener('change', function() {
                    handleImageUpload(this);
                });
            }
            
            window.previewImage = function(input) {
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const avatarFigure = document.querySelector('.coverimg');
                        avatarFigure.style.backgroundImage = `url(${e.target.result})`;
                        handleImageUpload(input);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        });

        // Step ko'rsatish funksiyasi
        function showStep(stepIndex) {
            console.log(`showStep(${stepIndex}) chaqirildi`);

            const tabPanes = document.querySelectorAll('.tab-pane');
            const navLinks = document.querySelectorAll('.nav-link');

            const idx = Number(stepIndex) - 1;

            tabPanes.forEach(pane => pane.classList.remove('show', 'active'));
            navLinks.forEach(link => link.classList.remove('active'));

            if (tabPanes[idx]) tabPanes[idx].classList.add('show', 'active');
            if (navLinks[idx]) navLinks[idx].classList.add('active');

            // Tahrirlash tugmasini faqat Step 5 da ko'rsatish
            try {
                const toggleBtn = document.getElementById('toggleEditBtn');
                if (toggleBtn) {
                    if (Number(stepIndex) === 5) {
                        toggleBtn.style.display = '';
                    } else {
                        toggleBtn.style.display = 'none';
                    }
                }
            } catch (e) {
                console.warn('Could not toggle Edit button visibility', e);
            }
        }

        // URL dan step parametrini o'qish
        (function() {
            try {
                const params = new URLSearchParams(window.location.search);
                const stepParam = params.get('step');
                if (!stepParam) return;

                const stepNum = parseInt(stepParam, 10);
                if (isNaN(stepNum) || stepNum < 1 || stepNum > 5) return;

                const openStep = () => {
                    try {
                        console.log(`Opening step from URL param: ${stepNum}`);
                        showStep(stepNum);
                    } catch (err) {
                        console.warn('showStep not ready, retrying...', err);
                        setTimeout(() => {
                            try { showStep(stepNum); } catch (e) { console.error('Failed to open step', e); }
                        }, 100);
                    }
                };

                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', openStep);
                } else {
                    openStep();
                }
            } catch (e) {
                console.error('Error parsing step query param', e);
            }
        })();

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
                    
                    document.getElementById('educationFormModalLabel').textContent = "Ta'lim ma'lumotlarini tahrirlash";
                    
                    loadEducationForm(education.degree_type);
                    
                    setTimeout(() => {
                        const form = document.getElementById('educationForm');
                        if (form) {
                            document.getElementById('educationId').value = education.id;
                            
                            const degreeTypeInput = form.querySelector('input[name="degree_type"]');
                            if (degreeTypeInput) {
                                degreeTypeInput.value = education.degree_type;
                            }
                            
                            Object.keys(education).forEach(key => {
                                const input = form.querySelector(`[name="${key}"]`);
                                if (input && education[key] !== null) {
                                    if (key.includes('_date') && education[key]) {
                                        const date = new Date(education[key]);
                                        input.value = date.toISOString().split('T')[0];
                                    } else {
                                        input.value = education[key];
                                    }
                                }
                            });
                            
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

        function saveEducation() {
            console.log('saveEducation function called');
            
            const form = document.getElementById('educationForm');
            console.log('Education form:', form);
            
            if (!form) {
                console.error('Education form not found!');
                showToast('Ta\'lim formasi topilmadi.', 'error');
                return;
            }
            
            const formData = new FormData(form);
            const data = {};
            
            for (let [key, value] of formData.entries()) {
                data[key] = value;
            }
            
            console.log('Form data for education:', data);
            
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
                document.getElementById('workExperienceModalLabel').textContent = "Ish tajribasini tahrirlash";
                
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

        function saveWorkExperience() {
            console.log('saveWorkExperience function called');
            
            const form = document.getElementById('workExperienceForm');
            if (!form) {
                showToast('Ish tajribasi formasi topilmadi.', 'error');
                return;
            }
            
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
                    showWorkExperienceForm(workId);
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

        // ==================== QARINDOSHLAR FUNKSIYALARI ====================

        const regions = @json($regions->map(function($r){ return ['id' => $r->id, 'name' => $r->name]; })->values());
        const districts = @json($districts->map(function($d){ return ['id' => $d->id, 'name' => $d->name, 'region_id' => $d->region_id]; })->values());
        const villages = @json($villages->map(function($v){ return ['id' => $v->id, 'name' => $v->name, 'district_id' => $v->district_id]; })->values());

        function loadRegionsToForm() {
            const viloyatSelect = document.getElementById('relativeViloyat');
            if (!viloyatSelect) {
                console.error('Viloyat select topilmadi');
                return;
            }

            if (viloyatSelect.options.length > 1) {
                console.log('Viloyat select already populated from server; skipping client fill');
                return;
            }

            viloyatSelect.innerHTML = '<option value="">Viloyat tanlang</option>';
            regions.forEach(region => {
                const option = document.createElement('option');
                option.value = region.name;
                option.textContent = region.name;
                option.dataset.regionId = region.id;
                viloyatSelect.appendChild(option);
            });
        }

        function loadTumanlar(regionName) {
            const tumanSelect = document.getElementById('relativeTuman');
            const qishloqSelect = document.getElementById('relativeQishloq');

            if (!tumanSelect || !qishloqSelect) {
                console.error('Tuman yoki qishloq select topilmadi');
                return;
            }

            tumanSelect.innerHTML = '<option value="">Tuman tanlang</option>';
            qishloqSelect.innerHTML = '<option value="">Qishloq/MFY tanlang</option>';

            if (!regionName) return;

            const serverDistrictOptions = Array.from(document.querySelectorAll('#relativeTuman option[data-region-id]'));
            if (serverDistrictOptions.length > 0) {
                const viloyatOption = Array.from(document.querySelectorAll('#relativeViloyat option')).find(o => o.value === regionName);
                const regionId = viloyatOption ? viloyatOption.dataset.regionId : null;
                if (!regionId) {
                    console.error('Region id not found for', regionName);
                    return;
                }

                serverDistrictOptions
                    .filter(o => o.dataset.regionId == regionId)
                    .forEach(o => {
                        const opt = document.createElement('option');
                        opt.value = o.value;
                        opt.textContent = o.textContent;
                        opt.dataset.regionId = o.dataset.regionId;
                        tumanSelect.appendChild(opt);
                    });

                return;
            }

            const regionObj = regions.find(r => r.name === regionName);
            if (!regionObj) return;
            const districtList = districts.filter(d => d.region_id == regionObj.id);
            districtList.forEach(district => {
                const option = document.createElement('option');
                option.value = district.name;
                option.textContent = district.name;
                option.dataset.districtId = district.id;
                tumanSelect.appendChild(option);
            });
        }

        function loadQishloqlar(districtName) {
            const qishloqSelect = document.getElementById('relativeQishloq');
            if (!qishloqSelect) {
                console.error('Qishloq select topilmadi');
                return;
            }

            qishloqSelect.innerHTML = '<option value="">Qishloq/MFY tanlang</option>';
            if (!districtName) return;

            const serverVillageOptions = Array.from(document.querySelectorAll('#relativeQishloq option[data-district-id]'));
            if (serverVillageOptions.length > 0) {
                const districtOption = Array.from(document.querySelectorAll('#relativeTuman option')).find(o => o.value === districtName);
                const districtId = districtOption ? districtOption.dataset.districtId : null;
                if (!districtId) {
                    console.error('District id not found for', districtName);
                    return;
                }

                serverVillageOptions
                    .filter(o => o.dataset.districtId == districtId)
                    .forEach(o => {
                        const opt = document.createElement('option');
                        opt.value = o.value;
                        opt.textContent = o.textContent;
                        opt.dataset.districtId = o.dataset.districtId;
                        qishloqSelect.appendChild(opt);
                    });

                return;
            }

            const districtObj = districts.find(d => d.name === districtName);
            if (!districtObj) return;
            const villageList = villages.filter(v => v.district_id == districtObj.id);
            villageList.forEach(village => {
                const option = document.createElement('option');
                option.value = village.name;
                option.textContent = village.name;
                option.dataset.villageId = village.id;
                qishloqSelect.appendChild(option);
            });
        }

        function showRelativeForm(relativeId = null) {
            const container = document.getElementById('relatives-form-container');
            const title = document.getElementById('relativeFormTitle');
            
            if (!container) {
                console.error('Form konteyneri topilmadi');
                return;
            }
            
            if (relativeId) {
                title.textContent = "Qarindoshni tahrirlash";
                loadRelativeData(relativeId);
            } else {
                title.textContent = "Qarindosh qo'shish";
                resetRelativeForm();
            }
            
            container.style.display = 'block';
            container.scrollIntoView({ behavior: 'smooth' });
        }

        function showAddRelativeForm() {
            showRelativeForm();
        }

        function closeRelativeForm() {
            const container = document.getElementById('relatives-form-container');
            if (container) {
                container.style.display = 'none';
            }
        }

        function saveRelative() {
            const container = document.getElementById('relativeForm');
            if (!container) {
                console.error('Form container topilmadi');
                showToast('Form topilmadi', 'error');
                return;
            }

            const requiredFieldIds = [
                'relativeQarindoshlik','relativeFamiliyasi','relativeIsmi','relativeOtasiIsmi','relativeTugilganYili','relativeViloyat','relativeTuman'
            ];

            let missing = [];
            requiredFieldIds.forEach(id => {
                const el = document.getElementById(id);
                if (!el || (!el.value && el.type !== 'checkbox')) missing.push(id);
            });

            if (missing.length) {
                showToast('Iltimos, barcha majburiy maydonlarni to\'ldiring: ' + missing.join(', '), 'error');
                return;
            }

            const formData = new FormData();
            const fields = [
                ['qarindoshlik','relativeQarindoshlik'], ['familiyasi','relativeFamiliyasi'], ['ismi','relativeIsmi'], ['otasi_ismi','relativeOtasiIsmi'],
                ['tugilgan_yili','relativeTugilganYili'], ['tugilgan_joy_viloyat','relativeViloyat'], ['tugilgan_joy_tuman','relativeTuman'], ['tugilgan_joy_qishloq','relativeQishloq'],
                ['tugilgan_joy_soato','relativeSoato'], ['ishi_joyi','relativeIshiJoyi'], ['lavozimi','relativeLavozimi'], ['oquv_yurti','relativeOquvYurti']
            ];

            fields.forEach(([name, id]) => {
                const el = document.getElementById(id);
                if (el) formData.append(name, el.type === 'checkbox' ? (el.checked ? '1' : '0') : el.value);
            });

            const nafaqadaCheckbox = document.getElementById('relativeNafaqada');
            const oqishdaCheckbox = document.getElementById('relativeOqishda');
            formData.append('nafaqada', nafaqadaCheckbox && nafaqadaCheckbox.checked ? '1' : '0');
            formData.append('oqishda', oqishdaCheckbox && oqishdaCheckbox.checked ? '1' : '0');

            const oldIshi = document.getElementById('relativeOldIshiJoyi');
            const oldLav = document.getElementById('relativeOldLavozimi');
            if (nafaqadaCheckbox && nafaqadaCheckbox.checked) {
                if (oldIshi) formData.append('old_ishi_joyi', oldIshi.value || '');
                if (oldLav) formData.append('old_lavozimi', oldLav.value || '');
            } else {
                if (oldIshi) formData.append('old_ishi_joyi', oldIshi.value || '');
                if (oldLav) formData.append('old_lavozimi', oldLav.value || '');
            }

            const relativeId = document.getElementById('relativeId')?.value || '';
            const url = relativeId ? `/employees/{{ $employee->id }}/relatives/${relativeId}` : `/employees/{{ $employee->id }}/relatives`;
            let method = relativeId ? 'PUT' : 'POST';

            if (method === 'PUT') {
                formData.append('_method', 'PUT');
                method = 'POST';
            }

            console.log('Saving relative:', { url, method, relativeId });

            fetch(url, {
                method: method,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast(data.message, 'success');
                    closeRelativeForm();
                    refreshRelativesTable();
                } else {
                    if (data.errors) {
                        let errorMessage = '';
                        for (const field in data.errors) {
                            errorMessage += data.errors[field].join(', ') + '\n';
                        }
                        showToast(errorMessage, 'error');
                    } else {
                        showToast(data.message || 'Saqlashda xatolik', 'error');
                    }
                }
            })
            .catch(error => {
                console.error('Xatolik:', error);
                showToast('Saqlashda xatolik yuz berdi', 'error');
            });
        }

        function editRelative(relativeId) {
            showRelativeForm(relativeId);
        }

        function deleteRelative(relativeId) {
            if (confirm('Haqiqatan ham ushbu qarindoshlik ma\'lumotini o\'chirmoqchimisiz?')) {
                fetch(`/employees/{{ $employee->id }}/relatives/${relativeId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast(data.message, 'success');
                        refreshRelativesTable();
                    } else {
                        showToast(data.message, 'error');
                    }
                })
                .catch(error => console.error('Xatolik:', error));
            }
        }

        function refreshRelativesTable() {
            fetch(`/employees/{{ $employee->id }}/relatives-table`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('relativesTableBody').innerHTML = html;
                })
                .catch(error => console.error('Xatolik:', error));
        }

        function toggleIshJoyiFields() {
            const nafaqadaCheckbox = document.getElementById('relativeNafaqada');
            const ishJoyiFields = document.getElementById('ish-joyi-fields');
            const previousJobFields = document.getElementById('previous-job-fields');
            
            if (nafaqadaCheckbox && ishJoyiFields) {
                if (nafaqadaCheckbox.checked) {
                    ishJoyiFields.style.display = 'none';
                    if (previousJobFields) previousJobFields.style.display = 'block';
                    
                    const currentIshi = document.getElementById('relativeIshiJoyi');
                    const currentLav = document.getElementById('relativeLavozimi');
                    const oldIshi = document.getElementById('relativeOldIshiJoyi');
                    const oldLav = document.getElementById('relativeOldLavozimi');
                    
                    if (oldIshi && !oldIshi.value && currentIshi && currentIshi.value) {
                        oldIshi.value = currentIshi.value;
                    }
                    if (oldLav && !oldLav.value && currentLav && currentLav.value) {
                        oldLav.value = currentLav.value;
                    }
                } else {
                    ishJoyiFields.style.display = 'block';
                    if (previousJobFields) previousJobFields.style.display = 'none';
                }
            }
        }

        function loadRelativeData(relativeId) {
            console.log('Loading relative data for ID:', relativeId);
            
            fetch(`/employees/{{ $employee->id }}/relatives/${relativeId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Received relative data:', data);
                    
                    if (data.success && data.relative) {
                        const relative = data.relative;
                        
                        resetRelativeForm();
                        
                        document.getElementById('relativeId').value = relative.id;
                        document.getElementById('relativeQarindoshlik').value = relative.qarindoshlik || '';
                        document.getElementById('relativeFamiliyasi').value = relative.familiyasi || '';
                        document.getElementById('relativeIsmi').value = relative.ismi || '';
                        document.getElementById('relativeOtasiIsmi').value = relative.otasi_ismi || '';
                        document.getElementById('relativeTugilganYili').value = relative.tugilgan_yili || '';
                        
                        if (relative.tugilgan_joy_viloyat) {
                            const viloyatSelect = document.getElementById('relativeViloyat');
                            viloyatSelect.value = relative.tugilgan_joy_viloyat;
                            
                            loadTumanlar(relative.tugilgan_joy_viloyat);
                            
                            setTimeout(() => {
                                const tumanSelect = document.getElementById('relativeTuman');
                                if (relative.tugilgan_joy_tuman) {
                                    tumanSelect.value = relative.tugilgan_joy_tuman;
                                    
                                    loadQishloqlar(relative.tugilgan_joy_tuman);
                                    
                                    setTimeout(() => {
                                        const qishloqSelect = document.getElementById('relativeQishloq');
                                        if (relative.tugilgan_joy_qishloq) {
                                            qishloqSelect.value = relative.tugilgan_joy_qishloq;
                                        }
                                    }, 500);
                                }
                            }, 500);
                        }
                        
                        try {
                            const ishiJoyiEl = document.getElementById('relativeIshiJoyi');
                            const lavozimiEl = document.getElementById('relativeLavozimi');
                            const oldIshiEl = document.getElementById('relativeOldIshiJoyi');
                            const oldLavEl = document.getElementById('relativeOldLavozimi');
                            const oquvYurtiEl = document.getElementById('relativeOquvYurti');

                            if (ishiJoyiEl) ishiJoyiEl.value = relative.ishi_joyi || '';
                            if (lavozimiEl) lavozimiEl.value = relative.lavozimi || '';
                            if (oldIshiEl) oldIshiEl.value = relative.old_ishi_joyi || '';
                            if (oldLavEl) oldLavEl.value = relative.old_lavozimi || '';
                            if (oquvYurtiEl) oquvYurtiEl.value = relative.oquv_yurti || '';

                            const nafaqadaEl = document.getElementById('relativeNafaqada');
                            const oqishdaEl = document.getElementById('relativeOqishda');
                            const truthy = v => (v === true || v === 1 || v === '1' || v === 'true' || v === 'on');

                            if (nafaqadaEl) {
                                nafaqadaEl.checked = truthy(relative.nafaqada);
                            }
                            if (oqishdaEl) {
                                oqishdaEl.checked = truthy(relative.oqishda);
                            }

                            toggleIshJoyiFields();
                            toggleOquvYurtiField();
                        } catch (e) {
                            console.warn('Could not populate some relative fields:', e);
                        }

                        console.log('Form successfully populated with relative data');
                    } else {
                        throw new Error(data.message || 'Invalid response format');
                    }
                })
                .catch(error => {
                    console.error('Error loading relative data:', error);
                    showToast('Ma\'lumotlarni yuklashda xatolik: ' + error.message, 'error');
                });
        }

        function resetRelativeForm() {
            document.getElementById('relativeId').value = '';

            const fieldIds = [
                'relativeQarindoshlik','relativeFamiliyasi','relativeIsmi','relativeOtasiIsmi',
                'relativeTugilganYili','relativeViloyat','relativeTuman','relativeQishloq',
                'relativeSoato','relativeIshiJoyi','relativeLavozimi','relativeOquvYurti',
                'relativeNafaqada','relativeOqishda'
            ];

            fieldIds.forEach(id => {
                const el = document.getElementById(id);
                if (!el) return;
                if (el.tagName === 'SELECT' || el.tagName === 'INPUT' || el.tagName === 'TEXTAREA') {
                    if (el.type === 'checkbox' || el.type === 'radio') {
                        el.checked = false;
                    } else {
                        el.value = '';
                    }
                }
            });

            const ishJoyiFields = document.getElementById('ish-joyi-fields');
            const oquvYurtiField = document.getElementById('oquv-yurti-field');
            if (ishJoyiFields) ishJoyiFields.style.display = 'block';
            if (oquvYurtiField) oquvYurtiField.style.display = 'none';

            const tumanSelect = document.getElementById('relativeTuman');
            const qishloqSelect = document.getElementById('relativeQishloq');
            if (tumanSelect) tumanSelect.innerHTML = '<option value="">Tuman tanlang</option>';
            if (qishloqSelect) qishloqSelect.innerHTML = '<option value="">Qishloq/MFY tanlang</option>';

            loadRegionsToForm();

            const oldIshi = document.getElementById('relativeOldIshiJoyi');
            const oldLav = document.getElementById('relativeOldLavozimi');
            if (oldIshi) oldIshi.value = '';
            if (oldLav) oldLav.value = '';

            setTimeout(() => {
                toggleIshJoyiFields();
                toggleOquvYurtiField();
            }, 100);
        }

        function toggleOquvYurtiField() {
            const oqishdaCheckbox = document.getElementById('relativeOqishda');
            const oquvYurtiField = document.getElementById('oquv-yurti-field');
            
            if (oqishdaCheckbox && oquvYurtiField) {
                if (oqishdaCheckbox.checked) {
                    oquvYurtiField.style.display = 'block';
                } else {
                    oquvYurtiField.style.display = 'none';
                }
            }
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
                            <input type="text" name="certificate_number" class="form-control" placeholder="Atestat raqami">
                            <label>Atestat raqami</label>
                        </div>
                    </div>
                </div>
            `;
        }

        // ==================== YORDAMCHI FUNKSIYALARI ====================

        // Input validatsiya funksiyasi
        function validateInput(input) {
            const inputType = input.getAttribute('data-type');
            const value = input.value;
            
            if (inputType === 'text-only') {
                // Faqat harflar va bo'shliq
                const textRegex = /^[a-zA-Zа-яА-ЯёЁ\s]+$/;
                if (value && !textRegex.test(value)) {
                    input.value = value.replace(/[^a-zA-Zа-яА-ЯёЁ\s]/g, '');
                    showToast('Faqat harflar va bo\'shliq kiritish mumkin', 'error');
                }
            } else if (inputType === 'number-only') {
                // Faqat raqamlar
                const numberRegex = /^[0-9]+$/;
                if (value && !numberRegex.test(value)) {
                    input.value = value.replace(/[^0-9]/g, '');
                    // Faqat noto'g'ri belgi kiritilganda toast ko'rsatish
                  
                }
            } else if (inputType === 'mixed') {
                // Harflar, raqamlar va ba'zi belgilar (passport seriya, mashina raqami)
                const mixedRegex = /^[a-zA-Zа-яА-ЯёЁ0-9\s\-]+$/;
                if (value && !mixedRegex.test(value)) {
                    input.value = value.replace(/[^a-zA-Zа-яА-ЯёЁ0-9\s\-]/g, '');
                    showToast('Faqat harflar, raqamlar va tire kiritish mumkin', 'error');
                }
            }
        }

        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            let alertClass = 'alert-info';
            
            if (type === 'error') {
                alertClass = 'alert-danger';
            } else if (type === 'success') {
                alertClass = 'alert-success';
            } else if (type === 'info') {
                alertClass = 'alert-info';
            }
            
            toast.className = `alert ${alertClass} alert-dismissible fade show position-fixed`;
            toast.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
            toast.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            document.body.appendChild(toast);
            
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.remove();
                }
            }, 5000);
        }

        // Chiroyli validation xatoliklarini ko'rsatish
        function showValidationErrors(errors) {
            // Eski error toastlarni olib tashlash
            const existingToasts = document.querySelectorAll('.validation-error-toast');
            existingToasts.forEach(toast => toast.remove());
            
            const toast = document.createElement('div');
            toast.className = 'alert alert-danger alert-dismissible fade show position-fixed validation-error-toast';
            toast.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 400px; max-width: 500px;';
            
            let errorList = '<div class="mb-2"><strong><i class="bi bi-exclamation-triangle me-2"></i>Validatsiya xatolari:</strong></div><ul class="mb-0">';
            
            Object.keys(errors).forEach(field => {
                const fieldName = getFieldDisplayName(field);
                errors[field].forEach(error => {
                    errorList += `<li>${fieldName}: ${error}</li>`;
                });
            });
            
            errorList += '</ul>';
            
            toast.innerHTML = `
                ${errorList}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            document.body.appendChild(toast);
            
            // 8 soniyadan keyin avtomatik yashirish
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.remove();
                }
            }, 8000);
        }

        // Field nomlarini chiroyli ko'rinishda qaytarish
        function getFieldDisplayName(field) {
            const fieldNames = {
                'first_name': 'Ism',
                'last_name': 'Familiya',
                'middle_name': 'Otasining ismi',
                'fnfl': 'FNFL',
                'tab_number': 'Tab Nº',
                'gender': 'Jinsi',
                'birth_date': 'Tug\'ilgan sana',
                'phone': 'Telefon',
                'hired_date': 'Ishga olingan sana',
                'organization_id': 'Tashkilot',
                'department': 'Bo\'lim',
                'position': 'Lavozim',
                'worker_and_time': 'Kundalik ish soati',
                'extradepartment': 'Qo\'shimcha bo\'lim',
                'expected_arrival_time': 'Kelish vaqti',
                'cardnumber': 'Card raqami',
                'floor': 'Qavat',
                'room': 'Xona',
                'car_number': 'Mashina raqami',
                'military_status': 'Harbiy holat'
            };
            
            return fieldNames[field] || field;
        }

        // ==================== DEBUG FUNKSIYALARI ====================

        function checkFormIds() {
            console.log('=== FORM ID LARINI TEKSHIRISH ===');
            for (let i = 1; i <= 5; i++) {
                const form = document.getElementById(`step${i}Form`);
                console.log(`step${i}Form:`, form ? 'MAVJUD' : 'MAVJUD EMAS');
                
                if (form) {
                    console.log(`  - Form elementi:`, form);
                    console.log(`  - Form action:`, form.action);
                    console.log(`  - Form method:`, form.method);
                }
            }
            
            const allForms = document.querySelectorAll('form');
            console.log('Barcha form elementlari:', allForms);
            allForms.forEach((form, index) => {
                console.log(`Form ${index}:`, form.id, form);
            });
        }

        // ==================== PASSPORT FILE FUNCTIONS ====================

        // Passport faylni ko'rish
        function viewPassportFile() {
            fetch(`/employees/{{ $employee->id }}/view-passport`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.open(data.file_url, '_blank');
                } else {
                    console.log('Fayl ko\'rishda xatolik:', data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                console.log('Faylni ko\'rishda xatolik!');
            });
        }

        // Passport faylni o'chirish
        function deletePassportFile() {
            if (!confirm('Passport faylini o\'chirishni tasdiqlaysizmi?')) {
                return;
            }

            fetch(`/employees/{{ $employee->id }}/delete-passport`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Fayl o\'chirildi:', data.message);
                    updatePassportFileInfo(null);
                } else {
                    console.log('Fayl o\'chirishda xatolik:', data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                console.log('Faylni o\'chirishda xatolik!');
            });
        }

        // Passport fayl ma'lumotlarini yangilash
        function updatePassportFileInfo(fileUrl) {
            console.log('updatePassportFileInfo chaqirildi:', fileUrl);
            const fileInfoDiv = document.getElementById('passportFileInfo');
            
            if (!fileInfoDiv) {
                console.error('passportFileInfo element topilmadi!');
                return;
            }
            
            console.log('fileInfoDiv topildi:', fileInfoDiv);
            
            if (fileUrl) {
                console.log('Fayl URL mavjud, UI yangilanmoqda...');
                fileInfoDiv.innerHTML = `
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <i class="bi bi-file-earmark-text text-primary me-2"></i>
                            <span class="fw-medium">Passport fayli yuklangan</span>
                        </div>
                        <div>
                            <button type="button" class="btn btn-square btn-link" onclick="viewPassportFile()" title="Ko'rish">
                                <i class="bi bi-eye"></i>
                            </button>
                            <button type="button" class="btn btn-square btn-link text-danger" onclick="deletePassportFile()" title="O'chirish">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                `;
                console.log('UI yangilandi - fayl yuklangan');
            } else {
                console.log('Fayl URL yo\'q, UI yangilanmoqda...');
                fileInfoDiv.innerHTML = `
                    <div class="text-muted">
                        <i class="bi bi-file-earmark-plus me-2"></i>
                        Passport fayli yuklanmagan
                    </div>
                `;
                console.log('UI yangilandi - fayl yuklanmagan');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => {
                checkFormIds();
                
                // Passport fayl yuklash event listener
                const passportFileInput = document.getElementById('passportFile');
                if (passportFileInput) {
                    console.log('Passport file input topildi');
                    passportFileInput.addEventListener('change', function(e) {
                        const file = e.target.files[0];
                        if (!file) return;

                        console.log('Fayl tanlandi:', file.name, file.size, file.type);

                        // Fayl hajmini tekshirish (10MB)
                        if (file.size > 10 * 1024 * 1024) {
                            console.log('Fayl hajmi 10MB dan katta!');
                            return;
                        }

                        // Fayl formatini tekshirish
                        const allowedTypes = ['application/pdf', 'image/jpeg', 'image/jpg', 'image/png'];
                        if (!allowedTypes.includes(file.type)) {
                            console.log('Noto\'g\'ri fayl formati!');
                            return;
                        }

                        const formData = new FormData();
                        formData.append('passport_file', file);
                        formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

                        console.log('FormData yaratildi, yuklash boshlandi...');

                        fetch(`/employees/{{ $employee->id }}/upload-passport`, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        })
                        .then(response => {
                            console.log('Response status:', response.status);
                            return response.json();
                        })
                        .then(data => {
                            console.log('Response data:', data);
                            if (data.success) {
                                console.log('updatePassportFileInfo chaqirilmoqda...');
                                updatePassportFileInfo(data.file_url);
                                
                                // Input ni tozalash
                                e.target.value = '';
                                
                                // Sahifani yangilash
                                setTimeout(() => {
                                    location.reload();
            }, 1000);
                            } else {
                                console.log('Xatolik:', data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            console.log('Fayl yuklashda xatolik yuz berdi!');
                        });
                    });
                } else {
                    console.log('Passport file input topilmadi!');
                }
            }, 1000);
        });

        // DataTable initialization
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize DataTable for education table
            if (document.getElementById('educationTable')) {
                $('#educationTable').DataTable({
                    responsive: true,
                    searching: false,        // Qidirishni o'chirish
                    paging: false,           // Pagination ni o'chirish
                    info: false,             // Info ni o'chirish
                    lengthChange: false,     // Length menu ni o'chirish
                    columnDefs: [
                        { orderable: false, targets: -1 } // Harakatlar ustunini sort qilmaslik
                    ]
                });
            }

            // Initialize DataTable for work experience table
            if (document.getElementById('workExperienceTable')) {
                $('#workExperienceTable').DataTable({
                    responsive: true,
                    searching: false,        // Qidirishni o'chirish
                    paging: false,           // Pagination ni o'chirish
                    info: false,             // Info ni o'chirish
                    lengthChange: false,     // Length menu ni o'chirish
                    columnDefs: [
                        { orderable: false, targets: -1 } // Harakatlar ustunini sort qilmaslik
                    ]
                });
            }

            // Initialize DataTable for relatives table
            if (document.getElementById('relativesTable')) {
                $('#relativesTable').DataTable({
                    responsive: true,
                    searching: false,        // Qidirishni o'chirish
                    paging: false,           // Pagination ni o'chirish
                    info: false,             // Info ni o'chirish
                    lengthChange: false,     // Length menu ni o'chirish
                    columnDefs: [
                        { orderable: false, targets: -1 } // Harakatlar ustunini sort qilmaslik
                    ]
                });
            }

            // Load reasons when step-6 is clicked
            document.getElementById('step-6-tab').addEventListener('shown.bs.tab', function() {
                loadReasons();
            });

            // Reason form submit
            document.getElementById('reasonForm').addEventListener('submit', function(e) {
                e.preventDefault();
                saveReason();
            });
        });

        // Load reasons list
        function loadReasons() {
            const container = document.getElementById('reasonsList');
            container.innerHTML = '<div class="text-center py-5"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Yuklanmoqda...</span></div></div>';
            
            fetch('/employee-reasons')
                .then(response => response.json())
                .then(data => {
                    if (data.length === 0) {
                        container.innerHTML = '<div class="text-center py-4 text-muted">Sabablar mavjud emas</div>';
                        return;
                    }
                    
                    let html = '';
                    data.forEach(reason => {
                        const colorStyle = reason.color ? `background-color: ${reason.color}` : '';
                        html += `
                            <div class="list-group-item d-flex justify-content-between align-items-start" data-id="${reason.id}">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold d-flex align-items-center">
                                        <span class="badge me-2" style="${colorStyle}">&nbsp;&nbsp;&nbsp;</span>
                                        ${reason.name}
                                    </div>
                                    <small class="text-muted">${reason.description || 'Tavsif yo\'q'}</small>
                                </div>
                                <div>
                                    <button class="btn btn-sm btn-outline-primary me-1" onclick="editReason(${reason.id})">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" onclick="deleteReason(${reason.id})">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                        `;
                    });
                    container.innerHTML = html;
                })
                .catch(error => {
                    console.error('Error loading reasons:', error);
                    container.innerHTML = '<div class="text-center py-4 text-danger">Xatolik yuz berdi</div>';
                });
        }

        // Save reason
        function saveReason() {
            const formData = new FormData(document.getElementById('reasonForm'));
            const data = {
                name: formData.get('name'),
                color: formData.get('color'),
                description: formData.get('description'),
                is_active: formData.get('is_active') === 'on'
            };
            
            const reasonId = formData.get('reason_id');
            const url = reasonId ? `/employee-reasons/${reasonId}` : '/employee-reasons';
            const method = reasonId ? 'PUT' : 'POST';
            
            fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    alert('Muvaffaqiyatli saqlandi!');
                    resetReasonForm();
                    loadReasons();
                } else {
                    alert('Xatolik: ' + result.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Xatolik yuz berdi!');
            });
        }

        // Edit reason
        function editReason(id) {
            fetch(`/employee-reasons/${id}`)
                .then(response => response.json())
                .then(reason => {
                    document.getElementById('reason_id').value = reason.id;
                    document.getElementById('reason_name').value = reason.name;
                    document.getElementById('reason_color').value = reason.color || '#667eea';
                    document.getElementById('reason_description').value = reason.description || '';
                    document.getElementById('reason_is_active').checked = reason.is_active;
                })
                .catch(error => {
                    console.error('Error loading reason:', error);
                    alert('Xatolik yuz berdi!');
                });
        }

        // Delete reason
        function deleteReason(id) {
            if (!confirm('Haqiqatan ham o\'chirmoqchimisiz?')) return;
            
            fetch(`/employee-reasons/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    alert('O\'chirildi!');
                    loadReasons();
                } else {
                    alert('Xatolik: ' + result.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Xatolik yuz berdi!');
            });
        }

        // Reset reason form
        function resetReasonForm() {
            document.getElementById('reasonForm').reset();
            document.getElementById('reason_id').value = '';
            document.getElementById('reason_color').value = '#667eea';
            document.getElementById('reason_is_active').checked = true;
        }

            // Load employee reasons when step-6 is clicked
            document.getElementById('step-6-tab').addEventListener('shown.bs.tab', function() {
                loadEmployeeReasons({{ $employee->id }});
                loadModalReasonsOptions();
            });

            // Reset add modal form when closed
            document.getElementById('addUserReasonModal').addEventListener('hidden.bs.modal', function() {
                // Remove any lingering backdrop
                const backdrops = document.querySelectorAll('.modal-backdrop');
                backdrops.forEach(backdrop => {
                    if (!document.querySelector('.modal.show')) {
                        backdrop.remove();
                    }
                });
                
                // Remove body classes if no modal is open
                if (!document.querySelector('.modal.show')) {
                    document.body.classList.remove('modal-open');
                    document.body.style.overflow = '';
                    document.body.style.paddingRight = '';
                }
                
                // Reset form
                const form = document.getElementById('addEmployeeReasonForm');
                if (form) {
                    form.reset();
                    document.getElementById('user-daily-fields').style.display = 'block';
                    document.getElementById('user-hourly-fields').style.display = 'none';
                    document.getElementById('modal_reason_type_daily').checked = true;
                }
            });

            // Reset edit modal form when closed
            document.getElementById('editUserReasonModal').addEventListener('hidden.bs.modal', function() {
                // Remove any lingering backdrop
                const backdrops = document.querySelectorAll('.modal-backdrop');
                backdrops.forEach(backdrop => {
                    if (!document.querySelector('.modal.show')) {
                        backdrop.remove();
                    }
                });
                
                // Remove body classes if no modal is open
                if (!document.querySelector('.modal.show')) {
                    document.body.classList.remove('modal-open');
                    document.body.style.overflow = '';
                    document.body.style.paddingRight = '';
                }
                
                // Reset form
                const form = document.getElementById('editEmployeeReasonForm');
                if (form) {
                    form.reset();
                    document.getElementById('edit_reason_item_id').value = '';
                    document.getElementById('edit-user-daily-fields').style.display = 'block';
                    document.getElementById('edit-user-hourly-fields').style.display = 'none';
                    document.getElementById('edit_modal_reason_type_daily').checked = true;
                }
            });

        // Load employee reasons list (real-time update)
        function loadEmployeeReasons(employeeId) {
            const tbody = document.getElementById('employeeReasonsTableBody');
            if (!tbody) return;
            
            // Show loading
            tbody.innerHTML = '<tr><td colspan="6" class="text-center py-5"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Yuklanmoqda...</span></div></td></tr>';
            
            // Safely destroy existing DataTable if exists
            try {
                if (typeof $ !== 'undefined' && $.fn.DataTable && $.fn.DataTable.isDataTable('#employeeReasonsTable')) {
                    const table = $('#employeeReasonsTable').DataTable();
                    if (table) {
                        table.destroy();
                    }
                }
            } catch (e) {
                console.warn('DataTable destroy warning:', e);
            }
            
            fetch(`/employee-reason-items/${employeeId}`)
                .then(r => {
                    if (!r.ok) throw new Error('Network error');
                    return r.json();
                })
                .then(items => {
                    if (!items || !Array.isArray(items)) {
                        tbody.innerHTML = '<tr><td colspan="6" class="text-center py-4 text-danger">Ma\'lumotlar xato</td></tr>';
                        return;
                    }
                    
                    if (!items.length) {
                        tbody.innerHTML = '<tr><td colspan="6" class="text-center py-4 text-muted">Sabablar mavjud emas</td></tr>';
                        return;
                    }
                    
                    let html = '';
                    items.forEach(it => {
                        const typeBadge = it.type === 'daily' ? '<span class="badge bg-info">Kunlik</span>' : '<span class="badge bg-warning text-dark">Soatlik</span>';
                        const statusBadge = it.status === 'ongoing' ? '<span class="badge bg-success">Davom etmoqda</span>' : '<span class="badge bg-secondary">Tugallangan</span>';
                        const period = it.type === 'daily' ?
                            (it.start_date ? new Date(it.start_date).toLocaleDateString('uz-UZ') : '') + 
                            (it.end_date ? ' — ' + new Date(it.end_date).toLocaleDateString('uz-UZ') : '') :
                            (it.start_datetime ? new Date(it.start_datetime).toLocaleString('uz-UZ') : '') + 
                            (it.end_datetime ? ' — ' + new Date(it.end_datetime).toLocaleString('uz-UZ') : '');
                        const reasonName = it.reason ? it.reason.name : '-';
                        const reasonColor = it.reason && it.reason.color ? it.reason.color : '#667eea';
                        const editBtn = it.status === 'ongoing' ? 
                            `<a href="javascript:void(0)" class="btn btn-square btn-link" onclick="editEmployeeReasonItem(${it.id})" title="Tahrirlash">
                                <i class="bi bi-pencil-square"></i>
                            </a>` : '';
                        const comment = it.comment ? (it.comment.length > 50 ? it.comment.substring(0, 50) + '...' : it.comment) : '-';
                        
                        html += `<tr data-id="${it.id}">
                            <td class="dtr-control" tabindex="0">${typeBadge}</td>
                            <td>${period || '-'}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="badge me-2" style="background-color: ${reasonColor}">&nbsp;&nbsp;&nbsp;</span>
                                    <span>${reasonName}</span>
                                </div>
                            </td>
                            <td>${statusBadge}</td>
                            <td>${comment}</td>
                            <td>
                                ${editBtn}
                                <button type="button" class="btn btn-square btn-link text-danger" onclick="deleteEmployeeReason(${it.id}, ${employeeId})" title="O'chirish">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>`;
                    });
                    tbody.innerHTML = html;
                    
                    // Initialize DataTable with delay to ensure DOM is ready
                    setTimeout(() => {
                        try {
                            if (typeof $ !== 'undefined' && $.fn.DataTable) {
                                // Check if already initialized
                                if (!$.fn.DataTable.isDataTable('#employeeReasonsTable')) {
                                    $('#employeeReasonsTable').DataTable({
                                        responsive: true,
                                        searching: false,
                                        paging: false,
                                        info: false,
                                        lengthChange: false,
                                        columnDefs: [
                                            { orderable: false, targets: -1 }
                                        ]
                                    });
                                }
                            }
                        } catch (e) {
                            console.error('DataTable initialization error:', e);
                        }
                    }, 100);
                })
                .catch(error => {
                    console.error('Load reasons error:', error);
                    tbody.innerHTML = '<tr><td colspan="6" class="text-center py-4 text-danger">Xatolik yuz berdi</td></tr>';
                });
        }

        function loadModalReasonsOptions(editMode = false) {
            // Load for add modal
            if (!editMode) {
                const select = document.getElementById('modal_reason_id');
                if (select) {
                    select.innerHTML = '<option value="">Yuklanmoqda...</option>';
                    fetch('/employee-reasons')
                        .then(r => r.json())
                        .then(data => {
                            select.innerHTML = '<option value="">Sababni tanlang...</option>';
                            data.forEach(r => {
                                const opt = document.createElement('option');
                                opt.value = r.id;
                                opt.textContent = r.name;
                                select.appendChild(opt);
                            });
                        })
                        .catch(() => {
                            select.innerHTML = '<option value="">Xatolik</option>';
                        });
                }
            }
            
            // Load for edit modal
            const editSelect = document.getElementById('edit_modal_reason_id');
            if (editSelect) {
                // Check if options already loaded (has options with values)
                const hasOptions = editSelect.querySelectorAll('option').length > 1 || 
                                   Array.from(editSelect.querySelectorAll('option')).some(opt => opt.value && opt.value !== '');
                
                if (!hasOptions) {
                    editSelect.innerHTML = '<option value="">Yuklanmoqda...</option>';
                    fetch('/employee-reasons')
                        .then(r => r.json())
                        .then(data => {
                            editSelect.innerHTML = '<option value="">Sababni tanlang...</option>';
                            data.forEach(r => {
                                const opt = document.createElement('option');
                                opt.value = r.id;
                                opt.textContent = r.name;
                                editSelect.appendChild(opt);
                            });
                        })
                        .catch(() => {
                            editSelect.innerHTML = '<option value="">Xatolik</option>';
                        });
                }
            }
        }

        function toggleUserReasonType() {
            const daily = document.getElementById('modal_reason_type_daily').checked;
            document.getElementById('user-daily-fields').style.display = daily ? 'block' : 'none';
            document.getElementById('user-hourly-fields').style.display = daily ? 'none' : 'block';
        }

        function saveEmployeeReason() {
            const form = document.getElementById('addEmployeeReasonForm');
            const formData = new FormData(form);
            const data = {
                employee_id: formData.get('employee_id'),
                reason_id: formData.get('reason_id'),
                type: formData.get('reason_type'),
                comment: formData.get('comment')
            };
            
            // Validation
            if (!data.reason_id) {
                alert('Iltimos, sababni tanlang!');
                return;
            }
            
            if (data.type === 'daily') {
                data.start_date = formData.get('start_date');
                data.end_date = formData.get('end_date');
                if (!data.start_date || !data.end_date) {
                    alert('Iltimos, sanalarni to\'ldiring!');
                    return;
                }
            } else {
                const hourlyDate = formData.get('hourly_date');
                const startTime = formData.get('start_time');
                const endTime = formData.get('end_time');
                
                if (!hourlyDate || !startTime || !endTime) {
                    alert('Iltimos, sana va vaqtlarni to\'ldiring!');
                    return;
                }
                
                // Combine date and time into datetime
                data.start_datetime = `${hourlyDate}T${startTime}:00`;
                data.end_datetime = `${hourlyDate}T${endTime}:00`;
            }
            
            fetch('/employee-reason-items', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(data)
            })
            .then(r => r.json())
            .then(res => {
                if (res.success) {
                    // Close modal smoothly
                    const modalElement = document.getElementById('addUserReasonModal');
                    const modal = bootstrap.Modal.getInstance(modalElement);
                    
                    if (modal) {
                        modal.hide();
                    } else {
                        // Fallback
                        if (typeof $ !== 'undefined') {
                            $(modalElement).modal('hide');
                        } else {
                            modalElement.classList.remove('show');
                            modalElement.style.display = 'none';
                        }
                    }
                    
                    // Real-time update table with delay to ensure modal is closed
                    setTimeout(() => {
                        loadEmployeeReasons({{ $employee->id }});
                    }, 300);
                } else {
                    alert('Xatolik: ' + (res.message || 'Noma\'lum xatolik'));
                }
            })
            .catch(error => {
                console.error('Save error:', error);
                alert('Xatolik yuz berdi!');
            });
        }

        function deleteEmployeeReason(id, employeeId) {
            if (!confirm('Haqiqatan ham o\'chirmoqchimisiz?')) return;
            
            fetch(`/employee-reason-items/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(r => r.json())
            .then(res => {
                if (res.success) {
                    // Real-time update table
                    loadEmployeeReasons(employeeId);
                } else {
                    alert('Xatolik: ' + (res.message || 'Noma\'lum xatolik'));
                }
            })
            .catch(error => {
                console.error('Delete error:', error);
                alert('Xatolik yuz berdi!');
            });
        }

        function editEmployeeReasonItem(id) {
            if (!id) {
                alert('Xatolik: Sabab ID topilmadi');
                return;
            }
            
            // Close add modal if open
            const addModal = bootstrap.Modal.getInstance(document.getElementById('addUserReasonModal'));
            if (addModal) {
                addModal.hide();
            }
            
            // Load reasons for edit modal
            loadModalReasonsOptions(true);
            
            // Wait a bit for reasons to load, then fetch item data
            setTimeout(() => {
                fetch(`/employee-reason-item/${id}`)
                    .then(r => {
                        if (!r.ok) {
                            return r.json().then(err => {
                                throw new Error(err.message || 'Ma\'lumot yuklashda xatolik');
                            });
                        }
                        return r.json();
                    })
                    .then(item => {
                        if (!item || item.success === false) {
                            throw new Error(item.message || 'Sabab topilmadi');
                        }
                        
                        // Fill form fields
                        document.getElementById('edit_reason_item_id').value = item.id;
                        document.getElementById('edit_modal_reason_status').value = item.status || 'ongoing';
                        document.getElementById('edit_modal_reason_comment').value = item.comment || '';
                        
                        // Format dates properly
                        let startDate = '';
                        let endDate = '';
                        let startDateTime = '';
                        let endDateTime = '';
                        
                        if (item.type === 'daily') {
                            if (item.start_date) {
                                const sd = new Date(item.start_date);
                                if (!isNaN(sd.getTime())) {
                                    startDate = sd.toISOString().split('T')[0];
                                }
                            }
                            if (item.end_date) {
                                const ed = new Date(item.end_date);
                                if (!isNaN(ed.getTime())) {
                                    endDate = ed.toISOString().split('T')[0];
                                }
                            }
                            document.getElementById('edit_modal_reason_type_daily').checked = true;
                            document.getElementById('edit_modal_start_date').value = startDate;
                            document.getElementById('edit_modal_end_date').value = endDate;
                            document.getElementById('edit-user-daily-fields').style.display = 'block';
                            document.getElementById('edit-user-hourly-fields').style.display = 'none';
                        } else {
                            // Parse datetime for hourly type
                            if (item.start_datetime) {
                                const sdt = new Date(item.start_datetime);
                                if (!isNaN(sdt.getTime())) {
                                    document.getElementById('edit_modal_hourly_date').value = sdt.toISOString().split('T')[0];
                                    document.getElementById('edit_modal_start_time').value = sdt.toTimeString().slice(0, 5);
                                }
                            }
                            if (item.end_datetime) {
                                const edt = new Date(item.end_datetime);
                                if (!isNaN(edt.getTime())) {
                                    document.getElementById('edit_modal_end_time').value = edt.toTimeString().slice(0, 5);
                                }
                            }
                            document.getElementById('edit_modal_reason_type_hourly').checked = true;
                            document.getElementById('edit-user-daily-fields').style.display = 'none';
                            document.getElementById('edit-user-hourly-fields').style.display = 'block';
                        }
                        
                        // Set reason dropdown value - wait a bit more if still loading
                        const editSelect = document.getElementById('edit_modal_reason_id');
                        if (editSelect) {
                            if (editSelect.options.length > 1) {
                                editSelect.value = item.reason_id;
                            } else {
                                // Wait for options to load
                                setTimeout(() => {
                                    editSelect.value = item.reason_id;
                                }, 300);
                            }
                        }
                        
                        // Show edit modal
                        const editModal = new bootstrap.Modal(document.getElementById('editUserReasonModal'));
                        editModal.show();
                    })
                    .catch(error => {
                        console.error('Error loading reason item:', error);
                        alert('Xatolik: ' + (error.message || 'Ma\'lumotlarni yuklashda xatolik yuz berdi'));
                    });
            }, 200);
        }

        function toggleEditUserReasonType() {
            const daily = document.getElementById('edit_modal_reason_type_daily').checked;
            document.getElementById('edit-user-daily-fields').style.display = daily ? 'block' : 'none';
            document.getElementById('edit-user-hourly-fields').style.display = daily ? 'none' : 'block';
        }

        function updateEmployeeReason() {
            const form = document.getElementById('editEmployeeReasonForm');
            const formData = new FormData(form);
            const itemId = document.getElementById('edit_reason_item_id').value;
            
            if (!itemId) {
                alert('Xatolik: Sabab ID topilmadi');
                return;
            }
            
            const data = {
                reason_id: formData.get('reason_id'),
                type: formData.get('reason_type'),
                comment: formData.get('comment'),
                status: formData.get('status') || 'ongoing'
            };
            
            // Add dates based on type
            if (data.type === 'daily') {
                const startDate = formData.get('start_date');
                const endDate = formData.get('end_date');
                if (!startDate || !endDate) {
                    alert('Iltimos, sanalarni to\'ldiring!');
                    return;
                }
                data.start_date = startDate;
                data.end_date = endDate;
                // Clear datetime fields
                data.start_datetime = null;
                data.end_datetime = null;
            } else {
                const hourlyDate = formData.get('hourly_date');
                const startTime = formData.get('start_time');
                const endTime = formData.get('end_time');
                
                if (!hourlyDate || !startTime || !endTime) {
                    alert('Iltimos, sana va vaqtlarni to\'ldiring!');
                    return;
                }
                
                // Combine date and time into datetime
                data.start_datetime = `${hourlyDate}T${startTime}:00`;
                data.end_datetime = `${hourlyDate}T${endTime}:00`;
                // Clear date fields
                data.start_date = null;
                data.end_date = null;
            }
            
            fetch(`/employee-reason-items/${itemId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(async r => {
                const responseData = await r.json();
                if (!r.ok) {
                    throw responseData;
                }
                return responseData;
            })
            .then(res => {
                if (res.success) {
                    // Close modal first
                    const modal = bootstrap.Modal.getInstance(document.getElementById('editUserReasonModal'));
                    if (modal) {
                        modal.hide();
                    }
                    
                    // Reset form after a short delay
                    setTimeout(() => {
                        form.reset();
                    }, 200);
                    
                    // Real-time update table with delay to ensure modal is closed
                    setTimeout(() => {
                        loadEmployeeReasons({{ $employee->id }});
                    }, 300);
                } else {
                    throw new Error(res.message || 'Noma\'lum xatolik');
                }
            })
            .catch(error => {
                console.error('Update error:', error);
                let errorMsg = 'Xatolik yuz berdi';
                
                if (error.message) {
                    errorMsg = error.message;
                } else if (error.errors) {
                    errorMsg = Object.values(error.errors).flat().join(', ');
                } else if (typeof error === 'object') {
                    errorMsg = error.message || JSON.stringify(error);
                }
                
                alert('Xatolik: ' + errorMsg);
            });
        }
</script>
        </div>
    </div>
</div>
@endsection