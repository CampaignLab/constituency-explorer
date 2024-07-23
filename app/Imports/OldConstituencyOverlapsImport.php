<?php

namespace App\Imports;

use App\Models\Constituency;
use App\Models\OldConstituency;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class OldConstituencyOverlapsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $constituency = Constituency::where('short_code', $row['parl25'])->first();
        $oldConstituency = OldConstituency::where('gss_code', $row['parl10'])->first();

        if ($constituency && $oldConstituency) {
            $constituency->oldConstituencies()->attach($oldConstituency, [
                'overlap_area' => $row['overlap_area'],
                'original_area' => $row['original_area'],
                'percentage_overlap_area' => $row['percentage_overlap_area'],
                'percentage_overlap_pop' => $row['percentage_overlap_pop'],
                'overlap_pop' => $row['overlap_pop'],
                'original_pop' => $row['original_pop'],
                '__index_level_0__' => $row['index_level_0'] ?? null,
            ]);
        }
    }
}
