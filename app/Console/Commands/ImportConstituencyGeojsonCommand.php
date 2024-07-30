<?php

namespace App\Console\Commands;

use App\Models\Constituency;
use Illuminate\Console\Command;

class ImportConstituencyGeojsonCommand extends Command
{
    protected $signature = 'import:constituency-geojson';

    protected $description = 'Import GeoJSON data for constituencies.';

    public function handle()
    {
        $file = database_path('fixtures/pcon24.geojson');

        if (!file_exists($file)) {
            $this->error('GeoJSON file not found.');
            return;
        }

        $json = json_decode(file_get_contents($file), true);

        foreach ($json['features'] as $geojson) {
            $constituency = Constituency::where('gss_code', $geojson['properties']['PCON24CD'])->first();

            if (! $constituency) {
                $this->warn('Constituency not found: ' . $geojson['properties']['PCON24CD']);
                continue;
            }

            $this->info('Updating constituency: ' . $constituency->name);

            // Convert all coordinates to WGS84.
            $constituency->update([
                'geojson' => $geojson,
            ]);
        }
    }
}
