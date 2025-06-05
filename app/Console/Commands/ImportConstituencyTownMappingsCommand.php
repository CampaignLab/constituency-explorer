<?php

namespace App\Console\Commands;

use App\Models\Constituency;
use App\Models\Town;

class ImportConstituencyTownMappingsCommand extends BaseImportCommand
{
    protected $signature = 'import:constituency-town-mappings';
    protected $description = 'Import town to constituency mappings.';
    protected $filename = 'fixtures/towns-map.csv';

    private $constituencies;
    private $towns;

    public function initialise()
    {
        $this->constituencies = Constituency::all()->keyBy('name');
        $this->towns = Town::all()->keyBy('name');
    }

    public function importRow($row)
    {
        if (! $row['town_name']) {
            return null;
        }

        $town = $this->towns[$row['town_name']] ?? null;

        if (! $town) {
            $this->warn('Town not found: ' . $row['town_name']);
            return null;
        }

        $constituency = $this->constituencies[$row['new_constituency_name']] ?? null;

        if (! $constituency) {
            $this->warn('Constituency not found: ' . $row['new_constituency_name']);
            return null;
        }

        $town->constituencies()->syncWithoutDetaching($constituency);

        return $town;
    }
}
