<?php

namespace App\Exports;

use App\Models\Constituency;
use App\Models\LocalAuthority;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AllLaExport implements FromQuery, WithHeadings, WithMapping
{
    public function query()
    {
        return Constituency::query()
            ->with(['localAuthorities']);
    }

    public function headings(): array
    {
        return [
            'name',
            'gss_code',
            'constituency_name',
            'constituency_full_code',
            'constituency_short_code',
            'constituency_gss_code',
        ];
    }

    public function map($row): array
    {
        return $row->localAuthorities
            ->map(function (LocalAuthority $la) use ($row) {
                return [
                    'name' => $la->name,
                    'gss_code' => $la->gss_code,
                    'constituency_name' => $row->name,
                    'constituency_full_code' => $row->full_code,
                    'constituency_short_code' => $row->short_code,
                    'constituency_gss_code' => $row->gss_code,
                ];
            })
            ->all();
    }
}
