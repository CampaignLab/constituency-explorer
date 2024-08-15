<?php

namespace App\Exports;

use App\Models\Constituency;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ConstituencyWithHospitals implements FromQuery, WithMapping, WithHeadings
{
    public function query()
    {
        return Constituency::query()
            ->orderBy('name')
            ->with('hospitals');
    }

    public function map($row): array
    {
        $hospitals = [];

        foreach ($row->hospitals as $hospital) {
            $hospitals[] = [
                $hospital->name,
                $hospital->formattedAddress(),
                $row->name,
                $row->gss_code,
            ];
        }

        return $hospitals;
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
