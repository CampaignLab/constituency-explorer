<?php

namespace App\Console\Commands;

use App\Models\Constituency;
use App\Models\GreenSpace;
use Illuminate\Console\Command;
use Spatie\SimpleExcel\SimpleExcelReader;

class ImportGreenSpaces extends Command
{
    protected $signature = 'import:green-spaces';

    protected $description = 'Import green spaces from a CSV file.';

    public function handle()
    {
        $file = database_path('fixtures/green-spaces.csv');

        if (!file_exists($file)) {
            $this->error('The file does not exist.');
            return;
        }

        $reader = SimpleExcelReader::create($file);

        $reader->getRows()->each(function (array $row) {
            $constituency = Constituency::where('gss_code', $row['Mapped: codes.parliamentary_constituency_2025'])->first();

            if (!$constituency) {
                $this->warn("Constituency not found for {$row['Mapped: codes.parliamentary_constituency_2025']}");
                return;
            }

            GreenSpace::create([
                'constituency_id' => $constituency->id,
                'name' => $row['name'],
                'postcode' => $row['postcode'] ?: null,
                'latitude' => $row['Mapped: latitude'],
                'longitude' => $row['Mapped: longitude'],
                'opening_hours' => $row['opening_hours'] ?: null,
            ]);
        });

        $this->info('Green spaces imported successfully.');
    }
}
