<?php

namespace App\Console\Commands;

use App\Models\Town;

class ImportTownsCommand extends BaseImportCommand
{
    protected $signature = 'import:towns {filename?}';
    protected $description = 'Import towns.';
    protected $filename = 'fixtures/uktowns.csv';

    public function importRow($row)
    {
        return Town::create([
            'name' => $row['name'],
            'county' => $row['county'],
            'country' => $row['country'],
            'grid_reference' => $row['grid_reference'],
            'easting' => $row['easting'],
            'northing' => $row['northing'],
            'latitude' => $row['latitude'],
            'longitude' => $row['longitude'],
            'elevation' => $row['elevation'],
            'postcode_sector' => $row['postcode_sector'],
            'local_government_area' => $row['local_government_area'],
            'region' => $row['nuts_region'],
            'type' => $row['type'],
        ]);
    }
}
