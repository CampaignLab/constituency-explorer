<?php

namespace App\Exports;

use App\Models\Constituency;
use App\Models\OldConstituency;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AllPcon23Export implements FromQuery, WithMapping, WithHeadings
{
    public function query()
    {
        return Constituency::query()
            ->with(['oldConstituencies'])
            ->orderBy('name');
    }

    public function headings(): array
    {
        return [
            'pcon23_name',
            'pcon23_gss_code',
            'pcon25_name',
            'pcon25_full_code',
            'pcon25_short_code',
            'pcon25_gss_code',
        ];
    }

    public function map($row): array
    {
        return $row->oldConstituencies->map(function (OldConstituency $oc) use ($row) {
            return [
                $oc->name,
                $oc->gss_code,
                $row->name,
                $row->full_code,
                $row->short_code,
                $row->gss_code,
            ];
        })->all();
    }
}
