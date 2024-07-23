<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ConstituenciesImport;

class ImportConstituencies extends Command
{
    protected $signature = 'import:constituencies';

    protected $description = 'Import constituencies.';

    public function handle()
    {
        $file = database_path('fixtures/parliament_con_2025.csv');

        if (! file_exists($file)) {
            $this->error("File not found: {$file}");
            return 1;
        }

        try {
            Excel::import(new ConstituenciesImport, $file);
            $this->info('Constituencies imported successfully.');
        } catch (\Exception $e) {
            $this->error('An error occurred while importing the file: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
