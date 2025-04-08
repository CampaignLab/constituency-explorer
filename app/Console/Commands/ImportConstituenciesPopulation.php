<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ConstituenciesPopulationImport;

class ImportConstituenciesPopulation extends Command
{
    protected $signature = 'import:constituencies-population';

    protected $description = 'Import constituency population data.';

    public function handle()
    {
        $file = database_path('fixtures/constituencies_population.csv');

        if (! file_exists($file)) {
            $this->error("File not found: {$file}");
            return 1;
        }

        try {
            Excel::import(new ConstituenciesPopulationImport, $file);
            $this->info('Constituency population data imported successfully.');
        } catch (\Exception $e) {
            $this->error('An error occurred while importing the file: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
} 