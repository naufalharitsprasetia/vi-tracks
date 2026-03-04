<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
    public function pendingApprovals()
    {
        $pendingApprovals = Approval::where('approver_id', Auth::user()->id)->where('status', 'PENDING')->get();
        return view('approver.pending', compact('pendingApprovals'));
    }

    public function historyApprovals()
    {
        $historyApprovals = Approval::where('approver_id', Auth::user()->id)->whereIn('status', ['APPROVED', 'REJECTED'])->get();
        return view('approver.history', compact('historyApprovals'));
    }
}
