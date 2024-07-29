<?php

namespace App\Console\Commands;

use App\Enums\PhaseOfEducation;
use App\Models\LocalAuthority;
use App\Models\School;
use Illuminate\Console\Command;
use Spatie\SimpleExcel\SimpleExcelReader;

class ImportScottishSchoolsCommand extends Command
{
    protected $signature = 'import:scottish-schools';

    protected $description = 'Import Scottish schools.';

    public function handle()
    {
        $file = database_path('fixtures/schools-scotland.xlsx');

        if (!file_exists($file)) {
            $this->error("File not found: {$file}");
            return 1;
        }

        $reader = SimpleExcelReader::create($file);

        $reader->getRows()->each(function (array $row) {
            $la = LocalAuthority::where('gss_code', $row['LACode'])->first();

            if (! $la) {
                return;
            }

            $constituency = $la->constituencies->first();

            if (! $constituency) {
                return;
            }

            School::create([
                'constituency_id' => $constituency->id,
                'name' => $row['SchoolName'],
                'phase_of_education' => match ($row['SchoolType']) {
                    'Primary' => PhaseOfEducation::Primary,
                    'Secondary' => PhaseOfEducation::Secondary,
                    default => null,
                },
                'latitude' => $row['Latitude'],
                'longitude' => $row['Longitude'],
            ]);
        });

        $this->info('Scottish schools imported successfully.');
    }
}
