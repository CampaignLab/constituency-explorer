<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\LocalAuthoritiesImport;

class ImportLocalAuthorities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:localauthorities {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import local authorities from a CSV file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $file = storage_path('app/imports/' . $this->argument('file'));

        if (!file_exists($file)) {
            $this->error("File not found: {$file}");
            return 1;
        }

        try {
            Excel::import(new LocalAuthoritiesImport, $file);
            $this->info('Local authorities imported successfully.');
        } catch (\Exception $e) {
            $this->error('An error occurred while importing the file: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
