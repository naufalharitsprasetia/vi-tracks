@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <!-- Welcome Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white rounded-2xl p-8 shadow-lg">
        <h1 class="text-4xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}</h1>
        <p class="text-blue-100">Kelola operasi armada Anda dengan efisien menggunakan sistem komprehensif kami</p>
    </div>

    <!-- Statistics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
        <!-- Total Orders Card -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Pemesanan Kendaraan</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalOrders }}</p>
                    <p class="text-green-600 text-xs mt-2 font-semibold">+{{ $totalOrdersToday }} pemesanan hari ini</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pending Approvals Card -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-yellow-500 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Persetujuan Tertunda</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $pendingOrders }}</p>
                    <p class="text-yellow-600 text-xs mt-2 font-semibold">Butuh Perhatian</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Completed Orders Card -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Pemesanan Selesai</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $completedOrders }}</p>
                    <p class="text-green-600 text-xs mt-2 font-semibold">Berhasil diselesaikan</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Vehicle Usage Chart -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-6">Kendaraan Paling Sering Dipesan</h3>
            <canvas id="vehicleBarChart" height="120"></canvas>
        </div>

        @php
        $radius = 45;
        $circumference = 2 * pi() * $radius;

        $approved = $chartData['APPROVED'] * $circumference;
        $completed = $chartData['COMPLETED'] * $circumference;
        $pending = $chartData['PENDING'] * $circumference;
        $rejected = $chartData['REJECTED'] * $circumference;
        $inProgress = $chartData['IN_PROGRESS'] * $circumference;
        $inUse = $chartData['IN_USE'] * $circumference;

        $offset1 = 0;
        $offset2 = -$approved;
        $offset3 = -($approved + $completed);
        $offset4 = -($approved + $completed + $pending);
        $offset5 = -($approved + $completed + $pending + $rejected);
        $offset6 = -($approved + $completed + $pending + $rejected + $inProgress);
        @endphp
        <!-- Approval Status Chart -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-6">Distribusi Status Pemesanan</h3>
            <div class="flex items-center justify-center gap-8">
                <!-- Pie Chart Simulation -->
                <div class="relative w-32 h-32">
                    <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
                        <!-- Background -->
                        <circle cx="50" cy="50" r="45" fill="none" stroke="#e5e7eb" stroke-width="10" />

                        <!-- Approved -->
                        <circle cx="50" cy="50" r="45" fill="none" stroke="#3b82f6" stroke-width="10"
                            stroke-dasharray="{{ $approved }} {{ $circumference }}"
                            stroke-dashoffset="{{ $offset1 }}" />

                        <!-- Completed -->
                        <circle cx="50" cy="50" r="45" fill="none" stroke="#10b981" stroke-width="10"
                            stroke-dasharray="{{ $completed }} {{ $circumference }}"
                            stroke-dashoffset="{{ $offset2 }}" />

                        <!-- Pending -->
                        <circle cx="50" cy="50" r="45" fill="none" stroke="#f97316" stroke-width="10"
                            stroke-dasharray="{{ $pending }} {{ $circumference }}" stroke-dashoffset="{{ $offset3 }}" />

                        <!-- Rejected -->
                        <circle cx="50" cy="50" r="45" fill="none" stroke="#ef4444" stroke-width="10"
                            stroke-dasharray="{{ $rejected }} {{ $circumference }}"
                            stroke-dashoffset="{{ $offset4 }}" />

                        <!-- In Progress -->
                        <circle cx="50" cy="50" r="45" fill="none" stroke="#f59e0b" stroke-width="10"
                            stroke-dasharray="{{ $inProgress }} {{ $circumference }}"
                            stroke-dashoffset="{{ $offset5 }}" />

                        <!-- In Use -->
                        <circle cx="50" cy="50" r="45" fill="none" stroke="#8b5cf6" stroke-width="10"
                            stroke-dasharray="{{ $inUse }} {{ $circumference }}" stroke-dashoffset="{{ $offset6 }}" />
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-2xl font-bold text-gray-900">{{$totalOrders}}</span>
                    </div>
                </div>
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 bg-blue-600 rounded-full"></div>
                        <span class="text-sm text-gray-700">Approved: <strong>{{ $statusStats['APPROVED'] ?? 0
                                }}</strong></span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 bg-green-600 rounded-full"></div>
                        <span class="text-sm text-gray-700">Completed: <strong>{{ $statusStats['COMPLETED'] ?? 0
                                }}</strong></span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 bg-orange-500 rounded-full"></div>
                        <span class="text-sm text-gray-700">Pending: <strong>{{ $statusStats['PENDING'] ?? 0
                                }}</strong></span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 bg-red-600 rounded-full"></div>
                        <span class="text-sm text-gray-700">Rejected: <strong>{{ $statusStats['REJECTED'] ?? 0
                                }}</strong></span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                        <span class="text-sm text-gray-700">In Progress: <strong>{{ $statusStats['IN_PROGRESS'] ?? 0
                                }}</strong></span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 bg-purple-600 rounded-full"></div>
                        <span class="text-sm text-gray-700">In Use: <strong>{{ $statusStats['IN_USE'] ?? 0
                                }}</strong></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders Table -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-lg font-bold text-gray-900">Pemesanan Terbaru</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Order ID</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Tanggal Booking</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Tanggal Pengembalian</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Nama Pemesan</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Kendaraan</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Supir</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Aksi</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Created At</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($newestOrders as $order)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $order->order_code }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ \Carbon\Carbon::parse($order->booking_date)->format('d F
                            Y')
                            }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ \Carbon\Carbon::parse($order->return_date)->format('d F
                            Y')
                            }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $order->requester_name }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $order->vehicle->brand }} - {{
                            $order->vehicle->plate_number
                            }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $order->driver->name }}</td>
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
                        <td class="px-6 py-4">
                            <a href="#" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">View</a>
                        </td>
                        <td class="px-6 py-4 text-gray-600">{{$order->created_at}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const vehicleLabels = @json(
        $topVehicles->map(fn($v) => $v->vehicle->brand . ' (' . $v->vehicle->plate_number . ')')
    );

    const vehicleTotals = @json(
        $topVehicles->pluck('total_orders')
    );

    const ctx = document.getElementById('vehicleBarChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: vehicleLabels,
            datasets: [{
                label: 'Jumlah Pemesanan',
                data: vehicleTotals,
                backgroundColor: '#3b82f6',
                borderRadius: 8,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.raw + ' kali dipesan';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>
@endsection
