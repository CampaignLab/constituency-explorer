<?php

namespace App\Console\Commands;

use App\Imports\EnglishHospitalsImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ImportEnglishHospitalsCommand extends Command
{
    protected $signature = 'import:english-hospitals';

    protected $description = 'Import English hospitals.';

    public function handle()
    {
        $file = database_path('fixtures/hospitals-england.csv');

        if (!file_exists($file)) {
            $this->error("File not found: {$file}");
            return 1;
        }

        try {
            Excel::import(new EnglishHospitalsImport, $file);
            $this->info('Hospitals imported successfully.');
        } catch (\Exception $e) {
            $this->error('An error occurred while importing the file: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
