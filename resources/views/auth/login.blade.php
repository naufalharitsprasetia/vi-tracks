@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-2xl p-8 backdrop-blur-sm border border-gray-100">
            <!-- Header -->
            <div class="mb-8 text-center">
                <div class="flex justify-center mb-4">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Vi-Tracks App</h1>
                <p class="text-gray-600">Sistem Monitoring Kendaraan</p>
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('authenticate') }}" class="space-y-5">
                @csrf

                <!-- Email Input -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                    <input type="email" name="email" id="email" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                        placeholder="admin@example.com" value="{{ old('email') }}">
                    @error('email')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Input -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                    <input type="password" name="password" id="password" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                        placeholder="••••••••">
                    @error('password')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Login Button -->
                <button type="submit"
                    class="w-full cursor-pointer bg-linear-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-3 rounded-lg transition-all shadow-lg hover:shadow-xl transform hover:scale-105">
                    Login
                </button>
            </form>
        </div>
        <!-- Footer Info -->
        <div class="mt-4 text-center text-sm text-gray-600">
            <p>© 2026 Vi-Tracks App. All rights reserved.</p>
        </div>
    </div>
</div>
@endsection
