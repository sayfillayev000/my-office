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
                                                    <th data-breakpoints="xs sm">Patient</th>
                                                    <th data-breakpoints="xs sm md">Contact info</th>
                                                    <th data-breakpoints="xs sm">Tags</th>
                                                    <th class="all">Recent Schedule</th>
                                                    <th data-breakpoints="xs sm">Status</th>
                                                    <th class="all">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>2054ID</td>
                                                    <td>
                                                        <div class="row align-items-center flex-nowrap">
                                                            <div class="col-auto">
                                                                <figure class="avatar avatar-40 mb-0 coverimg rounded-circle">
                                                                    <img src="assets/img/modern-ai-image/user-7.jpg" alt="">
                                                                </figure>
                                                            </div>
                                                            <div class="col ps-0">
                                                                <p class="mb-0 fw-medium">David Warner</p>
                                                                <p class="text-secondary small">32 years, United Kingdom</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0">david@sales..core.com</p>
                                                        <p class="text-secondary small">+44 8466585****1154</p>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-light rounded-pill text-bg-success">Fresh Case</span>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0">9:10 AM - 9 June 2024</p>
                                                        <p class="text-secondary small">Allergies -Dr. Ryan Sylia</p>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-light rounded-pill text-bg-warning">Pending</span>
                                                    </td>
                                                    <td>
                                                        <a href="investment-view-patient.html" class="btn btn-square btn-link" data-bs-toggle="tooltip" title="View">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <div class="dropdown d-inline-block">
                                                            <a class="btn btn-link no-caret" data-bs-toggle="dropdown">
                                                                <i class="bi bi-three-dots"></i>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li><a class="dropdown-item" href="javascript:void(0)">Edit</a></li>
                                                                <li><a class="dropdown-item" href="javascript:void(0)">Move</a></li>
                                                                <li><a class="dropdown-item theme-red" href="javascript:void(0)">Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>105ID</td>
                                                    <td>
                                                        <div class="row align-items-center flex-nowrap">
                                                            <div class="col-auto">
                                                                <figure class="avatar avatar-40 mb-0 coverimg rounded-circle">
                                                                    <img src="assets/img/modern-ai-image/user-8.jpg" alt="">
                                                                </figure>
                                                            </div>
                                                            <div class="col ps-0">
                                                                <p class="mb-0 fw-medium">Winnie John</p>
                                                                <p class="text-secondary small">18 years, Australia</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0">winnie@sales..core.com</p>
                                                        <p class="text-secondary small">+44 8466585****1154</p>
                                                    </td>
                                                    <td><span class="badge badge-light rounded-pill text-bg-success">Fresh Case</span></td>
                                                    <td>
                                                        <p class="mb-0">10:30 AM - 9 June 2024</p>
                                                        <p class="text-secondary small">Colds and flu - Dr. Ryan Sylia</p>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-light rounded-pill text-bg-primary">Waiting</span>
                                                    </td>
                                                    <td><a href="investment-view-patient.html" class="btn btn-square btn-link" data-bs-toggle="tooltip" title="View">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <div class="dropdown d-inline-block">
                                                            <a class="btn btn-link no-caret" data-bs-toggle="dropdown">
                                                                <i class="bi bi-three-dots"></i>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li><a class="dropdown-item" href="javascript:void(0)">Edit</a></li>
                                                                <li><a class="dropdown-item" href="javascript:void(0)">Move</a></li>
                                                                <li><a class="dropdown-item theme-red" href="javascript:void(0)">Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>058ID</td>
                                                    <td>
                                                        <div class="row align-items-center flex-nowrap">
                                                            <div class="col-auto">
                                                                <figure class="avatar avatar-40 mb-0 coverimg rounded-circle">
                                                                    <img src="assets/img/modern-ai-image/user-1.jpg" alt="">
                                                                </figure>
                                                            </div>
                                                            <div class="col ps-0">
                                                                <p class="mb-0 fw-medium">Alicia Smith</p>
                                                                <p class="text-secondary small">30 years, United States</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0">alicia@sales..core.com</p>
                                                        <p class="text-secondary small">+44 8466585****1154</p>
                                                    </td>
                                                    <td><span class="badge badge-light rounded-pill text-bg-theme-accent-1">Revisit</span>
                                                        <span class="badge badge-light rounded-pill text-bg-theme-accent-1">VIP</span>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0">11:30 AM - 9 June 2024</p>
                                                        <p class="text-secondary small">Diarrhea - Dr. Ryan Sylia</p>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-light rounded-pill text-bg-success">Complete</span>
                                                    </td>
                                                    <td><a href="investment-view-patient.html" class="btn btn-square btn-link" data-bs-toggle="tooltip" title="View">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <div class="dropdown d-inline-block">
                                                            <a class="btn btn-link no-caret" data-bs-toggle="dropdown">
                                                                <i class="bi bi-three-dots"></i>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li><a class="dropdown-item" href="javascript:void(0)">Edit</a></li>
                                                                <li><a class="dropdown-item" href="javascript:void(0)">Move</a></li>
                                                                <li><a class="dropdown-item theme-red" href="javascript:void(0)">Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>500ID</td>
                                                    <td>
                                                        <div class="row align-items-center flex-nowrap">
                                                            <div class="col-auto">
                                                                <figure class="avatar avatar-40 mb-0 coverimg rounded-circle">
                                                                    <img src="assets/img/modern-ai-image/user-2.jpg" alt="">
                                                                </figure>
                                                            </div>
                                                            <div class="col ps-0">
                                                                <p class="mb-0 fw-medium">Jr. Chen Li</p>
                                                                <p class="text-secondary small">9 years, United Kingdom</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0">cheli@sales..core.com</p>
                                                        <p class="text-secondary small">+44 8466585****1154</p>
                                                    </td>
                                                    <td><span class="badge badge-light rounded-pill text-bg-theme-accent-1">Revisit</span>
                                                        <span class="badge badge-light rounded-pill text-bg-primary">Regular</span>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0">11:55 AM - 9 June 2024</p>
                                                        <p class="text-secondary small">Conjunctivitis - Dr. Ryan Sylia</p>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-light rounded-pill text-bg-danger">Rejected</span>
                                                    </td>
                                                    <td><a href="investment-view-patient.html" class="btn btn-square btn-link" data-bs-toggle="tooltip" title="View">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <div class="dropdown d-inline-block">
                                                            <a class="btn btn-link no-caret" data-bs-toggle="dropdown">
                                                                <i class="bi bi-three-dots"></i>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li><a class="dropdown-item" href="javascript:void(0)">Edit</a></li>
                                                                <li><a class="dropdown-item" href="javascript:void(0)">Move</a></li>
                                                                <li><a class="dropdown-item theme-red" href="javascript:void(0)">Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2054ID</td>
                                                    <td>
                                                        <div class="row align-items-center flex-nowrap">
                                                            <div class="col-auto">
                                                                <figure class="avatar avatar-40 mb-0 coverimg rounded-circle">
                                                                    <img src="assets/img/modern-ai-image/user-3.jpg" alt="">
                                                                </figure>
                                                            </div>
                                                            <div class="col ps-0">
                                                                <p class="mb-0 fw-medium">David Warner</p>
                                                                <p class="text-secondary small">10 years, United Kingdom</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0">david@sales..core.com</p>
                                                        <p class="text-secondary small">+44 8466585****1154</p>
                                                    </td>
                                                    <td><span class="badge badge-light rounded-pill text-bg-theme-accent-1">Revisit</span>
                                                        <span class="badge badge-light rounded-pill text-bg-theme-accent-1">VIP</span>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0">12:15 PM - 9 June 2024</p>
                                                        <p class="text-secondary small">Headaches - Dr. Ryan Sylia</p>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-light rounded-pill text-bg-warning">Pending</span>
                                                    </td>
                                                    <td><a href="investment-view-patient.html" class="btn btn-square btn-link" data-bs-toggle="tooltip" title="View">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <div class="dropdown d-inline-block">
                                                            <a class="btn btn-link no-caret" data-bs-toggle="dropdown">
                                                                <i class="bi bi-three-dots"></i>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li><a class="dropdown-item" href="javascript:void(0)">Edit</a></li>
                                                                <li><a class="dropdown-item" href="javascript:void(0)">Move</a></li>
                                                                <li><a class="dropdown-item theme-red" href="javascript:void(0)">Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>105ID</td>
                                                    <td>
                                                        <div class="row align-items-center flex-nowrap">
                                                            <div class="col-auto">
                                                                <figure class="avatar avatar-40 mb-0 coverimg rounded-circle">
                                                                    <img src="assets/img/modern-ai-image/user-4.jpg" alt="">
                                                                </figure>
                                                            </div>
                                                            <div class="col ps-0">
                                                                <p class="mb-0 fw-medium">Winnie John</p>
                                                                <p class="text-secondary small">15 years, Australia</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0">winnie@sales..core.com</p>
                                                        <p class="text-secondary small">+44 8466585****1154</p>
                                                    </td>
                                                    <td><span class="badge badge-light rounded-pill text-bg-success">Fresh Case</span></td>
                                                    <td>
                                                        <p class="mb-0">1:30 PM - 9 June 2024</p>
                                                        <p class="text-secondary small">Mononucleosis - Dr. Ryan Sylia</p>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-light rounded-pill text-bg-theme-accent-1">Waiting</span>
                                                    </td>
                                                    <td><a href="investment-view-patient.html" class="btn btn-square btn-link" data-bs-toggle="tooltip" title="View">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <div class="dropdown d-inline-block">
                                                            <a class="btn btn-link no-caret" data-bs-toggle="dropdown">
                                                                <i class="bi bi-three-dots"></i>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li><a class="dropdown-item" href="javascript:void(0)">Edit</a></li>
                                                                <li><a class="dropdown-item" href="javascript:void(0)">Move</a></li>
                                                                <li><a class="dropdown-item theme-red" href="javascript:void(0)">Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>058ID</td>
                                                    <td>
                                                        <div class="row align-items-center flex-nowrap">
                                                            <div class="col-auto">
                                                                <figure class="avatar avatar-40 mb-0 coverimg rounded-circle">
                                                                    <img src="assets/img/modern-ai-image/user-5.jpg" alt="">
                                                                </figure>
                                                            </div>
                                                            <div class="col ps-0">
                                                                <p class="mb-0 fw-medium">Alicia Smith</p>
                                                                <p class="text-secondary small">21 years, United States</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0">alicia@sales..core.com</p>
                                                        <p class="text-secondary small">+44 8466585****1154</p>
                                                    </td>
                                                    <td><span class="badge badge-light rounded-pill text-bg-success">Fresh Case</span></td>
                                                    <td>
                                                        <p class="mb-0">2:20 AM - 9 June 2024</p>
                                                        <p class="text-secondary small">Stomach aches - Dr. Ryan Sylia</p>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-light rounded-pill text-bg-info">In-Progress</span>
                                                    </td>
                                                    <td><a href="investment-view-patient.html" class="btn btn-square btn-link" data-bs-toggle="tooltip" title="View">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <div class="dropdown d-inline-block">
                                                            <a class="btn btn-link no-caret" data-bs-toggle="dropdown">
                                                                <i class="bi bi-three-dots"></i>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li><a class="dropdown-item" href="javascript:void(0)">Edit</a></li>
                                                                <li><a class="dropdown-item" href="javascript:void(0)">Move</a></li>
                                                                <li><a class="dropdown-item theme-red" href="javascript:void(0)">Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>501ID</td>
                                                    <td>
                                                        <div class="row align-items-center flex-nowrap">
                                                            <div class="col-auto">
                                                                <figure class="avatar avatar-40 mb-0 coverimg rounded-circle">
                                                                    <img src="assets/img/modern-ai-image/user-6.jpg" alt="">
                                                                </figure>
                                                            </div>
                                                            <div class="col ps-0">
                                                                <p class="mb-0 fw-medium">Jr. Chen Li</p>
                                                                <p class="text-secondary small">45 years, United Kingdom</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0">cheli@sales..core.com</p>
                                                        <p class="text-secondary small">+44 8466585****1154</p>
                                                    </td>
                                                    <td><span class="badge badge-light rounded-pill text-bg-theme-accent-1">Revisit</span>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0">3:30 PM - 9 June 2024</p>
                                                        <p class="text-secondary small">Allergies - Dr. Ryan Sylia</p>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-light rounded-pill text-bg-theme-accent-1">Cancelled</span>
                                                    </td>
                                                    <td><a href="investment-view-patient.html" class="btn btn-square btn-link" data-bs-toggle="tooltip" title="View">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <div class="dropdown d-inline-block">
                                                            <a class="btn btn-link no-caret" data-bs-toggle="dropdown">
                                                                <i class="bi bi-three-dots"></i>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li><a class="dropdown-item" href="javascript:void(0)">Edit</a></li>
                                                                <li><a class="dropdown-item" href="javascript:void(0)">Move</a></li>
                                                                <li>
                                                                    <a class="dropdown-item theme-red" href="javascript:void(0)">Delete</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3052ID</td>
                                                    <td>
                                                        <div class="row align-items-center flex-nowrap">
                                                            <div class="col-auto">
                                                                <figure class="avatar avatar-40 mb-0 coverimg rounded-circle">
                                                                    <img src="assets/img/modern-ai-image/user-7.jpg" alt="">
                                                                </figure>
                                                            </div>
                                                            <div class="col ps-0">
                                                                <p class="mb-0 fw-medium">David Warner</p>
                                                                <p class="text-secondary small">55 years, United Kingdom</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0">david@sales..core.com</p>
                                                        <p class="text-secondary small">+44 8466585****1154</p>
                                                    </td>
                                                    <td><span class="badge badge-light rounded-pill text-bg-theme-accent-1">Revisit</span>
                                                        <span class="badge badge-light rounded-pill text-bg-primary">Regular</span>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0">9:10 AM - 9 June 2024</p>
                                                        <p class="text-secondary small">Colds and flu - Dr. Ryan Sylia</p>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-light rounded-pill text-bg-warning">Pending</span>
                                                    </td>
                                                    <td><a href="investment-view-patient.html" class="btn btn-square btn-link" data-bs-toggle="tooltip" title="View">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <div class="dropdown d-inline-block">
                                                            <a class="btn btn-link no-caret" data-bs-toggle="dropdown">
                                                                <i class="bi bi-three-dots"></i>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li><a class="dropdown-item" href="javascript:void(0)">Edit</a></li>
                                                                <li><a class="dropdown-item" href="javascript:void(0)">Move</a></li>
                                                                <li><a class="dropdown-item theme-red" href="javascript:void(0)">Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3052ID</td>
                                                    <td>
                                                        <div class="row align-items-center flex-nowrap">
                                                            <div class="col-auto">
                                                                <figure class="avatar avatar-40 mb-0 coverimg rounded-circle">
                                                                    <img src="assets/img/modern-ai-image/user-7.jpg" alt="">
                                                                </figure>
                                                            </div>
                                                            <div class="col ps-0">
                                                                <p class="mb-0 fw-medium">David Warner</p>
                                                                <p class="text-secondary small">55 years, United Kingdom</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0">david@sales..core.com</p>
                                                        <p class="text-secondary small">+44 8466585****1154</p>
                                                    </td>
                                                    <td><span class="badge badge-light rounded-pill text-bg-theme-accent-1">Revisit</span>
                                                        <span class="badge badge-light rounded-pill text-bg-primary">Regular</span>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0">9:10 AM - 9 June 2024</p>
                                                        <p class="text-secondary small">Colds and flu - Dr. Ryan Sylia</p>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-light rounded-pill text-bg-warning">Pending</span>
                                                    </td>
                                                    <td><a href="investment-view-patient.html" class="btn btn-square btn-link" data-bs-toggle="tooltip" title="View">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <div class="dropdown d-inline-block">
                                                            <a class="btn btn-link no-caret" data-bs-toggle="dropdown">
                                                                <i class="bi bi-three-dots"></i>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li><a class="dropdown-item" href="javascript:void(0)">Edit</a></li>
                                                                <li><a class="dropdown-item" href="javascript:void(0)">Move</a></li>
                                                                <li><a class="dropdown-item theme-red" href="javascript:void(0)">Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3105ID</td>
                                                    <td>
                                                        <div class="row align-items-center flex-nowrap">
                                                            <div class="col-auto">
                                                                <figure class="avatar avatar-40 mb-0 coverimg rounded-circle">
                                                                    <img src="assets/img/modern-ai-image/user-8.jpg" alt="">
                                                                </figure>
                                                            </div>
                                                            <div class="col ps-0">
                                                                <p class="mb-0 fw-medium">Winnie John</p>
                                                                <p class="text-secondary small">11 years, Australia</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0">winnie@sales..core.com</p>
                                                        <p class="text-secondary small">+44 8466585****1154</p>
                                                    </td>
                                                    <td><span class="badge badge-light rounded-pill text-bg-theme-accent-1">Revisit</span>
                                                        <span class="badge badge-light rounded-pill text-bg-primary">Regular</span>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0">10:30 AM - 9 June 2024</p>
                                                        <p class="text-secondary small">Conjunctivitis - Dr. Ryan Sylia</p>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-light rounded-pill text-bg-primary">Waiting</span>
                                                    </td>
                                                    <td><a href="investment-view-patient.html" class="btn btn-square btn-link" data-bs-toggle="tooltip" title="View">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <div class="dropdown d-inline-block">
                                                            <a class="btn btn-link no-caret" data-bs-toggle="dropdown">
                                                                <i class="bi bi-three-dots"></i>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li><a class="dropdown-item" href="javascript:void(0)">Edit</a></li>
                                                                <li><a class="dropdown-item" href="javascript:void(0)">Move</a></li>
                                                                <li><a class="dropdown-item theme-red" href="javascript:void(0)">Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                               
                            </div>
                                    @endsection