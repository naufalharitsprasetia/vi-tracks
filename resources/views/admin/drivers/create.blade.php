@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-4">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Tambah Supir</h1>
        <p class="text-gray-600">Isi informasi di bawah ini untuk menambahkan supir baru</p>
    </div>

    <!-- Form Card -->
    <form method="POST" action="{{ route('admin.drivers.store') }}" class="bg-white rounded-xl shadow-lg p-8 space-y-8">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Nama Supir -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Supir *</label>
                <input type="text" name="name" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="e.g., John Doe">
                @error('name')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Telepon *</label>
                <input type="text" name="phone" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="e.g., 08123456789">
                @error('phone')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- License Number -->
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor SIM *</label>
                <input type="text" name="license_number" required placeholder="e.g., SIM-A-002"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('license_number')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Addresss -->
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat</label>
                <input type="text" name="address" placeholder="e.g., Jl. Merdeka No. 123, Jakarta"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('address')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <!-- Form Actions -->
        <div class="flex items-center gap-4 border-gray-200">
            <button type="submit"
                class="px-8 py-3 bg-linear-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all shadow-lg">
                Tambah Supir
            </button>
            <a href=""
                class="px-8 py-3 border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-all">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
