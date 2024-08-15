<?php

namespace App\Console\Commands;

use App\Models\Constituency;
use App\Models\PlaceOfWorship;
use Illuminate\Console\Command;
use Spatie\SimpleExcel\SimpleExcelReader;

class ImportPlacesOfWorship extends Command
{
    protected $signature = 'import:places-of-worship';

    protected $description = 'Import places of worship from CSV file.';

    public function handle()
    {
        $file = database_path('fixtures/places-of-worship.csv');

        if (! file_exists($file)) {
            $this->error('File not found: ' . $file);
            return;
        }

        $this->info('Importing places of worship...');

        $reader = SimpleExcelReader::create($file);

        $reader->getRows()->each(function (array $row) {
            $constituency = Constituency::where('gss_code', $row['Mapped: codes.parliamentary_constituency_2025'])->first();

            if (! $constituency) {
                $this->warn('Skipping place of worship: ' . $row['name'] . ' - constituency not found.');
                return;
            }

            PlaceOfWorship::create([
                'name' => $row['name'],
                'religion' => $row['religion'],
                'denomination' => $row['denomination'],
                'postcode' => $row['postcode'],
                'constituency_id' => $constituency->id,
                'longitude' => $row['Mapped: longitude'],
                'latitude' => $row['Mapped: latitude'],
            ]);
        });

        $this->info('Places of worship imported.');
    }
}
