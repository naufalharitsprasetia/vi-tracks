<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Models\Log;
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

            if ($totalOrders > 0) {
                $chartData = [
                    'APPROVED' => ($statusStats['APPROVED'] ?? 0) / $totalOrders,
                    'COMPLETED' => ($statusStats['COMPLETED'] ?? 0) / $totalOrders,
                    'PENDING'  => ($statusStats['PENDING'] ?? 0) / $totalOrders,
                    'REJECTED' => ($statusStats['REJECTED'] ?? 0) / $totalOrders,
                    'IN_PROGRESS' => ($statusStats['IN_PROGRESS'] ?? 0) / $totalOrders,
                    'IN_USE' => ($statusStats['IN_USE'] ?? 0) / $totalOrders,
                ];
            } else {
                $chartData = [
                    'APPROVED' => 0,
                    'COMPLETED' => 0,
                    'PENDING'  => 0,
                    'REJECTED' => 0,
                    'IN_PROGRESS' => 0,
                    'IN_USE' => 0,
                ];
            }

            return view('admin.dashboard', compact('totalOrders', 'chartData', 'statusStats', 'topVehicles', 'newestOrders', 'totalOrdersToday', 'pendingOrders', 'completedOrders'));
        } else {
            if (Auth::user()->approval_level == 1) {
                $pendingApprovals = Approval::where('approver_id', Auth::user()->id)->where('status', 'PENDING')->get();
                $totalRejected = Approval::where('approver_id', Auth::user()->id)->where('status', 'REJECTED')->count();
                $totalApproved = Approval::where('approver_id', Auth::user()->id)->where('status', 'APPROVED')->count();
            } else if (Auth::user()->approval_level == 2) {
                $pendingApprovals = Approval::where('approver_id', Auth::user()->id)->where('status', 'PENDING')->get();
                $pendingApprovals = $pendingApprovals->filter(function ($approval) {
                    return $approval->order->status == 'IN_PROGRESS';
                });
                $totalRejected = Approval::where('approver_id', Auth::user()->id)->where('status', 'REJECTED')->count();
                $totalApproved = Approval::where('approver_id', Auth::user()->id)->where('status', 'APPROVED')->count();
            }
            return view('approver.dashboard', compact('pendingApprovals', 'totalRejected', 'totalApproved'));
        }
    }

    public function reports()
    {
        return view('admin.reports');
    }

    public function logs()
    {
        $logs = Log::latest()->get();
        return view('admin.logs', compact('logs'));
    }
}
