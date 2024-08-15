<?php

namespace App\Exports;

use App\Models\Constituency;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ConstituencyPlacesOfWorship implements FromQuery, WithMapping, WithHeadings
{
    public function __construct(
        protected Constituency $constituency,
    ) {}

    public function query()
    {
        return $this->constituency->placesOfWorship()->orderBy('name');
    }

    public function map($row): array
    {
        return [
            $row->name,
            $row->postcode,
            $row->religion,
            $row->denomination,
        ];
    }

    public function headings(): array
    {
        return [
            'name',
            'postcode',
            'religion',
            'denomination',
        ];
    }
}
