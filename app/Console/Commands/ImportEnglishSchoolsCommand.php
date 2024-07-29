<?php

namespace App\Console\Commands;

use App\Enums\PhaseOfEducation;
use App\Enums\SchoolGender;
use App\Imports\EnglishSchoolsImport;
use App\Models\Constituency;
use App\Models\School;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use proj4php\Point;
use proj4php\Proj;
use proj4php\Proj4php;
use Spatie\SimpleExcel\SimpleExcelReader;

class ImportEnglishSchoolsCommand extends Command
{
    protected $signature = 'import:english-schools';

    protected $description = 'Import English schools.';

    public function handle()
    {
        ini_set('memory_limit', '-1'); // Increase memory limit

        $file = database_path('fixtures/schools-england.csv');

        if (! file_exists($file)) {
            $this->error("File not found: {$file}");
            return 1;
        }

        $reader = SimpleExcelReader::create($file);
        $proj4 = new Proj4php();
        $osgb = new Proj('EPSG:27700', $proj4);
        $wgs84 = new Proj('EPSG:4326', $proj4);

        $reader->getRows()->each(function (array $row) use ($osgb, $wgs84, $proj4) {
            $constituency = Constituency::where('gss_code', $row['ParliamentaryConstituency (code)'])->value('id');

            if (! $constituency) {
                return;
            }

            $point = new Point($row['Easting'], $row['Northing'], $osgb);
            $point = $proj4->transform($wgs84, $point);

            School::create([
                'constituency_id' => $constituency,
                'name' => $row['EstablishmentName'],
                'phase_of_education' => match ($row['PhaseOfEducation (name)']) {
                    'Primary', 'Middle deemed primary' => PhaseOfEducation::Primary,
                    'Secondary', 'Middle deemed secondary' => PhaseOfEducation::Secondary,
                    'Nursery' => PhaseOfEducation::Nursery,
                    '16 plus' => PhaseOfEducation::Over16,
                    'All-through' => PhaseOfEducation::All,
                    default => null,
                },
                'gender' => match ($row['Gender (name)']) {
                    'Mixed' => SchoolGender::Mixed,
                    'Boys' => SchoolGender::Boys,
                    'Girls' => SchoolGender::Girls,
                    default => null,
                },
                'latitude' => $point->y,
                'longitude' => $point->x,
            ]);
        });

        $this->info('English schools imported successfully.');
    }
}
