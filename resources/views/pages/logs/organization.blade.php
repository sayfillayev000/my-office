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
            <div class="col-md-2">
                <label class="form-label fw-semibold">Yil</label>
                <select name="year" class="form-select">
                    @for($y = now()->year; $y >= now()->year - 5; $y--)
                        <option value="{{ $y }}" {{ ($year ?? now()->year) == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label fw-semibold">Oy</label>
                <select name="month" class="form-select">
                    <option value="">Barchasi</option>
                    @for($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}" {{ (int)($month ?? 0) === $m ? 'selected' : '' }}>{{ sprintf('%02d', $m) }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label fw-semibold">Kun</label>
                <select name="day" class="form-select">
                    <option value="">Barchasi</option>
                    @for($d = 1; $d <= 31; $d++)
                        <option value="{{ $d }}" {{ (int)($day ?? 0) === $d ? 'selected' : '' }}>{{ sprintf('%02d', $d) }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">To'liq ism</label>
                <input type="text" name="name" value="{{ $name }}" class="form-control" placeholder="Ism familya...">
            </div>
            <div class="col-md-2">
                <label class="form-label fw-semibold">Bo'lim</label>
                <select name="department" class="form-select">
                    <option value="">Barchasi</option>
                    @foreach(($departments ?? []) as $dep)
                        <option value="{{ $dep }}" {{ ($department ?? '') === $dep ? 'selected' : '' }}>{{ $dep }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-funnel me-1"></i></button>
            </div>
            <div class="col-12 text-center">
                <div class="btn-group" role="group" aria-label="Tabs">
                    <a href="{{ route('logs.organization', ['organizationId' => $organization->id, 'period' => $period, 'kitchen' => 0, 'year' => $year, 'month' => $month, 'day' => $day, 'name' => $name, 'department' => $department]) }}" class="btn {{ !$kitchen ? 'btn-primary' : 'btn-outline-primary' }}">Kirish/Chiqish</a>
                    <a href="{{ route('logs.organization', ['organizationId' => $organization->id, 'period' => $period, 'kitchen' => 1, 'year' => $year, 'month' => $month, 'day' => $day, 'name' => $name, 'department' => $department]) }}" class="btn {{ $kitchen ? 'btn-success' : 'btn-outline-success' }}">Oshxona</a>
                </div>
            </div>
            <div class="col-auto">
                <div class="btn-group" role="group">
                    <a href="{{ route('logs.organization', ['organizationId' => $organization->id, 'period' => 'daily', 'kitchen' => $kitchen ? 1 : 0, 'year' => $year, 'month' => $month, 'day' => $day, 'name' => $name, 'department' => $department]) }}" class="btn {{ $period==='daily' ? 'btn-dark' : 'btn-outline-dark' }}">Kunlik</a>
                    <a href="{{ route('logs.organization', ['organizationId' => $organization->id, 'period' => 'monthly', 'kitchen' => $kitchen ? 1 : 0, 'year' => $year, 'month' => $month, 'day' => $day, 'name' => $name, 'department' => $department]) }}" class="btn {{ $period==='monthly' ? 'btn-dark' : 'btn-outline-dark' }}">Oylik</a>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table w-100 nowrap table-striped" id="logsTable">
                <thead>
                    <tr>
                        <th>To'liq ism</th>
                        <th>Bo'lim</th>
                        <th>Tashkilot</th>
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
                        <td>{{ $r['employee_name'] ?? '-' }}</td>
                        <td>{{ $r['department'] ?? '-' }}</td>
                        <td>{{ $r['organization'] ?? '-' }}</td>
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


