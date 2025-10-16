<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;

class EmployeeController extends Controller
{
    #[Middleware('permission:employee.view', only: ['index', 'show'])]
    #[Middleware('permission:employee.create', only: ['create', 'store'])]
    #[Middleware('permission:employee.edit', only: ['edit', 'update'])]
    #[Middleware('permission:employee.delete', only: ['destroy'])]
    public function __construct()
    {
        //
    }

    public function index()
    {
        $employees = User::with('organization')->get();
        return view('pages.employee.index', compact('employees'));
    }

    public function create()
    {
        return view('pages.employee.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'position'   => 'nullable|string|max:255',
            'organization_id' => 'nullable|exists:menyu_organization,id',
            'image'      => 'nullable|image|max:2048',
        ]);

        if($request->hasFile('image')){
            $data['image'] = $request->file('image')->store('employees', 'public');
        }

        User::create($data);

        return redirect()->route('employees.index')->with('success', 'Xodim qo‘shildi!');
    }

    public function show(User $employee)
    {
        return view('pages.employee.show', compact('employee'));
    }

    public function edit(User $employee)
    {
        return view('pages.employee.edit', compact('employee'));
    }

    public function update(Request $request, User $employee)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'position'   => 'nullable|string|max:255',
            'organization_id' => 'nullable|exists:menyu_organization,id',
            'image'      => 'nullable|image|max:2048',
        ]);

        if($request->hasFile('image')){
            $data['image'] = $request->file('image')->store('employees', 'public');
        }

        $employee->update($data);

        return redirect()->route('employees.index')->with('success', 'Xodim tahrirlandi!');
    }

    public function destroy(User $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Xodim o‘chirildi!');
    }
}
