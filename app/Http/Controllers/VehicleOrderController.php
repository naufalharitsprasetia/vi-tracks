<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityLogger;
use App\Models\Approval;
use App\Models\Driver;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehicleOrderController extends Controller
{
    public function index()
    {
        $orders = VehicleOrder::with(['vehicle', 'driver'])->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        $vehicles = Vehicle::where('is_active', true)->get();
        $drivers = Driver::where('is_active', true)->get();
        $approverLevel1 = User::where('role', 'approver')->where('approval_level', 1)->get();
        $approverLevel2 = User::where('role', 'approver')->where('approval_level', 2)->get();

        return view('admin.orders.create', compact('vehicles', 'drivers', 'approverLevel1', 'approverLevel2'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // Validasi input
        $request->validate([
            'requester_name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'booking_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:booking_date',
            'destination' => 'required|string|max:255',
            'passengers' => 'required|integer|min:1',
            'vehicle_type' => 'required|exists:vehicles,id',
            'driver_id' => 'required|exists:drivers,id',
            'priority' => 'required|in:normal,high,urgent',
            'approver_level1' => 'required|exists:users,id',
            'approver_level2' => 'required|exists:users,id',
            'notes' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request) {
            $today = Carbon::now()->format('Ymd');
            $lastOrder = DB::table('vehicle_orders')
                ->whereDate('created_at', Carbon::today())
                ->lockForUpdate()
                ->orderByDesc('id')
                ->first();

            $nextNumber = $lastOrder
                ? ((int) substr($lastOrder->order_code, -4)) + 1
                : 1;

            $orderCode = 'VO-' . $today . '-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

            $vehicleOrder = VehicleOrder::create([
                'order_code'   => $orderCode,
                'requester_name' => $request->requester_name,
                'department' => $request->department,
                'booking_date' => $request->booking_date,
                'return_date' => $request->return_date,
                'destination' => $request->destination,
                'passengers' => $request->passengers,
                'priority' => $request->priority,
                'vehicle_id' => $request->vehicle_type,
                'driver_id' => $request->driver_id,
                'status' => 'PENDING',
                'notes' => $request->notes,
            ]);

            Approval::create([
                'vehicle_order_id' => $vehicleOrder->id,
                'approver_id' => $request->approver_level1,
                'level' => 1,
                'status' => 'PENDING',
            ]);
            Approval::create([
                'vehicle_order_id' => $vehicleOrder->id,
                'approver_id' => $request->approver_level2,
                'level' => 2,
                'status' => 'PENDING',
            ]);

            ActivityLogger::log('Order Created', 'Order #' . $vehicleOrder->order_code . ' has been created by ' . $request->requester_name);
        });

        return redirect()->route('admin.orders')->with('success', 'Order kendaraan berhasil dibuat!');
    }

    public function show($id)
    {
        $order = VehicleOrder::with(['vehicle', 'driver', 'approvals.approver'])->where('order_code', $id)->firstOrFail();
        return view('admin.orders.show', compact('order'));
    }
}
