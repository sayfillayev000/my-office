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
        <table id="dataTable" class="table w-100 nowrap table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Xodim</th>
                    <th>Contact info</th>
                    <th>Bo‘lim</th>
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
        <a href="javascript:void(0)" class="btn btn-square btn-link view-employee" data-id="{{ $employee->id }}">
            <i class="bi bi-eye"></i>
        </a>
        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-square btn-link">
            <i class="bi bi-pencil-square"></i>
        </a>
        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-square btn-link text-danger" onclick="return confirm('Haqiqatan ham o‘chirmoqchimisiz?')">
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

        <!-- Pagination -->
        <div class="mt-3">
            {{ $employees->withQueryString()->links() }}
        </div>

    </div>
</div>
<!-- Employee Info Modal -->
<div class="modal fade" id="employeeModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow-lg border-0">
            
            <!-- Header -->
            <div class="modal-header bg-light d-flex justify-content-between align-items-center">
                <h5 class="modal-title fw-bold" id="employeeModalLabel">Xodim ma’lumotlari</h5>
                <div class="d-flex align-items-center">
                    <a href="#" id="emp-edit" class="btn btn-sm btn-outline-primary me-2" title="Tahrirlash">
                        <i class="bi bi-pencil"></i>
                    </a> <a href="#" id="emp-edit" class="btn btn-sm btn-outline-success me-2" title="Tahrirlash">
                        <i class="bi bi-calendar"></i>
                    </a>
                    <button id="emp-delete" class="btn btn-sm btn-outline-danger me-2" title="O‘chirish">
                        <i class="bi bi-trash"></i>
                    </button>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Yopish"></button>
                </div>
            </div>

            <!-- Body -->
            <div class="modal-body">
                <div class="row align-items-center">
                    <!-- Avatar qismi -->
                    <div class="col-md-4 text-center border-end">
                        <figure class="avatar avatar-120 mb-3 coverimg rounded-circle mx-auto shadow-sm">
                            <img id="emp-image" src="{{ asset('assets/img/modern-ai-image/user-3.jpg') }}" alt="Employee" class="rounded-circle img-fluid">
                        </figure>
                        <h5 id="emp-name" class="fw-bold mb-1">-</h5>
                        <p id="emp-position" class="text-muted small mb-1">Lavozim: -</p>
                        <p id="emp-department" class="text-muted small mb-0">Bo‘lim: -</p>
                    </div>

                    <!-- Tafsilotlar qismi -->
                    <div class="col-md-8 ps-md-4 mt-3 mt-md-0">
                        <ul class="list-group list-group-flush text-start">
                            <li class="list-group-item d-flex justify-content-between">
                                <span class="fw-semibold">Tashkilot:</span>
                                <span id="emp-org">-</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span class="fw-semibold">Telefon:</span>
                                <span id="emp-phone">-</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span class="fw-semibold">PINFL:</span>
                                <span id="emp-pinfl">-</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span class="fw-semibold">Berilgan sana:</span>
                                <span id="emp-birth">-</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span class="fw-semibold">Amal qilish muddati:</span>
                                <span id="emp-start">-</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span class="fw-semibold">Gender:</span>
                                <span id="emp-gender">-</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Yopish</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = new bootstrap.Modal(document.getElementById('employeeModal'));

    document.querySelectorAll('.view-employee').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.getAttribute('data-id');

            fetch(`/employees/${id}`)
                .then(response => response.json())
                .then(data => {
                    console.log('Employee data:', data);

                    // 🧍‍♂️ Asosiy ma’lumotlar
                    document.getElementById('emp-image').src = data.image || "{{ asset('assets/img/modern-ai-image/user-3.jpg') }}";
                    document.getElementById('emp-name').textContent = data.full_name || '-';
                    document.getElementById('emp-position').textContent = `Lavozim: ${data.position || '-'}`;
                    document.getElementById('emp-department').textContent = `Bo‘lim: ${data.department || '-'}`;
                    document.getElementById('emp-org').textContent = data.organization || '-';
                    document.getElementById('emp-phone').textContent = data.phone || '-';

                    // 🪪 Pasport ma’lumotlari
                    const passport = data.passport || {};
                    document.getElementById('emp-pinfl').textContent = passport.seria_raqam || '-';
                    document.getElementById('emp-birth').textContent = passport.berilgan_sana || '-';
                    document.getElementById('emp-start').textContent = passport.amal_qilish_muddati || '-';

                    // 👤 Qo‘shimcha ma’lumotlar
                    const add = data.additional || {};
                    document.getElementById('emp-gender').textContent = add.sudlanganmi || '-';

                    // ✏️ Tahrirlash / O‘chirish tugmalari
                    const editBtn = document.getElementById('emp-edit');
                    const deleteBtn = document.getElementById('emp-delete');
                    if (editBtn) editBtn.href = `/employees/${id}/edit`;
                    if (deleteBtn) deleteBtn.setAttribute('data-id', id);

                    // 🪄 Modalni ko‘rsatish
                    modal.show();
                })
                .catch(error => {
                    console.error('Xatolik:', error);
                    alert("Ma’lumotlarni yuklashda xatolik yuz berdi.");
                });
        });
    });

    // ❌ Modal ichidagi o‘chirish tugmasi ishlashi uchun
    document.getElementById('emp-delete')?.addEventListener('click', function () {
        const id = this.getAttribute('data-id');
        if (!id) return;

        if (confirm('Haqiqatan ham ushbu xodimni o‘chirmoqchimisiz?')) {
            fetch(`/employees/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
            })
                .then(res => res.ok ? location.reload() : alert('O‘chirishda xatolik'))
                .catch(err => console.error('O‘chirish xatosi:', err));
        }
    });
});

</script>

@endsection
