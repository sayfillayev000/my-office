@extends('layouts.app')

@section('content')
<div class="card adminuiux-card mb-3">
    <div class="card-body">
        <h5 class="card-title mb-3 text-primary">
            <i class="bi bi-list-ul me-2"></i>Jadvallar
        </h5>

        <div class="table-responsive">
            <table class="table w-100 nowrap table-striped" id="orgTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tashkilot</th>
                        <th>Kundalik</th>
                        <th>Oylik</th>
                        <th>Oshxona (Kundalik)</th>
                        <th>Oshxona (Oylik)</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($organizations as $org)
                    <tr>
                        <td>{{ $org->id }}</td>
                        <td>{{ $org->name }}</td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="{{ route('logs.organization', ['organizationId'=>$org->id, 'period'=>'daily', 'date'=>now()->toDateString(), 'kitchen'=>0]) }}">
                                Kunlik
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('logs.organization', ['organizationId'=>$org->id, 'period'=>'monthly', 'date'=>now()->toDateString(), 'kitchen'=>0]) }}">
                                 Oylik
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-success" href="{{ route('logs.organization', ['organizationId'=>$org->id, 'period'=>'daily', 'date'=>now()->toDateString(), 'kitchen'=>1]) }}">
                                 Kunlik
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-outline-success" href="{{ route('logs.organization', ['organizationId'=>$org->id, 'period'=>'monthly', 'date'=>now()->toDateString(), 'kitchen'=>1]) }}">
                                Oylik
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Logs Modal -->
<div class="modal fade" id="logsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title"><i class="bi bi-clock-history me-2"></i>Loglar</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="logsContainer">
                    <div class="text-center py-5">
                        <div class="spinner-border text-primary mb-3" role="status">
                            <span class="visually-hidden">Yuklanmoqda...</span>
                        </div>
                        <p class="text-muted">Ma'lumotlar yuklanmoqda...</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Yopish</button>
            </div>
        </div>
    </div>
    
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    if (window.$ && $('#orgTable').length) {
        $('#orgTable').DataTable({
            responsive: true,
            searching: true,
            paging: true,
            info: true,
            lengthChange: false
        });
    }
});

function loadLogs(orgId, period = 'daily', kitchen = false) {
    const modal = new bootstrap.Modal(document.getElementById('logsModal'));
    const container = document.getElementById('logsContainer');
    container.innerHTML = `
        <div class="text-center py-5">
            <div class="spinner-border text-primary mb-3" role="status">
                <span class="visually-hidden">Yuklanmoqda...</span>
            </div>
            <p class="text-muted">Ma'lumotlar yuklanmoqda...</p>
        </div>
    `;
    modal.show();

    const url = `/logs/${orgId}?period=${encodeURIComponent(period)}&kitchen=${kitchen ? 1 : 0}`;
    fetch(url)
        .then(r => r.json())
        .then(res => {
            if (!res.success) throw new Error('Xatolik');
            const items = res.data || [];
            if (!items.length) {
                container.innerHTML = `
                    <div class="text-center py-4">
                        <i class="bi bi-info-circle text-muted fs-1"></i>
                        <p class="text-muted mt-2">Ma'lumotlar topilmadi</p>
                    </div>`;
                return;
            }

            let html = '<div class="table-responsive">\n<table class="table table-hover align-middle">';
            html += '<thead class="table-light"><tr>' +
                '<th>ID</th>' +
                '<th>Xodim</th>' +
                '<th>Loyiha</th>' +
                '<th>Kirish</th>' +
                '<th>Chiqish</th>' +
                '<th>Turniket IP</th>' +
                '<th>Kirish rasmi</th>' +
                '<th>Chiqish rasmi</th>' +
                '</tr></thead><tbody>';

            items.forEach(it => {
                html += `<tr>
                    <td>${it.employee_id ?? '-'}</td>
                    <td>${it.employee_name ?? '-'}</td>
                    <td>${it.project_name ?? '-'}</td>
                    <td>${it.first_in ? new Date(it.first_in).toLocaleString('uz-UZ') : '-'}</td>
                    <td>${it.last_out ? new Date(it.last_out).toLocaleString('uz-UZ') : '-'}</td>
                    <td><code>${it.turniket_ip ?? '-'}</code></td>
                    <td>${renderPhoto(it.entry_photo)}</td>
                    <td>${renderPhoto(it.exit_photo)}</td>
                </tr>`;
            });

            html += '</tbody></table></div>';
            container.innerHTML = html;
        })
        .catch(() => {
            container.innerHTML = `
                <div class="text-center py-4">
                    <i class="bi bi-exclamation-triangle text-warning fs-1"></i>
                    <p class="text-muted mt-2">Ma'lumotlarni yuklashda xatolik yuz berdi</p>
                </div>`;
        });
}

function renderPhoto(url) {
    if (!url) return '<span class="text-muted">-</span>';
    const safeUrl = url;
    return `
        <a href="${safeUrl}" target="_blank" class="d-inline-block">
            <img src="${safeUrl}" alt="photo" class="img-thumbnail" style="max-height: 60px;">
        </a>`;
}
</script>
@endsection


