<?php

namespace App\Console\Commands;

use App\Models\Constituency;
use App\Models\PlaceOfWorship;

class ImportPlacesOfWorship extends BaseImportCommand
{
    protected $signature = 'import:places-of-worship {filename?}';
    protected $description = 'Import places of worship from CSV file.';
    protected $filename = 'fixtures/places-of-worship.csv';

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
            $this->warn("Constituency not found: {$gss_code}");
            return null;
        }

        return PlaceOfWorship::create([
            'name' => $row['name'],
            'religion' => $row['religion'],
            'denomination' => $row['denomination'],
            'postcode' => $row['postcode'],
            'constituency_id' => $constituency->id,
            'longitude' => $row['Mapped: longitude'],
            'latitude' => $row['Mapped: latitude'],
        ]);
    }
}
