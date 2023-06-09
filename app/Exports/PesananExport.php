<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PesananExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Order::where('user_id', auth()->user()->id)->get();
    }

    public function headings(): array
    {
        return [
            'Mobil',
            'Dari',
            'Tujuan',
            'Driver',
            'Approver 1',
            'Approver 2',
            'Tanggal',
            'Status',
        ];
    }

    public function map($order): array
    {
        if ($order->approver->status == 'Menunggu') {
            $order->status = 'Menunggu Persetujuan';
        } elseif ($order->approver->status == 'Diterima' && $order->approver2->status == 'Menunggu') {
            $order->status = 'Menunggu Persetujuan Approver 2';
        } elseif ($order->approver->status == 'Diterima' && $order->approver2->status == 'Diterima') {
            $order->status = 'Diterima';
        } elseif ($order->approver->status == 'Ditolak') {
            $order->status = 'Ditolak';
        }

        return [
            $order->vehicle->model,
            $order->from->name.' - '.$order->from->address,
            $order->destination->name.' - '.$order->destination->address,
            $order->driver->name,
            $order->approver->user->username,
            $order->approver2->user->username,
            $order->date,
            $order->status,
        ];
    }
}
