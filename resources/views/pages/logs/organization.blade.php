@extends('layouts.app')

@section('content')
<div class="card adminuiux-card mb-3">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title mb-0 text-primary">
                <i class="bi bi-flag me-2"></i>{{ $organization->name }} — {{ $period === 'daily' ? 'Kunlik' : 'Oylik' }} statistika
            </h5>
            <a href="{{ route('logs.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i>Orqaga</a>
        </div>

        <form method="GET" class="row g-3 align-items-end mb-3">
            <input type="hidden" name="period" value="{{ $period }}">
            <input type="hidden" name="kitchen" value="{{ $kitchen ? 1 : 0 }}">
            <div class="col-auto">
                <label class="form-label fw-semibold">Sana</label>
                <input type="date" name="date" value="{{ $date }}" class="form-control">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary"><i class="bi bi-funnel me-1"></i> Filter</button>
            </div>
            <div class="col text-center">
                <div class="btn-group" role="group" aria-label="Tabs">
                    <a href="{{ route('logs.organization', ['organizationId' => $organization->id, 'period' => $period, 'date' => $date, 'kitchen' => 0]) }}" class="btn {{ !$kitchen ? 'btn-primary' : 'btn-outline-primary' }}">Kirish/Chiqish</a>
                    <a href="{{ route('logs.organization', ['organizationId' => $organization->id, 'period' => $period, 'date' => $date, 'kitchen' => 1]) }}" class="btn {{ $kitchen ? 'btn-success' : 'btn-outline-success' }}">Oshxona</a>
                </div>
            </div>
            <div class="col-auto">
                <div class="btn-group" role="group">
                    <a href="{{ route('logs.organization', ['organizationId' => $organization->id, 'period' => 'daily', 'date' => $date, 'kitchen' => $kitchen ? 1 : 0]) }}" class="btn {{ $period==='daily' ? 'btn-dark' : 'btn-outline-dark' }}">Kunlik</a>
                    <a href="{{ route('logs.organization', ['organizationId' => $organization->id, 'period' => 'monthly', 'date' => $date, 'kitchen' => $kitchen ? 1 : 0]) }}" class="btn {{ $period==='monthly' ? 'btn-dark' : 'btn-outline-dark' }}">Oylik</a>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table w-100 nowrap table-striped" id="logsTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Employee ID</th>
                        <th>Xodim</th>
                        <th>Obyekt/Loyiha</th>
                        <th>Kirish</th>
                        <th>Chiqish</th>
                        <th>Turniket IP</th>
                        <th>Kirish rasmi</th>
                        <th>Chiqish rasmi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($rows as $i => $r)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $r['employee_id'] ?? '-' }}</td>
                        <td>{{ $r['employee_name'] ?? '-' }}</td>
                        <td>{{ $r['project_name'] ?? '-' }}</td>
                        <td>{{ !empty($r['first_in']) ? \Carbon\Carbon::parse($r['first_in'])->format('d.m.Y H:i') : '-' }}</td>
                        <td>{{ !empty($r['last_out']) ? \Carbon\Carbon::parse($r['last_out'])->format('d.m.Y H:i') : '-' }}</td>
                        <td><code>{{ $r['turniket_ip'] ?? '-' }}</code></td>
                        <td>@if(!empty($r['entry_photo'])) <a href="{{ $r['entry_photo'] }}" target="_blank"><img src="{{ $r['entry_photo'] }}" class="img-thumbnail" style="max-height:60px;"></a>@else<span class="text-muted">-</span>@endif</td>
                        <td>@if(!empty($r['exit_photo'])) <a href="{{ $r['exit_photo'] }}" target="_blank"><img src="{{ $r['exit_photo'] }}" class="img-thumbnail" style="max-height:60px;"></a>@else<span class="text-muted">-</span>@endif</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted">Ma'lumotlar topilmadi</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    if (window.$ && $('#logsTable').length) {
        $('#logsTable').DataTable({
            responsive: true,
            searching: true,
            paging: true,
            info: true,
            lengthChange: false,
            autoWidth: false,
            order: [[4, 'asc']],
            // Prevent "unknown parameter" warnings if any cell is missing
            columnDefs: [
                { targets: '_all', defaultContent: '-' }
            ]
        });
    }
});
</script>
@endsection


