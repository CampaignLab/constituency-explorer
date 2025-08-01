<?php

namespace App\Console\Commands;

use App\Models\Constituency;
use \JsonMachine\Items;

class ImportConstituencyGeojsonCommand extends BaseImportCommand
{
    protected $signature = 'import:constituency-geojson {filename?}';
    protected $description = 'Import GeoJSON data for constituencies.';
    protected $filename = 'fixtures/pcon24.geojson';

    public function importRow($row)
    {
        $constituency = Constituency::where('gss_code', $row['properties']['PCON24CD'])->first();

        if (! $constituency) {
            $this->warn("Constituency not found: {$row['properties']['PCON24NM']} ({$row['properties']['PCON24CD']})");
            return null;
        }

        $constituency->update([
            'geojson' => $row,
        ]);

        return $constituency;
    }

    public function handle()
    {
        $this->outputTitle();

        $file = $this->getFile();
        if (! $file) {
            return 1;
        }

        $features = Items::fromFile($file, ['pointer' => '/features']);

        $this->output->progressStart(iterator_count(Items::fromFile($file, ['pointer' => '/features'])));

        foreach ($features as $featureObj) {
            $this->output->progressAdvance();
            $feature = json_decode(json_encode($featureObj), true);
            $this->importRow($feature);
        }

        $this->output->progressFinish();

        $this->outputPostscript();

        return 0;
    }
}
