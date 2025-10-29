@extends('layouts.app')

@section('content')
<div class="card adminuiux-card mb-3">
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <div class="card border-0 mb-4">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0 text-primary">
                            <i class="bi bi-list-ul me-2"></i>Sabablar ro'yxati
                        </h5>
                    </div>
                    <div class="card-body">
                        <div id="reasonsList" class="list-group">
                            <div class="text-center py-5">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Yuklanmoqda...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 mb-4">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0 text-primary">
                            <i class="bi bi-plus-circle me-2"></i>Yangi sabab
                        </h5>
                    </div>
                    <div class="card-body">
                        <form id="reasonForm">
                            <input type="hidden" name="reason_id" id="reason_id">

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Sabab nomi *</label>
                                <input type="text" name="name" id="reason_name" class="form-control" required placeholder="Masalan: Kasallik">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Rang</label>
                                <input type="color" name="color" id="reason_color" class="form-control form-control-color" value="#667eea">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Tavsif</label>
                                <textarea name="description" id="reason_description" class="form-control" rows="3" placeholder="Sabab haqida qisqa ma'lumot..."></textarea>
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="is_active" id="reason_is_active" checked>
                                <label class="form-check-label" for="reason_is_active">
                                    Faol
                                </label>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle me-1"></i> Saqlash
                                </button>
                                <button type="button" class="btn btn-secondary" onclick="resetReasonForm()">
                                    <i class="bi bi-arrow-clockwise me-1"></i> Tozalash
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    loadReasons();

    document.getElementById('reasonForm').addEventListener('submit', function(e) {
        e.preventDefault();
        saveReason();
    });
});

function loadReasons() {
    const container = document.getElementById('reasonsList');
    container.innerHTML = '<div class="text-center py-5"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Yuklanmoqda...</span></div></div>';
    fetch('/employee-reasons')
        .then(r => r.json())
        .then(data => {
            if (!data.length) {
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
                    </div>`;
            });
            container.innerHTML = html;
        })
        .catch(() => {
            container.innerHTML = '<div class="text-center py-4 text-danger">Xatolik yuz berdi</div>';
        });
}

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
        method,
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify(data)
    })
    .then(r => r.json())
    .then(res => {
        if (res.success) {
            resetReasonForm();
            loadReasons();
        } else {
            alert('Xatolik: ' + (res.message || 'Noma\'lum xatolik'));
        }
    })
    .catch(() => alert('Xatolik yuz berdi!'));
}

function editReason(id) {
    fetch(`/employee-reasons/${id}`)
        .then(r => r.json())
        .then(reason => {
            document.getElementById('reason_id').value = reason.id;
            document.getElementById('reason_name').value = reason.name;
            document.getElementById('reason_color').value = reason.color || '#667eea';
            document.getElementById('reason_description').value = reason.description || '';
            document.getElementById('reason_is_active').checked = !!reason.is_active;
        })
        .catch(() => alert('Xatolik yuz berdi!'));
}

function deleteReason(id) {
    if (!confirm('Haqiqatan ham o\'chirmoqchimisiz?')) return;
    fetch(`/employee-reasons/${id}`, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
    })
    .then(r => r.json())
    .then(res => {
        if (res.success) {
            loadReasons();
        } else {
            alert('Xatolik: ' + (res.message || 'Noma\'lum xatolik'));
        }
    })
    .catch(() => alert('Xatolik yuz berdi!'));
}

function resetReasonForm() {
    document.getElementById('reasonForm').reset();
    document.getElementById('reason_id').value = '';
    document.getElementById('reason_color').value = '#667eea';
    document.getElementById('reason_is_active').checked = true;
}
</script>
@endsection


