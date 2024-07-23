<?php

namespace App\Console\Commands;

use App\Imports\OldConstituencyOverlapsImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ImportOldConstituencyOverlapsCommand extends Command
{
    protected $signature = 'import:old-constituency-overlaps';

    protected $description = 'Import old constituency overlaps (PCON23 -> PCON25).';

    public function handle()
    {
        $file = database_path('fixtures/PARL10_PARL25_combo_overlap.csv');

        if (!file_exists($file)) {
            $this->error("File not found: {$file}");
            return 1;
        }

        try {
            Excel::import(new OldConstituencyOverlapsImport, $file);
            $this->info('Old constituency overlaps imported successfully.');
        } catch (\Exception $e) {
            $this->error('An error occurred while importing the file: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
