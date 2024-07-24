<?php

namespace App\Imports;

use App\Models\Constituency;
use App\Models\Dentist;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DentistsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $constituency = Constituency::where('gss_code', $row['mapped_codesparliamentary_constituency_2025'])->value('id');

        if (! $constituency) {
            return null;
        }

        return new Dentist([
            'constituency_id' => $constituency,
            'name' => $row['name'],
            'address' => [
                $row['address'],
                $row['e'],
                $row['f'],
                $row['g'],
                $row['hampshire'],
                $row['postcode'],
            ],
        ]);
    }
}
