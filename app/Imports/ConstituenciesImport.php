<?php

namespace App\Imports;

use App\Models\Constituency;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ConstituenciesImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Constituency([
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
