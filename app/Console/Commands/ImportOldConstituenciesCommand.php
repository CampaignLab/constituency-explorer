<?php

namespace App\Console\Commands;

use App\Imports\OldConstituenciesImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ImportOldConstituenciesCommand extends Command
{
    protected $signature = 'import:old-constituencies';

    protected $description = 'Import old constituencies (PCON23).';

    public function handle()
    {
        $file = database_path('fixtures/Westminster_Parliamentary_Constituencies_(December_2023)_Names_and_Codes_in_the_UK.csv');

        if (!file_exists($file)) {
            $this->error("File not found: {$file}");
            return 1;
        }

        try {
            Excel::import(new OldConstituenciesImport, $file);
            $this->info('Old constituencies imported successfully.');
        } catch (\Exception $e) {
            $this->error('An error occurred while importing the file: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
