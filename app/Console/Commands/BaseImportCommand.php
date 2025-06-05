<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\SimpleExcel\SimpleExcelReader;

abstract class BaseImportCommand extends Command
{
    protected $signature = '';
    protected $description = '';
    protected $filename = '';

    /**
     * Displays a message in the console when the command is run.
     */
    public function outputTitle()
    {
        $this->output->title(trim($this->description, '.'));
    }

    /**
     * Displays a message in the console when the command finishes.
     */
    public function outputPostscript()
    {
        $this->info(trim($this->description, '.') . ' complete.');
    }

    /**
     * Gets path to the file to import, and confirm it exists.
     */
    public function getFile()
    {
        $file = database_path($this->filename);
        if (! file_exists($file)) {
            $this->error("File not found: {$file}");
            return;
        }

        return $file;
    }

    /**
     * This is here in case we want to modify the SimpleExcelReader,
     * e.g. to set the file encoding.
     */
    public function setupReader($reader)
    {
        return $reader;
    }

    /**
     * Use this for any extra initialisation,
     * e.g. for setting up global lookups that can be used for each row.
     */
    public function initialise() {}

    /**
     * Main method that is call for each row.
     */
    abstract public function importRow($row);

    public function handle()
    {
        $this->outputTitle();

        $file = $this->getFile();
        if (! $file) {
            return 1;
        }

        $this->initialise();

        $reader = SimpleExcelReader::create($file);
        $reader = $this->setupReader($reader);

        $this->output->progressStart($reader->getRows()->count());
        $command = $this;

        $reader->getRows()->each(function ($row) use ($command) {
            $command->output->progressAdvance();
            try {
                return $command->importRow($row);
            } catch (\Exception $e) {
                $command->error("Error importing row: " . $e->getMessage());
                return null;
            }
        });

        $this->output->progressFinish();
        $this->outputPostscript();

        return 0;
    }
}
