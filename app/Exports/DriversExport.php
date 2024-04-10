<?php

namespace App\Exports;

use App\Models\Driver;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DriversExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    WithStyles
{
    use Exportable;
    public string $status = 'Pending';
    public function collection(): Collection
    {
        return Driver::all()->except(['created_at', 'updated_at', 'deleted_at']);
    }


    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Date of Birth',
            'Driver license Date',
            'Vehicle type',
            'Status',
        ];
    }

    /**
     * @param $row
     * @return array
     */
    public function map($row): array
    {
        if ($row->approved_at && !$row->rejected_at) {
            $this->status = 'Approved';
        } elseif ($row->rejected_at && !$row->approved_at) {
            $this->status = 'Rejected';
        }

        return array_values([
            $row->name,
            $row->email,
            $row->dob,
            $row->driver_license,
            $row->vehicle_type,
            $this->status,
        ]);
    }

    /**
     * @param Worksheet $sheet
     * @return void
     * @throws Exception
     */
    public function styles(Worksheet $sheet): void
    {
        $sheet->getStyle('A1:F1')->applyFromArray([
            'font' => [
                'bold' => true,
            ]
        ]);
    }
}
