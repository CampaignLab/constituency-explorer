<?php

namespace App\Console\Commands;

use App\Imports\ScottishHospitalsImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ImportScottishHospitalsCommand extends Command
{
    protected $signature = 'import:scottish-hospitals';

    protected $description = 'Import Scottish hospitals.';

    public function handle()
    {
        $file = database_path('fixtures/hospitals-scotland.csv');

        if (!file_exists($file)) {
            $this->error("File not found: {$file}");
            return 1;
        }

        try {
            Excel::import(new ScottishHospitalsImport, $file);
            $this->info('Hospitals imported successfully.');
        } catch (\Exception $e) {
            $this->error('An error occurred while importing the file: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
