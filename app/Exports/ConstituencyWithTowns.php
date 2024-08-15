<?php

namespace App\Exports;

use App\Models\Constituency;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ConstituencyWithTowns implements FromQuery, WithMapping, WithHeadings
{
    public function query()
    {
        return Constituency::query()
            ->orderBy('name')
            ->with('towns');
    }

    public function map($row): array
    {
        $towns = [];

        foreach ($row->towns as $town) {
            $towns[] = [
                $town->name,
                $town->county,
                $town->region,
                $town->grid_reference,
                $row->name,
                $row->gss_code,
            ];
        }

        return $towns;
    }

    public function headings(): array
    {
        return [
            'name',
            'county',
            'region',
            'grid_reference',
            'constituency_name',
            'constituency_gss_code',
        ];
    }
}
