<?php

// app/Imports/CharitiesImport.php

namespace App\Imports;

use App\Models\Charity;
use App\Models\Constituency;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Facades\Log;

class CharitiesImport implements ToModel, WithHeadingRow, WithChunkReading
{
    public function model(array $row)
    {
        try {
            $constituency = Constituency::where('gss_code', $row['pcon_2024'])->first();

            return new Charity([
                'charity_id' => $row['charity_id'],
                'company_id' => $row['company_id'] ?? null,
                'name' => $row['name'],
                'website' => $row['website'] ?? null,
                'trustees' => $row['trustees'] ?? null,
                'employees' => $row['employees'] ?? null,
                'volunteers' => $row['volunteers'] ?? null,
                'registered' => $row['registered'],
                'financial_year' => $row['financial_year'],
                'income' => $row['income'] ?? null,
                'spending' => $row['spending'] ?? null,
                'funders' => $row['funders'] ?? null,
                'email' => $row['email'] ?? null,
                'phone' => $row['phone'] ?? null,
                'address' => json_decode($row['address']),
                'postcode' => $row['postcode'] ?? null,
                'facebook' => $row['facebook'] ?? null,
                'instagram' => $row['instagram'] ?? null,
                'twitter' => $row['twitter'] ?? null,
                'ccg' => $row['ccg'] ?? null,
                'eer' => $row['eer'] ?? null,
                'laua' => $row['laua'] ?? null,
                'lsoa' => $row['lsoa'] ?? null,
                'msoa' => $row['msoa'] ?? null,
                'pcon' => $row['pcon'] ?? null,
                'ru' => $row['ru'] ?? null,
                'ttwa' => $row['ttwa'] ?? null,
                'ward' => $row['ward'] ?? null,
                'latitude' => $row['latitude'] ?? null,
                'longitude' => $row['longitude'] ?? null,
                'constituency_id' => $constituency ? $constituency->id : null,
            ]);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function chunkSize(): int
    {
        return 10000;
    }
}
