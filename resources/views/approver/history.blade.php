@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header with Filters -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Approval History</h1>
            <p class="text-gray-600">View your past approval and rejection decisions</p>
        </div>
        <div class="flex gap-2">
            <input type="text" placeholder="Search by Order ID..."
                class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            <select
                class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="">Filter by Status</option>
                <option value="approved">Approved</option>
                <option value="rejected">Rejected</option>
                <option value="all">All</option>
            </select>
        </div>
    </div>

    <!-- Timeline View -->
    <div class="space-y-4">
        @foreach ($historyApprovals as $approval)
        @if ($approval->status == 'APPROVED')
        <!-- Approval History Item Approved -->
        <div
            class="bg-white rounded-xl shadow-md overflow-hidden border-l-4 border-green-500 hover:shadow-lg transition-shadow">
            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <h3 class="text-lg font-bold text-gray-900">#{{ $approval->order->order_code }}</h3>
                            <span
                                class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Approved</span>
                        </div>
                        <p class="text-sm text-gray-600">Requested by:
                            <strong>{{$approval->order->requester_name}}</strong> |
                            {{$approval->order->department}} Department
                        </p>
                        <p class="text-sm text-gray-600">Decision Date: <strong>{{ $approval->approved_at }}</strong>
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-600 font-semibold uppercase mb-1">Decision</p>
                        <p class="text-sm font-bold text-green-600">Approved ✓</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4 pb-4 border-b border-gray-200">
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Vehicle</p>
                        <p class="text-sm font-medium text-gray-900">{{ $approval->order->vehicle->brand }} - {{
                            $approval->order->vehicle->plate_number }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Date</p>
                        <p class="text-sm font-medium text-gray-900">{{ $approval->order->booking_date }} s/d {{
                            $approval->order->return_date }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Driver</p>
                        <p class="text-sm font-medium text-gray-900">{{ $approval->order->driver->name }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Destination/Purpose</p>
                        <p class="text-sm font-medium text-gray-900">{{ $approval->order->destination }}</p>
                    </div>
                </div>

                <div class="mb-4 p-4 bg-green-50 rounded-lg border border-green-200">
                    <p class="text-xs text-green-900 font-semibold uppercase mb-1">Your Notes:</p>
                    <p class="text-sm text-green-900">{{ $approval->note }}</p>
                </div>

                <div class="flex items-center gap-4 text-sm">
                    <span class="px-3 py-1 bg-green-100 text-green-800 font-semibold rounded-full">Level {{
                        $approval->level }}
                        Approval</span>
                    <span class="text-gray-600">Approved on <strong>{{ $approval->approved_at }}</strong></span>
                </div>
            </div>
        </div>
        @endif

        @if ($approval->status == 'REJECTED')
        <!-- Approval History Item Rejected -->
        <div
            class="bg-white rounded-xl shadow-md overflow-hidden border-l-4 border-red-500 hover:shadow-lg transition-shadow">
            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <h3 class="text-lg font-bold text-gray-900">#{{ $approval->order->order_code }}</h3>
                            <span
                                class="px-3 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded-full">Rejected</span>
                        </div>
                        <p class="text-sm text-gray-600">Requested by: <strong>{{ $approval->order->requester_name
                                }}</strong> | {{ $approval->order->department }} Department
                        </p>
                        <p class="text-sm text-gray-600">Decision Date: <strong>{{ $approval->rejected_at }}</strong>
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-600 font-semibold uppercase mb-1">Decision</p>
                        <p class="text-sm font-bold text-red-600">Rejected ✗</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4 pb-4 border-b border-gray-200">
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Vehicle</p>
                        <p class="text-sm font-medium text-gray-900">{{ $approval->order->vehicle->brand }} ({{
                            $approval->order->vehicle->plate_number }})</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Date</p>
                        <p class="text-sm font-medium text-gray-900">{{ $approval->order->booking_date }} s/d {{
                            $approval->order->return_date }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Driver</p>
                        <p class="text-sm font-medium text-gray-900">{{ $approval->order->driver->name }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Destination</p>
                        <p class="text-sm font-medium text-gray-900">{{ $approval->order->destination }}</p>
                    </div>
                </div>

                <div class="mb-4 p-4 bg-red-50 rounded-lg border border-red-200">
                    <p class="text-xs text-red-900 font-semibold uppercase mb-1">Rejection Reason:</p>
                    <p class="text-sm text-red-900">{{ $approval->note }}</p>
                </div>

                <div class="flex items-center gap-4 text-sm">
                    <span class="px-3 py-1 bg-red-100 text-red-800 font-semibold rounded-full">Level {{ $approval->level
                        }} Approval</span>
                    <span class="text-gray-600">Rejected on <strong>{{ $approval->rejected_at }}</strong></span>
                </div>
            </div>
        </div>
        @endif

        @endforeach
    </div>

    <!-- Statistics Summary -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8 pt-8 border-t border-gray-200">
        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6 border border-green-200">
            <p class="text-sm text-green-700 font-semibold uppercase mb-2">Total Approved</p>
            <p class="text-4xl font-bold text-green-900">{{ $totalApproved }}</p>
            <p class="text-xs text-green-700 mt-2">In your approval history</p>
        </div>
        <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-xl p-6 border border-red-200">
            <p class="text-sm text-red-700 font-semibold uppercase mb-2">Total Rejected</p>
            <p class="text-4xl font-bold text-red-900">{{ $totalRejected }}</p>
            <p class="text-xs text-red-700 mt-2">Requiring revision</p>
        </div>
        <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-6 border border-purple-200">
            <p class="text-sm text-purple-700 font-semibold uppercase mb-2">Approval Rate</p>
            <p class="text-4xl font-bold text-purple-900">{{ $approvalRate }}%</p>
            <p class="text-xs text-purple-700 mt-2">Historical average</p>
        </div>
    </div>
</div>
@endsection
