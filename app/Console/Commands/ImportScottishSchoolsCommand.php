<?php

namespace App\Console\Commands;

use App\Models\School;
use App\Models\LocalAuthority;
use App\Enums\PhaseOfEducation;

class ImportScottishSchoolsCommand extends BaseImportCommand
{
    protected $signature = 'import:scottish-schools {filename?}';
    protected $description = 'Import Scottish schools.';
    protected $filename = 'fixtures/schools-scotland.xlsx';

    private $localAuthorities;

    public function initialise()
    {
        $this->localAuthorities = LocalAuthority::all()->keyBy('gss_code');
    }

    public function importRow($row)
    {
        $la = $this->localAuthorities[$row['LACode']] ?? null;

        if (! $la) {
            $this->warn("Local authority not found: {$row['LACode']}");
            return null;
        }

        $constituency = $la->constituencies->first();

        if (! $constituency) {
            $this->warn("Constituency not found: {$row['LACode']}");
            return null;
        }

        return School::create([
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
    }
}
