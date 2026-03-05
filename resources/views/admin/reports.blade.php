@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div>
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Reports & Analytics</h1>
        <p class="text-gray-600">Generate and export vehicle ordering reports for analysis</p>
    </div>

    <!-- Report Type Tabs -->
    <form action="">
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="flex gap-0 border-b border-gray-200">
                <button
                    class="flex-1 px-6 py-4 text-sm font-semibold text-gray-700 border-b-2 border-blue-600 text-blue-600 bg-blue-50 hover:bg-blue-100 transition-colors"
                    onclick="switchTab(event, 'daily')">
                    <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Daily Report
                </button>
            </div>

            <div class="p-8">
                <!-- Daily Report Tab -->
                <div id="daily" class="report-tab">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Daily Vehicle Orders Report</h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Start Date</label>
                            <input type="date" name="tabDaily_startDate" value="{{$tabDailyStartDate}}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">End Date</label>
                            <input type="date" name="tabDaily_endDate" value="{{$tabDailyEndDate}}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="flex items-end gap-2">
                            <button type="submit"
                                class="cursor-pointer flex-1 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-all">
                                Generate
                            </button>
                            <a target="_blank"
                                href="{{ route('admin.reports.daily.export', ['start_date' => $tabDailyStartDate,'end_date' => $tabDailyEndDate]) }}"
                                class="flex-1 px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition-all flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                Export Excel
                            </a>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-100 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Created Date
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Order ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Requester Name
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Vehicle</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($ordersDaily as $order)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium text-gray-900">{{$order->created_at}}
                                    </td>
                                    <td class="px-6 py-4 text-gray-700">{{$order->order_code}}</td>
                                    <td class="px-6 py-4 text-gray-700">{{$order->requester_name}}</td>
                                    <td class="px-6 py-4 text-gray-700">{{$order->vehicle->brand}}</td>
                                    @php
                                    if($order->status == 'APPROVED') {
                                    $statusClass = 'bg-green-100 text-green-800';
                                    } elseif($order->status == 'PENDING') {
                                    $statusClass = 'bg-yellow-100 text-yellow-800';
                                    } elseif($order->status == 'REJECTED') {
                                    $statusClass = 'bg-red-100 text-red-800';
                                    } else {
                                    $statusClass = 'bg-gray-100 text-gray-800';
                                    }
                                    @endphp
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 {{ $statusClass }} text-xs font-semibold rounded-full">{{
                                            $order->status }}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function switchTab(event, tabName) {
        event.preventDefault();

        // Hide all tabs
        document.querySelectorAll('.report-tab').forEach(tab => {
            tab.classList.add('hidden');
        });

        // Remove active state from all buttons
        document.querySelectorAll('[onclick*="switchTab"]').forEach(btn => {
            btn.classList.remove('border-b-2', 'border-blue-600', 'text-blue-600', 'bg-blue-50');
            btn.classList.add('hover:bg-gray-50');
        });

        // Show selected tab
        document.getElementById(tabName).classList.remove('hidden');

        // Add active state to clicked button
        event.target.closest('button').classList.add('border-b-2', 'border-blue-600', 'text-blue-600', 'bg-blue-50');
    }

    function exportReport(reportType) {
        alert('Exporting ' + reportType + ' report to Excel...');
        // Simulasi download
        console.log('Exporting:', reportType);
    }
</script>
@endsection
