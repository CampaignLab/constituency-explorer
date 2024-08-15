<?php

namespace App\Exports;

use App\Models\Constituency;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ConstituencyWithDentists implements FromQuery, WithMapping, WithHeadings
{
    public function query()
    {
        return Constituency::query()
            ->orderBy('name')
            ->with('dentists');
    }

    public function map($row): array
    {
        $dentists = [];

        foreach ($row->dentists as $dentist) {
            $dentists[] = [
                $dentist->name,
                $dentist->formattedAddress(),
                $row->name,
                $row->gss_code,
            ];
        }

        return $dentists;
    }

    public function headings(): array
    {
        return [
            'name',
            'address',
            'constituency_name',
            'constituency_gss_code',
        ];
    }
}
