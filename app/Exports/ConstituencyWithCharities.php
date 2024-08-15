<?php

namespace App\Exports;

use App\Models\Constituency;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ConstituencyWithCharities implements FromQuery, WithMapping, WithHeadings
{
    public function query()
    {
        return Constituency::query()
            ->orderBy('name')
            ->with('charities');
    }

    public function map($row): array
    {
        dd([]);
        // $charities = [];

        // foreach ($row->charities as $charity) {
        //     $charities[] = [
        //         $charity->name,
        //         $charity->formattedAddress(),
        //         $row->name,
        //         $row->gss_code,
        //     ];
        // }

        // return $charities;
    }

    public function headings(): array
    {
        return [
            'name',
            'address',
            'constituency_name',
            'constituency_gss_code',
        ];
    }
}
