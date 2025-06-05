<?php

namespace App\Console\Commands;

use App\Models\Constituency;
use Illuminate\Support\Facades\Http;

class ImportParliamentConstituencyIds extends BaseImportCommand
{
    protected $signature = 'import:parliament-constituency-ids';
    protected $description = 'Import Parliament constituency IDs from the Parliament API.';
    protected $filename = 'fixtures/parliament_constituency_ids.csv';
    protected $pageSize = 20;

    public function fetchApiPage($skip, $take)
    {
        $response = Http::get("https://members-api.parliament.uk/api/Location/Constituency/Search", [
            'skip' => $skip,
            'take' => $take,
        ]);

        if (! $response->successful()) {
            throw new \Exception("Failed to fetch data from Parliament API: " . $response->status());
        }

        return $response->json();
    }

    public function importRow($row)
    {
        $parliamentId = $row['value']['id'] ?? null;
        $name = $row['value']['name'] ?? null;

        if (!$parliamentId || !$name) {
            return null;
        }

        // Try to find a matching constituency by name
        $constituency = Constituency::where('name', $name)->first();

        if (! $constituency) {
            $this->warn("Constituency not found: {$name}");
            return null;
        }

        $constituency->update([
            'parliament_constituency_id' => $parliamentId,
        ]);

        return $constituency;
    }

    public function handle()
    {
        $this->outputTitle();

        $skip = 0;

        do {
            try {
                $data = $this->fetchApiPage($skip, $this->pageSize);
            } catch (\Exception $e) {
                $this->error("Error fetching API page: " . $e->getMessage());
                return 1;
            }

            if ($skip === 0) {
                $totalResults = $data['totalResults'] ?? 0;
                $this->output->progressStart($totalResults);
            }

            $rows = $data['items'] ?? [];

            if (empty($rows)) {
                break;
            }

            foreach ($rows as $row) {
                $this->importRow($row);
                $this->output->progressAdvance();
            }

            $skip += $this->pageSize;

            // Check if we've processed all items
            if ($skip >= ($data['totalResults'] ?? 0)) {
                break;
            }
        } while (true);

        $this->output->progressFinish();
        $this->outputPostscript();
        return 0;
    }
}
