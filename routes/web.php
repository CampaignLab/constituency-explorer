<?php

use App\Exports\ConstituencyWithAllOverlapsExport;
use App\Exports\ConstituencyWithHighestOverlapExport;
use App\Models\Constituency;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', function () {
    return view('index');
})
    ->name('index');

Route::get('/constituency/{gss_code}', function ($gss_code) {
    // Fetch the constituency by its GSS code
    $constituency = Constituency::where('gss_code', $gss_code)->firstOrFail();

    // Return the view with the constituency data
    return view('constituency', [
        'constituency' => $constituency,
    ]);
})
    ->name('constituency');

Route::get('/exports/constituency-with-highest-overlaps', function () {
    return Excel::download(new ConstituencyWithHighestOverlapExport, 'constituencies+la-pcon23.csv');
})
    ->name('exports.constituency-with-highest-overlaps');

Route::get('/exports/constituency-with-all-overlaps', function () {
    return Excel::download(new ConstituencyWithAllOverlapsExport, 'constituencies+all-overlaps.csv');
})
    ->name('exports.constituency-with-all-overlaps');
