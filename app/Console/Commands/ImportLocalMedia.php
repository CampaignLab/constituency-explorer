<?php

namespace App\Console\Commands;

use App\Models\LocalAuthority;
use App\Models\LocalMedia;

class ImportLocalMedia extends BaseImportCommand
{
    protected $signature = 'import:local-media';
    protected $description = 'Import local media data from CSV.';
    protected $filename = 'fixtures/local-media.csv';

    private $localAuthorities;

    public function initialise()
    {
        $this->localAuthorities = LocalAuthority::all()->keyBy('name');
    }

    public function importRow($row)
    {
        $la = $this->localAuthorities[$row['coverage LAD']] ?? null;

        if (! $la) {
            $this->warn("Local authority not found: {$row['coverage LAD']}");
            return null;
        }

        $constituency = $la->constituencies->sortByDesc('pivot.percentage_overlap_area')->first();

        if (! $constituency) {
            $this->warn('Constituency not found for Local Authority: ' . $row['coverage LAD']);
            return null;
        }

        return LocalMedia::create([
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
    }
}
