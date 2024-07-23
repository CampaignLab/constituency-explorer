<?php

// app/Console/Commands/ImportCharities.php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CharitiesImport;
use Illuminate\Support\Facades\Log;

class ImportCharities extends Command
{
    protected $signature = 'import:charities';

    protected $description = 'Import charities.';

    public function handle()
    {
        ini_set('memory_limit', '512M'); // Increase memory limit

        $file = database_path('fixtures/CharityBase_6a177e34883233ee698fa2b9a69a34d4.csv');

        if (! file_exists($file)) {
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
