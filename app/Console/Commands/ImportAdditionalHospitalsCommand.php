<?php

namespace App\Console\Commands;

use App\Models\Constituency;
use App\Models\Hospital;

class ImportAdditionalHospitalsCommand extends BaseImportCommand
{
    protected $signature = 'import:additional-hospitals {filename?}';
    protected $description = 'Import additional hospitals.';
    protected $filename = 'fixtures/additional_hospitals_20250618.csv';
    private $constituencies;

    public function initialise()
    {
        $this->constituencies = Constituency::all()->keyBy('gss_code');
    }

    public function importRow($row)
    {
        $gss_code = $row['Mapped: codes.parliamentary_constituency'];
        if (empty($gss_code)) {
            return null;
        }

        $constituency = $this->constituencies[$gss_code] ?? null;

        if (! $constituency) {
            $this->warn("Constituency not found: {$gss_code}");
            return null;
        }

        $existing = Hospital::where('name', $row['name'])->where('constituency_id', $constituency->id)->first();
        if ($existing) {
            $this->warn("Hospital already exists: {$row['name']} ({$constituency->name})");
        }

        return Hospital::create([
            'constituency_id' => $constituency->id,
            'name' => $row['name'],
            'address' => [trim($row['postcode'])],
            'latitude' => $row['Mapped: latitude'],
            'longitude' => $row['Mapped: longitude'],
        ]);
    }
}
