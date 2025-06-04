<?php

namespace App\Console\Commands;

use App\Models\Constituency;
use App\Models\LocalAuthority;

class ImportConstituencyLocalAuthorityPivotData extends BaseImportCommand
{
    protected $signature = 'import:constituency-local-authority-pivot-data';
    protected $description = 'Import Constituency -> Local Authority pivot data.';
    protected $filename = 'fixtures/overlap_local_authorities_cons_2025.csv';

    public function importRow($row)
    {
        $constituency = Constituency::where('short_code', $row['PARL25'])->first();
        $localAuthority = LocalAuthority::where('gss_code', $row['LAD23'])->first();

        if (! $constituency || ! $localAuthority) {
            $this->warn("Constituency or local authority not found: {$row['PARL25']} or {$row['LAD23']}");
            return null;
        }

        $constituency->localAuthorities()->attach($localAuthority->id, [
            'overlap_area' => $row['overlap_area'],
            'original_area' => $row['original_area'],
            'percentage_overlap_area' => $row['percentage_overlap_area'],
            'percentage_overlap_pop' => $row['percentage_overlap_pop'],
            'overlap_pop' => $row['overlap_pop'],
            'original_pop' => $row['original_pop'],
            '__index_level_0__' => $row['__index_level_0__'] ?? null
        ]);

        return $constituency;
    }
}
