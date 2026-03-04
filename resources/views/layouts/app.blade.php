<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Vi-Tracks App')</title>

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [data-theme="dark"] {
            --background: 15 23 42;
            --foreground: 248 250 252;
            --muted: 30 41 59;
            --muted-foreground: 148 163 184;
            --popover: 15 23 42;
            --popover-foreground: 248 250 252;
        }

        [data-theme="light"] {
            --background: 255 255 255;
            --foreground: 15 23 42;
            --muted: 226 232 240;
            --muted-foreground: 71 85 99;
            --popover: 255 255 255;
            --popover-foreground: 15 23 42;
        }

        * {
            @apply transition-colors duration-200;
        }
    </style>
</head>

<body class="font-sans antialiased bg-linear-to-br from-blue-50 to-indigo-50 dark:from-slate-950 dark:to-slate-900">
    <div class="min-h-screen">
        @auth
            <div class="flex h-screen bg-white dark:bg-slate-950">
                <!-- Sidebar Navigation -->
                {{-- @if (auth()->user()->role === 'admin') --}}
                @include('components.sidebar')

                <!-- Main Content -->
                <main class="flex-1 overflow-auto">
                    <!-- Top Navigation Bar -->
                    @include('components.top-navbar')

                    <!-- Page Content -->
                    <div class="p-8">
                        @yield('content')
                    </div>
                </main>
            </div>
        @else
            @yield('content')
        @endauth
    </div>

    <!-- Notifications -->
    @if ($errors->any())
        <div class="fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg">
            <p class="font-semibold">Error</p>
            @foreach ($errors->all() as $error)
                <p class="text-sm">{{ $error }}</p>
            @endforeach
        </div>
    @endif

    @if (session('success'))
        <div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg" id="successNotif">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(() => {
                document.getElementById('successNotif').remove();
            }, 3000);
        </script>
    @endif
</body>

</html>
