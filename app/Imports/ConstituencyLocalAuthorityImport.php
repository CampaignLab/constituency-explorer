<?php

// app/Imports/ConstituencyLocalAuthorityImport.php

namespace App\Imports;

use App\Models\Constituency;
use App\Models\LocalAuthority;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ConstituencyLocalAuthorityImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $constituency = Constituency::where('short_code', $row['parl25'])->first();
        $localAuthority = LocalAuthority::where('gss_code', $row['lad23'])->first();

        if ($constituency && $localAuthority) {
            $constituency->localAuthorities()->attach($localAuthority->id, [
                'overlap_area' => $row['overlap_area'],
                'original_area' => $row['original_area'],
                'percentage_overlap_area' => $row['percentage_overlap_area'],
                'percentage_overlap_pop' => $row['percentage_overlap_pop'],
                'overlap_pop' => $row['overlap_pop'],
                'original_pop' => $row['original_pop'],
                '__index_level_0__' => $row['__index_level_0__'] ?? null
            ]);
        }
    }
}
