<!-- Admin Sidebar Navigation -->
<aside class="w-64 bg-linear-to-b from-blue-600 to-blue-800 text-white shadow-2xl">
    <div class="p-6">
        <div class="flex items-center gap-3 mb-8">
            <div class="w-10 h-10 bg-blue-400 rounded-lg flex items-center justify-center font-bold">
                VT
            </div>
            <h1 class="text-2xl font-bold">Vi-Tracks</h1>
        </div>

        <nav class="space-y-2">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all {{ request()->routeIs('dashboard') ? 'bg-blue-500' : 'hover:bg-blue-600' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 3l3 3m0 0l3-3m-3 3V5" />
                </svg>
                <span class="font-medium">Dashboard</span>
            </a>

            @if (auth()->user()->role === 'admin')
            <!-- Orders -->
            <div class="px-4 py-2">
                <p class="text-xs uppercase font-semibold text-blue-200 mb-2">Pemesanan Kendaraan</p>
                <a href="{{ route('admin.orders') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm transition-all {{ request()->routeIs('admin.orders') ? 'bg-blue-500' : 'hover:bg-blue-600' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <span>Semua Pemesanan</span>
                </a>
                <a href="{{ route('admin.orders.create')}}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm transition-all mt-1 {{ request()->routeIs('admin.orders.create') ? 'bg-blue-500' : 'hover:bg-blue-600' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Buat Pemesanan</span>
                </a>
            </div>

            <!-- Drivers -->
            <div class="px-4 py-2">
                <p class="text-xs uppercase font-semibold text-blue-200 mb-2">Manajemen</p>
                <a href="{{ route('admin.drivers') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm transition-all {{ request()->routeIs('admin.drivers*') ? 'bg-blue-500' : 'hover:bg-blue-600' }}">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                        <path fill="rgb(255, 255, 255)"
                            d="M32 160C32 124.7 60.7 96 96 96L544 96C579.3 96 608 124.7 608 160L32 160zM32 208L608 208L608 480C608 515.3 579.3 544 544 544L96 544C60.7 544 32 515.3 32 480L32 208zM279.3 480C299.5 480 314.6 460.6 301.7 445C287 427.3 264.8 416 240 416L176 416C151.2 416 129 427.3 114.3 445C101.4 460.6 116.5 480 136.7 480L279.2 480zM208 376C238.9 376 264 350.9 264 320C264 289.1 238.9 264 208 264C177.1 264 152 289.1 152 320C152 350.9 177.1 376 208 376zM392 272C378.7 272 368 282.7 368 296C368 309.3 378.7 320 392 320L504 320C517.3 320 528 309.3 528 296C528 282.7 517.3 272 504 272L392 272zM392 368C378.7 368 368 378.7 368 392C368 405.3 378.7 416 392 416L504 416C517.3 416 528 405.3 528 392C528 378.7 517.3 368 504 368L392 368z" />
                    </svg>
                    <span>Supir</span>
                </a>
                <a href="{{ route('admin.vehicles') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm transition-all {{ request()->routeIs('admin.vehicles*') ? 'bg-blue-500' : 'hover:bg-blue-600' }}">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                        <path fill="rgb(255, 255, 255)"
                            d="M199.2 181.4L173.1 256L466.9 256L440.8 181.4C436.3 168.6 424.2 160 410.6 160L229.4 160C215.8 160 203.7 168.6 199.2 181.4zM103.6 260.8L138.8 160.3C152.3 121.8 188.6 96 229.4 96L410.6 96C451.4 96 487.7 121.8 501.2 160.3L536.4 260.8C559.6 270.4 576 293.3 576 320L576 512C576 529.7 561.7 544 544 544L512 544C494.3 544 480 529.7 480 512L480 480L160 480L160 512C160 529.7 145.7 544 128 544L96 544C78.3 544 64 529.7 64 512L64 320C64 293.3 80.4 270.4 103.6 260.8zM192 368C192 350.3 177.7 336 160 336C142.3 336 128 350.3 128 368C128 385.7 142.3 400 160 400C177.7 400 192 385.7 192 368zM480 400C497.7 400 512 385.7 512 368C512 350.3 497.7 336 480 336C462.3 336 448 350.3 448 368C448 385.7 462.3 400 480 400z" />
                    </svg>
                    <span>Kendaraan</span>
                </a>
            </div>

            <!-- Reports -->
            <div class="px-4 py-2">
                <p class="text-xs uppercase font-semibold text-blue-200 mb-2">Analisis</p>
                <a href="{{route('admin.reports')}}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm transition-all {{ request()->routeIs('admin.reports') ? 'bg-blue-500' : 'hover:bg-blue-600' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <span>Laporan</span>
                </a>
            </div>
            @endif

            @if (auth()->user()->role === 'approver')
            {{-- Jika Approver --}}
            <!-- Pending Approvals -->
            <div class="px-4 py-2">
                <p class="text-xs uppercase font-semibold text-indigo-200 mb-2">Approvals</p>
                <a href="{{ route('approver.pending') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm transition-all {{ request()->routeIs('approver.pending.*') ? 'bg-indigo-500' : 'hover:bg-indigo-700' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Pending Orders</span>
                </a>
                <a href="{{ route('approver.history') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm transition-all {{ request()->routeIs('approver.history.*') ? 'bg-indigo-500' : 'hover:bg-indigo-700' }} mt-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Approval History</span>
                </a>
            </div>
            @endif
        </nav>
    </div>

    <!-- Sidebar Footer -->
    <div class="absolute bottom-0 w-64 p-6 border-t border-blue-700">
        <form action="{{ route('logout') }}" method="POST" class="w-full">
            @csrf
            <button type="submit"
                class="w-full flex items-center gap-3 px-4 py-2 rounded-lg bg-blue-500 hover:bg-red-600 transition-all font-medium cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>
