<?php

namespace App\Imports;

use App\Models\OldConstituency;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class OldConstituenciesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new OldConstituency([
            'gss_code' => $row['pcon23cd'],
            'name' => $row['pcon23nm'],
        ]);
    }
}
