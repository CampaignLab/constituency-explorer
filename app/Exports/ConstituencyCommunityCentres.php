<?php

namespace App\Exports;

use App\Models\Constituency;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ConstituencyCommunityCentres implements FromQuery, WithMapping, WithHeadings
{
    public function __construct(
        protected Constituency $constituency,
    )
    {

    }

    public function query()
    {
        return $this->constituency->communityCentres()->orderBy('name');
    }

    public function map($row): array
    {
        return [
            $row->name,
            $row->postcode,
        ];
    }

    public function headings(): array
    {
        return [
            'name',
            'postcode',
        ];
    }
}
