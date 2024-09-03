<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class Postcodes
{
    public function get(string $postcode): array
    {
        $response = Http::get('https://api.postcodes.io/postcodes/' . $postcode)->json();

        if ($response['status'] === 200) {
            return $response['result'];
        }

        return [];
    }
}
