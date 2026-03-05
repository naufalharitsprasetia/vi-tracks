@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <!-- Welcome Section -->
    <div class="bg-linear-to-r from-indigo-600 to-purple-800 text-white rounded-2xl p-8 shadow-lg">
        <h1 class="text-4xl font-bold mb-2">Selamat Datang, {{ auth()->user()->name }}</h1>
        <p class="text-indigo-100">Tinjau dan setujui/tolak pemesanan kendaraan secara efisien</p>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Pending Orders Card -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-yellow-500 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Tinjauan yang Tertunda</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $pendingApprovals->count() }}</p>
                    <p class="text-yellow-600 text-xs mt-2 font-semibold">Menunggu tindakan Anda</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Approved Card -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Disetujui Bulan Ini</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalApproved }}</p>
                    <p class="text-green-600 text-xs mt-2 font-semibold">Berhasil diproses</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Rejected Card -->
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-red-500 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Ditolak Bulan Ini</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalRejected }}</p>
                    <p class="text-red-600 text-xs mt-2 font-semibold">Tidak disetujui</p>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 14l-2-2m0 0l-2-2m2 2l2-2m-2 2l-2 2" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Approval Priority Information -->
    @if(auth()->user()->approval_level == 1)
    {{-- Level 1 --}}
    <div class="bg-indigo-50 border border-indigo-200 rounded-xl p-6">
        <h3 class="text-lg font-bold text-indigo-900 mb-4">Tingkat Persetujuan Anda</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-sm text-indigo-700 mb-2"><strong>Peran Saat Ini:</strong> Level 1 (Manager)</p>
                <p class="text-sm text-indigo-700"><strong>Lingkup Persetujuan:</strong> Melakukan peninjauan awal
                    pemesanan kendaraan untuk memastikan kesesuaian kebutuhan operasional dan jadwal sebelum
                    diteruskan ke persetujuan berikutnya.</p>
            </div>
            <div class="bg-white rounded-lg p-4 border border-indigo-200">
                <p class="text-xs font-semibold text-indigo-900 mb-2">ALUR PERSETUJUAN:</p>
                <div class="flex items-center gap-2 text-xs">
                    <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded">Admin Membuat Pesanan</span>
                    <span class="text-gray-400">→</span>
                    <span class="px-2 py-1 bg-indigo-600 text-white rounded">Anda Meninjau & Menyetujui</span>
                    <span class="text-gray-400">→</span>
                    <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded">Director Persetujuan Akhir</span>
                </div>
            </div>
        </div>
    </div>
    @else
    {{-- Level 2 --}}
    <div class="bg-indigo-50 border border-indigo-200 rounded-xl p-6">
        <h3 class="text-lg font-bold text-indigo-900 mb-4">Tingkat Persetujuan Anda</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-sm text-indigo-700 mb-2"><strong>Peran Saat Ini:</strong> Level 2 (Director)</p>
                <p class="text-sm text-indigo-700"><strong>Lingkup Persetujuan:</strong> Otoritas persetujuan akhir
                    untuk semua pesanan</p>
            </div>
            <div class="bg-white rounded-lg p-4 border border-indigo-200">
                <p class="text-xs font-semibold text-indigo-900 mb-2">ALUR PERSETUJUAN:</p>
                <div class="flex items-center gap-2 text-xs">
                    <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded">Admin Membuat Pesanan</span>
                    <span class="text-gray-400">→</span>
                    <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded">Manajer Meninjau Pesanan</span>
                    <span class="text-gray-400">→</span>
                    <span class="px-2 py-1 bg-indigo-600 text-white rounded">Anda Menyetujui</span>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Pending Orders to Review -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
            <h3 class="text-lg font-bold text-gray-900">Orders Pending Your Approval</h3>
            <a href="" class="text-indigo-600 hover:text-indigo-800 font-semibold text-sm">View All →</a>
        </div>

        <div class="divide-y divide-gray-200">
            @foreach ($pendingApprovals as $approval)
            <!-- Order Card 1 -->
            <div class="p-6 hover:bg-gray-50 transition-colors border-l-4 border-yellow-500">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h4 class="text-lg font-bold text-gray-900">{{ $approval->order->order_code }}</h4>
                        <p class="text-sm text-gray-600">Requested by: {{ $approval->order->requester_name }}
                            ({{$approval->order->department}} Departement)</p>
                    </div>
                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">Awaiting
                        Level 2</span>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                    <div>
                        <p class="text-xs text-gray-600 font-semibold">Kendaraan</p>
                        <p class="text-sm font-medium text-gray-900">{{$approval->order->vehicle->brand}}
                            ({{$approval->order->vehicle->plate_number}})</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold">Date</p>
                        <p class="text-sm font-medium text-gray-900">{{ $approval->order->booking_date }} s/d {{
                            $approval->order->return_date }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold">Driver</p>
                        <p class="text-sm font-medium text-gray-900">{{ $approval->order->driver->name }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600 font-semibold">Priority</p>
                        @php
                        if($approval->order->priority == 'urgent') {
                        $textPriority = 'text-red-600';
                        } elseif($approval->order->priority == 'high') {
                        $textPriority = 'text-yellow-600';
                        } else {
                        $textPriority = 'text-blue-600';
                        }
                        @endphp
                        <p class="text-sm font-medium {{ $textPriority }}">{{ $approval->order->priority }}</p>
                    </div>
                </div>

                <p class="text-sm text-gray-600 mb-1"><strong>Destination/Purpose:</strong> {{
                    $approval->order->destination }}
                </p>
                <p class="text-xs text-gray-600 mb-4"><strong>Additional Notes:</strong> {{
                    $approval->order->notes }}
                </p>

                @if($approval->level == 1)
                <!-- Approval Timeline level 1 -->
                <div class="bg-gray-50 rounded-lg p-4 mb-4 text-xs">
                    <p class="font-semibold text-gray-700 mb-3">Approval Status:</p>
                    <div class="flex items-center gap-3">
                        <div class="text-center">
                            <div
                                class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center text-sm font-bold">
                                ✓</div>
                            <p class="text-xs mt-1 text-gray-600">Admin<br>Created</p>
                        </div>
                        <div class="flex-1 border-b-2 border-yellow-300"></div>
                        <div class="text-center">
                            <div
                                class="w-8 h-8 bg-yellow-400 text-white rounded-full flex items-center justify-center text-sm font-bold">
                                ?</div>
                            <p class="text-xs mt-1 text-gray-600">Manager<br>Approved</p>
                        </div>
                        <div class="flex-1 border-b-2 border-gray-300"></div>
                        <div class="text-center">
                            <div
                                class="w-8 h-8 bg-yellow-400 text-white rounded-full flex items-center justify-center text-sm font-bold">
                                ?</div>
                            <p class="text-xs mt-1 text-gray-600">Director<br>Pending</p>
                        </div>
                    </div>
                </div>
                @elseif($approval->level == 2)
                <!-- Approval Timeline level 2 -->
                <div class="bg-gray-50 rounded-lg p-4 mb-4 text-xs">
                    <p class="font-semibold text-gray-700 mb-3">Approval Status:</p>
                    <div class="flex items-center gap-3">
                        <div class="text-center">
                            <div
                                class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center text-sm font-bold">
                                ✓</div>
                            <p class="text-xs mt-1 text-gray-600">Admin<br>Created</p>
                        </div>
                        <div class="flex-1 border-b-2 border-green-500"></div>
                        <div class="text-center">
                            <div
                                class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center text-sm font-bold">
                                ✓</div>
                            <p class="text-xs mt-1 text-gray-600">Manager<br>Approved</p>
                        </div>
                        <div class="flex-1 border-b-2 border-gray-300"></div>
                        <div class="text-center">
                            <div
                                class="w-8 h-8 bg-yellow-400 text-white rounded-full flex items-center justify-center text-sm font-bold">
                                ?</div>
                            <p class="text-xs mt-1 text-gray-600">Director<br>Pending</p>
                        </div>
                    </div>
                </div>
                @endif
                <div class="flex gap-3">
                    <button onclick="openApprovalModal({{$approval->id}})"
                        class="cursor-pointer flex-1 px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition-all">
                        Approve
                    </button>
                    <button onclick="openRejectionModal({{$approval->id}})"
                        class="cursor-pointer flex-1 px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-all">
                        Reject
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Approval Modal -->
<div id="approvalModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-6">
        <h3 class="text-xl font-bold text-gray-900 mb-4">Approve Order</h3>
        <form method="POST" id="approvalForm">
            @csrf
            <p class="text-gray-600 mb-4">Are you sure you want to approve this order? The requester will be notified.
            </p>
            <textarea placeholder="Add approval notes (optional)" name="note"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 mb-4"
                rows="3"></textarea>
            <div class="flex gap-3">
                <button onclick="closeApprovalModal()" type="button"
                    class="cursor-pointer flex-1 px-4 py-2 border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-all">
                    Cancel
                </button>
                <button onclick="submitApproval()"
                    class="cursor-pointer flex-1 px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition-all">
                    Confirm Approval
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Rejection Modal -->
<div id="rejectionModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-6">
        <h3 class="text-xl font-bold text-gray-900 mb-4">Reject Order</h3>
        <form method="POST" id="rejectionForm">
            @csrf
            <p class="text-gray-600 mb-4">Please provide a reason for rejection:</p>
            <textarea placeholder="Reason for rejection..." name="note" required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 mb-4"
                rows="3" required></textarea>
            <div class="flex gap-3">
                <button onclick="closeRejectionModal()" type="button"
                    class="cursor-pointer flex-1 px-4 py-2 border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-all">
                    Cancel
                </button>
                <button onclick="submitRejection()"
                    class="cursor-pointer lex-1 px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-all">
                    Confirm Rejection
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openApprovalModal(id) {
    const form = document.getElementById('approvalForm');
    form.action = `/approval-approve/${id}`;
    document.getElementById('approvalModal').classList.remove('hidden');
}

function closeApprovalModal() {
    document.getElementById('approvalModal').classList.add('hidden');
}

function openRejectionModal(id) {
    const form = document.getElementById('rejectionForm');
    form.action = `/approval-reject/${id}`;
    document.getElementById('rejectionModal').classList.remove('hidden');
}

function closeRejectionModal() {
    document.getElementById('rejectionModal').classList.add('hidden');
}
</script>
@endsection
