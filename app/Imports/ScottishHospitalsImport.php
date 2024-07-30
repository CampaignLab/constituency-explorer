<?php

namespace App\Imports;

use App\Models\Constituency;
use App\Models\Hospital;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ScottishHospitalsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $constituency = Constituency::where('gss_code', $row['mapped_codesparliamentary_constituency_2025'])->value('id');

        if (! $constituency) {
            return;
        }

        return new Hospital([
            'constituency_id' => $constituency,
            'name' => $row['location_name'],
            'address' => array_merge(
                array_map('trim', explode(',', $row['address'])),
                [trim($row['postcode'])],
            ),
            'latitude' => $row['mapped_latitude'],
            'longitude' => $row['mapped_longitude'],
        ]);
    }
}
