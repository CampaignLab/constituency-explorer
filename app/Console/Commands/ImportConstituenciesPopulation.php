<?php

namespace App\Console\Commands;

use App\Models\Constituency;

class ImportConstituenciesPopulation extends BaseImportCommand
{
    protected $signature = 'import:constituencies-population {filename?}';
    protected $description = 'Import constituency population data.';
    protected $filename = 'fixtures/constituencies_population.csv';

    public function importRow($row)
    {
        $constituency = Constituency::where('gss_code', $row['code'])->first();

        if (! $constituency) {
            $this->warn("Constituency not found for {$row['code']}");
            return null;
        }

        // Cast population to integer and remove any commas
        $population = (int) str_replace(',', '', $row['population']);

        $constituency->update([
            'population' => $population,
        ]);

        return $constituency;
    }
}
