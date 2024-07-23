<?php

namespace App\Console\Commands;

use App\Models\Constituency;
use App\Models\Town;
use Illuminate\Console\Command;
use Spatie\SimpleExcel\SimpleExcelReader;

class ImportConstituencyTownMappingsCommand extends Command
{
    protected $signature = 'import:constituency-town-mappings';

    protected $description = 'Map towns -> constituencies mappings.';

    public function handle()
    {
        $file = database_path('fixtures/towns-map.csv');

        if (!file_exists($file)) {
            $this->error("File not found: {$file}");
            return 1;
        }

        $reader = SimpleExcelReader::create($file);

        $reader->getRows()->each(function (array $row) {
            if (! $row['town_name']) {
                return;
            }

            $town = Town::where('name', $row['town_name'])->first();

            if (! $town) {
                $this->warn('Town not found: ' . $row['town_name']);
                return;
            }

            $constituency = Constituency::where('name', $row['new_constituency_name'])->first();

            if (! $constituency) {
                $this->warn('Constituency not found: ' . $row['new_constituency_name']);
                return;
            }

            $town->constituencies()->syncWithoutDetaching($constituency);
        });
    }
}
