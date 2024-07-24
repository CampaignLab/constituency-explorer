<?php

namespace App\Console\Commands;

use App\Imports\DentistsImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ImportDentistsCommand extends Command
{
    protected $signature = 'import:dentists';

    protected $description = 'Import dentists.';

    public function handle()
    {
        $file = database_path('fixtures/dentists-england.csv');

        if (!file_exists($file)) {
            $this->error("File not found: {$file}");
            return 1;
        }

        try {
            Excel::import(new DentistsImport, $file);
            $this->info('Dentists imported successfully.');
        } catch (\Exception $e) {
            $this->error('An error occurred while importing the file: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
