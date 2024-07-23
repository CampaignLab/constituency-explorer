<?php

namespace App\Exports;

use App\Models\Constituency;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;

class ConstituencyWithAllOverlapsExport implements FromQuery, WithMapping
{
    public function query()
    {
        return Constituency::query()
            ->with(['localAuthorities', 'oldConstituencies']);
    }

    /** @param Constituency $row */
    public function map($row): array
    {
        return [];
    }
}
