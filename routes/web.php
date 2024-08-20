<?php

use App\Exports\AllLaExport;
use App\Exports\AllPcon23Export;
use App\Exports\ConstituencyCharities;
use App\Exports\ConstituencyCommunityCentres;
use App\Exports\ConstituencyDentists;
use App\Exports\ConstituencyHospitals;
use App\Exports\ConstituencyLocalAuthority;
use App\Exports\ConstituencyLocalMedia;
use App\Exports\ConstituencyOldConstituency;
use App\Exports\ConstituencyPlacesOfWorship;
use App\Exports\ConstituencySchools;
use App\Exports\ConstituencyTownsExport;
use App\Exports\ConstituencyWithAllOverlapsExport;
use App\Exports\ConstituencyWithCharities;
use App\Exports\ConstituencyWithDentists;
use App\Exports\ConstituencyWithHighestOverlapExport;
use App\Exports\ConstituencyWithHospitals;
use App\Exports\ConstituencyWithSchools;
use App\Exports\ConstituencyWithTowns;
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

Route::get('/exports/constituency-towns', function () {
    return Excel::download(new ConstituencyWithTowns, 'constituencies+towns.csv');
})
    ->name('exports.constituency-towns');

Route::get('/exports/constituency-schools', function () {
    return Excel::download(new ConstituencyWithSchools, 'constituencies+schools.csv');
})
    ->name('exports.constituency-schools');

Route::get('/exports/constituency-hospitals', function () {
    return Excel::download(new ConstituencyWithHospitals, 'constituencies+hospitals.csv');
})
->name('exports.constituency-hospitals');

Route::get('/exports/constituency-dentists', function () {
    return Excel::download(new ConstituencyWithDentists, 'constituencies+dentists.csv');
})
->name('exports.constituency-dentists');

Route::get('/exports/constituency-charities', function () {
    return Excel::download(new ConstituencyWithCharities, 'constituencies+charities.csv');
})
->name('exports.constituency-charities');

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
        'community-centres' => new ConstituencyCommunityCentres($constituency),
        'places-of-worship' => new ConstituencyPlacesOfWorship($constituency),
        'local-media' => new ConstituencyLocalMedia($constituency),
    }, "{$constituency->name}+{$export}.csv");
})
    ->name('constituency.export');
