@extends('layouts.app')
@section('content')
<!-- Orders Table -->
<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
        <h3 class="text-lg font-bold text-gray-900">Pemesanan Kendaraan</h3>
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
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($orders as $order)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $order->order_code }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ \Carbon\Carbon::parse($order->booking_date)->format('d F Y')
                        }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ \Carbon\Carbon::parse($order->return_date)->format('d F Y')
                        }}</td>
                    <td class="px-6 py-4 text-gray-700">{{ $order->requester_name }}</td>
                    <td class="px-6 py-4 text-gray-700">{{ $order->vehicle->brand }} - {{ $order->vehicle->plate_number
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
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
