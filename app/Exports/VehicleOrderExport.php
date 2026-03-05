<?php

namespace App\Exports;

use App\Models\VehicleOrder;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\{
    FromCollection,
    WithHeadings,
    WithMapping,
    ShouldAutoSize
};


class VehicleOrderExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $start;
    protected $end;

    public function __construct($startDate, $endDate)
    {
        $this->start = Carbon::parse($startDate)->startOfDay();
        $this->end   = Carbon::parse($endDate)->endOfDay();
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return VehicleOrder::whereBetween('created_at', [$this->start, $this->end])
            ->orderBy('created_at')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Created At',
            'Kode Order',
            'Requester',
            'Vehicle',
            'Status',
        ];
    }


    public function map($order): array
    {
        return [
            $order->created_at->format('d-m-Y H:i'),
            $order->order_code,
            $order->requester_name,
            $order->vehicle->brand ?? '-',
            $order->status,
        ];
    }
}
