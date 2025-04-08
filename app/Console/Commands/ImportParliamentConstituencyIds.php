<?php

namespace App\Console\Commands;

use App\Models\Constituency;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ImportParliamentConstituencyIds extends Command
{
    protected $signature = 'import:parliament-constituency-ids';

    protected $description = 'Import Parliament constituency IDs from the Parliament API.';

    public function handle()
    {
        $this->info('Starting Parliament constituency ID import...');
        
        $skip = 0;
        $take = 20;
        $totalProcessed = 0;
        $totalUpdated = 0;
        
        do {
            $response = Http::get("https://members-api.parliament.uk/api/Location/Constituency/Search", [
                'skip' => $skip,
                'take' => $take,
            ]);
            
            if (!$response->successful()) {
                $this->error("Failed to fetch data from Parliament API: " . $response->status());
                return 1;
            }
            
            $data = $response->json();
            $items = $data['items'] ?? [];
            
            if (empty($items)) {
                break;
            }
            
            foreach ($items as $item) {
                $totalProcessed++;
                
                $parliamentId = $item['value']['id'] ?? null;
                $name = $item['value']['name'] ?? null;
                
                if (!$parliamentId || !$name) {
                    continue;
                }
                
                // Try to find a matching constituency by name
                $constituency = Constituency::where('name', $name)->first();
                
                if ($constituency) {
                    $constituency->update([
                        'parliament_constituency_id' => $parliamentId,
                    ]);
                    $totalUpdated++;
                    $this->info("Updated {$name} with Parliament ID {$parliamentId}");
                } else {
                    $this->warn("No match found for constituency: {$name}");
                }
            }
            
            $skip += $take;
            
            // Check if we've processed all items
            if ($skip >= ($data['totalResults'] ?? 0)) {
                break;
            }
            
        } while (true);
        
        $this->info("Import completed. Processed {$totalProcessed} constituencies, updated {$totalUpdated}.");
        
        return 0;
    }
} 