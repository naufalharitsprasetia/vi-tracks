@extends('layouts.app')
@section('content')
<!-- Vehicles Table -->
<a href="{{route('admin.vehicles.create')}}"
    class="cursor-pointer px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-all">
    Tambah Kendaraan
</a>
<div class="bg-white mt-4 rounded-xl shadow-md overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
        <h3 class="text-lg font-bold text-gray-900">Daftar Kendaraan</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Plat Nomor</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Jenis Kendaraan</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Pemilik</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Merek</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Bahan Bakar</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($vehicles as $vehicle)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $vehicle->plate_number }}</td>
                    <td class="px-6 py-4 text-gray-700">{{ $vehicle->vehicle_type }}</td>
                    <td class="px-6 py-4 text-gray-700">{{ $vehicle->ownership }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $vehicle->brand }}</td>
                    <td class="px-6 py-4 text-gray-700">{{ $vehicle->fuel_type }}</td>
                    <td class="px-6 py-4">
                        <a href="#" class="text-yellow-600 hover:text-yellow-800 font-semibold text-sm">Edit</a>
                        <a href="#" class="text-red-600 hover:text-red-800 font-semibold text-sm">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
