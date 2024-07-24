<?php

namespace App\Models;

use App\Enums\PhaseOfEducation;
use App\Enums\SchoolGender;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'gender' => SchoolGender::class,
        'phase_of_education' => PhaseOfEducation::class,
    ];
}
