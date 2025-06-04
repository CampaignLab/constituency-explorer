<?php

namespace App\Console\Commands;

use App\Models\Constituency;
use App\Models\OldConstituency;

class ImportOldConstituencyOverlapsCommand extends BaseImportCommand
{
    protected $signature = 'import:old-constituency-overlaps';
    protected $description = 'Import old constituency overlaps (PCON23 -> PCON25).';
    protected $filename = 'fixtures/PARL10_PARL25_combo_overlap.csv';

    public function importRow($row)
    {
        $constituency = Constituency::where('short_code', $row['PARL25'])->first();
        $oldConstituency = OldConstituency::where('gss_code', $row['PARL10'])->first();

        if (! $constituency || ! $oldConstituency) {
            $this->warn("Constituency or old constituency not found: {$row['PARL25']} or {$row['PARL10']}");
            return null;
        }

        $constituency->oldConstituencies()->attach($oldConstituency, [
            'overlap_area' => $row['overlap_area'],
            'original_area' => $row['original_area'],
            'percentage_overlap_area' => $row['percentage_overlap_area'],
            'percentage_overlap_pop' => $row['percentage_overlap_pop'],
            'overlap_pop' => $row['overlap_pop'],
            'original_pop' => $row['original_pop'],
            '__index_level_0__' => $row['index_level_0'] ?? null,
        ]);

        return $constituency;
    }
}
