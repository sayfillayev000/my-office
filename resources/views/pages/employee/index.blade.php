@extends('layouts.app')

@section('content')
<div class="card adminuiux-card mb-3">
    <div class="card-body">

        <!-- data table -->
        <div class="mb-3">
            <table id="dataTable" class="table w-100 nowrap table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th data-breakpoints="xs sm">Xodim</th>
                        <th data-breakpoints="xs sm md">Contact info</th>
                        <th data-breakpoints="xs sm">Bo‘lim</th>
                        <th class="all">Tashkilot</th>
                        <th data-breakpoints="xs sm">Lavozim</th>
                        <th class="all">Amallar</th>
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
                                            @if($employee->image && file_exists(public_path('assets/img/' . $employee->image)))
                                                <img src="{{ asset('assets/img/' . $employee->image) }}" alt="{{ $employee->first_name }}">
                                            @else
                                                <img src="{{ asset('assets/img/modern-ai-image/user-3.jpg') }}" alt="Default photo">
                                            @endif
                                        </figure>
                                    </div>
                                    <div class="col ps-0">
                                        <p class="mb-0 fw-medium">{{ $employee->first_name }} {{ $employee->last_name }}</p>
                                        <p class="text-secondary small">{{ $employee->phone ?? '' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="mb-0">{{ $employee->email ?? '-' }}</p>
                                <p class="text-secondary small">{{ $employee->phone ?? '-' }}</p>
                            </td>
                            <td>{{ $employee->department ?? '-' }}</td>
                            <td>{{ $employee->organization->name ?? '-' }}</td>
                            <td>{{ $employee->position ?? '-' }}</td>
                            <td>
                                <a href="{{ route('employees.show', $employee->id) }}" 
                                   class="btn btn-square btn-link" 
                                   data-bs-toggle="tooltip" 
                                   title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <div class="dropdown d-inline-block">
                                    <a class="btn btn-link no-caret" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('employees.edit', $employee->id) }}">Edit</a>
                                        </li>
                                        <li>
                                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item theme-red" onclick="return confirm('Haqiqatan ham o‘chirmoqchimisiz?')">Delete</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
