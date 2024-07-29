<?php

namespace App\Console\Commands;

use App\Models\Constituency;
use Illuminate\Console\Command;
use proj4php\Point;
use proj4php\Proj;
use proj4php\Proj4php;

class ImportConstituencyGeojsonCommand extends Command
{
    protected $signature = 'import:constituency-geojson';

    protected $description = 'Import GeoJSON data for constituencies.';

    public function handle()
    {
        $file = database_path('fixtures/constituency-geojson.geojson');

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

            if ($constituency->geojson !== null) {
                $this->warn('Constituency already has GeoJSON data: ' . $constituency->name);
                continue;
            }

            $this->info('Updating constituency: ' . $constituency->name);

            // Convert all coordinates to WGS84.
            $geojson['geometry']['coordinates'] = $this->convertCoordinatesToWgs84($geojson['geometry']['coordinates']);

            $constituency->update([
                'geojson' => $geojson,
            ]);
        }
    }

    protected function convertCoordinatesToWgs84(array $coordinates): array
    {
        if (count($coordinates) === 2 && !is_array($coordinates[0])) {
            return $this->convertOsgbToWgs84($coordinates);
        }

        foreach ($coordinates as $key => $coordinate) {
            $coordinates[$key] = $this->convertCoordinatesToWgs84($coordinate);
        }

        return $coordinates;
    }

    protected function convertOsgbToWgs84(array $coordinates)
    {
        $proj4 = new Proj4php();

        $osgb = new Proj('EPSG:27700', $proj4);
        $wgs84 = new Proj('EPSG:4326', $proj4);

        $point = new Point($coordinates[0], $coordinates[1], projection: $osgb);
        $point = $proj4->transform($wgs84, $point);

        return [$point->x, $point->y];
    }
}
