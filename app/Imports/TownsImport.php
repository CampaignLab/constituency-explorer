<?php

namespace App\Imports;

use App\Models\Town;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TownsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Town([
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
