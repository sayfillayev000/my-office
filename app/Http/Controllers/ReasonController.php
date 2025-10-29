<?php

namespace App\Http\Controllers;

use App\Models\EmployeeReason;
use App\Models\EmployeeReasonItem;
use App\Models\User;
use Illuminate\Http\Request;

class ReasonController extends Controller
{
    /**
     * Get all active reasons
     */
    public function getReasons()
    {
        $reasons = EmployeeReason::where('is_active', true)->get();
        return response()->json($reasons);
    }

    /**
     * Get employee reason items
     */
    public function getEmployeeReasonItems($employeeId)
    {
        $items = EmployeeReasonItem::with('reason')
            ->where('employee_id', $employeeId)
            ->orderBy('created_at', 'desc')
            ->get();
        
        return response()->json($items);
    }

    /**
     * Store employee reason item
     */
    public function storeEmployeeReasonItem(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:Menyu_employee,id',
            'reason_id' => 'required|exists:employee_reasons,id',
            'type' => 'required|in:daily,hourly',
            'start_date' => 'required_if:type,daily|nullable|date',
            'end_date' => 'required_if:type,daily|nullable|date',
            'start_datetime' => 'required_if:type,hourly|nullable|date',
            'end_datetime' => 'required_if:type,hourly|nullable|date',
            'comment' => 'nullable|string|max:1000'
        ]);

        try {
            EmployeeReasonItem::create($validated);
            
            return response()->json([
                'success' => true,
                'message' => 'Sabab muvaffaqiyatli qo\'shildi'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Xatolik: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete employee reason item
     */
    public function deleteEmployeeReasonItem($id)
    {
        try {
            $item = EmployeeReasonItem::findOrFail($id);
            $item->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Sabab o\'chirildi'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Xatolik: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get single reason by ID
     */
    public function getReason($id)
    {
        $reason = EmployeeReason::findOrFail($id);
        return response()->json($reason);
    }

    /**
     * Store new reason
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'nullable|string|max:50',
            'description' => 'nullable|string|max:1000'
        ]);

        try {
            $reason = EmployeeReason::create($validated);
            
            return response()->json([
                'success' => true,
                'message' => 'Sabab muvaffaqiyatli qo\'shildi',
                'data' => $reason
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Xatolik: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update reason
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'nullable|string|max:50',
            'description' => 'nullable|string|max:1000',
            'is_active' => 'boolean'
        ]);

        try {
            $reason = EmployeeReason::findOrFail($id);
            $reason->update($validated);
            
            return response()->json([
                'success' => true,
                'message' => 'Sabab yangilandi',
                'data' => $reason
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Xatolik: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete reason
     */
    public function destroy($id)
    {
        try {
            $reason = EmployeeReason::findOrFail($id);
            $reason->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Sabab o\'chirildi'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Xatolik: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get all reasons with pagination (for management)
     */
    public function index()
    {
        $reasons = EmployeeReason::orderBy('created_at', 'desc')->paginate(10);
        return response()->json($reasons);
    }
}

