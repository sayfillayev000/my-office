@extends('layouts.app')

@section('content')
<div class="card adminuiux-card mb-3">
    <div class="card-body">

        <!-- Search form -->
        <form method="GET" action="{{ route('employees.index') }}" class="mb-3 d-flex">
            <input type="text" name="search" class="form-control me-2" 
                   placeholder="Xodimlarni qidirish..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Qidirish</button>
        </form>

        <!-- data table -->
        <div class="mb-3">
            <table id="dataTable" class="table w-100 nowrap table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Xodim</th>
                        <th>Contact info</th>
                        <th>Bo'lim</th>
                        <th>Tashkilot</th>
                        <th>Lavozim</th>
                        <th>Amallar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $employee)
                    <tr>
                        <td>{{ $employee->id }}</td>
                        <td>
                            <div class="row align-items-center flex-nowrap">
                                <div class="col-auto">
                                    <figure class="avatar avatar-40 mb-0 coverimg rounded-circle">
                                        <img src="{{ $employee->image && file_exists(public_path('storage/' . $employee->image)) 
                                            ? asset('storage/' . $employee->image) 
                                            : asset('assets/img/modern-ai-image/user-3.jpg') }}" 
                                            alt="{{ $employee->first_name }}">
                                    </figure>
                                </div>
                                <div class="col ps-0">
                                    <p class="mb-0 fw-medium">{{ $employee->first_name }} {{ $employee->last_name }}</p>
                                </div>
                            </div>
                        </td>
                        <td>{{ $employee->phone ?? '-' }}</td>
                        <td>{{ $employee->department ?? '-' }}</td>
                        <td>{{ $employee->organization->name ?? '-' }}</td>
                        <td>{{ $employee->position ?? '-' }}</td>
                        <td>
                            <button id="view-employee" class="btn btn-square btn-link view-employee" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#employeeModal"
                                    data-employee-id="{{ $employee->id }}"
                                    title="Ko'rish">
                                <i class="bi bi-eye"></i>
                            </button>
                            <button class="btn btn-square btn-link text-info add-reason-btn" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#addReasonModal"
                                    data-employee-id="{{ $employee->id }}"
                                    title="Sabab qo'shish">
                                <i class="bi bi-plus-circle"></i>
                            </button>
                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-square btn-link" title="Tahrirlash">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-square btn-link text-danger" onclick="return confirm('Haqiqatan ham o'chirmoqchimisiz?')" title="O'chirish">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Xodimlar topilmadi</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-3">
            {{ $employees->withQueryString()->links() }}
        </div>

    </div>
</div>

<!-- Employee Ma'lumotlari Modal -->
<div class="modal fade" id="employeeModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg">
            <!-- Modal Header -->
            <div class="modal-header bg-gradient-primary text-white rounded-top-3">
                <div class="d-flex align-items-center w-100">
                    <div class="flex-grow-1">
                        <h4 class="modal-title fw-bold mb-0" id="employeeModalLabel">
                            <i class="bi bi-person-badge me-2"></i>Xodim Ma'lumotlari
                        </h4>
                    </div>
                    <div class="d-flex align-items-center">
                        <button type="button" id="employeeEditBtn" class="btn btn-light btn-sm me-2" style="display:none;">
                            <i class="bi bi-pencil-square me-1"></i>
                        </button>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Tab Navigation -->
                <div class="card border-0">
                    <div class="card-body p-0">
                        <ul class="nav nav-pills nav-justified" id="employeeTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active d-flex align-items-center justify-content-center py-3" 
                                   id="tab-main-link" data-bs-toggle="tab" href="#tab-main" role="tab">
                                    <i class="bi bi-person me-2"></i>
                                    <span>Asosiy</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link d-flex align-items-center justify-content-center py-3" 
                                   id="tab-passport-link" data-bs-toggle="tab" href="#tab-passport" role="tab">
                                    <i class="bi bi-passport me-2"></i>
                                    <span>Pasport</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link d-flex align-items-center justify-content-center py-3" 
                                   id="tab-education-link" data-bs-toggle="tab" href="#tab-education" role="tab">
                                    <i class="bi bi-mortarboard me-2"></i>
                                    <span>Ta'lim</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link d-flex align-items-center justify-content-center py-3" 
                                   id="tab-work-link" data-bs-toggle="tab" href="#tab-work" role="tab">
                                    <i class="bi bi-briefcase me-2"></i>
                                    <span>Tajriba</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link d-flex align-items-center justify-content-center py-3" 
                                   id="tab-relatives-link" data-bs-toggle="tab" href="#tab-relatives" role="tab">
                                    <i class="bi bi-people me-2"></i>
                                    <span>Qarindoshlar</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link d-flex align-items-center justify-content-center py-3" 
                                   id="tab-additional-link" data-bs-toggle="tab" href="#tab-additional" role="tab">
                                    <i class="bi bi-info-circle me-2"></i>
                                    <span>Qo'shimcha</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Tab Content -->
                <div class="tab-content p-3" id="employeeTabContent">
                    <!-- Asosiy ma'lumotlar -->
                    <div class="tab-pane fade show active" id="tab-main" role="tabpanel">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0 text-primary">
                                    <i class="bi bi-person-gear me-2"></i>Asosiy Ma'lumotlar
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center mb-4">
                                    <div class="col-md-3 text-center">
                                        <div class="position-relative d-inline-block">
                                            <img id="modal-employee-image" src="" alt="Employee Image" 
                                                 class="img-fluid rounded-circle border border-4 border-primary shadow"
                                                 style="width: 160px; height: 160px; object-fit: cover;">
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold text-muted small mb-1">Familiya</label>
                                                    <p id="modal-last-name" class="fw-bold text-dark fs-6 mb-0">-</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold text-muted small mb-1">Ism</label>
                                                    <p id="modal-first-name" class="fw-bold text-dark fs-6 mb-0">-</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold text-muted small mb-1">Sharif</label>
                                                    <p id="modal-middle-name" class="fw-bold text-dark fs-6 mb-0">-</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 3 qatorli ma'lumotlar -->
                                <div class="row g-3">
                                    <!-- 1-qator -->
                                    <div class="col-md-4">
                                        <div class="info-item">
                                            <label class="form-label fw-semibold text-muted small mb-1">PINFL</label>
                                            <p id="modal-fnfl" class="info-value fw-bold text-dark">-</p>
                                        </div>
                                    </div> 
                                    <div class="col-md-4">
                                        <div class="info-item">
                                            <label class="form-label fw-semibold text-muted small mb-1">Tab Nº</label>
                                            <p id="modal-tabnumber" class="info-value fw-bold text-dark">-</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-item">
                                            <label class="form-label fw-semibold text-muted small mb-1">Jinsi</label>
                                            <p id="modal-gender" class="info-value fw-bold text-dark">-</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-item">
                                            <label class="form-label fw-semibold text-muted small mb-1">Tug'ilgan sana</label>
                                            <p id="modal-birth-date" class="info-value fw-bold text-dark">-</p>
                                        </div>
                                    </div>

                                    <!-- 2-qator -->
                                    <div class="col-md-4">
                                        <div class="info-item">
                                            <label class="form-label fw-semibold text-muted small mb-1">Telefon</label>
                                            <p id="modal-phone" class="info-value fw-bold text-dark">-</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-item">
                                            <label class="form-label fw-semibold text-muted small mb-1">Bo'lim</label>
                                            <p id="modal-department" class="info-value fw-bold text-dark">-</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-item">
                                            <label class="form-label fw-semibold text-muted small mb-1">Tashkilot</label>
                                            <p id="modal-organization" class="info-value fw-bold text-dark">-</p>
                                        </div>
                                    </div>

                                    <!-- 3-qator -->
                                    <div class="col-md-4">
                                        <div class="info-item">
                                            <label class="form-label fw-semibold text-muted small mb-1">Lavozim</label>
                                            <p id="modal-position" class="info-value fw-bold text-dark">-</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pasport ma'lumotlari -->
                    <div class="tab-pane fade" id="tab-passport" role="tabpanel">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0 text-primary">
                                    <i class="bi bi-passport me-2"></i>Pasport va Harbiy Ma'lumotlar
                                </h5>
                            </div>
                            <div class="card-body">
                                <!-- Pasport ma'lumotlari -->
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <h6 class="text-primary mb-3">Pasport Ma'lumotlari</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <label class="form-label fw-semibold text-muted small mb-1">Seriya raqam</label>
                                            <p id="modal-passport-seria" class="info-value fw-bold text-dark">-</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <label class="form-label fw-semibold text-muted small mb-1">Berilgan joyi</label>
                                            <p id="modal-passport-by" class="info-value fw-bold text-dark">-</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <label class="form-label fw-semibold text-muted small mb-1">Berilgan sana</label>
                                            <p id="modal-passport-issue-date" class="info-value fw-bold text-dark">-</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <label class="form-label fw-semibold text-muted small mb-1">Amal qilish muddati</label>
                                            <p id="modal-passport-expiry" class="info-value fw-bold text-dark">-</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <label class="form-label fw-semibold text-muted small mb-1">Doimiy manzil</label>
                                            <p id="modal-permanent-address" class="info-value fw-bold text-dark">-</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <label class="form-label fw-semibold text-muted small mb-1">Hozirgi manzil</label>
                                            <p id="modal-current-address" class="info-value fw-bold text-dark">-</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Harbiy ma'lumotlar -->
                                <div class="row">
                                    <div class="col-12">
                                        <h6 class="text-primary mb-3">Harbiy Hisob Ma'lumotlari</h6>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <label class="form-label fw-semibold text-muted small mb-1">Hisob guruhi</label>
                                            <p id="modal-military-group" class="info-value fw-bold text-dark">-</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <label class="form-label fw-semibold text-muted small mb-1">Hisob toifasi</label>
                                            <p id="modal-military-category" class="info-value fw-bold text-dark">-</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <label class="form-label fw-semibold text-muted small mb-1">Harbiy mutaxassislik</label>
                                            <p id="modal-military-speciality" class="info-value fw-bold text-dark">-</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <label class="form-label fw-semibold text-muted small mb-1">Qo'shin turi</label>
                                            <p id="modal-military-composition" class="info-value fw-bold text-dark">-</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <label class="form-label fw-semibold text-muted small mb-1">Xizmatga yaroqliligi</label>
                                            <p id="modal-military-suitable" class="info-value fw-bold text-dark">-</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <label class="form-label fw-semibold text-muted small mb-1">Harbiy unvoni</label>
                                            <p id="modal-military-rank" class="info-value fw-bold text-dark">-</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ta'lim ma'lumotlari -->
                    <div class="tab-pane fade" id="tab-education" role="tabpanel">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0 text-primary">
                                    <i class="bi bi-mortarboard me-2"></i>Ta'lim Ma'lumotlari
                                </h5>
                            </div>
                            <div class="card-body">
                                <div id="modal-education-list">
                                    <div class="text-center py-5">
                                        <div class="spinner-border text-primary mb-3" role="status">
                                            <span class="visually-hidden">Yuklanmoqda...</span>
                                        </div>
                                        <p class="text-muted">Ma'lumotlar yuklanmoqda...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ish tajribasi -->
                    <div class="tab-pane fade" id="tab-work" role="tabpanel">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0 text-primary">
                                    <i class="bi bi-briefcase me-2"></i>Ish Tajribasi
                                </h5>
                            </div>
                            <div class="card-body">
                                <div id="modal-work-experience">
                                    <div class="text-center py-5">
                                        <div class="spinner-border text-primary mb-3" role="status">
                                            <span class="visually-hidden">Yuklanmoqda...</span>
                                        </div>
                                        <p class="text-muted">Ma'lumotlar yuklanmoqda...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Qarindoshlar -->
                    <div class="tab-pane fade" id="tab-relatives" role="tabpanel">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0 text-primary">
                                    <i class="bi bi-people me-2"></i>Qarindoshlar
                                </h5>
                            </div>
                            <div class="card-body">
                                <div id="modal-relatives-list">
                                    <div class="text-center py-5">
                                        <div class="spinner-border text-primary mb-3" role="status">
                                            <span class="visually-hidden">Yuklanmoqda...</span>
                                        </div>
                                        <p class="text-muted">Ma'lumotlar yuklanmoqda...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Qo'shimcha ma'lumotlar -->
                    <div class="tab-pane fade" id="tab-additional" role="tabpanel">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0 text-primary">
                                    <i class="bi bi-info-circle me-2"></i>Qo'shimcha Ma'lumotlar
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Chap tomondagi ma'lumotlar -->
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <label class="form-label fw-semibold text-muted small mb-1">Bo'y</label>
                                            <p id="modal-height" class="info-value fw-bold text-dark">-</p>
                                        </div>
                                        <div class="info-item">
                                            <label class="form-label fw-semibold text-muted small mb-1">Vazn</label>
                                            <p id="modal-weight" class="info-value fw-bold text-dark">-</p>
                                        </div>
                                        <div class="info-item">
                                            <label class="form-label fw-semibold text-muted small mb-1">Kostyum razmeri</label>
                                            <p id="modal-suit-size" class="info-value fw-bold text-dark">-</p>
                                        </div>
                                        <div class="info-item">
                                            <label class="form-label fw-semibold text-muted small mb-1">Poyabzal razmeri</label>
                                            <p id="modal-shoe-size" class="info-value fw-bold text-dark">-</p>
                                        </div>
                                        <div class="info-item">
                                            <label class="form-label fw-semibold text-muted small mb-1">Telegram username</label>
                                            <p id="modal-telegram" class="info-value fw-bold text-dark">-</p>
                                        </div>
                                        <div class="info-item">
                                            <label class="form-label fw-semibold text-muted small mb-1">AKFA tanish</label>
                                            <p id="modal-akfa-contact" class="info-value fw-bold text-dark">-</p>
                                        </div>
                                        <div class="info-item" id="modal-akfa-details">
                                            <label class="form-label fw-semibold text-muted small mb-1">AKFA tanish ismi</label>
                                            <p id="modal-akfa-name" class="info-value fw-bold text-dark">-</p>
                                        </div>
                                        <div class="info-item" id="modal-akfa-position">
                                            <label class="form-label fw-semibold text-muted small mb-1">AKFA tanish lavozimi</label>
                                            <p id="modal-akfa-position-value" class="info-value fw-bold text-dark">-</p>
                                        </div>
                                    </div>

                                    <!-- O'ng tomondagi ma'lumotlar -->
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <label class="form-label fw-semibold text-muted small mb-1">Sudlanganmi</label>
                                            <p id="modal-criminal-record" class="info-value fw-bold text-dark">-</p>
                                        </div>
                                        <div class="info-item" id="modal-conviction-details">
                                            <label class="form-label fw-semibold text-muted small mb-1">Sudlanganlik sababi</label>
                                            <p id="modal-conviction-reason" class="info-value fw-bold text-dark">-</p>
                                        </div>
                                        <div class="info-item" id="modal-conviction-date">
                                            <label class="form-label fw-semibold text-muted small mb-1">Sudlanganlik sanasi</label>
                                            <p id="modal-conviction-date-value" class="info-value fw-bold text-dark">-</p>
                                        </div>
                                        <div class="info-item">
                                            <label class="form-label fw-semibold text-muted small mb-1">Davlat mukofoti</label>
                                            <p id="modal-state-award" class="info-value fw-bold text-dark">-</p>
                                        </div>
                                        <div class="info-item">
                                            <label class="form-label fw-semibold text-muted small mb-1">INPS</label>
                                            <p id="modal-inps" class="info-value fw-bold text-dark">-</p>
                                        </div>
                                        <div class="info-item">
                                            <label class="form-label fw-semibold text-muted small mb-1">Soliq ID</label>
                                            <p id="modal-tax-id" class="info-value fw-bold text-dark">-</p>
                                        </div>
                                        <div class="info-item">
                                            <label class="form-label fw-semibold text-muted small mb-1">Shaxsiy avtomobil</label>
                                            <p id="modal-personal-car" class="info-value fw-bold text-dark">-</p>
                                        </div>
                                        <div class="info-item">
                                            <label class="form-label fw-semibold text-muted small mb-1">Ofis</label>
                                            <p id="modal-office" class="info-value fw-bold text-dark">-</p>
                                        </div>
                                        <div class="info-item">
                                            <label class="form-label fw-semibold text-muted small mb-1">Parking</label>
                                            <p id="modal-parking" class="info-value fw-bold text-dark">-</p>
                                        </div>
                                    </div>

                                    <!-- Fayllar bo'limi -->
                                    <div class="col-12 mt-4">
                                        <h6 class="text-primary mb-3">
                                            <i class="bi bi-files me-2"></i>Yuklangan Fayllar
                                        </h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <!-- Sudlanganlik varaqasi -->
                                                <div class="file-item mb-3">
                                                    <label class="form-label fw-semibold text-muted small mb-1">
                                                        Sudlanganlik varaqasi
                                                    </label>
                                                    <div id="modal-conviction-file" class="mt-1">
                                                        <p class="text-muted">Fayl yuklanmagan</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <!-- Jinnimaslik malumotnomasi -->
                                                <div class="file-item mb-3">
                                                    <label class="form-label fw-semibold text-muted small mb-1">
                                                        Jinnimaslik malumotnomasi
                                                    </label>
                                                    <div id="modal-insanity-file" class="mt-1">
                                                        <p class="text-muted">Fayl yuklanmagan</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer bg-light rounded-bottom-3">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i>Yopish
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Add Reason Modal -->
<div class="modal fade" id="addReasonModal" tabindex="-1" aria-labelledby="addReasonModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addReasonModalLabel">Sabab qo'shish</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addReasonForm">
                    <input type="hidden" name="employee_id" id="reason-employee-id">
                    
                    <!-- Sabab turi -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Sabab turi</label>
                        <div class="d-flex gap-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="reason_type" id="reason_type_daily" value="daily" checked onchange="toggleReasonType()">
                                <label class="form-check-label" for="reason_type_daily">Kunlik</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="reason_type" id="reason_type_hourly" value="hourly" onchange="toggleReasonType()">
                                <label class="form-check-label" for="reason_type_hourly">Soatlik</label>
                            </div>
                        </div>
                    </div>

                    <!-- Kunlik uchun maydonlar -->
                    <div id="daily-fields">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Boshlanish sanasi <span class="text-danger">*</span></label>
                                <input type="date" name="start_date" id="start_date" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tugash sanasi <span class="text-danger">*</span></label>
                                <input type="date" name="end_date" id="end_date" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <!-- Soatlik uchun maydonlar -->
                    <div id="hourly-fields" style="display: none;">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Boshlanish sanasi va vaqti <span class="text-danger">*</span></label>
                                <input type="datetime-local" name="start_datetime" id="start_datetime" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tugash sanasi va vaqti <span class="text-danger">*</span></label>
                                <input type="datetime-local" name="end_datetime" id="end_datetime" class="form-control">
                            </div>
                        </div>
                    </div>

                    <!-- Sabab -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Sabab <span class="text-danger">*</span></label>
                        <select name="reason_id" id="reason_id" class="form-select" required>
                            <option value="">Sababni tanlang...</option>
                            <!-- Sabablar AJAX orqali yuklanadi -->
                        </select>
                    </div>

                    <!-- Kommentariya -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kommentariya</label>
                        <textarea name="comment" id="reason_comment" class="form-control" rows="3" placeholder="Qo'shimcha izoh..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bekor qilish</button>
                <button type="button" class="btn btn-primary" onclick="saveReason()">Saqlash</button>
            </div>
        </div>
    </div>
</div>

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
<script>
document.addEventListener('DOMContentLoaded', function() {
    // View employee modal
   document.body.addEventListener('click', function(e) {
        if (e.target.closest('.view-employee')) {
            const button = e.target.closest('.view-employee');
            e.preventDefault();
            e.stopPropagation();
            
            console.log('Tugma bosildi!');
            const employeeId = button.getAttribute('data-employee-id');
            console.log('Employee ID:', employeeId);
            loadEmployeeData(employeeId);
        }
    });

    // Fayllarni yuklash funksiyasi
    function loadFiles(files) {
        console.log('Loading files:', files);
        
        const fileContainer = {
            conviction: document.getElementById('modal-conviction-file'),
            insanity: document.getElementById('modal-insanity-file')
        };

        Object.entries(fileContainer).forEach(([key, element]) => {
            if (!element) return;
            
            element.innerHTML = '';
            const fileUrl = files?.[key] || files?.[`${key}_file`];

            if (fileUrl) {
                const extension = fileUrl.split('.').pop().toLowerCase();
                let previewHtml = '';

                if (['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(extension)) {
                    previewHtml = `
                        <div class="text-center">
                            <img src="${fileUrl}" alt="${key}" class="img-fluid rounded mb-2" style="max-height: 250px;">
                            <div class="mt-2">
                                <a href="${fileUrl}" download class="btn btn-sm btn-primary">
                                    <i class="bi bi-download me-1"></i> Yuklab olish
                                </a>
                            </div>
                        </div>
                    `;
                } else if (extension === 'pdf') {
                    previewHtml = `
                        <div class="text-center">
                            <iframe src="${fileUrl}" class="w-100 rounded" style="height: 300px;" frameborder="0"></iframe>
                            <div class="mt-2">
                                <a href="${fileUrl}" download class="btn btn-sm btn-primary">
                                    <i class="bi bi-download me-1"></i> Yuklab olish
                                </a>
                            </div>
                        </div>
                    `;
                } else {
                    previewHtml = `
                        <div class="text-center">
                            <i class="bi bi-file-earmark-text fs-2 text-secondary"></i>
                            <p class="mb-2">${fileUrl.split('/').pop()}</p>
                            <a href="${fileUrl}" download class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-download me-1"></i> Yuklab olish
                            </a>
                        </div>
                    `;
                }
                element.innerHTML = previewHtml;
            } else {
                element.innerHTML = '<div class="alert alert-secondary py-2 mb-0 text-center">Fayl mavjud emas</div>';
            }
        });
    }

    function loadFilesFromAdditional(additional) {
        const fileMappings = {
            conviction_document_path: 'modal-conviction-file',
            insanity_certificate_path: 'modal-insanity-file'
        };

        Object.entries(fileMappings).forEach(([key, elementId]) => {
            const element = document.getElementById(elementId);
            if (!element) return;

            const fileUrl = additional[key];
            element.innerHTML = '';

            if (fileUrl) {
                const extension = fileUrl.split('.').pop().toLowerCase();
                let previewHtml = '';

                if (['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(extension)) {
                    previewHtml = `
                        <div class="text-center">
                            <img src="${fileUrl}" alt="${key}" class="img-fluid rounded mb-2" style="max-height: 250px;">
                            <div class="mt-2">
                                <a href="${fileUrl}" download class="btn btn-sm btn-primary">
                                    <i class="bi bi-download me-1"></i> Yuklab olish
                                </a>
                            </div>
                        </div>
                    `;
                } else if (extension === 'pdf') {
                    previewHtml = `
                        <div class="text-center">
                            <iframe src="${fileUrl}" class="w-100 rounded" style="height: 300px;" frameborder="0"></iframe>
                            <div class="mt-2">
                                <a href="${fileUrl}" download class="btn btn-sm btn-primary">
                                    <i class="bi bi-download me-1"></i> Yuklab olish
                                </a>
                            </div>
                        </div>
                    `;
                } else {
                    previewHtml = `
                        <div class="text-center">
                            <i class="bi bi-file-earmark-text fs-2 text-secondary"></i>
                            <p class="mb-2">${fileUrl.split('/').pop()}</p>
                            <a href="${fileUrl}" download class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-download me-1"></i> Yuklab olish
                            </a>
                        </div>
                    `;
                }

                element.innerHTML = previewHtml;
            } else {
                element.innerHTML = '<div class="alert alert-secondary py-2 mb-0 text-center">Fayl mavjud emas</div>';
            }
        });
    }

    // Ta'lim ma'lumotlarini yuklash
    function loadEducationData(educations) {
        const educationList = document.getElementById('modal-education-list');
        
        if (!educations || educations.length === 0) {
            educationList.innerHTML = `
                <div class="text-center py-4">
                    <i class="bi bi-mortarboard text-muted fs-1"></i>
                    <p class="text-muted mt-2">Ta'lim ma'lumotlari mavjud emas</p>
                </div>
            `;
            return;
        }

        let html = '<div class="row g-3">';
        educations.forEach((edu, index) => {
            html += `
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-2 text-center">
                                    <div class="avatar avatar-60 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto">
                                        ${edu.type ? edu.type.charAt(0).toUpperCase() : 'T'}
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold text-muted small mb-1">Ta'lim turi</label>
                                            <p class="fw-bold text-dark mb-2">${edu.type || '-'}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold text-muted small mb-1">O'quv muassasasi</label>
                                            <p class="fw-bold text-dark mb-2">${edu.university || '-'}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold text-muted small mb-1">Fakultet</label>
                                            <p class="fw-bold text-dark mb-2">${edu.faculty || '-'}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold text-muted small mb-1">Mutaxassislik</label>
                                            <p class="fw-bold text-dark mb-2">${edu.speciality || '-'}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold text-muted small mb-1">Boshlanish sanasi</label>
                                            <p class="fw-bold text-dark mb-2">${edu.start_date ? new Date(edu.start_date).toLocaleDateString() : '-'}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold text-muted small mb-1">Tugash sanasi</label>
                                            <p class="fw-bold text-dark mb-2">${edu.end_date ? new Date(edu.end_date).toLocaleDateString() : (edu.course ? edu.course + '-kurs' : '-')}</p>
                                        </div>
                                        ${edu.diploma_number ? `
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold text-muted small mb-1">Diplom raqami</label>
                                            <p class="fw-bold text-dark mb-2">${edu.diploma_number}</p>
                                        </div>
                                        ` : ''}
                                    </div>
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
            workList.innerHTML = `
                <div class="text-center py-4">
                    <i class="bi bi-briefcase text-muted fs-1"></i>
                    <p class="text-muted mt-2">Ish tajribasi mavjud emas</p>
                </div>
            `;
            return;
        }

        let html = '<div class="row g-3">';
        workExperiences.forEach((work, index) => {
            html += `
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-2 text-center">
                                    <div class="avatar avatar-60 bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto">
                                        ${work.organization ? work.organization.charAt(0).toUpperCase() : 'I'}
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold text-muted small mb-1">Tashkilot</label>
                                            <p class="fw-bold text-dark mb-2">${work.organization || '-'}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold text-muted small mb-1">Lavozim</label>
                                            <p class="fw-bold text-dark mb-2">${work.position || '-'}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold text-muted small mb-1">Holati</label>
                                            <p class="fw-bold mb-2">
                                                ${work.current_job === 'Ha' || work.current_job === true ? 
                                                    '<span class="badge bg-success">Hozirgi ish</span>' : 
                                                    '<span class="badge bg-secondary">Oldingi ish</span>'}
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold text-muted small mb-1">Boshlanish sanasi</label>
                                            <p class="fw-bold text-dark mb-2">${work.start_date ? new Date(work.start_date).toLocaleDateString() : '-'}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold text-muted small mb-1">Tugash sanasi</label>
                                            <p class="fw-bold text-dark mb-2">${work.end_date ? new Date(work.end_date).toLocaleDateString() : 'Hozirgacha'}</p>
                                        </div>
                                        ${work.contract_number ? `
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold text-muted small mb-1">Shartnoma raqami</label>
                                            <p class="fw-bold text-dark mb-2">${work.contract_number}</p>
                                        </div>
                                        ` : ''}
                                        ${work.contract_date ? `
                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold text-muted small mb-1">Shartnoma sanasi</label>
                                            <p class="fw-bold text-dark mb-2">${new Date(work.contract_date).toLocaleDateString()}</p>
                                        </div>
                                        ` : ''}
                                    </div>
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
            relativesList.innerHTML = `
                <div class="text-center py-4">
                    <i class="bi bi-people text-muted fs-1"></i>
                    <p class="text-muted mt-2">Qarindoshlar ma'lumotlari mavjud emas</p>
                </div>
            `;
            return;
        }

        let html = '<div class="row g-3">';
        relatives.forEach((relative, index) => {
            const tugilganJoy = [
                relative.tugilgan_joy_viloyat,
                relative.tugilgan_joy_tuman, 
                relative.tugilgan_joy_qishloq
            ].filter(Boolean).join(', ') || '-';
            
            let ishJoyi = '';
            if (relative.nafaqada === 'Ha') {
                ishJoyi = `<span class="badge bg-warning">Nafaqada</span>`;
                if (relative.old_ishi_joyi || relative.old_lavozimi) {
                    ishJoyi += `<br><small class="text-muted">Oldingi ish: ${relative.old_ishi_joyi || '-'} ${relative.old_lavozimi ? '/ ' + relative.old_lavozimi : ''}</small>`;
                }
            } else if (relative.oqishda === 'Ha') {
                ishJoyi = `<span class="badge bg-info">${relative.oquv_yurti || 'O\'qiydi'}</span>`;
            } else {
                ishJoyi = `${relative.ishi_joyi || '-'}`;
                if (relative.lavozimi) {
                    ishJoyi += `<br><span class="badge bg-light text-dark">${relative.lavozimi}</span>`;
                }
            }

            html += `
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-2 text-center">
                                    <div class="avatar avatar-60 bg-info text-white rounded-circle d-flex align-items-center justify-content-center mx-auto">
                                        ${relative.familiyasi ? relative.familiyasi.charAt(0).toUpperCase() : 'Q'}${relative.ismi ? relative.ismi.charAt(0).toUpperCase() : ''}
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold text-muted small mb-1">Qarindoshlik</label>
                                            <p class="fw-bold text-dark mb-2">
                                                <span class="badge bg-primary">${relative.qarindoshlik || '-'}</span>
                                            </p>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold text-muted small mb-1">Familiya</label>
                                            <p class="fw-bold text-dark mb-2">${relative.familiyasi || '-'}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold text-muted small mb-1">Ism</label>
                                            <p class="fw-bold text-dark mb-2">${relative.ismi || '-'}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold text-muted small mb-1">Otasi ismi</label>
                                            <p class="fw-bold text-dark mb-2">${relative.otasi_ismi || '-'}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold text-muted small mb-1">Tug'ilgan yili</label>
                                            <p class="fw-bold text-dark mb-2">${relative.tugilgan_yili || '-'}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold text-muted small mb-1">Tug'ilgan joyi</label>
                                            <p class="fw-bold text-dark mb-2">${tugilganJoy}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label fw-semibold text-muted small mb-1">Holati</label>
                                            <div class="fw-bold text-dark mb-2">${ishJoyi}</div>
                                        </div>
                                    </div>
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

    // Qo'shimcha ma'lumotlarni yuklash
    function loadAdditionalData(additional) {
        console.log('Additional data:', additional);
        
        // Jismoniy ma'lumotlar
        document.getElementById('modal-height').textContent = additional.boy || '-';
        document.getElementById('modal-weight').textContent = additional.vazn || '-';
        document.getElementById('modal-suit-size').textContent = additional.kostyum_razmer || '-';
        document.getElementById('modal-shoe-size').textContent = additional.poyabzal_razmer || '-';
        document.getElementById('modal-telegram').textContent = additional.telegram_username || '-';
        
        // Sudlanganlik ma'lumotlari
        document.getElementById('modal-criminal-record').textContent = additional.sudlanganmi ? 'Ha' : 'Yo\'q';
        
        // Yangi qo'shimcha maydonlar
        if (document.getElementById('modal-akfa-contact')) {
            document.getElementById('modal-akfa-contact').textContent = additional.akfa_tanish ? 'Ha' : 'Yo\'q';
        }
        
        if (document.getElementById('modal-akfa-name')) {
            document.getElementById('modal-akfa-name').textContent = additional.akfa_tanish_ism || '-';
        }

        if (document.getElementById('modal-akfa-position-value')) {
            document.getElementById('modal-akfa-position-value').textContent = additional.akfa_tanish_lavozim || '-';
        }
        
        // Davlat mukofoti
        if (document.getElementById('modal-state-award')) {
            document.getElementById('modal-state-award').textContent = additional.davlat_mukofoti || '-';
        }
        
        // INPS
        if (document.getElementById('modal-inps')) {
            document.getElementById('modal-inps').textContent = additional.inps || '-';
        }
        
        // Soliq ID
        if (document.getElementById('modal-tax-id')) {
            document.getElementById('modal-tax-id').textContent = additional.soliq_id || '-';
        }
        
        // Shaxsiy avtomobil
        if (document.getElementById('modal-personal-car')) {
            document.getElementById('modal-personal-car').textContent = additional.shaxsiy_avtomobil === 'bor' ? 'Bor' : 'Yo\'q';
        }
        
        // Sudlanganlik tafsilotlari
        if (document.getElementById('modal-conviction-reason')) {
            document.getElementById('modal-conviction-reason').textContent = additional.sudlanganlik_sabab || '-';
        }

        if (document.getElementById('modal-conviction-date-value')) {
            document.getElementById('modal-conviction-date-value').textContent = additional.sudlanganlik_sana ? new Date(additional.sudlanganlik_sana).toLocaleDateString() : '-';
        }
        
        // Ofis va Parking
        if (document.getElementById('modal-office')) {
            document.getElementById('modal-office').textContent = additional.office === 'Ha' ? 'Ha' : 'Yo\'q';
        }
        
        if (document.getElementById('modal-parking')) {
            document.getElementById('modal-parking').textContent = additional.parking === 'Ha' ? 'Ha' : 'Yo\'q';
        }
    }

    function loadEmployeeData(employeeId) {
        console.log('Loading employee data for ID:', employeeId);
        
        // Yuklanish indikatorini ko'rsatish
        document.getElementById('modal-education-list').innerHTML = `
            <div class="text-center py-5">
                <div class="spinner-border text-primary mb-3" role="status">
                    <span class="visually-hidden">Yuklanmoqda...</span>
                </div>
                <p class="text-muted">Ma'lumotlar yuklanmoqda...</p>
            </div>
        `;
        
        document.getElementById('modal-work-experience').innerHTML = `
            <div class="text-center py-5">
                <div class="spinner-border text-primary mb-3" role="status">
                    <span class="visually-hidden">Yuklanmoqda...</span>
                </div>
                <p class="text-muted">Ma'lumotlar yuklanmoqda...</p>
            </div>
        `;
        
        document.getElementById('modal-relatives-list').innerHTML = `
            <div class="text-center py-5">
                <div class="spinner-border text-primary mb-3" role="status">
                    <span class="visually-hidden">Yuklanmoqda...</span>
                </div>
                <p class="text-muted">Ma'lumotlar yuklanmoqda...</p>
            </div>
        `;

        fetch(`/employees/${employeeId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.status);
                }
                return response.json();
            })
            .then(data => {
                console.log('Received full data:', data);
                
                // Asosiy ma'lumotlar
                document.getElementById('modal-employee-image').src = data.image || "{{ asset('assets/img/modern-ai-image/user-3.jpg') }}";
                document.getElementById('modal-last-name').textContent = data.last_name || '-';
                document.getElementById('modal-first-name').textContent = data.first_name || '-';
                document.getElementById('modal-middle-name').textContent = data.middle_name || '-';
                document.getElementById('modal-fnfl').textContent = data.fnfl || '-';
                document.getElementById('modal-gender').textContent = data.gender === 'male' ? 'Erkak' : data.gender === 'female' ? 'Ayol' : '-';
                document.getElementById('modal-tabnumber').textContent = data.tab_number || '-' ;
                document.getElementById('modal-birth-date').textContent = data.birth_date ? new Date(data.birth_date).toLocaleDateString() : '-';
                document.getElementById('modal-phone').textContent = data.phone || '-';
                document.getElementById('modal-department').textContent = data.department || '-';
                document.getElementById('modal-organization').textContent = data.organization || '-';
                document.getElementById('modal-position').textContent = data.position || '-';

                // Pasport ma'lumotlari
                const passport = data.passport || {};
                document.getElementById('modal-passport-seria').textContent = passport.seria_raqam || '-';
                document.getElementById('modal-passport-by').textContent = passport.kim_tomonidan_berilgan || '-';
                document.getElementById('modal-passport-issue-date').textContent = passport.berilgan_sana ? new Date(passport.berilgan_sana).toLocaleDateString() : '-';
                document.getElementById('modal-passport-expiry').textContent = passport.amal_qilish_muddati ? new Date(passport.amal_qilish_muddati).toLocaleDateString() : '-';
                document.getElementById('modal-permanent-address').textContent = passport.doimiy_yashash_joyi || '-';
                document.getElementById('modal-current-address').textContent = passport.yashash_joyi || '-';

                // Harbiy ma'lumotlar
                const military = data.military || {};
                document.getElementById('modal-military-group').textContent = military.accounting_group || '-';
                document.getElementById('modal-military-category').textContent = military.category || '-';
                document.getElementById('modal-military-speciality').textContent = military.military_speciality || '-';
                document.getElementById('modal-military-composition').textContent = military.composition || '-';
                document.getElementById('modal-military-suitable').textContent = military.suitable || '-';
                document.getElementById('modal-military-rank').textContent = military.rank || '-';

                // Qo'shimcha ma'lumotlarni yuklash
                loadAdditionalData(data.additional || {});
                loadFilesFromAdditional(data.additional || {});

                // Fayllarni yuklash
                if (data.files) {
                    loadFiles(data.files);
                }

                // Dinamik ma'lumotlarni yuklash
                loadEducationData(data.educations);
                loadWorkExperience(data.work_experiences);
                loadRelativesData(data.relatives);

                // Modal sarlavhasini yangilash
                document.getElementById('employeeModalLabel').textContent = 
                    `${data.last_name} ${data.first_name} ${data.middle_name} - Ma'lumotlari`;

                // Edit tugmasini ko'rsatish
                const editBtn = document.getElementById('employeeEditBtn');
                if (editBtn) {
                    editBtn.style.display = 'inline-block';
                    editBtn.onclick = function() {
                        window.location.href = `/employees/${employeeId}/edit`;
                    };
                }
            })
            .catch(error => {
                console.error('Error loading employee data:', error);
                alert('Ma\'lumotlarni yuklashda xatolik yuz berdi: ' + error.message);
                
                // Xatolik holatida default ma'lumotlarni ko'rsatish
                document.getElementById('modal-education-list').innerHTML = `
                    <div class="text-center py-4">
                        <i class="bi bi-exclamation-triangle text-warning fs-1"></i>
                        <p class="text-muted mt-2">Ma'lumotlarni yuklashda xatolik yuz berdi</p>
                    </div>
                `;
                document.getElementById('modal-work-experience').innerHTML = `
                    <div class="text-center py-4">
                        <i class="bi bi-exclamation-triangle text-warning fs-1"></i>
                        <p class="text-muted mt-2">Ma'lumotlarni yuklashda xatolik yuz berdi</p>
                    </div>
                `;
                document.getElementById('modal-relatives-list').innerHTML = `
                    <div class="text-center py-4">
                        <i class="bi bi-exclamation-triangle text-warning fs-1"></i>
                        <p class="text-muted mt-2">Ma'lumotlarni yuklashda xatolik yuz berdi</p>
                    </div>
                `;
            });
    }

    // Modal yopilganda tahrirlash tugmasini yashirish
    document.getElementById('employeeModal').addEventListener('hidden.bs.modal', function () {
        const editBtn = document.getElementById('employeeEditBtn');
        if (editBtn) {
            editBtn.style.display = 'none';
        }
    });

    // Add reason button click handler
    document.body.addEventListener('click', function(e) {
        if (e.target.closest('.add-reason-btn')) {
            const button = e.target.closest('.add-reason-btn');
            const employeeId = button.getAttribute('data-employee-id');
            document.getElementById('reason-employee-id').value = employeeId;
            
            // Load reasons
            loadReasons();
        }
    });
});

// Toggle between daily and hourly fields
function toggleReasonType() {
    const dailyFields = document.getElementById('daily-fields');
    const hourlyFields = document.getElementById('hourly-fields');
    const isDaily = document.getElementById('reason_type_daily').checked;
    
    if (isDaily) {
        dailyFields.style.display = 'block';
        hourlyFields.style.display = 'none';
        document.getElementById('start_datetime').value = '';
        document.getElementById('end_datetime').value = '';
    } else {
        dailyFields.style.display = 'none';
        hourlyFields.style.display = 'block';
        document.getElementById('start_date').value = '';
        document.getElementById('end_date').value = '';
    }
}

// Load reasons from server
function loadReasons() {
    fetch('/employee-reasons')
        .then(response => response.json())
        .then(data => {
            const select = document.getElementById('reason_id');
            select.innerHTML = '<option value="">Sababni tanlang...</option>';
            
            data.forEach(reason => {
                const option = document.createElement('option');
                option.value = reason.id;
                option.textContent = reason.name;
                select.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error loading reasons:', error);
        });
}

// Save reason
function saveReason() {
    const form = document.getElementById('addReasonForm');
    const formData = new FormData(form);
    const employeeId = formData.get('employee_id');
    
    // Prepare data
    const data = {
        employee_id: employeeId,
        reason_id: formData.get('reason_id'),
        type: formData.get('reason_type'),
        comment: formData.get('comment')
    };
    
    // Add dates based on type
    if (data.type === 'daily') {
        data.start_date = formData.get('start_date');
        data.end_date = formData.get('end_date');
    } else {
        data.start_datetime = formData.get('start_datetime');
        data.end_datetime = formData.get('end_datetime');
    }
    
    // Validate
    if (!data.reason_id) {
        alert('Iltimos, sababni tanlang!');
        return;
    }
    
    if (data.type === 'daily' && (!data.start_date || !data.end_date)) {
        alert('Iltimos, sanalarni to\'ldiring!');
        return;
    }
    
    if (data.type === 'hourly' && (!data.start_datetime || !data.end_datetime)) {
        alert('Iltimos, vaqtlarni to\'ldiring!');
        return;
    }
    
    // Send request
    fetch('/employee-reason-items', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Sabab muvaffaqiyatli qo\'shildi!');
            bootstrap.Modal.getInstance(document.getElementById('addReasonModal')).hide();
            form.reset();
        } else {
            alert('Xatolik: ' + (data.message || 'Noma\'lum xatolik'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Xatolik yuz berdi!');
    });
}
</script>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
}

.info-item {
    border-bottom: 1px solid #f8f9fa;
    padding-bottom: 1rem;
    margin-bottom: 1rem;
}

.info-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.info-value {
    margin-bottom: 0;
    word-break: break-word;
}

.nav-pills .nav-link {
    color: #6c757d;
    border-radius: 0;
    transition: all 0.3s ease;
    border: none;
}

.nav-pills .nav-link.active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    box-shadow: none;
}

.nav-pills .nav-link:hover:not(.active) {
    background-color: #f8f9fa;
    color: #495057;
}

.card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.rounded-top-3 {
    border-top-left-radius: 0.75rem !important;
    border-top-right-radius: 0.75rem !important;
}

.rounded-bottom-3 {
    border-bottom-left-radius: 0.75rem !important;
    border-bottom-right-radius: 0.75rem !important;
}

.spinner-border {
    width: 3rem;
    height: 3rem;
}

.file-item .btn {
    margin-top: 0.5rem;
}

@media (max-width: 768px) {
    .modal-dialog {
        margin: 0.5rem;
    }
    
    .nav-pills .nav-link span {
        display: none;
    }
    
    .nav-pills .nav-link {
        padding: 0.75rem 0.5rem;
    }
    
    .nav-pills .nav-link i {
        margin-right: 0 !important;
        font-size: 1.2rem;
    }
}
</style>

@endsection