@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-4">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Tambah Kendaraan</h1>
        <p class="text-gray-600">Isi informasi di bawah ini untuk menambahkan kendaraan baru</p>
    </div>

    <!-- Form Card -->
    <form method="POST" action="{{ route('admin.vehicles.store') }}"
        class="bg-white rounded-xl shadow-lg p-8 space-y-8">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Plat Nomer -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Plat Nomer *</label>
                <input type="text" name="plate_number" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="e.g., B 1234 XYZ">
                @error('plate_number')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Vehicle Type -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Tipe Kendaraan *</label>
                <select name="vehicle_type" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Pilih Tipe Kendaraan</option>
                    <option value="ANGKUTAN_ORANG">Angkutan Orang</option>
                    <option value="ANGKUTAN_BARANG">Angkutan Barang</option>
                </select>
                @error('vehicle_type')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- ownership -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Tipe Kepemilikan *</label>
                <select name="ownership" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Pilih Tipe Kepemilikan</option>
                    <option value="MILIK">Milik Perusahaan</option>
                    <option value="SEWA">Sewa</option>
                </select>
                @error('ownership')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Brand -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Brand *</label>
                <input type="text" name="brand" required placeholder="e.g., Toyota Avanza"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('brand')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Destination -->
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Bahan Bakar</label>
                <input type="text" name="fuel_type"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="e.g., Solar, Pertalite, Pertamax">
                @error('fuel_type')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <!-- Form Actions -->
        <div class="flex items-center gap-4 border-gray-200">
            <button type="submit"
                class="px-8 py-3 bg-linear-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all shadow-lg">
                Tambah Kendaraan
            </button>
            <a href=""
                class="px-8 py-3 border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-all">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
