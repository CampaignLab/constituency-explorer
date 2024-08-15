<?php

namespace App\Exports;

use App\Models\Constituency;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ConstituencyOldConstituency implements FromQuery, WithMapping, WithHeadings
{
    public function __construct(
        protected Constituency $constituency,
    ) {}

    public function query()
    {
        return $this->constituency->oldConstituencies();
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->gss_code,
            $row->name,
            $row->pivot->overlap_area,
            $row->pivot->overlap_pop,
            $row->pivot->percentage_overlap_area,
            $row->pivot->percentage_overlap_pop,
        ];
    }

    public function headings(): array
    {
        return [
            'id',
            'gss_code',
            'name',
            'overlap_area',
            'overlap_population',
            'percentage_overlap_area',
            'percentage_overlap_population',
        ];
    }
}
