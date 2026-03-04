@extends('layouts.app')

@section('content')
<h2 class="font-bold text-xl mb-4">Logs Activity</h2>
<div class="overflow-x-auto">
    <table class="w-full border-collapse border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border border-gray-300 px-4 py-2 text-left">Created At</th>
                <th class="border border-gray-300 px-4 py-2 text-left">User</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Action</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logs as $log)
            <tr class="hover:bg-gray-50">
                <td class="border border-gray-300 px-4 py-2">{{ $log->created_at }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $log->user->name }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $log->action }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $log->description }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
