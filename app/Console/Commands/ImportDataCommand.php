<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportDataCommand extends Command
{
    protected $signature = 'import:data';

    protected $description = 'Execute all import scripts.';

    public function handle()
    {
        if (! $this->confirm('Are you sure you want to import data?')) {
            return;
        }

        $this->call(ImportConstituencies::class);
        $this->call(ImportLocalAuthorities::class);
        $this->call(ImportConstituencyLocalAuthorityPivotData::class);
        $this->call(ImportCharities::class);
        $this->call(ImportTownsCommand::class);
        $this->call(ImportConstituencyTownMappingsCommand::class);
        $this->call(ImportOldConstituenciesCommand::class);
        $this->call(ImportOldConstituencyOverlapsCommand::class);
        $this->call(ImportDentistsCommand::class);
        $this->call(ImportEnglishHospitalsCommand::class);
        $this->call(ImportEnglishSchoolsCommand::class);
        $this->call(ImportCommunityCentres::class);
        $this->call(ImportPlacesOfWorship::class);
    }
}
