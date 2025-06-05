<?php

namespace App\Console\Commands;

use App\Models\Constituency;
use App\Models\Hospital;

class ImportEnglishHospitalsCommand extends BaseImportCommand
{
    protected $signature = 'import:english-hospitals';
    protected $description = 'Import English hospitals.';
    protected $filename = 'fixtures/hospitals-england.csv';
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

        return Hospital::create([
            'constituency_id' => $constituency->id,
            'name' => $row['Name'],
            'address' => array_merge(
                array_map(trim(...), explode(',', $row['Address'])),
                [$row['Postcode']],
            ),
            'latitude' => $row['Mapped: latitude'],
            'longitude' => $row['Mapped: longitude'],
        ]);
    }
}
