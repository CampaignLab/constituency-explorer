<?php

namespace App\Console\Commands;

use App\Models\Hospital;
use App\Models\Constituency;

class ImportScottishHospitalsCommand extends BaseImportCommand
{
    protected $signature = 'import:scottish-hospitals {filename?}';
    protected $description = 'Import Scottish hospitals.';
    protected $filename = 'fixtures/hospitals-scotland.csv';

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

        $existing = Hospital::where('name', $row['Location Name'])->where('constituency_id', $constituency->id)->first();
        if ($existing) {
            $this->warn("Hospital already exists: {$row['Location Name']} ({$constituency->name})");
        }

        return Hospital::create([
            'constituency_id' => $constituency->id,
            'name' => $row['Location Name'],
            'address' => array_map('trim', explode(',', $row['Address'])),
            'latitude' => $row['Mapped: latitude'],
            'longitude' => $row['Mapped: longitude'],
        ]);
    }
}
