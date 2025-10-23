@extends('layouts.app')

@section('content')
<div class="card adminuiux-card mb-3">
    <div class="card-body">
        <!-- data table -->
        <div class="mb-3">
            <table id="dataTable" class="table w-100 nowrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>FIO</th>
                        <th>Lavozim</th>
                        <th>Bo'lim</th>
                        <th>Tashkilot</th>
                        <th>Telefon</th>
                        <th>Amallar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $employee)
                    <tr>
                        <td>{{ $employee->id }}</td>
                        <td>
                            <div class="row align-items-center flex-nowrap">
                                <div class="col-auto">
                                    <figure class="avatar avatar-40 mb-0 coverimg rounded-circle">
                                        <img src="{{ $employee->image && file_exists(public_path('storage/' . $employee->image)) ? asset('storage/' . $employee->image) : asset('assets/img/modern-ai-image/user-3.jpg') }}" alt="{{ $employee->first_name }}">
                                    </figure>
                                </div>
                                <div class="col ps-0">
                                    <p class="mb-0 fw-medium">{{ $employee->last_name }} {{ $employee->first_name }} {{ $employee->middle_name }}</p>
                                </div>
                            </div>
                        </td>
                        <td>{{ $employee->position }}</td>
                        <td>{{ $employee->department }}</td>
                        <td>{{ $employee->organization->name ?? '-' }}</td>
                        <td>{{ $employee->phone }}</td>
                        <td>
                            {{ $employee }}
                            <button class="btn btn-square btn-link view-employee" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#employeeModal"
                                    data-employee-id="{{ $employee->id }}"
                                    title="Ko'rish">
                                <i class="bi bi-eye"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Employee Ma'lumotlari Modal -->
<div class="modal fade" id="employeeModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="employeeModalLabel">Xodim Ma'lumotlari</h5>
                <div class="ms-auto d-flex align-items-center">
                    <button type="button" id="employeeEditBtn" class="btn btn-sm btn-primary me-2" style="display:none;">Tahrirlash</button>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body">
                <!-- Tab Navigation -->
                <ul class="nav nav-pills nav-justified mb-4" id="employeeTabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#tab-main" data-bs-toggle="tab">
                            Asosiy ma'lumotlar
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-passport" data-bs-toggle="tab">
                            Pasport ma'lumotlari
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-education" data-bs-toggle="tab">
                            Ta'lim ma'lumotlari
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-work" data-bs-toggle="tab">
                            Ish tajribasi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-relatives" data-bs-toggle="tab">
                            Qarindoshlar
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-additional" data-bs-toggle="tab">
                            Qo'shimcha ma'lumotlar
                        </a>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content" id="employeeTabContent">
                    <!-- Asosiy ma'lumotlar -->
                    <div class="tab-pane fade show active" id="tab-main">
                        <div class="row">
                            <div class="col-md-3 text-center">
                                <img id="modal-employee-image" src="" alt="Employee Image" class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Familiya</label>
                                            <p id="modal-last-name" class="form-control-plaintext">-</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Ism</label>
                                            <p id="modal-first-name" class="form-control-plaintext">-</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Otasining ismi</label>
                                            <p id="modal-middle-name" class="form-control-plaintext">-</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Telefon</label>
                                            <p id="modal-phone" class="form-control-plaintext">-</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Lavozim</label>
                                            <p id="modal-position" class="form-control-plaintext">-</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Bo'lim</label>
                                            <p id="modal-department" class="form-control-plaintext">-</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Tab Nº</label>
                                            <p id="modal-tab-number" class="form-control-plaintext">-</p>
                                            <small class="text-muted">Debug: <span id="debug-tab-number">Loading...</span></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Tashkilot</label>
                                            <p id="modal-organization" class="form-control-plaintext">-</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Tug'ilgan sana</label>
                                            <p id="modal-birth-date" class="form-control-plaintext">-</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pasport ma'lumotlari -->
                    <div class="tab-pane fade" id="tab-passport">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Pasport seriya raqam</label>
                                    <p id="modal-passport-seria" class="form-control-plaintext">-</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Kim tomonidan berilgan</label>
                                    <p id="modal-passport-by" class="form-control-plaintext">-</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Berilgan sana</label>
                                    <p id="modal-passport-issue-date" class="form-control-plaintext">-</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Amal qilish muddati</label>
                                    <p id="modal-passport-expiry" class="form-control-plaintext">-</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Harbiy toifasi</label>
                                    <p id="modal-military-category" class="form-control-plaintext">-</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Doimiy yashash joyi</label>
                                    <p id="modal-permanent-address" class="form-control-plaintext">-</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Hozirgi yashash joyi</label>
                                    <p id="modal-current-address" class="form-control-plaintext">-</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ta'lim ma'lumotlari -->
                    <div class="tab-pane fade" id="tab-education">
                        <div id="modal-education-list">
                            <div class="alert alert-info">Ma'lumot yuklanmoqda...</div>
                        </div>
                    </div>

                    <!-- Ish tajribasi -->
                    <div class="tab-pane fade" id="tab-work">
                        <div id="modal-work-experience">
                            <div class="alert alert-info">Ma'lumot yuklanmoqda...</div>
                        </div>
                    </div>

                    <!-- Qarindoshlar -->
                    <div class="tab-pane fade" id="tab-relatives">
                        <div id="modal-relatives-list">
                            <div class="alert alert-info">Ma'lumot yuklanmoqda...</div>
                        </div>
                    </div>

                    <!-- Qo'shimcha ma'lumotlar -->
                    <div class="tab-pane fade" id="tab-additional">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Bo'y</label>
                                    <p id="modal-height" class="form-control-plaintext">-</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Vazn</label>
                                    <p id="modal-weight" class="form-control-plaintext">-</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Kostyum razmeri</label>
                                    <p id="modal-suit-size" class="form-control-plaintext">-</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Poyabzal razmeri</label>
                                    <p id="modal-shoe-size" class="form-control-plaintext">-</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Telegram username</label>
                                    <p id="modal-telegram" class="form-control-plaintext">-</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Sudlanganmi</label>
                                    <p id="modal-criminal-record" class="form-control-plaintext">-</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Soliq ID</label>
                                    <p id="modal-tax-id" class="form-control-plaintext">-</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">INPS</label>
                                    <p id="modal-inps" class="form-control-plaintext">-</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Davlat mukofoti</label>
                                    <p id="modal-state-award" class="form-control-plaintext">-</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Yopish</button>
            </div>
        </div>
    </div>
</div>


@endsection
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded - employee scripts initialized');
    
    // View employee modal
    document.querySelectorAll('.view-employee').forEach(button => {
        button.addEventListener('click', function() {
            const employeeId = this.getAttribute('data-employee-id');
            console.log('View button clicked, Employee ID:', employeeId);
            loadEmployeeData(employeeId);
        });
    });

    // Ta'lim ma'lumotlarini yuklash
    function loadEducationData(educations) {
        const educationList = document.getElementById('modal-education-list');
        
        if (!educations || educations.length === 0) {
            educationList.innerHTML = '<div class="alert alert-info">Ta\'lim ma\'lumotlari mavjud emas</div>';
            return;
        }

        let html = '<div class="row">';
        educations.forEach((edu, index) => {
            html += `
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Ta'lim ${index + 1}</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">Ta'lim turi</label>
                                    <p>${edu.type || '-'}</p>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">O'quv yurti</label>
                                    <p>${edu.university || '-'}</p>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">Fakultet</label>
                                    <p>${edu.faculty || '-'}</p>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">Mutaxassislik</label>
                                    <p>${edu.speciality || '-'}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Boshlanish sanasi</label>
                                    <p>${edu.start_date ? new Date(edu.start_date).toLocaleDateString() : '-'}</p>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Tugash sanasi</label>
                                    <p>${edu.end_date ? new Date(edu.end_date).toLocaleDateString() : '-'}</p>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Diplom raqami</label>
                                    <p>${edu.diploma_number || '-'}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        });
        html += '</div>';
        educationList.innerHTML = html;
    }

    // Ish tajribasini yuklash
    function loadWorkExperience(workExperiences) {
        const workList = document.getElementById('modal-work-experience');
        
        if (!workExperiences || workExperiences.length === 0) {
            workList.innerHTML = '<div class="alert alert-info">Ish tajribasi mavjud emas</div>';
            return;
        }

        let html = '<div class="row">';
        workExperiences.forEach((work, index) => {
            // Agar barcha maydonlar null bo'lsa, ko'rsatma
            if (!work.organization && !work.position && !work.start_date && !work.end_date) {
                return;
            }

            html += `
                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Tashkilot</label>
                                    <p>${work.organization || '-'}</p>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Lavozim</label>
                                    <p>${work.position || '-'}</p>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Joriy ish</label>
                                    <p>${work.current_job || 'Yo\'q'}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Ish boshlash sanasi</label>
                                    <p>${work.start_date ? new Date(work.start_date).toLocaleDateString() : '-'}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Ish tugash sanasi</label>
                                    <p>${work.end_date ? new Date(work.end_date).toLocaleDateString() : '-'}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        });
        html += '</div>';
        workList.innerHTML = html;
    }

    // Qarindoshlarni yuklash
    function loadRelativesData(relatives) {
        
        const relativesList = document.getElementById('modal-relatives-list');
        
        if (!relatives || relatives.length === 0) {
            relativesList.innerHTML = '<div class="alert alert-info">Qarindoshlar ma\'lumotlari mavjud emas</div>';
            return;
        }

        let html = '<div class="row">';
        relatives.forEach((relative, index) => {
            html += `
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">${relative.qarindoshlik || 'Qarindosh'} ${index + 1}</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Familiya</label>
                                    <p>${relative.familiyasi || '-'}</p>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Ism</label>
                                    <p>${relative.ismi || '-'}</p>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Otasining ismi</label>
                                    <p>${relative.otasi_ismi || '-'}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">Tug'ilgan yili</label>
                                    <p>${relative.tugilgan_yili || '-'}</p>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">Tug'ilgan joyi</label>
                                    <p>${[relative.tugilgan_joy_viloyat, relative.tugilgan_joy_tuman, relative.tugilgan_joy_qishloq].filter(Boolean).join(', ') || '-'}</p>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">Ish joyi</label>
                                    <p>${relative.ishi_joyi || '-'}</p>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">Lavozimi</label>
                                    <p>${relative.lavozimi || '-'}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Nafaqada</label>
                                    <p>${relative.nafaqada || 'Yo\'q'}</p>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">O'qishda</label>
                                    <p>${relative.oqishda || 'Yo\'q'}</p>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">O'quv yurti</label>
                                    <p>${relative.oquv_yurti || '-'}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        });
        html += '</div>';
        relativesList.innerHTML = html;
    }

    // Asosiy loadEmployeeData funksiyasi
    function loadEmployeeData(employeeId) {
        console.log('Loading employee data for ID:', employeeId);
        
        // Loading holatini ko'rsatish
        showLoadingState();
        
        fetch(`/employees/${employeeId}`)
            .then(response => {
                console.log('Response status:', response.status);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Received data:', data);
                
                // Asosiy ma'lumotlarni ko'rsatish
                displayBasicInfo(data);
                displayPassportInfo(data);
                displayAdditionalInfo(data);
                
                // Dinamik ma'lumotlarni yuklash
                loadEducationData(data.educations || []);
                loadWorkExperience(data.work_experiences || []);
                loadRelativesData(data.relatives || []);
                
                // Modal sarlavhasini yangilash
                updateModalTitle(data);
                
                // Tahrirlash tugmasini sozlash
                setupEditButton(employeeId);
            })
            .catch(error => {
                console.error('Error loading employee data:', error);
                alert('Ma\'lumotlarni yuklashda xatolik yuz berdi: ' + error.message);
            });
    }

    // Loading holati
    function showLoadingState() {
        const fields = document.querySelectorAll('#employeeModal [id^="modal-"]');
        fields.forEach(field => {
            if (field.tagName === 'P' || field.tagName === 'IMG') {
                if (field.tagName === 'IMG') {
                    field.src = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZGRkIi8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtc2l6ZT0iMTgiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGR5PSIuM2VtIj5Mb2FkaW5nLi4uPC90ZXh0Pjwvc3ZnPg==';
                } else {
                    field.textContent = 'Yuklanmoqda...';
                }
            }
        });
    }

    // Asosiy ma'lumotlarni ko'rsatish
    function displayBasicInfo(data) {
        console.log('Displaying basic info:', data);
        
        // Rasm
        const imageElement = document.getElementById('modal-employee-image');
        if (imageElement && data.image) {
            imageElement.src = data.image;
            imageElement.alt = `${data.first_name} ${data.last_name}`;
        }
        
        // Ism familiya
        setFieldValue('modal-last-name', data.last_name);
        setFieldValue('modal-first-name', data.first_name);
        setFieldValue('modal-middle-name', data.middle_name);
        
        // Kontakt ma'lumotlari
        setFieldValue('modal-phone', data.phone);
        setFieldValue('modal-position', data.position);
        setFieldValue('modal-department', data.department);
        setFieldValue('modal-tab-number', data.tab_number);
        setFieldValue('modal-organization', data.organization);
        
        // Tug'ilgan sana
        if (data.birth_date) {
            setFieldValue('modal-birth-date', new Date(data.birth_date).toLocaleDateString());
        } else {
            setFieldValue('modal-birth-date', '-');
        }
        
        // Debug ma'lumotlari
        const debugElement = document.getElementById('debug-tab-number');
        if (debugElement) {
            debugElement.textContent = data.tab_number || 'NULL';
        }
    }

    // Pasport ma'lumotlari
    function displayPassportInfo(data) {
        const passport = data.passport || {};
        
        setFieldValue('modal-passport-seria', passport.seria_raqam);
        setFieldValue('modal-passport-by', passport.kim_tomonidan_berilgan);
        
        // Sanalarni formatlash
        if (passport.berilgan_sana) {
            setFieldValue('modal-passport-issue-date', new Date(passport.berilgan_sana).toLocaleDateString());
        } else {
            setFieldValue('modal-passport-issue-date', '-');
        }
        
        if (passport.amal_qilish_muddati) {
            setFieldValue('modal-passport-expiry', new Date(passport.amal_qilish_muddati).toLocaleDateString());
        } else {
            setFieldValue('modal-passport-expiry', '-');
        }
        
        setFieldValue('modal-permanent-address', passport.doimiy_yashash_joyi);
        setFieldValue('modal-current-address', passport.yashash_joyi);
        
        // Harbiy ma'lumotlar
        const military = data.military || {};
        setFieldValue('modal-military-category', military.category);
    }

    // Qo'shimcha ma'lumotlar
    function displayAdditionalInfo(data) {
        const additional = data.additional || {};
        
        setFieldValue('modal-height', additional.boy);
        setFieldValue('modal-weight', additional.vazn);
        setFieldValue('modal-suit-size', additional.kostyum_razmer);
        setFieldValue('modal-shoe-size', additional.poyabzal_razmer);
        setFieldValue('modal-telegram', additional.telegram_username);
        setFieldValue('modal-criminal-record', additional.sudlanganmi);
        setFieldValue('modal-tax-id', additional.soliq_id);
        setFieldValue('modal-inps', additional.inps);
        setFieldValue('modal-state-award', additional.davlat_mukofoti);
    }

    // Yordamchi funksiya
    function setFieldValue(fieldId, value) {
        const element = document.getElementById(fieldId);
        if (element) {
            element.textContent = value || '-';
        } else {
            console.warn(`Element with id ${fieldId} not found`);
        }
    }

    // Modal sarlavhasini yangilash
    function updateModalTitle(data) {
        const titleElement = document.getElementById('employeeModalLabel');
        if (titleElement) {
            const fullName = `${data.last_name || ''} ${data.first_name || ''} ${data.middle_name || ''}`.trim();
            titleElement.textContent = `${fullName} - Ma'lumotlari`;
        }
    }

    // Tahrirlash tugmasini sozlash
    function setupEditButton(employeeId) {
        const editBtn = document.getElementById('employeeEditBtn');
        if (editBtn) {
            editBtn.style.display = 'inline-block';
            editBtn.onclick = function() {
                const activeTab = document.querySelector('#employeeTabs .nav-link.active');
                const tabs = Array.from(document.querySelectorAll('#employeeTabs .nav-link'));
                let step = 1;
                if (activeTab) {
                    const idx = tabs.indexOf(activeTab);
                    step = (idx >= 0) ? (idx + 1) : 1;
                }
                window.location.href = `/employees/${employeeId}/edit?step=${step}`;
            };
        }
    }

    // Modal ochilganda event listener qo'shing
    const employeeModal = document.getElementById('employeeModal');
    if (employeeModal) {
        employeeModal.addEventListener('show.bs.modal', function(event) {
            console.log('Modal opening...');
            // Loading holatini ko'rsatish
            showLoadingState();
        });
    }
});
</script>