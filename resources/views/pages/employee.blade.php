@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Xodimlar ro‘yxati</h4>
        <a href="{{ route('employees.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Yangi qo‘shish
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Xodim</th>
                <th>Lavozim</th>
                <th>Bo‘lim qo‘shimcha</th>
                <th>Tashkilot</th>
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
                                    <img src="{{ $employee->image ? asset('storage/'.$employee->image) : asset('assets/img/default-user.png') }}" 
                                         alt="Employee photo" width="40" height="40" class="rounded-circle">
                                </figure>
                            </div>
                            <div class="col ps-0">
                                <p class="mb-0 fw-medium">{{ $employee->full_name }}</p>
                                <p class="text-secondary small">{{ $employee->email ?? '-' }}</p>
                            </div>
                        </div>
                    </td>
                    <td>{{ $employee->position ?? '-' }}</td>
                    <td>{{ $employee->extra_department ?? '-' }}</td>
                    <td>{{ $employee->organization->name ?? '-' }}</td>
                    <td>
                        <a href="{{ route('employees.show', $employee->id) }}" 
                           class="btn btn-sm btn-outline-info" 
                           data-bs-toggle="tooltip" title="Ko‘rish">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('employees.edit', $employee->id) }}" 
                           class="btn btn-sm btn-outline-primary" 
                           data-bs-toggle="tooltip" title="Tahrirlash">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <form action="{{ route('employees.destroy', $employee->id) }}" 
                              method="POST" 
                              class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="btn btn-sm btn-outline-danger" 
                                    data-bs-toggle="tooltip" 
                                    title="O‘chirish"
                                    onclick="return confirm('Haqiqatan ham o‘chirmoqchimisiz?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Hozircha xodimlar mavjud emas</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
