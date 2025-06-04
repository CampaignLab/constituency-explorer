<?php

namespace App\Console\Commands;

use App\Models\OldConstituency;

class ImportOldConstituenciesCommand extends BaseImportCommand
{
    protected $signature = 'import:old-constituencies';
    protected $description = 'Import old constituencies (PCON23).';
    protected $filename = 'fixtures/Westminster_Parliamentary_Constituencies_(December_2023)_Names_and_Codes_in_the_UK.csv';

    public function importRow($row)
    {
        return OldConstituency::create([
            'gss_code' => $row['PCON23CD'],
            'name' => $row['PCON23NM'],
        ]);
    }
}
