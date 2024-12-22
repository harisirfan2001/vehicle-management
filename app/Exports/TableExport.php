<?php

namespace App\Exports;

use App\Models\GatePass\gatePass;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TableExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        $records = gatePass::whereNotNull('date')
            ->whereNotNull('gate_pass_number')
            ->whereNotNull('vehicle_no')
            ->whereNotNull('driver_name')
            ->whereNotNull('meter_out')
            ->whereNotNull('meter_in')
            ->whereNotNull('covered_km')
            ->whereNotNull('time_out')
            ->whereNotNull('time_in')
            ->whereNotNull('total_time')
            ->whereNotNull('user_officer')
            ->whereNotNull('area_name')
            ->whereNotNull('reason_to_travel')
            ->whereNotNull('pass_receiver')
            ->whereNotNull('pass_receiver_checkin')
            ->select(
                'date',
                'gate_pass_number',
                'vehicle_no',
                'driver_name',
                'meter_out',
                'meter_in',
                'covered_km',
                'time_out',
                'time_in',
                'total_time',
                'user_officer',
                'area_name',
                'reason_to_travel',
                'pass_receiver',
                'pass_receiver_checkin'
            )
            ->get();

        $dataWithSr = $records->map(function ($record, $key) {
            return [
                'sr_number' => $key + 1,
                'date' => $record->date,
                'gate_pass_number' => $record->gate_pass_number,
                'vehicle_no' => $record->vehicle_no,
                'driver_name' => $record->driver_name,
                'meter_out' => $record->meter_out,
                'meter_in' => $record->meter_in,
                'covered_km' => $record->covered_km,
                'time_out' => $record->time_out,
                'time_in' => $record->time_in,
                'total_time' => $record->total_time,
                'user_officer' => $record->user_officer,
                'area_name' => $record->area_name,
                'reason_to_travel' => $record->reason_to_travel,
                'pass_receiver' => $record->pass_receiver,
                'pass_receiver_checkin' => $record->pass_receiver_checkin,
            ];
        });

        return $dataWithSr;
    }

    public function headings(): array
    {
        return [
            'Sr #',
            'Date',
            'Gate Pass Number',
            'Vehicle No',
            'Driver Name',
            'Meter Out',
            'Meter In',
            'Covered KM',
            'Time Out',
            'Time In',
            'Total Time',
            'User Officer',
            'Area Name',
            'Reason to Travel',
            'Pass Receiver (Check-Out)',
            'Pass Receiver (Check-In)',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:P1')->getFont()->setBold(true);
        $sheet->getStyle('A:P')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A:P')->getAlignment()->setVertical('center');
        $sheet->getStyle('A:P')->getAlignment()->setWrapText(true);

        foreach (range('A', 'P') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $sheet->getStyle('A1:P' . $sheet->getHighestRow())
              ->getBorders()->getAllBorders()->setBorderStyle('thin');

        return [];
    }
}
