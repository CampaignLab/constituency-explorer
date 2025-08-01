<?php

namespace App\Console\Commands;

use App\Models\Constituency;

class ImportConstituencies extends BaseImportCommand
{
    protected $signature = 'import:constituencies {filename?}';
    protected $description = 'Import constituencies.';
    protected $filename = 'fixtures/parliament_con_2025.csv';

    public function importRow($row)
    {
        return Constituency::create([
            'full_code' => $row['full_code'],
            'short_code' => $row['short_code'],
            'name' => $row['name'],
            'name_cy' => $row['name_cy'],
            'gss_code' => $row['gss_code'],
            'three_code' => $row['three_code'],
            'nation' => $row['nation'],
            'region' => $row['region'],
            'con_type' => $row['con_type'],
            'electorate' => $row['electorate'],
            'area' => $row['area'],
            'density' => $row['density'],
            'center_lat' => $row['center_lat'],
            'center_lon' => $row['center_lon'],
        ]);
    }
}
