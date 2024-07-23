<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ConstituencyLocalAuthorityImport;

class ImportConstituencyLocalAuthorityPivotData extends Command
{
    protected $signature = 'import:constituency-local-authority-pivot-data';

    protected $description = 'Import Constituency -> Local Authority pivot data.';

    public function handle()
    {
        $file = database_path('fixtures/overlap_local_authorities_cons_2025.csv');

        if (!file_exists($file)) {
            $this->error("File not found: {$file}");
            return 1;
        }

        try {
            Excel::import(new ConstituencyLocalAuthorityImport, $file);
            $this->info('Pivot data imported successfully.');
        } catch (\Exception $e) {
            $this->error('An error occurred while importing the file: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
