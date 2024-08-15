<?php

use App\Exports\AllLaExport;
use App\Exports\AllPcon23Export;
use App\Exports\ConstituencyCharities;
use App\Exports\ConstituencyDentists;
use App\Exports\ConstituencyHospitals;
use App\Exports\ConstituencyLocalAuthority;
use App\Exports\ConstituencyOldConstituency;
use App\Exports\ConstituencySchools;
use App\Exports\ConstituencyTownsExport;
use App\Exports\ConstituencyWithAllOverlapsExport;
use App\Exports\ConstituencyWithHighestOverlapExport;
use App\Models\Constituency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

Route::view('/', 'index')
    ->name('index');

Route::get('/search', function () {
    return view('search');
})
    ->name('search');

Route::get('/constituency/{constituency:gss_code}', function (Constituency $constituency) {
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

Route::get('/exports/all-la', function () {
    return Excel::download(new AllLaExport, 'constituencies+la.csv');
})
    ->name('exports.all-la');

Route::get('/exports/all-pcon23', function () {
    return Excel::download(new AllPcon23Export, 'constituencies+pcon23.csv');
})
    ->name('exports.all-pcon23');

Route::get('/exports/constituency-with-all-overlaps', function () {
    return Excel::download(new ConstituencyWithAllOverlapsExport, 'constituencies+all-overlaps.csv');
})
    ->name('exports.constituency-with-all-overlaps');

Route::get('/constituency/{constituency:gss_code}/export', function (Request $request, Constituency $constituency) {
    $export = $request->input('export');

    return Excel::download(match ($export) {
        'towns' => new ConstituencyTownsExport($constituency),
        'charities' => new ConstituencyCharities($constituency),
        'dentists' => new ConstituencyDentists($constituency),
        'hospitals' => new ConstituencyHospitals($constituency),
        'schools' => new ConstituencySchools($constituency),
        'la' => new ConstituencyLocalAuthority($constituency),
        'old' => new ConstituencyOldConstituency($constituency),
    }, "{$constituency->name}+{$export}.csv");
})
    ->name('constituency.export');
