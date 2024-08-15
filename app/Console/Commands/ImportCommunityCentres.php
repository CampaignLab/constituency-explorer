<?php

namespace App\Console\Commands;

use App\Models\CommunityCentre;
use App\Models\Constituency;
use Illuminate\Console\Command;
use Spatie\SimpleExcel\SimpleExcelReader;

class ImportCommunityCentres extends Command
{
    protected $signature = 'import:community-centres';

    protected $description = 'Import community centres from CSV file.';

    public function handle()
    {
        $file = database_path('fixtures/community-centres.csv');

        if (! file_exists($file)) {
            $this->error('File not found: ' . $file);
            return;
        }

        $this->info('Importing community centres...');

        $reader = SimpleExcelReader::create($file);

        $reader->getRows()->each(function (array $row) {
            $constituency = Constituency::where('gss_code', $row['Mapped: codes.parliamentary_constituency_2025'])->first();

            if (! $constituency) {
                $this->warn('Skipping community centre: ' . $row['name'] . ' - constituency not found.');
                return;
            }

            CommunityCentre::create([
                'name' => $row['name'],
                'religion' => $row['religion'],
                'denomination' => $row['denomination'],
                'postcode' => $row['postcode'],
                'constituency_id' => $constituency->id,
                'longitude' => $row['Mapped: longitude'],
                'latitude' => $row['Mapped: latitude'],
            ]);
        });

        $this->info('Community centres imported.');
    }
}
