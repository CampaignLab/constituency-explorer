<?php

namespace App\Imports;

use App\Models\Constituency;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ConstituenciesPopulationImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $constituency = Constituency::where('gss_code', $row['code'])->first();
        
        if ($constituency) {
            // Cast population to integer and remove any commas
            $population = (int) str_replace(',', '', $row['population']);
            
            $constituency->update([
                'population' => $population,
            ]);
        }

        return null;
    }
} 