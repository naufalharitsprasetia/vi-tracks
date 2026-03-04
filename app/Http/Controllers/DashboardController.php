<?php

namespace App\Http\Controllers;

use App\Models\VehicleOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $totalOrders = VehicleOrder::count();
            $totalOrdersToday = VehicleOrder::whereDate('created_at', now()->toDateString())->count();
            $pendingOrders = VehicleOrder::where('status', 'PENDING')->count();
            $completedOrders = VehicleOrder::where('status', 'COMPLETED')->count();
            $newestOrders = VehicleOrder::latest()->take(5)->get();
            $statusStats = VehicleOrder::query()
                ->select('status')
                ->selectRaw('COUNT(id) as total')
                ->groupBy('status')
                ->pluck('total', 'status');
            $topVehicles = VehicleOrder::select('vehicle_id')
                ->selectRaw('COUNT(*) as total_orders')
                ->groupBy('vehicle_id')
                ->with('vehicle')
                ->orderByDesc('total_orders')
                ->limit(5)
                ->get();

            $chartData = [
                'APPROVED' => ($statusStats['APPROVED'] ?? 0) / $totalOrders,
                'COMPLETED' => ($statusStats['COMPLETED'] ?? 0) / $totalOrders,
                'PENDING'  => ($statusStats['PENDING'] ?? 0) / $totalOrders,
                'REJECTED' => ($statusStats['REJECTED'] ?? 0) / $totalOrders,
            ];

            return view('admin.dashboard', compact('totalOrders', 'chartData', 'statusStats', 'topVehicles', 'newestOrders', 'totalOrdersToday', 'pendingOrders', 'completedOrders'));
        } else {
            return view('approver.dashboard');
        }
    }
}
