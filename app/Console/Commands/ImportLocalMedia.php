<?php

namespace App\Console\Commands;

use App\Models\LocalAuthority;
use App\Models\LocalMedia;
use Illuminate\Console\Command;
use Spatie\SimpleExcel\SimpleExcelReader;

class ImportLocalMedia extends Command
{
    protected $signature = 'import:local-media';

    protected $description = 'Import local media data from CSV.';

    public function handle()
    {
        $file = database_path('fixtures/local-media.csv');

        if (!file_exists($file)) {
            $this->error('File not found: ' . $file);
            return;
        }

        $reader = SimpleExcelReader::create($file);

        $reader->getRows()->each(function (array $row) {
            $la = LocalAuthority::where('name', $row['coverage LAD'])->first();

            if (! $la) {
                $this->warn('Local Authority not found: ' . $row['coverage LAD']);
                return;
            }

            $constituency = $la->constituencies->sortByDesc('pivot.percentage_overlap_area')->first();

            if (! $constituency) {
                $this->warn('Constituency not found for Local Authority: ' . $row['coverage LAD']);
                return;
            }

            LocalMedia::create([
                'constituency_id' => $constituency->id,
                'local_authority_id' => $la->id,
                'name' => $row['Publication'],
                'address' => $row['Office / Newsroom Address'] ? array_map(trim(...), explode(',', $row['Office / Newsroom Address'])) : null,
                'twitter' => $row['Twitter'] ?: null,
                'type_of_owner' => $row['Type of owner'] ?: null,
                'frequency' => $row['Frequency'] ?: null,
                'cost' => $row['Cost'] ?: null,
                'media_type' => $row['Media Type'] ?: null,
                'website' => $row['Website'] ?: null,
            ]);
        });
    }
}
