<?php

namespace App\Exports;

use App\Models\Constituency;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ConstituencyCharities implements FromQuery, WithMapping, WithHeadings
{
    public function __construct(
        protected Constituency $constituency,
    ) {}

    public function query()
    {
        return $this->constituency->charities()->orderBy('name');
    }

    public function map($row): array
    {
        return [
            $row->name,
            $row->website,
            $row->volunteers,
            number_format($row->income),
            number_format($row->spending),
            $row->formattedAddress(),
        ];
    }

    public function headings(): array
    {
        return [
            'name',
            'website',
            'no_volunteers',
            'income',
            'spending',
            'address',
        ];
    }
}
