<?php

namespace App\Exports;

use App\Models\Constituency;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ConstituencySchools implements FromQuery, WithMapping, WithHeadings
{
    public function __construct(
        protected Constituency $constituency,
    ) {}

    public function query()
    {
        return $this->constituency->schools()->orderBy('name');
    }

    public function map($row): array
    {
        return [
            $row->name,
            $row->phase_of_education?->getLabel(),
            $row->gender?->getLabel(),
        ];
    }

    public function headings(): array
    {
        return [
            'name',
            'phase_of_education',
            'gender',
        ];
    }
}
