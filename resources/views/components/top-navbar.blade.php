<!-- Top Navigation Bar -->
<nav class="bg-white dark:bg-slate-900 shadow-sm border-b border-gray-200 dark:border-gray-700 sticky top-0 z-50">
    <div class="px-8 py-4 flex items-center justify-between">
        <!-- Left: Page Title -->
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                Dashboard
                {{-- Dashboard / title --}}
            </h2>

            <p class="text-sm text-gray-500 dark:text-gray-400">Welcome, {{ auth()->user()->name }}</p>
        </div>

        <!-- Right: User Menu -->
        <div class="flex items-center gap-4">
            @if (auth()->user()->role === 'admin')
            {{-- Logs --}}
            <a href="{{ route('admin.logs') }}"
                class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-3 py-2 rounded-lg text-sm font-medium hover:bg-gray-300 dark:hover:bg-gray-600 cursor-pointer">
                Logs
            </a>
            @endif

            <!-- User Profile -->
            <div class="flex items-center gap-3 pl-4 border-l border-gray-200 dark:border-gray-700">
                <div
                    class="w-10 h-10 bg-linear-to-br from-blue-400 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 capitalize">{{ auth()->user()->title }}</p>
                </div>
            </div>
        </div>
    </div>
</nav>
