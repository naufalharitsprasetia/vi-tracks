@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Buat Pemesanan Kendaraan</h1>
        <p class="text-gray-600">Isi informasi di bawah ini untuk membuat permintaan reservasi kendaraan</p>
    </div>

    <!-- Form Card -->
    <form method="POST" action="{{ route('admin.orders.store') }}" class="bg-white rounded-xl shadow-lg p-8 space-y-8">
        @csrf

        <!-- Section 1: Basic Information -->
        <div class="border-b border-gray-200 pb-8">
            <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                <span
                    class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-bold">1</span>
                Informasi Dasar
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Requester Name -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Pemesan *</label>
                    <input type="text" name="requester_name" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Fulan Ahmad">
                    @error('requester_name')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Department -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Department *</label>
                    <select name="department" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Pilih Department</option>
                        <option value="Sales">Sales</option>
                        <option value="Marketing">Marketing</option>
                        <option value="Operations">Operations</option>
                        <option value="Management">Management</option>
                        <option value="HR">HR</option>
                    </select>
                    @error('department')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Booking Date -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Booking *</label>
                    <input type="date" name="booking_date" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('booking_date')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Return Date -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Kembali *</label>
                    <input type="date" name="return_date" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('return_date')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Destination -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tujuan/Keperluan *</label>
                    <input type="text" name="destination" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="e.g., Pertemuan dengan klien di Jakarta">
                    @error('destination')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Number of Passengers -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah Penumpang *</label>
                    <input type="number" name="passengers" min="1" max="10" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="5">
                    @error('passengers')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Vehicle Type -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Kendaraan *</label>
                    <select name="vehicle_type" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Pilih Jenis Kendaraan</option>
                        @foreach ($vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}">{{ $vehicle->brand }} - {{ $vehicle->plate_number }} - {{
                            $vehicle->vehicle_type }}</option>
                        @endforeach
                    </select>
                    @error('vehicle_type')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Section 2: Driver & Approval Assignment -->
        <div class="border-b border-gray-200 pb-8">
            <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                <span
                    class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-bold">2</span>
                Pilih Supir dan Pihak Yang Menyetujui
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Driver Selection -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Supir *</label>
                    <select name="driver_id" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Pilih Supir</option>
                        @foreach ($drivers as $driver)
                        <option value="{{ $driver->id }}">{{ $driver->name }} - Tersedia</option>
                        @endforeach
                    </select>
                    @error('driver_id')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Priority Level -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Level Prioritas *</label>
                    <select name="priority" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="normal">Normal</option>
                        <option value="high">High</option>
                        <option value="urgent">Urgent</option>
                    </select>
                    @error('priority')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- First Level Approver -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Level 1 Approver (Manager) *</label>
                    <select name="approver_level1" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Pilih Pihak Menyetujui</option>
                        @foreach ($approverLevel1 as $approver)
                        <option value="{{ $approver->id }}">{{ $approver->name }} - {{ $approver->title }}</option>
                        @endforeach
                    </select>
                    @error('approver_level1')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Second Level Approver -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Level 2 Approver (Director) *</label>
                    <select name="approver_level2" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Pilih Pihak Menyetujui</option>
                        @foreach ($approverLevel2 as $approver)
                        <option value="{{ $approver->id }}">{{ $approver->name }} - {{ $approver->title }}</option>
                        @endforeach
                    </select>
                    @error('approver_level2')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Approval Flow Info -->
            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                <p class="text-sm text-blue-900 font-semibold mb-2">Hierarki Proses Persetujuan:</p>
                <div class="flex items-center gap-4 text-sm">
                    <div class="text-center">
                        <div
                            class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-sm">
                            1</div>
                        <p class="text-xs mt-1">Admin<br>Creates</p>
                    </div>
                    <div class="text-blue-600 font-bold text-lg">→</div>
                    <div class="text-center">
                        <div
                            class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-sm">
                            2</div>
                        <p class="text-xs mt-1">Manager<br>Reviews</p>
                    </div>
                    <div class="text-blue-600 font-bold text-lg">→</div>
                    <div class="text-center">
                        <div
                            class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-sm">
                            3</div>
                        <p class="text-xs mt-1">Director<br>Approves</p>
                    </div>
                    <div class="text-blue-600 font-bold text-lg">→</div>
                    <div class="text-center">
                        <div
                            class="w-10 h-10 bg-green-600 text-white rounded-full flex items-center justify-center font-bold text-sm">
                            ✓</div>
                        <p class="text-xs mt-1">Complete</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 3: Additional Notes -->
        <div class="pb-8">
            <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                <span
                    class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-bold">3</span>
                Catatan Tambahan
            </h2>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Permintaan Khusus/Catatan</label>
                <textarea name="notes" rows="4"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="permintaan khusus atau catatan tambahan untuk supir and pihak yang menyetujui..."></textarea>
                @error('notes')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex items-center gap-4 pt-8 border-t border-gray-200">
            <button type="submit"
                class="cursor-pointer px-8 py-3 bg-linear-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all shadow-lg">
                Buat Pesanan
            </button>
            <a href=""
                class="cursor-pointer px-8 py-3 border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-all">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
