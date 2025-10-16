<div class="container">
    <h3>Arizalar</h3>

    @foreach($applications as $application)
        <div class="card mb-3">
            <div class="card-body">
                <p><strong>Xodim:</strong> 
                    {{ $application->user->first_name }} 
                    {{ $application->user->last_name }}
                </p>

               @php
    $steps = [
        'yangi' => 'ariza qabul qilish',
        'qabul qilingan' => 'ariza tasdiqlash',
        'tasdiqlangan' => 'ariza yakuniy qabul',
        'yakuniy' => null,
    ];

    $currentPermission = $steps[$application->status] ?? null;

    // Shu bosqich uchun user bormi?
    $hasUser = $currentPermission 
        ? \Spatie\Permission\Models\Role::whereHas('permissions', function($q) use ($currentPermission) {
            $q->where('name', $currentPermission);
        })->whereHas('users')->exists()
        : false;
@endphp

@if($currentPermission && (auth()->user()->can($currentPermission) || ! $hasUser && auth()->user()->hasRole('manager')))
    <form action="{{ route('applications.update', $application) }}" method="POST">
        @csrf
        <button class="btn btn-primary">
            {{ ucfirst($application->status) }} bosqichni yakunlash
        </button>
    </form>
@endif

            </div>
        </div>
    @endforeach
</div>
