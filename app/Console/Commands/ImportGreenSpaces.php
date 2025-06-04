<?php

namespace App\Console\Commands;

use App\Models\Constituency;
use App\Models\GreenSpace;

class ImportGreenSpaces extends BaseImportCommand
{
    protected $signature = 'import:green-spaces';
    protected $description = 'Import green spaces.';
    protected $filename = 'fixtures/green-spaces.csv';
    private $constituencies;

    public function initialise()
    {
        $this->constituencies = Constituency::all()->keyBy('gss_code');
    }

    public function importRow($row)
    {
        $gss_code = $row['Mapped: codes.parliamentary_constituency_2025'];
        if (empty($gss_code)) {
            return null;
        }

        $constituency = $this->constituencies[$gss_code] ?? null;

        if (! $constituency) {
            $this->warn("Constituency not found: {$gss_code} ({$row['id']})");
            return null;
        }

        return GreenSpace::create([
            'constituency_id' => $constituency->id,
            'name' => $row['name'],
            'postcode' => $row['postcode'] ?: null,
            'latitude' => $row['Mapped: latitude'],
            'longitude' => $row['Mapped: longitude'],
            'opening_hours' => $row['opening_hours'] ?: null,
        ]);
    }
}
