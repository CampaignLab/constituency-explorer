<?php

namespace App\Exports;

use App\Models\Constituency;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ConstituencyWithSchools implements FromQuery, WithMapping, WithHeadings
{
    public function query()
    {
        return Constituency::query()
            ->orderBy('name')
            ->with('schools');
    }

    public function map($row): array
    {
        $schools = [];

        foreach ($row->schools as $school) {
            $schools[] = [
                $school->name,
                $school->phase_of_education?->getLabel(),
                $school->gender?->getLabel(),
                $row->name,
                $row->gss_code,
            ];
        }

        return $schools;
    }

    public function headings(): array
    {
        return [
            'name',
            'phase_of_education',
            'gender',
            'constituency_name',
            'constituency_gss_code',
        ];
    }
}
