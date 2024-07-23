<?php

namespace App\Console\Commands;

use App\Imports\TownsImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ImportTownsCommand extends Command
{
    protected $signature = 'imports:towns';

    protected $description = 'Import towns.';

    public function handle()
    {
        $file = database_path('fixtures/uktowns.csv');

        if (!file_exists($file)) {
            $this->error("File not found: {$file}");
            return 1;
        }

        try {
            Excel::import(new TownsImport, $file);
            $this->info('Towns imported successfully.');
        } catch (\Exception $e) {
            $this->error('An error occurred while importing the file: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
