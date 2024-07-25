<?php

namespace App;

use Illuminate\Support\HtmlString;

function mdash(): HtmlString
{
    return new HtmlString('&mdash;');
}
