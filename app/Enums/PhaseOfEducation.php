<?php

namespace App\Enums;

enum PhaseOfEducation: string
{
    case Nursery = 'nursery';
    case Primary = 'primary';
    case Secondary = 'secondary';
    case All = 'all';
    case Over16 = 'over16';

    public function getLabel(): string
    {
        return match ($this) {
            self::Nursery => 'Nursery',
            self::Primary => 'Primary',
            self::Secondary => 'Secondary',
            self::All => 'All',
            self::Over16 => 'Over 16',
        };
    }
}
