<?php

namespace App\Console\Commands;

use App\Models\CommunityCentre;
use App\Models\Constituency;

class ImportCommunityCentres extends BaseImportCommand
{
    protected $signature = 'import:community-centres';
    protected $description = 'Import community centres.';
    protected $filename = 'fixtures/community-centres.csv';
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
            $this->warn("Constituency not found for {$gss_code}");
            return null;
        }

        return CommunityCentre::create([
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
