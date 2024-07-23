<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\LocalAuthoritiesImport;

class ImportLocalAuthorities extends Command
{
    protected $signature = 'import:local-authorities';

    protected $description = 'Import local authorities from a CSV file';

    public function handle()
    {
        $file = database_path('fixtures/local_authority_districts.csv');

        if (! file_exists($file)) {
            $this->error("File not found: {$file}");
            return 1;
        }

        try {
            Excel::import(new LocalAuthoritiesImport, $file);
            $this->info('Local authorities imported successfully.');
        } catch (\Exception $e) {
            $this->error('An error occurred while importing the file: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
