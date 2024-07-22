<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ConstituencyLocalAuthorityImport;

class ImportConstituencyLocalAuthorityPivotData extends Command
{
    protected $signature = 'import:pivot {file}';
    protected $description = 'Import pivot data from a CSV file';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $file = storage_path('app/imports/' . $this->argument('file'));

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
