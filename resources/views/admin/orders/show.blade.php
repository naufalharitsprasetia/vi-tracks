@extends('layouts.app')

@section('content')
<div class="container">
    {{-- card --}}
    @php
    if($order->status == 'APPROVED') {
    $borderColor = 'border-green-500';
    $bgColor = 'bg-green-50';
    $textColor = 'text-green-900';
    $statusText = 'Approved';
    $statusBadge = 'bg-green-100 text-green-800';
    } elseif($order->status == 'REJECTED') {
    $borderColor = 'border-red-500';
    $bgColor = 'bg-red-50';
    $textColor = 'text-red-900';
    $statusText = 'Rejected';
    $statusBadge = 'bg-red-100 text-red-800';
    } else {
    $borderColor = 'border-gray-300';
    $bgColor = 'bg-gray-50';
    $textColor = 'text-gray-900';
    $statusText = 'Pending';
    $statusBadge = 'bg-gray-100 text-gray-800';
    }
    @endphp
    <div
        class="bg-white rounded-xl shadow-md overflow-hidden border-l-4 {{ $borderColor }} hover:shadow-lg transition-shadow">
        <div class="p-6">
            <div class="flex items-start justify-between mb-4">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-2">
                        <h3 class="text-lg font-bold text-gray-900">#{{ $order->order_code }}</h3>
                        <span
                            class="px-3 py-1 {{ $statusBadge }} text-xs font-semibold rounded-full">{{$order->status}}</span>
                    </div>
                    <p class="text-sm text-gray-600">Requested by:
                        <strong>{{ $order->requester_name }}</strong> |
                        {{ $order->department }} Department
                    </p>
                    <p class="text-sm text-gray-600">Created At: <strong>{{ $order->created_at }}</strong>
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4 pb-4 border-b border-gray-200">
                <div>
                    <p class="text-xs text-gray-600 font-semibold uppercase">Vehicle</p>
                    <p class="text-sm font-medium text-gray-900">{{ $order->vehicle->brand }} - {{
                        $order->vehicle->plate_number }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-600 font-semibold uppercase">Date</p>
                    <p class="text-sm font-medium text-gray-900">{{ $order->booking_date }} s/d {{
                        $order->return_date }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-600 font-semibold uppercase">Driver</p>
                    <p class="text-sm font-medium text-gray-900">{{ $order->driver->name }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-600 font-semibold uppercase">Destination/Purpose</p>
                    <p class="text-sm font-medium text-gray-900">{{ $order->destination }}</p>
                </div>
            </div>

            <div class="mb-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                <p class="text-xs text-gray-900 font-semibold uppercase mb-1">Additional Notes:</p>
                <p class="text-sm text-gray-900">{{ $order->notes }}</p>
            </div>

            @foreach ($order->approvals as $approval)
            @php
            if($approval->status == 'APPROVED') {
            $approvalBadge = 'bg-green-100 text-green-800';
            $approvalTextColor = 'text-green-600';
            } elseif($approval->status == 'REJECTED') {
            $approvalBadge = 'bg-red-100 text-red-800';
            $approvalTextColor = 'text-red-600';
            } elseif($approval->status == 'PENDING') {
            $approvalBadge = 'bg-yellow-100 text-yellow-800';
            $approvalTextColor = 'text-yellow-600';
            }
            @endphp
            @if($order->status == 'REJECTED' && $approval->status == 'PENDING')
            @else
            <div class="mb-2">
                <div class="flex items-center gap-4 text-sm">
                    <span class="px-3 py-1 {{ $approvalBadge }} font-semibold rounded-full">Level {{ $approval->level }}
                        Approval : </span>
                    <span class="font-semibold {{ $approvalTextColor }}">{{$approval->status}} <strong></strong></span>
                </div>
                <span class="ml-4 text-xs font-gray-600"><strong>Approver {{ $approval->level }} ({{
                        $approval->approver->name }}) Note :</strong>
                    {{$approval->note}}</span>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>
@endsection
