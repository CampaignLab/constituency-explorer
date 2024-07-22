<?php

namespace App\Imports;

use App\Models\LocalAuthority;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LocalAuthoritiesImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        return new LocalAuthority([
            'gss_code' => $row['lad23cd'],
            'name' => $row['lad23nm'],
        ]);
    }
}
