<?php

namespace App;

use Illuminate\Support\HtmlString;

function mdash(): HtmlString
{
    return new HtmlString('&mdash;');
}

function simplify_geojson_coordinates(array $geojson): array
{
    $json = json_encode($geojson);
    $json = preg_replace_callback('/\d+\.\d+/', function ($matches) {
        return round($matches[0], 4);
    }, $json);

    return $geojson;
}

function simplify_polygon(array $polygon): array
{
    $simplified = [];
    foreach ($polygon as $ring) {
        $simplified[] = simplify_ring($ring);
    }

    return $simplified;
}

function simplify_ring(array $ring): array
{
    $simplified = [];
    $prev = null;
    foreach ($ring as $point) {
        if ($prev === null || $prev[0] !== $point[0] || $prev[1] !== $point[1]) {
            $simplified[] = $point;
            $prev = $point;
        }
    }

    return $simplified;
}
