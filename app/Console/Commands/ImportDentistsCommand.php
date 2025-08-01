<?php

namespace App\Console\Commands;

use App\Models\Constituency;
use App\Models\Dentist;

class ImportDentistsCommand extends BaseImportCommand
{
    protected $signature = 'import:dentists {filename?}';
    protected $description = 'Import dentists.';
    protected $filename = 'fixtures/dentists-england.csv';
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

        return Dentist::create([
            'constituency_id' => $constituency->id,
            'name' => $row['Name'],
            'address' => [
                $row['Address'],
                $row['e'],
                $row['f'],
                $row['g'],
                $row['HAMPSHIRE'],
                $row['postcode'],
            ],
            'latitude' => $row['Mapped: latitude'],
            'longitude' => $row['Mapped: longitude'],
        ]);
    }
}
