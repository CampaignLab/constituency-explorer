<?php

namespace App\Exports;

use App\Models\Constituency;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ConstituencyTownsExport implements FromQuery, WithMapping, WithHeadings
{
    public function __construct(
        protected Constituency $constituency,
    ) {}

    public function query()
    {
        return $this->constituency->towns()->orderBy('name');
    }

    public function map($row): array
    {
        return [
            $row->name,
            $row->county,
            $row->country,
            $row->grid_reference,
        ];
    }

    public function headings(): array
    {
        return [
            'name',
            'county',
            'country',
            'grid_reference',
        ];
    }
}
