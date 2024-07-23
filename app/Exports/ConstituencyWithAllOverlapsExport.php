<?php

namespace App\Exports;

use App\Models\Constituency;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ConstituencyWithAllOverlapsExport implements FromQuery, WithMapping, WithHeadings
{
    protected int $maxLocalAuthorities;

    protected int $maxOldConstituencies;

    public function __construct()
    {
        $this->maxLocalAuthorities = Constituency::query()
            ->withCount('localAuthorities')
            ->orderBy('local_authorities_count', 'desc')
            ->first()
            ->local_authorities_count;

        $this->maxOldConstituencies = Constituency::query()
            ->withCount('oldConstituencies')
            ->orderBy('old_constituencies_count', 'desc')
            ->first()
            ->old_constituencies_count;
    }

    public function query()
    {
        return Constituency::query()
            ->with(['localAuthorities', 'oldConstituencies']);
    }

    public function headings(): array
    {
        $headings = [
            'name',
            'full_code',
            'short_code',
            'gss_code',
        ];

        for ($i = 1; $i <= $this->maxLocalAuthorities; $i++) {
            $headings[] = "local_authority_{$i}_name";
            $headings[] = "local_authority_{$i}_gss_code";
            $headings[] = "local_authority_{$i}_percentage_overlap_pop";
            $headings[] = "local_authority_{$i}_percentage_overlap_area";
        }

        for ($i = 1; $i <= $this->maxOldConstituencies; $i++) {
            $headings[] = "pcon23_{$i}_name";
            $headings[] = "pcon23_{$i}_gss_code";
            $headings[] = "pcon23_{$i}_percentage_overlap_pop";
            $headings[] = "pcon23_{$i}_percentage_overlap_area";
        }

        return $headings;
    }

    /** @param Constituency $row */
    public function map($row): array
    {
        $values = [
            $row->name,
            $row->full_code,
            $row->short_code,
            $row->gss_code,
        ];

        foreach ($row->localAuthorities as $localAuthority) {
            $values = array_merge($values, [
                $localAuthority->name,
                $localAuthority->gss_code,
                $localAuthority->pivot->percentage_overlap_pop,
                $localAuthority->pivot->percentage_overlap_area,
            ]);
        }

        for ($i = count($row->localAuthorities); $i < $this->maxLocalAuthorities; $i++) {
            $values = array_merge($values, [
                null,
                null,
                null,
                null,
            ]);
        }

        foreach ($row->oldConstituencies as $oldConstituency) {
            $values = array_merge($values, [
                $oldConstituency->name,
                $oldConstituency->gss_code,
                $oldConstituency->pivot->percentage_overlap_pop,
                $oldConstituency->pivot->percentage_overlap_area,
            ]);
        }

        for ($i = count($row->oldConstituencies); $i < $this->maxOldConstituencies; $i++) {
            $values = array_merge($values, [
                null,
                null,
                null,
                null,
            ]);
        }

        return $values;
    }
}
