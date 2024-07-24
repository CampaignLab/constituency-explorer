<?php

namespace App\Enums;

enum PhaseOfEducation: string
{
    case Nursery = 'nursery';
    case Primary = 'primary';
    case Secondary = 'secondary';
    case All = 'all';
    case Over16 = 'over16';
}
