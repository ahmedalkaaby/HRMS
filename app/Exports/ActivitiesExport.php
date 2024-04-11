<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Spatie\Activitylog\Models\Activity;

class ActivitiesExport implements FromQuery, WithHeadings, WithMapping, WithStyles
{
    use Exportable;
    public function query(): Builder
    {
        return Activity::query();
    }


    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Description',
            'Type',
            'Event',
            'Affected User',
            'Caused By',
            'Changes',
            'OLD',
            'NEW',
        ];
    }

    /**
     * @param $row
     * @return array
     */
    public function map($row): array
    {
        return array_values([
            $row->description,
            $row->subject_type,
            $row->event,
            $row->subject->name,
            $row->causer->name,
            implode(', ', array_keys(json_decode($row->properties, true)['old'])),
            implode(', ', json_decode($row->properties, true)['old']),
            implode(', ', json_decode($row->properties, true)['attributes']),
        ]);
    }

    /**
     * @param Worksheet $sheet
     * @return void
     * @throws Exception
     */
    public function styles(Worksheet $sheet): void
    {
        $sheet->getStyle('A1:C1')->applyFromArray([
            'font' => [
                'bold' => true,
            ]
        ]);
    }
}
