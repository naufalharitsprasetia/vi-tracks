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
            <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="">Filter by Priority</option>
                <option value="urgent">Urgent</option>
                <option value="high">High</option>
                <option value="normal">Normal</option>
            </select>
        </div>
    </div>

    <!-- Pending Orders List -->
    <div class="space-y-4">
        <!-- Order Item 1 -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border-l-4 border-red-500 hover:shadow-lg transition-shadow">
            <div class="p-6">
                <!-- Header Row -->
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <h3 class="text-lg font-bold text-gray-900">#ORD-2024-001</h3>
                            <span class="px-3 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded-full">Urgent</span>
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">Level 2 Review</span>
                        </div>
                        <p class="text-sm text-gray-600">Requested by: <strong>John Doe</strong> | Sales Department</p>
                        <p class="text-sm text-gray-600">Submitted: <strong>2024-03-03 10:30 AM</strong></p>
                    </div>
                    <button class="text-gray-400 hover:text-gray-600" onclick="toggleDetails(this)">
                        <svg class="w-6 h-6 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                    </button>
                </div>

                <!-- Details Section (Expandable) -->
                <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-4 pb-4 border-b border-gray-200">
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Vehicle</p>
                        <p class="text-sm font-medium text-gray-900">Toyota Avanza</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Dates</p>
                        <p class="text-sm font-medium text-gray-900">Mar 5-7, 2024</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Driver</p>
                        <p class="text-sm font-medium text-gray-900">Budi Santoso</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Passengers</p>
                        <p class="text-sm font-medium text-gray-900">5 persons</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Destination</p>
                        <p class="text-sm font-medium text-gray-900">Jakarta</p>
                    </div>
                </div>

                <!-- Purpose Section -->
                <div class="mb-4 p-4 bg-blue-50 rounded-lg border border-blue-200">
                    <p class="text-xs text-blue-900 font-semibold uppercase mb-1">Purpose</p>
                    <p class="text-sm text-blue-900">Client presentation and business meeting at our Jakarta office</p>
                </div>

                <!-- Approval Timeline -->
                <div class="mb-4 p-4 bg-gray-50 rounded-lg">
                    <p class="text-xs font-semibold text-gray-700 uppercase mb-3">Approval Progress</p>
                    <div class="flex items-center gap-2">
                        <div class="text-center flex-1">
                            <div class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center mx-auto text-sm font-bold mb-2">✓</div>
                            <p class="text-xs text-gray-600">Admin<br>Created</p>
                        </div>
                        <div class="flex-1 border-b-2 border-green-500"></div>
                        <div class="text-center flex-1">
                            <div class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center mx-auto text-sm font-bold mb-2">✓</div>
                            <p class="text-xs text-gray-600">Manager<br>Approved</p>
                        </div>
                        <div class="flex-1 border-b-2 border-gray-300"></div>
                        <div class="text-center flex-1">
                            <div class="w-8 h-8 bg-yellow-400 text-white rounded-full flex items-center justify-center mx-auto text-sm font-bold mb-2">?</div>
                            <p class="text-xs text-gray-600">Director<br>Pending</p>
                        </div>
                    </div>
                </div>

                <!-- Actions Row -->
                <div class="flex items-center gap-3">
                    <button onclick="openApprovalModal(this)" class="flex-1 px-4 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition-all flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Approve
                    </button>
                    <button onclick="openRejectionModal(this)" class="flex-1 px-4 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-all flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Reject
                    </button>
                    <button class="px-4 py-3 border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-all flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Details
                    </button>
                </div>
            </div>
        </div>

        <!-- Order Item 2 -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border-l-4 border-yellow-500 hover:shadow-lg transition-shadow">
            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <h3 class="text-lg font-bold text-gray-900">#ORD-2024-002</h3>
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">Normal</span>
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">Level 2 Review</span>
                        </div>
                        <p class="text-sm text-gray-600">Requested by: <strong>Sarah Smith</strong> | Marketing Department</p>
                        <p class="text-sm text-gray-600">Submitted: <strong>2024-03-02 2:15 PM</strong></p>
                    </div>
                    <button class="text-gray-400 hover:text-gray-600" onclick="toggleDetails(this)">
                        <svg class="w-6 h-6 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                    </button>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-4 pb-4 border-b border-gray-200">
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Vehicle</p>
                        <p class="text-sm font-medium text-gray-900">Honda CR-V</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Dates</p>
                        <p class="text-sm font-medium text-gray-900">Mar 10, 2024</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Driver</p>
                        <p class="text-sm font-medium text-gray-900">Ahmad Riyadi</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Passengers</p>
                        <p class="text-sm font-medium text-gray-900">3 persons</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Destination</p>
                        <p class="text-sm font-medium text-gray-900">Bali</p>
                    </div>
                </div>

                <div class="mb-4 p-4 bg-blue-50 rounded-lg border border-blue-200">
                    <p class="text-xs text-blue-900 font-semibold uppercase mb-1">Purpose</p>
                    <p class="text-sm text-blue-900">Product launch event and promotional campaign at Bali resort</p>
                </div>

                <div class="mb-4 p-4 bg-gray-50 rounded-lg">
                    <p class="text-xs font-semibold text-gray-700 uppercase mb-3">Approval Progress</p>
                    <div class="flex items-center gap-2">
                        <div class="text-center flex-1">
                            <div class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center mx-auto text-sm font-bold mb-2">✓</div>
                            <p class="text-xs text-gray-600">Admin<br>Created</p>
                        </div>
                        <div class="flex-1 border-b-2 border-green-500"></div>
                        <div class="text-center flex-1">
                            <div class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center mx-auto text-sm font-bold mb-2">✓</div>
                            <p class="text-xs text-gray-600">Manager<br>Approved</p>
                        </div>
                        <div class="flex-1 border-b-2 border-gray-300"></div>
                        <div class="text-center flex-1">
                            <div class="w-8 h-8 bg-yellow-400 text-white rounded-full flex items-center justify-center mx-auto text-sm font-bold mb-2">?</div>
                            <p class="text-xs text-gray-600">Director<br>Pending</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <button onclick="openApprovalModal(this)" class="flex-1 px-4 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition-all flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Approve
                    </button>
                    <button onclick="openRejectionModal(this)" class="flex-1 px-4 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-all flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Reject
                    </button>
                    <button class="px-4 py-3 border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-all flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Details
                    </button>
                </div>
            </div>
        </div>

        <!-- Order Item 3 -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border-l-4 border-orange-500 hover:shadow-lg transition-shadow">
            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <h3 class="text-lg font-bold text-gray-900">#ORD-2024-003</h3>
                            <span class="px-3 py-1 bg-orange-100 text-orange-800 text-xs font-semibold rounded-full">High</span>
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">Level 2 Review</span>
                        </div>
                        <p class="text-sm text-gray-600">Requested by: <strong>Rudi Hartono</strong> | Operations Department</p>
                        <p class="text-sm text-gray-600">Submitted: <strong>2024-03-01 9:45 AM</strong></p>
                    </div>
                    <button class="text-gray-400 hover:text-gray-600" onclick="toggleDetails(this)">
                        <svg class="w-6 h-6 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                    </button>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-4 pb-4 border-b border-gray-200">
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Vehicle</p>
                        <p class="text-sm font-medium text-gray-900">Mitsubishi Pajero</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Dates</p>
                        <p class="text-sm font-medium text-gray-900">Mar 8-15, 2024</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Driver</p>
                        <p class="text-sm font-medium text-gray-900">Siti Nurhaliza</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Passengers</p>
                        <p class="text-sm font-medium text-gray-900">6 persons</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Destination</p>
                        <p class="text-sm font-medium text-gray-900">Surabaya</p>
                    </div>
                </div>

                <div class="mb-4 p-4 bg-blue-50 rounded-lg border border-blue-200">
                    <p class="text-xs text-blue-900 font-semibold uppercase mb-1">Purpose</p>
                    <p class="text-sm text-blue-900">Supply chain inspection and warehouse audit at Surabaya distribution center</p>
                </div>

                <div class="mb-4 p-4 bg-gray-50 rounded-lg">
                    <p class="text-xs font-semibold text-gray-700 uppercase mb-3">Approval Progress</p>
                    <div class="flex items-center gap-2">
                        <div class="text-center flex-1">
                            <div class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center mx-auto text-sm font-bold mb-2">✓</div>
                            <p class="text-xs text-gray-600">Admin<br>Created</p>
                        </div>
                        <div class="flex-1 border-b-2 border-green-500"></div>
                        <div class="text-center flex-1">
                            <div class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center mx-auto text-sm font-bold mb-2">✓</div>
                            <p class="text-xs text-gray-600">Manager<br>Approved</p>
                        </div>
                        <div class="flex-1 border-b-2 border-gray-300"></div>
                        <div class="text-center flex-1">
                            <div class="w-8 h-8 bg-yellow-400 text-white rounded-full flex items-center justify-center mx-auto text-sm font-bold mb-2">?</div>
                            <p class="text-xs text-gray-600">Director<br>Pending</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <button onclick="openApprovalModal(this)" class="flex-1 px-4 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition-all flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Approve
                    </button>
                    <button onclick="openRejectionModal(this)" class="flex-1 px-4 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-all flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Reject
                    </button>
                    <button class="px-4 py-3 border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-all flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Details
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Approval Modal -->
<div id="approvalModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-6">
        <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            Approve Order
        </h3>
        <p class="text-gray-600 mb-4">Are you sure you want to approve this order? This action is final and the requester will be notified immediately.</p>
        <textarea placeholder="Add approval notes (optional)" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 mb-4" rows="3"></textarea>
        <div class="flex gap-3">
            <button onclick="closeApprovalModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-all">
                Cancel
            </button>
            <button onclick="submitApproval()" class="flex-1 px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition-all">
                Confirm Approval
            </button>
        </div>
    </div>
</div>

<!-- Rejection Modal -->
<div id="rejectionModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-6">
        <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            Reject Order
        </h3>
        <p class="text-gray-600 mb-4">Please provide a reason for rejection. The requester will be notified and may submit a revised request.</p>
        <textarea placeholder="Reason for rejection (required)..." class="w-full px-4 py-3 border border-red-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 mb-4" rows="3" required></textarea>
        <div class="flex gap-3">
            <button onclick="closeRejectionModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-all">
                Cancel
            </button>
            <button onclick="submitRejection()" class="flex-1 px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-all">
                Confirm Rejection
            </button>
        </div>
    </div>
</div>

<script>
    function toggleDetails(button) {
        button.closest('div').parentElement.classList.toggle('expanded');
        button.querySelector('svg').classList.toggle('rotate-180');
    }
    
    function openApprovalModal(button) {
        document.getElementById('approvalModal').classList.remove('hidden');
    }
    
    function closeApprovalModal() {
        document.getElementById('approvalModal').classList.add('hidden');
    }
    
    function openRejectionModal(button) {
        document.getElementById('rejectionModal').classList.remove('hidden');
    }
    
    function closeRejectionModal() {
        document.getElementById('rejectionModal').classList.add('hidden');
    }
    
    function submitApproval() {
        alert('Order approved successfully!');
        closeApprovalModal();
    }
    
    function submitRejection() {
        alert('Order rejected. Requester will be notified with the reason.');
        closeRejectionModal();
    }
</script>
@endsection
