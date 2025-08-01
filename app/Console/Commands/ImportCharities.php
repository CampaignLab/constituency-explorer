<?php

namespace App\Console\Commands;

use App\Models\Constituency;
use App\Models\Charity;

class ImportCharities extends BaseImportCommand
{
    protected $signature = 'import:charities {filename?}';
    protected $description = 'Import charities.';
    protected $filename = 'fixtures/CharityBase_6a177e34883233ee698fa2b9a69a34d4.csv';

    private $constituencies;

    public function initialise()
    {
        $this->constituencies = Constituency::all()->keyBy('gss_code');
    }

    public function importRow($row)
    {
        $constituency = $this->constituencies[$row['pcon_2024']] ?? null;

        return Charity::create([
            'charity_id' => $row['Charity ID'],
            'company_id' => $row['Company ID'] ?: null,
            'name' => $row['Name'],
            'website' => $row['Website'] ?: null,
            'trustees' => $row['Trustees'] ?: null,
            'employees' => $row['Employees'] ?: null,
            'volunteers' => $row['Volunteers'] ?: null,
            'registered' => date('Y-m-d', strtotime($row['Registered'])),
            'financial_year' => date('Y-m-d', strtotime($row['Financial Year'])),
            'income' => $row['Income'] ?: null,
            'spending' => $row['Spending'] ?: null,
            'funders' => $row['Funders'] ?: null,
            'email' => $row['Email'] ?: null,
            'phone' => $row['Phone'] ?: null,
            'address' => json_decode($row['Address']),
            'postcode' => $row['Postcode'] ?: null,
            'facebook' => $row['Facebook'] ?: null,
            'instagram' => $row['Instagram'] ?: null,
            'twitter' => $row['Twitter'] ?: null,
            'ccg' => $row['CCG'] ?: null,
            'eer' => $row['EER'] ?: null,
            'laua' => $row['LAUA'] ?: null,
            'lsoa' => $row['LSOA'] ?: null,
            'msoa' => $row['MSOA'] ?: null,
            'pcon' => $row['PCon'] ?: null,
            'ru' => $row['RU'] ?: null,
            'ttwa' => $row['TTWA'] ?: null,
            'ward' => $row['Ward'] ?: null,
            'latitude' => $row['Latitude'] ?: null,
            'longitude' => $row['Longitude'] ?: null,
            'constituency_id' => $constituency ? $constituency->id : null,
        ]);
    }
}
