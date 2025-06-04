<?php

namespace App\Console\Commands;

use App\Enums\PhaseOfEducation;
use App\Enums\SchoolGender;
use App\Models\Constituency;
use App\Models\School;
use proj4php\Point;
use proj4php\Proj;
use proj4php\Proj4php;

class ImportEnglishSchoolsCommand extends BaseImportCommand
{
    protected $signature = 'import:english-schools';
    protected $description = 'Import English schools.';
    protected $filename = 'fixtures/schools-england.csv';

    protected $proj4;
    protected $osgb;
    protected $wgs84;
    private $constituencies;

    public function initialise()
    {
        $this->proj4 = new Proj4php();
        $this->osgb = new Proj('EPSG:27700', $this->proj4);
        $this->wgs84 = new Proj('EPSG:4326', $this->proj4);
        $this->constituencies = Constituency::all()->keyBy('gss_code');
    }

    public function setupReader($reader)
    {
        return $reader->useEncoding('ISO-8859-1');
    }

    public function importRow($row)
    {
        $gss_code = $row['ParliamentaryConstituency (code)'];

        // if ($gss_code === '999') {
        //     // Closed
        //     return null;
        // } elseif ($gss_code === 'L99999999') {
        //     // Channel Islands
        //     return null;
        // } elseif ($gss_code === 'M99999999') {
        //     // Isle of Man
        //     return null;
        // }

        $constituency = $this->constituencies[$gss_code] ?? null;

        if (! $constituency) {
            // if ($row['EstablishmentStatus (name)'] !== 'Closed') {
            //     $this->warn("Constituency not found: {$gss_code} ({$row['URN']})");
            // }
            return null;
        }

        $point = new Point($row['Easting'], $row['Northing'], $this->osgb);
        $point = $this->proj4->transform($this->wgs84, $point);

        return School::create([
            'constituency_id' => $constituency->id,
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
    }
}
