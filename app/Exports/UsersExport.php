<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersExport implements FromQuery, WithHeadings, WithMapping, WithStyles
{
    use Exportable;
    public function query(): Builder
    {
        return User::query()->select('name', 'email', 'role_id')->with('role');
    }


    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Role',
        ];
    }

    /**
     * @param $row
     * @return array
     */
    public function map($row): array
    {
        return array_values([
            $row->name,
            $row->email,
            $row->role->name,
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
