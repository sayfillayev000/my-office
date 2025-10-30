<?php

namespace App\Http\Controllers;

use App\Models\MenyuOrganization;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LogsController extends Controller
{
    public function index()
    {
        $organizations = MenyuOrganization::query()
            ->select(['id', 'name'])
            ->orderBy('name')
            ->get();

        return view('pages.logs.index', compact('organizations'));
    }

    public function organizationLogs(Request $request, int $organizationId)
    {
        $period = $request->string('period', 'daily')->toString();
        $isKitchen = $request->boolean('kitchen', false);
        $dateInput = $request->input('date');
        $date = $dateInput ? Carbon::parse($dateInput) : Carbon::now();

        // Date range
        $start = ($period === 'daily') ? $date->copy()->startOfDay() : $date->copy()->startOfMonth();
        $end = ($period === 'daily') ? $date->copy()->endOfDay() : $date->copy()->endOfMonth();
        if ($period === 'monthly') {
            $start = now()->startOfMonth();
            $end = now()->endOfMonth();
        }

        // Base table and dynamic column names
        $table = $isKitchen ? 'Menyu_kitchenchecklog' : 'Menyu_workerlog';
        $employeeCol = $isKitchen ? 'employee_id' : 'worker_id';
        $projectCol = 'obyect_project_id'; // exists on workerlog; may be absent on kitchen

        // Build aggregated logs per worker (first in, last out by timestamp)
        // We don't have explicit in/out flags; use min(date) as first_in, max(date) as last_out within range
        $query = DB::table($table . ' as wl')
            ->leftJoin('Menyu_employee as e', 'e.id', '=', DB::raw("wl.{$employeeCol}"))
            ->leftJoin('Menyu_turniketsettings as t', 't.id', '=', 'wl.turniket_id')
            ->where('wl.organization_id', $organizationId)
            ->whereBetween('wl.date', [$start, $end]);

        // Optional project join only for workerlog
        if (!$isKitchen) {
            $query->leftJoin('Menyu_obyectproject as p', 'p.id', '=', DB::raw("wl.{$projectCol}"));
        }

        $query->selectRaw("wl.{$employeeCol} as employee_id")
            ->selectRaw("COALESCE(e.first_name || ' ' || e.last_name, e.first_name, '-') as employee_name")
            ->selectRaw($isKitchen ? "NULL as project_name" : 'p.name as project_name')
            ->selectRaw('MIN(wl.date) as first_in')
            ->selectRaw('MAX(wl.date) as last_out')
            ->selectRaw('MIN(wl.id) as first_id')
            ->selectRaw('MAX(wl.id) as last_id')
            ->groupBy(DB::raw("wl.{$employeeCol}"), 'e.first_name', 'e.last_name');

        if (!$isKitchen) {
            $query->groupBy('p.name');
        }

        $rows = $query->orderBy('employee_name')->get();

        // Fetch entry/exit records photos and turniket ip
        $firstIds = $rows->pluck('first_id')->filter()->values();
        $lastIds = $rows->pluck('last_id')->filter()->values();

        // Kitchen logs table doesn't have a photo column; avoid selecting non-existing columns
        if ($isKitchen) {
            $entryMap = DB::table($table . ' as wl')
                ->leftJoin('Menyu_turniketsettings as t', 't.id', '=', 'wl.turniket_id')
                ->whereIn('wl.id', $firstIds)
                ->select('wl.id', DB::raw('NULL as photo'), 't.turniket_ip')
                ->get()->keyBy('id');

            $exitMap = DB::table($table . ' as wl')
                ->leftJoin('Menyu_turniketsettings as t', 't.id', '=', 'wl.turniket_id')
                ->whereIn('wl.id', $lastIds)
                ->select('wl.id', DB::raw('NULL as photo'), 't.turniket_ip')
                ->get()->keyBy('id');
        } else {
            $entryMap = DB::table($table . ' as wl')
                ->leftJoin('Menyu_turniketsettings as t', 't.id', '=', 'wl.turniket_id')
                ->whereIn('wl.id', $firstIds)
                ->select('wl.id', 'wl.photo', 't.turniket_ip')
                ->get()->keyBy('id');

            $exitMap = DB::table($table . ' as wl')
                ->leftJoin('Menyu_turniketsettings as t', 't.id', '=', 'wl.turniket_id')
                ->whereIn('wl.id', $lastIds)
                ->select('wl.id', 'wl.photo', 't.turniket_ip')
                ->get()->keyBy('id');
        }

        $data = $rows->map(function ($r) use ($entryMap, $exitMap) {
            $entry = $entryMap->get($r->first_id);
            $exit = $exitMap->get($r->last_id);
            return [
                'employee_id' => $r->employee_id,
                'employee_name' => $r->employee_name ?? '-',
                'project_name' => $r->project_name ?? '-',
                'first_in' => $r->first_in,
                'last_out' => $r->last_out,
                'entry_photo' => $this->buildPhotoUrl($entry->photo ?? null),
                'exit_photo' => $this->buildPhotoUrl($exit->photo ?? null),
                'turniket_ip' => $entry->turniket_ip ?? $exit->turniket_ip ?? null,
            ];
        });
        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    private function buildPhotoUrl(?string $filename): ?string
    {
        if (empty($filename)) {
            return null;
        }
        if (str_starts_with($filename, 'http://') || str_starts_with($filename, 'https://')) {
            return $filename;
        }
        // WorkerLog photos are served from external media server
        $base = 'http://84.54.118.39:8444/media/media_uploads/';
        return rtrim($base, '/') . '/' . ltrim($filename, '/');
    }

    public function organizationView(Request $request, int $organizationId)
    {
        $period = $request->string('period', 'daily')->toString();
        $isKitchen = $request->boolean('kitchen', false);
        $dateInput = $request->input('date');
        $date = $dateInput ? Carbon::parse($dateInput) : Carbon::now();

        $organization = MenyuOrganization::select(['id','name'])->findOrFail($organizationId);

        // Reuse JSON method to get data
        $json = $this->organizationLogs(new Request([
            'period' => $period,
            'kitchen' => $isKitchen,
            'date' => $date->toDateString(),
        ]), $organizationId);

        $payload = $json->getData(true);
        $rows = $payload['data'] ?? [];

        return view('pages.logs.organization', [
            'organization' => $organization,
            'period' => $period,
            'kitchen' => $isKitchen,
            'date' => $date->toDateString(),
            'rows' => $rows,
        ]);
    }
}


