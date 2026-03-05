@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header with Filters -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Pending Approvals</h1>
            <p class="text-gray-600">Review and approve orders that require your decision</p>
        </div>
        <div class="flex gap-2">
            <input type="text" placeholder="Search by Order ID or Requester..."
                class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 w-full md:w-64">
            <select
                class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="">Filter by Priority</option>
                <option value="urgent">Urgent</option>
                <option value="high">High</option>
                <option value="normal">Normal</option>
            </select>
        </div>
    </div>

    <!-- Pending Orders List -->
    <div class="space-y-4">
        @foreach ($pendingApprovals as $approval)
        <!-- Order Card 1 -->
        <div class="p-6 hover:bg-gray-50 transition-colors border-l-4 border-yellow-500">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <h4 class="text-lg font-bold text-gray-900">{{ $approval->order->order_code }}</h4>
                    <p class="text-sm text-gray-600">Requested by: {{ $approval->order->requester_name }}
                        ({{$approval->order->department}} Departement)</p>
                </div>
                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">Awaiting
                    Level 2</span>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                <div>
                    <p class="text-xs text-gray-600 font-semibold">Kendaraan</p>
                    <p class="text-sm font-medium text-gray-900">{{$approval->order->vehicle->brand}}
                        ({{$approval->order->vehicle->plate_number}})</p>
                </div>
                <div>
                    <p class="text-xs text-gray-600 font-semibold">Date</p>
                    <p class="text-sm font-medium text-gray-900">{{ $approval->order->booking_date }} s/d {{
                        $approval->order->return_date }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-600 font-semibold">Driver</p>
                    <p class="text-sm font-medium text-gray-900">{{ $approval->order->driver->name }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-600 font-semibold">Priority</p>
                    @php
                    if($approval->order->priority == 'urgent') {
                    $textPriority = 'text-red-600';
                    } elseif($approval->order->priority == 'high') {
                    $textPriority = 'text-yellow-600';
                    } else {
                    $textPriority = 'text-blue-600';
                    }
                    @endphp
                    <p class="text-sm font-medium {{ $textPriority }}">{{ $approval->order->priority }}</p>
                </div>
            </div>

            <p class="text-sm text-gray-600 mb-1"><strong>Destination/Purpose:</strong> {{
                $approval->order->destination }}
            </p>
            <p class="text-xs text-gray-600 mb-4"><strong>Additional Notes:</strong> {{
                $approval->order->notes }}
            </p>

            @if($approval->level == 1)
            <!-- Approval Timeline level 1 -->
            <div class="bg-gray-50 rounded-lg p-4 mb-4 text-xs">
                <p class="font-semibold text-gray-700 mb-3">Approval Status:</p>
                <div class="flex items-center gap-3">
                    <div class="text-center">
                        <div
                            class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center text-sm font-bold">
                            ✓</div>
                        <p class="text-xs mt-1 text-gray-600">Admin<br>Created</p>
                    </div>
                    <div class="flex-1 border-b-2 border-yellow-300"></div>
                    <div class="text-center">
                        <div
                            class="w-8 h-8 bg-yellow-400 text-white rounded-full flex items-center justify-center text-sm font-bold">
                            ?</div>
                        <p class="text-xs mt-1 text-gray-600">Manager<br>Approved</p>
                    </div>
                    <div class="flex-1 border-b-2 border-gray-300"></div>
                    <div class="text-center">
                        <div
                            class="w-8 h-8 bg-yellow-400 text-white rounded-full flex items-center justify-center text-sm font-bold">
                            ?</div>
                        <p class="text-xs mt-1 text-gray-600">Director<br>Pending</p>
                    </div>
                </div>
            </div>
            @elseif($approval->level == 2)
            <!-- Approval Timeline level 2 -->
            <div class="bg-gray-50 rounded-lg p-4 mb-4 text-xs">
                <p class="font-semibold text-gray-700 mb-3">Approval Status:</p>
                <div class="flex items-center gap-3">
                    <div class="text-center">
                        <div
                            class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center text-sm font-bold">
                            ✓</div>
                        <p class="text-xs mt-1 text-gray-600">Admin<br>Created</p>
                    </div>
                    <div class="flex-1 border-b-2 border-green-500"></div>
                    <div class="text-center">
                        <div
                            class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center text-sm font-bold">
                            ✓</div>
                        <p class="text-xs mt-1 text-gray-600">Manager<br>Approved</p>
                    </div>
                    <div class="flex-1 border-b-2 border-gray-300"></div>
                    <div class="text-center">
                        <div
                            class="w-8 h-8 bg-yellow-400 text-white rounded-full flex items-center justify-center text-sm font-bold">
                            ?</div>
                        <p class="text-xs mt-1 text-gray-600">Director<br>Pending</p>
                    </div>
                </div>
            </div>
            @endif
            <div class="flex gap-3">
                <button onclick="openApprovalModal({{$approval->id}})"
                    class="cursor-pointer flex-1 px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition-all">
                    Approve
                </button>
                <button onclick="openRejectionModal({{$approval->id}})"
                    class="cursor-pointer flex-1 px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-all">
                    Reject
                </button>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Approval Modal -->
<div id="approvalModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-6">
        <h3 class="text-xl font-bold text-gray-900 mb-4">Approve Order</h3>
        <form method="POST" id="approvalForm">
            @csrf
            <p class="text-gray-600 mb-4">Are you sure you want to approve this order? The requester will be notified.
            </p>
            <textarea placeholder="Add approval notes (optional)" name="note"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 mb-4"
                rows="3"></textarea>
            <div class="flex gap-3">
                <button onclick="closeApprovalModal()" type="button"
                    class="cursor-pointer flex-1 px-4 py-2 border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-all">
                    Cancel
                </button>
                <button onclick="submitApproval()"
                    class="cursor-pointer flex-1 px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition-all">
                    Confirm Approval
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Rejection Modal -->
<div id="rejectionModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-6">
        <h3 class="text-xl font-bold text-gray-900 mb-4">Reject Order</h3>
        <form method="POST" id="rejectionForm">
            @csrf
            <p class="text-gray-600 mb-4">Please provide a reason for rejection:</p>
            <textarea placeholder="Reason for rejection..." name="note" required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 mb-4"
                rows="3" required></textarea>
            <div class="flex gap-3">
                <button onclick="closeRejectionModal()" type="button"
                    class="cursor-pointer flex-1 px-4 py-2 border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-all">
                    Cancel
                </button>
                <button onclick="submitRejection()"
                    class="cursor-pointer flex-1 px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-all">
                    Confirm Rejection
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openApprovalModal(id) {
    const form = document.getElementById('approvalForm');
    form.action = `/approval-approve/${id}`;
    document.getElementById('approvalModal').classList.remove('hidden');
}

function closeApprovalModal() {
    document.getElementById('approvalModal').classList.add('hidden');
}

function openRejectionModal(id) {
    const form = document.getElementById('rejectionForm');
    form.action = `/approval-reject/${id}`;
    document.getElementById('rejectionModal').classList.remove('hidden');
}

function closeRejectionModal() {
    document.getElementById('rejectionModal').classList.add('hidden');
}
</script>
@endsection
