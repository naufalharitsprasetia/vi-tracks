@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div>
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Reports & Analytics</h1>
        <p class="text-gray-600">Generate and export vehicle ordering reports for analysis</p>
    </div>

    <!-- Report Type Tabs -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="flex gap-0 border-b border-gray-200">
            <button class="flex-1 px-6 py-4 text-sm font-semibold text-gray-700 border-b-2 border-blue-600 text-blue-600 bg-blue-50 hover:bg-blue-100 transition-colors" onclick="switchTab(event, 'monthly')">
                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Monthly Report
            </button>
            <button class="flex-1 px-6 py-4 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-colors" onclick="switchTab(event, 'driver')">
                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 12H9m6 0H9m6 0h.01M9 12h.01M15 12h.01M9 12H9.01" />
                </svg>
                Driver Report
            </button>
            <button class="flex-1 px-6 py-4 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-colors" onclick="switchTab(event, 'vehicle')">
                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h11a2 2 0 012 2v2m-5 10v5a2 2 0 01-2 2H9a2 2 0 01-2-2v-5m0 0H4m15 0H9" />
                </svg>
                Vehicle Report
            </button>
            <button class="flex-1 px-6 py-4 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-colors" onclick="switchTab(event, 'summary')">
                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                Summary Report
            </button>
        </div>

        <div class="p-8">
            <!-- Monthly Report Tab -->
            <div id="monthly" class="report-tab">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Monthly Vehicle Orders Report</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Start Date</label>
                        <input type="date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">End Date</label>
                        <input type="date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="flex items-end gap-2">
                        <button class="flex-1 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-all">
                            Generate
                        </button>
                        <button onclick="exportReport('monthly')" class="flex-1 px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition-all flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Export Excel
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-100 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Month</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Total Orders</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Approved</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Rejected</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Pending</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Approval Rate</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">January 2024</td>
                                <td class="px-6 py-4 text-gray-700">45</td>
                                <td class="px-6 py-4 text-green-700 font-semibold">42</td>
                                <td class="px-6 py-4 text-red-700 font-semibold">2</td>
                                <td class="px-6 py-4 text-yellow-700 font-semibold">1</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-24 bg-gray-200 rounded-full h-2">
                                            <div class="bg-green-600 h-2 rounded-full" style="width: 93%"></div>
                                        </div>
                                        <span class="text-sm font-semibold text-gray-700">93%</span>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">February 2024</td>
                                <td class="px-6 py-4 text-gray-700">52</td>
                                <td class="px-6 py-4 text-green-700 font-semibold">48</td>
                                <td class="px-6 py-4 text-red-700 font-semibold">3</td>
                                <td class="px-6 py-4 text-yellow-700 font-semibold">1</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-24 bg-gray-200 rounded-full h-2">
                                            <div class="bg-green-600 h-2 rounded-full" style="width: 92%"></div>
                                        </div>
                                        <span class="text-sm font-semibold text-gray-700">92%</span>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">March 2024</td>
                                <td class="px-6 py-4 text-gray-700">58</td>
                                <td class="px-6 py-4 text-green-700 font-semibold">53</td>
                                <td class="px-6 py-4 text-red-700 font-semibold">4</td>
                                <td class="px-6 py-4 text-yellow-700 font-semibold">1</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-24 bg-gray-200 rounded-full h-2">
                                            <div class="bg-green-600 h-2 rounded-full" style="width: 91%"></div>
                                        </div>
                                        <span class="text-sm font-semibold text-gray-700">91%</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Driver Report Tab -->
            <div id="driver" class="report-tab hidden">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Driver Performance Report</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Select Driver</label>
                        <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">All Drivers</option>
                            <option value="1">Budi Santoso</option>
                            <option value="2">Ahmad Riyadi</option>
                            <option value="3">Siti Nurhaliza</option>
                        </select>
                    </div>
                    <div class="flex items-end gap-2">
                        <button class="flex-1 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-all">
                            Generate
                        </button>
                        <button onclick="exportReport('driver')" class="flex-1 px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition-all flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Export Excel
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-4 border border-blue-200">
                        <p class="text-sm text-blue-700 font-semibold">Total Trips</p>
                        <p class="text-3xl font-bold text-blue-900 mt-2">156</p>
                    </div>
                    <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg p-4 border border-green-200">
                        <p class="text-sm text-green-700 font-semibold">On-Time Delivery</p>
                        <p class="text-3xl font-bold text-green-900 mt-2">98%</p>
                    </div>
                    <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-lg p-4 border border-purple-200">
                        <p class="text-sm text-purple-700 font-semibold">Avg Rating</p>
                        <p class="text-3xl font-bold text-purple-900 mt-2">4.8/5</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-100 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Driver Name</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Total Trips</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">On Time %</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Avg Rating</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">Budi Santoso</td>
                                <td class="px-6 py-4 text-gray-700">42</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-16 bg-gray-200 rounded-full h-2">
                                            <div class="bg-green-600 h-2 rounded-full" style="width: 98%"></div>
                                        </div>
                                        <span class="text-sm font-semibold">98%</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">4.9/5 ⭐</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Active</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">Ahmad Riyadi</td>
                                <td class="px-6 py-4 text-gray-700">38</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-16 bg-gray-200 rounded-full h-2">
                                            <div class="bg-green-600 h-2 rounded-full" style="width: 95%"></div>
                                        </div>
                                        <span class="text-sm font-semibold">95%</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">4.7/5 ⭐</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Active</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">Siti Nurhaliza</td>
                                <td class="px-6 py-4 text-gray-700">32</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-16 bg-gray-200 rounded-full h-2">
                                            <div class="bg-green-600 h-2 rounded-full" style="width: 97%"></div>
                                        </div>
                                        <span class="text-sm font-semibold">97%</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">4.8/5 ⭐</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Active</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Vehicle Report Tab -->
            <div id="vehicle" class="report-tab hidden">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Vehicle Utilization Report</h3>
                
                <div class="flex items-end gap-2 mb-6">
                    <button class="flex-1 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-all max-w-xs">
                        Generate
                    </button>
                    <button onclick="exportReport('vehicle')" class="flex-1 px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition-all flex items-center justify-center gap-2 max-w-xs">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Export Excel
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-100 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Vehicle Name</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Plate Number</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Total Usage</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Utilization %</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">Toyota Avanza</td>
                                <td class="px-6 py-4 text-gray-700">B 1234 ABC</td>
                                <td class="px-6 py-4 text-gray-700">78 trips</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-20 bg-gray-200 rounded-full h-2">
                                            <div class="bg-blue-600 h-2 rounded-full" style="width: 78%"></div>
                                        </div>
                                        <span class="text-sm font-semibold">78%</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">In Use</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">Honda CR-V</td>
                                <td class="px-6 py-4 text-gray-700">B 5678 DEF</td>
                                <td class="px-6 py-4 text-gray-700">65 trips</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-20 bg-gray-200 rounded-full h-2">
                                            <div class="bg-indigo-600 h-2 rounded-full" style="width: 65%"></div>
                                        </div>
                                        <span class="text-sm font-semibold">65%</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Available</span>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">Mitsubishi Pajero</td>
                                <td class="px-6 py-4 text-gray-700">B 9012 GHI</td>
                                <td class="px-6 py-4 text-gray-700">52 trips</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-20 bg-gray-200 rounded-full h-2">
                                            <div class="bg-purple-600 h-2 rounded-full" style="width: 52%"></div>
                                        </div>
                                        <span class="text-sm font-semibold">52%</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded-full">Maintenance</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Summary Report Tab -->
            <div id="summary" class="report-tab hidden">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Executive Summary Report</h3>
                
                <div class="flex items-end gap-2 mb-6">
                    <button class="flex-1 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-all max-w-xs">
                        Generate
                    </button>
                    <button onclick="exportReport('summary')" class="flex-1 px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition-all flex items-center justify-center gap-2 max-w-xs">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Export Excel
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-6 border border-blue-200">
                        <p class="text-sm text-blue-700 font-semibold uppercase">Total Orders (Last 30 Days)</p>
                        <p class="text-4xl font-bold text-blue-900 mt-2">156</p>
                        <p class="text-xs text-blue-700 mt-2">↑ 12% from previous period</p>
                    </div>
                    <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg p-6 border border-green-200">
                        <p class="text-sm text-green-700 font-semibold uppercase">Approval Rate</p>
                        <p class="text-4xl font-bold text-green-900 mt-2">92%</p>
                        <p class="text-xs text-green-700 mt-2">142 approved orders</p>
                    </div>
                    <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-lg p-6 border border-yellow-200">
                        <p class="text-sm text-yellow-700 font-semibold uppercase">Pending Review</p>
                        <p class="text-4xl font-bold text-yellow-900 mt-2">8</p>
                        <p class="text-xs text-yellow-700 mt-2">Awaiting approver action</p>
                    </div>
                    <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-lg p-6 border border-red-200">
                        <p class="text-sm text-red-700 font-semibold uppercase">Rejection Rate</p>
                        <p class="text-4xl font-bold text-red-900 mt-2">6%</p>
                        <p class="text-xs text-red-700 mt-2">6 rejected orders</p>
                    </div>
                </div>

                <div class="mt-6 bg-white rounded-lg border border-gray-200 p-6">
                    <h4 class="text-lg font-bold text-gray-900 mb-4">Key Metrics</h4>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-700 font-medium">Average Processing Time</span>
                            <span class="text-2xl font-bold text-gray-900">2.5 days</span>
                        </div>
                        <div class="border-t border-gray-200"></div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-700 font-medium">Most Active Driver</span>
                            <span class="text-lg font-bold text-gray-900">Budi Santoso (42 trips)</span>
                        </div>
                        <div class="border-t border-gray-200"></div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-700 font-medium">Most Used Vehicle</span>
                            <span class="text-lg font-bold text-gray-900">Toyota Avanza (78% utilization)</span>
                        </div>
                        <div class="border-t border-gray-200"></div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-700 font-medium">Fleet Efficiency Score</span>
                            <span class="text-lg font-bold text-green-600">8.7/10</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
