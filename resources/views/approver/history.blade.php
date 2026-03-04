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
            <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="">Filter by Status</option>
                <option value="approved">Approved</option>
                <option value="rejected">Rejected</option>
                <option value="all">All</option>
            </select>
        </div>
    </div>

    <!-- Timeline View -->
    <div class="space-y-4">
        <!-- Approval History Item 1 -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border-l-4 border-green-500 hover:shadow-lg transition-shadow">
            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <h3 class="text-lg font-bold text-gray-900">#ORD-2024-042</h3>
                            <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Approved</span>
                        </div>
                        <p class="text-sm text-gray-600">Requested by: <strong>Maria Santos</strong> | HR Department</p>
                        <p class="text-sm text-gray-600">Decision Date: <strong>2024-03-02 4:30 PM</strong></p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-600 font-semibold uppercase mb-1">Decision Time</p>
                        <p class="text-sm font-bold text-green-600">Approved ✓</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4 pb-4 border-b border-gray-200">
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Vehicle</p>
                        <p class="text-sm font-medium text-gray-900">Honda CR-V</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Date</p>
                        <p class="text-sm font-medium text-gray-900">Mar 8, 2024</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Driver</p>
                        <p class="text-sm font-medium text-gray-900">Ahmad Riyadi</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Destination</p>
                        <p class="text-sm font-medium text-gray-900">Surabaya</p>
                    </div>
                </div>

                <div class="mb-4 p-4 bg-green-50 rounded-lg border border-green-200">
                    <p class="text-xs text-green-900 font-semibold uppercase mb-1">Your Notes</p>
                    <p class="text-sm text-green-900">Request meets all requirements. Driver and vehicle are suitable for this trip. Approved for execution.</p>
                </div>

                <div class="flex items-center gap-4 text-sm">
                    <span class="px-3 py-1 bg-green-100 text-green-800 font-semibold rounded-full">Level 2 Approval</span>
                    <span class="text-gray-600">Approved on <strong>March 2, 2024 - 4:30 PM</strong></span>
                </div>
            </div>
        </div>

        <!-- Approval History Item 2 -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border-l-4 border-green-500 hover:shadow-lg transition-shadow">
            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <h3 class="text-lg font-bold text-gray-900">#ORD-2024-041</h3>
                            <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Approved</span>
                        </div>
                        <p class="text-sm text-gray-600">Requested by: <strong>Bambang Wijaya</strong> | Sales Department</p>
                        <p class="text-sm text-gray-600">Decision Date: <strong>2024-02-28 10:15 AM</strong></p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-600 font-semibold uppercase mb-1">Decision Time</p>
                        <p class="text-sm font-bold text-green-600">Approved ✓</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4 pb-4 border-b border-gray-200">
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Vehicle</p>
                        <p class="text-sm font-medium text-gray-900">Toyota Avanza</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Date</p>
                        <p class="text-sm font-medium text-gray-900">Mar 1-3, 2024</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Driver</p>
                        <p class="text-sm font-medium text-gray-900">Budi Santoso</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Destination</p>
                        <p class="text-sm font-medium text-gray-900">Jakarta</p>
                    </div>
                </div>

                <div class="mb-4 p-4 bg-green-50 rounded-lg border border-green-200">
                    <p class="text-xs text-green-900 font-semibold uppercase mb-1">Your Notes</p>
                    <p class="text-sm text-green-900">All documentation complete. Driver has excellent track record. Vehicle is in good condition. Proceed with booking.</p>
                </div>

                <div class="flex items-center gap-4 text-sm">
                    <span class="px-3 py-1 bg-green-100 text-green-800 font-semibold rounded-full">Level 2 Approval</span>
                    <span class="text-gray-600">Approved on <strong>February 28, 2024 - 10:15 AM</strong></span>
                </div>
            </div>
        </div>

        <!-- Approval History Item 3 - Rejected -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border-l-4 border-red-500 hover:shadow-lg transition-shadow">
            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <h3 class="text-lg font-bold text-gray-900">#ORD-2024-040</h3>
                            <span class="px-3 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded-full">Rejected</span>
                        </div>
                        <p class="text-sm text-gray-600">Requested by: <strong>Eka Putri</strong> | Marketing Department</p>
                        <p class="text-sm text-gray-600">Decision Date: <strong>2024-02-25 2:45 PM</strong></p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-600 font-semibold uppercase mb-1">Decision Time</p>
                        <p class="text-sm font-bold text-red-600">Rejected ✗</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4 pb-4 border-b border-gray-200">
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Vehicle</p>
                        <p class="text-sm font-medium text-gray-900">Daihatsu Gran Max</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Date</p>
                        <p class="text-sm font-medium text-gray-900">Feb 28, 2024</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Driver</p>
                        <p class="text-sm font-medium text-gray-900">Rendra Kusuma</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Destination</p>
                        <p class="text-sm font-medium text-gray-900">Bandung</p>
                    </div>
                </div>

                <div class="mb-4 p-4 bg-red-50 rounded-lg border border-red-200">
                    <p class="text-xs text-red-900 font-semibold uppercase mb-1">Rejection Reason</p>
                    <p class="text-sm text-red-900">Vehicle scheduled for routine maintenance during requested dates (Feb 25-28). Please reschedule request for March 1st onwards. Driver Rendra is also unavailable during this period.</p>
                </div>

                <div class="flex items-center gap-4 text-sm">
                    <span class="px-3 py-1 bg-red-100 text-red-800 font-semibold rounded-full">Level 2 Approval</span>
                    <span class="text-gray-600">Rejected on <strong>February 25, 2024 - 2:45 PM</strong></span>
                </div>
            </div>
        </div>

        <!-- Approval History Item 4 -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border-l-4 border-green-500 hover:shadow-lg transition-shadow">
            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <h3 class="text-lg font-bold text-gray-900">#ORD-2024-039</h3>
                            <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Approved</span>
                        </div>
                        <p class="text-sm text-gray-600">Requested by: <strong>Hendra Gunawan</strong> | Operations Department</p>
                        <p class="text-sm text-gray-600">Decision Date: <strong>2024-02-22 11:20 AM</strong></p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-600 font-semibold uppercase mb-1">Decision Time</p>
                        <p class="text-sm font-bold text-green-600">Approved ✓</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4 pb-4 border-b border-gray-200">
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Vehicle</p>
                        <p class="text-sm font-medium text-gray-900">Mitsubishi Pajero</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Date</p>
                        <p class="text-sm font-medium text-gray-900">Feb 24-26, 2024</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Driver</p>
                        <p class="text-sm font-medium text-gray-900">Siti Nurhaliza</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Destination</p>
                        <p class="text-sm font-medium text-gray-900">Yogyakarta</p>
                    </div>
                </div>

                <div class="mb-4 p-4 bg-green-50 rounded-lg border border-green-200">
                    <p class="text-xs text-green-900 font-semibold uppercase mb-1">Your Notes</p>
                    <p class="text-sm text-green-900">Inspection visit approved. Siti is well-trained and familiar with long-distance driving. Vehicle is fully serviced. All systems go.</p>
                </div>

                <div class="flex items-center gap-4 text-sm">
                    <span class="px-3 py-1 bg-green-100 text-green-800 font-semibold rounded-full">Level 2 Approval</span>
                    <span class="text-gray-600">Approved on <strong>February 22, 2024 - 11:20 AM</strong></span>
                </div>
            </div>
        </div>

        <!-- Approval History Item 5 - Rejected -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border-l-4 border-red-500 hover:shadow-lg transition-shadow">
            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <h3 class="text-lg font-bold text-gray-900">#ORD-2024-038</h3>
                            <span class="px-3 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded-full">Rejected</span>
                        </div>
                        <p class="text-sm text-gray-600">Requested by: <strong>Kusuma Wijaya</strong> | Finance Department</p>
                        <p class="text-sm text-gray-600">Decision Date: <strong>2024-02-20 3:00 PM</strong></p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-600 font-semibold uppercase mb-1">Decision Time</p>
                        <p class="text-sm font-bold text-red-600">Rejected ✗</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4 pb-4 border-b border-gray-200">
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Vehicle</p>
                        <p class="text-sm font-medium text-gray-900">Honda CR-V</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Date</p>
                        <p class="text-sm font-medium text-gray-900">Feb 21-22, 2024</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Driver</p>
                        <p class="text-sm font-medium text-gray-900">Ahmad Riyadi</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold uppercase">Destination</p>
                        <p class="text-sm font-medium text-gray-900">Bekasi</p>
                    </div>
                </div>

                <div class="mb-4 p-4 bg-red-50 rounded-lg border border-red-200">
                    <p class="text-xs text-red-900 font-semibold uppercase mb-1">Rejection Reason</p>
                    <p class="text-sm text-red-900">Insufficient approval justification from requesting department. Purpose is vague and unclear. Please provide detailed business rationale and request again with proper documentation.</p>
                </div>

                <div class="flex items-center gap-4 text-sm">
                    <span class="px-3 py-1 bg-red-100 text-red-800 font-semibold rounded-full">Level 2 Approval</span>
                    <span class="text-gray-600">Rejected on <strong>February 20, 2024 - 3:00 PM</strong></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Summary -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8 pt-8 border-t border-gray-200">
        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6 border border-green-200">
            <p class="text-sm text-green-700 font-semibold uppercase mb-2">Total Approved</p>
            <p class="text-4xl font-bold text-green-900">47</p>
            <p class="text-xs text-green-700 mt-2">In your approval history</p>
        </div>
        <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-xl p-6 border border-red-200">
            <p class="text-sm text-red-700 font-semibold uppercase mb-2">Total Rejected</p>
            <p class="text-4xl font-bold text-red-900">5</p>
            <p class="text-xs text-red-700 mt-2">Requiring revision</p>
        </div>
        <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-6 border border-purple-200">
            <p class="text-sm text-purple-700 font-semibold uppercase mb-2">Approval Rate</p>
            <p class="text-4xl font-bold text-purple-900">90%</p>
            <p class="text-xs text-purple-700 mt-2">Historical average</p>
        </div>
    </div>
</div>
@endsection
