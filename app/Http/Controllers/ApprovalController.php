<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityLogger;
use App\Models\Approval;
use App\Models\VehicleOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
    public function pendingApprovals()
    {
        $pendingApprovals = Approval::where('approver_id', Auth::user()->id)->where('status', 'PENDING')->get();
        if (Auth::user()->approval_level == 2) {
            $pendingApprovals = $pendingApprovals->filter(function ($approval) {
                return $approval->order->status == 'IN_PROGRESS';
            });
        }

        return view('approver.pending', compact('pendingApprovals'));
    }

    public function historyApprovals()
    {
        $historyApprovals = Approval::where('approver_id', Auth::user()->id)->whereIn('status', ['APPROVED', 'REJECTED'])->get();
        $totalApproved = $historyApprovals->where('status', 'APPROVED')->count();
        $totalRejected = $historyApprovals->where('status', 'REJECTED')->count();
        $approvalRate = $historyApprovals->count() > 0 ? round(($totalApproved / $historyApprovals->count()) * 100, 2) : 0;
        return view('approver.history', compact('historyApprovals', 'totalApproved', 'totalRejected', 'approvalRate'));
    }

    public function approve(Request $request, Approval $approval)
    {
        if ($approval->status !== 'PENDING') {
            return back()->with('error', 'This order has already been processed');
        } elseif ($approval->approver_id !== Auth::id()) {
            return back()->with('error', 'You are not authorized to approve this order');
        }
        $request->validate([
            'note' => 'nullable|string',
        ]);

        if ($approval->level == 1) {
            VehicleOrder::where('id', $approval->vehicle_order_id)->update(['status' => 'IN_PROGRESS']);
        } elseif ($approval->level == 2) {
            VehicleOrder::where('id', $approval->vehicle_order_id)->update(['status' => 'APPROVED']);
        }

        $approval->update([
            'status' => 'APPROVED',
            'approved_at' => now(),
            'note' => $request->note,
        ]);

        ActivityLogger::log('Order Approved', 'Order #' . $approval->order->order_code . ' has been approved by ' . Auth::user()->name);

        return back()->with('success', 'Order approved successfully');
    }

    public function reject(Request $request, Approval $approval)
    {
        if ($approval->status !== 'PENDING') {
            return back()->with('error', 'This order has already been processed');
        } elseif ($approval->approver_id !== Auth::id()) {
            return back()->with('error', 'You are not authorized to approve this order');
        }

        $request->validate([
            'note' => 'required|string',
        ]);

        VehicleOrder::where('id', $approval->vehicle_order_id)->update(['status' => 'REJECTED']);

        $approval->update([
            'status' => 'REJECTED',
            'rejected_at' => now(),
            'note' => $request->note,
        ]);

        ActivityLogger::log('Order Rejected', 'Order #' . $approval->order->order_code . ' has been rejected by ' . Auth::user()->name . '. Reason: ' . $request->note);

        return back()->with('success', 'Order rejected');
    }
}
