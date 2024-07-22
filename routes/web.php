<?php

use App\Models\Constituency;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/constituency/{gss_code}', function ($gss_code) {
    // Fetch the constituency by its GSS code
    $constituency = Constituency::where('gss_code', $gss_code)->firstOrFail();

    // Return the view with the constituency data
    return view('constituency', compact('constituency'));
});
