<?php

namespace App\Console\Commands;

use App\Models\LocalAuthority;

class ImportLocalAuthorities extends BaseImportCommand
{
    protected $signature = 'import:local-authorities {filename?}';
    protected $description = 'Import local authorities.';
    protected $filename = 'fixtures/local_authority_districts.csv';

    public function importRow($row)
    {
        return LocalAuthority::create([
            'gss_code' => $row['LAD23CD'],
            'name' => $row['LAD23NM'],
        ]);
    }
}
