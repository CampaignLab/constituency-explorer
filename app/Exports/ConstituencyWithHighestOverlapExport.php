<?php

namespace App\Exports;

use App\Models\Constituency;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ConstituencyWithHighestOverlapExport implements FromQuery, WithMapping, WithHeadings
{
    public function query()
    {
        return Constituency::query()
            ->with(['localAuthorities', 'oldConstituencies']);
    }

    public function headings(): array
    {
        return [
            'name',
            'full_code',
            'short_code',
            'gss_code',
            'local_authority_name',
            'local_authority_gss_code',
            'pcon23_name',
            'pcon23_gss_code',
        ];
    }

    /** @param Constituency $row */
    public function map($row): array
    {
        $localAuthority = $row->localAuthorities->sortByDesc('pivot.percentage_overlap_pop')->first();
        $oldConstituency = $row->oldConstituencies->sortByDesc('pivot.percentage_overlap_pop')->first();

        return [
            'name' => $row->name,
            'full_code' => $row->full_code,
            'short_code' => $row->short_code,
            'gss_code' => $row->gss_code,
            'local_authority_name' => $localAuthority->name,
            'local_authority_gss_code' => $localAuthority->gss_code,
            'pcon23_name' => $oldConstituency->name,
            'pcon23_gss_code' => $oldConstituency->gss_code,
        ];
    }
}
