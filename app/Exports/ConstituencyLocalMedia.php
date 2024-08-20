<?php

namespace App\Exports;

use App\Models\Constituency;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ConstituencyLocalMedia implements FromQuery, WithMapping, WithHeadings
{
    public function __construct(
        protected Constituency $constituency,
    ) {}

    public function query()
    {
        return $this->constituency->localMedia()->orderBy('name');
    }

    public function map($row): array
    {
        return [
            $row->name,
            $row->address ? implode(', ', array_filter($row->address)) : null,
            $row->twitter,
            $row->type_of_owner,
            $row->frequency,
            $row->cost,
            $row->media_type,
            $row->website,
        ];
    }

    public function headings(): array
    {
        return [
            'name',
            'address',
            'twitter',
            'type_of_owner',
            'frequency',
            'cost',
            'media_type',
            'website',
        ];
    }
}
