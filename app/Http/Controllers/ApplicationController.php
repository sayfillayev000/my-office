<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Spatie\Permission\Models\Role;

class ApplicationController extends Controller
{
    use AuthorizesRequests;

    protected $steps = [
        'yangi' => 'ariza qabul qilish',   // HR
        'qabul qilingan' => 'ariza tasdiqlash', // Manager
        'tasdiqlangan' => 'ariza yakuniy qabul', // Manager (yakuniy)
        'yakuniy' => null,
    ];

    public function index()
    {
        $applications = Application::with('user')->latest()->get();
        return view('applications.index', compact('applications'));
    }

    public function updateStatus(Request $request, Application $application)
    {
        $currentStatus = $application->status;

        // Hozirgi bosqich uchun kerak bo‘ladigan permission
        $currentPermission = $this->steps[$currentStatus] ?? null;

        if ($currentPermission && !auth()->user()->can($currentPermission)) {
            // Shu bosqichdagi rol yo‘q → keyingi mavjud bosqichni topamiz
            $nextStatus = $this->getNextAvailableStatus($currentStatus);

            if ($nextStatus) {
                $application->update(['status' => $nextStatus]);
                return back()->with('success', "Ariza avtomatik o'tkazildi: {$nextStatus}");
            }

            return back()->with('error', "Keyingi bosqich topilmadi");
        }

        // Odatdagi ketma-ketlik
        $nextStatus = $this->getNextAvailableStatus($currentStatus);
        if ($nextStatus) {
            $application->update(['status' => $nextStatus]);
        }

        return redirect()->back()->with('success', "Ariza yangilandi: {$nextStatus}");
    }

 private function getNextAvailableStatus($currentStatus)
{
    $steps = $this->steps;
    $keys = array_keys($steps);
    $currentIndex = array_search($currentStatus, $keys);

    while ($currentIndex !== false && isset($keys[$currentIndex + 1])) {
        $nextStatus = $keys[$currentIndex + 1];
        $permission = $steps[$nextStatus];

        if ($permission) {
            // Shu permissionga ega user bormi?
            $hasUser = \Spatie\Permission\Models\Role::whereHas('permissions', function($q) use ($permission) {
                $q->where('name', $permission);
            })->whereHas('users')->exists();

            if ($hasUser) {
                return $nextStatus; // bosqichni topshiramiz
            }

            // agar user yo‘q bo‘lsa, avtomatik managerga topshiramiz
            if (! $hasUser) {
                return $nextStatus; 
            }
        }

        $currentIndex++;
    }

    return null;
}

}
