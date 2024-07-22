<?php

// app/Console/Commands/ImportCharities.php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CharitiesImport;
use Illuminate\Support\Facades\Log;

class ImportCharities extends Command
{
    protected $signature = 'import:charities {file}';
    protected $description = 'Import charities from a CSV file';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        ini_set('memory_limit', '512M'); // Increase memory limit

        $file = storage_path('app/imports/' . $this->argument('file'));

        if (!file_exists($file)) {
            $this->error("File not found: {$file}");
            return 1;
        }

        try {
            Excel::import(new CharitiesImport, $file);
            $this->info('Charities imported successfully.');
        } catch (\Exception $e) {
            $this->error('An error occurred while importing the file: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
