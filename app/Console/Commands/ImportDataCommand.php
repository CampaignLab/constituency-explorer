<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Console\Commands\ImportCharities;
use App\Console\Commands\ImportCommunityCentres;
use App\Console\Commands\ImportConstituencies;
use App\Console\Commands\ImportConstituenciesPopulation;
use App\Console\Commands\ImportConstituencyGeojsonCommand;
use App\Console\Commands\ImportConstituencyLocalAuthorityPivotData;
use App\Console\Commands\ImportConstituencyTownMappingsCommand;
use App\Console\Commands\ImportDentistsCommand;
use App\Console\Commands\ImportEnglishHospitalsCommand;
use App\Console\Commands\ImportEnglishSchoolsCommand;
use App\Console\Commands\ImportGreenSpaces;
use App\Console\Commands\ImportLocalAuthorities;
use App\Console\Commands\ImportLocalMedia;
use App\Console\Commands\ImportOldConstituenciesCommand;
use App\Console\Commands\ImportOldConstituencyOverlapsCommand;
use App\Console\Commands\ImportParliamentConstituencyIds;
use App\Console\Commands\ImportPlacesOfWorship;
use App\Console\Commands\ImportScottishHospitalsCommand;
use App\Console\Commands\ImportScottishSchoolsCommand;
use App\Console\Commands\ImportTownsCommand;

class ImportDataCommand extends Command
{
    protected $signature = 'import:data {--database= : The database connection to use}';

    protected $description = 'Execute all import scripts.';

    public function handle()
    {
        if (! $this->confirm('Are you sure you want to import data?')) {
            return;
        }

        $database = $this->option('database');
        if ($database) {
            config(['database.default' => $database]);
        }

        $this->call(ImportConstituencies::class);
        $this->call(ImportConstituenciesPopulation::class);
        $this->call(ImportConstituencyGeojsonCommand::class);
        $this->call(ImportParliamentConstituencyIds::class);

        $this->call(ImportOldConstituenciesCommand::class);
        $this->call(ImportOldConstituencyOverlapsCommand::class);

        $this->call(ImportLocalAuthorities::class);
        $this->call(ImportConstituencyLocalAuthorityPivotData::class);

        $this->call(ImportCharities::class);

        $this->call(ImportTownsCommand::class);
        $this->call(ImportConstituencyTownMappingsCommand::class);

        $this->call(ImportDentistsCommand::class);
        $this->call(ImportEnglishHospitalsCommand::class);
        $this->call(ImportScottishHospitalsCommand::class);
        $this->call(ImportAdditionalHospitalsCommand::class);
        $this->call(ImportEnglishSchoolsCommand::class);
        $this->call(ImportScottishSchoolsCommand::class);
        $this->call(ImportCommunityCentres::class);
        $this->call(ImportPlacesOfWorship::class);
        $this->call(ImportGreenSpaces::class);
        $this->call(ImportLocalMedia::class);
    }
}
